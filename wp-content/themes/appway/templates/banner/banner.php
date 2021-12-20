<?php
/**
 * Banner Template
 *
 * @package    ThemeName
 * @author     ThemeAuthor
 * @version    1.0
 */

if ( $data->get( 'enable_banner' ) AND $data->get( 'banner_type' ) == 'e' AND ! empty( $data->get( 'banner_elementor' ) ) ) {
	echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $data->get( 'banner_elementor' ) );

	return false;
}

?>
<?php if ( $data->get( 'enable_banner' ) ) : ?>
<!-- page-title -->
<?php if ( $data->get( 'banner' ) ) : ?>
<section class="page-title" style="background-image: url('<?php echo esc_url( $data->get( 'banner' ) ); ?>');">
<?php else : ?>	  
<section class="page-title" style="background-image: url(<?php echo esc_url(get_template_directory_uri().'/assets/images/background/pagetitle-bg.png');?>);">
<?php endif ;?>	 

	<div class="anim-icons">
		<div class="icon icon-1"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/icons/anim-icon-17.png');?>" alt="<?php esc_attr_e('image','appway') ?>"></div>
		<div class="icon icon-2 rotate-me"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/icons/anim-icon-18.png');?>" alt="<?php esc_attr_e('image','appway') ?>"></div>
		<div class="icon icon-3 rotate-me"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/icons/anim-icon-19.png');?>" alt="<?php esc_attr_e('image','appway') ?>"></div>
		<div class="icon icon-4"></div>
	</div>
	<div class="container">
		<div class="content-box clearfix">
			<div class="title-box pull-left">
				<h1><?php echo wp_kses( $data->get( 'title' ), true ); ?></h1>
			</div>
			<ul class="bread-crumb pull-right">
				<?php echo appway_the_breadcrumb(); ?>
			</ul>
		</div>
	</div>
</section>
<!-- page-title end -->
<?php endif; ?>

