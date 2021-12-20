<?php
/**
 * Default Template Main File.
 *
 * @package APPWAY
 * @author  tonatheme
 * @version 1.0
 */

get_header();
$data  = \APPWAY\Includes\Classes\Common::instance()->data( 'single' )->get();
$layout = $data->get( 'layout' );
$sidebar = $data->get( 'sidebar' );
if (is_active_sidebar( $sidebar )) {$layout = 'right';} else{$layout = 'full';}
$class = ( !$layout || $layout == 'full' ) ? 'col-xs-12 col-sm-12 col-md-12' : 'col-xs-12 col-sm-12 col-md-12 col-lg-8';
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
 <section class="sidebar-page-container mrsingle">
        <div class="container">
            <div class="row">
				<?php
				if ( $data->get( 'layout' ) == 'left' ) {
					do_action( 'appway_sidebar', $data );
				}
				?>
			<div class="wp-style <?php echo esc_attr( $class ); ?>  content-side">	
				<div class="blog-single-content">
					<div class="mr_page text clearfix">
					<?php while ( have_posts() ): the_post(); ?>
						<h2><?php the_title(); ?></h2>
						
						<?php the_content(); ?>
					
					<?php endwhile; ?>
					<div class="clearfix"></div>
					<?php
					$defaults = array(
						'before' => '<div class="paginate_links">' . esc_html__( 'Pages:', 'appway' ),
						'after'  => '</div>',

					);
					wp_link_pages( $defaults );
					?>
					</div>	
					<?php comments_template() ?>
				</div>
				</div>
				<?php
				if ( $layout == 'right' ) {
					$data->set('sidebar', 'default-sidebar');
					do_action( 'appway_sidebar', $data );
				}
				?>
		</div>
	</div>
</section><!-- blog section with pagination -->
<?php get_footer(); ?>
