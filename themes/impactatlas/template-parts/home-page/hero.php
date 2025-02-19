<?php $firstslidelabel = get_field('first_slide_label'); ?>
<?php $firstslidesubheading = get_field('first_slide_subheading'); ?>
<?php $firstslidecta = get_field('first_slide_cta'); ?>
<?php $firstslideimage = get_field('first_slide_image'); ?>

<?php $secondslidelabel = get_field('second_slide_label'); ?>
<?php $secondslidesubheading = get_field('second_slide_subheading'); ?>
<?php $secondslidecta = get_field('second_slide_cta'); ?>
<?php $secondslideimage = get_field('second_slide_image'); ?>

<?php $thirdslidelabel = get_field('third_slide_label'); ?>
<?php $thirdslidesubheading = get_field('third_slide_subheading'); ?>
<?php $thirdslidecta = get_field('third_slide_cta'); ?>
<?php $thirdslideimage = get_field('third_slide_image'); ?>




<div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
  <div class="carousel-inner">
    <div class="carousel-item active">
   
      <img src="<?php echo $firstslideimage['url'] ?>" class="d-block w-100 " alt="...">
      <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
      <div class="carousel-caption d-none d-md-block">
        <h1> <?php echo $firstslidelabel ?> </h1>
        <h2> <?php echo $firstslidesubheading ?> <h2>
        <a href="<?php echo get_permalink(35); ?>" class="btn btn-primary ms-3">
    <?php echo $firstslidecta ?>
</a>

      </div>
      
    </div>


    <div class="carousel-item">
      <img src="<?php echo $secondslideimage['url'] ?>" class="d-block w-100" alt="...">
      <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
      <div class="carousel-caption d-none d-md-block">
        <h1> <?php echo $secondslidelabel ?> </h1>
        <h2> <?php echo $secondslidesubheading ?> <h2>

        <a href="<?php echo get_permalink(39); ?>" class="btn btn-primary ms-3">
    <?php echo $secondslidecta ?>
</a>


      </div>
    </div>

    
    <div class="carousel-item">
      <img src="<?php echo $thirdslideimage['url'] ?>" class="d-block w-100" alt="...">
      <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
      <div class="carousel-caption d-none d-md-block ">
 
        <h1> <?php echo $thirdslidelabel ?> </h1>
        <h2> <?php echo $thirdslidesubheading ?> <h2>

        <a href="<?php echo get_permalink(37); ?>" class="btn btn-primary ms-3">

    <?php echo $thirdslidecta ?>
</a>




      </div>
    </div>
  </div>


  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>



