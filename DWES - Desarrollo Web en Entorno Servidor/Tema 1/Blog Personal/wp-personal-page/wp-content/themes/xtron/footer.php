<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package xtron
 */

?> 


	<footer id="colophon" class="footer-widget">
	<?php get_template_part('inc/footer','widget'); ?>
		<div class="container copy text-center">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'xtron' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'xtron' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'xtron' ), 'xtron', '<a href="https://www.atlasresponsivetasarim.com/"> Atlas</a>' );
				?>
		</div><!-- .site-info -->
	
	</footer><!-- #colophon -->
	</div> 
        <?php wp_footer(); ?>
    </body>
</html>
