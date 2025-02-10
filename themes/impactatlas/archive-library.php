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
  </div>
</nav>

<div class="row justify-content-center gy-4 g-md-4">
    

    <div class="col-lg-4 col-md-4">
      <div class="card" >
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <a href="#" class="card-link">Card link</a>
          <a href="#" class="card-link">Another link</a>
        </div>
      </div>
    </div>


</div>






</section>








<?php get_template_part('template-parts/uptodate') ?>


<?php get_footer(); ?>