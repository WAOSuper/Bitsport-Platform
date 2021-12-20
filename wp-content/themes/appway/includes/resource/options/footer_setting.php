<?php

//search  999
/*======Pre Define Area Atart=====*/
$footer_source_type = array(
			'id'      => 'footer_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Footer Source Type', 'appway' ),
			'options' => array(
				'd' => esc_html__( 'Default', 'appway' ),
				'e' => esc_html__( 'Elementor', 'appway' ),
			),
			'default' => 'd',
		);		
$footer_elementor_template = array(
			'id'       => 'footer_elementor_template',
			'type'     => 'select',
			'title'    => __( 'Template', 'appway' ),
			'data'     => 'posts',
			'args'     => [
				'post_type' => [ 'elementor_library' ],
				'posts_per_page'	=> -1
			],
			'required' => [ 'footer_source_type', '=', 'e' ],
		);

$footer_default_st=array(
			'id'       => 'footer_default_st',
			'type'     => 'section',
			'title'    => esc_html__( 'Footer Default', 'appway' ),
			'indent'   => true,
			'required' => [ 'footer_source_type', '=', 'd' ],
		);

/*----Do Not Edit Above---*/		
$footer_background=array(
			'id'      => 'footer_background',
			'type'    => 'media',
			'title'   => esc_html__( 'Footer Background', 'appway' ),
			'default' => array( 'url' => APPWAY_URI . 'assets/images/parallax.png' ),
		);
$footer_social_share=array(
			'id'    => 'footer_social_share',
			'type'  => 'social_media',
			'title' => esc_html__( 'Social Profiles', 'appway' ),
		);

$footer_subarea= array(
			'id'      => 'footer_subarea',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Subscribe Area', 'appway' ),
			'desc'    => esc_html__( 'Enable to Show Subscribe', 'appway' ),
			'default' => true,
		);
$footer_area= array(
			'id'      => 'footer_area',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Footer Area', 'appway' ),
			'desc'    => esc_html__( 'Enable to Footer Area', 'appway' ),
			'default' => true,
		);
$footer_shape= array(
			'id'      => 'footer_shape',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Shape', 'appway' ),
			'desc'    => esc_html__( 'Enable to Shape', 'appway' ),
			'default' => true,
		);		
		
$copyright_area= array(
			'id'      => 'copyright_area',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Footer Copyright Area', 'appway' ),
			'desc'    => esc_html__( 'Enable to Copyright Area', 'appway' ),
			'default' => true,
		);		
$footer_sbcid= array(
			'id'      => 'footer_sbcid',
			'type'    => 'textarea',
			'title'   => __( 'Subscribe ID', 'appway' ),
			'desc'    => esc_html__( 'Enter Subscribe ID', 'appway' ),
		);	
$footer_subtitle= array(
			'id'      => 'footer_subtitle',
			'type'    => 'textarea',
			'title'   => __( 'Footer Subtitle', 'appway' ),
			'desc'    => esc_html__( 'Enter Footer Subtitle', 'appway' ),
		);	
$footer_title= array(
			'id'      => 'footer_title',
			'type'    => 'textarea',
			'title'   => __( 'Footer Title', 'appway' ),
			'desc'    => esc_html__( 'Enter Footer Title', 'appway' ),
		);
$footer_text= array(
			'id'      => 'footer_text',
			'type'    => 'textarea',
			'title'   => __( 'Footer Text', 'appway' ),
			'desc'    => esc_html__( 'Enter Footer Text', 'appway' ),
		);
$footer_bttn= array(
			'id'      => 'footer_bttn',
			'type'    => 'textarea',
			'title'   => __( 'Footer Button', 'appway' ),
			'desc'    => esc_html__( 'Enter Footer Button', 'appway' ),
		);
$footer_sbcrbttn= array(
			'id'      => 'footer_sbcrbttn',
			'type'    => 'textarea',
			'title'   => __( 'Subscribe Button', 'appway' ),
			'desc'    => esc_html__( 'Enter Subscribe Button', 'appway' ),
		);		
		
$copyright_text= array(
			'id'      => 'copyright_text',
			'type'    => 'textarea',
			'title'   => __( 'Copyright Text', 'appway' ),
			'desc'    => esc_html__( 'Enter the Copyright Text', 'appway' ),
			'default' => '',
		);

$footer_js=array(
			'id'       => 'footer_js',
			'type'     => 'ace_editor',
			'title'    => esc_html__( 'Footer Javascript', 'appway' ),
			'subtitle' => esc_html__( 'Enter javascript code to add in page footer section', 'appway' ),
			'mode'     => 'javascript',
			'theme'    => 'monokai',
		);
$footer_default_ed = array(
			'id'       => 'footer_default_ed',
			'type'     => 'section',
			'indent'   => false,
			'required' => [ 'footer_source_type', '=', 'd' ],
		);
/*======Pre Define Area End=====  999 */
return array(
	'title'      => esc_html__( 'Footer Setting', 'appway' ),
	'id'         => 'footer_setting',
	'desc'       => '',
	'subsection' => false,
	'fields'     => array(
		
		$footer_source_type,
		$footer_elementor_template,
		$footer_default_st,
		
		array(
		    'id'       => 'footer_column_settings',
		    'type'     => 'image_select',
		    'title'    => esc_html__( 'Choose Footer Culumn', 'appway' ),
		    'subtitle' => esc_html__( 'Choose Number Footer Culumn', 'appway' ),
		    'options'  => array(

			    '6'  => array(
				    'alt' => esc_html__( 'Two Column', 'appway' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/02col.png',
			    ),
			    '4'  => array(
				    'alt' => esc_html__( 'Three Column', 'appway' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/03col.png',
			    ),
				'3'  => array(
				    'alt' => esc_html__( 'Four Column', 'appway' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/04col.png',
			    ),
				
				'2'  => array(
				    'alt' => esc_html__( 'Six Column', 'appway' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/06col.png',
			    ),
			
		
			),
			'required' => array( 'header_source_type', '=', 'd' ),
			'default' => 'header_v1',
	    ),	
		
		//Edit Bellow Array
		$footer_area,
		
	//$footer_background,
		$footer_shape,
		//$footer_subarea,
		//$footer_sbcid,
		//$footer_sbcrbttn,
		//$footer_subtitle,
		//$footer_title,
		//$footer_text,
		//$footer_bttn,
		//$footer_social_share,
		$copyright_area,
		$copyright_text,
		$footer_js,
		$footer_default_ed,
	),
);
