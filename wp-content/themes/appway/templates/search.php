<?php
$options = appway_WSH()->option();
$allowed_html = wp_kses_allowed_html();
$search_image    = $options->get( 'search_image' );
$search_image    = appway_set( $search_image, 'url', APPWAY_URI . 'assets/images/search.png' );

?>

<section class="search_area_df">
<div class="container">		 
		<div class="row clearfix">			
			<div class="col-md-5 col-sm-12 col-xs-12">
				<div class="searcg_img">
				
				<?php if(esc_url($search_image)): ?>
				
				<img src="<?php echo esc_url($search_image);?>	" alt="<?php esc_attr_e('Image', 'appway');?>">
				
				<?php else : ?>
				<img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/search.png');?>" alt="<?php esc_attr_e('Image', 'appway');?>">
				<?php endif; ?>	  
				  
				</div>
			</div>
			<div class="col-md-7 col-sm-12 col-xs-12">
			<div class="search_tx_box">
		<!-- search Title -->	
			<?php if($options->get('search_page_title' ) ): ?>
		
				<h1 class="search_title">
				<?php echo wp_kses( $options->get( 'search_page_title'), $allowed_html ); ?>
				
				</h1>
				<?php else : ?>
				<h1 class="search_title">
				<?php esc_html_e( 'Oops! Search not Found', 'appway' ); ?>
				</h1>
			<?php endif; ?>	
		<!-- search Text -->		
				<?php if($options->get('search_page_text' ) ): ?>
				
				<div class="search_text">	
				<?php echo(wp_kses($options->get('search_page_text' ), $allowed_html )) ?>
				</div>
			<?php else : ?>
				<div class="search_text">	
				<p><?php esc_html_e( '1. Check the Spelling ', 'appway' ); ?>
				</p>
				<p><?php esc_html_e( '2. Check the Caps Lock', 'appway' ); ?>
				</p>      
				<p><?php esc_html_e( '3. Press Enter correctly or Press F5', 'appway' ); ?>
				</p> 
				</div>
			<?php endif; ?>	
		<!--  Search form -->
		<?php if(!$options->get('search_page_form' ) ): ?>  
				<?php echo get_search_form(); ?>
			<?php endif; ?>	
		<!--  Back to Home -->
		<?php if(!$options->get('search_back_home_btn' ) ): ?> 
		  	<?php if($options->get('search_back_home_btn_label' ) ): ?> 
			
			<div class="btn-box">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-one"><i class="fas fa-home"></i><?php echo(wp_kses($options->get('search_back_home_btn_label' ), $allowed_html )) ?></a>
							
                        </div>
			
			
			<?php else : ?>
			<div class="error_btn1 btn-box wow fadeInUp animated" data-wow-delay="300ms">
			
				<div class="btn-box">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-one"><i class="fas fa-home"></i><?php esc_html_e( 'Back To Home', 'appway' ); ?></a>
							
                            
                        </div>
						
				
			</div>
			<?php endif; ?><?php endif; ?>	
			</div>
			</div>
	</div>
</div>
</section>	