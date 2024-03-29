<?php
/**
 * Modern Journalist functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Modern_Journalist
 */

if (! function_exists('modern_journalist_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function modern_journalist_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Modern Journalist, use a find and replace
         * to change 'modern-journalist' to the name of your theme in all the template files.
         */
        load_theme_textdomain('modern-journalist', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Primary', 'modern-journalist'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('modern_journalist_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ));
    }
endif;
add_action('after_setup_theme', 'modern_journalist_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function modern_journalist_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('modern_journalist_content_width', 640);
}
add_action('after_setup_theme', 'modern_journalist_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function modern_journalist_widgets_init()
{
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'modern-journalist'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'modern-journalist'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'modern_journalist_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function modern_journalist_scripts()
{
    wp_enqueue_style('modern-journalist-style', get_template_directory_uri() . '/style.min.css');

    wp_enqueue_script('modern-journalist-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true);

    wp_enqueue_script('modern-journalist-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

    //wp_enqueue_script('modern-journalist-ie-object-fill-fix', get_template_directory_uri() . '/js/ie-object-fill-fix.js', array(), '20151215', true);

    wp_enqueue_script('modern-journalist-settings-options', get_template_directory_uri() . '/js/options.js', array(), '20151215', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    if (is_singular()) {
      wp_enqueue_script('modern-journalist-anime', get_template_directory_uri() . '/js/anime-master/lib/anime.min.js', array(), '20151215', true);

      wp_enqueue_script('modern-journalist-post-animation', get_template_directory_uri() . '/js/post-animation.js', array(), '20151215', true);

    }

    if(is_front_page()){ //Check if we are viewing a page

    	   wp_enqueue_script('carousel1', get_template_directory_uri() .'/js/carousel/carousel.js');
         wp_enqueue_script('carouselItem', get_template_directory_uri() .'/js/carousel/carouselItem.js');
         wp_enqueue_script('carouselButtons', get_template_directory_uri() .'/js/carousel/carouselButtons.js');
         wp_enqueue_script('carouselPause', get_template_directory_uri() .'/js/carousel/pauseButton.js');
    	}


}
add_action('wp_enqueue_scripts', 'modern_journalist_scripts');

add_action( 'admin_enqueue_scripts', 'meta_box_scripts' );
function meta_box_scripts() {

    global $post;

    wp_enqueue_media( array(
        'post' => $post->ID,
    ) );

}

/**
 * Enqueue scripts for custom settings.
 */
function modern_journalist_settings_scripts()
{
 wp_enqueue_script( 'modern-journalist-settings', get_template_directory_uri() . '/js/options.js', array( 'jquery' ), '20151215', true );
}
add_action( 'admin_enqueue_scripts', 'modern_journalist_settings_scripts' );

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
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Register Custom Post Types
 */
require get_template_directory() . '/inc/custom-post-types.php';

/**
 * Wide Alignment.
 */
add_theme_support('align-wide');

/**
 * Disable custom font sizes.
 */
add_theme_support('disable-custom-font-sizes');

/**
 * Add editor styles.
 */
add_theme_support('editor-styles');

/**
 * Register Custom Settings
 */
require get_template_directory() . '/inc/custom-settings.php';

function jourblocks_register_post_meta()
{
    register_meta('post', 'jourblocks_meta_authors', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
    ));
    register_meta('post', 'jourblocks_meta_date', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
    ));
    register_meta('post', 'jourblocks_meta_intro', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
    ));
    register_meta('post', 'jourblocks_meta_header-color', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
    ));
	register_meta('post', 'jourblocks_meta_color', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
    ));
    register_meta('post', 'jourblocks_meta_media', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
    ));
    register_meta('post', 'jourblocks_meta_header', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
    ));
}
add_action('init', 'jourblocks_register_post_meta');

function jourblocks_register_testimonial_meta()
{
    register_meta('post', 'jourblocks_meta_testimonial_name', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',

    ));
    register_meta('post', 'jourblocks_meta_testimonial_institution', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',

    ));
    register_meta('post', 'jourblocks_meta_testimonial_date', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',

    ));
}
add_action('init', 'jourblocks_register_testimonial_meta');

function jourblocks_register_template()
{
    $post_type_object = get_post_type_object('post');
    $post_type_object->template = array(
        array( 'jourblocks/meta-block' ),
    );
}
add_action('init', 'jourblocks_register_template');
