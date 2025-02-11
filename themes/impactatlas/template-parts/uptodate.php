<?php $uptodateheading = get_field('up_to_date_heading') ?>
<?php $uptodatebutton = get_field('up_to_date_button_text') ?>
<?php $uptodateemail = get_field('up_to_date_email') ?>

<div class="container pt-5 pb-4">
  <div class="row justify-content-center mb-4">
    <div class="col-12 text-center">
      <h2>Stay Up to Date</h2>
    </div>
  </div>

  <div class="row justify-content-center text-center">
  <div class="col-md-6">
    <form action="https://outlook.us10.list-manage.com/subscribe/post?u=cecdcda267c4df17babb7e118&id=e8b628216f&f_id=00071be2f0" method="post">
      <div class="input-group">
        <input type="email" name="EMAIL" placeholder="Enter your email" required class="form-control me-2">
        <input type="hidden" name="redirect" value="https://yourwebsite.com/thank-you">
        <button class="btn btn-primary">Subscribe></button>
      </div>
    </form>
  </div>
</div>
</div>