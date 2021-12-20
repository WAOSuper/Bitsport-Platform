<?php
// search  899
//Header 1
$top_header_show_v1=array(
			'id'      => 'top_header_show_v1',
			'type'    => 'switch',
			'title'   => esc_html__( 'Top Header Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Top Header Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
		);
				
$welcome_v1 = array(
		    'id'       => 'welcome_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Welcome 1', 'appway' ),
		    'desc'     => esc_html__( 'Enter Welcome 1', 'appway' ),
			'default'  => esc_html__( 'Welcome to Us', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    );
$about_v1 = array(
		    'id'       => 'about_v1',
		    'type'     => 'textarea',
		    'title'    => esc_html__( 'About Text', 'appway' ),
		    'desc'     => esc_html__( 'Enter Welcome 1', 'appway' ),
			'default'  => esc_html__( 'We are Best', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    );		

$email_title_v1= array(
		    'id'       => 'email_title_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'E-mail Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter E-mail Title', 'appway' ),
			'default'  => esc_html__( 'e-mail us', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    );
$email_v1= array(
		    'id'       => 'email_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'E-mail Address', 'appway' ),
		    'desc'     => esc_html__( 'Enter E-mail Address', 'appway' ),
			'default'  => esc_html__( 'e-mail us', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    );
$address_title_v1= array(
		    'id'       => 'address_title_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Address Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Address Title', 'appway' ),
			'default'  => esc_html__( 'Our Address', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    );
$address_v1= array(
		    'id'       => 'address_v1',
		    'type'     => 'textarea',
		    'title'    => esc_html__( 'Address 1st Line', 'appway' ),
		    'desc'     => esc_html__( 'Enter Address 1st Line', 'appway' ),
			'default'  => esc_html__( 'House 35 R/A,Street', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    );
$address2nd_v1= array(
		    'id'       => 'address2nd_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Address 2nd Line', 'appway' ),
		    'desc'     => esc_html__( 'Enter Address 2nd Line', 'appway' ),
			'default'  => esc_html__( 'Sydney Australia', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    );
$phone_title_v1= array(
		    'id'       => 'phone_title_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Phone Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Text of Phone', 'appway' ),
			'default'  => esc_html__( 'Call Us', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    );
$phone_v1= array(
		    'id'       => 'phone_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Phone Number', 'appway' ),
		    'desc'     => esc_html__( 'Enter Number', 'appway' ),
			'default'  => esc_html__( '+357 984538', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    );
$time_title_v1 = array(
		    'id'       => 'time_title_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Time Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Time Title', 'appway' ),
			'default'  => esc_html__( 'We are Open', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    );
$open_time_v1= array(
		    'id'       => 'open_time_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Open Time', 'appway' ),
		    'desc'     => esc_html__( 'Enter Time Office', 'appway' ),
			'default'  => esc_html__( 'Every day 9:00am -6:00pm', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    );
$close_time_v1= array(
		    'id'       => 'close_time_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Close Time', 'appway' ),
		    'desc'     => esc_html__( 'Enter Close Office', 'appway' ),
			'default'  => esc_html__( 'We are close Sunday', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    );
$quote_show_v1=array(
			'id'      => 'quote_show_v1',
			'type'    => 'switch',
			'title'   => esc_html__( 'Quote Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Quote Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
		);
$quote_v1= array(
		    'id'       => 'quote_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Quote Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Quote Title', 'appway' ),
			'default'  => esc_html__( 'Get Quote', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    );
	
$quote_link_v1=array(
		    'id'       => 'quote_link_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Quote Link', 'appway' ),
		    'desc'     => esc_html__( 'Enter The Quote Link', 'appway' ),
			'default'  => esc_html__( '#', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    );
$button_show_v1=array(
			'id'      => 'button_show_v1',
			'type'    => 'switch',
			'title'   => esc_html__( 'Button Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Button Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
		);
$button_v1= array(
		    'id'       => 'button_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Button Title', 'appway' ),
			'default'  => esc_html__( 'Sing Up', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    );
$shop_button_v1= array(
	'id'       => 'shop_button_v1',
	'type'     => 'text',
	'title'    => esc_html__( 'Shop Button Title', 'appway' ),
	'desc'     => esc_html__( 'Enter Button Title', 'appway' ),
	'default'  => esc_html__( '2', 'appway' ),
	'required' => array( 'header_style_settings', '=', 'header_v1' ),
);
$button_link_v1=array(
		    'id'       => 'button_link_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Link', 'appway' ),
		    'desc'     => esc_html__( 'Enter The Button Link', 'appway' ),
			'default'  => esc_html__( '#', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    );

$login_show_v1=array(
			'id'      => 'login_show_v1',
			'type'    => 'switch',
			'title'   => esc_html__( 'Login Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Login Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
		);
$login_v1= array(
		    'id'       => 'login_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Login Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Login Title', 'appway' ),
			'default'  => esc_html__( 'Login', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    );
$login_link_v1=array(
		    'id'       => 'login_link_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Login Link', 'appway' ),
		    'desc'     => esc_html__( 'Enter The Login Link', 'appway' ),
			'default'  => esc_html__( '#', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    );
$download_show_v1=array(
			'id'      => 'download_show_v1',
			'type'    => 'switch',
			'title'   => esc_html__( 'Download Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Download Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
		);
$download_v1= array(
		    'id'       => 'download_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Download Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Download Title', 'appway' ),
			'default'  => esc_html__( 'Download', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    );
$download_link_v1=array(
		    'id'       => 'download_link_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Download Link', 'appway' ),
		    'desc'     => esc_html__( 'Enter The Download Link', 'appway' ),
			'default'  => esc_html__( '#', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    );			
		
$header_social_show_v1=array(
			'id'      => 'header_social_show_v1',
			'type'    => 'switch',
			'title'   => esc_html__( 'Social Icon Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Social Icon Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
		);
$socialtitle_v1	= array(
		    'id'       => 'socialtitle_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Social Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Social Title', 'appway' ),
			'default'  => esc_html__( 'Share', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    );
$header_social_v1= array(
			'id'    => 'header_social_v1',
			'type'  => 'social_media',
			'title' => esc_html__( 'Social Profiles', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
		);
$shop_show_v1=array(
			'id'      => 'shop_show_v1',
			'type'    => 'switch',
			'title'   => esc_html__( 'Shop Button Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Shop Button Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
		);
$shop_link_v1=array(
		    'id'       => 'shop_link_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Shop Link', 'appway' ),
		    'desc'     => esc_html__( 'Enter The Shop Link', 'appway' ),
			'default'  => esc_html__( '#', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    );
$header_search_show_v1=array(
			'id'      => 'header_search_show_v1',
			'type'    => 'switch',
			'title'   => esc_html__( 'Search Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Search Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
		);
$search_text_v1= array(
		    'id'       => 'search_text_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Search Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Search Title', 'appway' ),
			'default'  => esc_html__( 'Search...', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    );	

//Header Style 2 area============
//Header 2
$top_header_show_v2=array(
			'id'      => 'top_header_show_v2',
			'type'    => 'switch',
			'title'   => esc_html__( 'Top Header Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Top Header Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
		);
				
$welcome_v2 = array(
		    'id'       => 'welcome_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Welcome', 'appway' ),
		    'desc'     => esc_html__( 'Enter Welcome', 'appway' ),
			'default'  => esc_html__( 'Welcome to Us', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    );
$about_v2 = array(
		    'id'       => 'about_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'About Text', 'appway' ),
		    'desc'     => esc_html__( 'Enter Welcome 1', 'appway' ),
			'default'  => esc_html__( 'We are Best', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    );		

$email_title_v2= array(
		    'id'       => 'email_title_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'E-mail Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter E-mail Title', 'appway' ),
			'default'  => esc_html__( 'e-mail us', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    );
$email_v2= array(
		    'id'       => 'email_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'E-mail Address', 'appway' ),
		    'desc'     => esc_html__( 'Enter E-mail Address', 'appway' ),
			'default'  => esc_html__( 'e-mail us', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    );
$address_title_v2= array(
		    'id'       => 'address_title_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Address Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Address Title', 'appway' ),
			'default'  => esc_html__( 'Our Address', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    );
$address_v2= array(
		    'id'       => 'address_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Address 1st Line', 'appway' ),
		    'desc'     => esc_html__( 'Enter Address 1st Line', 'appway' ),
			'default'  => esc_html__( 'House 35 R/A,Street', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    );
$address2nd_v2= array(
		    'id'       => 'address2nd_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Address 2nd Line', 'appway' ),
		    'desc'     => esc_html__( 'Enter Address 2nd Line', 'appway' ),
			'default'  => esc_html__( 'Sydney Australia', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    );
$phone_title_v2= array(
		    'id'       => 'phone_title_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Phone Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Text of Phone', 'appway' ),
			'default'  => esc_html__( 'Call Us', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    );
$phone_v2= array(
		    'id'       => 'phone_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Phone Number', 'appway' ),
		    'desc'     => esc_html__( 'Enter Number', 'appway' ),
			'default'  => esc_html__( '+357 984538', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    );
$time_title_v2 = array(
		    'id'       => 'time_title_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Time Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Time Title', 'appway' ),
			'default'  => esc_html__( 'We are Open', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    );
$open_time_v2= array(
		    'id'       => 'open_time_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Open Time', 'appway' ),
		    'desc'     => esc_html__( 'Enter Time Office', 'appway' ),
			'default'  => esc_html__( 'Every day 9:00am -6:00pm', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    );
$close_time_v2= array(
		    'id'       => 'close_time_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Close Time', 'appway' ),
		    'desc'     => esc_html__( 'Enter Close Office', 'appway' ),
			'default'  => esc_html__( 'We are close Sunday', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    );
$quote_show_v2=array(
			'id'      => 'quote_show_v2',
			'type'    => 'switch',
			'title'   => esc_html__( 'Quote Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Quote Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
		);
$quote_v2= array(
		    'id'       => 'quote_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Quote Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Quote Title', 'appway' ),
			'default'  => esc_html__( 'Get Quote', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    );
	
$quote_link_v2=array(
		    'id'       => 'quote_link_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Quote Link', 'appway' ),
		    'desc'     => esc_html__( 'Enter The Quote Link', 'appway' ),
			'default'  => esc_html__( '#', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    );
$button_show_v2=array(
			'id'      => 'button_show_v2',
			'type'    => 'switch',
			'title'   => esc_html__( 'Button Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Button Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
		);
$button_v2= array(
		    'id'       => 'button_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Button Title', 'appway' ),
			'default'  => esc_html__( 'Sing Up', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    );
$button_link_v2=array(
		    'id'       => 'button_link_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Link', 'appway' ),
		    'desc'     => esc_html__( 'Enter The Button Link', 'appway' ),
			'default'  => esc_html__( '#', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    );

$login_show_v2=array(
			'id'      => 'login_show_v2',
			'type'    => 'switch',
			'title'   => esc_html__( 'Login Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Login Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
		);
$login_v2= array(
		    'id'       => 'login_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Login Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Login Title', 'appway' ),
			'default'  => esc_html__( 'Login', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    );
$login_link_v2=array(
		    'id'       => 'login_link_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Login Link', 'appway' ),
		    'desc'     => esc_html__( 'Enter The Login Link', 'appway' ),
			'default'  => esc_html__( '#', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    );
$download_show_v2=array(
			'id'      => 'download_show_v2',
			'type'    => 'switch',
			'title'   => esc_html__( 'Download Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Download Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
		);
$download_v2= array(
		    'id'       => 'download_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Download Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Download Title', 'appway' ),
			'default'  => esc_html__( 'Download', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    );
$download_link_v2=array(
		    'id'       => 'download_link_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Download Link', 'appway' ),
		    'desc'     => esc_html__( 'Enter The Download Link', 'appway' ),
			'default'  => esc_html__( '#', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    );			
		
$header_social_show_v2=array(
			'id'      => 'header_social_show_v2',
			'type'    => 'switch',
			'title'   => esc_html__( 'Social Icon Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Social Icon Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
		);
$socialtitle_v2	= array(
		    'id'       => 'socialtitle_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Social Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Social Title', 'appway' ),
			'default'  => esc_html__( 'Share', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    );
$header_social_v2= array(
			'id'    => 'header_social_v2',
			'type'  => 'social_media',
			'title' => esc_html__( 'Social Profiles', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
		);
$shop_show_v2=array(
			'id'      => 'shop_show_v2',
			'type'    => 'switch',
			'title'   => esc_html__( 'Shop Button Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Shop Button Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
		);
$shop_link_v2=array(
		    'id'       => 'shop_link_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Shop Link', 'appway' ),
		    'desc'     => esc_html__( 'Enter The Shop Link', 'appway' ),
			'default'  => esc_html__( '#', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    );
$header_search_show_v2=array(
			'id'      => 'header_search_show_v2',
			'type'    => 'switch',
			'title'   => esc_html__( 'Search Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Search Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
		);
$search_text_v2= array(
		    'id'       => 'search_text_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Search Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Search Title', 'appway' ),
			'default'  => esc_html__( 'Search...', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    );		
//Header 1
$top_header_show_v3=array(
			'id'      => 'top_header_show_v3',
			'type'    => 'switch',
			'title'   => esc_html__( 'Top Header Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Top Header Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
		);
				
$welcome_v3 = array(
		    'id'       => 'welcome_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Welcome 1', 'appway' ),
		    'desc'     => esc_html__( 'Enter Welcome 1', 'appway' ),
			'default'  => esc_html__( 'Welcome to Us', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
	    );
$about_v3 = array(
		    'id'       => 'about_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'About Text', 'appway' ),
		    'desc'     => esc_html__( 'Enter Welcome 1', 'appway' ),
			'default'  => esc_html__( 'We are Best', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
	    );		

$email_title_v3= array(
		    'id'       => 'email_title_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'E-mail Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter E-mail Title', 'appway' ),
			'default'  => esc_html__( 'e-mail us', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
	    );
$email_v3= array(
		    'id'       => 'email_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'E-mail Address', 'appway' ),
		    'desc'     => esc_html__( 'Enter E-mail Address', 'appway' ),
			'default'  => esc_html__( 'e-mail us', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
	    );
$address_title_v3= array(
		    'id'       => 'address_title_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Address Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Address Title', 'appway' ),
			'default'  => esc_html__( 'Our Address', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
	    );
$address_v3= array(
		    'id'       => 'address_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Address 1st Line', 'appway' ),
		    'desc'     => esc_html__( 'Enter Address 1st Line', 'appway' ),
			'default'  => esc_html__( 'House 35 R/A,Street', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
	    );
$address2nd_v3= array(
		    'id'       => 'address2nd_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Address 2nd Line', 'appway' ),
		    'desc'     => esc_html__( 'Enter Address 2nd Line', 'appway' ),
			'default'  => esc_html__( 'Sydney Australia', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
	    );
$phone_title_v3= array(
		    'id'       => 'phone_title_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Phone Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Text of Phone', 'appway' ),
			'default'  => esc_html__( 'Call Us', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
	    );
$phone_v3= array(
		    'id'       => 'phone_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Phone Number', 'appway' ),
		    'desc'     => esc_html__( 'Enter Number', 'appway' ),
			'default'  => esc_html__( '+357 984538', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
	    );
$time_title_v3 = array(
		    'id'       => 'time_title_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Time Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Time Title', 'appway' ),
			'default'  => esc_html__( 'We are Open', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
	    );
$open_time_v3= array(
		    'id'       => 'open_time_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Open Time', 'appway' ),
		    'desc'     => esc_html__( 'Enter Time Office', 'appway' ),
			'default'  => esc_html__( 'Every day 9:00am -6:00pm', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
	    );
$close_time_v3= array(
		    'id'       => 'close_time_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Close Time', 'appway' ),
		    'desc'     => esc_html__( 'Enter Close Office', 'appway' ),
			'default'  => esc_html__( 'We are close Sunday', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
	    );
$quote_show_v3=array(
			'id'      => 'quote_show_v3',
			'type'    => 'switch',
			'title'   => esc_html__( 'Quote Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Quote Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
		);
$quote_v3= array(
		    'id'       => 'quote_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Quote Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Quote Title', 'appway' ),
			'default'  => esc_html__( 'Get Quote', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
	    );
	
$quote_link_v3=array(
		    'id'       => 'quote_link_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Quote Link', 'appway' ),
		    'desc'     => esc_html__( 'Enter The Quote Link', 'appway' ),
			'default'  => esc_html__( '#', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
	    );
$button_show_v3=array(
			'id'      => 'button_show_v3',
			'type'    => 'switch',
			'title'   => esc_html__( 'Button Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Button Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
		);
$button_v3= array(
		    'id'       => 'button_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Button Title', 'appway' ),
			'default'  => esc_html__( 'Sing Up', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
	    );
$button_link_v3=array(
		    'id'       => 'button_link_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Link', 'appway' ),
		    'desc'     => esc_html__( 'Enter The Button Link', 'appway' ),
			'default'  => esc_html__( '#', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
	    );

$login_show_v3=array(
			'id'      => 'login_show_v3',
			'type'    => 'switch',
			'title'   => esc_html__( 'Login Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Login Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
		);
$login_v3= array(
		    'id'       => 'login_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Login Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Login Title', 'appway' ),
			'default'  => esc_html__( 'Login', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
	    );
$login_link_v3=array(
		    'id'       => 'login_link_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Login Link', 'appway' ),
		    'desc'     => esc_html__( 'Enter The Login Link', 'appway' ),
			'default'  => esc_html__( '#', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
	    );
$download_show_v3=array(
			'id'      => 'download_show_v3',
			'type'    => 'switch',
			'title'   => esc_html__( 'Download Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Download Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
		);
$download_v3= array(
		    'id'       => 'download_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Download Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Download Title', 'appway' ),
			'default'  => esc_html__( 'Download', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
	    );
$download_link_v3=array(
		    'id'       => 'download_link_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Download Link', 'appway' ),
		    'desc'     => esc_html__( 'Enter The Download Link', 'appway' ),
			'default'  => esc_html__( '#', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
	    );			
		
$header_social_show_v3=array(
			'id'      => 'header_social_show_v3',
			'type'    => 'switch',
			'title'   => esc_html__( 'Social Icon Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Social Icon Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
		);
$socialtitle_v3	= array(
		    'id'       => 'socialtitle_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Social Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Social Title', 'appway' ),
			'default'  => esc_html__( 'Share', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
	    );
$header_social_v3= array(
			'id'    => 'header_social_v3',
			'type'  => 'social_media',
			'title' => esc_html__( 'Social Profiles', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
		);
$shop_show_v3=array(
			'id'      => 'shop_show_v3',
			'type'    => 'switch',
			'title'   => esc_html__( 'Shop Button Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Shop Button Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
		);
$shop_link_v3=array(
		    'id'       => 'shop_link_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Shop Link', 'appway' ),
		    'desc'     => esc_html__( 'Enter The Shop Link', 'appway' ),
			'default'  => esc_html__( '#', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
	    );
$header_search_show_v3=array(
			'id'      => 'header_search_show_v3',
			'type'    => 'switch',
			'title'   => esc_html__( 'Search Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Search Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
		);
$search_text_v3= array(
		    'id'       => 'search_text_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Search Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Search Title', 'appway' ),
			'default'  => esc_html__( 'Search...', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
	    );
//Header 1
$top_header_show_v4=array(
			'id'      => 'top_header_show_v4',
			'type'    => 'switch',
			'title'   => esc_html__( 'Top Header Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Top Header Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
		);
				
$welcome_v4 = array(
		    'id'       => 'welcome_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Welcome 1', 'appway' ),
		    'desc'     => esc_html__( 'Enter Welcome 1', 'appway' ),
			'default'  => esc_html__( 'Welcome to Us', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
	    );
$about_v4 = array(
		    'id'       => 'about_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'About Text', 'appway' ),
		    'desc'     => esc_html__( 'Enter Welcome 1', 'appway' ),
			'default'  => esc_html__( 'We are Best', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
	    );		

$email_title_v4= array(
		    'id'       => 'email_title_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'E-mail Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter E-mail Title', 'appway' ),
			'default'  => esc_html__( 'e-mail us', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
	    );
$email_v4= array(
		    'id'       => 'email_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'E-mail Address', 'appway' ),
		    'desc'     => esc_html__( 'Enter E-mail Address', 'appway' ),
			'default'  => esc_html__( 'e-mail us', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
	    );
$address_title_v4= array(
		    'id'       => 'address_title_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Address Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Address Title', 'appway' ),
			'default'  => esc_html__( 'Our Address', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
	    );
$address_v4= array(
		    'id'       => 'address_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Address 1st Line', 'appway' ),
		    'desc'     => esc_html__( 'Enter Address 1st Line', 'appway' ),
			'default'  => esc_html__( 'House 35 R/A,Street', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
	    );
$address2nd_v4= array(
		    'id'       => 'address2nd_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Address 2nd Line', 'appway' ),
		    'desc'     => esc_html__( 'Enter Address 2nd Line', 'appway' ),
			'default'  => esc_html__( 'Sydney Australia', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
	    );
$phone_title_v4= array(
		    'id'       => 'phone_title_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Phone Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Text of Phone', 'appway' ),
			'default'  => esc_html__( 'Call Us', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
	    );
$phone_v4= array(
		    'id'       => 'phone_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Phone Number', 'appway' ),
		    'desc'     => esc_html__( 'Enter Number', 'appway' ),
			'default'  => esc_html__( '+357 984538', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
	    );
$time_title_v4 = array(
		    'id'       => 'time_title_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Time Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Time Title', 'appway' ),
			'default'  => esc_html__( 'We are Open', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
	    );
$open_time_v4= array(
		    'id'       => 'open_time_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Open Time', 'appway' ),
		    'desc'     => esc_html__( 'Enter Time Office', 'appway' ),
			'default'  => esc_html__( 'Every day 9:00am -6:00pm', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
	    );
$close_time_v4= array(
		    'id'       => 'close_time_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Close Time', 'appway' ),
		    'desc'     => esc_html__( 'Enter Close Office', 'appway' ),
			'default'  => esc_html__( 'We are close Sunday', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
	    );
$quote_show_v4=array(
			'id'      => 'quote_show_v4',
			'type'    => 'switch',
			'title'   => esc_html__( 'Quote Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Quote Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
		);
$quote_v4= array(
		    'id'       => 'quote_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Quote Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Quote Title', 'appway' ),
			'default'  => esc_html__( 'Get Quote', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
	    );
	
$quote_link_v4=array(
		    'id'       => 'quote_link_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Quote Link', 'appway' ),
		    'desc'     => esc_html__( 'Enter The Quote Link', 'appway' ),
			'default'  => esc_html__( '#', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
	    );
$button_show_v4=array(
			'id'      => 'button_show_v4',
			'type'    => 'switch',
			'title'   => esc_html__( 'Button Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Button Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
		);
$button_v4= array(
		    'id'       => 'button_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Button Title', 'appway' ),
			'default'  => esc_html__( 'Sing Up', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
	    );
$button_link_v4=array(
		    'id'       => 'button_link_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Link', 'appway' ),
		    'desc'     => esc_html__( 'Enter The Button Link', 'appway' ),
			'default'  => esc_html__( '#', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
	    );

$login_show_v4=array(
			'id'      => 'login_show_v4',
			'type'    => 'switch',
			'title'   => esc_html__( 'Login Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Login Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
		);
$login_v4= array(
		    'id'       => 'login_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Login Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Login Title', 'appway' ),
			'default'  => esc_html__( 'Login', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
	    );
$login_link_v4=array(
		    'id'       => 'login_link_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Login Link', 'appway' ),
		    'desc'     => esc_html__( 'Enter The Login Link', 'appway' ),
			'default'  => esc_html__( '#', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
	    );
$download_show_v4=array(
			'id'      => 'download_show_v4',
			'type'    => 'switch',
			'title'   => esc_html__( 'Download Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Download Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
		);
$download_v4= array(
		    'id'       => 'download_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Download Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Download Title', 'appway' ),
			'default'  => esc_html__( 'Download', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
	    );
$download_link_v4=array(
		    'id'       => 'download_link_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Download Link', 'appway' ),
		    'desc'     => esc_html__( 'Enter The Download Link', 'appway' ),
			'default'  => esc_html__( '#', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
	    );			
		
$header_social_show_v4=array(
			'id'      => 'header_social_show_v4',
			'type'    => 'switch',
			'title'   => esc_html__( 'Social Icon Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Social Icon Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
		);
$socialtitle_v4	= array(
		    'id'       => 'socialtitle_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Social Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Social Title', 'appway' ),
			'default'  => esc_html__( 'Share', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
	    );
$header_social_v4= array(
			'id'    => 'header_social_v4',
			'type'  => 'social_media',
			'title' => esc_html__( 'Social Profiles', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
		);
$shop_show_v4=array(
			'id'      => 'shop_show_v4',
			'type'    => 'switch',
			'title'   => esc_html__( 'Shop Button Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Shop Button Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
		);
$shop_link_v4=array(
		    'id'       => 'shop_link_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Shop Link', 'appway' ),
		    'desc'     => esc_html__( 'Enter The Shop Link', 'appway' ),
			'default'  => esc_html__( '#', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
	    );
$header_search_show_v4=array(
			'id'      => 'header_search_show_v4',
			'type'    => 'switch',
			'title'   => esc_html__( 'Search Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Search Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
		);
$search_text_v4= array(
		    'id'       => 'search_text_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Search Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Search Title', 'appway' ),
			'default'  => esc_html__( 'Search...', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
	    );
//Header 1
$top_header_show_v5=array(
			'id'      => 'top_header_show_v5',
			'type'    => 'switch',
			'title'   => esc_html__( 'Top Header Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Top Header Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
		);
				
$welcome_v5 = array(
		    'id'       => 'welcome_v5',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Welcome 1', 'appway' ),
		    'desc'     => esc_html__( 'Enter Welcome 1', 'appway' ),
			'default'  => esc_html__( 'Welcome to Us', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
	    );
$about_v5 = array(
		    'id'       => 'about_v5',
		    'type'     => 'text',
		    'title'    => esc_html__( 'About Text', 'appway' ),
		    'desc'     => esc_html__( 'Enter Welcome 1', 'appway' ),
			'default'  => esc_html__( 'We are Best', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
	    );		

$email_title_v5= array(
		    'id'       => 'email_title_v5',
		    'type'     => 'text',
		    'title'    => esc_html__( 'E-mail Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter E-mail Title', 'appway' ),
			'default'  => esc_html__( 'e-mail us', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
	    );
$email_v5= array(
		    'id'       => 'email_v5',
		    'type'     => 'text',
		    'title'    => esc_html__( 'E-mail Address', 'appway' ),
		    'desc'     => esc_html__( 'Enter E-mail Address', 'appway' ),
			'default'  => esc_html__( 'e-mail us', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
	    );
$address_title_v5= array(
		    'id'       => 'address_title_v5',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Address Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Address Title', 'appway' ),
			'default'  => esc_html__( 'Our Address', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
	    );
$address_v5= array(
		    'id'       => 'address_v5',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Address 1st Line', 'appway' ),
		    'desc'     => esc_html__( 'Enter Address 1st Line', 'appway' ),
			'default'  => esc_html__( 'House 35 R/A,Street', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
	    );
$address2nd_v5= array(
		    'id'       => 'address2nd_v5',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Address 2nd Line', 'appway' ),
		    'desc'     => esc_html__( 'Enter Address 2nd Line', 'appway' ),
			'default'  => esc_html__( 'Sydney Australia', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
	    );
$phone_title_v5= array(
		    'id'       => 'phone_title_v5',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Phone Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Text of Phone', 'appway' ),
			'default'  => esc_html__( 'Call Us', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
	    );
$phone_v5= array(
		    'id'       => 'phone_v5',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Phone Number', 'appway' ),
		    'desc'     => esc_html__( 'Enter Number', 'appway' ),
			'default'  => esc_html__( '+357 984538', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
	    );
$time_title_v5 = array(
		    'id'       => 'time_title_v5',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Time Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Time Title', 'appway' ),
			'default'  => esc_html__( 'We are Open', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
	    );
$open_time_v5= array(
		    'id'       => 'open_time_v5',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Open Time', 'appway' ),
		    'desc'     => esc_html__( 'Enter Time Office', 'appway' ),
			'default'  => esc_html__( 'Every day 9:00am -6:00pm', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
	    );
$close_time_v5= array(
		    'id'       => 'close_time_v5',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Close Time', 'appway' ),
		    'desc'     => esc_html__( 'Enter Close Office', 'appway' ),
			'default'  => esc_html__( 'We are close Sunday', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
	    );
$quote_show_v5=array(
			'id'      => 'quote_show_v5',
			'type'    => 'switch',
			'title'   => esc_html__( 'Quote Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Quote Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
		);
$quote_v5= array(
		    'id'       => 'quote_v5',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Quote Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Quote Title', 'appway' ),
			'default'  => esc_html__( 'Get Quote', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
	    );
	
$quote_link_v5=array(
		    'id'       => 'quote_link_v5',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Quote Link', 'appway' ),
		    'desc'     => esc_html__( 'Enter The Quote Link', 'appway' ),
			'default'  => esc_html__( '#', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
	    );
$button_show_v5=array(
			'id'      => 'button_show_v5',
			'type'    => 'switch',
			'title'   => esc_html__( 'Button Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Button Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
		);
$button_v5= array(
		    'id'       => 'button_v5',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Button Title', 'appway' ),
			'default'  => esc_html__( 'Sing Up', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
	    );
$button_link_v5=array(
		    'id'       => 'button_link_v5',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Link', 'appway' ),
		    'desc'     => esc_html__( 'Enter The Button Link', 'appway' ),
			'default'  => esc_html__( '#', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
	    );

$login_show_v5=array(
			'id'      => 'login_show_v5',
			'type'    => 'switch',
			'title'   => esc_html__( 'Login Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Login Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
		);
$login_v5= array(
		    'id'       => 'login_v5',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Login Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Login Title', 'appway' ),
			'default'  => esc_html__( 'Login', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
	    );
$login_link_v5=array(
		    'id'       => 'login_link_v5',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Login Link', 'appway' ),
		    'desc'     => esc_html__( 'Enter The Login Link', 'appway' ),
			'default'  => esc_html__( '#', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
	    );
$download_show_v5=array(
			'id'      => 'download_show_v5',
			'type'    => 'switch',
			'title'   => esc_html__( 'Download Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Download Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
		);
$download_v5= array(
		    'id'       => 'download_v5',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Download Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Download Title', 'appway' ),
			'default'  => esc_html__( 'Download', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
	    );
$download_link_v5=array(
		    'id'       => 'download_link_v5',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Download Link', 'appway' ),
		    'desc'     => esc_html__( 'Enter The Download Link', 'appway' ),
			'default'  => esc_html__( '#', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
	    );			
		
$header_social_show_v5=array(
			'id'      => 'header_social_show_v5',
			'type'    => 'switch',
			'title'   => esc_html__( 'Social Icon Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Social Icon Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
		);
$socialtitle_v5	= array(
		    'id'       => 'socialtitle_v5',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Social Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Social Title', 'appway' ),
			'default'  => esc_html__( 'Share', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
	    );
$header_social_v5= array(
			'id'    => 'header_social_v5',
			'type'  => 'social_media',
			'title' => esc_html__( 'Social Profiles', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
		);
$shop_show_v5=array(
			'id'      => 'shop_show_v5',
			'type'    => 'switch',
			'title'   => esc_html__( 'Shop Button Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Shop Button Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
		);
$shop_link_v5=array(
		    'id'       => 'shop_link_v5',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Shop Link', 'appway' ),
		    'desc'     => esc_html__( 'Enter The Shop Link', 'appway' ),
			'default'  => esc_html__( '#', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
	    );
$header_search_show_v5=array(
			'id'      => 'header_search_show_v5',
			'type'    => 'switch',
			'title'   => esc_html__( 'Search Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Search Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
		);
$search_text_v5= array(
		    'id'       => 'search_text_v5',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Search Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Search Title', 'appway' ),
			'default'  => esc_html__( 'Search...', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
	    );			

$header3_image1 = array(
			'id'       => 'header3_image1',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Header 3 Image 1', 'appway' ),
		);
$header3_image2 =array(
			'id'       => 'header3_image2',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Header 3 Image 2', 'appway' ),
		);
$header3_image3 =array(
			'id'       => 'header3_image3',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Header 3 Image 3', 'appway' ),
		);	
$header3_image4 =array(
			'id'       => 'header3_image4',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Header 3 Image 4', 'appway' ),
		);
$header3_image5 =array(
			'id'       => 'header3_image5',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Header 3 Image 5', 'appway' ),
		);
$header3_image6 =array(
			'id'       => 'header3_image6',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Header 3 Image 6', 'appway' ),
		);
$header3_image7 =array(
			'id'       => 'header3_image7',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Header 3 Image 7', 'appway' ),
		);		
//
$header2_image1 = array(
			'id'       => 'header2_image1',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Header 3 Image 1', 'appway' ),
		);
$header2_image2 =array(
			'id'       => 'header2_image2',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Header 3 Image 2', 'appway' ),
		);
$header2_image3 =array(
			'id'       => 'header2_image3',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Header 3 Image 3', 'appway' ),
		);	
$header2_image4 =array(
			'id'       => 'header2_image4',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Header 3 Image 4', 'appway' ),
		);
$header2_image5 =array(
			'id'       => 'header2_image5',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Header 3 Image 5', 'appway' ),
		);
//
$header1_image1 = array(
			'id'       => 'header1_image1',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Header 3 Image 1', 'appway' ),
		);
$header1_image2 =array(
			'id'       => 'header1_image2',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Header 3 Image 2', 'appway' ),
		);
$header1_image3 =array(
			'id'       => 'header1_image3',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Header 3 Image 3', 'appway' ),
		);	
$header1_image4 =array(
			'id'       => 'header1_image4',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Header 3 Image 4', 'appway' ),
		);
$header1_image5 =array(
			'id'       => 'header1_image5',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Header 3 Image 5', 'appway' ),
		);		
//PreDefine Area End==================

// Main Area 899
return array(
	'title'      => esc_html__( 'Header Setting', 'appway' ),
	'id'         => 'headers_setting',
	'desc'       => '',
	'subsection' => false,
	'fields'     => array(
		array(
			'id'      => 'header_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Header Source Type', 'appway' ),
			'options' => array(
				'd' => esc_html__( 'Default', 'appway' ),
				'e' => esc_html__( 'Elementor', 'appway' ),
			),
			'default' => 'd',
		),
		array(
			'id'       => 'header_elementor_template',
			'type'     => 'select',
			'title'    => __( 'Template', 'appway' ),
			'data'     => 'posts',
			'args'     => [
				'post_type' => [ 'elementor_library' ],
				'posts_per_page'	=> -1
			],
			'required' => [ 'header_source_type', '=', 'e' ],
		),
		array(
			'id'       => 'header_style_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Header Settings', 'appway' ),
			'required' => array( 'header_source_type', '=', 'd' ),
		),
		array(
		    'id'       => 'header_style_settings',
		    'type'     => 'image_select',
		    'title'    => esc_html__( 'Choose Header Styles', 'appway' ),
		    'subtitle' => esc_html__( 'Choose Header Styles', 'appway' ),
		    'options'  => array(

			    'header_v1'  => array(
				    'alt' => esc_html__( 'Header Style 1', 'appway' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/header/header1.png',
			    ),
			    'header_v2'  => array(
				    'alt' => esc_html__( 'Header Style 2', 'appway' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/header/header2.png',
			    ),
				'header_v3'  => array(
				    'alt' => esc_html__( 'Header Style 3', 'appway' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/header/header3.png',
			    ),
				
				'header_v4'  => array(
				    'alt' => esc_html__( 'Header Style 4', 'appway' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/header/header4.png',
			    ),
				'header_v5'  => array(
				    'alt' => esc_html__( 'Header Style 5', 'appway' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/header/header5.png',
			    ),
				'header_v6'  => array(
				    'alt' => esc_html__( 'Header Style 5', 'appway' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/header/header6.png',
			    ),
		
		
			),
			'required' => array( 'header_source_type', '=', 'd' ),
			'default' => 'header_v1',
	    ),			
		array(
			'id'       => 'header_v1_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Header Style One Settings', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
		),
		
		$email_v1,
		$time_title_v1,
		$welcome_v1,
		$login_v1,
		$login_link_v1,
		$phone_title_v1,
		$phone_v1,
		$quote_v1,
		$quote_link_v1,
		$about_v1,
		$address_v1,
	 array(
		    'id'       => 'sideabout_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Side Menu Title', 'appway' ),
		    'desc'     => esc_html__( 'About Us', 'appway' ),
			'default'  => esc_html__( 'We are Best', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    ),
	 array(
		    'id'       => 'sidetext_v1',
		    'type'     => 'textarea',
		    'title'    => esc_html__( 'Side Menu Text', 'appway' ),
		    'desc'     => esc_html__( 'Text', 'appway' ),
			'default'  => esc_html__( 'Welcome to Site', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    ),
	 array(
		    'id'       => 'sideaddresstitle_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Side Address Title', 'appway' ),
		    'desc'     => esc_html__( 'Address Info', 'appway' ),
			'default'  => esc_html__( 'Contact Info', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    ),		
		
		$header_social_show_v1,
		$header_social_v1,
		
	
		//Welcome
			//$top_header_show_v1,
			//$welcome_v1,
			//$about_v1,
		//Email	
			//$email_title_v1,
			//$email_v1,
		//Address	
			//$address_title_v1,
			//$address_v1,
			//$address2nd_v1,			
		//Phone	
			//$phone_title_v1,
			///$phone_v1,
		//Time	
			//$time_title_v1,
			//$open_time_v1,
			//$close_time_v1,
		//Quote	
		   //$quote_show_v1,
			//$quote_v1,
			//$quote_link_v1,
		//Button	
			//$button_show_v1,
			//$button_v1,
			//$button_link_v1,
		//login	
			//$login_show_v1,
			//$login_v1,
			//$login_link_v1,
		//download	
			//$download_show_v1,
			//$download_v1,
			//$download_link_v1,
		//Search
			//$header_search_show_v1,
			//$search_text_v1,	
		//Shop			
			//$shop_show_v1,
			//$shop_button_v1,
			//$shop_link_v1,
		//Header Social	
			//$header_social_show_v1,
			//$socialtitle_v1,
			//$header_social_v1,
		
		
		
			
		/***********************************************************************
								Header Version 2 Start
		************************************************************************/
		array(
			'id'       => 'header_v2_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Header Style Two Settings', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
		),
		$quote_v2,
		$quote_link_v2,
		$shop_link_v2,
		
			//$top_header_show_v2,
			
			//$about_v2,
		//Email	
			//$email_title_v2,
			
		//Address	
			//$address_title_v2,
			//$address_v2,
			//$address2nd_v2,			
		//Phone	
			
		//Time	
			
			//$open_time_v2,
			//$close_time_v2,
		//Quote	
			//$quote_show_v2,
			
		//Button	
			//$button_show_v2,
			//$button_v2,
			//$button_link_v2,
		//login	
			//$login_show_v2,
			
		//download	
			//$download_show_v2,
			//$download_v2,
			//$download_link_v2,	
		//Header Social	
			//$header_social_show_v2,
			//$socialtitle_v2,
			//$header_social_v2,
		//Shop			
			//$shop_show_v2,
			//$shop_link_v2,
		
		//Search
			//$header_search_show_v2,
			//$search_text_v2,
		
		/***********************************************************************
								Header Version 3 Start
		************************************************************************/
		array(
			'id'       => 'header_v3_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Header Style Three Settings', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
		),
		//Welcome
			//$top_header_show_v3,
			//$welcome_v3,
			//$about_v3,
		//Email	
			//$email_title_v3,
			$email_v3,
		//Address	
			//$address_title_v3,
			//$address_v3,
			//$address2nd_v3,			
		//Phone	
			//$phone_title_v3,
			$phone_v3,
		//Time	
			//$time_title_v3,
			//$open_time_v3,
			//$close_time_v3,
		//Quote	
			//$quote_show_v3,
			$quote_v3,
			$quote_link_v3,
		//Button	
			//$button_show_v3,
			//$button_v3,
			//$button_link_v3,
		//login	
			//$login_show_v3,
			$login_v3,
			$login_link_v3,
		//download	
			//$download_show_v3,
			$download_v3,
			$download_link_v3,	
		//Header Social	
			//$header_social_show_v3,
		    //$socialtitle_v3,
			//$header_social_v3,
		//Shop			
			//$shop_show_v3,
			//$shop_link_v3,
		//Search
			//$header_search_show_v3,
			//$search_text_v3,
		//Header Image
			//$header3_image1,
			//$header3_image2,
			//$header3_image3,
			//$header3_image4,
			//$header3_image5,
			//$header3_image6,
			//$header3_image7,
			
	/***********************************************************************
								Header Version 4 Start
		************************************************************************/
		array(
			'id'       => 'header_v4_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Header Style Four Settings', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
		),
		//Welcome
			//$top_header_show_v4,
			//$welcome_v4,
			//$about_v4,
		//Email	
			//$email_title_v4,
			//$email_v4,
		//Address	
			//$address_title_v4,
			//$address_v4,
			//$address2nd_v4,			
		//Phone	
			//$phone_title_v4,
			//$phone_v4,
		//Time	
			//$time_title_v4,
			//$open_time_v4,
			//$close_time_v4,
		//Quote	
			$quote_show_v4,
			$quote_v4,
		     $quote_link_v4,
		//Button	
			//$button_show_v4,
			//$button_v4,
			//$button_link_v4,
		//login	
			//$login_show_v4,
			//$login_v4,
			//$login_link_v4,
		//download	
			//$download_show_v4,
			//$download_v4,
			//$download_link_v4,	
		//Header Social	
			//$header_social_show_v4,
			//$socialtitle_v4,
			//$header_social_v4,
		//Shop			
			//$shop_show_v4,
			//$shop_link_v4,
		
		//Search
			//$header_search_show_v4,
			//$search_text_v4,
		/***********************************************************************
								Header Version 5 Start
		************************************************************************/
		array(
			'id'       => 'header_v5_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Header Style Five Settings', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v5' ),
		),
		//Welcome
			//$top_header_show_v5,
			//$welcome_v5,
			//$about_v5,
		//Email	
			//$email_title_v5,
			//$email_v5,
		//Address	
			//$address_title_v5,
			//$address_v5,
			//$address2nd_v5,			
		//Phone	
			//$phone_title_v5,
			//$phone_v5,
		//Time	
			//$time_title_v5,
			//$open_time_v5,
			//$close_time_v5,
		//Quote	
			$quote_show_v5,
			$quote_v5,
			$quote_link_v5,
		//Button	
			//$button_show_v5,
			//$button_v5,
			//$button_link_v5,
		//login	
			//$login_show_v5,
			//$login_v5,
			//$login_link_v5,
		//download	
			//$download_show_v5,
			//$download_v5,
			//$download_link_v5,	
		//Header Social	
			//$header_social_show_v5,
			//$socialtitle_v5,
			//$header_social_v5,
		//Shop			
			//$shop_show_v5,
			//$shop_link_v5,
		
		//Search
			//$header_search_show_v5,
			//$search_text_v5, 
		
		
		/***********************************************************************
								Header Version 6Start
		************************************************************************/
		array(
			'id'       => 'header_v6_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Header Style Six Settings', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v6' ),
		),
		//Welcome
			
		
		array(
			'id'      => 'quote_show_v6',
			'type'    => 'switch',
			'title'   => esc_html__( 'Quote Show', 'appway' ),
			'desc'    => esc_html__( 'Enable Quote Show', 'appway' ),
			'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v6' ),
		),
array(
		    'id'       => 'quote_v6',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Quote Title', 'appway' ),
		    'desc'     => esc_html__( 'Enter Quote Title', 'appway' ),
			'default'  => esc_html__( 'Get Quote', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v6' ),
	    ),
	
array(
		    'id'       => 'quote_link_v6',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Quote Link', 'appway' ),
		    'desc'     => esc_html__( 'Enter The Quote Link', 'appway' ),
			'default'  => esc_html__( '#', 'appway' ),
			'required' => array( 'header_style_settings', '=', 'header_v6' ),
	    ),
		

		
		array(
			'id'       => 'header_style_section_end',
			'type'     => 'section',
			'indent'      => false,
			'required' => [ 'header_source_type', '=', 'd' ],
		),
		
		

		
	
		
	/***** ==========Main Area End======== */	
	),
);
