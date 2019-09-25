<?php
/**
* The sidebar containing the footer widget area
*
*/

if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
	<div class="contact">

		<?php dynamic_sidebar( 'sidebar-footer' ); ?>

	</div>    
<?php endif; ?>
