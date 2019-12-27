<?php

namespace Kntnt\Schedule_Sociala_Media_Zapier;

class Plugin extends Abstract_Plugin {

    static protected function dependencies() {
        return [
            'advanced-custom-fields-pro/acf.php' => __( 'Advanced Custom Fields Pro', 'kntnt-schedule-sociala-media-zapier' ),
        ];
    }

    public function classes_to_load() {
        return [
            'cron' => [
                'init' => [
                    'ACF',       // Needed by ACF
                    'Scheduler', // To schedule social media posts when a scheduled post is published
                    'Sender',
                ],
            ],
            'admin' => [
                'init' => [
                    'ACF',
                    'ACF_UI',
                    'Scheduler', // To schedule social media posts when a post is directly published
                    'Settings',
                ],
            ],
        ];
    }

}
