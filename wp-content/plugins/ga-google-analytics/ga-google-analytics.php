<?php 
/*
	Plugin Name: GA Google Analytics
	Plugin URI: https://perishablepress.com/google-analytics-plugin/
	Description: Adds your Google Analytics Tracking Code to your WordPress site.
	Tags: analytics, ga, google, google analytics, tracking, statistics, stats
	Author: Jeff Starr
	Author URI: https://plugin-planet.com/
	Donate link: https://monzillamedia.com/donate.html
	Contributors: specialk
	Requires at least: 4.1
	Tested up to: 5.8
	Stable tag: 20210719
	Version: 20210719
	Requires PHP: 5.6.20
	Text Domain: ga-google-analytics
	Domain Path: /languages
	License: GPL v2 or later
*/

/*
	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 
	2 of the License, or (at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	with this program. If not, visit: https://www.gnu.org/licenses/
	
	Copyright 2021 Monzilla Media. All rights reserved.
*/

if (!defined('ABSPATH')) die();

if (!class_exists('GA_Google_Analytics')) {
	
	class GA_Google_Analytics {
		
		function __construct() {
			
			$this->constants();
			$this->includes();
			
			add_action('admin_menu',            array($this, 'add_menu'));
			add_filter('admin_init',            array($this, 'add_settings'));
			add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
			add_filter('plugin_action_links',   array($this, 'action_links'), 10, 2);
			add_filter('plugin_row_meta',       array($this, 'plugin_links'), 10, 2);
			add_action('plugins_loaded',        array($this, 'load_i18n'));
			add_action('admin_init',            array($this, 'check_version'));
			add_action('admin_init',            array($this, 'reset_options'));
			add_action('admin_notices',         array($this, 'admin_notices'));
			
		} 
		
		function constants() {
			
			if (!defined('GAP_VERSION')) define('GAP_VERSION', '20210719');
			if (!defined('GAP_REQUIRE')) define('GAP_REQUIRE', '4.1');
			if (!defined('GAP_AUTHOR'))  define('GAP_AUTHOR',  'Jeff Starr');
			if (!defined('GAP_NAME'))    define('GAP_NAME',    __('GA Google Analytics', 'ga-google-analytics'));
			if (!defined('GAP_HOME'))    define('GAP_HOME',    'https://perishablepress.com/ga-google-analytics/');
			if (!defined('GAP_PATH'))    define('GAP_PATH',    'options-general.php?page=ga-google-analytics');
			if (!defined('GAP_URL'))     define('GAP_URL',     plugin_dir_url(__FILE__));
			if (!defined('GAP_DIR'))     define('GAP_DIR',     plugin_dir_path(__FILE__));
			if (!defined('GAP_FILE'))    define('GAP_FILE',    plugin_basename(__FILE__));
			if (!defined('GAP_SLUG'))    define('GAP_SLUG',    basename(dirname(__FILE__)));
			
		}
		
		function includes() {
			
			require_once GAP_DIR .'inc/plugin-core.php';
			
		}
		
		function add_menu() {
			
			$title_page = esc_html__('GA Google Analytics', 'ga-google-analytics');
			$title_menu = esc_html__('Google Analytics',    'ga-google-analytics');
			
			add_options_page($title_page, $title_menu, 'manage_options', 'ga-google-analytics', array($this, 'display_settings'));
			
		}
		
		function add_settings() {
			
			register_setting('gap_plugin_options', 'gap_options', array($this, 'validate_settings'));
			
		}
		
		function admin_scripts($hook) {
			
			if ($hook === 'settings_page_ga-google-analytics') {
				
				wp_enqueue_style('ga-google-analytics', GAP_URL .'css/settings.css', array(), GAP_VERSION);
				
				wp_enqueue_script('ga-google-analytics', GAP_URL .'js/settings.js', array('jquery'), GAP_VERSION);
				
				$this->localize_scripts();
				
			}
			
		}
		
		function localize_scripts() {
			
			$script = array(
				'confirm_message' => esc_html__('Are you sure you want to restore all default options?', 'ga-google-analytics')
			);
			
			wp_localize_script('ga-google-analytics', 'ga_google_analytics', $script);
			
		}
		
		function action_links($links, $file) {
			
			if ($file === GAP_FILE && current_user_can('manage_options')) {
				
				$settings = '<a href="'. admin_url(GAP_PATH) .'">'. esc_html__('Settings', 'ga-google-analytics') .'</a>';
				
				array_unshift($links, $settings);
				
			}
			
			if ($file === GAP_FILE) {
				
				$pro_href   = 'https://plugin-planet.com/ga-google-analytics-pro/?plugin';
				$pro_title  = esc_attr__('Get GA Pro!', 'ga-google-analytics');
				$pro_text   = esc_html__('Go&nbsp;Pro', 'ga-google-analytics');
				$pro_style  = 'font-weight:bold;';
				
				$pro = '<a target="_blank" rel="noopener noreferrer" href="'. $pro_href .'" title="'. $pro_title .'" style="'. $pro_style .'">'. $pro_text .'</a>';
				
				array_unshift($links, $pro);
				
			}
			
			return $links;
			
		}
		
		function plugin_links($links, $file) {
			
			if ($file === GAP_FILE) {
				
				$home_href  = 'https://perishablepress.com/google-analytics-plugin/';
				$home_title = esc_attr__('Plugin Homepage', 'ga-google-analytics');
				$home_text  = esc_html__('Homepage', 'ga-google-analytics');
				
				$links[]    = '<a target="_blank" rel="noopener noreferrer" href="'. $home_href .'" title="'. $home_title .'">'. $home_text .'</a>';
				
				$rate_href  = 'https://wordpress.org/support/plugin/'. GAP_SLUG .'/reviews/?rate=5#new-post';
				$rate_title = esc_attr__('Click here to rate and review this plugin on WordPress.org', 'ga-google-analytics');
				$rate_text  = esc_html__('Rate this plugin', 'ga-google-analytics') .'&nbsp;&raquo;';
				
				$links[]    = '<a target="_blank" rel="noopener noreferrer" href="'. $rate_href .'" title="'. $rate_title .'">'. $rate_text .'</a>';
				
			}
			
			return $links;
			
		}
		
		function check_version() {
			
			$wp_version = get_bloginfo('version');
			
			if (isset($_GET['activate']) && $_GET['activate'] == 'true') {
				
				if (version_compare($wp_version, GAP_REQUIRE, '<')) {
					
					if (is_plugin_active(GAP_FILE)) {
						
						deactivate_plugins(GAP_FILE);
						
						$msg  = '<strong>'. GAP_NAME .'</strong> '. esc_html__('requires WordPress ', 'ga-google-analytics') . GAP_REQUIRE;
						$msg .= esc_html__(' or higher, and has been deactivated! ', 'ga-google-analytics');
						$msg .= esc_html__('Please return to the', 'ga-google-analytics') .' <a href="'. admin_url() .'">';
						$msg .= esc_html__('WP Admin Area', 'ga-google-analytics') .'</a> '. esc_html__('to upgrade WordPress and try again.', 'ga-google-analytics');
						
						wp_die($msg);
						
					}
					
				}
				
			}
			
		}
		
		function load_i18n() {
			
			$domain = 'ga-google-analytics';
			
			$locale = apply_filters('gap_locale', get_locale(), $domain);
			
			$dir    = trailingslashit(WP_LANG_DIR);
			
			$file   = $domain .'-'. $locale .'.mo';
			
			$path_1 = $dir . $file;
			
			$path_2 = $dir . $domain .'/'. $file;
			
			$path_3 = $dir .'plugins/'. $file;
			
			$path_4 = $dir .'plugins/'. $domain .'/'. $file;
			
			$paths = array($path_1, $path_2, $path_3, $path_4);
			
			foreach ($paths as $path) {
				
				if ($loaded = load_textdomain($domain, $path)) {
					
					return $loaded;
					
				} else {
					
					return load_plugin_textdomain($domain, false, GAP_DIR .'languages/');
					
				}
				
			}
			
		}
		
		function admin_notices() {
			
			$screen = get_current_screen();
			
			if (!property_exists($screen, 'id')) return;
			
			if ($screen->id === 'settings_page_ga-google-analytics') {
				
				if (isset($_GET['gap-reset-options'])) {
					
					if ($_GET['gap-reset-options'] === 'true') : ?>
						
						<div class="notice notice-success is-dismissible"><p><strong><?php esc_html_e('Default options restored.', 'ga-google-analytics'); ?></strong></p></div>
						
					<?php else : ?>
						
						<div class="notice notice-info is-dismissible"><p><strong><?php esc_html_e('No changes made to options.', 'ga-google-analytics'); ?></strong></p></div>
						
					<?php endif;
					
				}
				
			}
			
		}
		
		function reset_options() {
			
			if (isset($_GET['gap-reset-options']) && wp_verify_nonce($_GET['gap-reset-options'], 'gap_reset_options')) {
				
				if (!current_user_can('manage_options')) exit;
				
				$update = update_option('gap_options', $this->default_options());
				
				$result = $update ? 'true' : 'false';
				
				$location = add_query_arg(array('gap-reset-options' => $result), admin_url(GAP_PATH));
				
				wp_redirect(esc_url_raw($location));
				
				exit;
				
			}
			
		}

		function __clone() {
			
			_doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&rsquo; huh?', 'ga-google-analytics'), GAP_VERSION);
			
		}
		
		function __wakeup() {
			
			_doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&rsquo; huh?', 'ga-google-analytics'), GAP_VERSION);
			
		}
		
		function default_options() {
			
			$options = array(
				
				'gap_id'          => '',
				'gap_location'    => 'header',
				'gap_enable'      => 1,
				'gap_display_ads' => 0,
				'link_attr'       => 0,
				'gap_anonymize'   => 0,
				'gap_force_ssl'   => 0,
				'admin_area'      => 0,
				'disable_admin'   => 0,
				'gap_custom_loc'  => 0,
				'tracker_object'  => '',
				'gap_custom_code' => '',
				'gap_custom'      => '',
				//
				'gap_universal'   => 1,
				'version_alert'   => 0,
				'default_options' => 0
				
			);
			
			return apply_filters('gap_default_options', $options);
			
		}
		
		function validate_settings($input) {
			
			$input['gap_id'] = wp_filter_nohtml_kses($input['gap_id']);
			
			if (isset($input['gap_id']) && preg_match("/^GTM-/i", $input['gap_id'])) {
				
				$input['gap_id'] = '';
				
				$message  = esc_html__('Error: your tracking code begins with', 'ga-google-analytics') .' <code>GTM-</code> ';
				$message .= esc_html__('(for Google Tag Manager), which is not supported. Please try again with a supported tracking code.', 'ga-google-analytics');
				
				add_settings_error('gap_id', 'invalid-tracking-code', $message, 'error');
				
			}
			
			if (!isset($input['gap_location'])) $input['gap_location'] = null;
			if (!array_key_exists($input['gap_location'], $this->options_locations())) $input['gap_location'] = null;
			
			if (!isset($input['gap_enable'])) $input['gap_enable'] = null;
			if (!array_key_exists($input['gap_enable'], $this->options_libraries())) $input['gap_enable'] = null;
			
			if (!isset($input['gap_display_ads'])) $input['gap_display_ads'] = null;
			$input['gap_display_ads'] = ($input['gap_display_ads'] == 1 ? 1 : 0);
			
			if (!isset($input['link_attr'])) $input['link_attr'] = null;
			$input['link_attr'] = ($input['link_attr'] == 1 ? 1 : 0);
			
			if (!isset($input['gap_anonymize'])) $input['gap_anonymize'] = null;
			$input['gap_anonymize'] = ($input['gap_anonymize'] == 1 ? 1 : 0);
			
			if (!isset($input['gap_force_ssl'])) $input['gap_force_ssl'] = null;
			$input['gap_force_ssl'] = ($input['gap_force_ssl'] == 1 ? 1 : 0);
			
			if (!isset($input['admin_area'])) $input['admin_area'] = null;
			$input['admin_area'] = ($input['admin_area'] == 1 ? 1 : 0);
			
			if (!isset($input['disable_admin'])) $input['disable_admin'] = null;
			$input['disable_admin'] = ($input['disable_admin'] == 1 ? 1 : 0);
			
			if (!isset($input['gap_custom_loc'])) $input['gap_custom_loc'] = null;
			$input['gap_custom_loc'] = ($input['gap_custom_loc'] == 1 ? 1 : 0);
			
			if (isset($input['tracker_object'])) $input['tracker_object'] = wp_strip_all_tags(trim($input['tracker_object']));
			
			if (isset($input['gap_custom_code'])) $input['gap_custom_code'] = wp_strip_all_tags(trim($input['gap_custom_code']));
			
			if (isset($input['gap_custom'])) $input['gap_custom'] = stripslashes($input['gap_custom']);
			
			return $input;
			
		}
		
		function options_locations() {
			
			return array(
				
				'header' => array(
					'value' => 'header',
					'label' => esc_html__('Include tracking code in page head (via', 'ga-google-analytics') .' <code>wp_head</code>'. esc_html__(')', 'ga-google-analytics')
				),
				'footer' => array(
					'value' => 'footer',
					'label' => esc_html__('Include tracking code in page footer (via', 'ga-google-analytics') .' <code>wp_footer</code>'. esc_html__(')', 'ga-google-analytics')
				)
			);
			
		}
		
		function options_libraries() {
			
			$url1 = 'https://developers.google.com/analytics/devguides/collection/analyticsjs/';
			$url2 = 'https://developers.google.com/analytics/devguides/collection/gtagjs/';
			$url3 = 'https://developers.google.com/analytics/devguides/collection/gajs/';
			
			$link1 = '<a target="_blank" rel="noopener noreferrer" href="'. $url1 .'">'. esc_html__('Universal Analytics', 'ga-google-analytics') .'</a> ';
			$link2 = '<a target="_blank" rel="noopener noreferrer" href="'. $url2 .'">'. esc_html__('Global Site Tag', 'ga-google-analytics') .'</a> ';
			$link3 = '<a target="_blank" rel="noopener noreferrer" href="'. $url3 .'">'. esc_html__('Legacy', 'ga-google-analytics') .'</a> ';
			
			return array(
				
				1 => array(
					'value' => 1,
					'label' => $link1 .' <span class="gap-note">/</span> <code>analytics.js</code> <span class="gap-note">'. esc_html__('(default)', 'ga-google-analytics') .'</span>'
				),
				2 => array(
					'value' => 2,
					'label' => $link2 .' <span class="gap-note">/</span> <code>gtag.js</code> <span class="gap-note">'. esc_html__('(new method)', 'ga-google-analytics') .'</span>'
				), 
				3 => array(
					'value' => 3,
					'label' => $link3 .' <span class="gap-note">/</span> <code>ga.js</code> <span class="gap-note">'. esc_html__('(deprecated)', 'ga-google-analytics') .'</span>'
				)
			);
			
		}
		
		function display_settings() {
			
			$gap_options = get_option('gap_options', $this->default_options());
			
			require_once GAP_DIR .'inc/settings-display.php';
			
		}
		
		function select_menu($items, $menu) {
			
			$options = get_option('gap_options', $this->default_options());
			
			$universal = isset($options['gap_universal']) ? $options['gap_universal'] : 1;
			
			$tracking = isset($options['gap_enable']) ? $options['gap_enable'] : 1;
			
			$checked = '';
			
			$output = '';
			
			$class = '';
			
			foreach ($items as $item) {
				
				$key = isset($options[$menu]) ? $options[$menu] : '';
				
				$value = isset($item['value']) ? $item['value'] : '';
				
				if ($menu === 'gap_enable') {
					
					if ($tracking == 0) $key = 1;
					
					if (!$universal && $tracking == 1) $key = 3;
					
					$class = ' gap-select-method';
					
				}
				
				$checked = ($value == $key) ? ' checked="checked"' : '';
				
				$output .= '<div class="gap-radio-inputs'. esc_attr($class) .'">';
				$output .= '<input type="radio" name="gap_options['. esc_attr($menu) .']" value="'. esc_attr($item['value']) .'"'. $checked .'> ';
				$output .= '<span>'. $item['label'] .'</span>'; //
				$output .= '</div>';
				
			}
			
			return $output;
			
		}
		
		function callback_reset() {
			
			$nonce = wp_create_nonce('gap_reset_options');
			
			$href  = add_query_arg(array('gap-reset-options' => $nonce), admin_url(GAP_PATH));
			
			$label = esc_html__('Restore default plugin options', 'ga-google-analytics');
			
			return '<a class="gap-reset-options" href="'. esc_url($href) .'">'. esc_html($label) .'</a>';
			
		}
		
	}
	
	$GLOBALS['GA_Google_Analytics'] = $GA_Google_Analytics = new GA_Google_Analytics(); 
	
	ga_google_analytics_init($GA_Google_Analytics);
	
}
