<?php
/*
* The front page template file
 */

get_header();

?>

<!-- <?php get_template_part('template-parts/home-page/banner') ?> -->
<!--leaflet.js map section-->

<div class="container text-center ">
    <div class="row">
        <div class="col-md-12 pt-4">
            <div>
            <h2> Tracking Global Progress in 2024 </h2>
            <p>Our map documents verfified solutions and positive initiatives completed throughout 2024, creating an atlas of global progress.</p>
            </div>
        </div>
        <div class="col">

            <div id="map"></div>
        </div>
    </div>
</div>


<section class="map-info py-4">
    <div class="container">
        <div class="col-lg-8">
         

        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="h5 mb-3">Solution Categories</h3>
                        <div class="legend-item d-flex  ">
                            <span class="legend-icon green me-2"></span>
                            <div>
                                <h4>Environmental</h4>
                            </div>
                        </div>

                        <div class="legend-item d-flex  ">
                            <span class="legend-icon orange me-2"></span>
                            <div>
                                <h4>Social</h4>
                            </div>
                        </div>

                        <div class="legend-item d-flex ">
                            <span class="legend-icon charcoal me-2"></span>
                            <div>
                                <h4>Economic</h4>
                            </div>
                        </div>

                        <div class="legend-item d-flex ">
                            <span class="legend-icon vermillion me-2"></span>
                            <div>
                                <h4>Technology</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Make these bars represent % solutions in that category? -->
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="h5 mb-3">2024 Progress by category</h3>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3">
                                <h4 class="d-block">Something title</h4>
                                <div class="progress" style="height: 10px;">
                                    <div class="progress-bar bg-success" style="width: 45%"></div>
                                </div>
                                <p class="text-muted">something something</p>
                            </li>
                            <li class="mb-3">
                                <h4 class="d-block">Something title</h4>
                                <div class="progress" style="height: 10px;">
                                    <div class="progress-bar bg-primary" style="width: 30%"></div>
                                </div>
                                <p class="text-muted">something something</p>
                            </li>
                            <li>
                                <h4 class="d-block">Something title</h4>
                                <div class="progress" style="height: 10px;">
                                    <div class="progress-bar bg-warning" style="width: 75%"></div>
                                </div>
                                <p class="text-muted">something something</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="h5 mb-3">Get Involved</h3>
                        <div class="d-grid gap-2 involved-card">
                            <a href="<?php echo get_permalink(41); ?>" class="btn btn-outline-dark blue">Submit a Solution</a>
                            <a href="<?php echo get_permalink(35); ?> " class="btn btn-outline-dark blue">Explore Success Stories</a>
                            <a href="<?php echo get_permalink(39); ?>" class="btn btn-outline-dark blue">View Implementation Guides</a>
                        </div>
                        <hr>
                        <p class="small mb-0">Our team verifies and documents each solution to ensure accuracy and replicability. Learn more about our <a href="#">documentation process</a>.</p>
                    </div>
                </div>
            </div>








        </div>

</section>



<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h3>New articles on education access</h3>
            
            <div class="row">
                <?php 
                $education_access_query = new WP_Query(array(
                    'post_type' => 'articles',
                    'posts_per_page' => 4,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'article_categories',
                            'field' => 'term_id',
                            'terms' => '20',
                            'include_children' => false
                        )
                    ),
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));
                
                if ($education_access_query->have_posts()) :
                    while ($education_access_query->have_posts()) : $education_access_query->the_post();
                    ?>
                    <div class="col-3">
                        <div class="card h-100 p-2">
                            <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            <p class="text-muted small"><?php echo get_the_date('F j, Y'); ?></p>
                        </div>
                    </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>



 <div class="row align-items-center mt-4">
            <div class="col-md-6">
                <div id="electricity-access-container">
                    <h3>Global Electricity Access</h3>
                    <p>Tracking worldwide progress in electricity accessibility from 1998 to 2022, highlighting significant improvements in global energy infrastructure.</p>
                    <div><a href="https://data.worldbank.org/indicator/EG.ELC.ACCS.ZS?locations=1W&start=1998&view=chart">View orginal data<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                    </svg></a></div>
                </div>
            </div>
            <div class="col-md-6">
                <canvas id="electricity-access-chart" class="img-fluid"></canvas>
            </div>
        </div>
    </div>



        <div class="col-md-4"><?php get_template_part('template-parts/home-page/spotlight') ?></div>
   

</div>
</div>



<?php get_template_part('template-parts/featured') ?>
<?php get_template_part('template-parts/join') ?>







<?php get_footer(); ?>