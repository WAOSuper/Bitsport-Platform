<?php

/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     Redux Framework
 * @subpackage  Repeater
 * @author      Dovy Paukstys (dovy)
 * @author      Kevin Provance (kprovance)
 */
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Don't duplicate me!
if (!class_exists('ReduxFramework_repeater')) {

    /**
     * Main ReduxFramework_css_layout class
     *
     * @since       1.0.0
     */
    class ReduxFramework_repeater extends ReduxFramework {

        public $parent;
        public $field;
        public $value;
        public $args;
        public $repeater_values = '';
        public $extension_dir = '';
        public $extension_url = '';

        /**
         * Class Constructor. Defines the args for the extions class
         *
         * @since       1.0.0
         * @access      public
         *
         * @param       array $field  Field sections.
         * @param       array $value  Values.
         * @param       array $parent Parent object.
         *
         * @return      void
         */
        public function __construct($field = array(), $value = '', $parent) {
            // Set required variables
            $this->parent = $parent;
            $this->field = $field;
            $this->value = $value;
            $this->args = $parent->args;

            if (!isset($this->field['bind_title']) && !empty($this->field['fields'])) {
                $this->field['bind_title'] = $this->field['fields'][0]['id'];
            }

            // Set extension dir & url
            if (empty($this->extension_dir)) {
                $this->extension_dir = trailingslashit(str_replace('\\', '/', dirname(__FILE__)));
                //$this->extension_url = trailingslashit(ABSPATH) . 'wp-content/plugins/medicalist/panel/redux-extensions/extensions/repeater/repeater/';
                $this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
            }
        }

        /**
         * Field Render Function.
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function render() {

            if (!isset($this->field['item_name'])) {
                $this->field['item_name'] = "";
            }

            if (!isset($this->field['limit'])) {
                $this->field['limit'] = 10;
            }

            if (isset($this->field['group_values']) && $this->field['group_values']) {
                $this->repeater_values = '[' . $this->field['id'] . ']';
            }

            $title = '';
            if (empty($this->value) || !is_array($this->value)) {
                $this->value = array(
                    'redux_repeater_data' => array(
                        array(
                            'title' => $title
                        )
                    )
                );
            }

            if (isset($this->field['subfields']) && empty($this->field['fields'])) {
                $this->field['fields'] = $this->field['subfields'];
                unset($this->field['subfields']);
            }

            echo '<div class="redux-repeater-accordion" data-id="' . $this->field['id'] . '">';

            $x = 0;
            if (isset($this->value['redux_repeater_data']) && is_array($this->value['redux_repeater_data']) && !empty($this->value['redux_repeater_data'])) {

                $repeaters = $this->value['redux_repeater_data'];

                foreach ($repeaters as $repeater) {
                    if (empty($repeater)) {
                        continue;
                    }

                    echo '<div class="redux-repeater-accordion-repeater" data-sortid="' . $x . '">';
                    echo '<table style="margin-top: 0;" class="redux-repeater-accordion redux-repeater form-table no-border">';
                    echo '<fieldset class="redux-field" data-id="' . $this->field['id'] . '">';

                    echo '<input type="hidden" name="' . $this->parent->args['opt_name'] . '[' . $this->field['id'] . '][redux_repeater_data][' . $x . '][title]" value="' . esc_attr($repeater['title']) . '" class="regular-text slide-title" data-key="' . $x . '" />';

                    if (isset($this->field['bind_title'])) {

                        foreach ($this->field['fields'] as $field) {
                            if ($field['id'] == $this->field['bind_title']) {
                                if (isset($field['default'])) {
                                    $default = $field['default'];
                                } elseif (isset($field['options']) && ( $field['type'] != "ace_editor" )) {
                                    // Sorter data filter
                                    if ($field['type'] == "sorter" && isset($field['data']) && !empty($field['data']) && is_array($field['data'])) {
                                        if (!isset($field['args'])) {
                                            $field['args'] = array();
                                        }
                                        foreach ($field['data'] as $key => $data) {
                                            if (!isset($field['args'][$key])) {
                                                $field['args'][$key] = array();
                                            }
                                            $field['options'][$key] = $this->get_wordpress_data($data, $field['args'][$key]);
                                        }
                                    }
                                    $default = $field['options'];
                                }

                                $default = isset($field['default']) ? $field['default'] : '';
                                if (!empty($this->repeater_values)) {
                                    $repeater['title'] = !isset($this->parent->options[$this->field['id']][$field['id']][$x]) ? $default : $this->parent->options[$this->field['id']][$field['id']][$x];
                                } else {
                                    $repeater['title'] = !isset($this->parent->options[$field['id']][$x]) ? $default : $this->parent->options[$field['id']][$x];
                                }
                                if (isset($field['options']) && is_array($field['options']) && !empty($field['options'])) {
                                    if (isset($field['options'][$repeater['title']])) {
                                        $repeater['title'] = $field['options'][$repeater['title']];
                                    }
                                }
                            }
                        }
                    }

                    if (is_array($repeater['title'])) {
                        $repeater['title'] = "Title";
                    }

                    echo '<h3><span class="redux-repeater-header">' . $repeater['title'] . ' </span></h3>';

                    echo '<div>';

                    foreach ($this->field['fields'] as $field) {
                        if (isset($this->field['bind_title']) && $field['id'] == $this->field['bind_title']) {
                            if (!isset($field['class']) || ( isset($field['title']) && empty($field['title']) )) {
                                $field['class'] = "bind_title";
                            } else {
                                $field['class'] .= " bind_title";
                            }
                        }
                        $this->output_field($field, $x);
                    }
                    if (!isset($this->field['static']) && empty($this->field['static'])) {
                        echo '<a href="javascript:void(0);" class="button deletion redux-repeaters-remove">' . esc_html__('Delete', 'zetra') . ' ' . $this->field['item_name'] . '</a>';
                    }
                    echo '</div>';
                    echo '</fieldset>';
                    echo '</table>';
                    echo '</div>';

                    $x ++;
                }
            }


            if ($x == 0 || ( isset($this->field['static']) && ( $x - 1 ) < $this->field['static'] )) {

                if (isset($this->field['static']) && $x < $this->field['static']) {
                    $loop = $this->field['static'] - $x;
                } else {
                    $loop = 1;
                }

                while ($loop > 0) {
                    echo '<div class="redux-repeater-accordion-repeater">';
                    echo '<table style="margin-top: 0;" class="redux-repeater-accordion redux-repeater form-table no-border">';
                    echo '<fieldset class="redux-field" data-id="' . $this->field['id'] . '">';
                    if (!isset($this->value['redux_repeater_data'][$x]['title'])) {
                        $this->value['redux_repeater_data'][$x]['title'] = "";
                    }
                    echo '<input type="hidden" name="' . $this->parent->args['opt_name'] . '[' . $this->field['id'] . '][redux_repeater_data][' . $x . '][title]" value="" class="regular-text slide-title" />';

                    echo '<h3><span class="redux-repeater-header"> </span></h3>';
                    echo '<div>';

                    foreach ($this->field['fields'] as $field) {
                        if (isset($this->field['bind_title']) && $field['id'] == $this->field['bind_title']) {
                            if (!isset($field['class']) || ( isset($field['title']) && empty($field['title']) )) {
                                $field['class'] = "bind_title";
                            } else {
                                $field['class'] .= " bind_title";
                            }
                        }
                        $this->output_field($field, $x);
                    }
                    if (!isset($this->field['static']) && empty($this->field['static'])) {
                        echo '<a href="javascript:void(0);" class="button deletion redux-repeaters-remove">' . esc_html__('Delete', 'zetra') . ' ' . $this->field['item_name'] . '</a>';
                    }
                    echo '</div>';
                    echo '</fieldset>';
                    echo '</table>';
                    echo '</div>';

                    $x ++;
                    $loop --;
                }
            }

            echo '</div>';
            if (!isset($this->field['static']) && empty($this->field['static'])) {
                $disabled = "";
                if (isset($this->field['limit']) && is_integer($this->field['limit'])) {
                    if ($x >= $this->field['limit']) {
                        $disabled = ' button-disabled';
                    }
                }

                echo '<a href="javascript:void(0);" class="button redux-repeaters-add button-primary' . $disabled . '" rel-id="' . $this->field['id'] . '-ul" rel-name="' . $this->parent->args['opt_name'] . $this->repeater_values . '[title][]">' . esc_html__('Add', 'zetra') . ' ' . $this->field['item_name'] . '</a><br/>';
            }
        }

        /**
         * Enqueue Function.
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function enqueue() {

            $extension = ReduxFramework_extension_repeater::getInstance();

            // Set up min files for dev_mode = false.
            $min = Redux_Functions::isMin();
            
            wp_enqueue_script(
                    'redux-field-repeater-js', apply_filters("redux/repeater/{$this->parent->args['opt_name']}/enqueue/redux-field-repeater-js", $this->extension_url . 'field_repeater' . $min . '.js'), array('jquery', 'jquery-ui-core', 'jquery-ui-accordion', 'jquery-ui-sortable', 'wp-color-picker'), time(), true
            );


            wp_enqueue_style(
                    'redux-field-repeater-css', apply_filters("redux/repeater/{$this->parent->args['opt_name']}/enqueue/redux-field-repeater-css", $this->extension_url . 'field_repeater.css'), array(), time(), 'all'
            );
        }

        public function output_field($field, $x) {

            //we will enqueue all CSS/JS for sub fields if it wasn't enqueued
            $this->enqueue_dependencies($field['type']);

            //echo '<tr><td>';

            if (isset($field['class'])) {
                $field['class'] .= " repeater";
            } else {
                $field['class'] = " repeater";
            }

            if (!empty($field['title'])) {
                echo '<h4>' . $field['title'] . '</h4>';
            }

            if (!empty($field['subtitle'])) {
                echo '<span class="description">' . $field['subtitle'] . '</span>';
            }

            $origFieldID = $field['id'];

            $field['id'] = $field['id'] . '-' . $x;
            $field["name"] = $this->parent->args['opt_name'] . $this->repeater_values . '[' . $origFieldID . ']';
            $field['name_suffix'] = "[" . $x . "]";

            if (isset($field['default'])) {
                $default = $field['default'];
            } elseif (isset($field['options']) && ( $field['type'] != "ace_editor" )) {
                // Sorter data filter
                if ($field['type'] == "sorter" && isset($field['data']) && !empty($field['data']) && is_array($field['data'])) {
                    if (!isset($field['args'])) {
                        $field['args'] = array();
                    }
                    foreach ($field['data'] as $key => $data) {
                        if (!isset($field['args'][$key])) {
                            $field['args'][$key] = array();
                        }
                        $field['options'][$key] = $this->get_wordpress_data($data, $field['args'][$key]);
                    }
                }
                $default = $field['options'];
            }

            $default = isset($field['default']) ? $field['default'] : '';

            if (!empty($this->repeater_values)) {
                $value = !isset($this->parent->options[$this->field['id']][$origFieldID][$x]) ? $default : $this->parent->options[$this->field['id']][$origFieldID][$x];
            } else {
                $value = !isset($this->parent->options[$origFieldID][$x]) ? $default : $this->parent->options[$origFieldID][$x];
            }

            ob_start();
            $this->parent->_field_input($field, $value);

            $content = ob_get_contents();
            //
            //if ( ( $field['type'] === "text" ) && ( $field_is_title ) ) {
            //    $content        = str_replace( '>', 'data-title="true" />', $content );
            //    $field_is_title = false;
            //}

            $_field = apply_filters('redux-support-repeater', $content, $field, 0);
            ob_end_clean();
            echo $_field;
        }

        /**
         * Functions to pass data from the PHP to the JS at render time.
         *
         * @return array Params to be saved as a javascript object accessable to the UI.
         * @since  Redux_Framework 3.1.5
         */
        function localize($field, $value = "") {


            if (isset($field['subfields']) && empty($field['fields'])) {
                $field['fields'] = $field['subfields'];
                unset($field['subfields']);
            }

            if (isset($field['group_values']) && $field['group_values']) {
                $this->repeater_values = '[' . $field['id'] . ']';
            }

            $var = "";
            if (isset($field['fields']) && !empty($field['fields'])) {
                ob_start();
                foreach ($field['fields'] as $f) {
                    if (isset($this->field['bind_title']) && $f['id'] == $this->field['bind_title']) {
                        if (!isset($f['class']) || ( isset($f['title']) && empty($f['title']) )) {
                            $f['class'] = "bind_title";
                        } else {
                            $f['class'] .= " bind_title";
                        }
                    }
                    $this->output_field($f, 99999);
                }
                $var = ob_get_contents();

                $var = array(
                    'html' => $var . '<a href="javascript:void(0);" class="button deletion redux-repeaters-remove">Delete </a>',
                    'count' => count($value),
                    'sortable' => true,
                    'limit' => '',
                    'name' => $this->parent->args['opt_name'] . '[' . $field['id'] . '][99999]',
                );

                if (isset($field['sortable']) && is_bool($this->field['sortable'])) {
                    $var['sortable'] = $field['sortable'];
                }
                if (isset($field['limit']) && is_integer($field['limit'])) {
                    $var['limit'] = $field['limit'];
                }

                ob_end_clean();
            }

            return $var;
        }

        private function enqueue_dependencies($field_type) {
            $field_class = 'ReduxFramework_' . $field_type;

            if (!class_exists($field_class)) {
                $class_file = apply_filters('redux-typeclass-load', ReduxFramework::$_dir . 'inc/fields/' . $field_type . '/field_' . $field_type . '.php', $field_class);

                if (file_exists($class_file)) {
                    /** @noinspection PhpIncludeInspection */
                    require_once( $class_file );
                }
            }

            if (class_exists($field_class) && method_exists($field_class, 'enqueue')) {
                $enqueue = new $field_class('', '', $this);
                $enqueue->enqueue();
            }
        }

    }

}
