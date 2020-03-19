<?php

namespace Kntnt\Schedule_Sociala_Media_Zapier;

class Sender {

    use Timestamp;

    use WPML;

    private $post;

    public function run() {
        add_action( 'kntnt-schedule-sociala-media-zapier-publish-posts', [ $this, 'publish_posts' ], 10, 1 );
    }

    public function publish_posts( $id ) {
        $this->post = get_post( $id );
        $this->init_lang( $id );
        if ( 'publish' == $this->post->post_status ) {
            Plugin::log( 'Social media posts of  post %s is to be sent.', $id );
            $this->publish( 'linkedin' );
            $this->publish( 'facebook' );
            $this->publish( 'twitter' );
            $this->publish( 'email' );
        }
    }

    private function publish( $target ) {

        // Get social media posts. Abort if none social media exists.
        $posts = Plugin::get_field( "{$target}_posts", $this->post->ID );
        if ( ! is_array( $posts ) ) {
            Plugin::log( 'No social media posts exists for %s.', $target );
            return;
        }

        // Split the array of posts into posts that are due or will be due
        // within a minute, and remaining posts.
        list( $due_posts, $non_due_posts ) = $this->split_posts( $posts );

        // Abort if no posts are due.
        if ( ! $due_posts ) {
            Plugin::log( 'No social media posts are due for %s.', $target );
            return;
        }

        // Remove due posts from the post. N.B. This is done before the check
        // of webhook, so due posts are removed even if there is no webhook.
        // This is to prevent them to be sent later if the missing webhook is
        // added.
        update_field( "{$target}_posts", $non_due_posts, $this->post->ID );
        Plugin::log( 'Removed %s social media posts that have expired from the post with id %s.', count( $due_posts ), $this->post->ID );

        // Get webhook. Abort if none is provided.
        $webhook = $this->webhook( $target );
        if ( ! $webhook ) {
            Plugin::log( 'No webhook is provided for %s.', $target );
            return;
        }

        foreach ( $due_posts as $post ) {

            // Get the content of the social media post to be published.
            $content = $post['content'];

            // Use the excerpt as content if the content is not provided and
            // the target isn't Twitter (which don't allows lengthy content).
            if ( ! trim( $content ) && ( 'twitter' != $target ) ) {
                $content = $this->post_excerpt();
            }

            // Use the meta description provided by a SEO plugin if the content
            // is not provided and either the target is Twitter or excerpt is
            // empty.
            if ( ! trim( $content ) ) {
                $content = $this->post_meta_description();
            }

            // If we have content, trim it to the target's maximum allowed
            // length and send  it to the webhook.
            if ( $content = $this->normalize_and_trim( $content, $target ) ) {
                $this->send( $content, $webhook );
                Plugin::log( 'Sending to %s.', $target );
            }
            else {
                Plugin::log( 'No content to send to %s.', $target );
            }

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

    private function is_due( $date_and_time ) {
        return ( '' == $date_and_time ) || ( $this->timestamp( $date_and_time ) - time() < MINUTE_IN_SECONDS );
    }

    private function post_excerpt() {
        return get_the_excerpt( $this->post );
    }

    private function post_meta_description() {
        return Plugin::get_field( '_genesis_description', $this->post->ID ) ?: '';
    }

    private function normalize_and_trim( $content, $target ) {
        $max_length = (int) Plugin::option( "{$target}_length", PHP_INT_MAX );
        $content = normalizer_normalize( trim( $content ) );
        $len = strlen( $content );
        if ( $len > $max_length ) {
            $content = substr( $content, 0, $max_length );
            if ( false == ( $pos = strrpos( $content, ' ' ) ) ) {
                $pos = $max_length - 1;
            }
            $content = substr( $content, 0, $pos ) . '…';
        }
        return $content;
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
            Plugin::log( 'Successfully sent to webhook %s.', $webhook );
        }

    }

    private function data( $content ) {

        $data = new \stdClass();

        $data->content = $content;

        if ( $thumbnail_id = get_post_thumbnail_id( $this->post->ID ) ) {
            $thumbnail_src = wp_get_attachment_image_src( $thumbnail_id, Plugin::option( 'image_size', 'medium_large' ) );
            $data->image = $thumbnail_src[0];
        }
        else {
            $data->image = Plugin::option( 'default_image', '' );
        }

        $data->id = $this->post->ID;
        $data->url = $this->url( get_permalink( $this->post ) ?: $this->post->guid );
        $data->title = $this->post->post_title;
        $data->description = trim( $this->post_meta_description() ) ?: trim( $this->post_excerpt() ) ?: '';
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

    private function terms( $taxonomy ) {
        return wp_list_pluck( get_the_terms( $this->post, $taxonomy ) ?: [], 'name' );
    }

    private function hashtags( $terms ) {
        return join( ' ', array_map( function ( $term ) {
            return '#' . strtolower( str_replace( ' ', '', $term ) );
        }, $terms ) );
    }

}
