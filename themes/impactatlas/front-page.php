<?php
/*
* The front page template file
 */

get_header();

?>

<?php get_template_part('template-parts/home-page/banner') ?>
<!--leaflet.js map section-->

    <div class="container text-center">

        <div class="row">
            <div class="col-md-12 pt-4">
                <div>
                    <h2>A Year of global impact</h2>
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
            <h2> Tracking Global Progress in 2024 </h2>
            <p>Our map documents verfified solutions and positive initiatives completed throughout 2024, creating an atlas of global progress.</p>
            <p>Each marker represents a documented success story - from environmental conservation to social innovation. By mapping these solutions as they happen, we're building a resource of what works, where, and how it can be replicated.</p>
        </div>
        <div class="col-lg-4">
            <div class="row g-3">
                <div class="col-6">
                    <div class="p-3 bg-light rounded text-center">
                        <div class="h2 mb-1">42</div>
                        <p class="text-muted">Countries</small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 bg-light rounded text-center">
                        <div class="h2 mb-1">275</div>
                        <p class="text-muted">Solutions</small>
                    </div>
                </div>

            </div>

        </div>




</section>















<div class="container">
    <div class="row">
        <div class="col-md-8">stuff</div>
        <div class="col-md-4"><?php get_template_part('template-parts/home-page/spotlight') ?></div>
    </div>
</div>













<?php get_template_part('template-parts/join') ?>
<?php get_template_part('template-parts/featured') ?>






<?php get_footer(); ?>