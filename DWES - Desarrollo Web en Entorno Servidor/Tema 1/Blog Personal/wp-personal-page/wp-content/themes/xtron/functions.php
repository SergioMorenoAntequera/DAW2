<?php
/**
 * xtron functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package xtron
 */

if ( ! function_exists( 'xtron_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function xtron_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on xtron, use a find and replace
	 * to change 'xtron' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'xtron', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
    
    /*
     * Enable support for Post Thumbnails on posts and pages.
     */
    add_theme_support( 'post-thumbnails' );

    // Add menus.
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'xtron' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ) );

	
	
	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'xtron_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

}
endif; // xtron_setup

add_action( 'after_setup_theme', 'xtron_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function xtron_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'xtron_content_width', 640 );
}
add_action( 'after_setup_theme', 'xtron_content_width', 0 );


if ( ! function_exists( 'xtron_widgets_init' ) ) :

function xtron_widgets_init() {

    /*
     * Register widget areas.
     */
	 
    register_sidebar( array(
        'name' => __( 'Right Sidebar', 'xtron' ),
        'id' => 'right_sidebar',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ) );
	
    register_sidebar( array(
        'name' => __( 'Footer Widget 1', 'xtron' ),
        'id' => 'footer_widget_1',
        'before_widget' => '<li id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Widget 2', 'xtron' ),
        'id' => 'footer_widget_2',
        'before_widget' => '<li id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Widget 3', 'xtron' ),
        'id' => 'footer_widget_3',
        'before_widget' => '<li id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ) );

   
}
add_action( 'widgets_init', 'xtron_widgets_init' );
endif;// xtron_widgets_init

	 


if ( ! function_exists( 'xtron_enqueue_scripts' ) ) :
    function xtron_enqueue_scripts() {

     /* Js */

    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'xtron-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'xtron-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array('jquery'), '20151215', true );

     /* Css */

	wp_enqueue_style( 'xtron-style', get_stylesheet_uri() );

    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
	
	wp_enqueue_style( 'theme', get_template_directory_uri() . '/css/theme.css');
		
	wp_enqueue_style( 'themify-icons', get_template_directory_uri() . '/css/themify-icons/themify-icons.css');


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

    }
    add_action( 'wp_enqueue_scripts', 'xtron_enqueue_scripts' );
endif;


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/*
 * Resource files included by Bootstrap
 */
require get_template_directory() . '/inc/bootstrap/wp_bootstrap_navwalker.php';