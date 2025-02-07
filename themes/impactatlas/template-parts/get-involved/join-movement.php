<?php 
$joinmovementtitle = get_field('join_the_movement_title'); 
$joinmovementtext = get_field('join_movement_text'); 
$joinmovementbutton = get_field('joing_movement_button_text');
?>

<section class="container text-center ">
<div>
<h1> <?php echo $joinmovementtitle ?> </h1>
</div>

<div>
<p> <?php echo $joinmovementtext ?> </p>
</div>


<div>
<button> <?php echo $joinmovementbutton ?> </button>
</div>



</section>