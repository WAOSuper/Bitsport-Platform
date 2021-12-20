<?php

if (!class_exists('ReduxFramework_fonts')) {

    class ReduxFramework_fonts
    {
        public $parent;
        public $field;
        public $extension_dir = '';
        public $extension_url = '';

        public function __construct($field = array(), $value = '', $parent)
        {
            $this->parent = $parent;
            $this->field = $field;
            $this->value = $value;
            if (empty($this->extension_dir)) {
                $this->extension_dir = trailingslashit(str_replace('\\', '/', APPWAYPLUGIN_PLUGIN_PATH.'redux-framework/ReduxCore/inc/extensions/fonts'));
                $this->extension_url = site_url(str_replace(trailingslashit(str_replace('\\', '/', ABSPATH)), '', $this->extension_dir));
            }

        }

        public function render()
        {
                wp_register_script('redux-field-progress', $this->extension_url . 'js/jquery-ui-progressbar.js', array('jquery', 'select2-js', 'redux-js'), time(), TRUE);

            ?>
            <div class="fonts-switcher-uploader" data-id="opt-<?php echo esc_attr($this->field['id']) ?>">
                <select id="fonts_switcher" name="<?php echo esc_attr($this->field['name']) ?>">
                    <option></option>
                    <?php
                    $languages = $this->fetchLang();
                    
                    if (count($languages) > 0) {
                        foreach ($languages as $k => $v) {
                            $selected = ($k == $this->value) ? 'selected' : '';
                            echo '<option ' . $selected . ' value="' . $k . '">' . $v . '</option>';
                        }
                    }
                    ?>
                </select>
                <a id="delete-mo-file" href="javascript:void(0)"><?php esc_htmL_e('Delete', 'dailyhealth') ?></a>
                <div class="form-wrap">
                    <h3><?php esc_html_e('Upload Font File', 'dailyhealth') ?></h3>
                    <form enctype="multipart/form-data" id="fonts_uploader">
                        <div class="fonts-file">
                            <label for="fonts_file"><i class="el el-upload"></i><?php esc_html_e('Browse', 'dailyhealth') ?></label>
                            <input id="fonts_file" name="fonts_file" type="file"/>
                        </div>
                        <a id="font_upload_file" name="font_upload_file"><i class="el el-refresh"></i><?php esc_html_e('Start Upload', 'dailyhealth') ?></a>
                    </form>
                    <div id="font-progress-wrp">
                        <div class="fonts-progress-bar"></div>
                        <div class="status">0%</div>
                    </div>
                    <div id="fonts-error-log"></div>
                </div>
            </div>
            <?php
        }


        public function enqueue()
        {
            wp_register_script('redux-field-fonts-js', $this->extension_url . 'js/script.js', array('jquery', 'select2-js', 'redux-js'), time(), TRUE);
            $translation_array = array(
                'switcher' => esc_html__('Select Font', 'dailyhealth'),
                'api_error' => esc_html__('Your browser does not support new File API! Please upgrade', 'dailyhealth'),
                'no_file' => esc_html__("Please Select a 'otf', 'ttf', 'eot', 'woff' file", 'dailyhealth'),
                'unsupported' => esc_html__('Unsupported file type', 'dailyhealth'),
                'bigFile' => esc_html__('Too big file', 'dailyhealth'),
                'selectFile' => esc_html__('Please Select Font File', 'dailyhealth'),
                'del' => esc_html__('Delete', 'dailyhealth'),
            );
            wp_localize_script('redux-field-fonts-js', 'fonts', $translation_array);
            wp_enqueue_script('redux-field-fonts-js');
            wp_enqueue_style('redux-field-fonts-css', $this->extension_url . 'css/style.css', time(), 'all');
        }

        public function fetchLang()
        {
            $dir = get_template_directory() . '/assets/css/custom-fonts/';

            $data = @scandir($dir);

            if (!$data) {
                return array();
            }
            if ($data && is_array($data)) {
                unset($data[0], $data[1]);
            }
            $return = array();
            foreach ($data as $d) {
                $file_data = pathinfo($d);
                if (in_array($file_data['extension'], array("otf", "ttf", "eot", "woff"))) {
                    $return[$file_data['basename']] = ucfirst($file_data['filename']).'('.$file_data['extension'].')';
                }
            }
            
            return $return;
        }
    }
}