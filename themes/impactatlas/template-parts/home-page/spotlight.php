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

            if ($featured_query->have_posts()) :
                while ($featured_query->have_posts()) : $featured_query->the_post();
?>






<div class="card" style="width: 18rem;">
  <img src=".." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">?<php the_title(); ?></h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
            </div>


            

            <?php 
    endwhile;
    wp_reset_postdata();
endif;
?>