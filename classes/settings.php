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

        $lang = apply_filters( 'wpml_current_language', null ) ?: '';

        $fields["linkedin_{$lang}_webhook"] = [
            'type' => 'url',
            'label' => __( "LinkedIn webhook", 'kntnt-schedule-sociala-media-zapier' ),
            'size' => 80,
            'description' => __( 'URL of the <strong>catch webhook</strong> of your LinkedIn zap.', 'kntnt-schedule-sociala-media-zapier' ),
        ];

        $fields["facebook_{$lang}_webhook"] = [
            'type' => 'url',
            'label' => __( "Facebook webhook", 'kntnt-schedule-sociala-media-zapier' ),
            'size' => 80,
            'description' => __( 'URL of the <strong>catch webhook</strong> of your Facebook zap.', 'kntnt-schedule-sociala-media-zapier' ),
        ];

        $fields["twitter_{$lang}_webhook"] = [
            'type' => 'url',
            'label' => __( "Twitter webhook", 'kntnt-schedule-sociala-media-zapier' ),
            'size' => 80,
            'description' => __( 'URL of the <strong>catch webhook</strong> of your Twitter zap.', 'kntnt-schedule-sociala-media-zapier' ),
        ];

        $fields['submit'] = [
            'type' => 'submit',
        ];

        return $fields;

    }

}
