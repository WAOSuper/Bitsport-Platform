<?php
/**
 * 404 page file
 *
 * @package    WordPress
 * @subpackage Appway
 * @author     Template Path <admin@template-path.com>
 * @version    1.0
 */

$text = sprintf(__('Can not find what you need? Take a moment and do a search
below or start from our Homepage.', 'appway'), esc_html(home_url('/')));
$allowed_html = wp_kses_allowed_html( 'post' );
?>
<?php get_header();
$data = \APPWAY\Includes\Classes\Common::instance()->data( '404' )->get();
do_action( 'appway_banner', $data );
$options = appway_WSH()->option();
if ( class_exists( '\Elementor\Plugin' ) AND $data->get( 'tpl-type' ) == 'e' AND $data->get( 'tpl-elementor' ) ) {
	echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $data->get( 'tpl-elementor' ) );
} else {
?>




<?php if( $options->get( '404_title' )) : ?>
<!-- error-section -->
<section class="error-section centred" style="background-image:url(<?php echo esc_url(get_template_directory_uri().'/assets/images/errorbg.jpg');?>)">
	
	<div class="container">
		<div class="content-box">
			<h1><?php echo wp_kses( $options->get( '404_title' ), $allowed_html ) ? wp_kses( $options->get( '404_title' ), $allowed_html ) : esc_html_e( '404', 'appway' ); ?></h1>
			<!-- 404-page-Title -->
			<h2><?php echo wp_kses( $options->get( '404-page_title' ), $allowed_html ) ? wp_kses( $options->get( '404-page_title' ), $allowed_html ) : esc_html_e( 'Oops, This Page Not Be Found !', 'appway' ); ?></h2>
			<!-- 404-page-text -->
			<div class="text"><?php echo wp_kses( $options->get('404-page-text'), $allowed_html ) ? wp_kses($options->get('404-page-text' ), $allowed_html ) : $text; ?></div>
			 
			<div class="textxx"></div>
			 <!-- 404 back_home_btn -->
			 <?php if ( $options->get( 'back_home_btn', true ) ) : ?>
				<div class="errobtn_area" data-wow-delay="300ms"><a href="<?php echo( home_url( '/' ) ); ?>" class="error_btn"><i class="fas fa-home"></i><?php echo wp_kses( $options->get('back_home_btn_label'), $allowed_html ) ? wp_kses( $options->get('back_home_btn_label'), $allowed_html ) : esc_html_e( ' Back To Home', 'appway' ); ?></a></div>
			<?php endif; ?>
			<div class="textxx"></div>
			
			<div class="404_img">
			 
			</div>
		</div>
	</div>
</section>

<?php else : ?> 
 <!-- error-section -->
    <section class="error-section centred">
        <div class="container">
            <div class="content-box">
                <figure class="error-image"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/resource/error.png');?>" alt="<?php esc_attr_e('image','appway') ?>"></figure>
                <h1><?php esc_html_e( 'Sorry, The page was not found', 'appway' ); ?></h1>
                <div class="text"><?php esc_html_e( 'We can’t find the page that you are', 'appway' ); ?></br><?php esc_html_e( 'looking for', 'appway' ); ?></div>
                <div class="btn-box"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="theme-btn-two"><?php esc_html_e( 'Back To Home', 'appway' ); ?></a></div>
            </div>
        </div>
    </section>
    <!-- error-section end -->
    <!-- clients-style-four -->
    <section class="clients-style-four style-five">
        <div class="image-layer" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/icons/layer-image-7.png');?>);"></div>
        <div class="container">
            <div class="clients-carousel owl-carousel owl-theme owl-dots-none">
                <figure class="image-box"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/clients/client-1.png');?>" alt="<?php esc_attr_e('image','appway') ?>"></figure>
                <figure class="image-box"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/clients/client-2.png');?>" alt="<?php esc_attr_e('image','appway') ?>"></figure>
                <figure class="image-box"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/clients/client-3.png');?>" alt="<?php esc_attr_e('image','appway') ?>"></figure>
                <figure class="image-box"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/clients/client-4.png');?>" alt="<?php esc_attr_e('image','appway') ?>"></figure>
            </div>
        </div>
    </section>
    <!-- clients-style-four end -->
<?php endif;?>	
<!-- error-section end -->
<?php
}
get_footer(); ?>
