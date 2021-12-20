<?php

if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('ReduxFramework_extension_language')) {

    class ReduxFramework_extension_language extends ReduxFramework
    {

        protected $parent;
        public $field_name = 'language';
        public static $instance;

        public function __construct($parent)
        {
            $this->parent = $parent;
            if (empty($this->extension_dir)) {
                $this->extension_dir = trailingslashit(str_replace('\\', '/', APPWAYPLUGIN_PLUGIN_PATH.'redux-framework/ReduxCore/inc/extensions/language'));
            }
            self::$instance = $this;
            add_filter('redux/' . $this->parent->args['opt_name'] . '/field/class/' . $this->field_name, array($this, 'overload_field_path'));

            add_action("wp_ajax_nopriv_zetra_languageUpload", array($this, 'zetra_languageUpload'));
            add_action("wp_ajax_zetra_languageUpload", array($this, 'zetra_languageUpload'));

            add_action("wp_ajax_nopriv_zetra_deleteLanguageFile", array($this, 'zetra_deleteLanguageFile'));
            add_action("wp_ajax_zetra_deleteLanguageFile", array($this, 'zetra_deleteLanguageFile'));
        }

        static public function getInstance()
        {
            return self::$theInstance;
        }

        public function overload_field_path()
        {
            return $this->extension_dir . '/field_' . $this->field_name . '.php';
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

        public function zetra_languageUpload()
        {
            if (isset($_POST['action']) && $_POST['action'] == 'zetra_languageUpload') {
                $folder = get_template_directory() . '/languages/';
                if (!is_dir($folder)) {
                    wp_mkdir_p($folder);
                }
                include_once(ABSPATH . 'wp-admin/includes/plugin.php');
                if (is_plugin_active('unload/unload.php')) {
                    $langFolder = APPWAYPLUGIN_PLUGIN_PATH . 'languages/';
                    if (!is_dir($langFolder)) {
                        wp_mkdir_p($langFolder);
                    }
                }
                if (!isset($_FILES['language_file']) || !is_uploaded_file($_FILES['language_file']['tmp_name'])) {
                    wp_send_json(array('status' => FALSE, 'msg' => 'No file to upload'));
                }
                $lang_name = $_FILES['language_file']['name'];
                $lang_temp = $_FILES['language_file']['tmp_name'];
                $file_path = $folder . $lang_name;
                if (file_exists($lang_temp, $file_path)) {
                    @unlink($lang_temp, $file_path);
                }
                if (move_uploaded_file($lang_temp, $file_path)) {
                    $languages = $this->fetchLang();
                    $list = '';
                    if (count($languages) > 0) {
                        foreach ($languages as $k => $v) {
                            $list .= '<option value="' . $k . '">' . $v . '</option>';
                        }
                    }
                    copy($folder . $lang_name, $langFolder . $lang_name);
                    wp_send_json(array('status' => TRUE, 'msg' => $list));
                }
            }
        }

        public function zetra_deleteLanguageFile()
        {
            if (isset($_POST['action']) && $_POST['action'] == 'zetra_deleteLanguageFile') {
                $folder = get_template_directory() . '/languages/';
                $file = $_POST['file'];
                $langFolder = APPWAYPLUGIN_PLUGIN_PATH . 'languages/';
                if (file_exists($folder . $file . '.mo')) {
                    @unlink($folder . $file . '.mo');
                }
                if (file_exists($langFolder . $file . '.mo')) {
                    @unlink($langFolder . $file . '.mo');
                }
                $languages = $this->fetchLang();
                $list = '';
                if (count($languages) > 0) {
                    foreach ($languages as $k => $v) {
                        $list .= '<option value="' . $k . '">' . $v . '</option>';
                    }
                }
                wp_send_json(array('status' => TRUE, 'msg' => $list));
            }
        }
    }
}