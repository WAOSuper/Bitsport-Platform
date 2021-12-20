<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('ReduxFramework_extension_fonts')) {

    class ReduxFramework_extension_fonts extends ReduxFramework
    {
       
        protected $parent;
        public $field_name = 'fonts';
        public static $instance;

        public function __construct($parent)
        {
           
            $this->parent = $parent;
            if (empty($this->extension_dir)) {
                $this->extension_dir = trailingslashit(str_replace('\\', '/', APPWAYPLUGIN_PLUGIN_PATH.'redux-framework/ReduxCore/inc/extensions/fonts'));
            }
            self::$instance = $this;
            add_filter('redux/' . $this->parent->args['opt_name'] . '/field/class/' . $this->field_name, array($this, 'overload_field_path'));

            add_action("wp_ajax_nopriv_zetra_fontsUpload", array($this, 'zetra_fontsUpload'));
            add_action("wp_ajax_zetra_fontsUpload", array($this, 'zetra_fontsUpload'));

            add_action("wp_ajax_nopriv_zetra_deleteFontsFile", array($this, 'zetra_deleteFontsFile'));
            add_action("wp_ajax_zetra_deleteFontsFile", array($this, 'zetra_deleteFontsFile'));
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
                if (substr($d, -3) == '.mo') {
                    $name = substr($d, 0, (strlen($d) - 3));
                    $return[$name] = $name;
                }
            }

            return $return;
        }

        public function zetra_fontsUpload()
        {
            if (isset($_POST['action']) && $_POST['action'] == 'zetra_fontsUpload') {
                $folder = get_template_directory() . '/assets/css/custom-fonts/';
                if (!is_dir($folder)) {
                    wp_mkdir_p($folder);
                }
                include_once(ABSPATH . 'wp-admin/includes/plugin.php');
                if (is_plugin_active('unload/unload.php')) {
                    $langFolder = Plugin_ROOT . 'fonts/';
                    if (!is_dir($langFolder)) {
                        wp_mkdir_p($langFolder);
                    }
                }
                if (!isset($_FILES['fonts_file']) || !is_uploaded_file($_FILES['fonts_file']['tmp_name'])) {
                    wp_send_json(array('status' => FALSE, 'msg' => 'No file to upload'));
                }
                $lang_name = $_FILES['fonts_file']['name'];
                $lang_temp = $_FILES['fonts_file']['tmp_name'];
                $file_path = $folder . $lang_name;
                if (file_exists($lang_temp, $file_path)) {
                    @unlink($lang_temp, $file_path);
                }
                if (move_uploaded_file($lang_temp, $file_path)) {
                    $fonts = $this->fetchLang();
                    $list = '';
                    if (count($fonts) > 0) {
                        foreach ($fonts as $k => $v) {
                            $list .= '<option value="' . $k . '">' . $v . '</option>';
                        }
                    }
                    copy($folder . $lang_name, $langFolder . $lang_name);
                    wp_send_json(array('status' => TRUE, 'msg' => $list));
                }
            }
        }

        public function zetra_deleteFontsFile()
        {
            if (isset($_POST['action']) && $_POST['action'] == 'zetra_deleteFontsFile') {
                $folder = get_template_directory() . '/assets/css/custom-fonts/';
                $file = $_POST['file'];
            
                if (file_exists($folder . $file . '.mo')) {
                    @unlink($folder . $file . '.mo');
                }
               
                $fonts = $this->fetchLang();
                $list = '';
                if (count($fonts) > 0) {
                    foreach ($fonts as $k => $v) {
                        $list .= '<option value="' . $k . '">' . $v . '</option>';
                    }
                }
                wp_send_json(array('status' => TRUE, 'msg' => $list));
            }
        }
    }
}