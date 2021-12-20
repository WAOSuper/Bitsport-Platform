<?php
/**
 * Theme functions and definitions.
 */
function appway_child_enqueue_styles() {

    if ( SCRIPT_DEBUG ) {
        wp_enqueue_style( 'appway-style' , get_template_directory_uri() . '/style.css' );
    } else {
        wp_enqueue_style( 'appway-minified-style' , get_template_directory_uri() . '/style.min.css' );
    }

    wp_enqueue_style( 'appway-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'appway-style' ),
        wp_get_theme()->get('Version')
    );
}

add_action(  'wp_enqueue_scripts', 'appway_child_enqueue_styles' );