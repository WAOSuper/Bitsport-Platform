<?php
/**
 * Theme config file.
 *
 * @package ThemeName
 * @author  AuthorName
 * @version 1.0
 * changed
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Restricted' );
}

$config = array();

$config['default']['appway_main_header'][] 	= array( 'appway_preloader', 98 );
$config['default']['appway_main_header'][] 	= array( 'appway_main_header_area', 99 );

$config['default']['appway_sidebar'][] 	    = array( 'appway_sidebar', 99 );

$config['default']['appway_banner'][] 	    = array( 'appway_banner', 99 );


return $config;
