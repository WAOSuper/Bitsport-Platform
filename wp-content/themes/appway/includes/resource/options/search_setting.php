<?php

return  array(
    'title'      => esc_html__( 'Search Page Settings', 'appway' ),
    'id'         => 'search_setting',
    'desc'       => '', 
    'subsection' => true,
    'fields'     => array(
	    array(
		    'id'      => 'search_source_type',
		    'type'    => 'button_set',
		    'title'   => esc_html__( 'Search Source Type', 'appway' ),
		    'options' => array(
			    'd' => esc_html__( 'Default', 'appway' ),
			    'e' => esc_html__( 'Elementor', 'appway' ),
		    ),
		    'default' => 'd',
	    ),
	    array(
		    'id'       => 'search_elementor_template',
		    'type'     => 'select',
		    'title'    => __( 'Template', 'appway' ),
		    'data'     => 'posts',
		    'args'     => [
			    'post_type' => [ 'elementor_library' ],
				'posts_per_page'=> -1,
		    ],
		    'required' => [ 'search_source_type', '=', 'e' ],
	    ),

	    array(
		    'id'       => 'search_default_st',
		    'type'     => 'section',
		    'title'    => esc_html__( 'Search Default', 'appway' ),
		    'indent'   => true,
		    'required' => [ 'search_source_type', '=', 'd' ],
	    ),
	    array(
		    'id'      => 'search_page_banner',
		    'type'    => 'switch',
		    'title'   => esc_html__( 'Show Banner', 'appway' ),
		    'desc'    => esc_html__( 'Enable to show banner on blog', 'appway' ),
		    'default' => true,
	    ),
	    array(
		    'id'       => 'search_banner_title',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Banner Section Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter the title to show in banner section', 'appway' ),
		    'required' => array( 'search_page_banner', '=', true ),
	    ),
	    array(
		    'id'       => 'search_page_breadcrumb',
		    'type'     => 'raw',
		    'content'  => "<div style='background-color:#c33328;color:white;padding:20px;'>" . esc_html__( 'Use Yoast SEO plugin for breadcrumb.', 'appway' ) . "</div>",
		    'required' => array( 'search_page_banner', '=', true ),
	    ),
	    array(
		    'id'       => 'search_page_background',
		    'type'     => 'media',
		    'url'      => true,
		    'title'    => esc_html__( 'Background Image', 'appway' ),
		    'desc'     => esc_html__( 'Insert background image for banner', 'appway' ),
		    'default'  => array(
			    'url' => APPWAY_URI . 'assets/images/pagetitle.jpg',
		    ),
		    'required' => array( 'search_page_banner', '=', true ),
	    ),

	    array(
		    'id'       => 'search_sidebar_layout',
		    'type'     => 'image_select',
		    'title'    => esc_html__( 'Layout', 'appway' ),
		    'subtitle' => esc_html__( 'Select main content and sidebar alignment.', 'appway' ),
		    'options'  => array(

			    'left'  => array(
				    'alt' => esc_html__( '2 Column Left', 'appway' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/2cl.png',
			    ),
			    'full'  => array(
				    'alt' => esc_html__( '1 Column', 'appway' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/1col.png',
			    ),
			    'right' => array(
				    'alt' => esc_html__( '2 Column Right', 'appway' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/2cr.png',
			    ),
		    ),

		    'default' => 'right',
	    ),

	    array(
		    'id'       => 'search_page_sidebar',
		    'type'     => 'select',
		    'title'    => esc_html__( 'Sidebar', 'appway' ),
		    'desc'     => esc_html__( 'Select sidebar to show at blog listing page', 'appway' ),
		    'required' => array(
			    array( 'search_sidebar_layout', '=', array( 'left', 'right' ) ),
		    ),
		    'options'  => appway_get_sidebars(),
	    ),
	    array(
		    'id'      => 'search_post_comments',
		    'type'    => 'switch',
		    'title'   => esc_html__( 'Show Post Comments', 'appway' ),
		    'desc'    => esc_html__( 'Enable to show post comments on posts listing', 'appway' ),
		    'default' => true,
	    ),

	    array(
		    'id'      => 'search_post_author',
		    'type'    => 'switch',
		    'title'   => esc_html__( 'Show Author', 'appway' ),
		    'desc'    => esc_html__( 'Enable to show author on posts listing', 'appway' ),
		    'default' => true,
	    ),
	    array(
		    'id'      => 'search_post_date',
		    'type'    => 'switch',
		    'title'   => esc_html__( 'Show Post Date', 'appway' ),
		    'desc'    => esc_html__( 'Enable to show post data on posts listing', 'appway' ),
		    'default' => true,
	    ),
		//
		array(
			'id'    => 'search-page_title',
			'type'  => 'text',
			'title' => esc_html__( 'Search Title', 'appway' ),
			'desc'  => esc_html__( 'Enter Search section title that you want to show', 'appway' ),

		),
		array(
			'id'    => 'search-page-text',
			'type'  => 'textarea',
			'title' => esc_html__( 'Search Page Description', 'appway' ),
			'desc'  => esc_html__( 'Enter Search page description that you want to show.', 'appway' ),

		),
		array(
			'id'    => 'search_page_form',
			'type'  => 'switch',
			'title' => esc_html__( 'Show Search Form', 'appway' ),
			'desc'  => esc_html__( 'Enable to show search form on 404 page', 'appway' ),
			'default'  => true,
		),
		array(
			'id'    => 'search_back_home_btn',
			'type'  => 'switch',
			'title' => esc_html__( 'Show Button', 'appway' ),
			'desc'  => esc_html__( 'Enable to show back to home button.', 'appway' ),
			'default'  => true,
		),
		array(
			'id'       => 'search_back_home_btn_label',
			'type'     => 'text',
			'title'    => esc_html__( 'Button Label', 'appway' ),
			'desc'     => esc_html__( 'Enter back to home button label that you want to show.', 'appway' ),
			'default'  => esc_html__( 'Back To Home Page', 'appway' ),
			'required' => array( 'search_back_home_btn', '=', true ),
		),
		
		
		array(
			'id'       => 'search_image',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Search Image', 'appway' ),
			'desc'     => esc_html__( 'Insert Search Image image for banner', 'appway' ),
			'default'  => array(
				'url' => APPWAY_URI . 'assets/images/search.png',
			),
		),
		
	    array(
		    'id'       => 'search_default_ed',
		    'type'     => 'section',
		    'indent'   => false,
		    'required' => [ 'search_source_type', '=', 'd' ],
	    ),

    ),
);





