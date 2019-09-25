<?php
/**
* The sidebar containing the left widgets
*
*/

if ( is_category() ) {

	if ( is_active_sidebar( 'sidebar-category' ) ) {
		echo '<div class="archive__sidebar">';
		dynamic_sidebar( 'sidebar-category' );
		echo '</div>';
	}
}

if ( is_archive() && ! is_category() && ! is_tag() ) {

	if ( is_active_sidebar( 'sidebar-date' ) ) {
		echo '<div class="archive__sidebar">';
		dynamic_sidebar( 'sidebar-date' );
		echo '</div>';
	}
}

if ( is_tag() ) {

	if ( is_active_sidebar( 'sidebar-tags' ) ) {
		echo '<div class="archive__sidebar">';
		dynamic_sidebar( 'sidebar-tags' );
		echo '</div>';
	}
}
