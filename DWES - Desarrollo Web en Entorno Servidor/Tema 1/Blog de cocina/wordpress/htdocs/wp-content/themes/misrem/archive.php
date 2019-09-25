<?php get_header(); ?>

	<section class="blog__posts" id="news">
		<div class="container">
	
		<?php
			the_archive_title( '<h1 class="page__title">', '</h1>' );
			the_archive_description( '<div class="taxonomy-description">', '</div>' );
		?>

		</div>

		<div class="container container__archive">
			
			<?php get_sidebar(); ?>
			
			<div class="archive__posts">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content' );
			endwhile;
			?>   
			</div>
			
			<?php
			the_posts_pagination( array(
				'prev_text' => '<span class="previous"><</span><span class="screen-reader-text">' . __( 'Previous page', 'misrem' ) . '</span>',
				'next_text' => '<span class="previous">></span><span class="screen-reader-text">' . __( 'Next page', 'misrem' ) . '</span>',
				'before_page_number' => '<span class="meta-nav screen-reader-text">',
			));
			?>

		</div>

		<?php
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>
</section>

<?php get_footer(); ?>
