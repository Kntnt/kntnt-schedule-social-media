<?php

namespace Kntnt\Schedule_Sociala_Media_Zapier;

use Psr\Log\AbstractLogger;

class Scheduler {

    private $post_has_been_saved;

    public function run() {
        add_action( 'save_post', [ $this, 'publish_post' ], 10, 2 );
        add_action( 'kntnt_acf_zapier_scheduled_post', [ $this, 'publish_post' ], 10, 1 );
    }

    public function publish_post( $id, $post = null ) {
        Plugin::log( 'Called by `%s`.', $post ? 'save_post' : 'kntnt_acf_zapier_scheduled_post' );
        $this->post_has_been_saved = (bool) $post;
        $this->post = $post ?: get_post( $id );
        if ( 'publish' == $this->post->post_status ) {
            $this->process_posts( 'linkedin' );
            $this->process_posts( 'facebook' );
            $this->process_posts( 'twitter' );
        }
    }

    private function process_posts( $target ) {

        $posts = Plugin::get_field( "{$target}_posts", $this->post->ID );
        if ( ! $posts ) {
            Plugin::log( 'Post with id %s has nothing scheduled for %s', $this->post->ID, $target );
            return;
        }

        // Split the array of posts into the following two arrays:
        // $due_posts is an array of posts that are due or will be due within a minute
        // $scheduled_posts is an array of remaining posts.
        list( $due_posts, $non_due_posts ) = $this->split_posts( $posts );

        // Remove the due posts from the post
        if ( $due_posts ) {
            update_field( "{$target}_posts", $non_due_posts, $this->post->ID );
            Plugin::log( 'Removed %s social media posts that have expired from the post with id %s', count( $due_posts ), $this->post->ID );
        }

        // Send the due posts to Zapier.
        $this->send_posts( $due_posts, $target );

        // Schedule the non-due posts if the post is saved.
        if ( $this->post_has_been_saved ) {
            $this->schedule_posts( $non_due_posts );
        }

    }

    private function split_posts( $posts ) {

        $due_posts = [];
        $non_due_posts = [];

        foreach ( $posts as $post ) {
            if ( $this->is_due( $post['date_and_time'] ) ) {
                $due_posts[] = $post;
            }
            else {
                $non_due_posts[] = $post;
            }
        }

        return [ $due_posts, $non_due_posts ];

    }

    private function send_posts( $posts, $target ) {

        $webhook = Plugin::option( "{$target}_webhook" );
        if ( ! $webhook ) {
            Plugin::log( 'No webhook set for %s', $this->post->ID, $target );
            return;
        }

        foreach ( $posts as $post ) {

            $content = $post['content'];

            if ( ! trim( $content ) && ( 'linkedin' == $target || 'facebook' == $target ) ) {
                $content = $this->post_excerpt();
            }

            if ( ! trim( $content ) ) {
                $content = $this->post_meta_description();
            }

            if ( $content = trim( $content ) ) {
                $this->send( $content, $webhook );
            }

        }

    }

    private function schedule_posts( $posts ) {
        foreach ( $posts as $post ) {
            $stimestamp = $this->timestamp( $post['date_and_time'] );
            // The $timezone is used in the argument as a way to work around
            // the WordPress idea that two identical events shouldn't be
            // scheduled within 10 minutes, and at the same time prevent that
            // more than one event is scheduled for each time.
            wp_schedule_single_event( $stimestamp, 'kntnt_acf_zapier_scheduled_post', [ $this->post->ID, $stimestamp ] );
            Plugin::log( 'Scheduled publishing at %s for post with id %s', $post['date_and_time'], $this->post->ID );
        }
    }

    private function send( $content, $webhook ) {

        $data = $this->data( $content );

        Plugin::log( 'Sending to webhook %s: %s', $webhook, $data );

        $result = wp_remote_post( esc_url_raw( $webhook ), [
            'method' => 'POST',
            'headers' => [
                'Accept: application/json',
                'Content-Type: application/json',
            ],
            'body' => json_encode( $data ),
        ] );

        if ( is_wp_error( $result ) ) {
            Plugin::log( 'Failed sending to  webhook %s. %s', $webhook, $result->get_error_message() );
        }
        else {
            Plugin::log( 'Successfully sent to webhook %s: %s', $webhook, $result );
        }

    }

    private function data( $content ) {

        $data = new \stdClass();

        $data->content = $content;

        $data->id = $this->post->ID;
        $data->url = get_permalink( $this->post ) ?: $this->post->guid;
        $data->title = $this->post->post_title;
        $data->author = get_the_author_meta( 'display_name', $this->post->post_author );
        $data->published_date = $this->post->post_date;
        $data->published_date_gmt = $this->post->post_date_gmt;
        $data->modified = $this->post->post_modified;
        $data->modified_gmt = $this->post->post_modified_gmt;

        $categories = $this->terms( 'category' );
        $data->categories = $this->hashtags( $categories );
        $data->category = isset( $categories ) ? $categories[0] : '';

        $tags = $this->terms( 'post_tag' );
        $data->tags = $this->hashtags( $tags );

        return $data;

    }

    private function post_excerpt() {
        return get_the_excerpt( $this->post );
    }

    private function post_meta_description() {
        return Plugin::get_field( '_genesis_description', $this->post->ID ) ?: '';
    }

    private function is_due( $date_and_time ) {
        return ( '' == $date_and_time ) || ( $this->timestamp( $date_and_time ) - time() < MINUTE_IN_SECONDS );
    }

    private function timestamp( $date_and_time ) {
        return date_create_immutable_from_format( 'Y-m-d H:i', $date_and_time, wp_timezone() )->getTimestamp();
    }

    private function terms( $taxonomy ) {
        return wp_list_pluck( get_the_terms( $this->post, $taxonomy ) ?: [], 'name' );
    }

    private function hashtags( $terms ) {
        return join( ' ', array_map( function ( $term ) {
            return '#' . strtolower( str_replace( ' ', '', $term ) );
        }, $terms ) );
    }

}
