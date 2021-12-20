<?php
return array(
	'title' => 'Appway Post Setting',
	'id' => 'appway_meta_post',
	'icon' => 'el el-cogs',
	'position' => 'normal',
	'priority' => 'core',
	'post_types' => array( 'post' ),
	'sections' => array(
		array(
			'id' => 'appway_post_meta_setting',
			'fields' => array(
				array(
					'id' => 'meta_image',
					'type' => 'media',
					'title' => esc_html__( 'Meta image', 'appway' ),
				),
				array(
					'id'    => 'subtitle',
					'type'  => 'text',
					'title' => esc_html__( 'Subtitle', 'appway' ),
				),

			),
		),
	),
);