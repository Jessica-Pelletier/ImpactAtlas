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

<section class="bg-light py-5">
    <div class="container py-4">
        <h2 class="text-center mb-5">Our Collective Impact</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm text-center p-4">
                    <h2 class="display-5 fw-bold text-primary mb-2"><?php echo $numberone ?></h2>
                    <p class="lead mb-0"><?php echo $statone ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm text-center p-4">
                    <h2 class="display-5 fw-bold text-primary mb-2"><?php echo $numbertwo ?></h2>
                    <p class="lead mb-0"><?php echo $stattwo ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm text-center p-4">
                    <h2 class="display-5 fw-bold text-primary mb-2"><?php echo $numberthree ?></h2>
                    <p class="lead mb-0"><?php echo $statthree ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm text-center p-4">
                    <h2 class="display-5 fw-bold text-primary mb-2"><?php echo $numberfour ?></h2>
                    <p class="lead mb-0"><?php echo $statfour ?></p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Releif web opportunities  -->

<section class="relief-web-section py-4">
  <div class="container">
    <h3 class="mb-4">Global Humanitarian Opportunities</h3>
    
    <!-- Filter and Search Controls -->
    <div class="row mb-4">
      <div class="col-md-8">
        <div class="btn-group" role="group" aria-label="Job type filter">
          <button type="button" class="btn btn-outline-primary active" data-filter="all">All</button>
          <button type="button" class="btn btn-outline-primary" data-filter="volunteer">Volunteer</button>
          <button type="button" class="btn btn-outline-primary" data-filter="paid">Paid</button>
        </div>
      </div>
      <div class="col-md-4">
        <input type="text" id="job-search" class="form-control" placeholder="Search opportunities...">
      </div>
    </div>



    <div id="reliefweb-jobs-container" class="d-none">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="table-light">
            <tr>
              <th scope="col" class="sortable" data-sort="title">Position <i class="bi bi-arrow-down-up"></i></th>
              <th scope="col" class="sortable" data-sort="org">Organization <i class="bi bi-arrow-down-up"></i></th>
              <th scope="col" class="sortable" data-sort="type">Type</th>
              <th scope="col" class="sortable" data-sort="date">Posted <i class="bi bi-arrow-down-up"></i></th>
              <th scope="col" class="sortable" data-sort="closing">Deadline <i class="bi bi-arrow-down-up"></i></th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody id="jobs-table-body">
        
          </tbody>
         
        </table>

        <div id="jobs-pagination" class="mt-3 d-flex justify-content-center">

</div>
      </div>

      </div>

</div>
</section>










<!-- <div class="container">
<div id="reliefweb-jobs-container">
<ul class="jobs-list">
    
</ul>
</div>
</div> -->




<?php get_template_part('template-parts/uptodate'); ?>



<?php get_footer(); ?>