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




<div id="carouselExampleFade" class="carousel slide carousel-fade">
  <div class="carousel-inner">
    <div class="carousel-item active">
   
      <img src="<?php echo $firstslideimage['url'] ?>" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h1> <?php echo $firstslidelabel ?> </h1>
        <p> <?php echo $firstslidesubheading ?> </p>
        <button class="btn btn-primary ms-3" > <?php echo $firstslidecta ?> </button>

      </div>
      
    </div>


    <div class="carousel-item">
      <img src="<?php echo $secondslideimage['url'] ?>" class="d-block w-100" alt="...">
    </div>

    
    <div class="carousel-item">
      <img src="<?php echo $thirdslideimage['url'] ?>" class="d-block w-100" alt="...">
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



