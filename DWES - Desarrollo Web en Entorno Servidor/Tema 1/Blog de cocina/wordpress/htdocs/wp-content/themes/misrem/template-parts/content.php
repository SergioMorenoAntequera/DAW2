<article <?php
$default_img = get_theme_mod( 'default_img' );
post_class(); ?>>
	<div class="post__img-container" <?php if ( ! has_post_thumbnail() && empty( $default_img ) ) { echo 'style="width: 0;"'; } ?>>
		<?php if ( has_post_thumbnail() || ! empty( $default_img ) ) : ?>
			<div class="arrow">
				<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php get_the_title(); ?>">
					<i class="fa fa-angle-right" aria-hidden="true"></i>
				</a>
			</div>
		<?php endif ; ?>
		<?php if ( is_sticky() && has_post_thumbnail() ) : ?>
			<p class="this_sticky">! </p>
		<?php endif ; ?>					
		<?php if ( has_post_thumbnail() ) : ?>
			<?php echo get_the_post_thumbnail( null, 'misrem_post-thumbnail' ); ?>
		<?php else : ?>
			<?php misrem_no_post_thumbnail(); ?>
		<?php endif ; ?>     
	</div>
	<div class="post__content">
		<?php echo misrem_return_date_link(); ?>
		<a class="single__author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_the_author_meta( 'nickname' ); ?></a>
		<?php if ( get_the_title() !== '' ) : ?>
			<h3 class="post__title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo wp_trim_words( get_the_title(), 10 ); ?></a></h3>
		<?php else : ?> 
			<h3 class="post__title"><a href="<?php echo esc_url( get_permalink() ); ?>"> <?php echo __( 'Post without title', 'misrem' ); ?> </a></h3>
		<?php endif ; ?> 
		<div class="post__categories">
			<?php
			if ( ! is_home() || ! is_category() ) :
				misrem_return_post_categories(); ?>
				<button class="post__more-cat"><span class="post__more-all"><?php echo __( 'show all categories', 'misrem' ); ?></span></button>
		</div>
			<?php endif ; ?>
			<?php if ( has_tag() ) : ?>
		<div class="post__tags">
			<?php echo get_the_tag_list( '<div class="post__tax"><p>' . __( 'Tags: ', 'misrem' ) . '</p>', '', '</div>' ); ?>
			<button class="post__more-cat"><span class="post__more-all"><?php echo __( 'show all tags', 'misrem' ); ?></span></button>
		</div>
			<?php endif ; ?>
		<div class="post__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></div>
	</div>
</article>
