<?php

namespace Kntnt\Schedule_Sociala_Media_Zapier;

use Psr\Log\AbstractLogger;

class Scheduler {

    use Timestamp;

    private $post;

    public function run() {
        add_action( 'save_post', [ $this, 'schedule_posts' ], 10, 2 );
    }

    public function schedule_posts( $id, $post ) {
        if ( 'publish' == $post->post_status ) {
            $this->post = $post;
            $this->schedule( 'linkedin' );
            $this->schedule( 'facebook' );
            $this->schedule( 'twitter' );
        }
    }

    // This class don't save the social media posts to be published; it merely
    // schedule a call of the Sender class, which take care of sending the
    // social media posts to Zapier. Thus, there is no need to schedule more
    // than one event if more than one posts are due at the same time. Since
    // WordPress, after scheduling an event, ignore for ten minutes events with
    // identical signature, this is take care by itself. But on the other hand,
    // it must be possible to schedule with social media posts to go live at
    // separate times within ten minutes. It must also be possible to schedule
    // separate posts at the same time. Hence the need of $this->post->ID and
    // $stimestamp as arguments.
    private function schedule( $target ) {
        if ( $posts = Plugin::get_field( "{$target}_posts", $this->post->ID ) ) {
            foreach ( $posts as $post ) {
                $time = $post['date_and_time'] ?: substr( $this->post->post_modified, 0, 16 );
                $timestamp = $this->timestamp( $time );
                wp_schedule_single_event( $timestamp, 'kntnt-schedule-sociala-media-zapier-publish-posts', [ $this->post->ID, $timestamp ] );
                Plugin::log( 'Scheduled publishing at %s of social media posts of the WordPress post with id %s', $time, $this->post->ID );
            }
        }
    }

}
