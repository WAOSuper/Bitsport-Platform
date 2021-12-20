<?php
/**
 * Comments Main File.
 *
 * @package APPWAY
 * @author  Template Path
 * @version 1.0
 */
?>
<?php
if ( post_password_required() ) {
	return;
}
?>
<?php $count = wp_count_comments(get_the_ID()); ?>
<?php if ( have_comments() ) : ?>
<div class="mr_comments_area comments-area" id="comments">
		<?php if (appway_set($count, 'total_comments') > 0): ?>
			<div class="comment_titlebox">
				<h3 class="comments_title"><?php echo appway_set($count, 'total_comments'); ?>
					<?php if ( appway_set($count, 'total_comments') > 1 ) : ?>
						<?php esc_html_e('Comments', 'appway'); ?>
					<?php else : ?>
						<?php esc_html_e('Comment', 'appway'); ?>
					<?php endif; ?>
				</h3>
			</div>
			
		<ul class="mr_singlecomment">
			<?php
				wp_list_comments( array(
					'style'       => 'ul',
					'short_ping'  => true,
					'avatar_size' => 74,
					'callback'    => 'appway_list_comments',
				) );
			?>
		 </ul>  
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
				<nav class="navigation comment-navigation" role="navigation">
					<h1 class="screen-reader-text section-heading">
						<?php esc_html_e( 'Comment navigation', 'appway' ); ?>
					</h1>
					<div class="nav-previous">
						<?php previous_comments_link( esc_html__( '&larr; Older Comments', 'appway' ) ); ?>
					</div>
					<div class="nav-next">
						<?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'appway' ) ); ?>
					</div>
				</nav><!-- .comment-navigation -->
			<?php endif; ?>
		<?php endif; ?>
		<?php if ( ! comments_open() && get_comments_number() ) : ?>
			<p class="no-comments">
				<?php esc_html_e( 'Comments are closed.', 'appway' ); ?>
			</p>
		<?php endif; ?>
	
</div>
<?php endif; ?>
<?php appway_comment_form(); ?>