<?php
/**
 * Template part for displaying posts
 *
 * @package minimal-portfolio
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('grid-item'); ?>>
	<div class="post-inner-wrapper">
		
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail(); ?>
				</a>
			</div>
		<?php endif; ?>
		<div class="post-body-wrapper <?php if($minimal_portfolio_blog_post_align == 'left') { echo 'text-left'; } elseif($minimal_portfolio_blog_post_align == 'center') { echo 'text-center'; } else { echo 'text-right';} ?>">
			<header class="entry-header">
				<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			</header>
			<ul class="post-meta">
					<li class="post-author list-inline-item">
						<?php minimal_portfolio_post_author(); ?>
					</li>
					<li class="post-categories list-inline-item">
						<?php minimal_portfolio_post_categories(); ?>
					</li>
				<?php endif; ?>	
					<li class="post-comment list-inline-item">
						<i class="fa fa-comment-o" aria-hidden="true"></i>
						<?php minimal_portfolio_post_comment();?>
					</li>
			</ul>
			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div><!-- .entry-content -->
		</div>
	</div>
</article>