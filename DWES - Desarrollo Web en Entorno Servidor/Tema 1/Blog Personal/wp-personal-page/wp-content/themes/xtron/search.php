<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package xtron
 */

get_header();
?>

<div class="content-post">
<div class="container">
   <div class="row">
       <div class="col-md-8">
	   
	          <h2>
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'xtron' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h2>

		<?php if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

       </div>
	   <?php get_sidebar(); ?>
   </div>
</div>
</div>

<?php
get_footer();