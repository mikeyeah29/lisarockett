<?php

class SWPFD_Database
{
    public function createTables()
    {
        global $wpdb;
    	$charset_collate = $wpdb->get_charset_collate();
    	$table_name = $wpdb->prefix . 'swpfd_form_submission';

    	$sql = "CREATE TABLE $table_name (
    		id int AUTO_INCREMENT PRIMARY KEY,
    		sent_date timestamp DEFAULT CURRENT_TIMESTAMP,
            to_email varchar(30) NOT NULL,
            subject varchar(30) NULL,
    		message TEXT NULL
    	) $charset_collate;";

    	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    	dbDelta( $sql );
    }

    public function saveData($to, $subject, $msg)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'swpfd_form_submission';

        $msg = htmlentities($msg);

        $wpdb->query("
            INSERT INTO $table_name (to_email, subject, message) VALUES('$to', '$subject', '$msg')
        ");
    }

    public function getData($page = 1, $limit = 100)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'swpfd_form_submission';

        $offset = ($page - 1) * $limit;

        $records = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC LIMIT $limit OFFSET $offset;");

        return $records;
    }

    public function getEmail($id)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'swpfd_form_submission';

        return $wpdb->get_row("SELECT message FROM $table_name WHERE id = $id;");
    }
}

?>
