<?php
if (!class_exists('ReduxFramework_language')) {

    class ReduxFramework_language
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
                $this->extension_dir = trailingslashit(str_replace('\\', '/', APPWAYPLUGIN_PLUGIN_PATH.'redux-framework/ReduxCore/inc/extensions/language'));
                $this->extension_url = site_url(str_replace(trailingslashit(str_replace('\\', '/', ABSPATH)), '', $this->extension_dir));
            }

        }

        public function render()
        {
            ?>
            <div class="language-switcher-uploader" data-id="opt-<?php echo esc_attr($this->field['id']) ?>">
                <select id="language_switcher" name="<?php echo esc_attr($this->field['name']) ?>">
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
                <a id="delete-language-file" href="javascript:void(0)"><?php esc_htmL_e('Delete', 'dailyhealth') ?></a>
                <div class="form-wrap">
                    <h3><?php esc_html_e('Upload Language File', 'dailyhealth') ?></h3>
                    <form enctype="multipart/form-data" id="language_uploader">
                        <div class="language-file">
                            <label for="language_file"><i class="el el-upload"></i><?php esc_html_e('Browse', 'dailyhealth') ?></label>
                            <input id="language_file" name="language_file" type="file"/>
                        </div>
                        <a id="upload_file" name="upload_file"><i class="el el-refresh"></i><?php esc_html_e('Start Upload', 'dailyhealth') ?></a>
                    </form>
                    <div id="progress-wrp">
                        <div class="progress-bar"></div>
                        <div class="status">0%</div>
                    </div>
                    <div id="error-log"></div>
                </div>
            </div>
            <?php
        }


        public function enqueue()
        {
            wp_register_script('redux-field-language-js', $this->extension_url . 'js/script.js', array('jquery', 'select2-js', 'redux-js'), time(), TRUE);
            $translation_array = array(
                'switcher' => esc_html__('Select Language', 'dailyhealth'),
                'api_error' => esc_html__('Your browser does not support new File API! Please upgrade', 'dailyhealth'),
                'no_file' => esc_html__('Please Select a .mo file', 'dailyhealth'),
                'unsupported' => esc_html__('Unsupported file type', 'dailyhealth'),
                'bigFile' => esc_html__('Too big file', 'dailyhealth'),
                'selectFile' => esc_html__('Please Select Language File', 'dailyhealth'),
                'del' => esc_html__('Delete', 'dailyhealth'),
            );
            wp_localize_script('redux-field-language-js', 'language', $translation_array);
            wp_enqueue_script('redux-field-language-js');
            wp_enqueue_style('redux-field-language-css', $this->extension_url . 'css/style.css', time(), 'all');
        }

        public function fetchLang()
        {
            $dir = get_template_directory() . '/languages/';
            $data = @scandir($dir);
            if (!$data) {
                return array();
            }
            if ($data && is_array($data)) {
                unset($data[0], $data[1]);
            }
            $return = array();
            foreach ($data as $d) {
                if (substr($d, -3) == '.mo') {
                    $name = substr($d, 0, (strlen($d) - 3));
                    $return[$name] = $name;
                }
            }

            return $return;
        }
    }
}