<?php
/*
    Plugin Name: Save WP Form Data
    Plugin URI: https://www.madebyparent.co.uk
    description: A Plugin to save form submissions from wp_mail
    Version: 1
    Author: RWD
    Author URI: https://www.rockettwd.co.uk
    License: GPL2
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

class SaveWpFormData
{
    public $plugin_name;

    private function load_dependencies()
    {
        $files = [];

        // general helper functions
        $files[] = 'SWPFD_Database.php';
        $files[] = 'SWPFD_AdminMenu.php';
        $files[] = 'SWPFD_Scripts.php';
        // $files[] = 'SWPFD_CPT.php';
        $files[] = 'SWPFD_Options.php';
        $files[] = 'SWPFD_SaveData.php';

        foreach ($files as $file) {
            require_once plugin_dir_path( dirname( __FILE__ ) ) . $this->plugin_name . '/classes/' . $file;
        }
    }

    public function activate_plugin()
    {
        $dbs = new SWPFD_Database();
        $dbs->createTables();
    }

    public function __construct()
    {
        $this->plugin_name = 'save-wp-form-data';
        $this->load_dependencies();

        $menu = new SWPFD_AdminMenu();
        $scripts = new SWPFD_Scripts($this->plugin_name);
        // $saveData = new SWPFD_SaveData();

        // activate plugin
        register_activation_hook( __FILE__, array($this, 'activate_plugin') );
    }
}

$savewpformdata = new SaveWpFormData();

?>
