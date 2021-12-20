<?php


defined( 'APPWAY_NAME' ) or define( 'APPWAY_NAME', 'appway' );

define( 'APPWAY_ROOT', get_template_directory() . '/' );

require_once get_template_directory() . '/includes/functions/functions.php';
include_once get_template_directory() . '/includes/classes/base.php';
include_once get_template_directory() . '/includes/classes/dotnotation.php';
include_once get_template_directory() . '/includes/classes/header-enqueue.php';
include_once get_template_directory() . '/includes/classes/options.php';
include_once get_template_directory() . '/includes/classes/ajax.php';
include_once get_template_directory() . '/includes/classes/common.php';
include_once get_template_directory() . '/includes/classes/bootstrap_walker.php';
include_once get_template_directory() . '/includes/library/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/includes/library/hook.php';

// Merlin demo import.
require_once get_template_directory() . '/demo-import/class-merlin.php';
require_once get_template_directory() . '/demo-import/merlin-config.php';
require_once get_template_directory() . '/demo-import/merlin-filters.php';

add_action( 'after_setup_theme', 'appway_wp_load', 5 );

function appway_wp_load() {

	defined( 'APPWAY_URL' ) or define( 'APPWAY_URL', get_template_directory_uri() . '/' );
	define(  'APPWAY_KEY','!@#appway');
	define(  'APPWAY_URI', get_template_directory_uri() . '/');

	if ( ! defined( 'APPWAY_NONCE' ) ) {
		define( 'APPWAY_NONCE', 'appway_wp_theme' );
	}

	( new \APPWAY\Includes\Classes\Base )->loadDefaults();
	( new \APPWAY\Includes\Classes\Ajax )->actions();

}
