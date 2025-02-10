<section class="featured bg-light">
    <div class="container pt-5 pb-5">
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
            endif; 
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>


    




  </div>
</div>
</section>