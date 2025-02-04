<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ImpactAtlas
 */

?>

<footer id="colophon" class="site-footer">
    <div class="container">

        <div class="row mb-4">
            <div class="col text-center">
                <div class="p-3 center">   
					


<?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <span class="site-title"><?php bloginfo('name'); ?></span> 
<?php endif; ?>

			</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col">
                <div class="p-3  ">Column 1</div>
            </div>
            <div class="col">
                <div class="p-3  ">Column 2</div>
            </div>
            <div class="col">
                <div class="p-3  ">Column 3</div>
            </div>
        </div>


        <div class="row mb-4">
            <div class="col">
                <div class="p-3  ">Column 1</div>
            </div>
            <div class="col">
                <div class="p-3  ">Column 2</div>
            </div>
            <div class="col">
                <div class="p-3 ">Column 3</div>
            </div>
            <div class="col">
                <div class="p-3 ">Column 4</div>
            </div>
            <div class="col">
                <div class="p-3">Column 5</div>
            </div>
        </div>


        <div class="row mb-4">
            <div class="col">
                <div class="p-3 ">Column 1</div>
            </div>
            <div class="col">
                <div class="p-3 ">Column 2</div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>

