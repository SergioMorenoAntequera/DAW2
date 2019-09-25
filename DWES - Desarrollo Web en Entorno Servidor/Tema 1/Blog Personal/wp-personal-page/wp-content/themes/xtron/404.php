<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package xtron
 */

get_header();
?>


<div class="message text-center">	
<div class="container">
	  <div class="row">
	    <div class="col-md-12">
				    <br>
					<h1><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'xtron' ); ?></h1>
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'xtron' ); ?></p>
					<div class="home-btn">
					  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="home-turn"><?php esc_html_e( 'Home Back', 'xtron' ); ?></a>
					</div>
				   
		</div>
	</div>
</div>
</div>
<?php
get_footer();
