<?php
$whoweare = get_field('we_are_title');
$wearetext = get_field('we_are_text');
$weareimage = get_field('we_are_image');
?>

<section class="about-section py-5 bg-blue ">
  <div class="container">
    <div class="row justify-content-center mb-4">
      <div class="col-lg-8 text-center">
        <h2 class="display-4 fw-bold mb-3 text-white"><?php echo $whoweare ?></h2>
        <div class="heading-underline mx-auto mb-4"></div>
      </div>
    </div>
    
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <div class="about-content pe-lg-4">
          <div class="content-wrapper">
            <p class="text-white lead">
            <?php echo $wearetext ?>
</p>
          </div>
          <!-- <div class="mt-4">
            <a href="<?php echo get_permalink(9); ?>" class="btn btn-primary">Learn More About Our Team</a>
          </div> -->
        </div>
      </div>
      
      <div class="col-lg-6">
        <div class="image-wrapper text-center text-lg-end">
          <?php if($weareimage): ?>
            <img src="<?php echo $weareimage['url'] ?>" alt="<?php echo $weareimage['alt'] ?>" class="img-fluid rounded shadow-lg" style="max-width: 90%;">
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

