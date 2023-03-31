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

    public function submenu_testamonials_view()
    {
        $message = '';
        $error = false;

        if (isset($_POST['lr_testamonials'])) {
            LR_Testamonials::update();
            $message = 'testamonials updated';
        }

        if (isset($_POST['remove_testimonial'])) {
            $post = RWD_Helpers::getPost();
            LR_Testamonials::remove($post['remove_testimonial']);
            $message = 'testimonial removed';
        }

        $testimonials = LR_Testamonials::get();

        $page = (isset($_GET['page']) ? $_GET['page'] : '');

        include_once( plugin_dir_path( __FILE__ ) . '../admin/views/testamonials.php' );
    }

    public function submenu_testamonials_add_view()
    {
        $message = '';
        $error = false;

        if (isset($_POST['submit_add'])) {
            $post = RWD_Helpers::getPost();
            LR_Testamonials::add($post);
            $message = 'testimonial added';
        }

        $page = (isset($_GET['page']) ? $_GET['page'] : '');

        include_once( plugin_dir_path( __FILE__ ) . '../admin/views/testimonials-add.php' );
    }

    public function submenu_testamonials_edit_view()
    {
        $message = '';
        $error = false;

        if (isset($_POST['submit_update'])) {
            $post = RWD_Helpers::getPost();
            $index = $post['testimonial_index'];
            LR_Testamonials::update($index, $post);
            $message = 'testimonial updated';
        }

        $testimonial = LR_Testamonials::getOne($_GET['id']);

        $page = (isset($_GET['page']) ? $_GET['page'] : '');
        include_once( plugin_dir_path( __FILE__ ) . '../admin/views/testimonials-edit.php' );
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
        add_submenu_page(
            $this->slug, // parent slug
            'Testimonials', // title
            'Testimonials', // menu title
            $this->permissions,
            'lr-testamonials', // slugw
            array($this, 'submenu_testamonials_view')
        );
        add_submenu_page(
            $this->slug, // parent slug
            'Add Testimonial', // title
            '', // menu title
            $this->permissions,
            'lr-testamonials-add', // slugw
            array($this, 'submenu_testamonials_add_view')
        );
        add_submenu_page(
            $this->slug, // parent slug
            'Edit Testimonial', // title
            '', // menu title
            $this->permissions,
            'lr-testamonials-edit', // slugw
            array($this, 'submenu_testamonials_edit_view')
        );
    }

    public function __construct()
    {
        add_action('admin_menu', array($this, 'admin_menu'));
    }
}

?>
