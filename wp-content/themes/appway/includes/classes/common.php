<?php

namespace APPWAY\Includes\Classes;


/**
 * Common functions
 */
class Common {

	public static $instance;

	function __construct() {

	}

	public static function instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * [data description]
	 *
	 * @param  string $emplate [description]
	 *
	 * @return [type]          [description]
	 */
	function data( $template = 'blog' ) {
		$this->template = $template;


		return $this;
	}

	/**
	 * [get description]
	 *
	 * @return [type] [description]
	 */
	function get() {

		$data = (array) $this->blog();

		switch ( $this->template ) {

			case 'blog':
			case 'author':
			case 'search':
			case 'tag':
			case '404':
			case 'shop': 
			case 'product': 
			case 'category':
			case 'archive':
				return $this->blog( $this->template );
				break;
			case 'single':
				return $this->single( $this->template );
				break;
			default:
				#code...
				break;
		}
	}

	/**
	 * Blog pages banner, sidebar and layout data.
	 *
	 * @param  string $template The tempalte need to return the data for.
	 *
	 * @return [type]           [description]
	 */
	function blog( $template = 'blog' ) {

		global $wp_query;
		$options = appway_WSH()->option();

		if ( ( $wp_query->is_posts_page && 'blog' == $template ) || $template == 'page' ) {
			$page_id = ( $wp_query->is_posts_page ) ? $wp_query->queried_object->ID : get_the_ID();

			$return = [
				'layout'            => appway_meta( 'sidebar_sidebar_layout', $page_id, 'right' ),
				'sidebar_type'      => appway_meta( 'sidebar_source_type', $page_id, 'd' ),
				'sidebar_elementor' => appway_meta( 'sidebar_elementor_template', $page_id ),
				'sidebar'           => appway_meta( 'sidebar_page_sidebar', $page_id, 'default-sidebar' ),
				'banner_type'       => appway_meta( 'banner_source_type', $page_id ),
				'banner_elementor'  => appway_meta( 'banner_elementor_template', $page_id ),
				'banner'            => appway_set( appway_meta( 'banner_page_background', $page_id ), 'url' ),
				'title'             => appway_meta( 'banner_banner_title', $page_id ),
				'enable_banner'     => appway_meta( 'banner_page_banner', $page_id ),
			];

		} else {
			$enable_banner = $template . '_page_banner';
			$title         = $template . '_banner_title';
			$banner        = $template . '_page_background';
			$layout        = $template . '_sidebar_layout';
			$sidebar       = $template . '_page_sidebar';
			$bg            = $options->get( $banner );

			$return = [
				'enable_banner' => $options->get( $enable_banner ),
				'title'         => $options->get( $title ) ? $options->get( $title ) : appway_the_title( $template ),
				'banner'        => appway_set( $bg, 'url' ),
				'sidebar'       => $options->get( $sidebar, 'default-sidebar' ),
				'layout'        => $options->get( $layout, 'right' ),
			];
		}
		$return['tpl-type']      = $options->get( $template . '_source_type' );
		$return['tpl-elementor'] = $options->get( $template . '_elementor_template' );
		$return['author']        = $options->get( $template . '_post_author' );
		$return['date']          = $options->get( $template . '_post_date' );
		$return['comments']      = $options->get( $template . '_post_comments' );


		return new DotNotation( $return );
	}


	/**
	 * Post detail and custom post types datail meta.
	 *
	 * @param  string $template The template for which data is need to be returned.
	 *
	 * @return [type]           [description]
	 */


	public function single( $template = 'single' ) {
		global $wp_query;
		$options = appway_WSH()->option();

		$page_id = ( $wp_query->is_posts_page ) ? $wp_query->queried_object->ID : get_the_ID();
	
			
		if(function_exists("is_woocommerce")){
if(is_woocommerce()) $page_id = get_option( 'woocommerce_shop_page_id' );
}
		//if(is_woocommerce()) $page_id = get_option( 'woocommerce_shop_page_id' );
		
		$title = appway_meta( 'banner_banner_title', $page_id );

		$return = [
			'tpl-type'          => $options->get( $template . '_source_type', 'd' ),
			'tpl-elementor'     => $options->get( $template . '_elementor_template' ),
			'layout'            => appway_meta( 'sidebar_sidebar_layout', $page_id, 'right' ),
			'sidebar_type'      => appway_meta( 'sidebar_source_type', $page_id, 'd' ),
			'sidebar_elementor' => appway_meta( 'sidebar_elementor_template', $page_id ),
			'sidebar'           => appway_meta( 'sidebar_page_sidebar', $page_id, 'default-sidebar' ),
			'banner_type'       => appway_meta( 'banner_source_type', $page_id ),
			'banner_elementor'  => appway_meta( 'banner_elementor_template', $page_id ),
			'banner'            => appway_set( appway_meta( 'banner_page_background', $page_id ), 'url' ),
			'title'             => ($title) ? $title : esc_html__('Standard Post', 'appway'),
			'enable_banner'     => appway_meta( 'banner_page_banner', $page_id ),
			'date'              => $options->get( 'single_post_date', 1 ),
			'author'            => $options->get( 'single_post_author', 1 ),
			'comments'          => $options->get( 'single_post_comments', 1 ),
			'tag'               => $options->get( 'single_post_tag' ),
			'share'             => $options->get( 'single_post_share' ),
			'share_list'        => $options->get( 'single_social_share' ),
			'author_box'        => $options->get( 'single_post_author_box' ),
		];


		return new DotNotation( $return );


	}


}

