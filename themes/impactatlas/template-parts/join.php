<?php $joinheading = get_field('join_heading'); ?>
<?php $joinbuttontext = get_field('join_button_text'); ?>
<?php $joinparagraph = get_field('join_paragraph'); ?>






<div class="container pt-5 pb-4">

  <div class="row justify-content-center mb-4">
    <div class="col-12 text-center">
      <h2><?php echo $joinheading;?></h2>
    </div>
  </div>


  <div class="row">

    <div class="col-md-6">
      <p><?php echo $joinparagraph;?></p>
    </div>

    <div class="col-md-6 text-center">
      <button class="btn btn-primary"><?php echo $joinbuttontext;?></button>
    </div>
  </div>
</div>