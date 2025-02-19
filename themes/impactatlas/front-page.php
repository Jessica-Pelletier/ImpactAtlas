<?php 
/*
* The front page template file
 */

get_header();

?>
<!--leaflet.js map-->
<div id="map"></div>
<!-- <script> const map = L.map( 'map' ).setView( [ 51.505, -0.09 ], 13 );

L.tileLayer( 'https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
	maxZoom: 19,
	attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
} ).addTo( map );
</script> -->
<?php get_template_part('template-parts/join') ?>
<?php get_template_part('template-parts/featured') ?>






<?php get_footer(); ?>

