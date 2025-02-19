<section class="featured bg-light">
    <div class="container pt-5 p-5">
        <h2>Featured Articles</h2>
        <div class="row justify-content-center gy-4 g-md-4">
            <?php 
            $featured_args = array(
                'post_type' => 'articles',
                'posts_per_page' => 3,
                'meta_query' => array(
                    array(
                        'key' => 'featured_article', 
                        'value' => '1',
                        'compare' => '='
                    )
                )
            );

            $featured_query = new WP_Query($featured_args);

            if($featured_query->have_posts()) : 
                while($featured_query->have_posts()) : $featured_query->the_post(); 
                ?>
                <div class="col-lg-4 col-md-4">
                    <div class="card  h-100">
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
    
    <a class="align-self-end mt-auto" href="<?php the_permalink(); ?>" class="card-link">View Study 
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
        </svg>
    </a>
</div>
                    </div>
                </div>
                <?php 
                endwhile;
            endif; 
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>


    




  </div>
</div>
</section>