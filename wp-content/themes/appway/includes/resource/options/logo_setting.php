<?php
return array(
	'title'      => esc_html__( 'Logo Setting', 'appway' ),
	'id'         => 'logo_setting',
	'desc'       => '',
	'subsection' => false,
	'fields'     => array(
		array(
			'id'       => 'image_favicon',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Favicon', 'appway' ),
			'subtitle' => esc_html__( 'Insert site favicon image', 'appway' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/favicon.png' ),
			//'required' => array( array( 'logo_type', 'equals', 'image' ) ),
		),
		
	// ===Classic Logo Area====		
		array(
            'id' => 'normal_logo_show',
            'type' => 'switch',
            'title' => esc_html__('Enable Normal Logo', 'appway'),
            'default' => true,
        ),
		array(
			'id'       => 'image_normal_logo',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Normal Logo', 'appway' ),
			'subtitle' => esc_html__( 'Insert site normal logo image', 'appway' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/logo-3.png' ),
			'required' => array( 'normal_logo_show', '=', true ),
		),
		array(
			'id'       => 'normal_logo_dimension',
			'type'     => 'dimensions',
			'title'    => esc_html__( 'Normal Logo Dimentions', 'appway' ),
			'subtitle' => esc_html__( 'Select Logo Dimentions', 'appway' ),
			'units'    => array( 'em', 'px', '%' ),
			'default'  => array( 'Width' => '', 'Height' => '' ),
			'required' => array( 'normal_logo_show', '=', true ),
		),
	// === Small Logo Area====		
		array(
            'id' => 'small_logo_show',
            'type' => 'switch',
            'title' => esc_html__('Enable Small Logo', 'appway'),
            'default' => true,
        ),
		array(
			'id'       => 'image_small_logo',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Small Logo', 'appway' ),
			'subtitle' => esc_html__( 'Insert site normal logo image', 'appway' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/logo.png' ),
			'required' => array( 'small_logo_show', '=', true ),
		),
		array(
			'id'       => 'small_logo_dimension',
			'type'     => 'dimensions',
			'title'    => esc_html__( 'Small Logo Dimentions', 'appway' ),
			'subtitle' => esc_html__( 'Select Logo Dimentions', 'appway' ),
			'units'    => array( 'em', 'px', '%' ),
			'default'  => array( 'Width' => '', 'Height' => '' ),
			'required' => array( 'small_logo_show', '=', true ),
		),
	// ===2nd Logo Area====	
		array(
            'id' => 'two_logo_show',
            'type' => 'switch',
            'title' => esc_html__('Enable 2nd Logo', 'appway'),
            'default' => true,
        ),
		array(
			'id'       => 'image_two_logo',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( '2nd Logo', 'appway' ),
			'subtitle' => esc_html__( 'Insert site 2nd Logo logo image', 'appway' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/logo-3.png' ),
			'required' => array( 'two_logo_show', '=', true ),
		),
		array(
			'id'       => 'two_logo_dimension',
			'type'     => 'dimensions',
			'title'    => esc_html__( '2nd Logo Dimentions', 'appway' ),
			'subtitle' => esc_html__( 'Select Logo Dimentions', 'appway' ),
			'units'    => array( 'em', 'px', '%' ),
			'default'  => array( 'Width' => '', 'Height' => '' ),
			'required' => array( 'two_logo_show', '=', true ),
		),
		
	 // ===3rd Logo Area====	
		array(
            'id' => 'three_logo_show',
            'type' => 'switch',
            'title' => esc_html__('Enable 3rd Logo', 'appway'),
            'default' => true,
        ),
		array(
			'id'       => 'image_three_logo',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( '3rd Logo', 'appway' ),
			'subtitle' => esc_html__( 'Insert site 3rd Logo logo image', 'appway' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/logo3.png' ),
			'required' => array( 'three_logo_show', '=', true ),
		),
		array(
			'id'       => 'three_logo_dimension',
			'type'     => 'dimensions',
			'title'    => esc_html__( '3rd Logo Dimentions', 'appway' ),
			'subtitle' => esc_html__( 'Select Logo Dimentions', 'appway' ),
			'units'    => array( 'em', 'px', '%' ),
			'default'  => array( 'Width' => '', 'Height' => '' ),
			'required' => array( 'three_logo_show', '=', true ),
		),
		
		
	// ===Footer Logo Area====	
		array(
            'id' => 'footer_logo_show',
            'type' => 'switch',
            'title' => esc_html__('Enable Footer Logo', 'appway'),
            'default' => true,
        ),
		array(
			'id'       => 'image_footer_logo',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Footer Logo', 'appway' ),
			'subtitle' => esc_html__( 'Insert site normal logo image', 'appway' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/logo.png' ),
			'required' => array( 'footer_logo_show', '=', true ),
		),
		array(
			'id'       => 'footer_logo_dimension',
			'type'     => 'dimensions',
			'title'    => esc_html__( 'Footer Logo Dimentions', 'appway' ),
			'subtitle' => esc_html__( 'Select Logo Dimentions', 'appway' ),
			'units'    => array( 'em', 'px', '%' ),
			'default'  => array( 'Width' => '', 'Height' => '' ),
			'required' => array( 'footer_logo_show', '=', true ),
		),
		
		array(
			'id'       => 'logo_settings_section_end',
			'type'     => 'section',
			'indent'      => false,
			//'required' => [ 'header_source_type', '=', 'd' ],
		),
	),
);
