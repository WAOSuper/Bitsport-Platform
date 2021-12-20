<?php

namespace APPWAYPLUGIN\Inc;


use APPWAYPLUGIN\Inc\Abstracts\Taxonomy;


class Taxonomies extends Taxonomy {


	public static function init() {

		$labels = array(
			'name'              => _x( 'Project Category', 'rashid' ),
			'singular_name'     => _x( 'Project Category', 'rashid' ),
			'search_items'      => __( 'Search Category', 'rashid' ),
			'all_items'         => __( 'All Categories', 'rashid' ),
			'parent_item'       => __( 'Parent Category', 'rashid' ),
			'parent_item_colon' => __( 'Parent Category:', 'rashid' ),
			'edit_item'         => __( 'Edit Category', 'rashid' ),
			'update_item'       => __( 'Update Category', 'rashid' ),
			'add_new_item'      => __( 'Add New Category', 'rashid' ),
			'new_item_name'     => __( 'New Category Name', 'rashid' ),
			'menu_name'         => __( 'Project Category', 'rashid' ),
		);
		$args   = array(
			'hierarchical'       => true,
			'labels'             => $labels,
			'show_ui'            => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'            => array( 'slug' => 'project_cat' ),
		);

		register_taxonomy( 'project_cat', 'appway_project', $args );
		
		//Services Taxonomy Start
		$labels = array(
			'name'              => _x( 'Service Category', 'rashid' ),
			'singular_name'     => _x( 'Service Category', 'rashid' ),
			'search_items'      => __( 'Search Category', 'rashid' ),
			'all_items'         => __( 'All Categories', 'rashid' ),
			'parent_item'       => __( 'Parent Category', 'rashid' ),
			'parent_item_colon' => __( 'Parent Category:', 'rashid' ),
			'edit_item'         => __( 'Edit Category', 'rashid' ),
			'update_item'       => __( 'Update Category', 'rashid' ),
			'add_new_item'      => __( 'Add New Category', 'rashid' ),
			'new_item_name'     => __( 'New Category Name', 'rashid' ),
			'menu_name'         => __( 'Service Category', 'rashid' ),
		);
		$args   = array(
			'hierarchical'       => true,
			'labels'             => $labels,
			'show_ui'            => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'            => array( 'slug' => 'service_cat' ),
		);


		register_taxonomy( 'service_cat', 'appway_service', $args );
		
		//Testimonials Taxonomy Start
		$labels = array(
			'name'              => _x( 'Testimonials Category', 'rashid' ),
			'singular_name'     => _x( 'Testimonials Category', 'rashid' ),
			'search_items'      => __( 'Search Category', 'rashid' ),
			'all_items'         => __( 'All Categories', 'rashid' ),
			'parent_item'       => __( 'Parent Category', 'rashid' ),
			'parent_item_colon' => __( 'Parent Category:', 'rashid' ),
			'edit_item'         => __( 'Edit Category', 'rashid' ),
			'update_item'       => __( 'Update Category', 'rashid' ),
			'add_new_item'      => __( 'Add New Category', 'rashid' ),
			'new_item_name'     => __( 'New Category Name', 'rashid' ),
			'menu_name'         => __( 'Testimonials Category', 'rashid' ),
		);
		$args   = array(
			'hierarchical'       => true,
			'labels'             => $labels,
			'show_ui'            => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'            => array( 'slug' => 'testimonials_cat' ),
		);


		register_taxonomy( 'testimonials_cat', 'appway_testimonials', $args );
		
		
		//Team Taxonomy Start
		$labels = array(
			'name'              => _x( 'Team Category', 'rashid' ),
			'singular_name'     => _x( 'Team Category', 'rashid' ),
			'search_items'      => __( 'Search Category', 'rashid' ),
			'all_items'         => __( 'All Categories', 'rashid' ),
			'parent_item'       => __( 'Parent Category', 'rashid' ),
			'parent_item_colon' => __( 'Parent Category:', 'rashid' ),
			'edit_item'         => __( 'Edit Category', 'rashid' ),
			'update_item'       => __( 'Update Category', 'rashid' ),
			'add_new_item'      => __( 'Add New Category', 'rashid' ),
			'new_item_name'     => __( 'New Category Name', 'rashid' ),
			'menu_name'         => __( 'Team Category', 'rashid' ),
		);
		$args   = array(
			'hierarchical'       => true,
			'labels'             => $labels,
			'show_ui'            => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'            => array( 'slug' => 'team_cat' ),
		);


		register_taxonomy( 'team_cat', 'appway_team', $args );
		
		//Faqs Taxonomy Start
		$labels = array(
			'name'              => _x( 'Faqs Category', 'rashid' ),
			'singular_name'     => _x( 'Faq Category', 'rashid' ),
			'search_items'      => __( 'Search Category', 'rashid' ),
			'all_items'         => __( 'All Categories', 'rashid' ),
			'parent_item'       => __( 'Parent Category', 'rashid' ),
			'parent_item_colon' => __( 'Parent Category:', 'rashid' ),
			'edit_item'         => __( 'Edit Category', 'rashid' ),
			'update_item'       => __( 'Update Category', 'rashid' ),
			'add_new_item'      => __( 'Add New Category', 'rashid' ),
			'new_item_name'     => __( 'New Category Name', 'rashid' ),
			'menu_name'         => __( 'Faq Category', 'rashid' ),
		);
		$args   = array(
			'hierarchical'       => true,
			'labels'             => $labels,
			'show_ui'            => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'            => array( 'slug' => 'faqs_cat' ),
		);


		register_taxonomy( 'faqs_cat', 'appway_faqs', $args );
	}
	
}
