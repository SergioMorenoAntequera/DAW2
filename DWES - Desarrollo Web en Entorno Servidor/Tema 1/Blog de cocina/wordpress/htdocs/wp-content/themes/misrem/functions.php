<?php
/**
 * Misrem functions and definitions
 * @since 1.0
 */

/**
 * Misrem only works in WordPress 4.7 or later.
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

function misrem_setup() {
	/*
	* Make theme available for translation.
	* Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyseventeen
	* If you're building a theme based on Twenty Seventeen, use a find and replace
	* to change 'twentyseventeen' to the name of your theme in all the template files.
	*/
	load_theme_textdomain( 'misrem' );

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
	*
	*/
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'misrem_latest-posts',135,105,true );

	add_image_size( 'misrem_post-thumbnail',425,330,true );

	/**
	* Sets the content width in pixels, based on the theme's design and stylesheet.
	*
	* Priority 0 to make it available to lower priority callbacks.
	*
	* @global int $content_width
	*
	* @since Misrem 1.0
	*/
	function misrem_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'misrem_content_width', 880 );
	}
	add_action( 'after_setup_theme', 'misrem_content_width', 0 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Main Menu', 'misrem' ),
	) );

	/*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	* Enable support for Post Formats.
	*
	* See: https://codex.wordpress.org/Post_Formats
	*/
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	* Enable support for custom logo.
	*
	*/
	add_theme_support( 'custom-logo', array(
		'height'      => 75,
		'width'       => 145,
	) );

	/*
	* Enable support for custom header.
	*
	*/
	$header = array(
		'default-image'	=> get_template_directory_uri() . '/assets/images/bg-slider.jpg',
		'flex-width'	=> true,
		'flex-height'	=> true,
		'header-text'	=> false,
	);
	add_theme_support( 'custom-header', $header );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	* This theme styles the visual editor to resemble the theme style,
	* specifically font, colors, icons, and column width.
	*/
	add_editor_style( array( 'assets/css/editor-style.css', 'assets/genericons/genericons.css' ) );

		// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets' => array(
			// Place three core-defined widgets in the footer sidebar area.
			'sidebar-footer' => array(
				'text_business_info',
				'text_about',
			),

			'sidebar-category' => array(
				'categories',
			),

			'sidebar-date' => array(
				'archives',
			),
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-placeholder' => array(
				'post_title' => _x( 'Placeholder', 'Theme starter content', 'misrem' ),
				'file' => 'assets\images\placeholder.png',
				// URL relative to the template directory.
			),
		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array(
			'blog' => array(
				'thumbnail' => '{{image-placeholder}}',
			),
			'home' => array(
				'thumbnail' => '{{image-placeholder}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-placeholder}}',
			),
			'about' => array(
				'thumbnail' => '{{image-placeholder}}',
			),
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'primary' => array(
				'name' => __( 'Main Menu', 'misrem' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),
		),
	);

	/**
	 * Filters Misrem array of starter content.
	 *
	 * @since Misrem 1.0
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'misrem_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
}

add_action( 'after_setup_theme', 'misrem_setup' );

/**
*
* Registers a widget area.
* There are 4 types of widgets available
*
*/
function misrem_widgets_init() {
	register_sidebar( array(
		'name'	=> __( 'Sidebar footer', 'misrem' ),
		'id'	=> 'sidebar-footer',
		'description'	=> __( 'Add widgets here to appear in your footer sidebar.', 'misrem' ),
		'before_widget'	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h2 class="widget-title">',
		'after_title'	=> '</h2>',
	) );
	register_sidebar( array(
		'name'	=> __( 'Sidebar category archive', 'misrem' ),
		'id'	=> 'sidebar-category',
		'description'	=> __( 'Add widgets here to appear in your category sidebar.', 'misrem' ),
		'before_widget'	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h2 class="widget-title">',
		'after_title'	=> '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sidebar date archive', 'misrem' ),
		'id'            => 'sidebar-date',
		'description'   => __( 'Add widgets here to appear in your archive date sidebar.', 'misrem' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'	=> __( 'Sidebar tags', 'misrem' ),
		'id'	=> 'sidebar-tags',
		'description'	=> __( 'Add widgets here to appear in your tags archive.', 'misrem' ),
		'before_widget'	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h2 class="widget-title">',
		'after_title'	=> '</h2>',
	) );

}
add_action( 'widgets_init', 'misrem_widgets_init' );

/**
 * Enqueues scripts and styles.
 *
 */
function misrem_scripts() {
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/assets/genericons/genericons.css', array(), '3.2' );
	wp_enqueue_style( 'fontawesome',  get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.7' );
	wp_enqueue_style( 'misrem-style', get_template_directory_uri() . '/assets/css/main.css', array(), '1.1.0' );

	wp_enqueue_script( 'slick-slider', get_template_directory_uri() . '/assets/js/slick.min.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'misrem-script', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), '1.1.0', true );

	if ( get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'misrem_scripts' );

/**
 * Customizer and template-tagss additions.
 */
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/customizer.php';
