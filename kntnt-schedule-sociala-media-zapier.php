<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Kntnt Schedule Sociala Media with Zapier
 * Plugin URI:        https://github.com/kntnt/kntnt-schedule-sociala-media-zapier
 * GitHub Plugin URI: https://github.com/kntnt/kntnt-schedule-sociala-media-zapier
 * Description:       Provides ACF fields for scheduling webhooks that push social media posts to Zapier.
 * Version:           1.0.1
 * Author:            Thomas Barregren
 * Author URI:        https://www.kntnt.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       kntnt-schedule-sociala-media-zapier
 * Domain Path:       /languages
 */

namespace Kntnt\Schedule_Sociala_Media_Zapier;

defined( 'WPINC' ) || die;

// Define WP_DEBUG as TRUE and uncomment next line to debug this plugin.
// define( 'KNTNT_SCHEDULE_SOCIALA_MEDIA_ZAPIER', true );

spl_autoload_register( function ( $class ) {
	$ns_len = strlen( __NAMESPACE__ );
	if ( 0 == substr_compare( $class, __NAMESPACE__, 0, $ns_len ) ) {
		require_once __DIR__ . '/classes/' . strtr( strtolower( substr( $class, $ns_len + 1 ) ), '_', '-' ) . '.php';
	}
} );

new Plugin();
