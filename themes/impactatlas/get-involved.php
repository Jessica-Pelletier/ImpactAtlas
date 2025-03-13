<?php 
/*
Template Name: get-involved
*/


get_header();
?>
 
<!-- Join the movement  -->
<?php 
$joinmovementtitle = get_field('join_the_movement_title'); 
$joinmovementtext = get_field('join_the_movement_text'); 
$joinmovementbutton = get_field('join_the_movement_button_text');
?>

<section class="bg-primary text-white py-5">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1 class="display-4 fw-bold mb-3"><?php echo $joinmovementtitle ?></h1>
                <p class="lead mb-4"><?php echo $joinmovementtext ?></p>
                <a href="#ways-to-help" class="btn btn-light btn-lg px-4">
                    <?php echo $joinmovementbutton  ?>
                </a>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/helpinghand.jpg" alt="Collaboration" class="img-fluid rounded shadow-lg"  style="max-height: 400px">
            </div>
        </div>
    </div>
</section>


<!-- Movement Stats -->

<?php $statone = get_field('stat_one');
$numberone = get_field('number_one');
$stattwo = get_field('stat_two');
$numbertwo = get_field('number_two');
$statthree = get_field('stat_three');
$numberthree = get_field('number_three');
$statfour = get_field('stat_four');
$numberfour = get_field('number_four');

?>

<section>


    <div class="container text-center">
        <div class="row align-items-center p-4">
            <div class="col">
                <h2>
                    <?php echo $numberone ?>
                </h2>
                <h3>
                    <?php echo $statone ?>
                </h3>
            </div>
            <div class="col">
                <h2>
                    <?php echo $numbertwo ?>
                </h2>
                <h3>
                    <?php echo $stattwo ?>
                </h3>
            </div>
            <div class="col">
                <h2>
                    <?php echo $numberthree ?>
                </h2>
                <h3>
                    <?php echo $statthree ?>
                </h3>
            </div>
            <div class="col">
                <h2>
                    <?php echo $numberfour ?>
                </h2>
                <h3>
                    <?php echo $statfour ?>
                </h3>
            </div>
        </div>
    </div>



</section>


<!-- Releif web opportunities  -->
<div class="container">
<div id="reliefweb-jobs-container">
<ul class="jobs-list">
    
</ul>
</div>
</div>




<?php get_template_part('template-parts/uptodate'); ?>



<?php get_footer(); ?>