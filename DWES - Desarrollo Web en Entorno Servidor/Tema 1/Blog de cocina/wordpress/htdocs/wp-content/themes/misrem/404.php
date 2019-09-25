<?php   get_header();   ?>

<section class="container none">
	<h2>
		404
	</h2>
	<p> <?php esc_html_e( 'Sorry, we can&#39;t find that page!', 'misrem' ) ?> </p>
	<a href="<?php get_home_url();?>" class="btn">
		<?php esc_html_e( 'HOME PAGE', 'misrem' ) ?>
	</a>
</section>

<?php get_footer(); ?>
