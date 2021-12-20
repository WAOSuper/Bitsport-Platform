<?php
/**
 * Tag Main File.
 *
 * @package APPWAY
 * @author  Template Path
 * @version 1.0
 */
get_header();
global $wp_query;
$data  = \APPWAY\Includes\Classes\Common::instance()->data( 'product' )->get();
$class = ( $data->get( 'layout' ) != 'full' ) ? 'col-xs-12 col-sm-12 col-md-12 col-lg-8' : 'col-xs-12 col-sm-12 col-md-12';
do_action( 'appway_banner', $data );


if ( class_exists( '\Elementor\Plugin' ) AND $data->get( 'tpl-type' ) == 'e' AND $data->get( 'tpl-elementor' ) ) {
	echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $data->get( 'tpl-elementor' ) );
} else {
	?>

<section class="mr_shop_single">
    <div class="container">
        <div class="row">
         
			
           	<?php
					if ( $data->get( 'layout' ) == 'left' ) {?>
						<!-- page content -->
				<?php if ( is_active_sidebar( 'default-sidebar' ) ) { ?>
				<aside class="col-lg-4 col-md-12 col-sm-12 col-xs-12 sidebar-side">
					<?php dynamic_sidebar( 'default-sidebar' ); ?>
				</aside>
				<?php };}?>	
			<div class="content-side <?php echo esc_attr($class); ?> ">
            	
                <div class="shop-content mr_single_content">
                	<?php
						/**
						 * woocommerce_before_main_content hook
						 *
						 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
						 * @hooked woocommerce_breadcrumb - 20
						 */
						do_action( 'woocommerce_before_main_content' );
					?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php wc_get_template_part( 'content', 'single-product' ); ?>
						<?php endwhile; // end of the loop. ?>
					<?php
						/**
						 * woocommerce_after_main_content hook
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
						 */
						do_action( 'woocommerce_after_main_content' );
					?>
                </div>
                
            </div>
		
        	 	<?php
					if ( $data->get( 'layout' ) == 'right' ) {?>
						<!-- page content -->
				<?php if ( is_active_sidebar( 'default-sidebar' ) ) { ?>
				<aside class="col-lg-4 col-md-12 col-sm-12 col-xs-12 sidebar-side">
					<?php dynamic_sidebar( 'default-sidebar' ); ?>
				</aside>
				<?php };}?>	
		</div>
	</div>
</section>
<?php
}
get_footer( 'shop' );
