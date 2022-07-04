<?php
/*
    Plugin Name: RWD Booking Calender
    Plugin URI: https://rockettwd.co.uk
    description: A Plugin to allow users to book events
    Version: 1
    Author: Mike Rockett
    Author URI: https://rockettwd.co.uk
    License: GPL2
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

class RWDBookingCalender
{
    public $plugin_name;

    private function load_dependencies()
    {
        $files = [];

        // general helper functions
        // $files[] = 'Curchods.php';

        foreach ($files as $file) {
            require_once plugin_dir_path( dirname( __FILE__ ) ) . $this->plugin_name . '/classes/' . $file;
        }
    }

    public function __construct()
    {
        $this->plugin_name = 'rwd-booking-calender';
        $this->load_dependencies();
        // $menu = new ReapitAdminMenu();
        // $scripts = new ReapitScripts();
        // $reapitCpt = new ReapitCPT();
        // $ajaxSync = new ReapitAjaxSync();
        // $syncEvent = new ReapitSyncEvent();
    }
}

?>
