<article <?php post_class(); ?> >
	<header class="single__header">
		<div class="single__thumbnail-container">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php echo get_the_post_thumbnail() ?>
			<?php else : ?>
				<?php misrem_no_post_thumbnail(); ?>
			<?php endif; ?>
		</div>
		<?php echo misrem_return_date_link(); ?>
		<?php the_title( '<h1 class="single__title">', '</h1>' ); ?>
		<a class="single__author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_the_author_meta( 'nickname' ); ?></a>
		<?php if ( has_category() ) : ?>
			<div class="post__categories">
			<?php
			if ( ! is_home() || ! is_category() ) :
				misrem_return_post_categories(); ?>
				<button class="post__more-cat"><span class="post__more-all"><?php echo __( 'show all categories', 'misrem' ); ?></span></button>
			<?php endif ; ?>
			</div>
		<?php endif ; ?>
		<?php if ( has_tag() ) : ?>
			<div class="post__tags">
				<?php echo get_the_tag_list( '<div class="post__tax"><p>' . __( 'Tags: ', 'misrem' ) . '</p>', '', '</div>' ); ?>
				<button class="post__more-cat"><span class="post__more-all"><?php echo __( 'show all tags', 'misrem' ); ?></span></button>
			</div>
		<?php endif ; ?>
	</header>
	<div class="single__content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'misrem' ),
			'after'  => '</div>',
		) );
		?>
	</div>
</article>
