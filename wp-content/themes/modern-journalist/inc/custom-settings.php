<?php
/**
 * Custom settings page for the theme.
 *
 * @package Aerospace
 */

add_action('admin_menu', 'modern_journalist_add_options_page');
/**
 * Create an options page for the theme.
 */
function modern_journalist_add_options_page()
{
    add_options_page(
        'Modern Journalist Settings',
        'Modern Journalist Settings',
        'manage_options',
        'modern_journalist-options-page',
        'modern_journalist_display_options_page'
    );
}

/**
 * Displays the option page and creates the form.
 */
function modern_journalist_display_options_page()
{
    echo '<h1>Modern Journalist Settings</h1>';
    echo '<form method="post" action="options.php">';
    do_settings_sections('modern_journalist-options-page');
    settings_fields('modern_journalist_settings');
    submit_button();
    echo '</form>';
}

add_action('admin_init', 'modern_journalist_admin_init_section_footer');
/**
 * Creates the "Footer" settings section.
 */
function modern_journalist_admin_init_section_footer()
{
    add_settings_section(
        'modern_journalist_settings_section_footer',
        'Footer',
        'modern_journalist_display_section_footer_message',
        'modern_journalist-options-page'
    );

    add_settings_field(
        'modern_journalist_description',
        'Program Description',
        'modern_journalist_textarea_callback',
        'modern_journalist-options-page',
        'modern_journalist_settings_section_footer',
        array( 'modern_journalist_description' )
    );

    add_settings_field(
        'modern_journalist_footer_image',
        'Footer Image',
        'modern_journalist_text_callback',
        'modern_journalist-options-page',
        'modern_journalist_settings_section_footer',
        array( 'modern_journalist_footer_image' )
    );

    register_setting(
        'modern_journalist_settings',
        'modern_journalist_description',
        'wp_filter_post_kses'
    );
    register_setting(
        'modern_journalist_settings',
        'modern_journalist_footer_image',
        'sanitize_text_field'
    );
}

/**
 * Footer section description.
 */
function modern_journalist_display_section_footer_message()
{
    echo 'Information visible in the site\'s footer.';
}

add_action('admin_init', 'modern_journalist_admin_init_section_contact');
/**
 * Creates the "Contact" settings section.
 */
function modern_journalist_admin_init_section_contact()
{
    add_settings_section(
        'modern_journalist_settings_section_contact',
        'Contact Information',
        'modern_journalist_display_section_contact_message',
        'modern_journalist-options-page'
    );

    add_settings_field(
        'modern_journalist_email',
        'Email',
        'modern_journalist_text_callback',
        'modern_journalist-options-page',
        'modern_journalist_settings_section_contact',
        array( ' modern_journalist_email' )
    );

    add_settings_field(
        'modern_journalist_facebook',
        'Facebook',
        'modern_journalist_text_callback',
        'modern_journalist-options-page',
        'modern_journalist_settings_section_contact',
        array( ' modern_journalist_facebook' )
    );
    add_settings_field(
        'modern_journalist_twitter',
        'Twitter',
        'modern_journalist_text_callback',
        'modern_journalist-options-page',
        'modern_journalist_settings_section_contact',
        array( ' modern_journalist_twitter' )
    );
    add_settings_field(
        'modern_journalist_linkedin',
        'LinkedIn',
        'modern_journalist_text_callback',
        'modern_journalist-options-page',
        'modern_journalist_settings_section_contact',
        array( ' modern_journalist_linkedin' )
    );
    add_settings_field(
                'modern_journalist_youtube',
                'Youtube',
                'modern_journalist_text_callback',
                'modern_journalist-options-page',
                'modern_journalist_settings_section_contact',
                array( ' modern_journalist_youtube' )
        );
    add_settings_field(
                'modern_journalist_instagram',
                'Instagram',
                'modern_journalist_text_callback',
                'modern_journalist-options-page',
                'modern_journalist_settings_section_contact',
                array( ' modern_journalist_instagram' )
        );

    register_setting(
        'modern_journalist_settings',
        'modern_journalist_email',
        'sanitize_text_field'
    );

    register_setting(
        'modern_journalist_settings',
        'modern_journalist_facebook',
        'sanitize_text_field'
    );

    register_setting(
        'modern_journalist_settings',
        'modern_journalist_twitter',
        'sanitize_text_field'
    );

    register_setting(
        'modern_journalist_settings',
        'modern_journalist_linkedin',
        'sanitize_text_field'
    );

    register_setting(
        'modern_journalist_settings',
        'modern_journalist_youtube',
        'sanitize_text_field'
    );

    register_setting(
        'modern_journalist_settings',
        'modern_journalist_instagram',
        'sanitize_text_field'
    );
}

/**
 * Contact section description.
 */
function modern_journalist_display_section_contact_message()
{
    echo 'The contact information for the site, email and social media accounts.';
}

add_action('admin_init', 'modern_journalist_admin_init_section_homepage');
/**
 * Creates the "Homepage" settings section.
 */
function modern_journalist_admin_init_section_homepage()
{
    $post_types = array( 'post', 'testimonial' );
    $post_selection = array();
    foreach ($post_types as $type) {
        $post_selection[$type] = get_posts(
            array(
                'post_type'  => $type,
                'numberposts' => -1
            )
        );
    }

    add_settings_section(
        'modern_journalist_settings_section_homepage',
        'Homepage',
        'modern_journalist_display_section_homepage_message',
        'modern_journalist-options-page'
    );

		add_settings_field(
        'modern_journalist_homepage_hero',
        'Logo',
        'modern_journalist_text_callback',
        'modern_journalist-options-page',
        'modern_journalist_settings_section_homepage',
        array( 'modern_journalist_homepage_hero' )
    );

    add_settings_field(
        'modern_journalist_homepage_intro',
        'Introduction',
        'modern_journalist_textarea_callback',
        'modern_journalist-options-page',
        'modern_journalist_settings_section_homepage',
        array( 'modern_journalist_homepage_intro' )
    );

    add_settings_field(
        'modern_journalist_homepage_csis',
        'About CSIS',
        'modern_journalist_textarea_callback',
        'modern_journalist-options-page',
        'modern_journalist_settings_section_homepage',
        array( 'modern_journalist_homepage_csis' )
    );

    add_settings_field(
                'modern_journalist_homepage_featured_post_1',
                'Featured Post #1',
                'modern_journalist_posts_callback',
                'modern_journalist-options-page',
                'modern_journalist_settings_section_homepage',
                array( 'modern_journalist_homepage_featured_post_1', $post_selection['post'] )
        );
    add_settings_field(
                'modern_journalist_homepage_featured_post_2',
                'Featured Post #2',
                'modern_journalist_posts_callback',
                'modern_journalist-options-page',
                'modern_journalist_settings_section_homepage',
                array( 'modern_journalist_homepage_featured_post_2', $post_selection['post'] )
      );
      add_settings_field(
                  'modern_journalist_homepage_featured_post_3',
                  'Featured Post #3',
                  'modern_journalist_posts_callback',
                  'modern_journalist-options-page',
                  'modern_journalist_settings_section_homepage',
                  array( 'modern_journalist_homepage_featured_post_3', $post_selection['post'] )
          );
      add_settings_field(
          'modern_journalist_homepage_testimonialimg',
          'Testimonial Image',
          'modern_journalist_text_callback',
          'modern_journalist-options-page',
          'modern_journalist_settings_section_homepage',
          array( 'modern_journalist_homepage_testimonialimg' )
      );

      add_settings_field(
                  'modern_journalist_homepage_testimonal_1',
                  'Testimonial #1',
                  'modern_journalist_posts_callback',
                  'modern_journalist-options-page',
                  'modern_journalist_settings_section_homepage',
                  array( 'modern_journalist_homepage_testimonal_1', $post_selection['testimonial'] )
          );
      add_settings_field(
                  'modern_journalist_homepage_testimonal_2',
                  'Testimonial #2',
                  'modern_journalist_posts_callback',
                  'modern_journalist-options-page',
                  'modern_journalist_settings_section_homepage',
                  array( 'modern_journalist_homepage_testimonal_2', $post_selection['testimonial'] )
        );
        add_settings_field(
                    'modern_journalist_homepage_testimonal_3',
                    'Testimonial #3',
                    'modern_journalist_posts_callback',
                    'modern_journalist-options-page',
                    'modern_journalist_settings_section_homepage',
                    array( 'modern_journalist_homepage_testimonal_3', $post_selection['testimonial'] )
            );

		register_setting(
        'modern_journalist_settings',
        'modern_journalist_homepage_hero',
        'sanitize_text_field'
    );

    register_setting(
        'modern_journalist_settings',
        'modern_journalist_homepage_intro',
        'wp_filter_post_kses'
    );

    register_setting(
        'modern_journalist_settings',
        'modern_journalist_homepage_csis',
        'wp_filter_post_kses'
    );

    register_setting(
                'modern_journalist_settings',
                'modern_journalist_homepage_featured_post_1',
                'sanitize_text_field'
      );
    register_setting(
                'modern_journalist_settings',
                'modern_journalist_homepage_featured_post_2',
                'sanitize_text_field'
        );
    register_setting(
                'modern_journalist_settings',
                'modern_journalist_homepage_featured_post_3',
                'sanitize_text_field'
    );
    register_setting(
            'modern_journalist_settings',
            'modern_journalist_homepage_testimonialimg',
            'sanitize_text_field'
    );

    register_setting(
                'modern_journalist_settings',
                'modern_journalist_homepage_testimonal_1',
                'sanitize_text_field'
      );
    register_setting(
                'modern_journalist_settings',
                'modern_journalist_homepage_testimonal_2',
                'sanitize_text_field'
        );
    register_setting(
                'modern_journalist_settings',
                'modern_journalist_homepage_testimonal_3',
                'sanitize_text_field'
    );
}

/**
 * Contact section description.
 */
function modern_journalist_display_section_homepage_message()
{
    echo 'The featured posts shown on the home page.';
}

add_action('admin_init', 'modern_journalist_admin_init_section_archives');

/**
 * Archives section description.
 */
function modern_journalist_display_section_archives_message()
{
    echo 'Information visible in the site\'s archives.';
}

/**
 * Renders the text input fields.
 *
 * @param  Array $args Array of arguments passed by callback function.
 */
function modern_journalist_text_callback($args)
{
    $option = get_option($args[0]);
    echo '<input type="text" class="regular-text" id="' . esc_attr($args[0]) . '" name="' . esc_attr($args[0]) . '" value="' . esc_attr($option) . '" />';
}

/**
 * Renders the textareafields.
 *
 * @param  Array $args Array of arguments passed by callback function.
 */
function modern_journalist_textarea_callback($args)
{
    $option = get_option($args[0]);
    echo '<textarea class="regular-text" id="' . esc_attr($args[0]) . '" name="' . esc_attr($args[0]) . '" rows="5">' . esc_attr($option) . '</textarea>';
}

/**
 * Renders the post dropdown fields.
 *
 * @param  Array $args Array of arguments passed by callback function.
 */
function modern_journalist_posts_callback($args)
{
    $option = get_option($args[0]);
    echo '<select name="' . esc_attr($args[0]) . '" id="' . esc_attr($args[0]) . '" name="' . esc_attr($args[0]) . '">';
    foreach ($args[1] as $post) {
        if ($post->ID == esc_attr($option)) {
            $selected = "selected";
        } else {
            $selected = '';
        }

        echo '<option value="' . esc_attr($post->ID) . '" ' . $selected . '>' . esc_attr($post->post_title) . '</option>';
    }
    echo '</select>';
}
