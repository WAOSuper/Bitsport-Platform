<?php
/**
 * The header for our theme
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package APPWAY
 * @since   1.0
 * @version 1.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta content="IE=edge" http-equiv="X-UA-Compatible">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
		<?php wp_head(); ?>
	</head>
<?php $options = appway_WSH()->option(); ?>
<body <?php body_class(); ?>>
<?php
if ( ! function_exists( 'wp_body_open' ) ) {
		function wp_body_open() {
			do_action( 'wp_body_open' );
		}
}?>
	
<?php
$options = appway_WSH()->option();
$allowed_html = wp_kses_allowed_html( 'post' );?>	
<?php if($options->get( 'theme_preloader' ) ): ?>	
<div class="preloader"></div>
<?php endif ; ?>	
<main class="theme-layout <?php if($options->get( 'theme_rtl' ) ): echo esc_attr_e( ' rtl ', 'appway' ); endif;?>">
<?php do_action( 'appway_main_header' ); ?>
	
	