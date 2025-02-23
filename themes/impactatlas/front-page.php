<?php 
/*
* The front page template file
 */

get_header();

?>

<?php get_template_part('template-parts/home-page/banner') ?>
<!--leaflet.js map section-->


<div class="container text-center">

    <div class="row bg-light">
    <div class="col-md-8">
    <div><h2>A Year of global impact</h2></div>
</div>
        <div class="col-md-8">
       
            <div id="map"></div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="row py-2"><h3>Legend</h3></div>
                <div class="row py-2"><p>2024 was a year of growth, innovation, and meaningful impact </p></div>

                <div class="row py-2">
                    <div class="col-6" style="background-color: #2ecc71"></div>
                    <div class="col-6">Environmental</div>
                </div>
                <div class="row py-2">
                    <div class="col-6" style="background-color: #e74c3c"></div>
                    <div class="col-6">Technology</div>
                </div>
                <div class="row py-2">
                    <div class="col-6" style="background-color: #DF7D3B"></div>
                    <div class="col-6">Social</div>
                </div>
                <div class="row py-2">
                    <div class="col-6" style="background-color: #34495e"></div>
                    <div class="col-6">Economic</div>
                </div>
                <div class="row py-2">
                    <div class="col-6" style="background-color: #9b59b6"></div>
                    <div class="col-6">Success Stories</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
<div class="row">
    <div class="col-8"></div>
    <div class="col-4"><?php get_template_part('template-parts/home-page/spotlight') ?></div>
</div>
</div>





<div class="container">
    <div class="row">
    <div class="col-md-8">stuff</div>
    <div class="col-md-4"><?php get_template_part('template-parts/home-page/spotlight') ?></div>
</div>
</div>













<?php get_template_part('template-parts/join') ?>
<?php get_template_part('template-parts/featured') ?>






<?php get_footer(); ?>

