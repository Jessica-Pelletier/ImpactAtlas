<?php $uptodateheading = get_field('up_to_date_heading') ?>
<?php $uptodatebutton = get_field('up_to_date_button_text') ?>
<?php $uptodateemail = get_field('up_to_date_email') ?>

<div class="container pt-5 pb-4">
  <div class="row justify-content-center mb-4">
    <div class="col-12 text-center">
      <h2><?php echo $uptodateheading; ?></h2>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-6">
      <form action="/subscribe" method="post" class="d-flex">
        <input type="email" name="email" placeholder="Enter your email" required class="form-control me-2">
        <button type="submit" class="btn btn-primary"><?php echo $uptodatebutton; ?></button>
      </form>
    </div>
  </div>
</div>