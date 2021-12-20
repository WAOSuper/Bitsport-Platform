<?php
$options = appway_WSH()->option();
$allowed_html = wp_kses_allowed_html();
/**
 * Blog Content Template
 *
 * @package    WordPress
 * @subpackage ThemeName
 * @author     ThemeAuthor
 * @version    1.0
 */
if ( class_exists( 'Appway_Resizer' ) ) {
	$img_obj = new Appway_Resizer();
} else {
	$img_obj = array();
}
?>
<div <?php post_class() ?>>
<!--======Edit from Line Bellow===== -->
  <div class="single-blog-content">
	<div class="inner-box">
		<figure class="image-box"><a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><?php the_post_thumbnail(); ?></a></figure>
		
		<div class="lower-content">
		
<?php	if ( has_post_thumbnail() ) { ?>
   <?php if($options->get('blog_post_category' ) ): ?>
		<div class="single_cat"><?php the_category(); ?></div>
	<?php endif; ?>	
<?php } ?>
		
			<div class="upper-box">
				<ul class="post_meta">
			<?php if(!$options->get('blog_post_date' ) ): ?>			
					<li class="meta_date"><a href="<?php echo get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ); ?>"><?php esc_html_e('-', 'appway'); ?><?php echo get_the_date(); ?></a></li>
			<?php endif; ?>	
			<?php if(!$options->get('blog_post_comments' ) ): ?>			
			<li class="meta_comment"><?php esc_html_e('-', 'appway'); ?><?php comments_number(); ?></li>
			<?php endif; ?>			
		</ul>
				<h3><a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><?php the_title(); ?></a></h3>
				<div class="text"><?php the_excerpt(); ?></div>
			</div>
			<div class="lower-box clearfix">
		<?php if(!$options->get('blog_post_author' ) ): ?>
			<div class="left-content pull-left">
			<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta('ID') )); ?>">
				<figure class="admin-image"><?php echo get_avatar(get_the_author_meta('ID'), 90); ?></figure>
			<span class="admin-name"> <?php the_author(); ?></span>
				</a>
		</div>
		<?php endif; ?>	
		<?php if($options->get('blog_post_readmore' ) ): ?>			
				<div class="link right-content pull-right">
					<a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><i class="fas fa-angle-double-right"></i><?php echo wp_kses( $options->get( 'blog_post_readmoretext'), $allowed_html ); ?></a>
				</div>
		<?php else: ?>	
				<div class="link right-content pull-right">
					<a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><i class="fas fa-angle-double-right"></i><?php esc_html_e('Read More', 'appway'); ?></a>
				</div>
		<?php endif; ?>			
			</div>
		</div>
	</div>
</div>
<!--===Edit from Line Bellow====== -->
</div>
	