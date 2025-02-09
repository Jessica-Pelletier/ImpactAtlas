<?php
/**
*Plugin Name: Articles CPT plugin
**/


function articles_post_type() {
    register_post_type( 'articles',
        array(
            'labels' => array(
                'name' => __( 'Articles' ),
                'singular_name' => __( 'Article' )
            ),
            'public' => true,
            'show_in_rest' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'has_archive' => true,
            'rewrite'   => array( 'slug' => 'my-articles' ),
            'menu_position' => 5,
            'menu_icon' => 'dashicons-media-document',
            // 'taxonomies' => array('categories', 'post_tag') // this is IMPORTANT
        )
    );
}
add_action( 'init', 'articles_post_type' );

//// Add categories taxonomy
function create_articles_taxonomy() {
    register_taxonomy('categories','articles',array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x( 'Categories', 'taxonomy general name' ),
            'singular_name' => _x( 'Category', 'taxonomy singular name' ),
            'menu_name' => __( 'Categories' ),
            'all_items' => __( 'All Categories' ),
            'edit_item' => __( 'Edit Category' ), 
            'update_item' => __( 'Update Category' ),
            'add_new_item' => __( 'Add Category' ),
            'new_item_name' => __( 'New Category' ),
        ),
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
    ));
    register_taxonomy('tags','articles',array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x( 'Topics', 'taxonomy general name' ),
            'singular_name' => _x( 'Topic', 'taxonomy singular name' ),
            'menu_name' => __( 'Topics' ),
            'all_items' => __( 'All Topics' ),
            'edit_item' => __( 'Edit Topic' ), 
            'update_item' => __( 'Update Topic' ),
            'add_new_item' => __( 'Add Topic' ),
            'new_item_name' => __( 'New Topic' ),
        ),
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
    ));
}
add_action( 'init', 'create_articles_taxonomy', 0 );
