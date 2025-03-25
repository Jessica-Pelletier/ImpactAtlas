<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ImpactAtlas
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!--Added JS for leaflet-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>

    <?php wp_head(); ?>




</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'impactatlas'); ?></a>

        <header id="masthead" class="site-header ">
            <div class="site-branding">






                <nav class="navbar  navbar-expand-lg  ">
                    <div class="container-fluid">

                        <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                            <?php if (has_custom_logo()) : ?>
                                <?php the_custom_logo(); ?>
                            <?php else : ?>
                                <span class="site-title"><?php bloginfo('name'); ?></span>
                            <?php endif; ?>
                        </a>



                        <!-- Navbar Toggler for Mobile -->
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#primary-menu" aria-controls="primary-menu" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <!-- Navigation Menu -->
                        <div class="collapse navbar-collapse" id="primary-menu">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'menu-1',
                                'container'      => false,
                                'menu_class'     => 'navbar-nav mx-auto text-center gap-3',
                                'fallback_cb'    => '__return_false',
                                'link_class'     => 'nav-link',
                                'add_li_class'   => 'nav-item',
                                'walker'         => new WP_Bootstrap_Navwalker(),

                            ));


                            ?>
                            <div class="text-center text-lg-end">
                                <a href="#" class="btn btn-primary d-inline-block" data-bs-toggle="modal" data-bs-target="#subscribeModal">Subscribe</a>
                            </div>

                        </div>
                    </div>





                </nav>
        </header>

        <!--The modal for the cta in nav -->

        <div class="modal fade mt-5" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="subscribeModalLabel">Subscribe to our Newsletter</h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex flex-column">
                        <p>Join our community of change-makers and reveive: </p>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2">✓ Monthly solution summaries</li>
                            <li class="mb-2">✓ Early access to success stories</li>
                            <li class="mb-2">✓ Impact analysis reports</li>
                            <li class="mb-2">✓ Implementation guides</li>
                        </ul>
                        <form action="https://outlook.us10.list-manage.com/subscribe/post?u=cecdcda267c4df17babb7e118&id=e8b628216f&f_id=00071be2f0" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>

                            </div>
                            <div class="d-flex flex-column justify-content-end mt-2">
                                <button type="submit" class="btn btn-primary ">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>