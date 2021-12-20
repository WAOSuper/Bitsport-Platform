<?php
$options = appway_WSH()->option();
$allowed_html = wp_kses_allowed_html( 'post' );


$image_logo = $options->get( 'image_normal_logo' );


$small_logo  = $options->get( 'image_small_logo' );
//$small_logo  = appway_set( $small_logo, 'url', APPWAY_URI . 'assets/images/small-logo.png' );

$mobile_logo  = $options->get( 'image_three_logo' );
//$mobile_logo  = appway_set( $mobile_logo, 'url', APPWAY_URI . 'assets/images/logo.png' );

$logo_dimension = $options->get( 'normal_logo_dimension' );
$logo_type = '';
$logo_text = '';
$logo_typography = '';
?>
 <header class="main-header style-three">
        <div class="header-topbar">
			<div class="octf-area-wrap">
				<div class="container-fluid">
				<!-- contact info -->
		<?php if($options->get( 'email_v1') || $options->get( 'time_title_v1') ) : ?>		
				<ul class="topbar-info clearfix">
					<li><i class="fas fa-envelope"></i><a href="#"><?php echo wp_kses( $options->get( 'email_v1'), $allowed_html ); ?></a></li>
					<li><i class="fas fa-clock"></i><?php echo wp_kses( $options->get( 'time_title_v1'), $allowed_html ); ?></li>
				</ul>
		<?php endif ;?>	
<?php 
$icons = $options->get( 'header_social_v1' );
if ( ! empty( $icons ) ) :
	?>
	<ul class="social-list">
	<?php
			foreach ( $icons as $h_icon ) :
			$header_social_icons = json_decode( urldecode( appway_set( $h_icon, 'data' ) ) );
			if ( appway_set( $header_social_icons, 'enable' ) == '' ) {
				continue;
			}
			$icon_class = explode( '-', appway_set( $header_social_icons, 'icon' ) );
			?>
			<li><a href="<?php echo esc_url(appway_set( $header_social_icons, 'url' )); ?>" style="background-color:<?php echo esc_attr(appway_set( $header_social_icons, 'background' )); ?>; color: <?php echo esc_attr(appway_set( $header_social_icons, 'color' )); ?>"><span class="fab <?php echo esc_attr( appway_set( $header_social_icons, 'icon' ) ); ?>"></span></a></li>
		<?php endforeach; ?>	
	</ul>
<?php endif; ?>		
					
					
			<?php if($options->get( 'welcome_v1') || $options->get( 'login_v1') ) : ?>	
				<div class="extra-text"><?php echo wp_kses( $options->get( 'welcome_v1'), $allowed_html ); ?> <a href="<?php echo esc_url($options->get('login_link_v1' ));?>"><?php echo wp_kses( $options->get( 'login_v1'), $allowed_html ); ?></a>		
				</div>
			<?php endif; ?>		
				
				</div>
			</div>
		</div>
        <div class="header-upper">
            <div class="outer-container">
                <div class="container-fluid">
                    <div class="main-box clearfix">
                        <div class="logo-box pull-left">
                            <figure class="logo"><?php echo appway_logo( $logo_type, $image_logo, $logo_dimension, $logo_text, $logo_typography ); ?></figure>
                        </div>
                        <div class="menu-area pull-right clearfix">
                            <!--Mobile Navigation Toggler-->
                            <div class="mobile-nav-toggler">
                                <i class="icon-bar"></i>
                                <i class="icon-bar"></i>
                                <i class="icon-bar"></i>
                            </div>
                            <nav class="main-menu navbar-expand-md navbar-light">
                                <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                    <ul class="navigation clearfix">
                                    <?php wp_nav_menu( array( 'theme_location' => 'main_menu', 'container_id' => 'navbar-collapse-1',
									'container_class'=>'navbar-collapse collapse navbar-right',
									'menu_class'=>'nav navbar-nav',
									'fallback_cb'=>false, 
									'items_wrap' => '%3$s', 
									'container'=>false,
									'depth'=>'3',
									'walker'=> new Bootstrap_walker()  
								) ); ?>
                                    </ul>
                                </div>
                            </nav>
                            
                            
							<div class="octf-col cta-col text-right">
								<div class="octf-btn-cta">
							   <!--====sticky  ====== -->	
								

									<div class="search-box-outer">
										<div class="dropdown">
											<button class="search-box-btn" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-search"></span></button>
											<ul class="dropdown-menu pull-right search-panel" aria-labelledby="dropdownMenu3">
												<li class="panel-outer">
													<div class="form-container">

														
												<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">		
												
                                                    <div class="form-group">
                                                       
												<input type="search"  name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php echo esc_attr__( 'Search Here...', 'appway' ); ?>" />		
                                                        <button type="submit" class="search-btn"><span class="fas fa-search"></span></button>
                                                    </div>
                                                </form>	
														
														
														
													</div>
												</li>
											</ul>
										</div>
									</div>
<?php if($options->get( 'phone_title_v1') || $options->get( 'phone_v1') ) : ?>	
									<div class="octf-header-module">
										<div class="btn-cta-group contact-header">
											<i class="fas fa-phone"></i>
											<div class="cinfo-header">
												<span><?php echo wp_kses( $options->get( 'phone_title_v1'), $allowed_html ); ?></span>
												<span class="main-text"><a href="#"><?php echo wp_kses( $options->get( 'phone_v1'), $allowed_html ); ?></a></span>
											</div>
										</div>
									</div>
<?php endif ;?>
			<?php if($options->get( 'quote_v1')) : ?>							
									<div class="octf-header-module">
										<div class="btn-cta-group btn-cta-header">
											<a class="octf-btn octf-btn-third" href="<?php echo esc_url($options->get('quote_link_v1' ));?>"><?php echo wp_kses( $options->get( 'quote_v1'), $allowed_html ); ?></a>
										</div>
									</div>
					<?php endif ;?>				

								</div>								
							</div>	
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--sticky Header-->
        <div class="sticky-header">
            <div class="container clearfix">
                <figure class="logo-box"><?php echo appway_logo( $logo_type, $small_logo, $logo_dimension, $logo_text, $logo_typography ); ?></figure>
                <div class="menu-area">
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- main-header end -->

 <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><i class="fas fa-times"></i></div>
        <nav class="menu-box">
            <div class="nav-logo"><?php echo appway_logo( $logo_type, $mobile_logo, $logo_dimension, $logo_text, $logo_typography ); ?></div>
            <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
            <div class="contact-info">
                <h4><?php echo wp_kses( $options->get( 'about_v1'), $allowed_html ); ?></h4>
                <ul>
                    <li><?php echo wp_kses( $options->get( 'address_v1'), $allowed_html ); ?></li>
                    <li><?php echo wp_kses( $options->get( 'phone_v1'), $allowed_html ); ?></li>
                    <li><?php echo wp_kses( $options->get( 'email_v1'), $allowed_html ); ?></li>
                </ul>
            </div>
            <div class="social-links">
                <?php
$icons = $options->get( 'header_social_v1' );
if ( ! empty( $icons ) ) :
	?>
	<ul class="sociallinks-style-one">
		  <?php
			foreach ( $icons as $h_icon ) :
			$header_social_icons = json_decode( urldecode( appway_set( $h_icon, 'data' ) ) );
			if ( appway_set( $header_social_icons, 'enable' ) == '' ) {
				continue;
			}
			$icon_class = explode( '-', appway_set( $header_social_icons, 'icon' ) );
			?>
			<li><a href="<?php echo esc_url(appway_set( $header_social_icons, 'url' )); ?>" style="background-color:<?php echo esc_attr(appway_set( $header_social_icons, 'background' )); ?>; color: <?php echo esc_attr(appway_set( $header_social_icons, 'color' )); ?>"><span class="fab <?php echo esc_attr( appway_set( $header_social_icons, 'icon' ) ); ?>"></span></a></li>
		<?php endforeach; ?>
		
		
	</ul>
<?php endif; ?>
            </div>
        </nav>
    </div><!-- End Mobile Menu -->
   