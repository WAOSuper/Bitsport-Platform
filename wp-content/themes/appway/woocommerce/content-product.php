<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

global $wp_query;
$options     = appway_WSH()->option();
?>

<div class="col-lg-<?php echo esc_attr($options->get('shop_column')); ?> col-md-12" >
	<div class="product-block-two">
		<?php
		/**
		 * Hook: woocommerce_before_shop_loop_item.
		 */
		do_action( 'woocommerce_before_shop_loop_item' );
	
		/**
		 * Hook: woocommerce_before_shop_loop_item_title.
		 */
		 
		 $post_thumbnail_id = get_post_thumbnail_id($post->ID);
		 $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
		 ?>
		 
		 <div class="inner-box">
			<div class="image">
				<?php woocommerce_template_loop_product_thumbnail(); ?>
				<div class="overlay">
					<div class="shop_metas">
						<a class="shop_link" href="<?php echo esc_url(get_the_permalink(get_the_id())); ?>"><i class="fa fa-shopping-cart"></i></a>
						<a class="lightbox-image shop_image" href="<?php echo esc_url( $post_thumbnail_url ); ?>" data-group="1"><span class="fa fa-search"></span></a>
					</div>
					
				</div>
			</div>
			<div class="lower-content">
				<h4><a href="<?php echo esc_url(get_the_permalink(get_the_id())); ?>"><?php the_title(); ?></a></h4>
				<div class="price"><?php woocommerce_template_loop_price(); ?></div>
			</div>
		</div>
		
		<?php
		/**
		 * Hook: woocommerce_after_shop_loop_item.
		 */
		do_action( 'woocommerce_after_shop_loop_item' );
		?>
	</div>
</div>