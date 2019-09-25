<?php get_header(); ?>

<section class="baner">     
	<div class="baner__slider">
	<?php

	$cat_name = get_theme_mod( 'slider_category', misrem_get_customiser_default( 'slider_category' ) );

	if ( 'disable' !== $cat_name ) {
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 3,
			'paged' => 1,
			'ignore_sticky_posts' => 1,
		);

		if ( 'latest_posts' !== $cat_name && 'sticky_posts' !== $cat_name ) {
			$args['category_name'] = $cat_name;
		} elseif ( 'sticky_posts' === $cat_name ) {
			$sticky = get_option( 'sticky_posts' );
			array_slice( $sticky, 0, 3 );
			$args['post__in'] = get_option( 'sticky_posts' );
		}

		$ms_slider_query = new WP_Query( $args );
		if ( $ms_slider_query->have_posts() ) {
			while ( $ms_slider_query->have_posts() ) {
				$ms_slider_query->the_post();

				get_template_part( 'template-parts/content', 'slider' );
			}
			wp_reset_postdata();
		}
	}
	?>
	</div>
</section>
<section class="blog__posts" style="background: #fff">
	<div class="container">
		<?php
		$categories = get_categories();

		foreach ( $categories as $cat ) {
			$args_news = array(
				'post__in' => misrem_get_posts( $cat->slug ),
				'orderby' => 'post__in',
				'order' => 'ASC',
				'ignore_sticky_posts' => 1,
			);

			echo '<div class="blog__category">';
			echo '<h3 class="category__title">' . '<a href="' . esc_url( get_category_link( $cat->cat_ID ) ) . '">' . esc_html( $cat->name ) . '<span class="category__all">' . __( 'see all posts', 'misrem' ) . '</span>' . '<span class="category__right-arrow">' . '<i class="fa fa-chevron-right" aria-hidden="true"></i>' . '</span>' . '</a>' . '</h3>';
			echo '<div class="category__posts">';

			$ms_news_query = new WP_Query( $args_news );

			if ( $ms_news_query->have_posts() ) {
				echo '<div class="category__slider">';
				while ( $ms_news_query->have_posts() ) : $ms_news_query->the_post();
					get_template_part( 'template-parts/content' );
				endwhile;
				echo '</div>';
				echo '<div class="category__archive-link"><a class="btn" href="' . esc_url( get_category_link( $cat->cat_ID ) ) . '" title="' . esc_attr__( 'Show all posts from ', 'misrem' ) . esc_html( $cat->name ) . ' category">' . __( 'see all posts', 'misrem' ) . '</a></div>';
			} else {
				get_template_part( 'template-parts/content', 'none' );
			}

			echo '</div>';
			echo '</div>';
			wp_reset_postdata();
		}
		?>
	</div>
</section>

<?php get_footer(); ?>
