<?php

class RWDCalenderDatabase
{
    public function createTables()
    {
        global $wpdb;
    	$charset_collate = $wpdb->get_charset_collate();
    	$table_name = $wpdb->prefix . 'rwd_calender_events';

    	$sql = "CREATE TABLE $table_name (
    		id int AUTO_INCREMENT PRIMARY KEY,
    		date_from DATETIME NOT NULL,
    		date_to DATETIME NOT NULL,
            type enum('booked', 'available') NOT NULL,
            first_name varchar(30),
            last_name varchar(30),
            email varchar(100),
            phone varchar(20),
            description varchar(500) NULL
    	) $charset_collate;";

    	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    	dbDelta( $sql );

        // $table_name = $wpdb->prefix . 'rwd_calender_booking';
        // $sql = "CREATE TABLE $table_name (
    	// 	id int AUTO_INCREMENT PRIMARY KEY,
    	// 	event_id INT NOT NULL,
        //     first_name varchar(50),
        //     last_name varchar(50),
        //     phone varchar(20),
        //     email varchar(50)
    	// ) $charset_collate;";
        //
        // dbDelta( $sql );
        //
        // $table_name = $wpdb->prefix . 'rwd_calender_opening_times';
        // $sql = "CREATE TABLE $table_name (
    	// 	id int AUTO_INCREMENT PRIMARY KEY,
    	// 	day enum('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday') NULL,
        //     from_time int NOT NULL,
        //     to_time int NOT NULL
    	// ) $charset_collate;";
        //
        // dbDelta( $sql );
    }
}

?>
