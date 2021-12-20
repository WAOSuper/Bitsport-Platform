<?php if (!$options->get( 'single_post_tag' ) ) :?> 

<?php if(has_tag()) {?>
   
<div class="share-box clearfix">
	
	<div class="post-tags left-title pull-left">
	<?php the_tags('<i class="fa fa-tag"></i> ', '<span class="commax">,</span>  ', ''); ?>
	</div>
</div>	

<?php	}?>
<?php endif; ?>