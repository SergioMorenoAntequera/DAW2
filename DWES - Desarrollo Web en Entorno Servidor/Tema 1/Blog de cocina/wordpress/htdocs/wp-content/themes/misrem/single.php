<?php get_header(); ?>

	<main class="single__post" role="main">
		
		<div class="container">
			
			<div class="single__article">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'single' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
			</div>
			<div class="single__sidebar">
				<?php
				misrem_latest_thumbnail();
				?>
			</div>
		</div>
	</main>

<?php get_footer();
