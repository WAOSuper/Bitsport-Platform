<?php
/**
 * Footer Main File.
 *
 * @package APPWAY
 * @author  Template Path
 * @version 1.0
 */
global $wp_query;
$page_id = ( $wp_query->is_posts_page ) ? $wp_query->queried_object->ID : get_the_ID();
?>
<div class="clearfix"></div>
<?php appway_template_load( 'templates/footer/footer.php', compact( 'page_id' ) );?>
<!--Scroll to top-->
<button class="scroll-top scroll-to-target" data-target="html">
    <span class="fa fa-arrow-up"></span>
</button>

<?php
$options = appway_WSH()->option();
$allowed_html = wp_kses_allowed_html( 'post' );


$image_logo = $options->get( 'image_normal_logo' );

$small_logo  = $options->get( 'image_small_logo' );
//$small_logo  = appway_set( $small_logo, 'url', APPWAY_URI . 'assets/images/small-logo.png' );

$mobile_logo  = $options->get( 'image_three_logo' );
//$mobile_logo  = appway_set( $mobile_logo, 'url', APPWAY_URI . 'assets/images/logo.png' );

$logo_dimension = $options->get( 'three_logo_dimension' );
$logo_type = '';
$logo_text = '';
$logo_typography = ''; ?>

    <!-- sidebar cart item -->
    <div class="xs-sidebar-group info-group info-sidebar">
        <div class="xs-overlay xs-bg-black"></div>
        <div class="xs-sidebar-widget">
            <div class="sidebar-widget-container">
                <div class="widget-heading">
                    <a href="#" class="close-side-widget">
                        X
                    </a>
                </div>
                <div class="sidebar-textwidget">
                    
                    <!-- Sidebar Info Content -->
                <div class="sidebar-info-contents">
                    <div class="content-inner">
                        <div class="logo">
                            <?php echo appway_logo( $logo_type, $image_logo, $logo_dimension, $logo_text, $logo_typography ); ?>
                        </div>
                        <div class="content-box">
                            <h4><?php echo wp_kses( $options->get( 'sideabout_v1'), $allowed_html ); ?></h4>
                            <p class="text"><?php echo wp_kses( $options->get( 'sidetext_v1'), $allowed_html ); ?>.</p>
                            <a href="<?php echo esc_url($options->get('quote_link_v1' ));?>" class="theme-btn-two"><?php echo wp_kses( $options->get( 'quote_v1'), $allowed_html ); ?></a>
                        </div>
                        <div class="contact-info">
                            <h4><?php echo wp_kses( $options->get( 'sideaddresstitle_v1'), $allowed_html ); ?></h4>
                            <ul>
                                <li><?php echo wp_kses( $options->get( 'address_v1'), $allowed_html ); ?></li>
                                <li><a href="#"><?php echo wp_kses( $options->get( 'phone_v1'), $allowed_html ); ?></a></li>
                                <li><a href="<?php echo esc_url($options->get('quote_link_v1' ));?>"><?php echo wp_kses( $options->get( 'quote_v1'), $allowed_html ); ?></a></li>
                            </ul>
                        </div>
                        <!-- Social Box -->
					   <?php
$icons = $options->get( 'header_social_v1' );
if ( ! empty( $icons ) ) :
	?>
	<ul class="social-box">
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
                </div>
                    
                </div>
            </div>
        </div>
    </div>
</main>
<?php wp_footer() ?>
</body>
</html>


