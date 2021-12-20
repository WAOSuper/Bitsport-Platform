<?php
if ( ! function_exists( "appway_add_metaboxes" ) ) {
	function appway_add_metaboxes( $metaboxes ) {
		$directories_array = array(
			'page.php',
			'projects.php',
			'service.php',
			'team.php',
			'testimonials.php',
			'event.php',
			'banner.php',
			'header.php',
			'footer.php',
			'sidebar.php',
			'menu.php',
			'post.php',
		);
		foreach ( $directories_array as $dir ) {
			$metaboxes[] = require_once( APPWAYPLUGIN_PLUGIN_PATH . '/metabox/' . $dir );
		}

		return $metaboxes;
	}

	add_action( "redux/metaboxes/appway_options/boxes", "appway_add_metaboxes" );
}

