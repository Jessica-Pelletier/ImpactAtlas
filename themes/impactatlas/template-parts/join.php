<?php $joinheading = get_field('join_heading'); ?>
<?php $joinbuttontext = get_field('join_button_text'); ?>
<?php $joinparagraph = get_field('join_paragraph'); ?>






<div class="container pt-5 pb-4">

  <div class="row justify-content-center mb-4">
    <div class="col-12 text-center">
      <h2><?php echo $joinheading; ?></h2>
    </div>
  </div>


  <div class="row justify-content-center mb-4 text-center">

    <div class="col-12">
      <p><?php echo $joinparagraph; ?></p>
    </div>
  </div>


  <div class="row justify-content-center text-center">
  <div class="col-md-6">
    <form action="https://outlook.us10.list-manage.com/subscribe/post?u=cecdcda267c4df17babb7e118&id=e8b628216f&f_id=00071be2f0" method="post">
      <div class="input-group">
        <input type="email" name="EMAIL" placeholder="Enter your email" required class="form-control me-2">
        <input type="hidden" name="redirect" value="http://localhost:8888/ImpactAtlas/">
        <button class="btn btn-primary"><?php echo $joinbuttontext; ?></button>
      </div>
    </form>
  </div>
</div>

</div>
