<?php

/**
 * AvadaRedux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * AvadaRedux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with AvadaRedux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     AvadaRedux_Framework
 * @subpackage  Premium Extensions
 * @author      Dovy Paukstys (dovy)
 * @version 1.0.0
 * @since 3.1.7
 */
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

// Don't duplicate me!
if (!class_exists('ReduxFramework_Extension_search')) {

    class ReduxFramework_Extension_search {

        static $version = "1.0.1";
        // Protected vars
        protected $parent;

        /**
         * Class Constructor. Defines the args for the extions class
         *
         * @since       1.0.0
         * @access      public
         * @param       array $parent AvadaRedux_Options class instance
         * @return      void
         */
        public function __construct($parent) {


            $this->parent = $parent;

            if (empty($this->extension_dir)) {
                $this->_extension_dir = trailingslashit(str_replace('\\', '/', APPWAYPLUGIN_PLUGIN_PATH.'redux-framework/ReduxCore/inc/extensions/search'));
         
                //$this->_extension_url = trailingslashit(get_template_directory_uri()) . '/core/application/panel/redux-extensions/extensions/search';
                 $this->_extension_url = site_url(str_replace(trailingslashit(str_replace('\\', '/', ABSPATH)), '', $this->_extension_dir));
            }

            // Allow users to extend if they want
            do_action('redux/search/' . $parent->args['opt_name'] . '/construct');

            global $pagenow;
            if (isset($_GET['page']) && $_GET['page'] && $_GET['page'] == $this->parent->args['page_slug']) {
                add_action('admin_enqueue_scripts', array($this, '_enqueue'), 0);
            }

            add_action("redux/metaboxes/{$this->parent->args['opt_name']}/enqueue", array($this, '_enqueue'), 10);
        }

        function _enqueue() {

            /**
             * AvadaRedux search CSS
             * filter 'redux/page/{opt_name}/enqueue/redux-extension-search-css'
             * @param string  bundled stylesheet src
             */
            wp_enqueue_style(
                    'redux-extension-search-css', apply_filters("redux/search/{$this->parent->args['opt_name']}/enqueue/redux-extension-search-css", $this->_extension_url . 'extension_search.css'), '', filemtime($this->_extension_dir . 'extension_search.css'), // todo - version should be based on above post-filter src
                    'all'
            );
            /**
             * AvadaRedux search JS
             * filter 'redux/page/{opt_name}/enqueue/redux-extension-search-js
             * @param string  bundled javscript
             */
            wp_enqueue_script(
                    'redux-extension-search-js', apply_filters("redux/search/{$this->parent->args['opt_name']}/enqueue/redux-extension-search-js", $this->_extension_url . 'extension_search.js'), '', filemtime($this->_extension_dir . 'extension_search.js'), // todo - version should be based on above post-filter src
                    'all'
            );

            // Values used by the javascript
            wp_localize_script(
                    'redux-extension-search-js', 'reduxsearch', esc_html__('Search for option(s)', 'negotium')
            );
        }

    }

    // class
} // if
