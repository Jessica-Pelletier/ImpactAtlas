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
        $spotlightImage = get_field('cpt_image');
        $spotlightText = get_field('article_body');
?>

<div class="row align-items-center">
    <div class="col-md-6">
        <div>
            <h3><?php the_title(); ?></h3>
            <p><?php echo wp_trim_words($spotlightText, 30, '...'); ?></p>
            <div>
                <a href="<?php the_permalink(); ?>">
                    Read Interview
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <?php if ($spotlightImage) : ?>
            <img src="<?php echo esc_url($spotlightImage['url']); ?>" alt="<?php echo esc_attr($spotlightImage['alt']); ?>" class="img-fluid rounded">
        <?php endif; ?>
    </div>
</div>

<?php
    endwhile;
    wp_reset_postdata();
endif;
?>