<?php

/**
 * Template Name: Single Article
 * 
 * This is the template that displays all single articles.
 */

get_header(); ?>

<div class="container p-5 ">
	<div class="row ">
		<div class="col-lg-8 bg-light">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<!-- Article Header -->
					<header class="article-header mb-4">
						<h1><?php the_title(); ?></h1>

						<!-- Category -->
						<?php
						$terms = get_the_terms(get_the_ID(), 'article_categories');
						if ($terms && !is_wp_error($terms)) {
							$first_term = reset($terms);
							echo '<span class="category">' . $first_term->name . '</span>';
						}
						?>
					</header>

					<!-- Article Content -->
					<div class="article-content">
						<!-- Get your ACF fields -->
						<?php if (get_field('what')): ?>
							<div class="section mb-4">
								<h2>What</h2>
								<p> <?php echo get_field('what'); ?></p>
							</div>
						<?php endif; ?>

						<?php if (get_field('where')): ?>
							<div class="section mb-4">
								<h2>Where</h2>
								<?php echo get_field('where'); ?>
							</div>
						<?php endif; ?>

						<?php if (get_field('how')): ?>
							<div class="section mb-4">
								<h2>How</h2>
								<?php echo get_field('how'); ?>
							</div>
						<?php endif; ?>
						<?php if (get_field('original_researcj')): ?>
							<div class="section mb-4">
								<h2>Original research</h2>
								<?php echo get_field('original_research'); ?>
							</div>
						<?php endif; ?>

						<?php if (get_field('original_link')); ?>
						<a  href="<?php echo get_field('original_link') ?>">View Study <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
								<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
							</svg></a>
					</div>

			<?php endwhile;
			endif; ?>
		</div>

		<!-- Sidebar -->
		<div class="col-lg-4">
			<div class="sidebar bg-light">
				<h3>Related Articles</h3>
				<?php
				// Get articles in the same category
				$terms = get_the_terms(get_the_ID(), 'article_categories');
				if ($terms && !is_wp_error($terms)) {
					$first_term = reset($terms);

					$related_args = array(
						'post_type' => 'articles',
						'posts_per_page' => 3,
						'post__not_in' => array(get_the_ID()),
						'tax_query' => array(
							array(
								'taxonomy' => 'article_categories',
								'field' => 'term_id',
								'terms' => $first_term->term_id,
							),
						),
					);

					$related_query = new WP_Query($related_args);

					if ($related_query->have_posts()) :
						while ($related_query->have_posts()) : $related_query->the_post();
				?>
							<div class="related-article mb-3">
								<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								<p><?php echo wp_trim_words(get_field('what'), 10, '...'); ?></p>
							</div>
				<?php
						endwhile;
						wp_reset_postdata();
					endif;
				}
				?>
			</div>
		</div>
	</div>
</div>
</main><!-- #main -->

<?php

get_footer();
