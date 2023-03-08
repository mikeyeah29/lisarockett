<?php

class LR_AdminMenu
{
    private $title;
    private $menu_title;
    private $permissions = 'manage_options';
    private $slug = 'lr-settings';
    private $callback;

    public function admin_menu_view()
    {
        $message = '';
        $error = false;

        if (isset($_POST['lr_options'])) {

            LR_Options::update();

            $message = 'options updated';
        }

        $options = LR_Options::get();

        $page = (isset($_GET['page']) ? $_GET['page'] : '');

        include_once( plugin_dir_path( __FILE__ ) . '../admin/views/settings.php' );
    }

    public function admin_menu()
    {
        add_menu_page(
            'General', // title
            'Lisa Rockett', // menu title
            $this->permissions, // permissions
            $this->slug, // slug
            array($this, 'admin_menu_view'), // callback
            'dashicons-book-alt', // dash icon
            4 // position
        );
        // add_submenu_page(
        //     $this->slug, // parent slug
        //     'Edit Footer', // title
        //     'Edit Footer', // menu title
        //     $this->permissions,
        //     'wa-footer', // slugw
        //     array($this, 'submenu_edit_footer_view')
        // );
    }

    public function __construct()
    {
        add_action('admin_menu', array($this, 'admin_menu'));
    }
}

?>
