<?php

namespace Kntnt\Schedule_Sociala_Media_Zapier;

class Settings extends Abstract_Settings {

    use WPML;

    /**
     * Returns the settings menu title.
     */
    protected function menu_title() {
        return __( 'Social Media Scheduler', 'kntnt-schedule-sociala-media-zapier' );
    }

    /**
     * Returns the settings page title.
     */
    protected function page_title() {
        return __( "Kntnt Social Media Scheduler with Zapier", 'kntnt-schedule-sociala-media-zapier' );
    }

    /**
     * Returns all fields used on the settings page.
     */
    protected function fields() {

        $this->init_lang();

        $fields[ $this->webhook_name( 'linkedin' ) ] = [
            'type' => 'url',
            'label' => __( "LinkedIn webhook", 'kntnt-schedule-sociala-media-zapier' ),
            'size' => 80,
            'description' => __( 'URL of the <strong>catch webhook</strong> of your LinkedIn zap.', 'kntnt-schedule-sociala-media-zapier' ),
        ];

        $fields[ $this->webhook_name( 'facebook' ) ] = [
            'type' => 'url',
            'label' => __( "Facebook webhook", 'kntnt-schedule-sociala-media-zapier' ),
            'description' => __( 'URL of the <strong>catch webhook</strong> of your Facebook zap.', 'kntnt-schedule-sociala-media-zapier' ),
            'size' => 80,
        ];

        $fields[ $this->webhook_name( 'twitter' ) ] = [
            'type' => 'url',
            'label' => __( "Twitter webhook", 'kntnt-schedule-sociala-media-zapier' ),
            'description' => __( 'URL of the <strong>catch webhook</strong> of your Twitter zap.', 'kntnt-schedule-sociala-media-zapier' ),
            'size' => 80,
        ];

        $fields["linkedin_length"] = [
            'type' => 'integer',
            'label' => __( "Twitter length", 'kntnt-schedule-sociala-media-zapier' ),
            'description' => __( 'Max number of characters allowed in a LinkedIn post.', 'kntnt-schedule-sociala-media-zapier' ),
            'size' => 10,
            'min' => 0,
            'max' => 700,
            'default' => 700,
        ];

        $fields["facebook_length"] = [
            'type' => 'integer',
            'label' => __( "Facebook length", 'kntnt-schedule-sociala-media-zapier' ),
            'description' => __( 'Max number of characters allowed in a Facebook post.', 'kntnt-schedule-sociala-media-zapier' ),
            'size' => 10,
            'min' => 0,
            'max' => 63206,
            'default' => 63206,
        ];

        $fields["twitter_length"] = [
            'type' => 'integer',
            'label' => __( "Twitter length", 'kntnt-schedule-sociala-media-zapier' ),
            'description' => __( 'Max number of characters allowed in a tweet.', 'kntnt-schedule-sociala-media-zapier' ),
            'size' => 10,
            'min' => 0,
            'max' => 280,
            'default' => 256, // Leave 24 characters for space and t.co-link
        ];

        $fields['submit'] = [
            'type' => 'submit',
        ];

        return $fields;

    }

}
