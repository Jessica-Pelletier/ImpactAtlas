<?php 
/*
* The front page template file
 */

get_header();

?>
<!--leaflet.js map-->


<div class="container text-center">
    <div class="row">

        <div class="col-md-6">
            <div id="map"></div>
        </div>

    
        <div class="col-md-6">
            <div class="row">
                <div class="col-12 py-2">Right item 1</div>
                <div class="col-12 py-2">Right item 2</div>
                <div class="col-12 py-2">Right item 3</div>
            </div>
        </div>
    </div>
</div>














<?php get_template_part('template-parts/join') ?>
<?php get_template_part('template-parts/featured') ?>






<?php get_footer(); ?>

