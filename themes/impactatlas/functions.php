<?php
/**
* ImpactAtlas functions and definitions
*
* @link https://developer.wordpress.org/themes/basics/theme-functions/
*
* @package ImpactAtlas
*/

if ( ! defined( '_S_VERSION' ) ) {
   // Replace the version number of the theme on each release.
   define( '_S_VERSION', '1.0.0' );
}

/**
* Sets up theme defaults and registers support for various WordPress features.
*/
function impactatlas_setup() {
   load_theme_textdomain( 'impactatlas', get_template_directory() . '/languages' );
   add_theme_support( 'automatic-feed-links' );
   add_theme_support( 'title-tag' );
   add_theme_support( 'post-thumbnails' );
   add_theme_support('page-templates');

   register_nav_menus(
   	array(
   		'menu-1' => esc_html__( 'Primary', 'impactatlas' ),
   	)
   );

   add_theme_support(
   	'html5',
   	array(
   		'search-form',
   		'comment-form',
   		'comment-list',
   		'gallery',
   		'caption',
   		'style',
   		'script',
   	)
   );

   add_theme_support(
   	'custom-background',
   	apply_filters(
   		'impactatlas_custom_background_args',
   		array(
   			'default-color' => 'ffffff',
   			'default-image' => '',
   		)
   	)
   );

   add_theme_support( 'customize-selective-refresh-widgets' );

   add_theme_support(
   	'custom-logo',
   	array(
   		'height'      => 250,
   		'width'       => 250,
   		'flex-width'  => true,
   		'flex-height' => true,
   	)
   );
}
add_action( 'after_setup_theme', 'impactatlas_setup' );

/**
* Set the content width in pixels
*/
function impactatlas_content_width() {
   $GLOBALS['content_width'] = apply_filters( 'impactatlas_content_width', 640 );
}
add_action( 'after_setup_theme', 'impactatlas_content_width', 0 );

/**
* Register widget area.
*/
function impactatlas_widgets_init() {
   register_sidebar(
   	array(
   		'name'          => esc_html__( 'Sidebar', 'impactatlas' ),
   		'id'            => 'sidebar-1',
   		'description'   => esc_html__( 'Add widgets here.', 'impactatlas' ),
   		'before_widget' => '<section id="%1$s" class="widget %2$s">',
   		'after_widget'  => '</section>',
   		'before_title'  => '<h2 class="widget-title">',
   		'after_title'   => '</h2>',
   	)
   );
}
add_action( 'widgets_init', 'impactatlas_widgets_init' );

/**
* Enqueue scripts and styles.
*/
function impactatlas_scripts() {
    // jQuery
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.7.1.min.js', array(), '3.7.1', false);
    wp_enqueue_script('jquery');

    // Bootstrap JS
    wp_enqueue_script(
        'bootstrap-js',
        get_template_directory_uri() . '/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
        array('jquery'),
        '5.3.3',
        true
    );

    // Your custom Bootstrap CSS
    wp_enqueue_style(
        'bootstrap-custom', 
        get_template_directory_uri() . '/sass/bootstrap-custom.css',
        array(),
        filemtime(get_template_directory() . '/sass/bootstrap-custom.css')
    );
    
    // Theme styles
    wp_enqueue_style(
        'impactatlas-style', 
        get_stylesheet_uri(), 
        array('bootstrap-custom'), 
        _S_VERSION
    );

    // Single main JavaScript file
    wp_enqueue_script(
        'impactatlas-scripts',
        get_template_directory_uri() . '/js/main.js',
        array('jquery', 'bootstrap-js'),
        _S_VERSION,
        true
    );
}
add_action('wp_enqueue_scripts', 'impactatlas_scripts');
/**
* Custom Google Fonts
*/
function enqueue_custom_google_fonts() {
   wp_register_style('google-fonts-preconnect-1', 'https://fonts.googleapis.com', false);
   wp_register_style('google-fonts-preconnect-2', 'https://fonts.gstatic.com', false);
   
   wp_enqueue_style(
       'custom-google-fonts', 
       'https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', 
       array('google-fonts-preconnect-1', 'google-fonts-preconnect-2')
   );
}
add_action('wp_enqueue_scripts', 'enqueue_custom_google_fonts');

/**
* Implement the Custom Header feature.
*/
require get_template_directory() . '/inc/custom-header.php';

/**
* Custom template tags for this theme.
*/
require get_template_directory() . '/inc/template-tags.php';

/**
* Functions which enhance the theme by hooking into WordPress.
*/
require get_template_directory() . '/inc/template-functions.php';

/**
* Customizer additions.
*/
require get_template_directory() . '/inc/customizer.php';

/**
* Load Jetpack compatibility file.
*/
if ( defined( 'JETPACK__VERSION' ) ) {
   require get_template_directory() . '/inc/jetpack.php';
}

register_nav_menu('footer-menu', __('Footer Menu'));


// Add custom classes to nav menu items
class WP_Bootstrap_Navwalker extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        
        // Add active class for current page
        if ($item->current) {
            $classes[] = 'active';
        }
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $output .= '<li' . $class_names . '>';
        
        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $attributes .= ' class="nav-link' . ($item->current ? ' active' : '') . '"';
        
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}


//leaflet scripts
function enqueue_leaflet_script() {
    // Enqueue Leaflet CSS
    wp_enqueue_style('leaflet-css', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css', array(), '1.7.1');
    
    // Enqueue Leaflet JS
    wp_enqueue_script('leaflet-js', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js', array(), '1.7.1', true);
    
    // Enqueue custom map script
    wp_enqueue_script(
        'custom-map', 
        get_template_directory_uri() . '/js/main.js', 
        array('jquery', 'leaflet-js'), 
        filemtime(get_template_directory() . '/js/main.js'), 
        true
    );
    
    // Localize script with map data
    wp_localize_script('custom-map', 'mapData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('map_data_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_leaflet_script');



function get_map_markers() {
    check_ajax_referer('map_data_nonce', 'nonce');
    
    $args = array(
        'post_type' => 'articles', // Ensure this matches your custom post type
        'posts_per_page' => -1,
        'date_query' => array(
            array(
                'year' => 2025, // Specify the year 2025
            ),
        ),
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'latitude', // Updated to match your ACF field name
                'compare' => 'EXISTS'
            ),
            array(
                'key' => 'longitude', // Updated to match your ACF field name
                'compare' => 'EXISTS'
            )
        )
    );
    
    $query = new WP_Query($args);
    $markers = array();
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            
            // Get latitude and longitude using the correct field names
            $latitude = get_field('latitude');
            $longitude = get_field('longitude');
            
            // Additional safety checks
            if (empty($latitude) || empty($longitude)) {
                continue;
            }
            
            // Get categories
            $categories = get_the_terms(get_the_ID(), 'article_categories');
            $category_name = $categories ? $categories[0]->name : 'Uncategorized';
            
            $markers[] = array(
                'title' => get_the_title(),
                'excerpt' => wp_trim_words(get_the_content(), 20), // Changed from 'what' to get_the_content()
                'permalink' => get_permalink(),
                'lat' => floatval($latitude),
                'lng' => floatval($longitude),
                'category' => $category_name,
                'date' => get_the_date('Y-m-d')
            );
        }
        wp_reset_postdata();
    }
    
    wp_send_json($markers);
    wp_die();
}
add_action('wp_ajax_get_map_markers', 'get_map_markers');
add_action('wp_ajax_nopriv_get_map_markers', 'get_map_markers');