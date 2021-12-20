<?php
$options = appway_WSH()->option();
$allowed_html = wp_kses_allowed_html( 'post' );
$image_logo = $options->get( 'image_two_logo' );

$small_logo  = $options->get( 'image_small_logo' );
//$small_logo  = appway_set( $small_logo, 'url', APPWAY_URI . 'assets/images/small-logo.png' );

$mobile_logo  = $options->get( 'image_three_logo' );
//$mobile_logo  = appway_set( $mobile_logo, 'url', APPWAY_URI . 'assets/images/logo.png' );

$logo_dimension = $options->get( 'two_logo_dimension' );
$logo_type = '';
$logo_text = '';
$logo_typography = '';
?>
 <!-- main header -->
    <header class="main-header style-four">
        <div class="outer-container">
            <div class="container">
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
                        <div class="menu-right-content clearfix">
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
					<?php if($options->get( 'shop_link_v2') ) : ?>		
                            <div class="cart-box-outer">
                                <a href="<?php echo esc_url($options->get('shop_link_v2' ));?>">
                                    <i class="fas fa-shopping-basket"></i>
                                </a>
                            </div>
					<?php endif ;?>			
                            <div class="nav-btn nav-toggler navSidebar-button clearfix">
                                <span class="icon"></span>
                                <span class="icon"></span>
                                <span class="icon"></span>
                            </div>
					<?php if($options->get( 'quote_v2') ) : ?>			
                            <div class="btn-box"><a href="<?php echo esc_url($options->get('quote_link_v2' ));?>"><?php echo wp_kses( $options->get( 'quote_v2'), $allowed_html ); ?></a></div>
					<?php endif ;?>			
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