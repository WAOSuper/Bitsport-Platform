<?php
return array(
	'title'      => 'Appway Service Setting',
	'id'         => 'appway_meta_service',
	'icon'       => 'el el-cogs',
	'position'   => 'normal',
	'priority'   => 'core',
	'post_types' => array( 'appway_service' ),
	'sections'   => array(
		array(
			'id'     => 'appway_service_meta_setting',
			'fields' => array(
				array(
					'id'       => 'service_icon',
					'type'     => 'select',
					'title'    => esc_html__( 'Service Icons', 'appway' ),
					'options'  => get_fontawesome_icons(),
				),
				array(
					'id'    => 'ext_url',
					'type'  => 'text',
					'title' => esc_html__( 'Enter Read More Link', 'appway' ),
				),
			),
		),
	),
);