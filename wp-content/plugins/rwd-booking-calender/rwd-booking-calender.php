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
        $files[] = 'RWD_Helpers.php';
        $files[] = 'RWDCalenderDatabase.php';
        $files[] = 'RWDCalenderDbModel.php';
        $files[] = 'RWDBookingCalenderAdminMenu.php';
        $files[] = 'RWDBookingScripts.php';
        $files[] = 'RWDCalender.php';
        $files[] = 'RWDEvents.php';
        // models
        $files[] = 'models/RWD_Event.php';

        foreach ($files as $file) {
            require_once plugin_dir_path( dirname( __FILE__ ) ) . $this->plugin_name . '/classes/' . $file;
        }
    }

    public function activate_plugin()
    {
        $dbs = new RWDCalenderDatabase();
        $dbs->createTables();
    }

    public function __construct()
    {
        // define('RWD_CAL_HOUR_HEIGHT', 85);
        define('RWD_CAL_HOUR_HEIGHT', 60);
        define('RWD_CAL_DAY_WIDTH', 14); // %

        define('RWD_CAL_DISPLAY_START_HOUR', 8);
        define('RWD_CAL_DISPLAY_END_HOUR', 21);

        $this->plugin_name = 'rwd-booking-calender';
        $this->load_dependencies();
        $menu = new RWDBookingCalenderAdminMenu();
        $scripts = new RWDBookingScripts($this->plugin_name);

        // models
        // global $wpdb;
        // $rwdEvent = new RWDCalenderDbModel($wpdb->prefix . 'rwd_calender_events');
        // $rwdBooking = new RWDCalenderDbModel($wpdb->prefix . 'rwd_calender_booking');
        // $rwdOpeningTimes = new RWDCalenderDbModel($wpdb->prefix . 'rwd_calender_opening_times');

        // activate plugin
        register_activation_hook( __FILE__, array($this, 'activate_plugin') );
    }
}

$RWDBookingCalender = new RWDBookingCalender();

?>
