<?php

namespace APPWAY\Includes\Classes;


/**
 * Header and Enqueue class
 */
class Options {

	public static $instance;

	/**
	 * Set this value for theme options key
	 *
	 * @var string
	 */
	private $opt_name = APPWAY_NAME . '_options';

	private $menu_title = '';

	private $page_title = '';

	private $menu_type = 'submenu';

	private $page_slug = APPWAY_NAME . '_options';

	private $customizer = true;

	private $admin_bar_icon = 'dashicons-portfolio';

	private $page_parent = 'themes.php';

	private $menu_icon = 'dashicons-settings';

	private $docs_link = '#';

	private $google_api_key = '';

	function init() {

		if ( ! class_exists( 'Redux' ) ) {
			return;
		}

		$this->opt_name   = apply_filters( 'redux_demo/opt_name', $this->opt_name );
		$this->menu_title = esc_html__( 'APPWAY Options', 'appway' );
		$this->page_title = esc_html__( 'APPWAY Options', 'appway' );

		$this->args();

		$this->sections();
	}

	public static function instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * [args description]
	 *
	 * @return [type] [description]
	 */
	function args() {

		/**s
		 * ---> SET ARGUMENTS
		 * All the possible arguments for Redux.
		 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
		 * */

		$theme = wp_get_theme(); // For use with some settings. Not necessary.

		$args = array(
			/*TYPICAL -> Change these values as you need/desire*/
			'opt_name'             => $this->opt_name,
			/*This is where your data is stored in the database and also becomes your global variable name.*/
			'display_name'         => $theme->get( 'Name' ),
			/*Name that appears at the top of your panel*/
			'display_version'      => $theme->get( 'Version' ),
			/*Version that appears at the top of your panel*/
			'menu_type'            => $this->menu_type,
			/*Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)*/
			'allow_sub_menu'       => true,
			/*Show the sections below the admin menu item or not*/
			'menu_title'           => $this->menu_title,
			'page_title'           => $this->page_title,
			/*You will need to generate a Google API key to use this feature.
			Please visit: https://developers.google.com/fonts/docs/developer_api#Auth*/
			'google_api_key'       => $this->google_api_key,
			/*Set it you want google fonts to update weekly. A google_api_key value is required.*/
			'google_update_weekly' => false,
			/*Must be defined to add google fonts to the typography module*/
			'async_typography'     => true,
			/*Use a asynchronous font on the front end or font string
			'disable_google_fonts_link' => true,                     Disable this in case you want to create your own google fonts loader*/
			'admin_bar'            => true,
			/*Show the panel pages on the admin bar*/
			'admin_bar_icon'       => $this->admin_bar_icon,
			/*Choose an icon for the admin bar menu*/
			'admin_bar_priority'   => 50,
			/*Choose an priority for the admin bar menu*/
			'global_variable'      => 'appway_options',
			/*Set a different name for your global variable other than the opt_name*/
			'dev_mode'             => false,
			/*Show the time the page took to load, etc*/
			'update_notice'        => false,
			/*If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo*/
			'customizer'           => $this->customizer,
			/*Enable basic customizer support
			'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
			'disable_save_warn' => true,                    // Disable the save warning when a user changes a field*/

			/*OPTIONAL -> Give you extra features*/
			'page_priority'        => null,
			/*Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.*/
			'page_parent'          => $this->page_parent,
			/*For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters*/
			'page_permissions'     => 'manage_options',
			/*Permissions needed to access the options panel.*/
			'menu_icon'            => '',
			/*Specify a custom URL to an icon*/
			'last_tab'             => '',
			/*Force your panel to always open to a specific tab (by id)*/
			'page_icon'            => 'icon-themes',
			/*Icon displayed in the admin panel next to your menu_title*/
			'page_slug'            => $this->page_slug,
			/*Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided*/
			'save_defaults'        => true,
			/*On load save the defaults to DB before user clicks save or not*/
			'default_show'         => false,
			/*If true, shows the default value next to each field that is not the default value.*/
			'default_mark'         => '',
			/*What to print by the field's title if the value shown is default. Suggested: **/
			'show_import_export'   => true,
			/*Shows the Import/Export panel when not used as a field.*/
			/*CAREFUL -> These options are for advanced use only*/
			'transient_time'       => 60 * MINUTE_IN_SECONDS,
			'output'               => true,
			/*Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output*/
			'output_tag'           => true,
			/*Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
			'footer_credit'     => '',                    Disable the footer credit of Redux. Please leave if you can help it.

			FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.*/
			'database'             => 'theme_mods',
			/*possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!*/
			'use_cdn'              => true,
			/*If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

			HINTS*/
			'hints'                => array(
				'icon'          => 'el el-question-sign',
				'icon_position' => 'right',
				'icon_color'    => 'lightgray',
				'icon_size'     => 'normal',
				'tip_style'     => array(
					'color'   => 'red',
					'shadow'  => true,
					'rounded' => false,
					'style'   => '',
				),
				'tip_position'  => array(
					'my' => 'top left',
					'at' => 'bottom right',
				),
				'tip_effect'    => array(
					'show' => array(
						'effect'   => 'slide',
						'duration' => '500',
						'event'    => 'mouseover',
					),
					'hide' => array(
						'effect'   => 'slide',
						'duration' => '500',
						'event'    => 'click mouseleave',
					),
				),
			),
		);



		// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
		$args['share_icons'][] = array(
			'url'   => 'https://www.pinterest.com/template-path_/',
			'title' => 'Visit us on Pinterest',
			'icon'  => 'el el-pinterest',
		);
		$args['share_icons'][] = array(
			'url'   => 'https://www.facebook.com/people/@/template-path',
			'title' => 'Like us on Facebook',
			'icon'  => 'el el-facebook',
		);
		$args['share_icons'][] = array(
			'url'   => 'https://twitter.com/template-path',
			'title' => 'Follow us on Twitter',
			'icon'  => 'el el-twitter',
		);
		$args['share_icons'][] = array(
			'url'   => 'https://www.linkedin.com/company/template-path-web-arcade',
			'title' => 'Find us on LinkedIn',
			'icon'  => 'el el-linkedin',
		);

		// Panel Intro text -> before the form
		if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
			if ( ! empty( $args['global_variable'] ) ) {
				$v = $args['global_variable'];
			} else {
				$v = str_replace( '-', '_', $args['opt_name'] );
			}
			$args['intro_text'] = '';
		} else {
			$args['intro_text'] = '';
		}

		// Add content after the form.
		$args['footer_text'] = '';
		\Redux::setArgs( $this->opt_name, $args );
		do_action( 'templatepath/themes/after_redux_setup', $this->opt_name, $args );
	}


	function helpTabs() {

		/*
	     * ---> START HELP TABS
	     */

		$tabs = array(
			array(
				'id'      => 'redux-help-tab-1',
				'title'   => esc_html__( 'Theme Information 1', 'appway' ),
				'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'appway' ),
			),
			array(
				'id'      => 'redux-help-tab-2',
				'title'   => esc_html__( 'Theme Information 2', 'appway' ),
				'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'appway' ),
			),
		);
		Redux::setHelpTab( $opt_name, $tabs );

		// Set the help sidebar
		$content = '<p>' . esc_html__( 'This is the sidebar content, HTML is allowed.', 'appway' ) . '</p>';
		Redux::setHelpSidebar( $opt_name, $content );
	}


	function sections() {

		$sections = array(
			'general_setting',
			'logo_setting',
			'headers_setting',
			'footer_setting',
			'blog_setting',
			'tag_setting',
			'archive_setting',
			'author_setting',
			'category_setting',
			'search_setting',
			'404_setting',
			'single_post_setting',
			'language_setting',
			'shop_setting',
			'product_setting',
			'sidebar_setting',
			'custom_fonts_setting',
			'typography_setting',
			'heading_setting',
			'body_font_setting',

		);


		$sections_path = array();

		// Set the path for options.
		foreach ( $sections as $sec ) {
			$sections_path[ $sec ] = get_template_directory() . '/includes/resource/options/' . $sec . '.php';
		}

		$sections_path = apply_filters( 'appway_redux_sections', $sections_path );

		$count = 1;


		foreach ( $sections_path as $key => $file ) {

			if ( file_exists( $file ) ) {

				$options = include( $file );

				$options['priority'] = $count;

				$options = apply_filters( "appway_redux_sections_{$key}", $options );

				\Redux::setSection( $this->opt_name, $options );
			}

			$count ++;
		}
	}
}

