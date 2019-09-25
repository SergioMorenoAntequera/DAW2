<?php get_header(); ?>

	<section class="blog__posts">
		<div class="container">
			<div class="index">
			<?php
			if ( have_posts() ) :

				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					* Include the Post-Format-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Format name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content', 'content' );

				endwhile;

				the_posts_pagination( array(
					'prev_text' => '<span class="screen-reader-text">' . __( 'Previous page', 'misrem' ) . '</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'misrem' ) . '</span>',
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'misrem' ) . ' </span>',
				) );

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>
		</div>
	</div>
</section>
<?php get_footer(); ?>
