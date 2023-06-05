<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lisa Rockett | Mediumship &amp; Guidance</title>
        <meta name="description" content="description"/>
        <meta name="author" content="author" />
        <meta name="keywords" content="keywords" />
        <link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Varela+Round&display=swap" rel="stylesheet">
        <!-- CSS only -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri().'/css/slick.min.css'; ?>"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri().'/css/variables.css'; ?>">
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

        <?php wp_head(); ?>

    </head>
    <body>

        <?php $contact = LR_Options::get(); ?>

        <header class="shadow-light">



            <div class="container py-2">
                <div class="row">
                    <div class="col">
                        <h1><a href="<?php echo home_url(); ?>">Lisa Rockett</a></h1>
                    </div>
                    <div class="col text-end d-flex justify-content-end align-items-center">

                        <div class="desktop-menu d-none d-md-block">
                            <?php

                                // Define the arguments for the menu
                                $menu_args = array(
                                    'menu' => 'main-menu', // Replace 'main-menu' with the slug or name of your menu
                                    'theme_location' => 'primary',
                                    'menu_class' => '' // Remove class from ul element
                                );

                                // Output the menu
                                wp_nav_menu( $menu_args );

                            ?>
                        </div>

                        <div class="burger d-md-none">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="top-nav">
                <div class="container">
                    <div class="row">
                        <div class="col d-flex">
                            <div class="top-nav-contact-link mr-2">
                                <a href="mailto:<?php echo $contact['ADMIN_EMAIL']; ?>">
                                    <i class="fas fa-envelope"></i>
                                    <?php echo $contact['ADMIN_EMAIL']; ?>
                                </a>
                            </div>
                            <div class="top-nav-contact-link">
                                <a href="tel:<?php echo $contact['PHONE']; ?>">
                                    <i class="fas fa-phone-alt"></i>
                                    <?php echo $contact['PHONE']; ?>
                                </a>
                            </div>
                        </div>
                        <div class="col text-end">
                            <i class="fab fa-facebook-f"></i>
                        </div>
                    </div>
                </div>
            </div>

        </header>

        <div class="menu">
            <?php

                // Define the arguments for the menu
                $menu_args = array(
                    'menu' => 'main-menu', // Replace 'main-menu' with the slug or name of your menu
                    'theme_location' => 'primary',
                    'container_class' => 'menu', // Add wrapper class for the menu
                    'menu_class' => '' // Remove class from ul element
                );

                // Output the menu
                wp_nav_menu( $menu_args );

            ?>
        </div>
