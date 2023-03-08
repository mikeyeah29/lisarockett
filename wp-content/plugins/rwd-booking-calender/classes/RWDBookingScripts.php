<?php

class RWDBookingScripts
{
    private $plugin_name;

    public function register_scripts()
    {
        // css
        wp_register_style( 'rwd-booking-calender-admin', plugins_url( $this->plugin_name . '/admin/css/plugin.css' ) );
        wp_enqueue_style( 'rwd-booking-calender-admin' );

        wp_register_style( 'rwd-booking-calender-cal', plugins_url( $this->plugin_name . '/admin/css/calender.css' ) );
        wp_enqueue_style( 'rwd-booking-calender-cal' );

        // js
        wp_register_script( 'rwd-booking-calender-admin', plugins_url( $this->plugin_name . '/admin/js/plugin.js' ), array('jquery') );
        wp_localize_script( 'rwd-booking-calender-admin', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

        // enqueue
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'rwd-booking-calender-admin' );
    }

    public function register_front_end_scripts()
    {
        // css
        wp_enqueue_style( 'rwd-booking-calender', plugins_url( $this->plugin_name . '/admin/css/calender.css' ) );

        // js
        wp_register_script( 'rwd-booking-calender-booking', plugins_url( $this->plugin_name . '/front-end/js/booking.js' ), array('jquery') );
        wp_enqueue_script( 'rwd-booking-calender-booking' );
    }

    public function __construct($plugin_name)
    {
        $this->plugin_name = $plugin_name;
        add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'register_front_end_scripts' ) );
    }
}

?>
