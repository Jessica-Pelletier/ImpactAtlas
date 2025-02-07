<?php
$whoweare = get_field('we_are_title'); 
$wearetext = get_field('we_are_text');
$weareimage = get_field('we_are_image');
?>


<div class="container text-center">
  <div class=" align-items-start">
    <div>
        <h1>
      <?php echo $whoweare ?>
</h1>
    </div>
    <div>
      <p> 
        <?php echo $wearetext ?>
    </p>
    </div>
    <div>
      <img src="<?php echo $weareimage['url'] ?>" class="img-fluid">
    </div>
  </div>
</div>
