<?php

namespace Kntnt\Schedule_Sociala_Media_Zapier;

class ACF {

    public function run() {

        add_filter( 'acf/prepare_field/key=field_5de3a0d2f9ad5', [ $this, 'missing_webhooks_message' ] );

        add_filter( 'acf/prepare_field/key=field_5ddec09314fa4', [ $this, 'linkedin_fields' ] );
        add_filter( 'acf/prepare_field/key=field_5de16074d18f0', [ $this, 'linkedin_fields' ] );

        add_filter( 'acf/prepare_field/key=field_5ddec0a714fa6', [ $this, 'facebook_fields' ] );
        add_filter( 'acf/prepare_field/key=field_5de161425d142', [ $this, 'facebook_fields' ] );

        add_filter( 'acf/prepare_field/key=field_5ddec0a614fa5', [ $this, 'twitter_fields' ] );
        add_filter( 'acf/prepare_field/key=field_5ddec20314fb1', [ $this, 'twitter_fields' ] );

        require Plugin::template( 'acf-fields.php' );

    }

    public function missing_webhooks_message( $field ) {
        return Plugin::option( 'linkedin_webhook' ) || Plugin::option( 'facebook_webhook' ) || Plugin::option( 'twitter_webhook' ) ? false : $field;
    }

    public function linkedin_fields( $field ) {
        return Plugin::option( 'linkedin_webhook' ) ? $field : false;
    }

    public function facebook_fields( $field ) {
        return Plugin::option( 'facebook_webhook' ) ? $field : false;
    }

    public function twitter_fields( $field ) {
        return Plugin::option( 'twitter_webhook' ) ? $field : false;
    }

}
