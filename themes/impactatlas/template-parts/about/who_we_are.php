<?php
$whoweare = get_field('we_are_title');
$wearetext = get_field('we_are_text');
$weareimage = get_field('we_are_image');
?>

<section class="bg-light">
<div class="container text-center">


    <div>
        <h1>
            <?php echo $whoweare ?>
        </h1>
    </div>




    <div class="row align-items-center">
        <div class="col-md-6 text md-start p-5">
            <p>
                <?php echo $wearetext ?>
            </p>
        </div>
   
    <div class="col-md-6">
        <img src="<?php echo $weareimage['url'] ?>" class="img-fluid w-50">

    </div>
    </div>
</div>
</section>