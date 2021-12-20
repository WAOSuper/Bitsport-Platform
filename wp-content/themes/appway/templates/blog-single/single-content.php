<?php
/**
 * Single Post Content Template
 *
 * @package    WordPress
 * @subpackage ThemeName
 * @author     AuthorName
 * @version    1.0
 */
?>
<?php global $wp_query;

$page_id = ( $wp_query->is_posts_page ) ? $wp_query->queried_object->ID : get_the_ID();

$gallery = get_post_meta( $page_id, 'appway_gallery_images', true );

$video = get_post_meta( $page_id, 'appway_video_url', true );


$audio_type = get_post_meta( $page_id, 'appway_audio_type', true );

?>
<div class="post-details">
<?php if(has_post_thumbnail()):?>
<figure class="image-box"><?php the_post_thumbnail();?></figure>
<?php endif; ?>

<div class="inner-box">
<?php	if ( has_post_thumbnail() ) { ?>
	<?php if(!$options->get('single_post_cat' ) ): ?>
	<div class="single_cat"><?php the_category(); ?></div>
	<?php endif; ?>	
<?php } ?>	
	<div class="upper-box">
		
		<ul class="post_meta">
			<?php if(!$options->get('single_post_date' ) ): ?>
				<li class="meta_date"><a href="<?php echo get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ); ?>"><?php esc_html_e('-', 'appway'); ?><?php echo get_the_date(); ?></a></li>
			<?php endif; ?>	
			<?php if(!$options->get('single_post_comments' ) ): ?>
			<li class="meta_comment"><?php esc_html_e('-', 'appway'); ?><?php comments_number(); ?></li>
			<?php endif; ?>	
		</ul>
		<h3><?php the_title();?></h3>
		<div class="text post_text"><?php the_content(); ?>
		<div class="clearfix"></div>
			<?php wp_link_pages(array('before'=>'<div class="paginate_links">'.esc_html__('Pages: ', 'appway'), 'after' => '</div>', 'link_before'=>'', 'link_after'=>'')); ?>
		</div>
	</div>
	<div class="lower-box clearfix">
			<?php if(!$options->get('single_post_author' ) ): ?>	
		<div class="left-content pull-left">
			<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta('ID') )); ?>">
				<figure class="admin-image"><?php echo get_avatar(get_the_author_meta('ID'), 90); ?></figure>
			<span class="admin-name"> <?php the_author(); ?></span>
				</a>
		</div>
			<?php endif; ?>
		<?php if ($options->get( 'single_social_share' ) && $options->get( 'single_post_share' ) ) : ?>
		<ul class="social-links_post clearfix right-content pull-right">							
			<?php foreach ( $options->get( 'single_social_share' ) as $k => $v ) {
				if ( $v == '' ) {
					continue;
				} ?>
				<?php do_action('appway_social_share_output', $k ); ?>
			<?php } ?>
		</ul>
		<?php endif; ?>
		
	</div>
</div>
</div>
<?php appway_template_load( 'templates/blog-single/social_share.php', compact( 'options', 'data' ) ); ?>	
 <!-- Navigation -->
<?php appway_template_load( 'templates/blog-single/next_post.php', compact( 'options', 'data' ) ); ?>	
<?php appway_template_load( 'templates/blog-single/author_box.php', compact( 'options', 'data' ) ); ?>
<?php comments_template(); ?> 	

