<?php 

namespace APPWAY\Includes\Classes;

/**
 * Visual Composer array mapper and render the output.
 */
class Visual_Composer {

	/**
	 * [$maps description]
	 * @var array
	 */
	protected $maps = array(
		'heading1',
		'our_services',
		'choose_us',
		'projects',
		'blog',
		'testimonial',
		'brands',
		'slider',
		'get_in_touch',
		'our_services2',
		'services_news',
		'circled_services',
		'custom_info',
		'services_icon',
		'our_experts',
		'pricing_plan',
		'projects2',
		'faqs',
		'contact_info',
		'contact_form',
		'map',
		'estimated_time',
		'pricing_plan2',
		'about_us',
		'widget_contact',
		'useful_links',
		'store_hours',
		'get_offer',
		'header_logo',
		'contact_us',
		'main_menu',
		'simple_info',
		'header_button',
		'search_box',
		'header_contact_info',
		'header_social_icons',
		'reparing',
		'about_us_carousel',
		'repair_video',
		'problem_fix_form',
		'widget_blog',
		'widget_newsletter',
		'widget_social_profiles',
		'funfacts',
		'repaired_parallax',
		'appointment_banner',
		'repair_device',
		'best_opertunity',
		'simple_banner',
		'states',
		'repair_model',
		'parts_price',
		'supported_models',
		'branches',
		'latest_articles',
		'projects3',
		'pricing_plans3',
		'funfact2',
		'services3',
		'contact_infobar',
		'services4',
		'about_us2',
		'choose_us2',
		'team',
		'funfacts3',
		'specialized_services',
		'services5',
		'pricing_plans4',
		'blog2',
		'call_back',
		'sponsors',
		'fun_facts_boxes',
		'gallery',
		'portfolio',
		'featured_banner',
		'video_banner',
		'featured_carousel'
	);

	/**
	 * [__construct description]
	 */
	function __construct() {

		if ( ! function_exists( 'vc_map' ) ) {
			return;
		}

		
		vc_set_default_editor_post_types( array( 'page', 'static_block' ) );


		add_action( 'vc_before_init', array( $this, 'init' ) );
	}

	/**
	 * VC Map main init
	 * @return void [description]
	 */
	function init() {

		// set vc as theme.
		vc_set_as_theme();

		if ( function_exists( 'vc_addshortcode_param' ) ) {
			vc_addshortcode_param( 'toggle', array( $this, 'toggle' ) );
		}

		$dir = get_stylesheet_directory() . '/shortcodes'; // First, set new directory for templates
		vc_set_shortcodes_templates_dir( $dir );

		// Map the params of existing elements.
		$this->map_params();

		$maps = apply_filters( 'appway_vc_map', $this->maps );

		foreach ( $maps as $value) {
			
			$file = $this->get_file( $value );

			if ( file_exists( $file ) ) {

				$data = include $file;

				vc_map( $data );

				if ( function_exists( 'wpappway_shortcode' ) ) {
					$tag = esc_attr( appway_set( $data, 'base' ) );

					wpappway_shortcode( $tag, array( $this, 'output' ) );
				}
			}
		}
	}

	function output( $atts, $content = null, $tag ) {

		$params = $this->shortcodeParams( $tag );

		ob_start();

		appway_template_load( 'shortcodes/' . $tag . '.php', compact( 'atts', 'content', 'tag' ) );

		return ob_get_clean();	

	}

	function get_file( $tag ) {

		$file = appway_template( 'includes/resource/vc_map/'.$tag . '.php' );
		$file = apply_filters( "appway_vc_map_file_{$tag}", $file );

		return $file;
	}

	/**
	 * shortcode params from vc array.
	 *
	 * @param  string $tag shortcode tag
	 * @return array      params
	 */
	function shortcodeParams( $tag ) {

		$file = $this->get_file( $tag );

		if ( file_exists( $file ) ) {
			$data = include $file;

			return appway_set( $data, 'params' );
		}

		return array();
	}

	function map_params() {

		$array = array(
			'vc_row',
		);

		foreach( $array as $file ) {

			$file = $this->get_file( $file );

			if ( file_exists( $file ) ) {
				$data = include $file;

				foreach ( $data as $key => $value) {
					
					foreach( $value as $param )	{
						vc_add_param( $key, $param );
					}
				}
			}
		}
	}


	/**
	 * Checkbox shortcode attribute type generator.
	 *
	 * @param $settings
	 * @param string $value
	 *
	 * @since 4.4
	 * @return string - html string.
	 */
	function toggle( $settings, $value ) {
		$output = '';
		if ( is_array( $value ) ) {
			$value = '';
		}
		$current_value = strlen( $value ) > 0 ? explode( ',', $value ) : array();
		$values = isset( $settings['value'] ) && is_array( $settings['value'] ) ? $settings['value'] : array( esc_html__( 'Yes', 'appway' ) => 'true' );
		if ( ! empty( $values ) ) {
			foreach ( $values as $label => $v ) {
				$checked = count( $current_value ) > 0 && in_array( $v, $current_value ) ? ' checked' : '';
				$output .= ' <label class="vc_checkbox-label"><input id="'
				           . $settings['param_name'] . '-' . $v . '" value="'
				           . $v . '" class="wpb_vc_param_value tgl tgl-ios '
				           . $settings['param_name'] . ' ' . $settings['type'] . '" type="checkbox" name="'
				           . $settings['param_name'] . '"'

				           . $checked . '> '
				           . '<span class="tgl-btn" for="cb2"></span>'
				           . $label . '</label>';
			}
		}

		return $output;
	}
}