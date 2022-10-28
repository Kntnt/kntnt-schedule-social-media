<?php

namespace Kntnt\Schedule_Social_Media;

class Settings extends Abstract_Settings {

    const LINKEDIN_MAX_LENGTH = 700;

    const FACEBOOK_MAX_LENGTH = 63206;

    const TWITTER_MAX_LENGTH = 280;

    use WPML;

    /**
     * Returns the settings menu title.
     */
    protected function menu_title() {
        return __( 'Social Media Scheduler', 'kntnt-schedule-social-media' );
    }

    /**
     * Returns the settings page title.
     */
    protected function page_title() {
        return __( "Kntnt Social Media Scheduler with Zapier", 'kntnt-schedule-social-media' );
    }

    /**
     * Returns all fields used on the settings page.
     */
    protected function fields() {

        $this->init_lang();

        $fields[ $this->webhook_name( 'linkedin' ) ] = [
            'type' => 'url',
            'label' => __( "LinkedIn webhook", 'kntnt-schedule-social-media' ),
            'size' => 80,
            'description' => __( 'URL of the <strong>catch webhook</strong> of your LinkedIn zap.', 'kntnt-schedule-social-media' ),
        ];

        $fields["linkedin_length"] = [
            'type' => 'integer',
            'label' => __( "LinkedIn length", 'kntnt-schedule-social-media' ),
            'description' => sprintf( __( 'Max number of characters allowed in a LinkedIn post. Defaults to %s, which is max allowed.', 'kntnt-schedule-social-media' ), static::LINKEDIN_MAX_LENGTH ),
            'size' => 10,
            'min' => 0,
            'max' => static::LINKEDIN_MAX_LENGTH,
            'default' => static::LINKEDIN_MAX_LENGTH,
            'filter-before' => function ( $val ) { return static::LINKEDIN_MAX_LENGTH != $val ? $val : ''; },
            'filter-after' => function ( $val ) { return '' != $val ? $val : static::LINKEDIN_MAX_LENGTH; },
        ];

        $fields[ $this->webhook_name( 'facebook' ) ] = [
            'type' => 'url',
            'label' => __( "Facebook webhook", 'kntnt-schedule-social-media' ),
            'description' => __( 'URL of the <strong>catch webhook</strong> of your Facebook zap.', 'kntnt-schedule-social-media' ),
            'size' => 80,
        ];

        $fields["facebook_length"] = [
            'type' => 'integer',
            'label' => __( "Facebook length", 'kntnt-schedule-social-media' ),
            'description' => sprintf( __( 'Max number of characters allowed in a Facebook post. Defaults to %s, which is max allowed.', 'kntnt-schedule-social-media' ), static::FACEBOOK_MAX_LENGTH ),
            'size' => 10,
            'min' => 0,
            'max' => static::FACEBOOK_MAX_LENGTH,
            'default' => static::FACEBOOK_MAX_LENGTH,
            'filter-before' => function ( $val ) { return static::FACEBOOK_MAX_LENGTH != $val ? $val : ''; },
            'filter-after' => function ( $val ) { return '' != $val ? $val : static::FACEBOOK_MAX_LENGTH; },
        ];

        $fields[ $this->webhook_name( 'twitter' ) ] = [
            'type' => 'url',
            'label' => __( "Twitter webhook", 'kntnt-schedule-social-media' ),
            'description' => __( 'URL of the <strong>catch webhook</strong> of your Twitter zap.', 'kntnt-schedule-social-media' ),
            'size' => 80,
        ];

        $fields["twitter_length"] = [
            'type' => 'integer',
            'label' => __( "Twitter length", 'kntnt-schedule-social-media' ),
            'description' => sprintf( __( 'Max number of characters allowed in a Facebook post. Defaults to %s, which leaves 24 characters for space and t.co-link.', 'kntnt-schedule-social-media' ), static::LINKEDIN_MAX_LENGTH - 24 ),
            'size' => 10,
            'min' => 0,
            'max' => static::TWITTER_MAX_LENGTH,
            'default' => '',
            'filter-before' => function ( $val ) { return ( static::TWITTER_MAX_LENGTH - 24 ) != $val ? $val : ''; },
            'filter-after' => function ( $val ) { return '' != $val ? $val : ( static::TWITTER_MAX_LENGTH - 24 ); },
        ];

        $fields[ $this->webhook_name( 'email' ) ] = [
            'type' => 'url',
            'label' => __( "Email webhook", 'kntnt-schedule-social-media' ),
            'description' => __( 'URL of the <strong>catch webhook</strong> of your email zap.', 'kntnt-schedule-social-media' ),
            'size' => 80,
        ];

        $fields["email_length"] = [
            'type' => 'integer',
            'label' => __( "Email length", 'kntnt-schedule-social-media' ),
            'description' => __( 'Max number of characters allowed in an email. Defaults to unlimited.', 'kntnt-schedule-social-media' ),
            'size' => 10,
            'min' => 0,
            'default' => '',
            'filter-before' => function ( $val ) { return PHP_INT_MAX != $val ? $val : ''; },
            'filter-after' => function ( $val ) { return '' != $val ? $val : PHP_INT_MAX; },
        ];

        $fields['image_size'] = [
            'type' => 'select',
            'label' => __( "Image size", 'kntnt-schedule-social-media' ),
            'description' => __( 'Size of featured image.', 'kntnt-schedule-social-media' ),
            'options' => $this->image_sizes(),
            'default' => 'medium_large',
        ];

        $fields['default_image'] = [
            'type' => 'url',
            'label' => __( "Default image", 'kntnt-schedule-social-media' ),
            'description' => __( 'Url of image to show for posts with no featured image.', 'kntnt-schedule-social-media' ),
            'size' => 80,
        ];

        $fields['submit'] = [
            'type' => 'submit',
        ];

        return $fields;

    }

    private function image_sizes() {
        $image_sizes = [ '' => '' ];
        foreach ( Plugin::image_sizes() as $name => $size ) {
            $image_sizes[ $name ] = "$name (${size['width']}x${size['height']})";
        }
        return $image_sizes;
    }

}
