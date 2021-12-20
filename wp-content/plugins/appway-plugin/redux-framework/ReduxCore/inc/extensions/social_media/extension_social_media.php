<?php

/**
 * social media field extension class.
 *
 * @version     1.0.0
 */
/* exit if accessed directly. */
if ( !defined( 'ABSPATH' ) )
	exit;
	
/* don't duplicate me! */
if ( !class_exists( 'ReduxFramework_extension_social_media' ) ) {


	/**
	 *  ReduxFramework_extension_social_media class.
	 *
	 * @since       1.0.0
	 */
	

	class ReduxFramework_extension_social_media extends ReduxFramework {

		/**
		 * @access      protected
		 * @since       1.0.0
		 * @var         array      $parent             ReduxFramework object
		 */
		protected $parent;

		/**
		 * @access      public
		 * @static
		 * @since       1.0.0
		 * @var         object      $instance       singleton instance
		 */
		public static $instance;

		public $folder_path;

		/**
		 * class Constructor - defines the args for the extions class.
		 *
		 * @access      public
		 * @since       1.0.0         
		 * @param       array $sections             panel sections
		 * @param       array $args                 panel arguments
		 * @param       array $extra_tabs           extra panel tabs
		 * @return      void
		 */
		public function __construct( $parent ) {
			$this->folder_path =  APPWAYPLUGIN_PLUGIN_PATH.'redux-framework/';
			$this->parent = $parent;
			$this->field_name = 'social_media';

			if ( !isset( self::$instance ) ) {
				self::$instance = $this;
			}

			/* implement custom field. */
			add_filter( 'redux/' . $this->parent->args['opt_name'] . '/field/class/' . $this->field_name, array( $this, 'overload_field_path' ) );
		}

		/* __construct() */

		/**
		 * get singleton instance.
		 *
		 * @access      public
		 * @static
		 * @since       1.0.0
		 * @return      object      $instance       singleton instance
		 */
		public static function getInstance() {

			if ( !isset( self::$instance ) ) {

				/* instance class. */
				self::$instance = new self;
			}

			return self::$instance;
		}

		/* get_instance() */

		/**
		 * implement custom field.
		 * 
		 * @access      public
		 * @static
		 * @since       1.0.0
		 * @return      object      $instance       singleton instance
		 */
		public function overload_field_path( $field ) {
			//print_r(CPATH.'panal/redux-extensions/extensions/' . $this->field_name . '/' . $this->field_name . '.php');exit();
			
			return APPWAYPLUGIN_PLUGIN_PATH.'redux-framework/ReduxCore/inc/extensions/' . $this->field_name . '/' . $this->field_name . '.php';
			

		}

		/* overload_field_path() */
	}

	/* class */
}   /* if */
