<?php

namespace Kntnt\ACF_Zapier_Integrator;

class Plugin extends Abstract_Plugin {

    static protected function dependencies() {
        return [
            'advanced-custom-fields-pro/acf.php' => __( 'Advanced Custom Fields Pro', 'kntnt-acf-zapier-integrator' ),
        ];
    }

    public function classes_to_load() {

        return [
            'any' => [
                'init' => [
                    'ACF',
                    'Scheduler',
                ],
            ],
            'admin' => [
                'init' => [
                    'Settings',
                ],
            ],
        ];

    }

}
