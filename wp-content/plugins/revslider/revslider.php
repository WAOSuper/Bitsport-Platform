<?php
/*
Plugin Name: Slider Revolution
Plugin URI: https://revolution.themepunch.com/
Description: Slider Revolution - Premium responsive slider
Author: ThemePunch
Text Domain: revslider
Domain Path: /languages
Version: 6.2.15
Author URI: https://themepunch.com/
*/

// If this file is called directly, abort.
if(!defined('WPINC')){ die; }

if(class_exists('RevSliderFront')){
	die('ERROR: It looks like you have more than one instance of Slider Revolution installed. Please remove additional instances for this plugin to work again.');
}

define('RS_REVISION',			'6.2.15');
define('RS_PLUGIN_PATH',		plugin_dir_path(__FILE__));
define('RS_PLUGIN_SLUG_PATH',	plugin_basename(__FILE__));
define('RS_PLUGIN_FILE_PATH',	__FILE__);
define('RS_PLUGIN_SLUG',		apply_filters('set_revslider_slug', 'revslider'));
define('RS_PLUGIN_URL',			get_rs_plugin_url());
define('RS_PLUGIN_URL_CLEAN',	str_replace(array('http://', 'https://'), '//', RS_PLUGIN_URL));
define('RS_DEMO',				false);
define('RS_TP_TOOLS',			'6.2.15'); //holds the version of the tp-tools script, load only the latest!

$revslider_fonts = array('queue' => array(), 'loaded' => array());
$revslider_is_preview_mode = false;
$revslider_save_post = false;
$revslider_addon_notice_merged = 0;

//include frameword files
require_once(RS_PLUGIN_PATH . 'includes/data.class.php');
require_once(RS_PLUGIN_PATH . 'includes/functions.class.php');
require_once(RS_PLUGIN_PATH . 'includes/em-integration.class.php');
require_once(RS_PLUGIN_PATH . 'includes/cssparser.class.php');
require_once(RS_PLUGIN_PATH . 'includes/woocommerce.class.php');
require_once(RS_PLUGIN_PATH . 'includes/wpml.class.php');
require_once(RS_PLUGIN_PATH . 'includes/colorpicker.class.php');
require_once(RS_PLUGIN_PATH . 'includes/navigation.class.php');
require_once(RS_PLUGIN_PATH . 'includes/object-library.class.php');
require_once(RS_PLUGIN_PATH . 'admin/includes/loadbalancer.class.php');
require_once(RS_PLUGIN_PATH . 'admin/includes/plugin-update.class.php');
require_once(RS_PLUGIN_PATH . 'admin/includes/widget.class.php');
require_once(RS_PLUGIN_PATH . 'includes/extension.class.php');
require_once(RS_PLUGIN_PATH . 'includes/favorite.class.php');
require_once(RS_PLUGIN_PATH . 'includes/aq-resizer.class.php');
require_once(RS_PLUGIN_PATH . 'includes/external-sources.class.php');
require_once(RS_PLUGIN_PATH . 'includes/page-template.class.php');

require_once(RS_PLUGIN_PATH . 'includes/slider.class.php');
require_once(RS_PLUGIN_PATH . 'includes/slide.class.php');
require_once(RS_PLUGIN_PATH . 'includes/output.class.php');
require_once(RS_PLUGIN_PATH . 'public/revslider-front.class.php');

require_once(RS_PLUGIN_PATH . 'includes/backwards.php');

try{
	RevSliderFunctions::set_memory_limit();
	
	function rev_slider_shortcode($args, $mid_content = null){
		extract(shortcode_atts(array('alias'	=> ''), $args, 'rev_slider'));
		extract(shortcode_atts(array('settings' => ''), $args, 'rev_slider'));
		extract(shortcode_atts(array('order'	=> ''), $args, 'rev_slider'));
		extract(shortcode_atts(array('usage'	=> ''), $args, 'rev_slider'));
		extract(shortcode_atts(array('modal'	=> ''), $args, 'rev_slider'));
		extract(shortcode_atts(array('layout'	=> ''), $args, 'rev_slider'));
		extract(shortcode_atts(array('offset'	=> ''), $args, 'rev_slider'));
		extract(shortcode_atts(array('skin'		=> ''), $args, 'rev_slider'));
		extract(shortcode_atts(array('zindex'	=> ''), $args, 'rev_slider'));
		
		$output = new RevSliderOutput();
		
		$slider_alias = ($alias != '') ? $alias : $output->get_val($args, 0); //backwards compatibility
		
		//this fixes an issue with the Visual Composer extension 
		if(empty($slider_alias)){
			return (function_exists('is_user_logged_in') && is_user_logged_in()) ? '<div><img src="' . RS_PLUGIN_URL_CLEAN . 'admin/assets/images/rs6_logo_2x.png"></div>' : '';
		}
		
		$output->set_custom_order($order);
		$output->set_custom_settings($settings);
		$output->set_custom_skin($skin);

		$gallery_ids = $output->check_for_shortcodes($mid_content); //check for example on gallery shortcode and do stuff
		if($gallery_ids !== false) $output->set_gallery_ids($gallery_ids);
		
		ob_start();
		$slider = $output->add_slider_to_stage($slider_alias, $usage, $layout, $offset, $modal);
		$content = ob_get_contents();
		ob_clean();
		ob_end_clean();

		if(!empty($zindex)){
			$content = '<div class="wp-block-themepunch-revslider" style="z-index:'.$zindex.';">' .$content. '</div>';
		}
		
		if(!empty($slider)){
			switch($slider->get_param(array('troubleshooting', 'outPutFilter'), '')){
				case 'compress':
					$content = str_replace(array("\n", "\r"), '', $content);
					return $content;
				break;
				case 'echo':
					global $revslider_save_post;
					if($revslider_save_post) return $content;
					
					echo $content; //bypass the filters
				break;
				default:
					return $content;
				break;
			}
		}else{
			return $content;
		}
	}
	
	$rslb = new RevSliderLoadBalancer();
	$rslb->refresh_server_list();
	add_shortcode('rev_slider', 'rev_slider_shortcode');
	add_action('save_post', array('RevSliderFront', 'set_post_saving'));
	add_action('widgets_init', array('RevSliderWidget', 'register_widget'));
	
	if(is_admin()){
		require_once(RS_PLUGIN_PATH . 'admin/includes/license.class.php');
		require_once(RS_PLUGIN_PATH . 'admin/includes/addons.class.php');
		require_once(RS_PLUGIN_PATH . 'admin/includes/template.class.php');
		require_once(RS_PLUGIN_PATH . 'admin/includes/functions-admin.class.php');
		require_once(RS_PLUGIN_PATH . 'admin/includes/folder.class.php');
		require_once(RS_PLUGIN_PATH . 'admin/includes/import.class.php');
		require_once(RS_PLUGIN_PATH . 'admin/includes/export.class.php');
		require_once(RS_PLUGIN_PATH . 'admin/includes/export-html.class.php');
		require_once(RS_PLUGIN_PATH . 'admin/includes/newsletter.class.php');
		require_once(RS_PLUGIN_PATH . 'admin/revslider-admin.class.php');
		require_once(RS_PLUGIN_PATH . 'includes/update.class.php');
		//require_once(RS_PLUGIN_PATH . 'admin/includes/debug.php');
		
		$rs_admin = new RevSliderAdmin();
	}else{
		require_once(RS_PLUGIN_PATH . 'public/includes/functions-public.class.php');
		
		/**
		 * add RevSlider to the page/post
		 */
		function putRevSlider($data, $put_in = ''){
			add_revslider($data, $put_in);
		}
		
		function add_revslider($data, $put_in = ''){
			$output = new RevSliderOutput();
			$g_values = $output->get_global_settings();
			$add_to = $output->get_val($g_values, 'includeids', '');
			$output->set_add_to($add_to);
			if($output->check_add_to(true) == false && $output->_truefalse($output->get_val($g_values, 'allinclude', true)) == false){
				$output->print_error_message(
					__('If you want to use the PHP function "add_revslider" in your code please make sure to activate ', 'revslider').
					__('"Include RevSlider libraries globally" ', 'revslider').
					__('and/or add the current page to the ', 'revslider').
					__('"Pages to include RevSlider libraries" option ', 'revslider').
					__('in the "Global Settings" of Slider Revolution.', 'revslider')
				);
				return false;
			}
			
			ob_start();
			$output->set_add_to($put_in);
			$slider = $output->add_slider_to_stage($data);
			$content = ob_get_contents();
			ob_clean();
			ob_end_clean();
			
			echo $content;

		}
		
		$rev_slider_front = new RevSliderFront();
	}
	
	register_activation_hook(__FILE__, array('RevSliderFront', 'create_tables'));
	add_action('plugins_loaded', array('RevSliderFront', 'create_tables'));
	add_action('plugins_loaded', array('RevSliderPluginUpdate', 'do_update_checks')); //add update checks
	add_action('plugins_loaded', array('RevSliderPageTemplate', 'get_instance'));
	add_action('plugins_loaded', array('RevSliderFront', 'add_post_editor'));
	
	add_filter('wpseo_sitemap_entry', array('RevSliderFront', 'get_images_for_seo'), 10, 3);
}catch(Exception $e){
	$message = $e->getMessage();
	//$trace = $e->getTraceAsString();
	echo _e('Revolution Slider Error:', 'revslider').' <b>'. esc_html($message) .'</b>';
}

function get_rs_plugin_url(){
	$url = str_replace('index.php', '', plugins_url('index.php', __FILE__ ));
	if(strpos($url, 'http') === false) {
		$site_url	= get_site_url();
		$url		= (substr($site_url, -1) === '/') ? substr($site_url, 0, -1). $url : $site_url. $url;
	}
	$url = str_replace(array(chr(10), chr(13)), '', $url);
	
	return $url;
}

?>