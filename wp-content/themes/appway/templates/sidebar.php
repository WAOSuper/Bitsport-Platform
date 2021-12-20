<?php

/**
 * Sidebar Template
 *
 * @package    WordPress
 * @author     ThemeAuthor
 * @version    1.0
 */

if ( class_exists( '\Elementor\Plugin' ) AND $data->get( 'sidebar_type' ) == 'e' AND $data->get( 'sidebar_elementor' ) ) {
	?>

	<div class="col-lg-3 col-sm-8 col-md-12">
		<aside class="sidebar">
			<?php
			echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $data->get( 'sidebar_elementor' ) );
			?>
		</aside>
	</div>
	<?php
	return false;
} else {
	$options = $data->get( 'sidebar' );
}
?>

<?php if ( is_active_sidebar( $options ) ) : ?>
	<div class="col-lg-4 col-md-12">
		<aside class="sidebar-wrapper">
			<?php dynamic_sidebar( $options ); ?>
		</aside>
	</div>	
<?php endif; ?>

