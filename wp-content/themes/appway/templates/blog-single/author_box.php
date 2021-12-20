<?php

if ($options->get( 'single_post_author_box' ) ) : ?>
 <div class="author-box">
	<div class="author-inner">
		<figure class="author-thumb"><?php echo get_avatar( get_the_author_meta( 'ID' ), 130 ); ?></figure>
		<div class="inner">
			<h4><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></h4>
			<div class="text">
				<?php echo esc_html( get_the_author_meta( 'description' ) ); ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>