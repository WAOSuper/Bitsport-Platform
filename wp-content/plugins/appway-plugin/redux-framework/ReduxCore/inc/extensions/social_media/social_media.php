<?php

/**
 * switch_label field class.
 *
 * @version     1.0.0
 */
/* exit if accessed directly. */
if (!defined('ABSPATH')) exit;
 //print_r($folder_path); exit('');
/* don't duplicate me! */
if (!class_exists('ReduxFramework_social_media')) {

    /**
     *  ReduxFramework_switch_label class.
     *
     * @since       1.0.0
     */
    class ReduxFramework_social_media extends ReduxFramework
    {

        /**
         * field constructor.
         *
         * @access      public
         * @since       1.0.0
         * @return      void
         */
        public function __construct($field = array(), $value = '', $parent)
        {
            $this->parent = $parent;
            $this->field = $field;
            $this->value = $value;
        }
        /* __construct() */

        /**
         * render field output.
         *
         * @access      public
         * @since       1.0.0
         * @return      void
         */
        public function render()
        {
            $counter = 0;
            ?>
            <div class="icons-pack" data-opt-name=""
                 data-id="opt-<?php echo esc_attr(appway_set($this->field, 'id')) ?>">
                <?php if (appway_set($this->field, 'heading') === true): ?>
                    <h2 class="sec-title1"><?php echo esc_html(appway_set($this->field, 'title')) ?></h2>
                <?php endif; ?>
                <div class="icons-sec">
                    <ul>
                        <?php
                        $profiler = appway_social_profiler();
                        foreach ($profiler as $k => $v) {
                            $getTitle = str_replace('_', ' ', $k);
                            $title = ucwords($getTitle);

                            $getVal = appway_set($this->value, $counter);
                            $fieldVal = json_decode(urldecode(appway_set($getVal, 'data')));
                            $selected = (appway_set($fieldVal, 'enable') == 'true') ? 'class=active' : '';
                            echo '<li ' . esc_attr($selected) . ' data-key="' . $counter++ . '" data-id="' . $k . '" ><i class="fa ' . $v . '"></i></li>';
                        }
                        ?>
                    </ul>
                </div>
                <div class="socialmedia-settingsec">
                    <ul>
                        <?php
                        $counter2 = 0;
                        foreach ($profiler as $k => $v) {
                            $getTitle = str_replace('_', ' ', $k);
                            $title = ucwords($getTitle);
                            $getVal = appway_set($this->value, $counter2);
                            $fieldVal = json_decode(urldecode(appway_set($getVal, 'data'))); $selected = (appway_set($fieldVal, 'enable') == 'true') ? 'style=display:block' : 'style=display:none';
                            if (!empty($fieldVal)) $val = json_encode(array('icon' => $v, 'enable' => $fieldVal->enable, 'url' => $fieldVal->url, 'background' => $fieldVal->background, 'color' => $fieldVal->color));
                            else $val = json_encode(array('icon' => $v, 'enable' => '', 'url' => '', 'background' => '', 'color' => ''));
                            ?>
                            <li id="redux-social_meida-<?php echo esc_attr($counter2) ?>"
                                data-key="<?php echo esc_attr($counter2) ?>" <?php echo esc_attr($selected) ?> >
                                <div class="socialmedia-setting">
                                    <input class="redux-social_media-hidden-data-<?php echo esc_attr($counter2) ?>"
                                           type="hidden" id="opt-social-media-<?php echo esc_attr($counter2) ?>"
                                           name="<?php echo esc_attr($this->field['name']) . '[' . $counter2 . ']' ?>[data]"
                                           value="<?php echo urlencode($val) ?>">
                                    <span class="icon-title">
                                        <i class="fa <?php echo esc_attr($v) ?>"></i>
                                        <?php echo esc_html($title) ?>
                                    </span>
                                    <span class="del-btn">
                                        <i class="fa fa-close"></i>
                                    </span>
                                    <div class="socialmedia-link">
                                        <div class="inner">
                                            <label
                                                for="social_link"><?php esc_html_e('Link URL', 'appway') ?></label>
                                            <input id="social_link"
                                                   class="redux-social_media-url-text-<?php echo esc_attr($counter2) ?>"
                                                   data-key="<?php echo esc_attr($counter2) ?>" type="text"/>
                                        </div>
                                        <div class="inner">
                                            <label for="social_color"><?php esc_html_e('Color', 'appway') ?></label>
                                            <input id="social_color"
                                                   class="redux-social_media-color-picker-<?php echo esc_attr($counter2) ?>"
                                                   type="text" value="">
                                        </div>

                                        <div class="inner">
                                            <label
                                                for="social_bg"><?php esc_html_e('Background', 'appway') ?></label>
                                            <input id="social_bg"
                                                   class="redux-social_media-background-picker-<?php echo esc_attr($counter2) ?>"
                                                   type="text" value="">
                                        </div>
                                        <button data-value="<?php echo esc_attr($counter2) ?>" data-v="value"
                                                class="clear-btn">
                                            <?php esc_html_e('Clear', 'appway') ?>
                                        </button>
                                    </div>
                                </div>
                            </li>
                            <?php
                            $counter2++;
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <?php
        }
        /* render() */

        /**
         * enqueue styles and/or scripts.
         *
         * @access      public
         * @since       1.0.0
         * @return      void
         */
        public function enqueue()
        {

            $extension = ReduxFramework_extension_social_media::getInstance();   
            wp_enqueue_script(
                'redux-field-social_media-color-plate-js', APPWAY_PLUGIN_URI.'redux-framework/ReduxCore/inc/extensions/' . 'social_media/spectrum.js', array('jquery'), time(), true

            );
/*var_dump(file_exists((ABSPATH.'wp-content\plugins\appway/panel/redux-extensions/extensions/' . 'social_media/spectrum.js'))); exit();*/
            wp_enqueue_script(
                'redux-field-social_media-js',APPWAY_PLUGIN_URI.'redux-framework/ReduxCore/inc/extensions/' . 'social_media/social_media.min.js', array('jquery', 'jquery-ui-core'), time(), true
            );

            wp_enqueue_script(
                'redux-field-social_media-scroll-js', APPWAY_PLUGIN_URI . 'redux-framework/ReduxCore/inc/extensions/' . 'social_media/social_media_scroll.min.js', array('jquery'), time(), true
            );

            wp_enqueue_style(
                'redux-field-social_media-font', APPWAY_PLUGIN_URI . 'redux-framework/ReduxCore/inc/extensions/' . 'social_media/font-awesome.min.css', time(), 'all'
            );

            wp_enqueue_style(
                'redux-field-social_media-css', APPWAY_PLUGIN_URI . 'redux-framework/ReduxCore/inc/extensions/' . 'social_media/social_media.css', time(), 'all'
            );
            wp_enqueue_style(
                'redux-field-social_media-plate-css', APPWAY_PLUGIN_URI . 'redux-framework/ReduxCore/inc/extensions/' . 'social_media/spectrum.css', time(), 'all'
            );
            if (appway_set($this->field, 'full_width') === true) {
                $custom_css = "
                .redux-container-social_media > div:nth-child(1){
                    
                        display: none;
                }";
                wp_add_inline_style('redux-field-social_media-css', $custom_css);
            }
        }
        /* enqueue() */

        /**
         * Output Function.
         *
         * Used to enqueue to the front-end
         *
         * @access      public
         * @since       1.0.0
         * @return      void
         */
        public function output()
        {

            if ($this->field['enqueue_frontend']) {

            }
        }
        /* output() */
    }
}
