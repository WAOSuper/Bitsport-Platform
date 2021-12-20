<?php
/**
 * @author    ThemePunch <info@themepunch.com>
 * @link      https://www.themepunch.com/
 * @copyright 2019 ThemePunch
 */

if(!defined('ABSPATH')) exit();

class RevSliderAdmin extends RevSliderFunctionsAdmin {
	//private $theme_mode = false;
	private $view			 = 'slider';
	private $user_role		 = 'admin';
	private $global_settings = array();
	private $screens		 = array(); //holds all RevSlider Relevant screens in it
	private $allowed_views	 = array('sliders', 'slider', 'slide', 'update'); //holds pages, that are allowed to be included
	private $pages			 = array('revslider'); //, 'revslider_navigation', 'rev_addon', 'revslider_global_settings'
	private $dev_mode		 = false;
	private $path_views;
	
	
	/**
	 * START: DEPRECATED FUNCTIONS PRIOR 6.2.0 THAT ARE IN HERE FOR OLD THEMES TO WORK PROPERLY
	 **/
	
	/**
	 * Activate the Plugin through the ThemePunch Servers
	 * @before: RevSliderOperations::checkPurchaseVerification();
	 * @moved to RevSliderLicense::activate_plugin();
	 **/
	public function activate_plugin($code){
		$rs_license = new RevSliderLicense();
		return $rs_license->activate_plugin($code);
	}
	
	
	/**
	 * Deactivate the Plugin through the ThemePunch Servers
	 * @before: RevSliderOperations::doPurchaseDeactivation();
	 * @moved to RevSliderLicense::deactivate_plugin();
	 **/
	public function deactivate_plugin(){
		$rs_license = new RevSliderLicense();
		return $rs_license->deactivate_plugin();
	}
	
	/**
	 * END: DEPRECATED FUNCTIONS THAT ARE IN HERE FOR OLD ADDONS TO WORK PROPERLY
	 **/
	 
	
	/**
	 * construct admin part
	 **/
	public function __construct(){
		parent::__construct();
		
		if(!file_exists(RS_PLUGIN_PATH.'admin/assets/js/plugins/utils.min.js') && !file_exists(RS_PLUGIN_PATH.'admin/assets/js/modules/editor.min.js')){
			$this->dev_mode = true;
		}
		
		$this->path_views = RS_PLUGIN_PATH . 'admin/views/';
		$this->global_settings = $this->get_global_settings();
		
		$this->set_current_page();
		$this->set_user_role();
		$this->do_update_checks();
		$this->add_actions();
		$this->add_filters();
	}
	
	/**
	 * enqueue all admin styles
	 **/
	public function enqueue_admin_styles(){
		wp_enqueue_style('rs-open-sans', '//fonts.googleapis.com/css?family=Open+Sans:400,300,700,600,800');
		//wp_enqueue_style('revslider-global-styles', RS_PLUGIN_URL . 'admin/assets/css/global.css', array(), RS_REVISION);
		wp_enqueue_style(array('wp-jquery-ui', 'wp-jquery-ui-core', 'wp-jquery-ui-dialog', 'wp-color-picker'));
		wp_enqueue_style('revbuilder-color-picker-css', RS_PLUGIN_URL . 'admin/assets/css/tp-color-picker.css', array(), RS_REVISION);
		
		if(in_array($this->get_val($_GET, 'page'), $this->pages)){
			wp_enqueue_style('revbuilder-select2RS', RS_PLUGIN_URL . 'admin/assets/css/select2RS.css', array(), RS_REVISION);
			//wp_enqueue_style('codemirror-css', RS_PLUGIN_URL .'admin/assets/css/codemirror.css', array(), RS_REVISION);
			wp_enqueue_style('rs-frontend-settings', RS_PLUGIN_URL . 'public/assets/css/rs6.css', array(), RS_REVISION);
			wp_enqueue_style('rs-icon-set-fa-icon-', RS_PLUGIN_URL . 'public/assets/fonts/font-awesome/css/font-awesome.css', array(), RS_REVISION);
			wp_enqueue_style('rs-icon-set-pe-7s-', RS_PLUGIN_URL . 'public/assets/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css', array(), RS_REVISION);
			wp_enqueue_style('revslider-basics-css', RS_PLUGIN_URL . 'admin/assets/css/basics.css', array(), RS_REVISION); //'rs-new-plugin-settings'
			wp_enqueue_style('rs-new-plugin-settings', RS_PLUGIN_URL . 'admin/assets/css/builder.css', array('revslider-basics-css'), RS_REVISION);
			if(is_rtl()){
				wp_enqueue_style('rs-new-plugin-settings-rtl', RS_PLUGIN_URL . 'admin/assets/css/builder-rtl.css', array('rs-new-plugin-settings'), RS_REVISION);
			}
		}
	}

	/**
	 * enqueue all admin scripts
	 **/
	public function enqueue_admin_scripts(){
		if(function_exists('wp_enqueue_media')){
			wp_enqueue_media();
		}

		wp_enqueue_script(array('jquery', 'jquery-ui-core', 'jquery-ui-mouse', 'jquery-ui-accordion', 'jquery-ui-datepicker', 'jquery-ui-dialog', 'jquery-ui-slider', 'jquery-ui-autocomplete', 'jquery-ui-sortable', 'jquery-ui-droppable', 'jquery-ui-tabs', 'jquery-ui-widget', 'wp-color-picker', 'wpdialogs', 'updates'));
		wp_enqueue_script(array('wp-color-picker'));
		/**
		 * The script is already auto-enqueued via 'add_tinymce_shortcode_editor_plugin'
		 **/
		/*
		//enqueue in all pages / posts in backend
		$screen = get_current_screen();

		$post_types = get_post_types('', 'names');
		foreach($post_types as $post_type){
			if($post_type == $screen->id){
				wp_enqueue_script('revslider-tinymce-shortcode-script', RS_PLUGIN_URL . 'admin/assets/js/modules/tinymce-shortcode-script.js', array('jquery'), RS_REVISION, true);
			}
		}
		*/

		if(in_array($this->get_val($_GET, 'page'), $this->pages)){
			global $wp_scripts;
			$view = $this->get_val($_GET, 'view');

			wp_enqueue_script('jquery-ui-droppable', array('jquery'), RS_REVISION);
			
			/**
			 * dequeue tp-tools to make sure that always the latest is loaded
			 **/
			if(version_compare($this->get_val($wp_scripts, array('registered', 'tp-tools', 'ver'), '1.0'), RS_TP_TOOLS, '<')){
				wp_deregister_script('tp-tools');
				wp_dequeue_script('tp-tools');
			}
			
			$wait_for = array('media-editor', 'media-audiovideo');
			if(is_admin()){
				$wait_for[] = 'mce-view';
				$wait_for[] = 'image-edit';
			}
			$wait_for = array();
			wp_enqueue_script('tp-tools', RS_PLUGIN_URL . 'public/assets/js/rbtools.min.js', $wait_for, RS_TP_TOOLS);
			
			if($this->dev_mode){
				wp_enqueue_script('revbuilder-admin', RS_PLUGIN_URL . 'admin/assets/js/modules/admin.js', array('jquery'), RS_REVISION, false);
				wp_localize_script('revbuilder-admin', 'RVS_LANG', $this->get_javascript_multilanguage()); //Load multilanguage for JavaScript
				wp_enqueue_script('revbuilder-basics', RS_PLUGIN_URL . 'admin/assets/js/modules/basics.js', array('jquery'), RS_REVISION, false);
				wp_enqueue_script('revbuilder-select2RS', RS_PLUGIN_URL . 'admin/assets/js/plugins/select2RS.full.min.js', array('jquery'), RS_REVISION, false);
				wp_enqueue_script('revbuilder-color-picker-js', RS_PLUGIN_URL . 'admin/assets/js/plugins/tp-color-picker.min.js', array('jquery', 'revbuilder-select2RS', 'wp-color-picker'), RS_REVISION);
				wp_enqueue_script('revbuilder-clipboard', RS_PLUGIN_URL . 'admin/assets/js/plugins/clipboard.min.js', array('jquery'), RS_REVISION, false);
				wp_enqueue_script('revbuilder-objectlibrary', RS_PLUGIN_URL . 'admin/assets/js/modules/objectlibrary.js', array('jquery'), RS_REVISION, false);
				wp_enqueue_script('revbuilder-optimizer', RS_PLUGIN_URL . 'admin/assets/js/modules/optimizer.js', array('jquery'), RS_REVISION, false);
			}else{
				wp_enqueue_script('revbuilder-admin', RS_PLUGIN_URL . 'admin/assets/js/modules/admin.min.js', array('jquery'), RS_REVISION, false);
				wp_localize_script('revbuilder-admin', 'RVS_LANG', $this->get_javascript_multilanguage()); //Load multilanguage for JavaScript
				wp_enqueue_script('revbuilder-utils', RS_PLUGIN_URL . 'admin/assets/js/plugins/utils.min.js', array('jquery', 'wp-color-picker'), RS_REVISION, false);
			}
			
			if($view == 'slide' && $this->dev_mode){
				wp_enqueue_script('revbuilder-help', RS_PLUGIN_URL . 'admin/assets/js/modules/helpinit.js', array('jquery', 'revbuilder-admin'), RS_REVISION, false);
				wp_enqueue_script('revbuilder-toolbar', RS_PLUGIN_URL . 'admin/assets/js/modules/rightclick.js', array('jquery', 'revbuilder-admin'), RS_REVISION, false);
				wp_enqueue_script('revbuilder-effects', RS_PLUGIN_URL . 'admin/assets/js/modules/timeline.js', array('jquery','revbuilder-admin'), RS_REVISION, false);
				wp_enqueue_script('revbuilder-layer', RS_PLUGIN_URL . 'admin/assets/js/modules/layer.js', array('jquery','revbuilder-admin'), RS_REVISION, false);
				wp_enqueue_script('revbuilder-layertools', RS_PLUGIN_URL . 'admin/assets/js/modules/layertools.js', array('jquery','revbuilder-admin'), RS_REVISION, false);
				wp_enqueue_script('revbuilder-quick-style', RS_PLUGIN_URL . 'admin/assets/js/modules/quickstyle.js', array('jquery','revbuilder-admin'), RS_REVISION, false);
				wp_enqueue_script('revbuilder-navigations', RS_PLUGIN_URL . 'admin/assets/js/modules/navigation.js', array('jquery','revbuilder-admin'), RS_REVISION, false);
				wp_enqueue_script('revbuilder-layeractions', RS_PLUGIN_URL . 'admin/assets/js/modules/layeractions.js', array('jquery','revbuilder-admin'), RS_REVISION, false);
				wp_enqueue_script('revbuilder-layerlist', RS_PLUGIN_URL . 'admin/assets/js/modules/layerlist.js', array('jquery','revbuilder-admin'), RS_REVISION, false);
				wp_enqueue_script('revbuilder-slide', RS_PLUGIN_URL . 'admin/assets/js/modules/slide.js', array('jquery','revbuilder-admin'), RS_REVISION, false);
				wp_enqueue_script('revbuilder-slider', RS_PLUGIN_URL . 'admin/assets/js/modules/slider.js', array('jquery','revbuilder-admin'), RS_REVISION, false);
				wp_enqueue_script('revbuilder', RS_PLUGIN_URL . 'admin/assets/js/builder.js', array('jquery','revbuilder-admin', 'jquery-ui-sortable'), RS_REVISION, false);
			}elseif($view == 'slide' && !$this->dev_mode){
				wp_enqueue_script('revbuilder-editor', RS_PLUGIN_URL . 'admin/assets/js/modules/editor.min.js', array('jquery', 'revbuilder-admin', 'jquery-ui-sortable'), RS_REVISION, false);
			}

			if($view == '' || $view == 'sliders'){
				if($this->dev_mode){
					wp_enqueue_script('revbuilder-overview', RS_PLUGIN_URL . 'admin/assets/js/modules/overview.js', array('jquery'), RS_REVISION, false);
				}else{
					wp_enqueue_script('revbuilder-overview', RS_PLUGIN_URL . 'admin/assets/js/modules/overview.min.js', array('jquery'), RS_REVISION, false);
				}
				
				if(!file_exists(RS_PLUGIN_PATH.'public/assets/js/rs6.min.js')){
					wp_enqueue_script('revmin', RS_PLUGIN_URL . 'public/assets/js/dev/rs6.main.js', 'tp-tools', RS_REVISION, false);
					//if on, load all libraries instead of dynamically loading them
					wp_enqueue_script('revmin-actions', RS_PLUGIN_URL . 'public/assets/js/dev/rs6.actions.js', 'tp-tools', RS_REVISION, false);
					wp_enqueue_script('revmin-carousel', RS_PLUGIN_URL . 'public/assets/js/dev/rs6.carousel.js', 'tp-tools', RS_REVISION, false);
					wp_enqueue_script('revmin-layeranimation', RS_PLUGIN_URL . 'public/assets/js/dev/rs6.layeranimation.js', 'tp-tools', RS_REVISION, false);
					wp_enqueue_script('revmin-navigation', RS_PLUGIN_URL . 'public/assets/js/dev/rs6.navigation.js', 'tp-tools', RS_REVISION, false);
					wp_enqueue_script('revmin-panzoom', RS_PLUGIN_URL . 'public/assets/js/dev/rs6.panzoom.js', 'tp-tools', RS_REVISION, false);
					wp_enqueue_script('revmin-parallax', RS_PLUGIN_URL . 'public/assets/js/dev/rs6.parallax.js', 'tp-tools', RS_REVISION, false);
					wp_enqueue_script('revmin-slideanims', RS_PLUGIN_URL . 'public/assets/js/dev/rs6.slideanims.js', 'tp-tools', RS_REVISION, false);
					wp_enqueue_script('revmin-video', RS_PLUGIN_URL . 'public/assets/js/dev/rs6.video.js', 'tp-tools', RS_REVISION, false);
				}else{
					wp_enqueue_script('revmin', RS_PLUGIN_URL . 'public/assets/js/rs6.min.js', array('jquery', 'tp-tools'), RS_REVISION, false);
				}
			}
		}
		
		//include all media upload scripts
		$this->add_media_upload_includes();
	}

	/**
	 * add all js and css needed for media upload
	 */
	protected static function add_media_upload_includes(){
		if(function_exists('wp_enqueue_media')){
			wp_enqueue_media();
		}

		wp_enqueue_script('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_style('thickbox');
	}
	
	/**
	 * Load the plugin text domain for translation.
	 */
	public function load_plugin_textdomain(){
		load_plugin_textdomain('revslider', false, dirname(RS_PLUGIN_SLUG_PATH) . '/languages/');
		load_plugin_textdomain('revsliderhelp', false, dirname(RS_PLUGIN_SLUG_PATH) . '/languages/');
	}

	/**
	 * set the user role, to restrict plugin usage to certain groups
	 * @since: 6.0
	 **/
	public function set_user_role(){
		$this->user_role = $this->get_val($this->global_settings, 'permission', 'admin');
	}

	/**
	 * add the admin pages to the WordPress backend
	 * @since: 6.0
	 **/
	public function add_admin_pages(){
		switch ($this->user_role){
		case 'author':
			$role = 'edit_published_posts';
			break;
		case 'editor':
			$role = 'edit_pages';
			break;
		default:
		case 'admin':
			$role = 'manage_options';
			break;
		}

		$this->screens[] = add_menu_page('Slider Revolution', 'Slider Revolution', $role, 'revslider', array($this, 'display_admin_page'), 'dashicons-update');
	}

	/**
	 * add wildcards metabox variables to posts
	 * @var $post_types: null = all, post = only posts
	 */
	public function add_slider_meta_box($post_types = null){
		try {
			$post_types = array('post','page');
			add_meta_box('slider_revolution_metabox', 'Slider Revolution', array('RevSliderAdmin', 'add_meta_box_content'), $post_types, 'side', 'default');
		} catch (Exception $e){}
	}

	/**
	 * on add metabox content
	 */
	public static function add_meta_box_content($post, $boxData){
		call_user_func(array('RevSliderAdmin', 'custom_post_fields_output'));
	}

	/**
	 *  custom output function
	 */
	public static function custom_post_fields_output(){
		$slider = new RevSliderSlider();
		$output = array();
		$output['default'] = 'default';

		$meta = get_post_meta(get_the_ID(), 'slide_template', true);
		$meta = ($meta == '') ? 'default' : $meta;

		$page_bg = get_post_meta(get_the_ID(), 'rs_page_bg_color', true);
		$page_bg = ($page_bg == '') ? '' : $page_bg;

		$blank = get_page_template_slug(get_the_ID()) == "../public/views/revslider-page-template.php";
		$blankcheck = $blank ? 'checked' : '';
		$hide_page_bg =  $blank ? '' : 'style="display:none;"';
		
		
		$slides = $slider->get_sliders_with_slides_short('template');
		$output = $output + $slides; //union arrays

		$latest_version	= get_option('revslider-latest-version', RS_REVISION);

		?>
		<ul class="revslider_settings _TPRB_">
			<li id="slide_template_row">
				<label class="rs_wp_ppset" for="revslider_blank_template"><?php _e('Blank Template','revslider'); ?></label><input id="rs_blank_template" name="rs_blank_template" <?php echo $blankcheck;?> class="" type="checkbox" >
			</li>
			<li id="slide_template_row">
				<div id="rs_page_bg_color_column" class="" <?php echo $hide_page_bg;?>>
					<label class="rs_wp_ppset"><?php _e('Page Color', 'revslider');?></label><input type="text" data-editing="<?php _e('Background Color', 'revslider');?>" name="rs_page_bg_color" id="rs_page_bg_color" class="my-color-field" value="<?php echo $page_bg; ?>">					
				</div>
				<div class="clear"></div>				
			</li>
			<li id="slide_template_row">				
					<label class="rs_wp_ppset" id="slide_template_text"><?php _e('Slide Template', 'revslider');?></label><select style="max-width:82px" name="slide_template" id="slide_template">
							<?php
							foreach($output as $handle => $name){
								echo '<option ' . selected($handle, $meta) . ' value="' . $handle . '">' . $name . '</option>';
							}
							?></select>				
			</li>
			<li id="slide_template_row" style="margin-top:40px">
				<solidiconbox><i class="material-icons">flag</i></solidiconbox><div class="pli_twoline_wp"><div class="pli_subtitle"><?php _e('Installed Version', 'revslider');?></div><div class="dynamicval pli_subtitle"><?php echo RS_REVISION; ?></div></div>
				<div class="div5"></div>
				<solidiconbox id="available_version_icon"><i class="material-icons">cloud_download</i></solidiconbox><div id="available_version_content" class="pli_twoline_wp"><div class="pli_subtitle"><?php _e('Available Version', 'revslider');?></div><div class="available_latest_version dynamicval pli_subtitle"><?php echo $latest_version; ?></div></div>				
			</li>
			<li>
				<div class="rs_wp_plg_act_wrapper"><span><?php _e('Unlock All Features', 'revslider');?></span></div>
			</li>
		</ul>
		
		<?php
	}
	
	
	
	/**
	 * 
	 * on save post meta. Update metaboxes data from post, add it to the post meta 
	 * @before: RevSliderBaseAdmin::onSavePost();
	 */
	public static function on_save_post(){
		$f = new RevSliderFunctions();
		
		$post_id = $f->get_post_var('ID');

		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id; //protection against autosave
		if(empty($post_id)) return false;
		
		// Slide Template
		$slide_template = $f->get_post_var('slide_template');
		update_post_meta($post_id, 'slide_template', $slide_template);

		// Blank Page Template Background Color
		$rs_page_bg_color = $f->get_post_var('rs_page_bg_color');
		update_post_meta($post_id, 'rs_page_bg_color', $rs_page_bg_color);

		// Set/Unset Blank Template depending on Blank Template Switch
		$rs_blank_template = $f->get_post_var('rs_blank_template');
		if( empty( $rs_blank_template ) && !empty($rs_page_bg_color)  && get_post_meta($post_id, '_wp_page_template',true) == '../public/views/revslider-page-template.php' ){
			update_post_meta($post_id, '_wp_page_template','');
		}
		if( !empty( $rs_blank_template ) &&  $rs_blank_template=="on" ) {
			update_post_meta($post_id, '_wp_page_template','../public/views/revslider-page-template.php');
		}
	}
	
	
	/**
	 * we dont want to show notices in our plugin
	 **/
	public function hide_notices(){
		if(in_array($this->get_val($_GET, 'page'), $this->pages)){
			remove_all_actions('admin_notices');
		}
	}

	/**
	 * check if we need to search for updates, if yes. Do them
	 **/
	private function do_update_checks(){
		$upgrade	= new RevSliderUpdate(RS_REVISION);
		$library	= new RevSliderObjectLibrary();
		$template	= new RevSliderTemplate();
		$validated	= get_option('revslider-valid', 'false');
		$stablev	= get_option('revslider-stable-version', '0');

		$uol = (isset($_REQUEST['update_object_library'])) ? true : false;
		$library->_get_list($uol);
		
		$us = (isset($_REQUEST['update_shop'])) ? true : false;
		$template->_get_template_list($us);

		$upgrade->force = (in_array($this->get_val($_REQUEST, 'checkforupdates', 'false'), array('true', true), true)) ? true : false;
		$upgrade->_retrieve_version_info();
		
		if($validated === 'true' || version_compare(RS_REVISION, $stablev, '<')){
			$upgrade->add_update_checks();
		}
	}

	/**
	 * Add Classes to the WordPress body
	 * @since    6.0
	 */
	function modify_admin_body_class($classes){
		$classes .= ($this->get_val($_GET, 'page') == 'revslider' && $this->get_val($_GET, 'view') == 'slide') ? ' rs-builder-mode' : '';
		$classes .= ($this->_truefalse($this->get_val($this->global_settings, 'highContrast', false)) === true && $this->get_val($_GET, 'page') === 'revslider') ? ' rs-high-contrast' : '';
		
		return $classes;
	}


	/**
	 * Add all actions that the backend needs here
	 **/
	public function add_actions(){
		global $pagenow;
		
		add_action('plugins_loaded', array($this, 'load_plugin_textdomain'));
		add_action('admin_head', array($this, 'hide_notices'), 1);
		add_action('admin_menu', array($this, 'add_admin_pages'));
		add_action('add_meta_boxes', array($this, 'add_slider_meta_box'));
		add_action('save_post', array($this, 'on_save_post'));
		add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_styles'));
		add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
		add_action('wp_ajax_revslider_ajax_action', array($this, 'do_ajax_action')); //ajax response to save slider options.
		add_action('wp_ajax_revslider_ajax_call_front', array($this, 'do_front_ajax_action'));
		add_action('wp_ajax_nopriv_revslider_ajax_call_front', array($this, 'do_front_ajax_action')); //for not logged in users

		if(isset($pagenow) && $pagenow == 'plugins.php'){
			add_action('admin_notices', array($this, 'add_plugins_page_notices'));
		}
		
		add_action('admin_init', array($this, 'merge_addon_notices'), 99);
		add_action('admin_init', array($this, 'add_suggested_privacy_content'), 15);
	}

	/**
	 * Add all filters that the backend needs here
	 **/
	public function add_filters(){
		add_filter('admin_body_class', array($this, 'modify_admin_body_class'));
		
		add_filter('plugin_locale', array($this, 'change_lang'), 10, 2);
	}
	
	/**
	 * Change the language of the Sldier Backend even if WordPress is set to be a different language
	 * @since: 6.1.6
	 **/
	public function change_lang($locale, $domain = ''){
		return (in_array($domain, array('revslider', 'revsliderhelp'), true)) ? $this->get_val($this->global_settings, 'lang', 'default') : $locale;
	}

	/**
	 * merge the revslider addon notices into one bigger notice
	 * @since: 2.2.0
	 **/
	public function merge_addon_notices(){
		global $wp_filter;
		
		if(!isset($wp_filter['admin_notices'])) return;
		if(!isset($wp_filter['admin_notices']->callbacks)) return;
		
		global $revslider_addon_notice_merged;
		$slugs = array(
			'Revslider_404_Addon_Verify', 'RsAddOnBackupNotice', 'RsAddOnBeforeAfterNotice', 'RsAddOnBubblemorphNotice', 'Revslider_Domain_Switch_Addon_Verify',
			'RsAddOnDuotoneNotice', 'RsAddOnExplodinglayersNotice', 'Revslider_Featured_Addon_Verify', 'RsAddOnFilmstripNotice', 'Revslider_Gallery_Addon_Verify',
			'RsAddOnLiquideffectNotice', 'Revslider_Login_Addon_Verify', 'Revslider_Maintenance_Addon_Verify', 'RsAddOnMousetrapNotice', 'RsAddOnPaintbrushNotice',
			'RsAddOnPanoramaNotice', 'RsAddOnParticlesNotice', 'RsAddOnPolyfoldNotice', 'Revslider_Prev_Next_Addon_Verify', 'RsAddOnRefreshNotice',
			'Revslider_Related_Posts_Addon_Verify', 'RsAddOnRevealerNotice', 'RsAddOnShapebuilderNotice', 'Revslider_Sharing_Addon_Verify', 'RsAddOnSliceyNotice',
			'RsAddOnSnowNotice', 'RsAddOnSunbeamNotice', 'RsAddOnTypewriterNotice', 'Revslider_Weather_Addon_Verify', 'Revslider_Whiteboard_Addon_Verify',
			'Revslider_Whiteboard_Addon_Verify'
		);
	
		foreach($wp_filter['admin_notices']->callbacks as $k => $o){
			if(!empty($o)){
				foreach($o as $ok => $f){
					if(!isset($f['function'])) continue;
					if(!is_array($f['function'])) continue;
					if(!isset($f['function'][0])) continue;
					if(!is_object($f['function'][0])) continue;
					
					
					$class = get_class($f['function'][0]);
					if(in_array($class, $slugs, true)){
						unset($wp_filter['admin_notices']->callbacks[$k][$ok]);
						$revslider_addon_notice_merged++;
					}
				}
			}
		}
		if($revslider_addon_notice_merged > 0){
			add_action('admin_notices', array($this, 'add_addon_plugins_page_notices'));
		}
	}
	
	/**
	 * add addon merged notices
	 * @since: 6.2.0
	 **/
	public function add_addon_plugins_page_notices(){
		?>
		<div class="error below-h2 soc-notice-wrap revaddon-notice" style="display: none;">
			<p><?php echo __('Action required for Slider Revolution AddOns: Please <a href="//revolution.themepunch.com/" target="_blank">install</a>/<a href="//www.themepunch.com/slider-revolution/install-activate-and-update/#register-purchase-code" target="_blank">activate</a>/<a href="//www.themepunch.com/slider-revolution/install-activate-and-update/#plugin-updates" target="_blank">update</a> Slider Revolution</a>', 'revslider'); ?><span data-addon="rs-addon-notice" data-noticeid="rs-addon-merged-notices" style="float: right; cursor: pointer" class="revaddon-dismiss-notice dashicons dashicons-dismiss"></span></p>
		</div>
		<?php
	}
	
	/**
	 * add plugin notices to the Slider Revolution Plugin at the overview page of plugins
	 **/
	public static function add_plugins_page_notices(){
		$plugins = get_plugins();

		foreach($plugins as $plugin_id => $plugin){
			$slug = dirname($plugin_id);
			if(empty($slug) || $slug !== 'revslider'){
				continue;
			}

			$add = (get_option('revslider-valid', 'false') == 'false' || version_compare(get_option('revslider-latest-version', RS_REVISION), $plugin['Version'], '>')) ? true : false;
			
			if($add){
				add_action('after_plugin_row_' . $plugin_id, array('RevSliderAdmin', 'add_notice_wrap_pre'), 10, 3);
			}

			//check version, latest updates and if registered or not
			if(get_option('revslider-valid', 'false') == 'false'){
				//activate for updates and support
				add_action('after_plugin_row_' . $plugin_id, array('RevSliderAdmin', 'show_purchase_notice'), 10, 3);
			}
			
			if($add){
				add_action('after_plugin_row_' . $plugin_id, array('RevSliderAdmin', 'add_notice_wrap_post'), 10, 3);
			}
		}
	}

	/**
	 * Add the pre HTML for plugin notice on the plugin overview page
	 **/
	public static function add_notice_wrap_pre($plugin_file, $plugin_data, $plugin_status){
		$wp_list_table = _get_list_table('WP_Plugins_List_Table');
		$slug = dirname($plugin_file);
		if(is_network_admin()){
			$active_class = is_plugin_active_for_network($plugin_file) ? ' active' : '';
		}else{
			$active_class = is_plugin_active($plugin_file) ? ' active' : '';
		}
		
		?>
		<tr class="plugin-update-tr<?php echo $active_class; ?>" id="<?php echo $slug; ?>-update" data-plugin="<?php echo $plugin_file; ?>"><td colspan="<?php echo $wp_list_table->get_column_count(); ?>" class="plugin-update colspanchange">
			<div class="update-message notice inline notice-warning notice-alt">
		<?php
	}

	/**
	 * Add the post HTML for plugin notice on the plugin overview page
	 **/
	public static function add_notice_wrap_post($plugin_file, $plugin_data, $plugin_status){
		?>
			</div>
		</tr>
		<?php
	}

	/**
	 * Show message for activation benefits
	 **/
	public static function show_purchase_notice($plugin_file, $plugin_data, $plugin_status){
		?>
		<p>
			<?php _e('Activate Slider Revolution for <a href="https://revolution.themepunch.com/direct-customer-benefits/" target="_blank">Premium Benefits (e.g. Live Updates)</a>.', 'revslider');?>
		</p>
        <?php
	}

	/**
	 * Add the suggested privacy policy text to the policy postbox.
	 */
	public function add_suggested_privacy_content() {
		if(function_exists('wp_add_privacy_policy_content')){
			$content = $this->get_default_privacy_content();
			wp_add_privacy_policy_content(__( 'Slider Revolution'), $content);
		}
	}
	
	/**
	 * Return the default suggested privacy policy content.
	 *
	 * @return string The default policy content.
	 */
	public function get_default_privacy_content(){
		return __('<h2>In case you’re using Google Web Fonts (default) or playing videos or sounds via YouTube or Vimeo in Slider Revolution we recommend to add the corresponding text phrase to your privacy police:</h2>
		<h3>YouTube</h3> <p>Our website uses plugins from YouTube, which is operated by Google. The operator of the pages is YouTube LLC, 901 Cherry Ave., San Bruno, CA 94066, USA.</p> <p>If you visit one of our pages featuring a YouTube plugin, a connection to the YouTube servers is established. Here the YouTube server is informed about which of our pages you have visited.</p> <p>If you\'re logged in to your YouTube account, YouTube allows you to associate your browsing behavior directly with your personal profile. You can prevent this by logging out of your YouTube account.</p> <p>YouTube is used to help make our website appealing. This constitutes a justified interest pursuant to Art. 6 (1) (f) DSGVO.</p> <p>Further information about handling user data, can be found in the data protection declaration of YouTube under <a href="https://www.google.de/intl/de/policies/privacy" target="_blank">https://www.google.de/intl/de/policies/privacy</a>.</p>
		<h3>Vimeo</h3> <p>Our website uses features provided by the Vimeo video portal. This service is provided by Vimeo Inc., 555 West 18th Street, New York, New York 10011, USA.</p> <p>If you visit one of our pages featuring a Vimeo plugin, a connection to the Vimeo servers is established. Here the Vimeo server is informed about which of our pages you have visited. In addition, Vimeo will receive your IP address. This also applies if you are not logged in to Vimeo when you visit our plugin or do not have a Vimeo account. The information is transmitted to a Vimeo server in the US, where it is stored.</p> <p>If you are logged in to your Vimeo account, Vimeo allows you to associate your browsing behavior directly with your personal profile. You can prevent this by logging out of your Vimeo account.</p> <p>For more information on how to handle user data, please refer to the Vimeo Privacy Policy at <a href="https://vimeo.com/privacy" target="_blank">https://vimeo.com/privacy</a>.</p>
		<h3>Google Web Fonts</h3> <p>For uniform representation of fonts, this page uses web fonts provided by Google. When you open a page, your browser loads the required web fonts into your browser cache to display texts and fonts correctly.</p> <p>For this purpose your browser has to establish a direct connection to Google servers. Google thus becomes aware that our web page was accessed via your IP address. The use of Google Web fonts is done in the interest of a uniform and attractive presentation of our plugin. This constitutes a justified interest pursuant to Art. 6 (1) (f) DSGVO.</p> <p>If your browser does not support web fonts, a standard font is used by your computer.</p> <p>Further information about handling user data, can be found at <a href="https://developers.google.com/fonts/faq" target="_blank">https://developers.google.com/fonts/faq</a> and in Google\'s privacy policy at <a href="https://www.google.com/policies/privacy/" target="_blank">https://www.google.com/policies/privacy/</a>.</p>
		<h3>SoundCloud</h3><p>On our pages, plugins of the SoundCloud social network (SoundCloud Limited, Berners House, 47-48 Berners Street, London W1T 3NF, UK) may be integrated. The SoundCloud plugins can be recognized by the SoundCloud logo on our site.</p>
			<p>When you visit our site, a direct connection between your browser and the SoundCloud server is established via the plugin. This enables SoundCloud to receive information that you have visited our site from your IP address. If you click on the “Like” or “Share” buttons while you are logged into your SoundCloud account, you can link the content of our pages to your SoundCloud profile. This means that SoundCloud can associate visits to our pages with your user account. We would like to point out that, as the provider of these pages, we have no knowledge of the content of the data transmitted or how it will be used by SoundCloud. For more information on SoundCloud’s privacy policy, please go to https://soundcloud.com/pages/privacy.</p><p>If you do not want SoundCloud to associate your visit to our site with your SoundCloud account, please log out of your SoundCloud account.</p>', 'revslider');
	}

	/**
	 * The Ajax Action part for backend actions only
	 **/
	public function do_ajax_action(){
		@ini_set('memory_limit', apply_filters('admin_memory_limit', WP_MAX_MEMORY_LIMIT));

		$slider	= new RevSliderSlider();
		$slide	= new RevSliderSlide();

		$action	= $this->get_request_var('client_action');
		$data	= $this->get_request_var('data');
		$data	= ($data == '') ? array() : $data;
		$nonce	= $this->get_request_var('nonce');
		$nonce	= (empty($nonce)) ? $this->get_request_var('rs-nonce') : $nonce;

		try{
			if(RS_DEMO){
				switch ($action){
					case 'get_template_information_short':
					case 'import_template_slider':
					case 'install_template_slider':
					case 'install_template_slide':
					case 'get_list_of':
					case 'get_global_settings':
					case 'get_full_slider_object':
					case 'subscribe_to_newsletter':
					case 'check_system':
					case 'load_module':
					case 'get_addon_list':
					case 'get_layers_by_slide':
					case 'silent_slider_update':
					case 'get_help_directory':
					case 'set_tooltip_preference':
					case 'load_builder':
					case 'load_library_object':
					case 'get_tooltips':
					//case 'preview_slider':
						//these are all okay in demo mode
					break;
					default:
						$this->ajax_response_error(__('Function Not Available in Demo Mode', 'revslider'));
						exit;
					break;
				}
			}

			if(!current_user_can('administrator') && apply_filters('revslider_restrict_role', true)){
				switch($action){
					case 'activate_plugin':
					case 'deactivate_plugin':
					case 'import_template_slider':
					case 'install_template_slider':
					case 'install_template_slide':
					case 'import_slider':
					case 'delete_slider':
					case 'create_navigation_preset':
					case 'delete_navigation_preset':
					case 'save_navigation':
					case 'delete_animation':
					case 'save_animation':
					case 'check_system':
					case 'fix_database_issues':
					case 'trigger_font_deletion':
					case 'get_v5_slider_list':
					case 'reimport_v5_slider':
						$this->ajax_response_error(__('Function Only Available for Adminstrators', 'revslider'));
						exit;
					break;
					default:
						$return = apply_filters('revslider_admin_onAjaxAction_user_restriction', true, $action, $data, $slider, $slide, $operations);
						if($return !== true){
							$this->ajax_response_error(__('Function Only Available for Adminstrators', 'revslider'));
							exit;
						}
					break;
				}
			}

			if(wp_verify_nonce($nonce, 'revslider_actions') == false){
				//check if it is wp nonce and if the action is refresh nonce
				$this->ajax_response_error(__('Bad Request', 'revslider'));
				exit;
			}

			switch($action){
				case 'activate_plugin':
					$result	 = false;
					$code	 = trim($this->get_val($data, 'code'));
					$selling = $this->get_addition('selling');
					$rs_license = new RevSliderLicense();
					
					if(!empty($code)){
						$result = $rs_license->activate_plugin($code);
					}else{
						$error = ($selling === true) ? __('The License Key needs to be set!', 'revslider') : __('The Purchase Code needs to be set!', 'revslider');
						$this->ajax_response_error($error);
						exit;
					}

					if($result === true){
						$this->ajax_response_success(__('Plugin successfully activated', 'revslider'));
					}elseif($result === false){
						$error = ($selling === true) ? __('License Key is invalid', 'revslider') : __('Purchase Code is invalid', 'revslider');
						$this->ajax_response_error($error);
					}else{
						if($result == 'exist'){
							$error = ($selling === true) ? __('License Key already registered!', 'revslider') : __('Purchase Code already registered!', 'revslider');
							$this->ajax_response_error($error);
						}elseif($result == 'banned'){
							$error = ($selling === true) ? __('License Key was locked, please contact the ThemePunch support!', 'revslider') : __('Purchase Code was locked, please contact the ThemePunch support!', 'revslider');
							$this->ajax_response_error($error);
						}
						$error = ($selling === true) ? __('License Key could not be validated', 'revslider') : __('Purchase Code could not be validated', 'revslider');
						$this->ajax_response_error($error);
					}
				break;
				case 'deactivate_plugin':
					$rs_license = new RevSliderLicense();
					$result = $rs_license->deactivate_plugin();

					if($result){
						$this->ajax_response_success(__('Plugin deregistered', 'revslider'));
					}else{
						$this->ajax_response_error(__('Deregistration failed!', 'revslider'));
					}
				break;
				case 'dismiss_dynamic_notice':
					$ids = $this->get_val($data, 'id', array());
					$notices_discarded = get_option('revslider-notices-dc', array());
					if(!empty($ids)){
						foreach($ids as $_id){
							$notices_discarded[] = esc_attr(trim($_id));
						}
						
						update_option('revslider-notices-dc', $notices_discarded);
					}
					
					$this->ajax_response_success(__('Saved', 'revslider'));
				break;
				case 'check_for_updates':
					$update = new RevSliderUpdate(RS_REVISION);
					$update->force = true;
					
					$update->_retrieve_version_info();
					$version = get_option('revslider-latest-version', RS_REVISION);
					
					if($version !== false){
						$this->ajax_response_data(array('version' => $version));
					}else{
						$this->ajax_response_error(__('Connection to Update Server Failed', 'revslider'));
					}
				break;
				case 'get_template_information_short':
					$templates = new RevSliderTemplate();
					$sliders = $templates->get_tp_template_sliders();

					$this->ajax_response_data(array('templates' => $sliders));
				break;
				/*case 'get_template_slides':
						$slider_id		 = $this->get_val($data, 'slider_id');
						$templates		 = new RevSliderTemplate();
						$template_slider = $slider->init_by_id($slider_id);
						$slides			 = $templates->get_tp_template_slides($template_slider);

						$this->ajax_response_data(array('template_slides' => $slides));
				break;*/
				case 'import_template_slider': //before: import_slider_template_slidersview
					$uid		= $this->get_val($data, 'uid');
					$install	= $this->get_val($data, 'install', true);
					$templates	= new RevSliderTemplate();
					$filepath	= $templates->_download_template($uid);

					if($filepath !== false){
						$templates->remove_old_template($uid);
						$slider = new RevSliderSliderImport();
						$return = $slider->import_slider(false, $filepath, $uid, false, true, $install);
						
						if($this->get_val($return, 'success') == true){
							$new_id = $this->get_val($return, 'sliderID');
							if(intval($new_id) > 0){
								$map = $this->get_val($return, 'map',  array());
								$folder_id = $this->get_val($data, 'folderid', -1);
								if(intval($folder_id) > 0){
									$folder = new RevSliderFolder();
									$folder->add_slider_to_folder($new_id, $folder_id, false);
								}

								$new_slider = new RevSliderSlider();
								$new_slider->init_by_id($new_id);
								$data = $new_slider->get_overview_data();

								$hiddensliderid = $templates->get_slider_id_by_uid($uid);
								
								$templates->_delete_template($uid); //delete template file
								
								$this->ajax_response_data(array('slider' => $data, 'hiddensliderid' => $hiddensliderid, 'map' => $map, 'uid' => $uid));
							}
						}
						
						$templates->_delete_template($uid); //delete template file
						
						$error = ($this->get_val($return, 'error') !== '') ? $this->get_val($return, 'error') : __('Slider Import Failed', 'revslider');
						$this->ajax_response_error($error);
					}
					$this->ajax_response_error(__('Template Slider Import Failed', 'revslider'));
				break;
				case 'install_template_slider':
					$id = $this->get_val($data, 'sliderid');
					$new_id = $slider->duplicate_slider_by_id($id, true);
					if(intval($new_id) > 0){
						$new_slider = new RevSliderSlider();
						$new_slider->init_by_id($new_id);
						$data = $new_slider->get_overview_data();
						$slide_maps = $slider->get_map();
						$map = array(
							'slider' => array('template_to_duplication' => array($id => $new_id)),
							'slides' => $slide_maps
						);
						$this->ajax_response_data(array('slider' => $data, 'hiddensliderid' => $id, 'map' => $map));
					}
					$this->ajax_response_error(__('Template Slider Installation Failed', 'revslider'));
				break;
				case 'install_template_slide':
					$template = new RevSliderTemplate();
					$slider_id = intval($this->get_val($data, 'slider_id'));
					$slide_id = intval($this->get_val($data, 'slide_id'));

					if($slider_id == 0 || $slide_id == 0){
					}else{
						$new_slide_id = $slide->duplicate_slide_by_id($slide_id, $slider_id);

						if($new_slide_id !== false){
							$slide->init_by_id($new_slide_id);
							$_slides[] = array(
								'order' => $slide->get_order(),
								'params' => $slide->get_params(),
								'layers' => $slide->get_layers(),
								'id' => $slide->get_id(),
							);

							$this->ajax_response_data(array('slides' => $_slides));
						}
					}

					$this->ajax_response_error(__('Slide duplication failed', 'revslider'));
				break;
				case 'import_slider':
					$import = new RevSliderSliderImport();
					$return = $import->import_slider();

					if($this->get_val($return, 'success') == true){
						$new_id = $this->get_val($return, 'sliderID');

						if(intval($new_id) > 0){
							$folder = new RevSliderFolder();
							$folder_id = $this->get_val($data, 'folderid', -1);
							if(intval($folder_id) > 0){
								$folder->add_slider_to_folder($new_id, $folder_id, false);
							}

							$new_slider = new RevSliderSlider();
							$new_slider->init_by_id($new_id);
							$data = $new_slider->get_overview_data();

							$this->ajax_response_data(array('slider' => $data, 'hiddensliderid' => $new_id));
						}
					}

					$error = ($this->get_val($return, 'error') !== '') ? $this->get_val($return, 'error') : __('Slider Import Failed', 'revslider');

					$this->ajax_response_error($error);
				break;
				case 'add_to_media_library':
					$return = $this->import_upload_media();
					
					if($this->get_val($return, 'error', false) !== false){
						$this->ajax_response_error($this->get_val($return, 'error', false));
					}else{
						$this->ajax_response_data($return);
					}
				break;
				case 'adjust_modal_ids':
					$map = $this->get_val($data, 'map', array());
					
					if(!empty($map)){
						$slider_map = array();
						$slider_ids = $this->get_val($map, 'slider_map', array());
						$slides_ids = $this->get_val($map, 'slides_map', array());
						
						$ztt = $this->get_val($slider_ids, 'zip_to_template', array());
						$ztd = $this->get_val($slider_ids, 'zip_to_duplication', array());
						$ttd = $this->get_val($slider_ids, 'template_to_duplication', array());
						$s_a = array();
						if(!empty($slides_ids)){
							foreach($slides_ids as $k => $v){
								if(is_array($v)){
									foreach($v as $vk => $vv){
										$s_a[$vk] = $vv;
									}
									unset($slides_ids[$k]);
								}
							}
						}
						
						if(!empty($ztt)){
							foreach($ztt as $old => $new){
								$slider = new RevSliderSliderImport();
								$slider->init_by_id($new);
								
								$slider->update_modal_ids($ztt, $slides_ids);
							}
						}
						
						if(!empty($ztd)){
							foreach($ztd as $old => $new){
								$slider = new RevSliderSliderImport();
								$slider->init_by_id($new);
								$slider->update_modal_ids($ztd, $s_a);
							}
						}
						
						if(!empty($ttd)){
							foreach($ttd as $old => $new){
								$slider = new RevSliderSliderImport();
								$slider->init_by_id($new);
								$slider->update_modal_ids($ttd, $slides_ids);
							}
						}
						
						$this->ajax_response_data(array());
					}else{
						$this->ajax_response_error(__('Slider Map Empty', 'revslider'));
					}
				break;
				case 'adjust_js_css_ids':
					$map = $this->get_val($data, 'map', array());
					
					if(!empty($map)){
						$slider_map = array();
						foreach($map as $m){
							$slider_ids = $this->get_val($m, 'slider_map', array());
							if(!empty($slider_ids)){
								foreach($slider_ids as $old => $new){
									$slider = new RevSliderSliderImport();
									$slider->init_by_id($new);
									
									$slider_map[] = $slider;
								}
							}
						}
						
						if(!empty($slider_map)){
							foreach($slider_map as $slider){
								foreach($map as $m){
									$slider_ids = $this->get_val($m, 'slider_map', array());
									$slide_ids = $this->get_val($m, 'slide_map', array());
									if(!empty($slider_ids)){
										foreach($slider_ids as $old => $new){
											$slider->update_css_and_javascript_ids($old, $new, $slide_ids);
										}
									}
								}
							}
						}
					}
				break;
				case 'export_slider':
					$export = new RevSliderSliderExport();
					$id = intval($this->get_request_var('id'));

					$return = $export->export_slider($id);

					//will never be called if all is good
					$this->ajax_response_data($return);
				break;
				case 'export_slider_html':
					$export = new RevSliderSliderExportHtml();
					$id = intval($this->get_request_var('id'));
					$return = $export->export_slider_html($id);

					//will never be called if all is good
					$this->ajax_response_data($return);
				break;
				case 'delete_slider':
					$id = $this->get_val($data, 'id');
					$slider->init_by_id($id);
					$result = $slider->delete_slider();

					$this->ajax_response_success(__('Slider Deleted', 'revslider'));
				break;
				case 'duplicate_slider':
					$id = $this->get_val($data, 'id');
					$new_id = $slider->duplicate_slider_by_id($id);
					if(intval($new_id) > 0){
						$new_slider = new RevSliderSlider();
						$new_slider->init_by_id($new_id);
						$data = $new_slider->get_overview_data();
						$this->ajax_response_data(array('slider' => $data));
					}

					$this->ajax_response_error(__('Duplication Failed', 'revslider'));
				break;
				case 'save_slide':
					$slide_id = $this->get_val($data, 'slide_id');
					$slider_id = $this->get_val($data, 'slider_id');
					$return = $slide->save_slide($slide_id, $data, $slider_id);

					if($return){
						$this->ajax_response_success(__('Slide Saved', 'revslider'));
					}else{
						$this->ajax_response_error(__('Slide not found', 'revslider'));
					}
				break;
				case 'save_slide_advanced':
					$slide_id = $this->get_val($data, 'slide_id');
					$slider_id = $this->get_val($data, 'slider_id');
					$return = $slide->save_slide_advanced($slide_id, $data, $slider_id);
					
					if($return){
						$this->ajax_response_success(__('Slide Saved', 'revslider'));
					}else{
						$this->ajax_response_error(__('Slide not found', 'revslider'));
					}
				break;
				case 'save_slider':
					$slider_id = $this->get_val($data, 'slider_id');
					$slide_ids = $this->get_val($data, 'slide_ids', array());
					$return = $slider->save_slider($slider_id, $data);
					$missing_slides = array();
					$delete_slides = array();

					if($return !== false){
						if(!empty($slide_ids)){
							$slides = $slider->get_slides(false, true);

							//get the missing Slides (if any at all)
							foreach($slide_ids as $slide_id){
								$found = false;
								foreach($slides as $_slide){
									if($_slide->get_id() !== $slide_id){
										continue;
									}

									$found = true;
								}
								if(!$found){
									$missing_slides[] = $slide_id;
								}

							}

							//get the Slides that are no longer needed and delete them
							foreach($slides as $key => $_slide){
								$id = $_slide->get_id();
								if(!in_array($id, $slide_ids)){
									$delete_slides[] = $id;
									unset($slides[$key]); //remove none existing slides for further ordering process
								}
							}

							if(!empty($delete_slides)){
								foreach($delete_slides as $delete_slide){
									$slide->delete_slide_by_id($delete_slide);
								}
							}

							//change the order of slides
							foreach($slide_ids as $order => $id){
								$new_order = $order + 1;
								$_slide->change_slide_order($id, $new_order);
							}
						}

						$this->ajax_response_data(array('missing' => $missing_slides, 'delete' => $delete_slides));
					}else{
						$this->ajax_response_error(__('Slider not found', 'revslider'));
					}
				break;
				case 'delete_slide':
					$slide_id = intval($this->get_val($data, 'slide_id', ''));
					$return = ($slide_id > 0) ? $slide->delete_slide_by_id($slide_id) : false;
					
					if($return !== false){
						$this->ajax_response_success(__('Slide deleted', 'revslider'));
					}else{
						$this->ajax_response_error(__('Slide could not be deleted', 'revslider'));
					}
				break;
				case 'duplicate_slide':
					$slide_id	= intval($this->get_val($data, 'slide_id', ''));
					$slider_id	= intval($this->get_val($data, 'slider_id', ''));
					
					$new_slide_id = $slide->duplicate_slide_by_id($slide_id, $slider_id);
					if($new_slide_id !== false){
						$slide->init_by_id($new_slide_id);
						$_slide = $slide->get_overview_data();
						
						$this->ajax_response_data(array('slide' => $_slide));
					}else{
						$this->ajax_response_error(__('Slide could not duplicated', 'revslider'));
					}
				break;
				case 'update_slide_order':
					$slide_ids	= $this->get_val($data, 'slide_ids', array());
					
					//change the order of slides
					if(!empty($slide_ids)){
						foreach($slide_ids as $order => $id){
							$new_order = $order + 1;
							$slide->change_slide_order($id, $new_order);
						}
						
						$this->ajax_response_success(__('Slide order changed', 'revslider'));
					}else{
						$this->ajax_response_error(__('Slide order could not be changed', 'revslider'));
					}
				break;
				case 'getSliderImage':
					// Available Sliders
					$slider = new RevSliderSlider();
					$arrSliders = $slider->get_sliders();
					$post60		= (version_compare($slider->get_setting('version', '1.0.0'), '6.0.0', '<')) ? false : true;
					// Given Alias
					$alias = $this->get_val($data, 'alias');
					$return = array_search($alias,$arrSliders);

					foreach($arrSliders as $sliderony){
						if( $sliderony->get_alias() == $alias ){
							$slider_found = $sliderony->get_overview_data();
							$return = $slider_found["bg"]["src"];
							$title = $slider_found['title'];
						}
					}

					if(!$return) $return = "";

					if(!empty($title)){
						$this->ajax_response_data(array('image' => $return, 'title' => $title));
					}
					else{
						$this->ajax_response_error( __('The Slider with the alias "' . $alias . '" is not available!', 'revslider') );
					}

				break;
				case 'getSliderSizeLayout':
					// Available Sliders
					$slider = new RevSliderSlider();
					$arrSliders = $slider->get_sliders();
					$post60		= (version_compare($slider->get_setting('version', '1.0.0'), '6.0.0', '<')) ? false : true;
					// Given Alias
					$alias = $this->get_val($data, 'alias');
					
					$return = array_search($alias,$arrSliders);

					foreach($arrSliders as $sliderony){
						if( $sliderony->get_alias() == $alias ){
							$slider_found = $sliderony->get_overview_data();
							$return = $slider_found['size'];
							$title = $slider_found['title'];
						}
					}
					
					$this->ajax_response_data(array('layout' => $return, 'title' => $title));
				break;
				case 'get_list_of':
					$type = $this->get_val($data, 'type');
					switch($type){
						case 'sliders':
							$slider = new RevSliderSlider();
							$arrSliders = $slider->get_sliders();
							$return = array();
							foreach($arrSliders as $sliderony){
								$return[$sliderony->get_id()] = array('slug' => $sliderony->get_alias(), 'title' => $sliderony->get_title(), 'type' => $sliderony->get_type(), 'subtype' => $sliderony->get_param(array('source', 'post', 'subType'), false));
							}
							$this->ajax_response_data(array('sliders' => $return));
						break;
						case 'pages':
							$pages = get_pages(array());
							$return = array();
							foreach($pages as $page){
								if(!$page->post_password){
									$return[$page->ID] = array('slug' => $page->post_name, 'title' => $page->post_title);
								}

							}
							$this->ajax_response_data(array('pages' => $return));
						break;
						case 'posttypes':
							$args = array(
								'public' => true,
								'_builtin' => false,
							);
							$output = 'objects';
							$operator = 'and';
							$post_types = get_post_types($args, $output, $operator);
							$return['post'] = array('slug' => 'post', 'title' => __('Posts', 'revslider'));

							foreach($post_types as $post_type){
								$return[$post_type->rewrite['slug']] = array('slug' => $post_type->rewrite['slug'], 'title' => $post_type->labels->name);
								if(!in_array($post_type->name, array('post', 'page', 'attachment', 'revision', 'nav_menu_item', 'custom_css', 'custom_changeset', 'user_request'))){
									$taxonomy_objects = get_object_taxonomies($post_type->name, 'objects');
									if(!empty($taxonomy_objects)){
										$return[$post_type->rewrite['slug']]['tax'] = array();
										foreach($taxonomy_objects as $name => $tax){
											$return[$post_type->rewrite['slug']]['tax'][$name] = $tax->label;
										}
									}
								}
							}

							$this->ajax_response_data(array('posttypes' => $return));
						break;
					}
				break;
				case 'load_wordpress_object':
					$id = $this->get_val($data, 'id', 0);
					$type = $this->get_val($data, 'type', 'full');
					
					$file = wp_get_attachment_image_src($id, $type);
					if($file !== false){
						$this->ajax_response_data(array('url' => $this->get_val($file, 0)));
					}else{
						$this->ajax_response_error(__('File could not be loaded', 'revslider'));
					}
				break;
				case 'get_global_settings':
					$this->ajax_response_data(array('global_settings' => $this->global_settings));
				break;
				case 'update_global_settings':
					$global = $this->get_val($data, 'global_settings', array());
					if(!empty($global)){
						$return = $this->set_global_settings($global);
						if($return === true){
							$this->ajax_response_success(__('Global Settings saved/updated', 'revslider'));
						}else{
							$this->ajax_response_error(__('Global Settings not saved/updated', 'revslider'));
						}
					}else{
						$this->ajax_response_error(__('Global Settings not saved/updated', 'revslider'));
					}
				break;
				case 'create_navigation_preset':
					$nav = new RevSliderNavigation();
					$return = $nav->add_preset($data);

					if($return === true){
						$this->ajax_response_success(__('Navigation preset saved/updated', 'revslider'), array('navs' => $nav->get_all_navigations_builder()));
					}else{
						if($return === false){
							$return = __('Preset could not be saved/values are the same', 'revslider');
						}

						$this->ajax_response_error($return);
					}
				break;
				case 'delete_navigation_preset':
					$nav = new RevSliderNavigation();
					$return = $nav->delete_preset($data);

					if($return === true){
						$this->ajax_response_success(__('Navigation preset deleted', 'revslider'), array('navs' => $nav->get_all_navigations_builder()));
					}else{
						if($return === false){
							$return = __('Preset not found', 'revslider');
						}

						$this->ajax_response_error($return);
					}
				break;
				case 'save_navigation': //also deletes if requested
					$_nav = new RevSliderNavigation();
					$navs = (array) $this->get_val($data, 'navs', array());
					$delete_navs = (array) $this->get_val($data, 'delete', array());

					if(!empty($delete_navs)){
						foreach($delete_navs as $dnav){
							$_nav->delete_navigation($dnav);
						}
					}

					if(!empty($navs)){
						$_nav->create_update_full_navigation($navs);
					}

					$navigations = $_nav->get_all_navigations_builder();

					$this->ajax_response_data(array('navs' => $navigations));
				break;
				case 'delete_animation':
					$animation_id = $this->get_val($data, 'id');
					$admin = new RevSliderFunctionsAdmin();
					$return = $admin->delete_animation($animation_id);
					if($return){
						$this->ajax_response_success(__('Animation deleted', 'revslider'));
					}else{
						$this->ajax_response_error(__('Deletion failed', 'revslider'));
					}
				break;
				case 'save_animation':
					$admin	= new RevSliderFunctionsAdmin();
					$id		= $this->get_val($data, 'id', false);
					$type	= $this->get_val($data, 'type', 'in');
					$animation = $this->get_val($data, 'obj');

					if($id !== false){
						$return = $admin->update_animation($id, $animation, $type);
					}else{
						$return = $admin->insert_animation($animation, $type);
					}

					if(intval($return) > 0){
						$this->ajax_response_data(array('id' => $return));
					} elseif($return === true){
						$this->ajax_response_success(__('Animation saved', 'revslider'));
					}else{
						if($return == false){
							$this->ajax_response_error(__('Animation could not be saved', 'revslider'));
						}
						$this->ajax_response_error($return);
					}
				break;
				case 'get_slides_by_slider_id':
					$sid	 = intval($this->get_val($data, 'id'));
					$slides	 = array();
					$_slides = $slide->get_slides_by_slider_id($sid);
					
					if(!empty($_slides)){
						foreach($_slides as $slide){
							$slides[] = $slide->get_overview_data();
						}
					}
					
					$this->ajax_response_data(array('slides' => $slides));
				break;
				case 'get_full_slider_object':
					$slide_id = $this->get_val($data, 'id');
					$slide_id = RevSliderFunctions::esc_attr_deep($slide_id);
					$slider_alias = $this->get_val($data, 'alias', '');
					$slider_alias = RevSliderFunctions::esc_attr_deep($slider_alias);
					
					if($slider_alias !== ''){
						$slider->init_by_alias($slider_alias);
						$slider_id = $slider->get_id();
					}else{
						if(strpos($slide_id, 'slider-') !== false){
							$slider_id = str_replace('slider-', '', $slide_id);
						}else{
							$slide->init_by_id($slide_id);

							$slider_id = $slide->get_slider_id();
							if(intval($slider_id) == 0){
								$this->ajax_response_error(__('Slider could not be loaded', 'revslider'));
							}
						}
						
						$slider->init_by_id($slider_id);
					}
					if($slider->inited === false){
						$this->ajax_response_error(__('Slider could not be loaded', 'revslider'));
					}
					
					//create static Slide if the Slider not yet has one
					$static_slide_id = $slide->get_static_slide_id($slider_id);
					$static_slide_id = (intval($static_slide_id) === 0) ? $slide->create_slide($slider_id, '', true) : $static_slide_id;
					
					$static_slide = false;
					if(intval($static_slide_id) > 0){
						$static_slide = new RevSliderSlide();
						$static_slide->init_by_static_id($static_slide_id);
					}
					
					$slides = $slider->get_slides(false, true);
					$_slides = array();
					$_static_slide = array();

					if(!empty($slides)){
						foreach($slides as $s){
							$_slides[] = array(
								'order' => $s->get_order(),
								'params' => $s->get_params(),
								'layers' => $s->get_layers(),
								'id' => $s->get_id(),
							);
						}
					}

					if(!empty($static_slide)){
						$_static_slide = array(
							'params' => $static_slide->get_params(),
							'layers' => $static_slide->get_layers(),
							'id' => $static_slide->get_id(),
						);
					}
					
					$obj = array(
						'id' => $slider_id,
						'alias' => $slider->get_alias(),
						'title' => $slider->get_title(),
						'slider_params' => $slider->get_params(),
						'slider_settings' => $slider->get_settings(),
						'slides' => $_slides,
						'static_slide' => $_static_slide,
					);

					$this->ajax_response_data($obj);
				break;
				case 'load_builder':
					ob_start();
					require_once RS_PLUGIN_PATH . 'admin/views/builder.php';
					$builder = ob_get_contents();
					ob_clean();
					ob_end_clean();

					$this->ajax_response_data($builder);
				break;
				case 'create_slider_folder':
					$folder = new RevSliderFolder();
					$title = $this->get_val($data, 'title', __('New Folder', 'revslider'));
					$parent = $this->get_val($data, 'parentFolder', 0);
					$new = $folder->create_folder($title, $parent);

					if($new !== false){
						$overview_data = $new->get_overview_data();
						$this->ajax_response_data(array('folder' => $overview_data));
					}else{
						$this->ajax_response_error(__('Folder Creation Failed', 'revslider'));
					}
				break;
				case 'delete_slider_folder':
					$id = $this->get_val($data, 'id');
					$folder = new RevSliderFolder();
					$is = $folder->init_folder_by_id($id);
					if($is === true){
						$folder->delete_slider();
						$this->ajax_response_success(__('Folder Deleted', 'revslider'));
					}else{
						$this->ajax_response_error(__('Folder Deletion Failed', 'revslider'));
					}
				break;
				case 'update_slider_tags':
					$id = $this->get_val($data, 'id');
					$tags = $this->get_val($data, 'tags');

					$return = $slider->update_slider_tags($id, $tags);
					if($return == true){
						$this->ajax_response_success(__('Tags Updated', 'revslider'));
					}else{
						$this->ajax_response_error(__('Failed to Update Tags', 'revslider'));
					}
				break;
				case 'save_slider_folder':
					$folder = new RevSliderFolder();
					$children = $this->get_val($data, 'children');
					$folder_id = $this->get_val($data, 'id');

					$return = $folder->add_slider_to_folder($children, $folder_id);

					if($return == true){
						$this->ajax_response_success(__('Slider Moved to Folder', 'revslider'));
					}else{
						$this->ajax_response_error(__('Failed to Move Slider Into Folder', 'revslider'));
					}
				break;
				case 'update_slider_name':
				case 'update_folder_name':
					$slider_id = $this->get_val($data, 'id');
					$new_title = $this->get_val($data, 'title');

					$slider->init_by_id($slider_id, $new_title);
					$return = $slider->update_title($new_title);
					if($return != false){
						$this->ajax_response_data(array('title' => $return), __('Title updated', 'revslider'));
					}else{
						$this->ajax_response_error(__('Failed to update Title', 'revslider'));
					}
				break;
				case 'preview_slider':
					$slider_id = $this->get_val($data, 'id');
					$slider_data = $this->get_val($data, 'data');
					$title = __('Slider Revolution Preview', 'revslider');
					
					if(intval($slider_id) > 0 && empty($slider_data)){
						$slider->init_by_id($slider_id);

						//check if an update is needed
						if(version_compare($slider->get_param(array('settings', 'version')), get_option('revslider_update_version', '6.0.0'), '<')){
							$upd = new RevSliderPluginUpdate();
							$upd->upgrade_slider_to_latest($slider);
							$slider->init_by_id($slider_id);
						}

						$content = '[rev_slider alias="' . esc_attr($slider->get_alias()) . '"][/rev_slider]';
					}elseif(!empty($slider_data)){
						$_slides = array();
						$_static = array();
						$slides = array();
						$static_slide = array();
						
						$_slider = array(
							'id'		=> $slider_id,
							'title'		=> 'Preview',
							'alias'		=> 'preview',
							'settings'	=> json_encode(array('version' => RS_REVISION)),
							'params'	=> stripslashes($this->get_val($slider_data, 'slider'))
						);
						
						$slide_order = json_decode(stripslashes($this->get_val($slider_data, array('slide_order'))), true);
						
						foreach($slider_data as $sk => $sd){
							if(in_array($sk, array('slider', 'slide_order'), true)) continue;
							
							if(strpos($sk, 'static_') !== false){
								$_static = array(
									'params' => stripslashes($this->get_val($sd, 'params')),
									'layers' => stripslashes($this->get_val($sd, 'layers')),
								);
							}else{
								$_slides[$sk] = array(
									'id'		=> $sk,
									'slider_id'	=> $slider_id,
									'slide_order' => array_search($sk, $slide_order),
									'params'	=> stripslashes($this->get_val($sd, 'params')),
									'layers'	=> stripslashes($this->get_val($sd, 'layers')),
									'settings'	=> array('version' => RS_REVISION)
								);
							}
						}
						
						$output = new RevSliderOutput();
						$slider->init_by_data($_slider);
						if($slider->is_stream() || $slider->is_posts()){
							$slides = $slider->get_slides_for_output();
						}else{
							if(!empty($_slides)){
								//reorder slides
								
								usort($_slides, array($this, 'sort_by_slide_order'));
								foreach($_slides as $_slide){
									$slide = new RevSliderSlide();
									$slide->init_by_data($_slide);
									if($slide->get_param(array('publish', 'state'), 'published') === 'unpublished') continue;
									$slides[] = $slide;
								}
							}
						}
						if(!empty($_static)){
							$slide = new RevSliderSlide();
							$slide->init_by_data($_static);
							$static_slide = $slide;
						}
						
						$output->set_slider($slider);
						$output->set_current_slides($slides);
						$output->set_static_slide($static_slide);
						$output->set_preview_mode(true);
						
						ob_start();
						$slider = $output->add_slider_to_stage($slider_id);
						$content = ob_get_contents();
						ob_clean();
						ob_end_clean();
					}
					
					//get dimensions of slider
					$size = array(
						'width'	 => $slider->get_param(array('size', 'width'), array()),
						'height' => $slider->get_param(array('size', 'height'), array()),
						'custom' => $slider->get_param(array('size', 'custom'), array())
					);
					
					if(empty($size['width'])){
						$size['width'] = array(
							'd' => $this->get_val($this->global_settings, array('size', 'desktop'), '1240'),
							'n' => $this->get_val($this->global_settings, array('size', 'notebook'), '1024'),
							't' => $this->get_val($this->global_settings, array('size', 'tablet'), '778'),
							'm' => $this->get_val($this->global_settings, array('size', 'mobile'), '480')
						);
					}
					if(empty($size['height'])){
						$size['height'] = array('d' => '868', 'n' => '768', 't' => '960', 'm' => '720'); 
					}
					
					global $revslider_is_preview_mode;
					$revslider_is_preview_mode = true;
					require_once(RS_PLUGIN_PATH . 'public/includes/functions-public.class.php');
					$rev_slider_front = new RevSliderFront();
					
					$post = $this->create_fake_post($content, $title);
					
					ob_start();
					include(RS_PLUGIN_PATH . 'public/views/revslider-page-template.php');
					$html = ob_get_contents();
					ob_clean();
					ob_end_clean();
					
					$this->ajax_response_data(array('html' => $html, 'size' => $size, 'layouttype' => $slider->get_param('layouttype', 'fullwidth')));
					
					exit;
				break;
				case 'subscribe_to_newsletter':
					$email = $this->get_val($data, 'email');
					if(!empty($email)){
						$return = ThemePunch_Newsletter::subscribe($email);

						if($return !== false){
							if(!isset($return['status']) || $return['status'] === 'error'){
								$error = $this->get_val($return, 'message', __('Invalid Email', 'revslider'));
								$this->ajax_response_error($error);
							}else{
								$this->ajax_response_success(__('Success! Please check your E-Mails to finish the subscription', 'revslider'), $return);
							}
						}
						$this->ajax_response_error(__('Invalid Email/Could not connect to the Newsletter server', 'revslider'));
					}

					$this->ajax_response_error(__('No Email given', 'revslider'));
				break;
				case 'check_system':
					//recheck the connection to themepunch server
					$update = new RevSliderUpdate(RS_REVISION);
					$update->force = true;
					$update->_retrieve_version_info();

					$fun = new RevSliderFunctionsAdmin();
					$system = $fun->get_system_requirements();

					$this->ajax_response_data(array('system' => $system));
				break;
				case 'load_module':
					$module = $this->get_val($data, 'module', array('all'));
					$module_uid = $this->get_val($data, 'module_uid', false);
					$module_slider_id = $this->get_val($data, 'module_id', false);
					$refresh_from_server = $this->get_val($data, 'refresh_from_server', false);
					$get_static_slide = $this->_truefalse($this->get_val($data, 'static', false));
					
					if($module_uid === false){
						$module_uid = $module_slider_id;
					}

					$admin = new RevSliderFunctionsAdmin();
					$modules = $admin->get_full_library($module, $module_uid, $refresh_from_server, $get_static_slide);
					
					$this->ajax_response_data(array('modules' => $modules));
				break;
				case 'set_favorite':
					$do = $this->get_val($data, 'do', 'add');
					$type = $this->get_val($data, 'type', 'slider');
					$id = esc_attr($this->get_val($data, 'id'));

					$favorite = new RevSliderFavorite();
					$favorite->set_favorite($do, $type, $id);

					$this->ajax_response_success(__('Favorite Changed', 'revslider'));
				break;
				case 'load_library_object':
					$library = new RevSliderObjectLibrary();

					$cover = false;
					$id = $this->get_val($data, 'id');
					$type = $this->get_val($data, 'type');
					if($type == 'thumb'){
						$thumb = $library->_get_object_thumb($id, 'thumb');
					}elseif($type == 'video'){
						$thumb = $library->_get_object_thumb($id, 'video_full', true);
						$cover = $library->_get_object_thumb($id, 'cover', true);
					}elseif($type == 'layers'){
						$thumb = $library->_get_object_layers($id);
					}else{
						$thumb = $library->_get_object_thumb($id, 'orig', true);
						if(isset($thumb['error']) && $thumb['error'] === false){
							$orig = $this->get_val($thumb, 'url', false);
							$url = $library->get_correct_size_url($id, $type);
							if($url !== ''){
								$thumb['url'] = $url;
							}
						}
					}

					if(isset($thumb['error']) && $thumb['error'] !== false){
						$this->ajax_response_error(__('Object could not be loaded', 'revslider'));
					}else{
						if($type == 'layers'){
							$return = array('layers' => $this->get_val($thumb, 'data'));
						}else{
							$return = array('url' => $this->get_val($thumb, 'url'));
						}

						if($cover !== false){
							if(isset($cover['error']) && $cover['error'] !== false){
								$this->ajax_response_error(__('Video cover could not be loaded', 'revslider'));
							}

							$return['cover'] = $this->get_val($cover, 'url');
						}

						$this->ajax_response_data($return);
					}
				break;
				case 'create_slide':
					$slider_id = $this->get_val($data, 'slider_id', false);
					$amount = $this->get_val($data, 'amount', 1);
					$amount = intval($amount);
					$slide_ids = array();

					if(intval($slider_id) > 0 && ($amount > 0 && $amount < 50)){
						for ($i = 0; $i < $amount; $i++){
							$slide_ids[] = $slide->create_slide($slider_id);
						}
					}

					if(!empty($slide_ids)){
						$this->ajax_response_data(array('slide_id' => $slide_ids));
					}else{
						$this->ajax_response_error(__('Could not create Slide', 'revslider'));
					}
				break;
				case 'create_slider':
					/**
					 * 1. create a blank Slider
					 * 2. create a blank Slide
					 * 3. create a blank Static Slide
					 **/

					$slide_id = false;
					$slider_id = $slider->create_blank_slider();
					if($slider_id !== false){
						$slide_id = $slide->create_slide($slider_id); //normal slide
						$slide->create_slide($slider_id, '', true); //static slide
					}

					if($slide_id !== false){
						$this->ajax_response_data(array('slide_id' => $slide_id, 'slider_id' => $slider_id));
					}else{
						$this->ajax_response_error(__('Could not create Slider', 'revslider'));
					}
				break;
				case 'get_addon_list':
					$addon = new RevSliderAddons();
					$addons = $addon->get_addon_list();
					
					update_option('rs-addons-counter', 0); //set the counter back to 0
										
					$this->ajax_response_data(array('addons' => $addons));
				break;
				case 'get_layers_by_slide':
					$slide_id = $this->get_val($data, 'slide_id');

					$slide->init_by_id($slide_id);
					$layers = $slide->get_layers();

					$this->ajax_response_data(array('layers' => $layers));
				break;
				case 'activate_addon':
					$handle = $this->get_val($data, 'addon');
					$update = $this->get_val($data, 'update', false);
					$addon = new RevSliderAddons();

					$return = $addon->install_addon($handle, $update);

					if($return === true){
						//return needed files of the plugin somehow
						$data = array();
						$data = apply_filters('revslider_activate_addon', $data, $handle);

						$this->ajax_response_data(array($handle => $data));
					}else{
						$error = ($return === false) ? __('AddOn could not be activated', 'revslider') : $return;
						
						$this->ajax_response_error($error);
					}
				break;
				case 'deactivate_addon':
					$handle = $this->get_val($data, 'addon');
					$addon = new RevSliderAddons();
					$return = $addon->deactivate_addon($handle);

					if($return){
						//return needed files of the plugin somehow
						$this->ajax_response_success(__('AddOn deactivated', 'revslider'));
					}else{
						$this->ajax_response_error(__('AddOn could not be deactivated', 'revslider'));
					}
				break;
				case 'create_draft_page':
					$admin		= new RevSliderFunctionsAdmin();
					$response	= array('open' => false, 'edit' => false);
					$slider_ids = $this->get_val($data, 'slider_ids');
					$modals		= $this->get_val($data, 'modals', array());
					$additions	= $this->get_val($data, 'additions', array());
					$page_id	= $admin->create_slider_page($slider_ids, $modals, $additions);
					
					if($page_id > 0){
						$response['open'] = get_permalink($page_id);
						$response['edit'] = get_edit_post_link($page_id);
					}
					$this->ajax_response_data($response);
				break;
				case 'generate_attachment_metadata':
					$this->generate_attachment_metadata();
					$this->ajax_response_success('');
				break;
				case 'export_layer_group': //developer function only :)
					$title = $this->get_val($data, 'title', $this->get_request_var('title'));
					$videoid = intval($this->get_val($data, 'videoid', $this->get_request_var('videoid')));
					$thumbid = intval($this->get_val($data, 'thumbid', $this->get_request_var('thumbid')));
					$layers = $this->get_val($data, 'layers', $this->get_request_var('layers'));

					$export = new RevSliderSliderExport($title);
					$url = $export->export_layer_group($videoid, $thumbid, $layers);

					$this->ajax_response_data(array('url' => $url));
				break;
				case 'silent_slider_update':
					$upd = new RevSliderPluginUpdate();
					$return = $upd->upgrade_next_slider();
					
					$this->ajax_response_data($return);
				break;
				case 'load_wordpress_image':
					$id = $this->get_val($data, 'id', 0);
					$type = $this->get_val($data, 'type', 'orig');
					
					$img = wp_get_attachment_image_url($id, $type);
					if(empty($img)){
						$this->ajax_response_error(__('Image could not be loaded', 'revslider'));
					}
					
					$this->ajax_response_data(array('url' => $img));
				break;
				case 'load_library_image':
					$images	= (!is_array($data)) ? (array)$data : $data;
					$images	= RevSliderFunctions::esc_attr_deep($images);
					$images	= RevSliderAdmin::esc_js_deep($images);
					$img_data = array();
					
					if(!empty($images)){
						$templates = new RevSliderTemplate();
						$obj = new RevSliderObjectLibrary();
						
						foreach($images as $image){
							$type = $this->get_val($image, 'librarytype');
							$img = $this->get_val($image, 'id');
							$ind = $this->get_val($image, 'ind');
							$mt = $this->get_val($image, 'mediatype');
							switch($type){
								case 'moduletemplates':
								case 'moduletemplateslides':
									$img = $templates->_check_file_path($img, true);
									$img_data[] = array(
										'ind' => $ind,
										'url' => $img,
										'mediatype' => $mt
									);
								break;
								case 'image':
								case 'images':
								case 'layers':
								case 'objects':
									$get = ($mt === 'video') ? 'video_thumb' : 'thumb';
									$img = $obj->_get_object_thumb($img, $get, true);
									if($this->get_val($img, 'error', false) === false){
										$img_data[] = array(
											'ind' => $ind,
											'url' => $this->get_val($img, 'url'),
											'mediatype' => $mt
										);
									}
								break;
								case 'videos':
									$get = ($mt === 'img') ? 'video' : 'video_thumb';
									$img = $obj->_get_object_thumb($img, $get, true);
									if($this->get_val($img, 'error', false) === false){
										$img_data[] = array(
											'ind' => $ind,
											'url' => $this->get_val($img, 'url'),
											'mediatype' => $mt
										);
									}
								break;
							}
						}
					}
					
					$this->ajax_response_data(array('data' => $img_data));
				break;
				case 'get_help_directory':
					include_once(RS_PLUGIN_PATH . 'admin/includes/help.class.php');

					if(class_exists('RevSliderHelp')){
						$help_data = RevSliderHelp::getIndex();
						$this->ajax_response_data(array('data' => $help_data));
					}else{
						$return = '';
					}
				break;
				case 'get_tooltips':
					include_once(RS_PLUGIN_PATH . 'admin/includes/tooltips.class.php');

					if(class_exists('RevSliderTooltips')){
						$tooltips = RevSliderTooltips::getTooltips();
						$this->ajax_response_data(array('data' => $tooltips));
					}else{
						$return = '';
					}
				break;
				case 'set_tooltip_preference':
					update_option('revslider_hide_tooltips', true);
					$return = 'Preference Updated';
				break;
				case 'save_color_preset':
					$presets = $this->get_val($data, 'presets', array());
					$color_presets = RSColorpicker::save_color_presets($presets);
					$this->ajax_response_data(array('presets' => $color_presets));
				break;
				case 'get_facebook_photosets':
					if(!empty($data['url'])){
						$facebook = new RevSliderFacebook();
						$return = $facebook->get_photo_set_photos_options($data['url'], $data['album'], $data['app_id']);
						
						if(empty($return)){
							$error = __('Could not fetch Facebook albums', 'revslider');
							$this->ajax_response_error($error);	
						}
						else {
							if( !isset( $return[0] ) || $return[0] != "error" ) {
								$this->ajax_response_success(__('Successfully fetched Facebook albums', 'revslider'), array('html' => implode(' ', $return)));
							}
							else {
								$error = $return[1];
								$this->ajax_response_error($error);	
							}
						}
						
						/*
						if(!empty($return) && ( isset($return[0]) ) ){
							$this->ajax_response_success(__('Successfully fetched Facebook albums', 'revslider'), array('html' => implode(' ', $return)));
						}else{
							$error = __('Could not fetch Facebook albums', 'revslider');
							$this->ajax_response_error($error);	
						}*/
					}else{
						$this->ajax_response_success(__('Cleared Albums', 'revslider'), array('html' => implode(' ', $return)));
					}
				break;
				case 'get_flickr_photosets':
					$error = __('Could not fetch flickr photosets', 'revslider');
					if(!empty($data['url']) && !empty($data['key'])){
						$flickr = new RevSliderFlickr($data['key']);
						$user_id = $flickr->get_user_from_url($data['url']);
						$return = $flickr->get_photo_sets($user_id, $data['count'], $data['set']);
						if(!empty($return)){
							$this->ajax_response_success(__('Successfully fetched flickr photosets', 'revslider'), array('data' => array('html' => implode(' ', $return))));
						}else{
							$error = __('Could not fetch flickr photosets', 'revslider');
						}
					}else{
						if(empty($data['url']) && empty($data['key'])){
							$this->ajax_response_success(__('Cleared Photosets', 'revslider'), array('html' => implode(' ', $return)));
						}elseif(empty($data['url'])){
							$error = __('No User URL - Could not fetch flickr photosets', 'revslider');
						}else{
							$error = __('No API KEY - Could not fetch flickr photosets', 'revslider');
						}
					}
					
					$this->ajax_response_error($error);
				break;
				case 'get_youtube_playlists':
					if(!empty($data['id'])){
						$youtube = new RevSliderYoutube(trim($data['api']), trim($data['id']));
						$return = $youtube->get_playlist_options($data['playlist']);
						$this->ajax_response_success(__('Successfully fetched YouTube playlists', 'revslider'), array('data' => array('html' => implode(' ', $return))));
					}else{
						$this->ajax_response_error(__('Could not fetch YouTube playlists', 'revslider'));
					}
				break;
				case 'fix_database_issues':
					update_option('revslider_table_version', '1.0.0');
					
					RevSliderFront::create_tables(true);
					
					$this->ajax_response_success(__('Slider Revolution database structure was updated', 'revslider'));
				break;
				case 'trigger_font_deletion':
					$this->delete_google_fonts();
					
					$this->ajax_response_success(__('Downloaded Google Fonts will be updated', 'revslider'));
				break;
				case 'get_same_aspect_ratio':
					$images = $this->get_val($data, 'images', array());
					$return = $this->get_same_aspect_ratio_images($images);
					
					$this->ajax_response_data(array('images' => $return));
				break;
				case 'get_addons_sizes':
					$addons = $this->get_val($data, 'addons', array());
					$sizes = $this->get_addon_sizes($addons);
					
					$this->ajax_response_data(array('addons' => $sizes));
				break;
				case 'get_v5_slider_list':
					$admin = new RevSliderFunctionsAdmin();
					$sliders = $admin->get_v5_slider_data();
					
					$this->ajax_response_data(array('slider' => $sliders));
				break;
				case 'reimport_v5_slider':
					$status = false;
					if(!empty($data['id'])){
						$admin = new RevSliderFunctionsAdmin();
						$status = $admin->reimport_v5_slider($data['id']);
					}
					if($status === false){
						$this->ajax_response_error(__('Slider could not be transfered to v6', 'revslider'));
					}else{
						$this->ajax_response_success(__('Slider transfered to v6', 'revslider'));
					}
				break;
				default:
					$return = ''; //''is not allowed to be added directly in apply_filters(), so its needed like this
					$return = apply_filters('revslider_do_ajax', $return, $action, $data);
					if($return){
						if(is_array($return)){
							//if(isset($return['message'])) $this->ajax_response_success($return["message"]);
							if(isset($return['message'])){
								$this->ajax_response_data(array('message' => $return['message'], 'data' => $return['data']));
							}

							$this->ajax_response_data(array('data' => $return['data']));
						}else{
							$this->ajax_response_success($return);
						}
					}else{
						$return = '';
					}
				break;
			}
		}catch(Exception $e){
			$message = $e->getMessage();
			if(in_array($action, array('preview_slide', 'preview_slider'))){
				echo $message;
				wp_die();
			}
			$this->ajax_response_error($message);
		}

		//it's an ajax action, so exit
		$this->ajax_response_error(__('No response on action', 'revslider'));
		wp_die();
	}

	/**
	 * Ajax handling for frontend, no privileges here
	 */
	public function do_front_ajax_action(){
		$token = $this->get_post_var('token', false);

		//verify the token
		$is_verified = wp_verify_nonce($token, 'RevSlider_Front');

		$error = false;
		if($is_verified){
			$data = $this->get_post_var('data', false);
			switch($this->get_post_var('client_action', false)){
				case 'get_slider_html':
					$alias = $this->get_post_var('alias', '');
					$usage = $this->get_post_var('usage', '');
					$modal = $this->get_post_var('modal', '');
					$layout = $this->get_post_var('layout', '');
					$offset = $this->get_post_var('offset', '');
					$id = intval($this->get_post_var('id', 0));
					
					//check if $alias exists in database, transform it to id
					if($alias !== ''){
						$sr = new RevSliderSlider();
						$id = intval($sr->alias_exists($alias, true));
					}
					
					if($id > 0){
						$html = '';
						ob_start();
						$slider = new RevSliderOutput();
						$slider->set_ajax_loaded();
						
						$slider_class = $slider->add_slider_to_stage($id, $usage, $layout, $offset, $modal);
						$html = ob_get_contents();
						ob_clean();
						ob_end_clean();
						
						$result = (!empty($slider_class) && $html !== '') ? true : false;
						
						if(!$result){
							$error = __('Slider not found', 'revslider');
						}else{
							if($html !== false){
								$this->ajax_response_data($html);
							}else{
								$error = __('Slider not found', 'revslider');
							}
						}
					}else{
						$error = __('No Data Received', 'revslider');
					}
				break;
			}
		}else{
			$error = true;
		}

		if($error !== false){
			$show_error = ($error !== true) ? __('Loading Error', 'revslider') : __('Loading Error: ', 'revslider') . $error;

			$this->ajax_response_error($show_error, false);
		}
		exit;
	}

	/**
	 * echo json ajax response as error
	 * @before: RevSliderBaseAdmin::ajaxResponseError();
	 */
	protected function ajax_response_error($message, $data = null){
		$this->ajax_response(false, $message, $data, true);
	}

	/**
	 * echo ajax success response with redirect instructions
	 * @before: RevSliderBaseAdmin::ajaxResponseSuccessRedirect();
	 */
	protected function ajax_response_redirect($message, $url){
		$data = array('is_redirect' => true, 'redirect_url' => $url);

		$this->ajax_response(true, $message, $data, true);
	}

	/**
	 * echo json ajax response, without message, only data
	 * @before: RevSliderBaseAdmin::ajaxResponseData()
	 */
	protected function ajax_response_data($data){
		$data = (gettype($data) == 'string') ? array('data' => $data) : $data;

		$this->ajax_response(true, '', $data);
	}

	/**
	 * echo ajax success response
	 * @before: RevSliderBaseAdmin::ajaxResponseSuccess();
	 */
	protected function ajax_response_success($message, $data = null){

		$this->ajax_response(true, $message, $data, true);
	}

	/**
	 * echo json ajax response
	 * before: RevSliderBaseAdmin::ajaxResponse
	 */
	private function ajax_response($success, $message, $data = null){

		$response = array(
			'success' => $success,
			'message' => $message,
		);

		if(!empty($data)){
			if(gettype($data) == 'string'){
				$data = array('data' => $data);
			}

			$response = array_merge($response, $data);
		}

		echo json_encode($response);

		wp_die();
	}

	
	/**
	 * set the page that should be shown
	 **/
	private function set_current_page(){
		$view = $this->get_get_var('view');
		$this->view = (empty($view)) ? 'sliders' : $this->get_get_var('view');
	}

	/**
	 * include/display the previously set page
	 * only allow certain pages to be showed
	 **/
	public function display_admin_page(){
		try{
			if(!in_array($this->view, $this->allowed_views)){
				$this->throw_error(__('Bad Request', 'revslider'));
			}

			switch ($this->view){
			//switch URLs to corresponding php files
			case 'slide':
				$view = 'builder';
				break;
			case 'sliders':
			default:
				$view = 'overview';
				break;
			}

			$this->validate_filepath($this->path_views . $view . '.php', 'View');

			require $this->path_views . 'header.php';
			require $this->path_views . $view . '.php';
			require $this->path_views . 'footer.php';

		}catch(Exception $e){
			$this->show_error($this->view, $e->getMessage());
		}
	}
	
	
	/**
	 * show an nice designed error
	 **/
	public function show_error($view, $message){
		echo '<div class="rs-error">';
		echo __('Slider Revolution encountered the following error: ', 'revslider');
		echo esc_attr($view);
		echo ' - Error: <span>';
		echo esc_attr($message);
		echo '</span>';
		echo '</div>';
		exit;
	}
	
	
	/**
	 * validate that some file exists, if not - throw error
	 * @before: RevSliderFunctions::validateFilepath
	 */
	public function validate_filepath($filepath, $prefix = null){
		if(file_exists($filepath) == true) return true;
		
		$prefix	 = ($prefix == null) ? 'File' : $prefix;
		$message = $prefix.' '.esc_attr($filepath).' not exists!';
		
		$this->throw_error($message);
	}
	
	
	/**
	 * Create a temporary fake page/post
	 * @since: 6.0
	 **/
	public function create_fake_post($content, $title = 'Slider Revolution'){
		$post				 = new stdClass();
		$post->ID			 = -1;
		$post->post_author	 = get_current_user_id();
		$post->post_date	 = current_time('mysql');
		$post->post_date_gmt = current_time('mysql', 1);
		$post->post_title	 = $title;
		$post->post_content	 = $content;
		$post->post_status	 = 'publish';
		$post->comment_status = 'closed';
		$post->ping_status	 = 'closed';
		$post->post_name	 = 'rs-fake-page-' . rand(1, 99999); //append random number to avoid clash
		$post->post_type	 = 'page';
		$post->filter		 = 'raw'; //important
		
		//$post->post_meta		= new stdClass();
		//$post->post_meta->_wp_page_template= '../public/views/revslider-page-template.php';
		
		//Convert to WP_Post object
		$wp_post = new WP_Post($post);
		//Add the fake post to the cache
		wp_cache_add(-1, $wp_post, 'posts');
		
		global $wp, $wp_query;

		// Update the main query
		$wp_query->queried_object_id = -1;
		$wp_query->post				 = $wp_post;
		$wp_query->posts			 = array($wp_post);
		$wp_query->queried_object	 = $wp_post;
		$wp_query->found_posts		 = 1;
		$wp_query->post_count		 = 1;
		$wp_query->max_num_pages	 = 1;
		$wp_query->is_page			 = true;
		$wp_query->is_singular		 = true;
		$wp_query->is_single		 = false;
		$wp_query->is_attachment	 = false;
		$wp_query->is_archive		 = false;
		$wp_query->is_category		 = false;
		$wp_query->is_tag			 = false;
		$wp_query->is_tax			 = false;
		$wp_query->is_author		 = false;
		$wp_query->is_date			 = false;
		$wp_query->is_year			 = false;
		$wp_query->is_month			 = false;
		$wp_query->is_day			 = false;
		$wp_query->is_time			 = false;
		$wp_query->is_search		 = false;
		$wp_query->is_feed			 = false;
		$wp_query->is_comment_feed	 = false;
		$wp_query->is_trackback		 = false;
		$wp_query->is_home			 = false;
		$wp_query->is_embed			 = false;
		$wp_query->is_404			 = false;
		$wp_query->is_paged			 = false;
		$wp_query->is_admin			 = false;
		$wp_query->is_preview		 = false;
		$wp_query->is_robots		 = false; 
		$wp_query->is_posts_page	 = false;
		$wp_query->is_post_type_archive	= false;
		
		//Update globals
		$GLOBALS['wp_query'] = $wp_query;
		$wp->register_globals();
		
		return $wp_post;
	}
	
	
	/**
	 * esc attr recursive
	 * @since: 6.0
	 */
	public static function esc_js_deep($value){
		$value = is_array($value) ? array_map(array('RevSliderAdmin', 'esc_js_deep'), $value) : esc_js($value);
		
		return $value;
	}
	
	
	/**
	 * generate missing attachement metadata for images
	 * @since: 6.0
	 **/
	public function generate_attachment_metadata(){
		$rs_meta_create = get_option('rs_image_meta_todo', array());
		
		if(!empty($rs_meta_create)){
			foreach($rs_meta_create as $attach_id => $save_dir){
				if($attach_data = @wp_generate_attachment_metadata($attach_id, $save_dir)){
					@wp_update_attachment_metadata($attach_id, $attach_data);
				}
				unset($rs_meta_create[$attach_id]);
				
				update_option('rs_image_meta_todo', $rs_meta_create);
			}
		}
	}

}