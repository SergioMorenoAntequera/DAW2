<article <?php post_class(); ?>>
	<header class="page__header">
		<div class="page__thumbnail-container" style="<?php if ( ! has_post_thumbnail() ) { echo 'height: 0'; } ?>">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php echo get_the_post_thumbnail() ?>
			<?php else : ?>
				<?php misrem_no_post_thumbnail(); ?>
			<?php endif; ?>
		</div>
		<?php the_title( '<h1 class="page__title">', '</h1>' ); ?>
	</header>
	<div class="page__content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'misrem' ),
			'after'  => '</div>',
		) );
		?>
	</div>
</article>
