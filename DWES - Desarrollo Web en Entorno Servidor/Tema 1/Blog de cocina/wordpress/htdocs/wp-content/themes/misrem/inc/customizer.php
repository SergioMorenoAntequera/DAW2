<?php
/*
* Contains methods for customizing the theme customization screen.
*
* Misrem incorporates code from Twenty Seventeen WordPress Theme (functions: misrem_blogname, misrem_blog_description), Copyright 2016 WordPress.org
* Twenty Seventeen is distributed under the terms of the GNU GPL
*
* @link http://codex.wordpress.org/Theme_Customization_API
* @since Misrem 1.0
*/
class Misrem_Customize {
	/**
	* This hooks into 'customize_register' ( available as of WP 3.4 ) and allows
	* you to add new sections and controls to the Theme Customize screen.
	*
	* Note: To enable instant preview, we have to actually write a bit of custom
	* javascript. See live_preview() for more.
	*
	* @see add_action( 'customize_register',$func )
	* @param \WP_Customize_Manager $wp_customize
	* @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	* @since Misrem 1.0
	*/
	public static function register( $wp_customize ) {
		$wp_customize->add_section( 'theme_options',
			array(
				'title'	=> __( 'Theme options', 'misrem' ), //Visible title of section
				'priority'	=> 35, //Determines what order this appears in
				'capability'	=> 'edit_theme_options', //Capability needed to tweak
				'description'	=> __( 'Allows you to customize the way of displaying site.', 'misrem' ), //Descriptive tooltip
			)
		);

		$wp_customize->add_setting( 'slider_category', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'	=> misrem_get_customiser_default( 'slider_category' ), //Default setting/value to save
				'type'	=> 'theme_mod', //Is this an 'option' or a 'theme_mod'?
				'capability'	=> 'edit_theme_options', //Optional. Special permissions for accessing this setting.
				'transport'	=> 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' ( instant )?
				'sanitize_callback'	=> 'sanitize_text_field',
			)
		);

		$wp_customize->add_control( //Instantiate the slider_category control class
			'slider_chose_category', //Set a unique ID for the control
			array(
				'label'	=> __( 'Choose category displaying in header slider', 'misrem' ), //Admin-visible name of the control
				'settings'	=> 'slider_category', //Which setting to load and manipulate ( serialized is okay )
				'priority'	=> 10, //Determines the order this control appears in for the specified section
				'section'	=> 'theme_options', //ID of the section this control should render in ( can be one of yours, or a WordPress default section )
				'type'	=> 'select',
				'description'	=> __( 'Choose category which will be displayed in slider. Admit that category with child category will also display posts from child category.', 'misrem' ),
				'choices'	=> misrem_return_categories_list( 'slider' ),
			)
		);

		$wp_customize->add_setting( 'footer_category', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'	=> misrem_get_customiser_default( 'footer_category' ), //Default setting/value to save
				'type'	=> 'theme_mod', //Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
				'transport'	=> 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' ( instant )?
				'sanitize_callback'	=> 'sanitize_text_field',
			)
		);

		$wp_customize->add_control( //Instantiate the footer_category control class
			'footer_chose_category', //Set a unique ID for the control
			array(
				'label'	=> __( 'Choose category displaying in footer', 'misrem' ), //Admin-visible name of the control
				'settings'	=> 'footer_category', //Which setting to load and manipulate ( serialized is okay )
				'priority'	=> 10, //Determines the order this control appears in for the specified section
				'section'	=> 'theme_options', //ID of the section this control should render in ( can be one of yours, or a WordPress default section )
				'type'	=> 'select',
				'description'	=> __( 'Choose category which will be displayed in top of the footer. Admit that category with child category will also display posts from child category.', 'misrem' ),
				'choices'	=> misrem_return_categories_list( 'footer' ),
			)
		);

		$wp_customize->add_setting( 'footer_number', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => misrem_get_customiser_default( 'footer_number' ), //Default setting/value to save
				'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' ( instant )?
				'sanitize_callback'  => 'absint',
			)
		);

		$wp_customize->add_control( //Instantiate thefooter_number control class
			'footer_posts_numbers', //Set a unique ID for the control
			array(
				'label'	=> __( 'Choose number of posts to display from each category', 'misrem' ), //Admin-visible name of the control
				'settings'	=> 'footer_number', //Which setting to load and manipulate ( serialized is okay )
				'priority'	=> 10, //Determines the order this control appears in for the specified section
				'section'	=> 'theme_options', //ID of the section this control should render in ( can be one of yours, or a WordPress default section )
				'type'	=> 'radio',
				'description'	=> __( 'Choose number of posts which will be displayed in footer for each category.', 'misrem' ),
				'choices'	=> array(
					1 => 1,
					2 => 2,
					3 => 3,
				),
			)
		);

		$wp_customize->add_setting( 'display_way', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'	=> misrem_get_customiser_default( 'display_way' ), //Default setting/value to save
				'type'	=> 'theme_mod', //Is this an 'option' or a 'theme_mod'?
				'capability'	=> 'edit_theme_options', //Optional. Special permissions for accessing this setting.
				'transport'	=> 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' ( instant )?
				'sanitize_callback'	=> 'sanitize_text_field',
			)
		);

		$wp_customize->add_control( //Instantiate the display_way control class
			'display_way_control', //Set a unique ID for the control
			array(
				'label'	=> __( 'Choose way of displaying posts on home, archives and search pages.', 'misrem' ), //Admin-visible name of the control
				'settings'	=> 'display_way', //Which setting to load and manipulate ( serialized is okay )
				'priority'	=> 10, //Determines the order this control appears in for the specified section
				'section'	=> 'theme_options', //ID of the section this control should render in ( can be one of yours, or a WordPress default section )
				'type'	=> 'radio',
				'description'	=> __( 'Choose number of posts which will be displayed in footer for each category.', 'misrem' ),
				'choices'	=> array(
					'grid'	=> 'grid',
					'list'	=> 'list',
				),
			)
		);

		$wp_customize->add_setting( 'default_img', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'type'	=> 'theme_mod', //Is this an 'option' or a 'theme_mod'?
				'capability'	=> 'edit_theme_options', //Optional. Special permissions for accessing this setting.
				'transport'	=> 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' ( instant )?
				'sanitize_callback'	=> 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'choose__img',
				array(
					'label'	=> __( 'Upload a default post thumbnail.', 'misrem' ), //Admin-visible name of the control
					'settings'	=> 'default_img', //Which setting to load and manipulate ( serialized is okay )
					'priority'	=> 10, //Determines the order this control appears in for the specified section
					'section'	=> 'theme_options', //ID of the section this control should render in ( can be one of yours, or a WordPress default section )
					'description'	=> __( 'Choose img for posts without post thumbnail. You have to publish after this change and refresh page.', 'misrem' ),
				)
			)
		);

		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		$wp_customize->get_setting( 'slider_category' )->transport = 'postMessage';
		$wp_customize->get_setting( 'footer_category' )->transport = 'postMessage';
		$wp_customize->get_setting( 'footer_number' )->transport = 'postMessage';
		$wp_customize->get_setting( 'display_way' )->transport = 'postMessage';

		$wp_customize->selective_refresh->add_partial(
			'blogname', array(
				'selector'	=> '.header__title a',
				'render_callback'	=> 'misrem_blogname',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'blogdescription', array(
				'selector'	=> '.header__subtitle',
				'render_callback'	=> 'misrem_blog_description',
			)
		);
	}

	/**
	* This outputs the javascript needed to automate the live settings preview.
	* Also keep in mind that this function isn't necessary unless your settings
	* are using 'transport'=>'postMessage' instead of the default 'transport'
	* => 'refresh'
	*
	* Used by hook: 'customize_preview_init'
	*
	* @see add_action( 'customize_preview_init',$func )
	* @since Misrem 1.0
	*/
	public static function live_preview() {
		wp_enqueue_script(
			'misrem-themecustomizer', // Give the script a unique ID
			get_template_directory_uri() . '/assets/js/theme-customizer.js', // Define the path to the JS file
			array( 'jquery', 'customize-preview' ), // Define dependencies
			'1.0',
			true
		);

		wp_localize_script( 'misrem-themecustomizer', 'ajaxresponse', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		) );
	}
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register', array( 'Misrem_Customize', 'register' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init', array( 'Misrem_Customize', 'live_preview' ) );

/**
* Return default option before first ussage of customizer.
*
* @since Misrem 1.0.4
*/
function misrem_get_customiser_default( $theme_mod ) {
	$defaults = array(
		'display_way' => 'grid',
		'footer_category' => 'latest_posts',
		'slider_category' => 'latest_posts',
		'footer_number' => 3,
	);

	return isset( $defaults[ $theme_mod ] ) ? $defaults[ $theme_mod ] : false;
}

/**
* Return categoris of posts to 'theme options' in customizer.
*
* @since Misrem 1.0
*/
function misrem_return_categories_list( $arg ) {
	//Adding current
	if ( 'slider' === $arg ) {
		$current = get_theme_mod( 'slider_category' );
	} elseif ( 'footer' === $arg ) {
		$current = get_theme_mod( 'footer_category' );
	}

	//Retrieve list of category objects.
	$categories = get_categories(
		array(
			'hide_empty' => 1,
		)
	);
	$categories_list = array();

	$sticky = get_option( 'sticky_posts' );

	if ( 'sticky_posts' === $current ) {
		if ( ! isset( $sticky[0] ) ) {
			$categories_list[ $current ] = __( 'Latest sticky posts (currently there are no sticky posts, so latests posts will display)', 'misrem' );
		} else {
			$categories_list[ $current ] = __( 'Latest sticky posts', 'misrem' );
		}
	}

	//Adding three additional options for latests and sticky posts.
	if ( ! array_search( 'Disable this option', $categories_list ) ) {
		$categories_list['disable'] = __( 'Disable this option', 'misrem' );
	}

	if ( isset( $sticky[0] ) ) {
		if ( ! array_search( 'Latest sticky posts', $categories_list ) ) {
			$categories_list['sticky_posts'] = __( 'Latest sticky posts', 'misrem' );
		}
	}

	if ( ! array_search( 'Latest posts from all categories', $categories_list ) ) {
		$categories_list['latest_posts'] = __( 'Latest posts from all categories', 'misrem' );
	}

	foreach ( $categories as $cat ) {
		if ( ! array_search( $cat->name, $categories_list ) ) {
			$categories_list[ $cat->slug ] = $cat->name;
		}
	}

	return $categories_list;
}

function misrem_blogname() {
	/**
	* Render the site title for the selective refresh partial.
	*
	* Misrem incorporates this code block from Twenty Seventeen WordPress Theme, Copyright 2016 WordPress.org
	* Twenty Seventeen is distributed under the terms of the GNU GPL
	*
	* @since Misrem 1.0
	*
	* @return void
	*/
	bloginfo( 'name' );
}

function misrem_blog_description() {
	/**
	* Render the site tagline for the selective refresh partial.
	*
	* Misrem incorporates this code block from Twenty Seventeen WordPress Theme, Copyright 2016 WordPress.org
	* Twenty Seventeen is distributed under the terms of the GNU GPL
	*
	* @since Misrem 1.0
	*
	* @return void
	*/
	bloginfo( 'description' );
}

/**
* Render the home slider after changes in customizer.
*
* @since Misrem 1.0
*
*/
function misrem_create_home_slider() {
	//checking if request was send by scripts.
	if ( isset( $_GET['cat_name'] ) ) {
		$cat_name = json_decode( stripslashes( $_GET['cat_name'] ), true );
	} else {
		$cat_name = get_theme_mod( 'slider_category' );
	}

	if ( 'disable' !== $cat_name ) {
		//rendering home slider using custom WP_Query
		$args = array(
			'post_type'	=> 'post',
			'posts_per_page'	=> 3,
			'paged'	=> 1,
			'post_status' => 'publish',
		);
		if ( 'latest_posts' !== $cat_name && 'sticky_posts' !== $cat_name ) {
			$args['category_name'] = $cat_name;
		} elseif ( 'sticky_posts' === $cat_name ) {
			$sticky = get_option( 'sticky_posts' );
			array_slice( $sticky, 0, 3 );
			$args['post__in'] = get_option( 'sticky_posts' );
			$args['ignore_sticky_posts'] = 1;
		}

		$ms_slider_query = new WP_Query( $args );

		if ( $ms_slider_query->have_posts() ) {
			while ( $ms_slider_query->have_posts() ) {
				$ms_slider_query->the_post();

				get_template_part( 'template-parts/content', 'slider' );
			}
			wp_reset_postdata();
		} else {
			echo '<p class="no-posts">' . __( 'No posts found with this option, choose different option or posts will not display in the slider. You can see this message only in customizer.', 'misrem' ) . '</p>';
		}
	} else {
		//this string is used by JS file,
		echo 'false';
	}

	wp_die();
}

/**
* Render the top footer after changes in customizer.
*
* @since Misrem 1.0
*
*/
function misrem_create_footer_top() {
	//checking if requests was send by scripts.
	if ( isset( $_GET['cat_footer_name'] ) ) {
		$cat_footer_name = json_decode( stripslashes( $_GET['cat_footer_name'] ), true );
	} else {
		$cat_footer_name = get_theme_mod( 'footer_category' );
	}

	if ( 'disable' !== $cat_footer_name ) {
		if ( isset( $_GET['cat_number'] ) ) {
			$cat_number = json_decode( stripslashes( $_GET['cat_number'] ), true );
		} else {
			$cat_number = get_theme_mod( 'footer_number' );
		}

		//rendering footer top posts using custom WP_Query
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => (int) $cat_number,
			'paged' => 1,
			'post_status' => 'publish',
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
			if ( 'latest_posts' === $cat_footer_name ) {
				echo '<h3 class="highlighted__main-title">' . __( 'Latest', 'misrem' ) . '</h3>';
			} else {
				echo '<h3 class="highlighted__main-title">' . __( 'Latest from', 'misrem' ) . ' <a href="' . esc_url( get_category_link( $category_obj->cat_ID ) ) . '" class="">' . esc_attr( $category_obj->name ) . '</a>' . '</h3>';
			}
			echo '<div class="highlighted__posts">';
			while ( $ms_footer_query->have_posts() ) {
				$ms_footer_query->the_post();

				get_template_part( 'template-parts/content', 'footer-top' );
			}
			echo '</div>';
			wp_reset_postdata();
		} elseif ( is_customize_preview() ) {
			echo '<p class="no-posts">' . __( 'No posts found with this option, choose different option or posts will not display in the top of the footer. You can see this message only in customizer.', 'misrem' ) . '</p>';
		}
	} else {
		//this string is used by JS file,
		echo 'false';
	}// End if().

	wp_die();
}

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function misrem_customize_preview_js() {
	wp_enqueue_script( 'misrem-themecustomizer', get_template_directory_uri() . '/assets/js/theme-customizer.js', array( 'jquery', 'customize-preview' ), '1.0', true );

	wp_localize_script( 'misrem-themecustomizer', 'ajaxresponse', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	) );
}
add_action( 'customize_preview_init', 'misrem_customize_preview_js' );

add_action( 'wp_ajax_nopriv_preview_slider', 'misrem_create_home_slider' );
add_action( 'wp_ajax_preview_slider', 'misrem_create_home_slider' );

add_action( 'wp_ajax_nopriv_preview_footer', 'misrem_create_footer_top' );
add_action( 'wp_ajax_preview_footer', 'misrem_create_footer_top' );
