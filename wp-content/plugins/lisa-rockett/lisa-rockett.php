<?php
/*
    Plugin Name: Lisa Rockett
    Plugin URI: https://www.rockettwd.co.uk
    description: A Plugin for Lisa Rockett
    Version: 1
    Author: RWD
    Author URI: https://www.rockettwd.co.uk
    License: GPL2
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

class LisaRockett
{
    public $plugin_name;

    private function load_dependencies()
    {
        $files = [];

        // general helper functions
        // $files[] = 'LR_Database.php';
        $files[] = 'LR_AdminMenu.php';
        $files[] = 'LR_Scripts.php';
        // $files[] = 'LR_CPT.php';
        $files[] = 'LR_Options.php';
        $files[] = 'LR_Testamonials.php';

        foreach ($files as $file) {
            require_once plugin_dir_path( dirname( __FILE__ ) ) . $this->plugin_name . '/classes/' . $file;
        }
    }

    public function activate_plugin()
    {
        // $dbs = new LR_Database();
        // $dbs->createTables();
    }

    public function __construct()
    {
        $this->plugin_name = 'lisa-rockett';
        $this->load_dependencies();

        $menu = new LR_AdminMenu();
        $scripts = new LR_Scripts($this->plugin_name);
        // $cpts = new LR_CPT();

        // activate plugin
        register_activation_hook( __FILE__, array($this, 'activate_plugin') );
    }
}

$lisarockett = new LisaRockett();

?>
