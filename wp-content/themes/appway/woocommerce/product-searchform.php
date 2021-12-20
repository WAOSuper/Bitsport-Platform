<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>


<div class="search-box">
    <!--Start single sidebar-->
    <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
        <div class="form-group">
            <input type="hidden" name="post_type[]" value="product">
            <input type="text" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field" placeholder="<?php esc_attr_e( 'Enter Keyword', 'appway' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
            <button type="submit"><span class="icon fa fa-search"></span></button>
        </div>
    </form>
    <!--End single sidebar-->
</div>

