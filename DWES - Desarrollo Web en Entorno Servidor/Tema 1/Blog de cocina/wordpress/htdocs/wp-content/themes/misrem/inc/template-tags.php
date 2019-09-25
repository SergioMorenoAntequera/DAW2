<?php

/**
* Return date link to posts.
*
* @since Misrem 1.0
*/
function misrem_return_date_link() {
	$archive_year  = get_the_time( 'Y' );
	$archive_month = get_the_time( 'm' );
	$archive_day   = get_the_time( 'd' );
	get_day_link( $archive_year, $archive_month, $archive_day );

	return '<a class="post__date" href="' . esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ) . '">' . get_the_date() . '</a>';
}

/**
* Echo categories for single post.
*
* @since Misrem 1.0
*/
function misrem_return_post_categories() {

	//Retrieve post categories.
	$category_obj = get_the_category();

	//Displayling categories of single post.
	echo '<ul class="post__categories-list">';
	echo '<li><p>Categories: </p></li>';
	foreach ( $category_obj as $cat ) {
		echo '<li><a href="' . esc_url( get_category_link( $cat->cat_ID ) ) . '" class="post__category">' . esc_html( $cat->name ) . '</a></li>';
	}
	echo '</ul>';
}

/**
* Return display mode class.
*
* Checking display mode ( grid/list ).
* @since Misrem 1.0
*/
function misrem_check_display_mode() {
	return get_theme_mod( 'display_way', misrem_get_customiser_default( 'display_way' ) );
}

/**
* Return date link to posts.
*
* Checking display mode ( grid/list ).
* @since Misrem 1.0.2
*/
function misrem_check_additional_classes() {
	$classes = array();

	if ( 'disable' === get_theme_mod( 'slider_category' ) && is_home() || ! have_posts() && is_home() ) {
		$classes[] = esc_attr( 'no-slider' );
	}

	$classes[] = misrem_check_display_mode();

	return $classes;
}

/**
* Return date link to posts.
*
* Function rendering default img which can be add in customizer when there is no thumbnail for post.
* @since Misrem 1.0
*/
function misrem_no_post_thumbnail() {
	// This is getting the image / url
	$feature = get_theme_mod( 'default_img' );

	// This is getting the post id
	$feature_id = attachment_url_to_postid( $feature );

	echo wp_get_attachment_image( $feature_id, 'misrem_post-thumbnail' );
}

/**
* Return title when no post title.
*
* @since Misrem 1.0.2
*/
function misrem_no_title() {
	$title = get_the_title();

	if ( empty( $title ) ) {
		return __( 'Post without title.', 'misrem' );
	} else {
		return $title;
	}
}

/**
* Return date link to posts.
*
* Displaying 6 latests posts in single post page.
* @since Misrem 1.0
*/
function misrem_latest_thumbnail() {
	$read_also_args = array(
		'post_type' => 'post',
		'posts_per_page' => 6,
		'paged' => 1,
		'post__not_in' => array( get_the_ID() ),
	 );

	$read_also = new WP_Query( $read_also_args );

	if ( $read_also->have_posts() ) {
		echo '<h3 class="latest__main-title">' . __( 'Read also', 'misrem' ) . '</h3>';
		echo '<div class="single__latest-container">';
		while ( $read_also->have_posts() ) : $read_also->the_post();
			if ( has_post_thumbnail() ) {
				echo '<a href="' . esc_url( get_permalink() ) . '" class="single__latest">';
						echo '<span class="latest__thumbnail-container">';
							echo get_the_post_thumbnail( get_the_ID(), 'misrem_latest-posts' );
						echo '</span>';
						echo '<span class="latest__title" title="' . get_the_title() . '">';
							echo wp_trim_words( get_the_title(), 7 );
						echo '</span>';
				echo '</a>';
			} else {
				echo '<a href="' . esc_url( get_permalink() ) . '" class="single__latest no-thumbnail">';
					echo '<p class="latest__title latest__title--no-thumbnail" title="' . get_the_title() . '">';
						echo wp_trim_words( misrem_no_title(), 7 );
					echo '</p>';
				echo '</a>';
			}
		endwhile;
		echo '</div>';
		wp_reset_postdata();
	}
}

/**
* Return date link to posts.
*
* Custom template for comment form.
* @since Misrem 1.0
*/
function misrem_comment_fields( $fields ) {

	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$label     = $req ? '*' : ' ' . __( '( optional )', 'misrem' );
	$aria_req  = $req ? "aria-required='true'" : '';

	$fields['author'] =
		'<p class="comment-form-author">
			<label for="author">' . __( 'Name', 'misrem' ) . $label . '</label>
			<input id="author" name="author" type="text" placeholder="' . esc_attr__( 'Jane Doe,', 'misrem' ) . '" value="' . esc_attr( $commenter['comment_author'] ) .
		'" size="30" ' . $aria_req . ' />
                        <p class="error-author">' . __( 'This field can&#39;t be empty ', 'misrem' ) . '</p>' .
		'</p>';

	$fields['email'] =
		'<p class="comment-form-email">
			<label for="email">' . __( 'Email', 'misrem' ) . $label . '</label>
			<input id="email" name="email" type="email" placeholder="' . esc_attr__( 'name@email.com', 'misrem' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) .
		'" size="30" ' . $aria_req . ' />
			<p class="error-mail">' . __( 'You have to write correct email here, ex. name@email.com', 'misrem' ) . '</p>' .
		'</p>';

	$fields['url'] =
		'<p class="comment-form-url">
			<label for="url">' . __( 'Website', 'misrem' ) . '</label>
			<input id="url" name="url" type="url"  placeholder="' . esc_url( 'http://wordpress.com' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) .
		'" size="30" />
			</p>';

	return $fields;
}
add_filter( 'comment_form_default_fields', 'misrem_comment_fields' );

/**
* Return date link to posts.
*
* This functions return dynamic copyright year depends of current year and site start ( taking oldest post as start ).
* @since Misrem 1.0
*/
function misrem_dynamic_copyright() {
	return date_i18n( __( 'Y', 'misrem' ) );
}

/**
* Return date link to posts.
*
* Adding class to rest of defaults body classes.
* @since Misrem 1.0
*/
function misrem_my_class_names( $classes ) {
	$classes[] = 'full-container';
	return $classes;
}

add_filter( 'body_class','misrem_my_class_names' );


/**
*Add to the blog page post in specified queue divided into categories with sticky posts first.
*
* Param is category name.
* Function returns list of posts IDs with sticky posts first.
* @since Misrem 1.0
*/
function misrem_get_posts( $cat_name ) {

	$queue = array();

	$ms_args = array(
			'post_type' => 'post',
			'category_name' => $cat_name,
	 );

	$ms_query = new WP_Query( $ms_args );

	while ( $ms_query->have_posts() ) : $ms_query->the_post();
		if ( is_sticky() ) {
			$queue[] = get_the_ID();
		}
	endwhile;

	while ( $ms_query->have_posts() ) : $ms_query->the_post();
		if ( ! is_sticky() ) {
			$queue[] = get_the_ID();
		}
	endwhile;

	return( $queue );
}

/**
* Custom breadcrumbs
*
* Function echo page breadcrumbs
* @since Misrem 1.1.0
*/
// Breadcrumbs
function custom_breadcrumbs() {

	// Settings
	$separator = '<i class="fa fa-chevron-right" aria-hidden="true"></i>';
	$breadcrums_id = 'breadcrumbs';
	$breadcrums_class = 'breadcrumbs';
	$home_title = __( 'Homepage', 'misrem' );

	// If you have any custom post types with custom taxonomies, put the taxonomy name below ( e.g. product_cat )
	$custom_taxonomy = 'product_cat';

	// Get the query & post information
	global $post,$wp_query;

	// Do not display on the homepage
	if ( ! is_front_page() ) {

		// Build the breadcrums
		echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';

		// Home page
		echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
		echo '<li class="separator separator-home"> ' . $separator . ' </li>';

		if ( is_archive() && ! is_tax() && ! is_category() && ! is_tag() && ! is_author() ) {

			echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title( '', false ) . '</strong></li>';

		} else if ( is_archive() && is_tax() && ! is_category() && ! is_tag() ) {

			// If post is a custom post type
			$post_type = get_post_type();

			// If it is a custom post type display name and link
			if ( 'post' != $post_type ) {

				$post_type_object = get_post_type_object( $post_type );
				$post_type_archive = get_post_type_archive_link( $post_type );

				echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
				echo '<li class="separator"> ' . $separator . ' </li>';
			}

			$custom_tax_name = get_queried_object()->name;
			echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';

		} else if ( is_single() ) {

			// If post is a custom post type
			$post_type = get_post_type();

			// If it is a custom post type display name and link
			if ( 'post' != $post_type ) {

				$post_type_object = get_post_type_object( $post_type );
				$post_type_archive = get_post_type_archive_link( $post_type );

				echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
				echo '<li class="separator"> ' . $separator . ' </li>';

			}

			// Get post category info
			$category = get_the_category();

			if ( ! empty( $category ) ) {

				// Get last category post is in
				$last_category = $category[count($category) - 1];

				// Get parent any categories and create array
				$get_cat_parents = rtrim( get_category_parents( $last_category->term_id, true, ',' ),',' );
				$cat_parents = explode( ',',$get_cat_parents );

				// Loop through parent categories and store in variable $cat_display
				$cat_display = '';
				foreach( $cat_parents as $parents ) {
					$cat_display .= '<li class="item-cat">'.$parents.'</li>';
					$cat_display .= '<li class="separator"> ' . $separator . ' </li>';
				}

			}

			// If it's a custom post type within a custom taxonomy
			$taxonomy_exists = taxonomy_exists( $custom_taxonomy );
			if ( empty( $last_category ) && ! empty( $custom_taxonomy ) && $taxonomy_exists ) {

				$taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
				$cat_id = $taxonomy_terms[0]->term_id;
				$cat_nicename = $taxonomy_terms[0]->slug;
				$cat_link = get_term_link( $taxonomy_terms[0]->term_id, $custom_taxonomy );
				$cat_name = $taxonomy_terms[0]->name;

			}

			// Check if the post is in a category
			if ( ! empty( $last_category ) ) {
				echo $cat_display;
				echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

			// Else if post is in a custom taxonomy
			} else if ( ! empty( $cat_id ) ) {

				echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
				echo '<li class="separator"> ' . $separator . ' </li>';
				echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

			} else {
				echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
            }

        } else if ( is_category() ) {

			// Category page
			echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title( '', false ) . '</strong></li>';

		} else if ( is_page() ) {

			// Standard page
			if ( $post->post_parent ){

				// If child page, get parents 
				$anc = get_post_ancestors( $post->ID );

				// Get parents in the right order
				$anc = array_reverse( $anc );

				// Parent page loop
				if ( ! isset( $parents ) ) $parents = null;
				foreach ( $anc as $ancestor ) {
					$parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink( $ancestor ) . '" title="' . get_the_title( $ancestor ) . '">' . get_the_title( $ancestor ) . '</a></li>';
					$parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
				}

				// Display parent pages
				echo $parents;

				// Current page
				echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';

			} else {

				// Just display current page if not parents
				echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';

			}

		} else if ( is_tag() ) {

			// Tag page

			// Get tag information
			$term_id = get_query_var( 'tag_id' );
			$taxonomy = 'post_tag';
			$args = 'include=' . $term_id;
			$terms = get_terms( $taxonomy, $args );
			$get_term_id = $terms[0]->term_id;
			$get_term_slug = $terms[0]->slug;
			$get_term_name = $terms[0]->name;

			// Display the tag name
			echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';

		} elseif ( is_day() ) {

			// Day archive

			// Year link
			echo '<li class="item-year item-year-' . get_the_time( 'Y' ) . '"><a class="bread-year bread-year-' . get_the_time( 'Y' ) . '" href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( 'Y' ) . '">' . get_the_time( 'Y' ) . ' Archives</a></li>';
			echo '<li class="separator separator-' . get_the_time( 'Y' ) . '"> ' . $separator . ' </li>';

			// Month link
			echo '<li class="item-month item-month-' . get_the_time( 'm' ) . '"><a class="bread-month bread-month-' . get_the_time( 'm' ) . '" href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '" title="' . get_the_time( 'M' ) . '">' . get_the_time( 'M' ) . ' Archives</a></li>';
			echo '<li class="separator separator-' . get_the_time( 'm' ) . '"> ' . $separator . ' </li>';

			// Day display
			echo '<li class="item-current item-' . get_the_time( 'j' ) . '"><strong class="bread-current bread-' . get_the_time( 'j' ) . '"> ' . get_the_time( 'jS' ) . ' ' . get_the_time( 'M' ) . ' Archives</strong></li>';

		} else if ( is_month() ) {

			// Month Archive

			// Year link
			echo '<li class="item-year item-year-' . get_the_time( 'Y' ) . '"><a class="bread-year bread-year-' . get_the_time( 'Y' ) . '" href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( 'Y' ) . '">' . get_the_time( 'Y' ) . ' Archives</a></li>';
			echo '<li class="separator separator-' . get_the_time( 'Y' ) . '"> ' . $separator . ' </li>';

			// Month display
			echo '<li class="item-month item-month-' . get_the_time( 'm' ) . '"><strong class="bread-month bread-month-' . get_the_time( 'm' ) . '" title="' . get_the_time( 'M' ) . '">' . get_the_time( 'M' ) . ' Archives</strong></li>';

		} else if ( is_year() ) {

			// Display year archive
			echo '<li class="item-current item-current-' . get_the_time( 'Y' ) . '"><strong class="bread-current bread-current-' . get_the_time( 'Y' ) . '" title="' . get_the_time( 'Y' ) . '">' . get_the_time( 'Y' ) . ' Archives</strong></li>';

		} else if ( is_author() ) {

			// Auhor archive

			// Get the author information
			global $author;
			$userdata = get_userdata( $author );

			// Display author name
			echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';

		} else if ( get_query_var( 'paged' ) ) {

			// Paginated archives
			echo '<li class="item-current item-current-' . get_query_var( 'paged' ) . '"><strong class="bread-current bread-current-' . get_query_var( 'paged' ) . '" title="Page ' . get_query_var( 'paged' ) . '">'.__( 'Page', 'misrem' ) . ' ' . get_query_var( 'paged' ) . '</strong></li>';

		} else if ( is_search() ) {

			// Search results page
			echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';

		} elseif ( is_404() ) {

			// 404 page
			echo '<li>' . 'Error 404' . '</li>';
		}

		echo '</ul>';

	}   
}
