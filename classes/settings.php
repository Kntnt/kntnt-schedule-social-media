<?php

namespace Kntnt\Schedule_Sociala_Media_Zapier;

class Settings extends Abstract_Settings {

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

        $fields['linkedin_webhook'] = [
            'type' => 'url',
            'label' => __( "LinkedIn webhook", 'kntnt-schedule-sociala-media-zapier' ),
            'size' => 80,
            'description' => __( 'Enter the <em>catch webhook URL</em> of your your Webhook to LinkedIn zap.', 'kntnt-schedule-sociala-media-zapier' ),
        ];

        $fields['facebook_webhook'] = [
            'type' => 'url',
            'label' => __( "Facebook webhook", 'kntnt-schedule-sociala-media-zapier' ),
            'size' => 80,
            'description' => __( 'Enter the <em>catch webhook URL</em> of your your Webhook to Facebook zap.', 'kntnt-schedule-sociala-media-zapier' ),
        ];

        $fields['twitter_webhook'] = [
            'type' => 'url',
            'label' => __( "Twitter webhook", 'kntnt-schedule-sociala-media-zapier' ),
            'size' => 80,
            'description' => __( 'Enter the <em>catch webhook URL</em> of your your Webhook to Twitter zap.', 'kntnt-schedule-sociala-media-zapier' ),
        ];

        $fields['submit'] = [
            'type' => 'submit',
        ];

        return $fields;

    }

}
