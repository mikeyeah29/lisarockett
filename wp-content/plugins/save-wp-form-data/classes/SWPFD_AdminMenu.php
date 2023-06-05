<?php

class SWPFD_AdminMenu
{
    private $title;
    private $menu_title;
    private $permissions = 'manage_options';
    private $slug = 'swpfd-settings';
    private $callback;

    public function admin_menu_view()
    {
        $message = '';
        $error = false;

        if (isset($_POST['swpfd_options'])) {

            SWPFD_Options::update();

            $message = 'options updated';
        }

        $options = SWPFD_Options::get();

        $page = (isset($_GET['page']) ? $_GET['page'] : '');

        include_once( plugin_dir_path( __FILE__ ) . '../admin/views/settings.php' );
    }

    public function submenu_data_view()
    {
        $message = '';
        $error = false;

        // if(isset($_GET['page_number']) ) {
        //     dd('njkn');
        // }

        $pageNumber = (isset($_GET['page_number']) ? $_GET['page_number'] : 1);
        $limit = 200;

        $db = new SWPFD_Database();
        $records = $db->getData($pageNumber, $limit);

        $showingFrom = (($pageNumber - 1) * $limit) + 1;
        $showingTo = ($showingFrom - 1) + count($records);

        $page = (isset($_GET['page']) ? $_GET['page'] : '');
        include_once( plugin_dir_path( __FILE__ ) . '../admin/views/view-data.php' );
    }

    public function submenu_email_view()
    {
        $emailId = (isset($_GET['email_id']) ? $_GET['email_id'] : '');

        if(!$emailId) {
            dd('No id set');
        }

        $db = new SWPFD_Database();
        $email = $db->getEmail($emailId);

        include_once( plugin_dir_path( __FILE__ ) . '../admin/views/view-email.php' );
    }

    public function admin_menu()
    {
        add_menu_page(
            'General', // title
            'Save WP Form Data', // menu title
            $this->permissions, // permissions
            $this->slug, // slug
            array($this, 'admin_menu_view'), // callback
            'dashicons-email', // dash icon
            4 // position
        );
        add_submenu_page(
            $this->slug, // parent slug
            'View Data', // title
            'View Data', // menu title
            $this->permissions,
            'swpfd-data', // slugw
            array($this, 'submenu_data_view')
        );
        add_submenu_page(
            $this->slug, // parent slug
            'Email', // title
            'Email', // menu title
            $this->permissions,
            'swpfd-email', // slugw
            array($this, 'submenu_email_view')
        );
    }

    public function __construct()
    {
        add_action('admin_menu', array($this, 'admin_menu'));
    }
}

?>
