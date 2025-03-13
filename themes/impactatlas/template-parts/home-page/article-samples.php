<?php

$articles_query = new WP_Query(array(
    'post_type' => 'articles',
    'posts_per_page' => 4,
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => 'cpt_image',
            'compare' => '!=',
            'value' => ''
        ),
        array(
            'key' => 'article_type',
            'compare' => '=',
            'value' => 'article'
        )
    ),
    'orderby' => 'date',
    'order' => 'DESC'
));
?>

<div class="container py-4 explore">
    <h2>Fresh Perspectives: Just Documented</h2>
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
    <?php if ($articles_query->have_posts()) : ?>
      <?php while ($articles_query->have_posts()) : $articles_query->the_post(); ?>
        <div class="col">
          <a href="<?php the_permalink(); ?>" class="article-card">
            <?php 
            $image = get_field('cpt_image');
            if ($image) : ?>
              <div class="card-img-container">
                <img src="<?php echo esc_url($image['url']); ?>" class="card-img-top" alt="<?php echo esc_attr($image['alt']); ?>">
              </div>
            <?php endif; ?>
            <div>
              <h5 class="mb-2"><?php the_title(); ?></h5>
              <p class="text-muted mb-3"><?php echo wp_trim_words(get_field('what'), 10, '...'); ?></p>
            </div>
          </a>
        </div>
      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>


    
    
    <?php endif; ?>
  </div>

  <div class="text-end mt-4">
  <a href="<?php echo get_permalink(35); ?>" class="btn btn-outline-primary btn-sm ">
    View All Solutions
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
    </svg>
  </a>
</div>
</div>