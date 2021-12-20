<?php
/**
 * Footer Template  File
 * @package ThemeName
 * @author  ThemeAuthor
 * @version 1.0
 */

$options = appway_WSH()->option();
$footerbg    = $options->get( 'footer_background' );
$footerbg    = appway_set( $footerbg, 'url', APPWAY_URI . 'assets/images/footerbg.png' );
$allowed_html = wp_kses_allowed_html( 'post' );
?>
    <!-- main-footer -->
<?php if ( is_active_sidebar( 'footer-sidebar' ) ) { ?>    

   <!-- main-footer -->
    <footer class="main-footer style-two style-three mr_footer">
       <?php if($options->get( 'footer_shape' ) ):?>  
		<div class="anim-icons">
            <div class="icon icon-1"></div>
            <div class="icon icon-2"></div>
            <div class="icon icon-3"></div>
            <div class="icon icon-4"></div>
            <div class="icon icon-5"></div>
            <div class="icon icon-6"></div>
            <div class="icon icon-7"></div>
            <div class="icon icon-8"></div>
            <div class="icon icon-9"></div>
            <div class="icon icon-10"></div>
        </div>
		<?php endif; ?>	
        <div class="container">
            <div class="footer-top">
                <div class="widget-section">
                    <div class="row">
                       <?php dynamic_sidebar( 'footer-sidebar' ); ?>
                    </div>
                </div>
            </div>
		<?php if( $options->get( 'copyright_area' ) ):?>	
            <div class="footer-bottom">
                <div class="copyright"><?php echo wp_kses( $options->get( 'copyright_text', '' ), $allowed_html ); ?></div>
            </div>
		<?php endif; ?>	
			
        </div>
    </footer>
	
<?php } ?> 	 
