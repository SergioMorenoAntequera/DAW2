<div class="highlighted__post">
	<div class="post__date-container">
		<h5 class="post__title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo wp_trim_words( get_the_title(), 5 ); ?></a></h5>
		<p class="post__date"><?php echo misrem_return_date_link();?></p>
	</div>
	<div class="post__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></div>
	<a href="<?php echo esc_url( get_permalink() ); ?>" class="btn" title="<?php the_title_attribute(); ?>"><?php echo __( 'read more', 'misrem' ) ?><span class="btn__arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
</div>		



