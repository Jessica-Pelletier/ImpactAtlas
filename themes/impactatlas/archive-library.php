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






    
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  
</nav>

<div class="row justify-content-center gy-4 g-md-4">
    






    <?php
$loop = new WP_Query( // The query
 array( // WP_Query arguments:
 'post_type' => 'articles', // This is the name of your post type
 'posts_per_page' => 9 // This is the amount of posts you want to show
 )
);
while ( $loop->have_posts() ) : $loop->the_post(); // The loop
?>

<!-- The content you want to display goes here: -->





<div class="col-lg-4 col-md-4">
      <div class="card" >
        <div class="card-body">
        <h5><?php the_title()?></h5>
          <h6 class="card-subtitle mb-2  secondary">   



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


<?php endwhile;
wp_reset_postdata(); // Restore original post data
?>

</div>
</section>








<?php get_template_part('template-parts/uptodate') ?>


<?php get_footer(); ?>