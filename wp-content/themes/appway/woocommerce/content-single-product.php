<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );
	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
	 $allowed_tags = wp_kses_allowed_html('post');
?>
<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="single-shop-content">
    	<div class="row clearfix">
            <div class="col-lg-4 pr-lg-5">
                <?php
					/**
					 * woocommerce_before_single_product_summary hook.
					 *
					 * @hooked woocommerce_show_product_sale_flash - 10
					 * @hooked woocommerce_show_product_images - 20
					 */
					do_action( 'woocommerce_before_single_product_summary' );
				?>
        	</div>
            <div class="col-lg-8">
        
                <div class="content-box">
                    <?php woocommerce_template_single_title();?>
                    <div class="review-box">
                        <?php woocommerce_template_single_rating(); ?>
                    </div>
                    <?php woocommerce_template_single_price();?>
                    <div class="text">
                        <?php woocommerce_template_single_excerpt();?>
                    </div>
                    <div class="cart-wrapper">
                        <?php woocommerce_template_single_add_to_cart();?>
                    </div>
                          
                    <div class="category">
                        <?php woocommerce_template_single_meta();?>
                    </div>  
                </div>
        
            </div><!-- .summary -->
    	</div>
    </div>
	<?php
		/**
		 * woocommerce_after_single_product_summary hook.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>
</div><!-- #product-<?php the_ID(); ?> -->
<?php do_action( 'woocommerce_after_single_product' ); ?>
