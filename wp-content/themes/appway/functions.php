<?php

require_once get_template_directory() . '/includes/loader.php';

add_action( 'after_setup_theme', 'appway_setup_theme' );
add_action( 'after_setup_theme', 'appway_load_default_hooks' );


function appway_setup_theme() {

	load_theme_textdomain( 'appway', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-header' );
	add_theme_support( 'custom-background' );
    add_theme_support('woocommerce');
	add_theme_support('wc-product-gallery-lightbox');
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );


	// Set the default content width.
	$GLOBALS['content_width'] = 525;
	
	//Register image sizes
	add_image_size( 'appway_370x220', 370, 220, true ); //'appway_370x220 Our Services'
	add_image_size( 'appway_80x80', 80, 80, true ); //'appway_80x80 Our Testimonials'
	add_image_size( 'appway_140x100', 140, 100, true ); //'appway_140x100 Team Slider'
	add_image_size( 'appway_360x475', 360, 475, true ); //'appway_360x475 Team Slider'
	add_image_size( 'appway_370x240', 370, 240, true ); //'appway_370x240 Latest News'
	add_image_size( 'appway_370x420', 370, 420, true ); //'appway_370x420 Our Team'
	add_image_size( 'appway_85x95', 85, 95, true ); //'appway_85x95 service Block 2'
	add_image_size( 'appway_90x90', 890, 90, true ); //'appway_90x90 Widget'
	add_image_size( 'appway_1170x420', 1170, 450, true ); //'appway_1170x450 single'

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'main_menu' => esc_html__( 'Main Menu', 'appway' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'      => 250,
		'height'     => 250,
		'flex-width' => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style();
	add_action( 'admin_init', 'appway_admin_init', 2000000 );
}

/**
 * [appway_widgets_init]
 *
 * @param  array $data [description]
 *
 * @return [type]       [description]
 */
function appway_widgets_init() {

	global $wp_registered_sidebars;

	$theme_options = get_theme_mod( APPWAY_NAME . '_options-mods' );
$options = appway_WSH()->option();
    $allowed_html = wp_kses_allowed_html( 'post' );
	register_sidebar( array(
		'name'          => esc_html__( 'Default Sidebar', 'appway' ),
		'id'            => 'default-sidebar',
		'description'   => esc_html__( 'Widgets in this area will be shown on the right-hand side.', 'appway' ),
		'before_widget' => '<div id="%1$s" class="mrsidebar widget sidebar-widget single-sidebar %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="sidebar-title">',
		'after_title'   => '</h3>',
	) );
register_sidebar(array(
		'name' => esc_html__('Footer Widget', 'appway'),
		'id' => 'footer-sidebar',
		'description' => esc_html__('Widgets in this area will be shown in Footer Area.', 'appway'),
		'before_widget'=>'<div class="mrfooter footer-column  col-lg-3 col-md-12 col-sm-12"><div id="%1$s" class="single-footer-widget footer-widget %2$s">',
		'after_widget'=>'</div></div>',
		'before_title' => '<div class="title"><h3 class="widget-title"><span>',
		'after_title' => '</span><i></i></h3></div>'
	));
	register_sidebar(array(
	  'name' => esc_html__( 'Blog Listing', 'appway' ),
	  'id' => 'blog-sidebar',
	  'description' => esc_html__( 'Widgets in this area will be shown on the right-hand side.', 'appway' ),
	  'before_widget'=>'<div id="%1$s" class="widget sidebar-widget single-sidebar %2$s">',
	  'after_widget'=>'</div>',
	  'before_title' => '<h3 class="sidebar-title">',
	  'after_title' => '</h3>'
	));
	if ( ! is_object( appway_WSH() ) ) {
		return;
	}

	$sidebars = appway_set( $theme_options, 'custom_sidebar_name' );

	foreach ( array_filter( (array) $sidebars ) as $sidebar ) {

		if ( appway_set( $sidebar, 'topcopy' ) ) {
			continue;
		}

		$name = $sidebar;
		if ( ! $name ) {
			continue;
		}
		$slug = str_replace( ' ', '_', $name );

		register_sidebar( array(
			'name'          => $name,
			'id'            => sanitize_title( $slug ),
			'before_widget' => '<div id="%1$s" class="%2$s widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widget-title"><h4>',
			'after_title'   => '</h4></div>',
		) );
	}

	update_option( 'wp_registered_sidebars', $wp_registered_sidebars );
}

add_action( 'widgets_init', 'appway_widgets_init' );

/**
 * [appway_admin_init]
 *
 * @param  array $data [description]
 *
 * @return [type]       [description]
 */


function appway_admin_init() {
	remove_action( 'admin_notices', array( 'ReduxFramework', '_admin_notices' ), 99 );
}

/**
 * [appway_set description]
 *
 * @param  array $data [description]
 *
 * @return [type]       [description]
 */
if ( ! function_exists( 'appway_set' ) ) {
	function appway_set( $var, $key, $def = '' ) {
		//if( ! $var ) return false;

		if ( is_object( $var ) && isset( $var->$key ) ) {
			return $var->$key;
		} elseif ( is_array( $var ) && isset( $var[ $key ] ) ) {
			return $var[ $key ];
		} elseif ( $def ) {
			return $def;
		} else {
			return false;
		}
	}
}




/**
 * product per page
 */
add_filter( 'loop_shop_per_page', 'appway_loop_shop_per_page', 20 );

function appway_loop_shop_per_page( $cols ) {
		$options     = appway_WSH()->option();		
		$shop_product = esc_attr( $options->get( 'shop_product') );	
		
  // $cols contains the current number of products per page based on the value stored on Options –> Reading
  // Return the number of products you wanna show per page.
  $cols =  $shop_product;
  return $cols;
}


