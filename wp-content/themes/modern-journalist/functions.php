<?php
/**
 * Modern Journalist functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Modern_Journalist
 */

if ( ! function_exists( 'modern_journalist_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function modern_journalist_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Modern Journalist, use a find and replace
		 * to change 'modern-journalist' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'modern-journalist', get_template_directory() . '/languages' );

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
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'modern-journalist' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'modern_journalist_custom_background_args', array(
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
endif;
add_action( 'after_setup_theme', 'modern_journalist_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function modern_journalist_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'modern_journalist_content_width', 640 );
}
add_action( 'after_setup_theme', 'modern_journalist_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function modern_journalist_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'modern-journalist' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'modern-journalist' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'modern_journalist_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function modern_journalist_scripts() {
	wp_enqueue_style( 'modern-journalist-style', get_stylesheet_uri() );

	wp_enqueue_script( 'modern-journalist-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'modern-journalist-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Themes Archive Page
    if ( is_post_type_archive( 'themes' ) ) {
        wp_enqueue_script('modernjournalism-themes-archive');
    }

}
add_action( 'wp_enqueue_scripts', 'modern_journalist_scripts' );

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

/**
 * Register Custom Settings
 */
require get_template_directory() . '/inc/custom-settings.php';

/**
 * Register Custom Post Types
 */
//require get_template_directory() . '/inc/custom-post-types.php';

/**
 * Register Custom Post Meta Boxes for posts
 */
require get_template_directory() . '/inc/custom-post-meta.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Remove AddToAny Default CSS
 */
add_action( 'wp_enqueue_scripts', function() { wp_dequeue_style( 'addtoany' ); }, 21 );

/**
 * shortcodes
 */
require get_template_directory() . '/inc/shortcodes.php';


/**
 * Add featured gallery to a custom post type
 */
function add_featured_galleries_to_ctp( $post_types ) {
    array_push($post_types, 'themes'); // ($post_types comes in as array('post','page'). If you don't want FGs on those, you can just return a custom array instead of adding to it. )
    return $post_types;
}
add_filter('fg_post_types', 'add_featured_galleries_to_ctp' );

   
