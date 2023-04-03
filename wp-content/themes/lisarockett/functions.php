<?php

// include('classes/LR_WalkerNavMenu.php');

function lr_theme_menus() {
    register_nav_menus( array(
        'primary' => __( 'Primary Menu' )
    ) );
}
add_action( 'init', 'lr_theme_menus' );

function dd($var)
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
    die();
}

function lr_remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'lr_remove_admin_login_header');

?>
