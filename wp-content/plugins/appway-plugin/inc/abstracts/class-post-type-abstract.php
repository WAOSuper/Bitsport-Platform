<?php
/**
 * Abstract class for register post type
 *
 * @package    WordPress
 * @subpackage Plugin
 * @author     Mahfuzur Rashid <rashidcloud@gmail.com>
 * @version    1.0
 */

namespace APPWAYPLUGIN\Inc\Abstracts;


if ( ! function_exists( 'add_action' ) ) {
	exit;
}

/**
 * Abstract Post Type
 * Implemented by classes using the same CRUD(s) pattern.
 *
 * @version  2.6.0
 * @package  APPWAYPLUGIN/Abstracts
 * @category Abstract Class
 * @author   Wptech
 */
abstract class Post_Type {

	protected $post_type = '';

	protected $singular = '';

	protected $plural = '';

	protected $menu_icon = '';

	protected $menu_name = '';

	protected $only_admin = false;

	protected $taxonomies = array();
	
	protected $supports = array( 'title', 'thumbnail', 'editor' );

	function __construct() {

	}

	/**
	 * The register function is used the register post type finally.
	 *
	 * @return [type] [description]
	 */
	public function register() {

		if ( ! $this->post_type ) {
			return;
		}

		$labels = array( 'labels' => $this->labels() );

		$args = $this->args();
		$args = array_merge( $labels, $args );

		register_post_type( $this->post_type, $args );
	}

	/**
	 * The args to set the post type.
	 *
	 * @return array Returns the array of arguments.
	 */
	public function args() {

		$args = array( 'supports' => $this->supports(), 'rewrite' => $this->rewrites() );

		if ( ! $this->only_admin ) {
			$args['public'] = true;
		}

		if ( $taxonomies = $this->taxonomies ) {
			$args['taxonomies'] = $taxonomies;
		}

		if ( $menu_icon = $this->menu_icon ) {
			$args['menu_icon'] = $menu_icon;
		}

		return $args;
	}

	public function supports() {
		return $this->supports;
	}

	public function labels() {

		$menu_name = $this->menu_name;
		if ( ! $menu_name ) {
			$menu_name = $this->plural;
		}
		$singular = $this->singular;
		$plural   = $this->plural;

		$labels = array(
			'name'                  => sprintf( _x( '%s', 'Post type general name', 'student-2-plugin' ), $plural ),
			'singular_name'         => sprintf( _x( '%s', 'Post type singular name', 'student-2-plugin' ), $singular ),
			'menu_name'             => sprintf( _x( '%s', 'Admin Menu text', 'student-2-plugin' ), $plural ),
			'name_admin_bar'        => sprintf( _x( '%s', 'Add New on Toolbar', 'student-2-plugin' ), $singular ),
			'add_new'               => sprintf( __( 'Add New', 'student-2-plugin' ) ),
			'add_new_item'          => sprintf( __( 'Add New %s', 'student-2-plugin' ), $singular ),
			'new_item'              => sprintf( __( 'New %s', 'student-2-plugin' ), $singular ),
			'edit_item'             => sprintf( __( 'Edit %s', 'student-2-plugin' ), $singular ),
			'view_item'             => sprintf( __( 'View %s', 'student-2-plugin' ), $singular ),
			'all_items'             => sprintf( __( 'All %s', 'student-2-plugin' ), $plural ),
			'search_items'          => sprintf( __( 'Search %s', 'student-2-plugin' ), $plural ),
			'parent_item_colon'     => sprintf( __( 'Parent %s:', 'student-2-plugin' ), $plural ),
			'not_found'             => sprintf( __( 'No %s found.', 'student-2-plugin' ), $plural ),
			'not_found_in_trash'    => sprintf( __( 'No %s found in Trash.', 'student-2-plugin' ), $plural ),
			'featured_image'        => sprintf( _x( '%s Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'student-2-plugin' ), $singular ),
			'set_featured_image'    => sprintf( _x( 'Set featured image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'student-2-plugin' ), $singular ),
			'remove_featured_image' => sprintf( _x( 'Remove featured image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'student-2-plugin' ) ),
			'use_featured_image'    => sprintf( _x( 'Use as featured image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'student-2-plugin' ) ),
			'archives'              => sprintf( _x( '%s archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'student-2-plugin' ), $singular ),
			'insert_into_item'      => sprintf( _x( 'Insert into %s', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'student-2-plugin' ), $singular ),
			'uploaded_to_this_item' => sprintf( _x( 'Uploaded to this %s', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'student-2-plugin' ), $singular ),
			'filter_items_list'     => sprintf( _x( 'Filter %s list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'student-2-plugin' ), $singular ),
			'items_list_navigation' => sprintf( _x( '%s list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'student-2-plugin' ), $plural ),
			'items_list'            => sprintf( _x( '%s list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'student-2-plugin' ), $plural ),
		);

		if ( $menu_name ) {
			$labels['menu_name'] = $menu_name;
		}

		return $labels;
	}

	public function rewrites() {

		return array(
			'slug' => $this->get_prop( __CLASS__, 'post_type' ),
		);
	}

	static function get_prop( $className, $property ) {
		if ( ! class_exists( $className ) ) {
			return null;
		}
		if ( ! property_exists( $className, $property ) ) {
			return null;
		}

		$vars = get_class_vars( $className );

		return $vars[ $property ];
	}

	function set_prop( $className, $property ) {
		if ( ! class_exists( $className ) ) {
			return null;
		}
		if ( ! property_exists( $className, $property ) ) {
			return null;
		}

		$vars = get_class_vars( $className );

		return $vars[ $property ];
	}
}