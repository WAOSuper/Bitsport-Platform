<?php

namespace APPWAY\Includes\Classes;


/**
 * Header and Enqueue class
 */
class Header_Enqueue {


	public static function init() {
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue' ) );

		add_filter( 'wp_resource_hints', array( __CLASS__, 'resource_hints' ), 10, 2 );
	}

	/**
	 * Gets the arrays from method scripts and styles and process them to load.
	 * Styles are being loaded by default while scripts only enqueue and can be loaded where required.
	 *
	 * @return void This function returns nothing.
	 */
	public static function enqueue() {

		self::scripts();

		self::styles();

	}

	/**
	 * The major scripts loader to load all the scripts of the theme. Developer can hookup own scripts.
	 * All the scripts are being load in footer.
	 *
	 * @return array Returns the array of scripts to load
	 */
	public static function scripts() {
		$options = get_theme_mod( APPWAY_NAME . '_options-mods' );
		$ssl     = is_ssl() ? 'https' : 'http';

		$scripts = array(
			'appear' => 'assets/js/appear.js',
			'popover' => 'assets/js/popover.js',
			'bootstrap' => 'assets/js/bootstrap.min.js',
			'bxslider' => 'assets/js/bxslider.js',
			'circle-progress' => 'assets/js/circle-progress.js',
			'countdown' => 'assets/js/countdown.js',
			'isotope' => 'assets/js/isotope.js',
			'countTo' => 'assets/js/jquery.countTo.js',
			'fancybox' => 'assets/js/jquery.fancybox.js',
			'paroller' => 'assets/js/jquery.paroller.min.js',
			'jquery-ui' => 'assets/js/jquery-ui.js',
			'nav-tool' => 'assets/js/nav-tool.js',
			'owl' => 'assets/js/owl.js',
			'popper' => 'assets/js/popper.min.js',
			'scrollbar' => 'assets/js/scrollbar.js',
			'tilt' => 'assets/js/tilt.jquery.min.js',
			'validation' => 'assets/js/validation.js',
			'html5lightbox' => 'assets/js/html5lightbox/html5lightbox.js',
			'wow' => 'assets/js/wow.js',
			'themepanel' => 'assets/js/themepanel.js',
			//'nav-tool' => 'assets/js/nav-tool.js',
			
			'jquery-cookie' => 'assets/js/jquery.cookie.js',
			'main-script' => 'assets/js/script.js',
		);

		$scripts = apply_filters( 'APPWAY/includes/classes/header_enqueue/scripts', $scripts );
		/**
		 * Enqueue the scripts
		 *
		 * @var array
		 */
		foreach ( $scripts as $name => $js ) {

			if ( strstr( $js, 'http' ) || strstr( $js, 'https' ) || strstr( $js, 'googleapis.com' ) ) {

				wp_register_script( "{$name}", $js, '', '', true );
			} else {
				wp_register_script( "{$name}", get_template_directory_uri() . '/' . $js, '', '', true );
			}
		}

		wp_enqueue_script( array(
			'appear',
			'popover',
			'bootstrap',
			'bxslider',
			'circle-progress',
			'countdown',
			'isotope',
			'countTo',
			'fancybox',
			'paroller',
			'jquery-ui',
			'nav-tool',
			'owl',
			'popper',
			'scrollbar',
			'tilt',
			'validation',
			'html5lightbox',
			'wow',
			'themepanel',
			//'nav-tool',
			'jquery-cookie',
			'main-script',
		) );


		$header_data = array(
			'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
			'nonce'   => wp_create_nonce( APPWAY_NONCE ),
		);

		wp_localize_script( 'jquery', 'appway_data', $header_data );

		if ( appway_set( $options, 'footer_js' ) ) {

			wp_add_inline_script( 'jquery', appway_set( $options, 'footer_js' ) );
		}

	}

	/**
	 * The major styles loader to load all the styles of the theme. Developer can hookup own styles.
	 * All the styles are being load in head.
	 *
	 * @return array Returns the array of styles to load
	 */
	public static function styles() {
		
		 $options = appway_WSH()->option();		
		 $maincolor = esc_attr( $options->get( 'theme_color_scheme') );		
	     $maincolor = str_replace( '#', '' , $maincolor );	
		 wp_enqueue_style( 'main-color', get_template_directory_uri() . '/assets/css/color.php?main_color='.$maincolor );
		
		
		$styles = array(
			'google-fonts'      => self::fonts_url(),
			'animate'      => 'assets/css/animate.css',
			'bootstrap'      => 'assets/css/bootstrap.css',
			'flaticon'      => 'assets/css/flaticon.css',
			'font-awesome-all'      => 'assets/css/font-awesome-all.css',
			'imagebg'      => 'assets/css/imagebg.css',
			'fancybox'      => 'assets/css/jquery.fancybox.min.css',
			'jquery-ui'      => 'assets/css/jquery-ui.css',
			'owl'      => 'assets/css/owl.css',
			'style-2'      => 'assets/css/style-2.css',
			'main-style'      => 'assets/css/style.css',
		//This is Theme Styles
			'error'             => 'assets/css/theme/error.css',
			'sidebar'         => 'assets/css/theme/sidebar.css',
			'tut'             => 'assets/css/theme/tut.css',
			'woocommerce'      => 'assets/css/woocommerce.css',
			'fixing'             => 'assets/css/theme/fixing.css',
			'responsive'      => 'assets/css/responsive.css',
			'color-panel'      => 'assets/css/color-panel.css',
			'rtl'      => 'assets/css/rtl.css',
			'sidedoc'      => 'assets/css/sidedoc.css',
			
			
		); 

		$styles = apply_filters( 'APPWAY/includes/classes/header_enqueue/styles', $styles );

		/**
		 * Enqueue the styles
		 *
		 * @var array
		 */
		foreach ( $styles as $name => $style ) {

			if ( strstr( $style, 'http' ) || strstr( $style, 'https' ) || strstr( $style, 'fonts.googleapis' ) ) {
				wp_enqueue_style( "appway-{$name}", $style );
			} else {
				wp_enqueue_style( "appway-{$name}", get_template_directory_uri() . '/' . $style );
			}
		}
		$options      = appway_WSH()->option();
		$custom_style = '';

		wp_add_inline_style( 'color', $custom_style );

		$header_styles = self::header_styles(); 
		
		if ( $custom_font = $options->get('theme_custom_font') ) {
            $header_styles .= appway_custom_fonts_load( $custom_font );
        }

		wp_add_inline_style( 'appway-main-style', $header_styles );

		if( $options->get('theme_preloader') ) {
			wp_enqueue_style('appway_preloader', get_template_directory_uri().'/assets/css/theme/loader.min.css');
		}

	}

	/**
	 * Register custom fonts.
	 */
	public static function fonts_url() {
		$fonts_url = '';
		$font_families['Ubuntu']      = 'Ubuntu:300,300i,400,400i,500,500i,700,700i';

		$font_families['Kaushan']     = 'Kaushan Script';
		
		$font_families = apply_filters( 'APPWAY/includes/classes/header_enqueue/font_families', $font_families );

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$protocol  = is_ssl() ? 'https' : 'http';
		$fonts_url = add_query_arg( $query_args, $protocol . '://fonts.googleapis.com/css' );

		return esc_url_raw($fonts_url);
	}


	/**
	 * Add preconnect for Google Fonts.
	 *
	 * @since APPWAY 1.0
	 *
	 * @param array  $urls          URLs to print for resource hints.
	 * @param string $relation_type The relation type the URLs are printed.
	 *
	 * @return array $urls           URLs to print for resource hints.
	 */
	public static function resource_hints( $urls, $relation_type ) {
		if ( wp_style_is( 'appway-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		}

		return $urls;
	}

	/**
	 * header_styles
	 *
	 * @since APPWAY 1.0
	 *
	 * @param array $urls URLs to print for resource hints.
	 */
	public static function header_styles() {

		$data = \APPWAY\Includes\Classes\Common::instance()->data( 'blog' )->get();

		$options = appway_WSH()->option();

		$styles = '';
		if ( $options->get( 'footer_top_button' ) ) :
			$styles .= "#topcontrol {
				background: " . $options->get( 'button_bg' ) . " none repeat scroll 0 0 !important;
				opacity: 0.5;

				color: " . $options->get( 'button_color' ) . " !important;

			}";

		endif;

		$settings = get_theme_mod( APPWAY_NAME . '_options-mods' );

		if ( $custom_font = appway_set( $settings, 'theme_custom_font' ) ) {

			$styles .= apply_filters('appway_redux_custom_fonts_load', $custom_font );


		}

		return $styles;
	}


}