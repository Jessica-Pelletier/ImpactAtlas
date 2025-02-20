<?php
$featured_args = array(
    'post_type' => 'articles',
    'posts_per_page' => 1,
    'meta_query' => array(
        array(
            'key' => 'article_type',
            'value' => 'interview',
            'compare' => '='
        )
    )
);

$featured_query = new WP_Query($featured_args);

if ($featured_query->have_posts()) :
    while ($featured_query->have_posts()) : $featured_query->the_post();
?>



        <?php $spotlightImage = get_field('cpt_image') ?>
        <?php $splotlightText = get_field('article_body') ?>


        <div class="card bg-light" style="width: 100%;">
            <img src="<?php echo $spotlightImage['url'] ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?php the_title(); ?></h5>
                <p class="card-text"><?php echo wp_trim_words(get_field('article_body'), 20, '...'); ?></p>
                <a class="align-self-end mt-auto" href="<?php the_permalink(); ?>" class="card-link">Read Interview
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                    </svg>
                </a>
            </div>
        </div>




<?php
    endwhile;
    wp_reset_postdata();
endif;
?>