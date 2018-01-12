<?php
/**
 * Modern Journalist functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Modern_Journalist
 */
if (!function_exists('modern_journalist_setup')):
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
    wp_enqueue_style('modern-journalist-style', get_stylesheet_uri());

    wp_enqueue_script('modern-journalist-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true);

    wp_enqueue_script('modern-journalist-testimonials', get_template_directory_uri() . '/js/testimonials.js', array('jquery'), '20151215', true);

    wp_enqueue_script('modern-journalist-audiovideo', get_template_directory_uri() . '/js/audio-video-player.js', array('jquery'), '20151215', true);

    wp_enqueue_script('modern-journalist-fluidscriptcdn', 'http:///cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js', array('jquery'), '20151215', true);

    wp_enqueue_script('modern-journalist-picturefill', get_template_directory_uri() . '/js/picturefill.min.js#asyncload', array('jquery'), '20151215', true);

    wp_enqueue_script('modern-journalist-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    // Themes Archive Page
    if (is_post_type_archive('themes')) {
        wp_enqueue_script('modernjournalism-themes-archive');
    }

}

add_action('wp_enqueue_scripts', 'modern_journalist_scripts');

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
require get_template_directory() . '/inc/custom-post-types.php';

/**
 * Register Custom Post Meta Boxes for posts
 */
require get_template_directory() . '/inc/custom-post-meta.php';
/**
 * Register Custom Post Types
 */
require get_template_directory() . '/inc/custom-taxonomies.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

// Async load
function ikreativ_async_scripts($url)
{
    if (strpos($url, '#asyncload') === false) {
        return $url;
    } else if (is_admin()) {
        return str_replace('#asyncload', '', $url);
    } else {
        return str_replace('#asyncload', '', $url) . "' async='async";
    }

}

add_filter('clean_url', 'ikreativ_async_scripts', 11, 1);

/**
 * Remove AddToAny Default CSS
 */
add_action('wp_enqueue_scripts', function () {wp_dequeue_style('addtoany');}, 21);

/**
 * shortcodes
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Add featured gallery to a custom post type
 */
function add_featured_galleries_to_ctp($post_types)
{
    array_push($post_types, 'themes'); // ($post_types comes in as array('post','page'). If you don't want FGs on those, you can just return a custom array instead of adding to it. )
    return $post_types;
}

add_filter('fg_post_types', 'add_featured_galleries_to_ctp');

/**
 * Change "posts" to "stories in admin nav
 */
function revcon_change_post_label()
{
    global $menu;
    global $submenu;
    $menu[5][0]                 = 'Stories';
    $submenu['edit.php'][5][0]  = 'Stories';
    $submenu['edit.php'][10][0] = 'Add Story';
}

function revcon_change_post_object()
{
    global $wp_post_types;
    $labels                     = &$wp_post_types['post']->labels;
    $labels->name               = 'Stories';
    $labels->singular_name      = 'Story';
    $labels->add_new            = 'Add Story';
    $labels->add_new_item       = 'Add Story';
    $labels->edit_item          = 'Edit Story';
    $labels->new_item           = 'Story';
    $labels->view_item          = 'View Story';
    $labels->search_items       = 'Search Stories';
    $labels->not_found          = 'No Story found';
    $labels->not_found_in_trash = 'No Story found in Trash';
    $labels->all_items          = 'All Stories';
    $labels->menu_name          = 'Stories';
    $labels->name_admin_bar     = 'Stories';
}

add_action('admin_menu', 'revcon_change_post_label');
add_action('init', 'revcon_change_post_object');

/**
 * Add separators to organize admin nav
 */
add_action('admin_init', 'add_admin_menu_separator');

function add_admin_menu_separator($position)
{

    global $menu;

    $menu[$position] = array(
        0 => '',
        1 => 'read',
        2 => 'separator' . $position,
        3 => '',
        4 => 'wp-menu-separator',
    );

}

add_action('admin_menu', 'set_admin_menu_separator');
function set_admin_menu_separator()
{
    do_action('admin_init', 9);
    do_action('admin_init', 39);
}
// end set_admin_menu_separator

// retrieves the attachment ID from the file URL
function pippin_get_image_id($attachment_url = '')
{
    global $wpdb;
    $attachment_id = false;

    // If there is no url, return.
    if ('' == $attachment_url) {
        return;
    }

    // Get the upload directory paths
    $upload_dir_paths = wp_upload_dir();

    // Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
    if (false !== strpos($attachment_url, $upload_dir_paths['baseurl'])) {

        // If this is the URL of an auto-generated thumbnail, get the URL of the original image
        $attachment_url = preg_replace('/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url);

        // Remove the upload path base directory from the attachment URL
        $attachment_url = str_replace($upload_dir_paths['baseurl'] . '/', '', $attachment_url);

        // Finally, run a custom database query to get the attachment ID from the modified attachment URL
        $attachment_id = $wpdb->get_var($wpdb->prepare("SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url));

    }

    return $attachment_id;
}

/**
 * Get an attachment ID given a URL.
 *
 * @param string $url
 *
 * @return int Attachment ID on success, 0 on failure
 */
function get_attachment_id($url)
{
    $attachment_id = 0;
    $dir           = wp_upload_dir();
    if (false !== strpos($url, $dir['baseurl'] . '/')) {
        // Is URL in uploads directory?
        $file       = basename($url);
        $query_args = array(
            'post_type'   => 'attachment',
            'post_status' => 'inherit',
            'fields'      => 'ids',
            'meta_query'  => array(
                array(
                    'value'   => $file,
                    'compare' => 'LIKE',
                    'key'     => '_wp_attachment_metadata',
                ),
            ),
        );
        $query = new WP_Query($query_args);
        if ($query->have_posts()) {
            foreach ($query->posts as $post_id) {
                $meta                = wp_get_attachment_metadata($post_id);
                $original_file       = basename($meta['file']);
                $cropped_image_files = wp_list_pluck($meta['sizes'], 'file');
                if ($original_file === $file || in_array($file, $cropped_image_files)) {
                    $attachment_id = $post_id;
                    break;
                }
            }
        }
    }
    return $attachment_id;
}

vc_map(array(
    "name"     => __("Blockquote"),
    "base"     => "blockquote",
    "category" => __('Content'),
    "icon"     => get_template_directory_uri() . "/img/vc_extend/blockquote.svg",
    "params"   => array(
        array(
            "type"        => "textfield",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("Content"),
            "param_name"  => "quotecontent",
            "value"       => __(""),
            "description" => __(""),
        ),
        array(
            "type"        => "checkbox",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("Full Width"),
            "param_name"  => "fullwidth",
            'value'       => " ",
            "description" => __(""),
        ),
        array(
            "type"        => "dropdown",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("Blockquote Style"),
            "param_name"  => "style",
            'value'       => array(
                __('Lines')     => 'lines',
                __('Quotes')    => 'quotes',
                __('Highlight') => 'highlighted',
            ),
            'save_always' => true,
            "description" => __(""),
        ),
        array(
            "type"        => "colorpicker",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("Accent Color"),
            "param_name"  => "accent",
            "value"       => __(""),
            "description" => __(""),
            'dependency'  => array(
                'element' => 'style',
                'value'   => array('lines', 'quotes'),
            ),
        ),
        array(
            "type"        => "dropdown",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("Highlight Color"),
            "param_name"  => "highlightcolor",
            'value'       => array(
                __('Yellow')     => 'yellow-highlight',
                __('Black')      => 'black-highlight',
                __('Light Gray') => 'light-highlight',
                __('Blue')       => 'blue-highlight',

            ),
            "save_always" => true,
            "description" => __(""),
            'dependency'  => array(
                'element' => 'style',
                'value'   => array('highlighted'),

            ),
        ),

    ),
));

vc_map(array(
    "name"     => __("Character Detail"),
    "base"     => "character",
    "category" => __('Content'),
    "icon"     => get_template_directory_uri() . "/img/vc_extend/character.svg",
    "params"   => array(
        array(
            "type"        => "textfield",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("Name"),
            "param_name"  => "name",
            "value"       => __("Name"),
            "description" => __(""),
        ),
        array(
            "type"        => "textfield",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("Description"),
            "param_name"  => "description",
            "value"       => __(""),
            "description" => __(""),
        ),
        array(
            "type"        => "attach_image",
            "class"       => "",
            "heading"     => __("Image"),
            "param_name"  => "image",
            "value"       => __(""),
            "description" => __(""),
        ),
        array(
            "type"        => "checkbox",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("Include source info"),
            "param_name"  => "includesource",
            'value'       => " ",
            "description" => __(""),

        ),
        array(
            "type"        => "textfield",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("Source Description"),
            "param_name"  => "sourcedesc",
            "value"       => __(""),
            "description" => __(""),
            'dependency'  => array(
                'element' => 'includesource',
                'value'   => array('true'),

            ),
        ),
        array(
            "type"        => "textfield",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("URL"),
            "param_name"  => "sourceurl",
            "value"       => __(""),
            "description" => __("Optional"),
            'dependency'  => array(
                'element' => 'includesource',
                'value'   => array('true'),

            ),
        ),
    ),
));

vc_map(array(
    "name"        => __("Image Group"),
    "base"        => "img-group",
    "category"    => __('Content'),
    "description" => __("Choose 2 - 3 images."),
    "icon"        => get_template_directory_uri() . "/img/vc_extend/image-group.svg",
    "params"      => array(
        array(
            "type"        => "checkbox",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("Full Width"),
            "param_name"  => "fullwidth",
            'value'       => " ",
            "description" => __(""),
        ),
        array(
            "type"        => "attach_images",
            "class"       => "",
            "heading"     => __("Images"),
            "param_name"  => "images",
            "value"       => "",
            "description" => __(""),
        ),

    ),
));

vc_map(array(
    "name"     => __("Single Image"),
    "base"     => "singleimg",
    "category" => __('Content'),
    "icon"     => get_template_directory_uri() . "/img/vc_extend/singleimage.svg",
    "params"   => array(
        array(
            "type"        => "checkbox",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("Full Width"),
            "param_name"  => "fullwidth",
            'value'       => " ",
            "description" => __(""),
        ),
        array(
            "type"        => "attach_image",
            "class"       => "",
            "heading"     => __("Image"),
            "param_name"  => "image",
            "value"       => "",
            "description" => __(""),
        ),
        array(
            "type"        => "checkbox",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("Include source info"),
            "param_name"  => "includesource",
            'value'       => " ",
            "description" => __(""),

        ),
        array(
            "type"        => "textfield",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("Source Description"),
            "param_name"  => "sourcedesc",
            "value"       => __(""),
            "description" => __(""),
            'dependency'  => array(
                'element' => 'includesource',
                'value'   => array('true'),

            ),
        ),
        array(
            "type"        => "textfield",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("URL"),
            "param_name"  => "sourceurl",
            "value"       => __(""),
            "description" => __("Optional"),
            'dependency'  => array(
                'element' => 'includesource',
                'value'   => array('true'),

            ),
        ),
    ),
));

vc_map(array(
    "name"     => __("Post Header"),
    "base"     => "header",
    "category" => __('Content'),
    "icon"     => get_template_directory_uri() . "/img/vc_extend/post-header.svg",
    "params"   => array(
        array(
            "type"        => "textfield",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("Intro"),
            "param_name"  => "intro",
            "value"       => __(""),
            "description" => __(""),
        ),
     
        array(
            "type"        => "dropdown",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("Header Style"),
            "param_name"  => "style",
            'value'       => array(
                __('Blocks')     => 'block',
                __('Full Width') => 'full',
            ),
            'save_always' => true,
            "description" => __(""),
        ),
        array(
            "type"        => "colorpicker",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("Highlight Color"),
            "param_name"  => "highlight",
            "value"       => __(""),
            "description" => __(""),
        ),
        array(
            "type"        => "checkbox",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("Include source info"),
            "param_name"  => "includesource",
            'value'       => " ",
            "description" => __(""),

        ),
        array(
            "type"        => "textfield",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("Source Description"),
            "param_name"  => "sourcedesc",
            "value"       => __(""),
            "description" => __(""),
            'dependency'  => array(
                'element' => 'includesource',
                'value'   => array('true'),

            ),
        ),
        array(
            "type"        => "textfield",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("URL"),
            "param_name"  => "sourceurl",
            "value"       => __(""),
            "description" => __(""),
            'dependency'  => array(
                'element' => 'includesource',
                'value'   => array('true'),

            ),
        ),
    ),
));

vc_map(array(
    "name"     => __("Dialog"),
    "base"     => "dialog",
    "category" => __('Content'),
    "icon"     => get_template_directory_uri() . "/img/vc_extend/dialog.svg",
    "params"   => array(
        array(
            "type"        => "textarea_html",
            "class"       => "",
            "heading"     => __("Content"),
            "param_name"  => "content",
            "value"       => __(""),
            "description" => __(""),
        ),
        array(
            "type"        => "checkbox",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("Include source info"),
            "param_name"  => "includesource",
            'value'       => " ",
            "description" => __(""),

        ),
        array(
            "type"        => "textfield",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("Source Description"),
            "param_name"  => "sourcedesc",
            "value"       => __(""),
            "description" => __(""),
            'dependency'  => array(
                'element' => 'includesource',
                'value'   => array('true'),

            ),
        ),
        array(
            "type"        => "textfield",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("URL"),
            "param_name"  => "sourceurl",
            "value"       => __(""),
            "description" => __("Optional"),
            'dependency'  => array(
                'element' => 'includesource',
                'value'   => array('true'),

            ),
        ),
    ),
));

vc_map(array(
    "name"     => __("Text Over Image"),
    "base"     => "textimg",
    "category" => __('Content'),
    "icon"     => get_template_directory_uri() . "/img/vc_extend/text-image.svg",
    "params"   => array(
        array(
            "type"        => "textarea_html",
            "class"       => "",
            "heading"     => __("Content"),
            "param_name"  => "content",
            "value"       => __(""),
            "description" => __(""),
        ),

        array(
            "type"        => "attach_image",
            "class"       => "",
            "heading"     => __("Image"),
            "param_name"  => "image",
            "value"       => __(""),
            "description" => __(""),
        ),
        array(
            "type"        => "colorpicker",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("Background Color"),
            "param_name"  => "backgroundcolor",
            "value"       => __(""),
            "description" => __(""),
        ),
         array(
            "type"        => "checkbox",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("Photo credit has white text"),
            "param_name"  => "lightcredit",
            'value'       => " ",
            "description" => __(""),

        ),
        array(
            "type"        => "checkbox",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("Include source info"),
            "param_name"  => "includesource",
            'value'       => " ",
            "description" => __(""),

        ),
        array(
            "type"        => "textfield",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("Source Description"),
            "param_name"  => "sourcedesc",
            "value"       => __(""),
            "description" => __(""),
            'dependency'  => array(
                'element' => 'includesource',
                'value'   => array('true'),

            ),
        ),
        array(
            "type"        => "textfield",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("URL"),
            "param_name"  => "sourceurl",
            "value"       => __(""),
            "description" => __("Optional"),
            'dependency'  => array(
                'element' => 'includesource',
                'value'   => array('true'),

            ),
        ),
    ),
));

vc_map(array(
    "name"     => __("Audio"),
    "base"     => "audiowidget",
    "category" => __('Content'),
    "icon"     => get_template_directory_uri() . "/img/vc_extend/audio.svg",
    "params"   => array(
        array(
            "type"        => "textfield",
            "class"       => "",
            "heading"     => __("Title"),
            "param_name"  => "title",
            "value"       => __(""),
            "description" => __(""),
        ),
        array(
            "type"        => "textfield",
            "class"       => "",
            "heading"     => __("Description"),
            "param_name"  => "title",
            "value"       => __(""),
            "description" => __("Optional"),
        ),
        array(
            "type"        => "textfield",
            "class"       => "",
            "heading"     => __("URL"),
            "param_name"  => "url",
            "value"       => __(""),
            "description" => __(""),
        ),
        array(
            "type"        => "checkbox",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("Include source info"),
            "param_name"  => "includesource",
            'value'       => " ",
            "description" => __(""),

        ),
        array(
            "type"        => "textfield",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("Source Description"),
            "param_name"  => "sourcedesc",
            "value"       => __(""),
            "description" => __(""),
            'dependency'  => array(
                'element' => 'includesource',
                'value'   => array('true'),

            ),
        ),
        array(
            "type"        => "textfield",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __("URL"),
            "param_name"  => "sourceurl",
            "value"       => __(""),
            "description" => __("Optional"),
            'dependency'  => array(
                'element' => 'includesource',
                'value'   => array('true'),

            ),
        ),
    ),
));

$attributes = array(
    'type'        => 'textfield',
    'heading'     => "Section Title",
    'param_name'  => 'title',

    'value'       => '',
    'description' => "",
);
vc_add_param('vc_section', $attributes); // Note: 'vc_message' was used as a base for "Message box" element

$attributes = array(
    "type"        => "checkbox",
    "holder"      => "div",
    "class"       => "",
    "heading"     => __("Full Width"),
    "param_name"  => "fullwidth",
    'value'       => " ",
    "description" => __(""),
);
vc_add_param('vc_raw_html', $attributes); // Note: 'vc_message' was used as a base for "Message box" element

$settings = array(
    'show_settings_on_create' => 'true',
);
vc_map_update('vc_section', $settings); // Note: 'vc_message' was used as a base for "Message box" element

vc_remove_param("vc_message", "el_class");
vc_remove_param("vc_section", "full_width");
vc_remove_param("vc_section", "full_height");
vc_remove_param("vc_section", "columns_placement");
vc_remove_param("vc_section", "content_placement");
vc_remove_param("vc_section", "parallax");
vc_remove_param("vc_section", "parallax_image");
vc_remove_param("vc_section", "css");
vc_remove_param("vc_section", "el_id");
vc_remove_param("vc_section", "video_bg");
vc_remove_param("vc_section", "video_bg_url");
vc_remove_param("vc_section", "video_bg_parallax");
vc_remove_param("vc_section", "parallax_speed_bg");
vc_remove_param("vc_section", "parallax_speed_video");
vc_remove_param("vc_section", "css_animation");
vc_remove_param("vc_section", "el_class");
\

vc_remove_param("vc_row", "full_width");
vc_remove_param("vc_row", "full_height");
vc_remove_param("vc_row", "columns_placement");
vc_remove_param("vc_row", "content_placement");
vc_remove_param("vc_row", "parallax");
vc_remove_param("vc_row", "parallax_image");
vc_remove_param("vc_row", "css");
vc_remove_param("vc_row", "el_id");
vc_remove_param("vc_row", "video_bg");
vc_remove_param("vc_row", "video_bg_url");
vc_remove_param("vc_row", "video_bg_parallax");
vc_remove_param("vc_row", "parallax_speed_bg");
vc_remove_param("vc_row", "parallax_speed_video");
vc_remove_param("vc_row", "css_animation");
vc_remove_param("vc_row", "el_class");

vc_remove_param("vc_column_text", "el_class");
vc_remove_param("vc_column_text", "css");
vc_remove_param("vc_column_text", "css_animation");
vc_remove_param("vc_column_text", "el_id");

vc_remove_param("vc_empty_space", "el_class");
vc_remove_param("vc_empty_space", "el_id");

vc_remove_param("vc_video", "el_class");
vc_remove_param("vc_column_text", "css");
vc_remove_param("vc_video", "css_animation");
vc_remove_param("vc_video", "el_id");
