<?php

return array(
	'title'      => esc_html__( 'Tag Page Settings', 'appway' ),
	'id'         => 'tag_setting',
	'desc'       => '',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => 'tag_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Tag Source Type', 'appway' ),
			'options' => array(
				'd' => esc_html__( 'Default', 'appway' ),
				'e' => esc_html__( 'Elementor', 'appway' ),
			),
			'default' => 'd',
		),
		array(
			'id'       => 'tag_elementor_template',
			'type'     => 'select',
			'title'    => __( 'Template', 'appway' ),
			'data'     => 'posts',
			'args'     => [
				'post_type' => [ 'elementor_library' ],
				'posts_per_page'=> -1,
			],
			'required' => [ 'tag_source_type', '=', 'e' ],
		),

		array(
			'id'       => 'tag_default_st',
			'type'     => 'section',
			'title'    => esc_html__( 'Tag Default', 'appway' ),
			'indent'   => true,
			'required' => [ 'tag_source_type', '=', 'd' ],
		),
		array(
			'id'      => 'tag_page_banner',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Banner', 'appway' ),
			'desc'    => esc_html__( 'Enable to show banner on blog', 'appway' ),
			'default' => true,
		),
		array(
			'id'       => 'tag_banner_title',
			'type'     => 'text',
			'title'    => esc_html__( 'Banner Section Title', 'appway' ),
			'desc'     => esc_html__( 'Enter the title to show in banner section', 'appway' ),
			'required' => array( 'tag_page_banner', '=', true ),
		),
		array(
			'id'       => 'tag_page_breadcrumb',
			'type'     => 'raw',
			'content'  => "<div style='background-color:#c33328;color:white;padding:20px;'>" . esc_html__( 'Use Yoast SEO plugin for breadcrumb.', 'appway' ) . "</div>",
			'required' => array( 'tag_page_banner', '=', true ),
		),
		array(
			'id'       => 'tag_page_background',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Background Image', 'appway' ),
			'desc'     => esc_html__( 'Insert background image for banner', 'appway' ),
			'default'  => array(
				'url' => APPWAY_URI . 'assets/images/pagetitle.jpg',
			),
			'required' => array( 'tag_page_banner', '=', true ),
		),

		array(
			'id'       => 'tag_sidebar_layout',
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
			'id'       => 'tag_page_sidebar',
			'type'     => 'select',
			'title'    => esc_html__( 'Sidebar', 'appway' ),
			'desc'     => esc_html__( 'Select sidebar to show at blog listing page', 'appway' ),
			'required' => array(
				array( 'tag_sidebar_layout', '=', array( 'left', 'right' ) ),
			),
			'options'  => appway_get_sidebars(),
		),
		array(
			'id'      => 'tag_post_comments',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Post Comments', 'appway' ),
			'desc'    => esc_html__( 'Enable to show post comments on posts listing', 'appway' ),
			'default' => true,
		),

		array(
			'id'      => 'tag_post_author',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Author', 'appway' ),
			'desc'    => esc_html__( 'Enable to show author on posts listing', 'appway' ),
			'default' => true,
		),
		array(
			'id'      => 'tag_post_date',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Post Date', 'appway' ),
			'desc'    => esc_html__( 'Enable to show post data on posts listing', 'appway' ),
			'default' => true,
		),
		array(
			'id'       => 'tag_default_ed',
			'type'     => 'section',
			'indent'   => false,
			'required' => [ 'tag_source_type', '=', 'd' ],
		),
	),
);





