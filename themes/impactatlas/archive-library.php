<?php get_header(); ?>

<?php get_template_part('template-parts/featured') ?>

<section class="articles container p-5">
    <div class="row"> <!-- Main row container for sidebar + content -->
        <!-- Sidebar Filters -->
        <h2>All Articles</h2>
        <div class="col-lg-3">
            <div class="filter-sidebar p-3 bg-light rounded">
                <h3 class="h5 mb-4">Filters</h3>
                <form method="GET">
            <!---seafch bar-->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Search</label>
                        <input class="form-control" type="search" name="article_search" 
                            placeholder="Search articles..." 
                            value="<?php echo isset($_GET['article_search']) ? esc_attr($_GET['article_search']) : ''; ?>">
                    </div>
           
                    <div class="mb-4">
                        <label class="form-label fw-bold">Categories</label>
                        <?php
                        $categories = get_terms([
                            'taxonomy' => 'article_categories',
                            'hide_empty' => true,
                            'parent' => 0
                        ]);
                        
                        foreach ($categories as $category) {
                            $checked = (isset($_GET['category_filter']) && 
                                      (is_array($_GET['category_filter']) && 
                                       in_array($category->term_id, $_GET['category_filter']))) ? 'checked' : '';
                            ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       name="category_filter[]" 
                                       id="cat-<?php echo $category->term_id; ?>" 
                                       value="<?php echo $category->term_id; ?>" <?php echo $checked; ?>>
                                <label class="form-check-label" for="cat-<?php echo $category->term_id; ?>">
                                    <?php echo $category->name; ?>
                                </label>
                            </div>
                            
                            <?php
                  
                            $subcategories = get_terms([
                                'taxonomy' => 'article_categories',
                                'hide_empty' => true,
                                'parent' => $category->term_id
                            ]);
                            
                            foreach ($subcategories as $subcategory) {
                                $checked = (isset($_GET['category_filter']) && 
                                          (is_array($_GET['category_filter']) && 
                                           in_array($subcategory->term_id, $_GET['category_filter']))) ? 'checked' : '';
                                ?>
                                <div class="form-check ms-4">
                                    <input class="form-check-input" type="checkbox" 
                                           name="category_filter[]" 
                                           id="cat-<?php echo $subcategory->term_id; ?>" 
                                           value="<?php echo $subcategory->term_id; ?>" <?php echo $checked; ?>>
                                    <label class="form-check-label" for="cat-<?php echo $subcategory->term_id; ?>">
                                        <?php echo $subcategory->name; ?>
                                    </label>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    
                    <!-- Date Range -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Date Range</label>
                        <div class="mb-2">
                            <label class="form-label small">From:</label>
                            <input type="date" class="form-control" name="date_from" 
                                value="<?php echo isset($_GET['date_from']) ? esc_attr($_GET['date_from']) : ''; ?>">
                        </div>
                        <div>
                            <label class="form-label small">To:</label>
                            <input type="date" class="form-control" name="date_to" 
                                value="<?php echo isset($_GET['date_to']) ? esc_attr($_GET['date_to']) : ''; ?>">
                        </div>
                    </div>
                    
                    <!-- Filter Controls -->
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Apply Filters</button>
                        <?php if (isset($_GET['article_search']) || isset($_GET['category_filter']) || isset($_GET['date_from']) || isset($_GET['date_to'])): ?>
                            <a href="<?php echo get_permalink(); ?>" class="btn btn-outline-secondary">Reset All</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Main Content Area -->
        <div class="col-lg-9">
           
            
            <?php
            // Show active filters if any
            $active_filters = array();
            $search_query = isset($_GET['article_search']) ? sanitize_text_field($_GET['article_search']) : '';
            
            if (!empty($search_query)) {
                $active_filters[] = 'Search: "' . esc_html($search_query) . '"';
            }
            if (!empty($_GET['category_filter'])) {
                $filter_cats = is_array($_GET['category_filter']) ? $_GET['category_filter'] : array($_GET['category_filter']);
                foreach ($filter_cats as $cat_id) {
                    $term = get_term($cat_id, 'article_categories');
                    if ($term) {
                        $active_filters[] = 'Category: ' . $term->name;
                    }
                }
            }
            if (!empty($_GET['date_from']) || !empty($_GET['date_to'])) {
                $date_label = 'Date: ';
                if (!empty($_GET['date_from'])) {
                    $date_label .= 'From ' . date('M j, Y', strtotime($_GET['date_from']));
                }
                if (!empty($_GET['date_to'])) {
                    $date_label .= (!empty($_GET['date_from']) ? ' ' : '') . 'To ' . date('M j, Y', strtotime($_GET['date_to']));
                }
                $active_filters[] = $date_label;
            }
            
            if (!empty($active_filters)) {
                echo '<div class="active-filters mb-4 p-3 bg-light rounded">';
                echo '<div class="small text-muted mb-2">Active filters:</div>';
                echo '<div class="d-flex flex-wrap gap-2">';
                foreach ($active_filters as $filter) {
                    echo '<span class="badge bg-secondary">' . $filter . '</span>';
                }
                echo '</div>';
                echo '</div>';
            }
            ?>
            
            <!-- Article Cards -->
            <div class="row gy-4 g-md-4">
                <?php
                // Get and process all filter parameters
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $category_filter = isset($_GET['category_filter']) ? array_map('intval', (array)$_GET['category_filter']) : array();
                $date_from = isset($_GET['date_from']) ? sanitize_text_field($_GET['date_from']) : '';
                $date_to = isset($_GET['date_to']) ? sanitize_text_field($_GET['date_to']) : '';
                
                $args = array(
                    'post_type' => 'articles',
                    'posts_per_page' => 9,
                    'paged' => $paged,
                    'orderby' => 'date',
                    'order' => 'DESC'
                );
                
                // Date query
                $date_query = array();
                if (!empty($date_from)) {
                    $date_query['after'] = $date_from;
                }
                if (!empty($date_to)) {
                    $date_query['before'] = $date_to;
                    $date_query['inclusive'] = true;
                }
                if (!empty($date_query)) {
                    $args['date_query'] = array($date_query);
                }
                
                // Category filter
                if (!empty($category_filter)) {
                    $args['tax_query'] = array(
                        array(
                            'taxonomy' => 'article_categories',
                            'field' => 'term_id',
                            'terms' => $category_filter,
                            'operator' => 'IN'
                        )
                    );
                }
                
                // Search functionality
                if (!empty($search_query)) {
                    $args['meta_query'] = array(
                        'relation' => 'OR',
               
                        array(
                            'key' => 'what',
                            'value' => $search_query,
                            'compare' => 'LIKE'
                        ),
                  
                        array(
                            'key' => 'how',
                            'value' => $search_query,
                            'compare' => 'LIKE'
                        ),
           
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
                    
      
                    $args['_meta_or_title'] = $search_query;
                    add_filter('posts_where', function ($where) use ($search_query) {
                        global $wpdb;
                        $where .= " OR {$wpdb->posts}.post_title LIKE '%" . esc_sql($wpdb->esc_like($search_query)) . "%'";
                        return $where;
                    });
                }
                
                $loop = new WP_Query($args);
                
                if ($loop->have_posts()) :
                    while ($loop->have_posts()) : $loop->the_post();
                ?>
                    <div class="col-md-6 col-lg-6">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column">
                                <h5><?php the_title() ?></h5>
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
                                
                                <span class="post-date mb-2 text-muted small">
                                    <?php echo get_the_date('F j, Y'); ?>
                                </span>
                                
                                <a class="align-self-end mt-auto" href="<?php the_permalink(); ?>">View Study
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php
                    endwhile;
                else:
                ?>
                    <div class="col-12 text-center">
                        <h3>No articles found matching your criteria.</h3>
                    </div>
                <?php
                endif;
                wp_reset_postdata();
                ?>
            </div>
            
            <!-- Pagination -->
            <div class="pagination mt-4">
                <?php
                $big = 999999999;
                echo paginate_links(array(
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '?paged=%#%',
                    'current' => max(1, get_query_var('paged')),
                    'total' => $loop->max_num_pages,
                    'add_args' => array(
                        'article_search' => $search_query,
                        'category_filter' => $category_filter,
                        'date_from' => $date_from,
                        'date_to' => $date_to
                    )
                ));
                ?>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('template-parts/uptodate') ?>

<?php get_footer(); ?>