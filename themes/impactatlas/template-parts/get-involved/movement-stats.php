<?php $statone = get_field('stat_one');
$numberone = get_field('number_one');
$stattwo = get_field('stat_two');
$numbertwo = get_field('number_two');
$statthree = get_field('stat_three');
$numberthree = get_field('number_three');
$statfour = get_field('stat_four');
$numberfour = get_field('number_four');

?>

<section>


    <div class="container text-center">
        <div class="row align-items-center p-4">
            <div class="col">
                <h2>
                    <?php echo $numberone ?>
                </h2>
                <h3>
                    <?php echo $statone ?>
                </h3>
            </div>
            <div class="col">
                <h2>
                    <?php echo $numbertwo ?>
                </h2>
                <h3>
                    <?php echo $stattwo ?>
                </h3>
            </div>
            <div class="col">
                <h2>
                    <?php echo $numberthree ?>
                </h2>
                <h3>
                    <?php echo $statthree ?>
                </h3>
            </div>
            <div class="col">
                <h2>
                    <?php echo $numberfour ?>
                </h2>
                <h3>
                    <?php echo $statfour ?>
                </h3>
            </div>
        </div>
    </div>



</section>