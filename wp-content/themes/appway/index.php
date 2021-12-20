<?php
/**
 * Blog Main File.
 *
 * @package APPWAY
 * @author  toantheme
 * @version 1.0
 */

get_header();
global $wp_query;
$data  = \APPWAY\Includes\Classes\Common::instance()->data( 'blog' )->get();
$layout = $data->get( 'layout' );
$sidebar = $data->get( 'sidebar' );
$layout = ( $layout ) ? $layout : 'right';
$sidebar = ( $sidebar ) ? $sidebar : 'default-sidebar';
if (is_active_sidebar( $sidebar )) {$layout = 'right';} else{$layout = 'full';}
$class = ( !$layout || $layout == 'full' ) ? 'col-xs-12 col-sm-12 col-md-12' : 'col-xs-12 col-sm-12 col-md-12 col-lg-8';
if ( class_exists( '\Elementor\Plugin' ) AND $data->get( 'tpl-type' ) == 'e' AND $data->get( 'tpl-elementor' ) ) {
	echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $data->get( 'tpl-elementor' ) );
} else {
?>


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
<!--Start blog area-->
 <section class="sidebar-page-container">
        <div class="container">
            <div class="row">
                <!--Sidebar Start-->
                <?php
				if ( $data->get( 'layout' ) == 'left' ) {
					do_action( 'appway_sidebar', $data );
				}
				?>               
            
             <div class="<?php echo esc_attr( $class ); ?>  content-side"> 
				 <div class="blog-content">
                        <?php
						while ( have_posts() ) :
							the_post();
							appway_template_load( 'templates/blog/blog.php', compact( 'data' ) );
						endwhile;
						
					
						?>
						
						<div class="post-pagination">
						<?php appway_the_pagination(); ?>
					</div>
                    </div>
                </div>
                <!--Sidebar Start-->
                <?php
				if ( $data->get( 'layout' ) == 'right' ) {
					do_action( 'appway_sidebar', $data );
				}
				?>
            </div>
        </div>
    </section> 
    <!--End blog area--> 
	<?php
}
get_footer();
