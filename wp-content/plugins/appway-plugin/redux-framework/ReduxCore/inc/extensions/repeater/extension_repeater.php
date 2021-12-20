<?php

if (!class_exists('ReduxFramework_Extension_repeater')) {


    /**
     * Main ReduxFramework css_layout extension class
     *
     * @since       1.0.0
     */
    class ReduxFramework_Extension_repeater extends ReduxFramework {

        public static $version = '1.0.4';
        // Protected vars
        protected $parent;
        public static $instance;

        public function __construct($parent) {

            $this->parent = $parent;
            $this->field_name = 'repeater';

            if (!isset(self::$instance)) {
                self::$instance = $this;
            }

            // Adds the local field

            add_filter('redux/' . $this->parent->args['opt_name'] . '/field/class/' . $this->field_name, array($this, 'overload_field_path'));
        }

        static public function getInstance() {
            if (!isset(self::$instance)) {

                /* instance class. */
                self::$instance = new self;
            }

            return self::$instance;
        }

        // Forces the use of the embeded field path vs what the core typically would use
        public function overload_field_path($field) {
            //print_r(ABSPATH.'wp-content/plugins/medicalist');
            //exit();
            return ABSPATH . 'wp-content/plugins/medicalist/panel/redux-extensions/extensions/' . $this->field_name . '/' . $this->field_name . '/field_' . $this->field_name . '.php';
        }

    }

    // class
} // if
