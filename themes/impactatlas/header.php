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
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'impactatlas' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">







		
		<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <!-- Site Branding (Logo + Title) -->
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

            ));
            ?>
        </div>
    </div>
</nav>




		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
