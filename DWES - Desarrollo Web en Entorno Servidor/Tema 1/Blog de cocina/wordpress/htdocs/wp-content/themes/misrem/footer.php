	<footer class="footer">
			<section class="footer__highlighted">
				<div class="container">
					<?php
					$cat_footer_name = get_theme_mod( 'footer_category', misrem_get_customiser_default( 'footer_category' ) );

					if ( 'disable' !== $cat_footer_name ) {
						$cat_number = get_theme_mod( 'footer_number', misrem_get_customiser_default( 'footer_number' ) );
						$args = array(
								'post_type' => 'post',
								'posts_per_page' => (int) $cat_number,
								'paged' => 1,
								'ignore_sticky_posts' => 1,
						);

						if ( 'latest_posts' !== $cat_footer_name && 'sticky_posts' !== $cat_footer_name ) {
							$args['category_name'] = $cat_footer_name;
						} elseif ( 'sticky_posts' === $cat_footer_name ) {
							$sticky = get_option( 'sticky_posts' );
							array_slice( $sticky, 0, 3 );
							$args['post__in'] = get_option( 'sticky_posts' );
							$args['ignore_sticky_posts'] = 1;
						}

						$category_obj = get_category_by_slug( $cat_footer_name );

						$ms_footer_query = new WP_Query( $args );

						if ( $ms_footer_query->have_posts( $cat_footer_name ) ) {
							if ( 'latest_posts' === $cat_footer_name || 'sticky_posts' === $cat_footer_name ) {
								echo '<h3 class="highlighted__main-title">' . __( 'Latest', 'misrem' ) . '</h3>';
							} else {
								echo '<h3 class="highlighted__main-title">' . __( 'Latest from', 'misrem' ) . ' <a href="' . esc_url( get_category_link( $category_obj->cat_ID ) ) . '" class="">' . esc_html( $category_obj->name ) . '</a>' . '</h3>';
							}

								echo '<div class="highlighted__posts">';
							while ( $ms_footer_query->have_posts( ) ) {
								$ms_footer_query->the_post( );

								get_template_part( 'template-parts/content', 'footer-top' );

							}
								echo '</div>';
								wp_reset_postdata( );
						} else {
							if ( is_customize_preview() ) {
								echo '<p class="no-posts">' . __( 'No posts found with this option, choose different option or posts will not display in the top of the footer. You can see this message only in customizer.', 'misrem' ) . '</p>';
							}
						}
					}// End if().
					?>
				</div>
			</section>
			<section class="footer__contact">
				<div class="container">
					<?php get_sidebar( 'footer' ); ?>
				</div>   
			</section>
			<section class="footer__copyright container">
				<span>&#169; <?php echo esc_html( misrem_dynamic_copyright() ); ?> </span> 
				<span><?php  esc_html_e( 'Made by', 'misrem' ); ?> <a href="<?php echo esc_url( 'https://www.b4after.pl' ); ?>" title="Before after">BEFORE AFTER</a></span>
			</section>
	</footer>
		<?php wp_footer( ); ?>
</body>
</html>
