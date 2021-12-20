<?php


/** Set ABSPATH for execution */
define( 'ABSPATH', dirname(dirname(__FILE__)) . '/' );
define( 'WPINC', 'wp-includes' );


/**
 * @ignore
 */
function add_filter() {}

/**
 * @ignore
 */
function esc_attr($str) {return $str;}

/**
 * @ignore
 */
function apply_filters() {}

/**
 * @ignore
 */
function get_option() {}

/**
 * @ignore
 */
function is_lighttpd_before_150() {}

/**
 * @ignore
 */
function add_action() {}

/**
 * @ignore
 */
function did_action() {}

/**
 * @ignore
 */
function do_action_ref_array() {}

/**
 * @ignore
 */
function get_bloginfo() {}

/**
 * @ignore
 */
function is_admin() {return true;}

/**
 * @ignore
 */
function site_url() {}

/**
 * @ignore
 */
function admin_url() {}

/**
 * @ignore
 */
function home_url() {}

/**
 * @ignore
 */
function includes_url() {}

/**
 * @ignore
 */
function wp_guess_url() {}

if ( ! function_exists( 'json_encode' ) ) :
/**
 * @ignore
 */
function json_encode() {}
endif;



/* Convert hexdec color string to rgb(a) string */
 
function hex2rgba($color, $opacity = false) {
 
	$default = 'rgb(0,0,0)';
 
	//Return default if no color provided
	if(empty($color))
          return $default; 
 
	//Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }
 
        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }
 
        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);
 
        //Check if opacity is set(rgba or rgb)
        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }
 
        //Return rgb(a) color string
        return $output;
}

$color = $_GET['main_color'];

ob_start(); ?>
/*========== Color ====================*/


.octf-btn-cta .contact-header i,
.main-menu .navigation > li > ul > li > a:hover,
.banner-section .content-box .btn-box a:hover,
.content_block_01 .content-box .inner-box .single-item .icon-box,
.feature-style-two .feature-block:nth-child(2) .feature-block-one .inner-box .icon-box,
.theme-btn,
.theme-btn-two:hover,
.pricing-block-one .pricing-table .table-header .price,
.pricing-block-one .pricing-table .table-content li:before,
.pricing-section .tab-btn-box .tab-btns li,
.testimonial-section .testimonial-block .inner-box .author-info h5,
#content_block_05 .content-box .download-btn a:hover,
.news-block-one .inner-box .lower-content h3 a:hover,
.news-block-one .inner-box .lower-content .link-btn a
.sticky-header .main-menu .navigation > li.current > a, 
.sticky-header .main-menu .navigation > li:hover > a,
.news-block-one .inner-box .lower-content .link-btn a,
.banner-style-three .content-box .video-box a:hover,
.banner-style-three .content-box .video-box a:hover i,
#content_block_14 .inner-content .single-column:last-child .feature-block-one:first-child .icon-box,
.sticky-header .main-menu .navigation > li.current > a, 
.sticky-header .main-menu .navigation > li:hover > a,
.innovative-idea .single-item .inner-box h3 a:hover,
#content_block_16 .content-box .download-btn a:hover,
.application-setup .single-item .inner-box h3 a:hover,
#content_block_17 .content-box h3,
.testimonial-style-five .testimonial-content .inner-box .author-info .name,
.main-footer .footer-top .contact-widget .list li i,
.main-footer .footer-top .links-widget .list li a:hover, 
.main-footer .footer-top .links-widget .list li a:hover:before, 
.main-footer .footer-top .contact-widget .list li a:hover,
.main-footer .footer-top .about-widget .social-links h6,
.main-footer .footer-top .about-widget .social-links li a:hover,
.main-footer .footer-bottom .copyright,
.rtl .main-header.style-four .search-box-btn, 
.rtl .main-header.style-four .menu-right-content .cart-box-outer a,
#content_block_20 .content-box .btn-box a,
.banner-style-eight .content-box .btn-box .btn-one,
#content_block_23 .inner-content .feature-column:last-child .feature-block-one:first-child .icon-box,
#content_block_22 .content-box h5,
.support-section .sec-title h5,
.trusted-section .sec-title h5,
.trusted-section .fact-counter .inner-box h2,
.testimonial-style-eight .sec-title h5,
.testimonial-style-eight .testimonial-content .inner-box .author-info .name,
.testimonial-style-ten .content-box .testimonial-content .author-info .name,
.organization-section .single-item .inner-box .icon-box,
.organization-section .single-item .inner-box h4 a:hover,
.banner-style-11 .content-box .btn-box .btn-one,
.banner-style-11 .content-box .btn-box .video-btn i,
.main-footer .footer-bottom .copyright a,
.testimonial-style-11 .testimonial-inner .owl-prev:hover, 
.testimonial-style-11 .testimonial-inner .owl-next:hover,
.pricing-style-four .pricing-table .table-footer a,
.pricing-style-four .pricing-table .table-content li,
.pricing-style-four .pricing-table .table-header .title,
.content_block_34 .content-box .list-item li:before,
.chooseus-section .inner-box .list-item li:before,
.testimonial-style-12 .testimonial-content .inner-box .author-info .name,
.content_block_38 .content-box .lower-content .single-item h3 a:hover,
.work-section .single-item .inner-box h3 a:hover,
.banner-style-15 .content-box .btn-box .btn-one,
.banner-style-15 .content-box h1,
.ridesharing-section .single-item .inner-box h3 a:hover,
#content_block_43 .content-box .estimate-form .btn-box button i,
#content_block_43 .content-box .estimate-form .btn-box button:hover,
#content_block_43 .content-box .estimate-form .form-group i,
.content_block_42 .content-box span,
.banner-style-17 .content-box .download-btn a:hover,
#content_block_51 .content-box .upper-box .btn-box a:hover,
#content_block_50 .content-box .list-item li:before,
#content_block_50 .content-box h2,
#content_block_47 .content-box .counter-inner .single-counter-box h3,
.ourmission-section .single-item .inner-box h3 a:hover,
#content_block_49 .content-box h2,
#content_block_49 .content-box .list-item li:before,
#content_block_51 .content-box .upper-box .btn-box a:hover,
.best-hosting .sec-title h2,
.domain-prices .sec-title h2,
.service-style-four .sec-title h2,
.service-block-three .inner-box h3 a:hover,
#content_block_45 .content-box .btn-box a,
.feature-style-14 .inner-box .content-box .list-item li:before,
.testimonial-style-four .testimonial-content .inner-box .author-info .name,
.banner-style-12 .content-box .btn-box .btn-two,
#content_block_12 .content-box .single-item h4 a:hover,
.userfree-section .content-box .btn-box a,
.banner-style-12 .content-box .btn-box .btn-two,
.banner-style-12 .content-box .btn-box .btn-one:hover,
#content_block_12 .content-box .single-item h4 a:hover,
.userfree-section .content-box .btn-box a,
.team-block-three .inner-box .lower-content h5 a:hover,
.team-block-three .inner-box .lower-content .designation,
.banner-style-two .content-box h3,
.service-section .sec-title .icon-box,
.content_block_07 .content-box h3, 
.content_block_08 .content-box h3, 
.content_block_09 .content-box h3, 
.content_block_10 .content-box h3,
.image_block_08 .image-box .image-content h3 a, 
.image_block_09 .image-box .image-content h3 a,
.testimonial-style-two .sec-title h3,
#content_block_11 .slide-content .author-info .name,
.banner-style-two .content-box h3,
.service-section .sec-title .icon-box,
.content_block_07 .content-box h3, 
.content_block_08 .content-box h3, 
.content_block_09 .content-box h3, 
.content_block_10 .content-box h3,
.image_block_08 .image-box .image-content h3 a, 
.image_block_09 .image-box .image-content h3 a,
.testimonial-style-two .sec-title h3,
#content_block_11 .slide-content .author-info .name,
.main-header .menu-area .btn-box a,
.pricing-style-three .tab-btn-box .tab-btns li,
.banner-style-six .content-box h1,
.recruitment-section .single-item .icon-box,
.recruitment-section .single-item h3 a:hover,
.recruitment-section .btn-box a,
.industries-service .list-item li a:hover,
.industries-service .list-item li a i,
.industries-service .inner-content .btn-box a,
.testimonial-style-six .testimonial-content .image-box:after,
.testimonial-style-six .testimonial-content .content-box .author-info .name,
.testimonial-style-six .owl-nav .owl-prev:hover, 
.testimonial-style-six .owl-nav .owl-next:hover,
#content_block_18 .content-box .subscribe-form .form-group button,
.reasons-section .single-item .inner-box h3 a:hover,
.banner-style-ten .content-box h5,
.service-block-three .inner-box .link-btn a,
#content_block_25 .content-box h3,
#content_block_25 .content-box .list-item li:before,
#content_block_26 .content-box .counter-inner .counter-block .count-outer span,
#content_block_27 .content-box .list-item li:before,
.testimonial-style-nine .owl-nav .owl-prev:hover, 
.testimonial-style-nine .owl-nav .owl-next:hover,
.designe-process .single-item .inner-box h4 a:hover,
.designe-process-two .tabs-content .content-box h3,
.designe-process-three .inner-content .single-item .inner-box h3 a:hover,
#content_block_33 .content-box a,
.feature-block-two .inner-box h3 a,
.feature-block-two .inner-box .link-btn a,
.main-footer.style-five .footer-top .contact-widget .social-links li a:hover,
.banner-style-16 .upper-box .content-box .btn-box a i,
.banner-style-16 .upper-box .content-box .btn-box a:hover,
#content_block_40 .inner-box .single-item .box h4 a:hover,
#content_block_39 .content-box h5,
.crypto-service .single-item .inner-box h3 a:hover,
.team-block-one .inner-box .lower-content h2 a:hover,
.best-hosting .single-item h3 a:hover,
.testimonial-style-nine.home-18 .testimonial-content .author-info .name,
.designe-process-three.alternate-2 .owl-nav .owl-next, 
.designe-process-three.alternate-2 .owl-nav .owl-prev,
.main-menu .navigation > li > ul > li > ul > li:hover > a,
.team-block-two .content-box h4 a:hover,
.team-block-two .content-box .team-social li a:hover,
.faq-section .accordion-box .block .acc-btn.active h4,
.faq-section .accordion-box .block .acc-btn .icon-outer,
.faq-section .faq-sidebar .online-purchase a,
.error-section .content-box h1,
.service-details .service-details-content .bottom-content .list-item li:before,
.portfolio-details .content-box .social-icons li a:hover,
#appway_recent_post-2 .post .bind h6 a:hover,
.sidebar-page-container .blog-content .single-blog-content .lower-content .lower-box .right-content a,
.sidebar-page-container .blog-content .single-blog-content .lower-content .upper-box h3 a:hover,
.post_meta li,
.post_meta li a,
.drop-cap span,
.post_color,
.sidebar-page-container .blog-single-content .comments-area .comment .comment-inner .replay-btn a,
.header-topbar .extra-text a

{
	color:#<?php echo esc_attr( $color ); ?>!important;
}

/*==============================================
   Theme Background Css
===============================================*/

.octf-btn,
.main-header.style-three .main-menu .navigation > li:before,
.theme-btn i,
.theme-btn:before,
.theme-btn-two,
.pricing-block-one:hover .pricing-table .table-header .price,
.pricing-section .tab-btn-box .tab-btns li:before,
.news-block-one .inner-box .image-box,
.sticky-header,
.clients-section .owl-theme .owl-dots .owl-dot.active span,
.feature-block-one .inner-box .hover-content,
.image_block_13 .image-box,
.pricing-block-two .pricing-table,
.pricing-block-two:hover .pricing-table .table-footer a,
.pricing-block-two .pricing-table .choice-box,
.rtl .main-header.style-four .menu-area .btn-box a,
#content_block_16 .content-box .download-btn a,
.rtl .main-header.style-four .menu-right-content .nav-btn .icon,
.enterprise-section .single-item .inner-box h3:before,
#content_block_20 .content-box .btn-box a:before,
.banner-style-eight .content-box .btn-box .btn-one:hover,
.banner-style-eight .content-box .btn-box .btn-one:before,
.testimonial-style-eight .owl-theme .owl-dots .owl-dot.active span, 
.testimonial-style-eight .owl-theme .owl-dots .owl-dot span:hover,
.betterlook-section .anim-icons .icon-2,
.testimonial-style-ten .owl-theme .owl-dots .owl-dot.active span, 
.testimonial-style-ten .owl-theme .owl-dots .owl-dot span:hover,
.organization-section .single-item .inner-box h4:before,
.banner-style-11 .content-box .btn-box .btn-one:hover,
.banner-style-11 .content-box .btn-box .btn-one:before,
.main-footer .footer-top .widget-title:before,
.banner-style-13 .content-box .mail-box .form-group button,
.testimonial-style-12 .owl-theme .owl-dots .owl-dot.active span, 
.testimonial-style-12 .owl-theme .owl-dots .owl-dot span:hover,
.testimonial-style-12 .testimonial-content .inner-box .icon-box,
.counter-style-three .inner-box:before,
.work-section .single-item .inner-box h3:before,
.work-section .single-item .inner-box .link-btn a,
.banner-style-15 .content-box .btn-box .video-btn:hover,
.banner-style-15 .content-box .btn-box .video-btn i,
.banner-style-15 .content-box .btn-box .btn-one:hover,
.banner-style-15 .content-box .btn-box .btn-one:before,
.news-block-two .inner-box .lower-content:before,
.news-block-two .inner-box .image-box,
#content_block_43 .content-box .estimate-form .btn-box button,
.banner-style-17 .content-box .mail-box .form-group button,
#content_block_43 .content-box .estimate-form .btn-box button:hover i,
.news-block-three .inner-box .lower-content:before,
#content_block_51 .content-box .donation-box .btn-box button:hover,
#content_block_51 .content-box .donation-box .btn-box button:before,
#content_block_51 .content-box .donation-box .btn-box a:hover,
#content_block_51 .content-box .donation-box .btn-box a:before,
.popular-causes,
.banner-style-19 .content-box .btn-box a:before,
.banner-style-19 .content-box .btn-box a.btn-two:hover,
.banner-style-19 .content-box .btn-box a:before,
#content_block_48 .inner-box .single-item:hover,
.ui-selectmenu-open .ui-widget-content .ui-state-focus,
.banner-style-18 .content-box .btn-box a:hover,
.banner-style-18 .content-box .btn-box a:before,
.domain-section .search-form .form-group button,
.best-hosting.alternate-2 .single-item .inner-box:before,
.best-hosting .single-item:hover .link-btn a,
.service-style-four .service-block-three .inner-box .link-btn a,
#content_block_45 .content-box .btn-box a:hover,
#content_block_45 .content-box .btn-box a:after,
.testimonial-style-four .owl-theme .owl-dots .owl-dot.active span, 
.testimonial-style-four .owl-theme .owl-dots .owl-dot span:hover,
#content_block_44 .content-box .btn-box .theme-btn,
.banner-style-12 .content-box .btn-box .btn-two:before,
.banner-style-12 .content-box .btn-box .btn-two:hover,
.banner-style-12 .content-box .btn-box .btn-one,
.banner-style-12 .content-box .btn-box .btn-two:hover,
.banner-style-12 .content-box .btn-box .btn-two:before,
.banner-style-12 .content-box .btn-box .btn-one,
.userfree-section .content-box .btn-box a:hover,
.userfree-section .content-box .btn-box a:before,
.team-block-three .inner-box .image-box,
.banner-style-two .anim-icons .icon-1,
.service-block-one:hover .inner-box,
.image_block_06 .image-box .image, 
.image_block_07 .image-box .image, 
.image_block_08 .image-box .image, 
.image_block_09 .image-box .image, 
.image_block_10 .image-box .image,
.management-section,
.management-section .tabs-content .image-box,
.banner-style-two .anim-icons .icon-1,
.service-block-one:hover .inner-box,
.image_block_06 .image-box .image, 
.image_block_07 .image-box .image, 
.image_block_08 .image-box .image, 
.image_block_09 .image-box .image, 
.image_block_10 .image-box .image,
.management-section,
.management-section .tabs-content .image-box,
.main-header.style-three .header-top,
.pricing-style-three .tab-btn-box .tab-btns li:before,
.banner-style-six .content-box .mail-box .form-group button,
.recruitment-section .btn-box a:hover,
.recruitment-section .btn-box a:before,
.industries-service .inner-content .btn-box a:hover,
.industries-service .inner-content .btn-box a:before,
.video-style-two .video-inner,
.testimonial-style-six .owl-nav .owl-prev:before,
.check-work .inner-box .check-form .form-group button,
.image_block_32 .image-box,
.designe-process-two .tab-btn-box .tab-btns li.active-btn, 
.designe-process-two .tab-btn-box .tab-btns li:hover,
.designe-process-three .owl-nav .owl-next:hover, 
.designe-process-three .owl-nav .owl-prev:hover,
.feature-block-two:hover .inner-box,
.awesome-features .owl-theme .owl-dots .owl-dot.active span, 
.awesome-features .owl-theme .owl-dots .owl-dot span:hover,
.userfree-section,
.subscribe-style-three .subscribe-form .form-group:before,
.subscribe-style-three .subscribe-form .form-group button,
.team-section .owl-theme .owl-dots .owl-dot.active span, 
.team-section .owl-theme .owl-dots .owl-dot span:hover,
.testimonial-style-nine.home-18 .owl-nav .owl-prev:hover, 
.testimonial-style-nine.home-18 .owl-nav .owl-next:hover,
.designe-process-three.alternate-2 .owl-nav .owl-next:hover, 
.designe-process-three.alternate-2 .owl-nav .owl-prev:hover,
.team-block-two .content-box span,
.team-block-two .image-box,
.service-details .service-sidebar .sidebar .list li:before,
.portfolio-block-one .image-box,
.portfolio-details .image-content .image,
.sidebar-search .form-group button,
.sidebar-title:before,
.tagcloud a:hover,
.sidebar-page-container .blog-content .single-blog-content .image-box,
.sidebar-page-container .blog-content .single-blog-content .lower-content .lower-box .right-content a i,
.single_cat a,
#commentform .submit.theme-btn.style-four

{
	background: #<?php echo esc_attr( $color ); ?>!important;
	background-color:#<?php echo esc_attr( $color ); ?>!important;
}


/*==============================================
   Theme Border Color Css
===============================================*/

.theme-btn,
.pricing-block-one:hover .pricing-table,
.pricing-section .tab-btn-box .tab-btns:before,
.news-block-one .inner-box .lower-content .link-btn a,
#content_block_06 .content-box .subscribe-form .form-group input:focus,
.clients-section .owl-theme .owl-dots .owl-dot.active span,
.main-header .menu-area .btn-box a:before,
.main-header .menu-area .btn-box a:after,
.banner-style-13 .content-box .mail-box .form-group input[type='email'],
.banner-style-15 .content-box .btn-box .btn-one,
#content_block_43 .content-box .estimate-form .btn-box button,
.banner-style-19 .content-box .btn-box a.btn-two:hover,
.domain-section .search-form .form-group input:focus,
#content_block_41 .content-box .subscribe-form .form-group input:focus,
.pricing-style-three .tab-btn-box .tab-btns:before,
.main-header .menu-area .btn-box a:before,
.main-header .menu-area .btn-box a:after,
.banner-style-six .content-box .mail-box .form-group input[type='email'],
.check-work .inner-box .check-form .form-group,
.banner-style-14 .content-box .mail-box .form-group input[type='email'],
.subscribe-style-three .subscribe-form .form-group button,
.testimonial-style-nine.home-18 .owl-nav .owl-prev:hover, 
.testimonial-style-nine.home-18 .owl-nav .owl-next:hover,
.designe-process-three.alternate-2 .owl-nav .owl-next, 
.designe-process-three.alternate-2 .owl-nav .owl-prev,
.faq-section .faq-sidebar .online-purchase a,
.tagcloud a:hover,
.sidebar-page-container .blog-content .single-blog-content .inner-box,
blockquote,
.sidebar-page-container .blog-single-content .post-details,
.contact-section .contact-form-area .form-inner .form-group input:focus, 
.contact-section .contact-form-area .form-inner .form-group textarea:focus

{
    border-color: #<?php echo esc_attr( $color ); ?>!important;  
}

/*==============================================
   RGB
===============================================*/

.video-galler-outer-bg:before {
    background-color: <?php echo esc_attr( hex2rgba($color, 0.9));?>!important;
}

.main-slider .content h3:before,
#video_block_01 .video-inner a

{
    background: <?php echo esc_attr( hex2rgba($color, 0.4));?>!important;
}




<?php 

$out = ob_get_clean();
$expires_offset = 31536000; // 1 year
header('Content-Type: text/css; charset=UTF-8');
header('Expires: ' . gmdate( "D, d M Y H:i:s", time() + $expires_offset ) . ' GMT');
header("Cache-Control: public, max-age=$expires_offset");
header('Vary: Accept-Encoding'); // Handle proxies
header('Content-Encoding: gzip');

echo gzencode($out);
exit;