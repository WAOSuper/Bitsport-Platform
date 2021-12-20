<?php

return array(
	'id'     => 'appway_header_settings',
	'title'  => esc_html__( "Appway Header Settings", "konia" ),
	'fields' => array(
		array(
			'id'      => 'header_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Header Source Type', 'appway' ),
			'options' => array(
				'd' => esc_html__( 'Default', 'appway' ),
				'e' => esc_html__( 'Elementor', 'appway' ),
			),
			'default'=> '',
		),
		array(
			'id'       => 'header_new_elementor_template',
			'type'     => 'select',
			'title'    => __( 'Template', 'appway-plugin' ),
			'data'     => 'posts',
			'args'     => [
				'post_type' => [ 'elementor_library' ],
				'posts_per_page' => -1,
				'orderby'  => 'title',
				'order'     => 'DESC'
			],
			'required' => [ 'header_source_type', '=', 'e' ],
		),
		array(
			'id'       => 'header_style_settings',
			'type'     => 'image_select',
			'title'    => esc_html__( 'Choose Header Styles', 'appway' ),
			'options'  => array(
				'header_v1' => array(
					'alt' => 'Header Style 1',
					'img' => get_template_directory_uri() . '/assets/images/redux/header/header1.png',
				),
				'header_v2' => array(
					'alt' => 'Header Style 2',
					'img' => get_template_directory_uri() . '/assets/images/redux/header/header2.png',
				),
				'header_v3' => array(
					'alt' => 'Header Style 3',
					'img' => get_template_directory_uri() . '/assets/images/redux/header/header3.png',
				),
				'header_v4' => array(
					'alt' => 'Header Style 4',
					'img' => get_template_directory_uri() . '/assets/images/redux/header/header4.png',
				),
				'header_v5' => array(
					'alt' => 'Header Style 5',
					'img' => get_template_directory_uri() . '/assets/images/redux/header/header5.png',
				),
				'header_v6' => array(
					'alt' => 'Header Style 6',
					'img' => get_template_directory_uri() . '/assets/images/redux/header/header6.png',
				),
			),
			'required' => array( array( 'header_source_type', 'equals', 'd' ) ),
		),
	),
);