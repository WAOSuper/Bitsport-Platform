<?php $allowed_html = wp_kses_allowed_html( 'post' ); ?>

<div class="blog-detail-page project-deta">
<figure>
	<?php if ( class_exists( 'WPappway_Resizer' ) ) : ?>
		<?php echo wp_kses( $img_obj->WPappway_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ), 'full' ), 1100, 600, true ), $allowed_html ); ?>
	<?php else : ?>
		<?php the_post_thumbnail( 'full' ); ?>
	<?php endif; ?>  

</figure>
<div class="blog-detail-meta">
		
		<h2><?php the_title(); ?></h2>
		<?php if ( $options->get( 'projects_single_categories' ) ) : ?>
			<div class="pro-cat">
				<span class="pro-title"><?php esc_html_e('Posted In:', 'appway' ); ?></span>
				<span>
				<?php $lists = get_the_terms( get_the_ID(), 'project_cat' ); ?>
					<?php foreach( $lists as $list ) { 
						echo appway_set( $list,'name' ).', ';
					}
					?>
						
				</span>
			</div>
		<?php endif; ?>

		<?php the_content(); ?>
		<?php
		$entries = get_post_meta( get_the_ID(), 'project_timng', true );
		if ( $entries && $options->get( 'projectsingle_timing' ) ) { ?>

		<div class="opening-hours">
			<?php echo ( esc_attr($options->get( 'projectsingle_timing_title' )) ) ? '<span>' .esc_attr($options->get( 'projectsingle_timing_title' )).'</span>' : ''; ?>
			<ul>
				<?php foreach ( (array) $entries as $key => $entry ) { ?>
				<li> 

					<?php echo ( appway_set( $entry, 'opening_day') ) ? '<span>'.appway_set( $entry, 'opening_day') .':</span>' : ''; ?>

					<?php echo ( appway_set( $entry, 'opening_time') ) ? '<p>'.appway_set( $entry, 'opening_time') .'</p>' : ''; ?>
				</li>

				<?php } ?>
				<?php if (  $closed = get_post_meta( get_the_ID(), 'project_closed_day', true ) ) : ?>
					<li>
						<span><?php echo esc_attr( $closed ); ?> :</span>
						<i><?php esc_html_e( 'closed', 'appway' ); ?></i>
					</li>
				<?php endif; ?>
			</ul>
		</div>

		<?php } ?>


		<?php if ( $options->get( 'projectsingle_post_share' ) && $options->get( 'projectsingle_social_share' ) ) : ?>
			<div class="sharing">
				<span><?php esc_html_e( 'Social Sharing:', 'appway' ); ?></span>
				<ul class="share-social">
					<?php if ( ! empty( $options->get( 'projectsingle_social_share' ) ) ) : ?>
						
						<?php
						foreach ( $options->get( 'projectsingle_social_share' ) as $k => $v) {
							if ($v == '')
								continue;
							?>
							<?php do_action('appway_social_share_output', $k); ?>
							<?php } ?>
							
						<?php endif; ?>
					</ul>
				</div>	
			<?php endif; ?>
		</div>
	</div>
