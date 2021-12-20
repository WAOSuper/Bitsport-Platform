<?php

return array(
	'id'     => 'appway_footer_settings',
	'title'  => esc_html__( "Appway Footer Settings", "konia" ),
	'fields' => array(
		array(
			'id'      => 'footer_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Footer Source Type', 'appway' ),
			'options' => array(
				'd'    => esc_html__( 'Default', 'appway' ),
				'e'    => esc_html__( 'Elementor', 'appway' ),
				'none' => esc_html__( 'Off', 'appway' ),
			),
			'default' => '',
		),
		array(
			'id'       => 'footer_elementor_template',
			'type'     => 'select',
			'title'    => __( 'Template', 'viral-buzz' ),
			'data'     => 'posts',
			'args'     => [
				'post_type' => [ 'elementor_library' ],
				'posts_per_page'=> -1,
			],
			'required' => [ 'footer_source_type', '=', 'e' ],
		),
		array(
			'id'       => 'footer_style_settings',
			'type'     => 'image_select',
			'title'    => esc_html__( 'Choose Footer Styles', 'appway' ),
			'options'  => array(
				'header_v1' => array(
					'alt' => 'Footer Style 1',
					'img' => get_template_directory_uri() . '/assets/images/redux/footer/f1.png',
				),
			/*	
				'header_v2' => array(
					'alt' => 'Footer Style 2',
					'img' => get_template_directory_uri() . '/assets/images/redux/footer/f2.png',
				),
				'header_v3' => array(
					'alt' => 'Footer Style 3',
					'img' => get_template_directory_uri() . '/assets/images/redux/footer/f3.png',
				),
				*/
			),
			'required' => array( array( 'footer_source_type', 'equals', 'd' ) ),
		),
	),
);