<?php
/** 
 * Template Name: archive-library
 */

get_header(); ?>
  
<?php get_template_part('template-parts/featured') ?>

<section class="articles container p-5">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <h2>All Articles</h2>
            <form class="d-flex" role="search" method="GET">
                <input class="form-control me-2" type="search" name="article_search" 
                    placeholder="Search" value="<?php echo isset($_GET['article_search']) ? esc_attr($_GET['article_search']) : ''; ?>">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div class="row justify-content-center gy-4 g-md-4">
    <?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$search_query = isset($_GET['article_search']) ? sanitize_text_field($_GET['article_search']) : '';

$args = array(
    'post_type' => 'articles',
    'posts_per_page' => 9,
    'paged' => $paged,
    'orderby' => 'date',
    'order' => 'DESC'
);

// Only add search parameters if there's a search query
if (!empty($search_query)) {
    $args['meta_query'] = array(
        'relation' => 'OR',
        // Search in 'what' field
        array(
            'key' => 'what',
            'value' => $search_query,
            'compare' => 'LIKE'
        ),
        // Search in 'how' field (add other ACF fields as needed)
        array(
            'key' => 'how',
            'value' => $search_query,
            'compare' => 'LIKE'
        ),
        // Search in 'why' field
        array(
            'key' => 'why',
            'value' => $search_query,
            'compare' => 'LIKE'
        ),
        array(
          'key' => 'original_research',
          'value' => $search_query,
          'compare' => 'LIKE'
      )
    );
    
    // Also search in title
    $args['_meta_or_title'] = $search_query;
    add_filter('posts_where', function($where) use ($search_query) {
        global $wpdb;
        $where .= " OR {$wpdb->posts}.post_title LIKE '%" . esc_sql($wpdb->esc_like($search_query)) . "%'";
        return $where;
    });
}

        $loop = new WP_Query($args);

        if ($loop->have_posts()) :
            while ($loop->have_posts()) : $loop->the_post(); 
            ?>
            <div class="col-lg-4 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5><?php the_title()?></h5>
                        <h6 class="card-subtitle mb-2 secondary">   
                            <?php 
                            $terms = get_the_terms(get_the_ID(), 'article_categories');
                            if ($terms && !is_wp_error($terms)) {
                                $first_term = reset($terms);
                                echo $first_term->name;
                            }
                            ?>
                        </h6>
                        <p class="card-text">
                            <?php echo wp_trim_words(get_field('what'), 20, '...'); ?>
                        </p>
                        <a href="<?php the_permalink(); ?>" class="card-link">View Study</a>
                    </div>
                </div>
            </div>
            <?php 
            endwhile;
        else:
            // If no search is performed, show all posts
            if (empty($search_query)) {
                $default_args = array(
                    'post_type' => 'articles',
                    'posts_per_page' => 9,
                    'orderby' => 'date',
                    'order' => 'DESC'
                );
                $default_query = new WP_Query($default_args);
                
                while ($default_query->have_posts()) : $default_query->the_post();
                ?>
                <div class="col-lg-4 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5><?php the_title()?></h5>
                            <h6 class="card-subtitle mb-2 secondary">   
                                <?php 
                                $terms = get_the_terms(get_the_ID(), 'article_categories');
                                if ($terms && !is_wp_error($terms)) {
                                    $first_term = reset($terms);
                                    echo $first_term->name;
                                }
                                ?>
                            </h6>
                            <p class="card-text">
                                <?php echo wp_trim_words(get_field('what'), 20, '...'); ?>
                            </p>
                            <a href="<?php the_permalink(); ?>" class="card-link">View Study</a>
                        </div>
                    </div>
                </div>
                <?php
                endwhile;
                wp_reset_postdata();
            } else {
                ?>
                <div class="col-12 text-center">
                    <h3>No articles found matching your search.</h3>
                </div>
                <?php
            }
        endif;
        wp_reset_postdata(); 
        ?>
    </div>
</section>

<?php get_template_part('template-parts/uptodate') ?>

<?php get_footer(); ?>