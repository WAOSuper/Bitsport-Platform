<?php
return array(
	'title'      => 'Appway Project Setting',
	'id'         => 'appway_meta_projects',
	'icon'       => 'el el-cogs',
	'position'   => 'normal',
	'priority'   => 'core',
	'post_types' => array( 'appway_project' ),
	'sections'   => array(
		array(
			'id'     => 'appway_projects_meta_setting',
			'fields' => array(
				array(
					'id'    => 'meta_subtitle',
					'type'  => 'text',
					'title' => esc_html__( 'Sub Title', 'appway' ),
				),
				array(
					'id'    => 'page_link',
					'type'  => 'text',
					'title' => esc_html__( 'Page Link', 'appway' ),
				),
			),
		),
	),
);