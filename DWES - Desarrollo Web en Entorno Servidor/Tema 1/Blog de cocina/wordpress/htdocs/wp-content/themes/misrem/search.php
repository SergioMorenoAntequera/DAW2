<?php get_header(); ?>
	<section class="blog__posts" id="news">
		
		<div class="container">

		<?php if ( have_posts() ) : ?>
			<h1 class="page__title"><?php echo __( 'Search results for: ', 'misrem' ) . '"' . get_search_query() . '"'; ?></h1>
		<?php else : ?>
			<h1 class="page__title"><?php _e( 'Nothing Found', 'misrem' ); ?></h1>
		<?php endif; ?>

		</div>

		<div class="container container__archive">
			
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
