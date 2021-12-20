<?php
return array(
	'title'      => 'Appway Setting',
	'id'         => 'appway_meta',
	'icon'       => 'el el-cogs',
	'position'   => 'normal',
	'priority'   => 'core',
	'post_types' => array( 'page', 'post' ),
	'sections'   => array(
		require_once APPWAYPLUGIN_PLUGIN_PATH . '/metabox/header.php',
		require_once APPWAYPLUGIN_PLUGIN_PATH . '/metabox/banner.php',
		require_once APPWAYPLUGIN_PLUGIN_PATH . '/metabox/sidebar.php',
		require_once APPWAYPLUGIN_PLUGIN_PATH . '/metabox/footer.php',
	),
);