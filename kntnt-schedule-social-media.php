<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Kntnt Schedule Social Media
 * Plugin URI:        https://github.com/kntnt/kntnt-schedule-social-media
 * GitHub Plugin URI: https://github.com/kntnt/kntnt-schedule-social-media
 * Description:       Allows authors of posts to schedule social media posts.
 * Version:           2.0.0
 * Author:            Thomas Barregren
 * Author URI:        https://www.kntnt.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       kntnt-schedule-social-media
 * Domain Path:       /languages
 */

namespace Kntnt\Schedule_Social_Media;

defined( 'WPINC' ) || die;

// To debug this plugin, set both WP_DEBUG and following constant to true.
// define( 'KNTNT_SCHEDULE_SOCIAL_MEDIA_DEBUG', true );

spl_autoload_register( function ( $class ) {
    $ns_len = strlen( __NAMESPACE__ );
    if ( 0 == substr_compare( $class, __NAMESPACE__, 0, $ns_len ) ) {
        require_once __DIR__ . '/classes/' . strtr( strtolower( substr( $class, $ns_len + 1 ) ), '_', '-' ) . '.php';
    }
} );

new Plugin();