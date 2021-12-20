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
abstract class Taxonomy {

	protected $taxonomy = '';

	protected $singular = '';

	protected $plural = '';

	protected $menu_name = '';

	protected $post_types = array();

	protected $labels = array();

	protected $admin_only = false;

	protected $args = array();

	protected $supports = array();

	protected $rewrite = array();

	protected $show_in_table = false;

	protected $hierarchical = false;

	function instance( $taxonomy, $singular, $plural ) {

		$this->taxonomy = $taxonomy;

		$this->singular = $singular;

		$this->plural = $plural;

		return $this;
	}

	/**
	 * The register function is used the register post type finally.
	 *
	 * @return [type] [description]
	 */
	public function register() {

		if ( ! $this->taxonomy ) {
			return;
		}

		$labels = array( 'labels' => ( $this->labels ) ? $this->labels : $this->labels() );

		$args = ( $this->args ) ? $this->args : $this->args();

		$args = array_merge( $labels, $args );

		$post_types = $this->post_types ? $this->post_types : array( 'post' );

		register_taxonomy( $this->taxonomy, $post_types, $args );
	}

	/**
	 * The args to set the post type.
	 *
	 * @return array Returns the array of arguments.
	 */
	public function args() {

		$args = array(
			'supports' => ( $this->supports ) ? $this->supports : $this->supports(),
			'rewrite'  => ( $this->rewrite ) ? $this->rewrite : $this->rewrites(),
		);

		if ( $this->admin_only ) {
			$args['public'] = false;
		}


		return $args;
	}

	public function supports() {

		return array( 'title', 'thumbnail', 'editor' );
	}

	public function labels() {

		$menu_name = $this->menu_name;
		if ( ! $menu_name ) {
			$menu_name = $this->plural;
		}
		$singular = $this->singular;
		$plural   = $this->plural;

		$labels = array(
			'name'              => sprintf( _x( '%s', 'taxonomy general name', 'student-2-plugin' ), $plural ),
			'singular_name'     => sprintf( _x( '%s', 'taxonomy singular name', 'student-2-plugin' ), $singular ),
			'search_items'      => sprintf( __( 'Search %s', 'student-2-plugin' ), $plural ),
			'all_items'         => sprintf( __( 'All %s', 'student-2-plugin' ), $plural ),
			'parent_item'       => sprintf( __( 'Parent %s', 'student-2-plugin' ), $singular ),
			'parent_item_colon' => sprintf( __( 'Parent %s:', 'student-2-plugin' ), $singular ),
			'edit_item'         => sprintf( __( 'Edit %s', 'student-2-plugin' ), $singular ),
			'update_item'       => sprintf( __( 'Update %s', 'student-2-plugin' ), $singular ),
			'add_new_item'      => sprintf( __( 'Add New %s', 'student-2-plugin' ), $singular ),
			'new_item_name'     => sprintf( __( 'New %s Name', 'student-2-plugin' ), $singular ),
			'menu_name'         => sprintf( __( '%s', 'student-2-plugin' ), $singular ),
		);

		if ( $menu_name ) {
			$labels['menu_name'] = $menu_name;
		}

		return $labels;
	}

	public function rewrites() {

		return array(
			'slug' => $this->taxonomy,
		);
	}


	function set_labels( $labels = array() ) {

		$this->labels = array_merge( $labels, $this->labels() );

		return $this;
	}

	function set_supports( $supports = array() ) {

		$this->supports = $supports;

		return $this;
	}

	function set_rewrite( $rewrites = array() ) {

		$this->rewrite = $rewrites;

		return $this;
	}

	function set_args( $args = array() ) {

		$this->args = array_merge( $args, $this->args() );

		return $this;
	}

	function admin_only() {
		$this->admin_only = true;

		return $this;
	}

	function set_post_type( $post_type ) {

		$this->post_types = $post_type;

		return $this;
	}

	function show_in_table() {

		$this->show_in_table = true;

		return $this;
	}

	function hierarchical() {

		$this->hierarchical = true;

		return $this;
	}
}