<?php
$recent_articles = new WP_Query(array(
    'post_type' => 'articles', 
    'posts_per_page' => 3,
    'orderby' => 'date',
    'order' => 'DESC'
));
?>

<div id="carouselExample" class="carousel slide banner" data-bs-ride="carousel">
  <div class="carousel-inner">
    <?php 
    if ($recent_articles->have_posts()) : 
        $first = true;
        while ($recent_articles->have_posts()) : 
            $recent_articles->the_post(); 
    ?>
        <div class="carousel-item <?php echo $first ? 'active' : ''; ?> text-center">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </div>
    <?php 
        $first = false;
        endwhile; 
        wp_reset_postdata(); 
    endif; 
    ?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>