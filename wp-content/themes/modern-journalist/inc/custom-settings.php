<?php
/**
 * Custom settings page for the theme.
 *
 * @package Modern-Journalist
 */
add_action( 'admin_menu', 'modernjournalist_add_options_page' );
/**
 * Create an options page for the theme.
 */
function modernjournalist_add_options_page()
{

	add_options_page(
		'Modern Journalist Settings',
		'Modern Journalist Settings',
		'manage_options',
		'modernjournalist-options-page',
		'modernjournalist_display_options_page'
	);
}

/**
 * Displays the option page and creates the form.
 */
function modernjournalist_display_options_page()
{
	echo '<h1>Modern Journalist Theme Settings</h1>';
	echo '<form method="post" action="options.php" style="width: 80%;">';
	do_settings_sections( 'modernjournalist-options-page' );
	settings_fields( 'modernjournalist_settings' );
	submit_button();
	// print_r($_POST);
	// die();
	echo '</form>';
}

add_action( 'admin_init', 'modernjournalist_admin_init_section_homepage' );
/**
 * Creates the "Homepage" settings section.
 */
function modernjournalist_admin_init_section_homepage()
{
	$post_types     = array( 'post' );
	$post_selection = array();
	foreach ( $post_types as $type ) {
		$post_selection[$type] = get_posts(
			array(
				'post_type'   => $type,
				'numberposts' => -1,
			)
		);
	}

	add_settings_section(
		'modernjournalist_settings_section_homepage',
		'Homepage',
		'modernjournalist_display_section_homepage_message',
		'modernjournalist-options-page'
	);

	add_settings_field(
		'modernjournalist_video_mp4',
		'Url to Homepage Video MP4',
		'modernjournalist_text_callback',
		'modernjournalist-options-page',
		'modernjournalist_settings_section_homepage',
		array( 'modernjournalist_video_mp4' )
	);

/*	add_settings_field(
		'modernjournalist_video_webm',
		'Url to Homepage Video WebM',
		'modernjournalist_text_callback',
		'modernjournalist-options-page',
		'modernjournalist_settings_section_homepage',
		array( 'modernjournalist_video_webm' )
	);*/

	add_settings_field(
		'modernjournalist_program_description',
		'Practicum Description',
		'modernjournalist_texteditor_callback',
		'modernjournalist-options-page',
		'modernjournalist_settings_section_homepage',
		array( 'modernjournalist_program_description' )
	);

	add_settings_field(
		'modernjournalist_csis_description',
		'CSIS Description',
		'modernjournalist_texteditor_callback',
		'modernjournalist-options-page',
		'modernjournalist_settings_section_homepage',
		array( 'modernjournalist_csis_description' )
	);

	add_settings_field( 
		'modernjournalist_csis_image', 
		'CSIS Image',
		'modernjournalist_image_callback', 
		'modernjournalist-options-page', 
		'modernjournalist_settings_section_homepage',
		array( 'modernjournalist_csis_image', 'csis-img' ) 
	);

	add_settings_field(
		'modernjournalist_stories_description',
		'Stories Description',
		'modernjournalist_texteditor_callback',
		'modernjournalist-options-page',
		'modernjournalist_settings_section_homepage',
		array( 'modernjournalist_stories_description' )
	);

	add_settings_field(
		'modernjournalist_featured_story',
		'Featured Story',
		'modernjournalist_posts_callback',
		'modernjournalist-options-page',
		'modernjournalist_settings_section_homepage',
		array( 'modernjournalist_featured_story', $post_selection['post'] )
	);

	add_settings_field( 
		'modernjournalist_browse_image', 
		'Browse Stories Image',
		'modernjournalist_image_callback', 
		'modernjournalist-options-page', 
		'modernjournalist_settings_section_homepage',
		array( 'modernjournalist_browse_image', 'browse-img' ) 
	);

	register_setting(
		'modernjournalist_settings',
		'modernjournalist_video_mp4',
		'sanitize_text_field'
	);

/*	register_setting(
		'modernjournalist_settings',
		'modernjournalist_video_webm',
		'sanitize_text_field'
	);*/

	register_setting(
		'modernjournalist_settings',
		'modernjournalist_browse_image',
		'wp_filter_post_kses'
	);


	register_setting(
		'modernjournalist_settings',
		'modernjournalist_csis_image',
		'wp_filter_post_kses'
	);


	register_setting(
		'modernjournalist_settings',
		'modernjournalist_program_description',
		'wp_filter_post_kses'
	);

	register_setting(
		'modernjournalist_settings',
		'modernjournalist_csis_description',
		'wp_filter_post_kses'
	);


	register_setting(
		'modernjournalist_settings',
		'modernjournalist_featured_story',
		'sanitize_text_field'
	);

	register_setting(
		'modernjournalist_settings',
		'modernjournalist_stories_description',
		'wp_filter_post_kses'
	);

	register_setting(
		'modernjournalist_settings',
		'modernjournalist_featured_story',
		'sanitize_text_field'
	);

	
}


/**
 * Homepage section description.
 */
function modernjournalist_display_section_homepage_message()
{
	echo 'Information visible in the site\'s homepage.';
}


add_action( 'admin_init', 'modernjournalist_admin_init_section_homepage' );
/**
 * Creates the "Footer" settings section.
 */
function modernjournalist_admin_init_section_footer()
{

	add_settings_section(
		'modernjournalist_settings_section_footer',
		'Footer',
		'modernjournalist_display_section_footer_message',
		'modernjournalist-options-page'
	);

	add_settings_field(
		'modernjournalist_footer_description',
		'Description',
		'modernjournalist_texteditor_callback',
		'modernjournalist-options-page',
		'modernjournalist_settings_section_footer',
		array( 'modernjournalist_footer_description' )
	);

	register_setting(
		'modernjournalist_settings',
		'modernjournalist_footer_description',
		'wp_filter_post_kses'
	);

}

/**
 * Footer section description.
 */
function modernjournalist_display_section_footer_message()
{
	echo 'Information visible in the site\'s footer.';
}

add_action( 'admin_init', 'modernjournalist_admin_init_section_contact' );
/**
 * Creates the "Contact" settings section.
 */
function modernjournalist_admin_init_section_contact()
{

	add_settings_section(
		'modernjournalist_settings_section_contact',
		'Contact Information',
		'modernjournalist_display_section_contact_message',
		'modernjournalist-options-page'
	);

	add_settings_field(
		'modernjournalist_email',
		'Email',
		'modernjournalist_text_callback',
		'modernjournalist-options-page',
		'modernjournalist_settings_section_contact',
		array( 'modernjournalist_email' )
	);

	add_settings_field(
		'modernjournalist_facebook',
		'Facebook',
		'modernjournalist_text_callback',
		'modernjournalist-options-page',
		'modernjournalist_settings_section_contact',
		array( 'modernjournalist_facebook' )
	);

	add_settings_field(
		'modernjournalist_twitter',
		'Twitter',
		'modernjournalist_text_callback',
		'modernjournalist-options-page',
		'modernjournalist_settings_section_contact',
		array( 'modernjournalist_twitter' )
	);

	add_settings_field(
		'modernjournalist_linkedin',
		'LinkedIn',
		'modernjournalist_text_callback',
		'modernjournalist-options-page',
		'modernjournalist_settings_section_contact',
		array( 'modernjournalist_linkedin' )
	);

	add_settings_field(
		'modernjournalist_youtube',
		'Youtube',
		'modernjournalist_text_callback',
		'modernjournalist-options-page',
		'modernjournalist_settings_section_contact',
		array( 'modernjournalist_youtube' )
	);

	add_settings_field(
		'modernjournalist_instagram',
		'Instagram',
		'modernjournalist_text_callback',
		'modernjournalist-options-page',
		'modernjournalist_settings_section_contact',
		array( 'modernjournalist_instagram' )
	);
	register_setting(
		'modernjournalist_settings',
		'modernjournalist_facebook',
		'sanitize_text_field'
	);

	register_setting(
		'modernjournalist_settings',
		'modernjournalist_email',
		'sanitize_text_field'
	);

	register_setting(
		'modernjournalist_settings',
		'modernjournalist_twitter',
		'sanitize_text_field'
	);

	register_setting(
		'modernjournalist_settings',
		'modernjournalist_linkedin',
		'sanitize_text_field'
	);

	register_setting(
		'modernjournalist_settings',
		'modernjournalist_youtube',
		'sanitize_text_field'
	);

	register_setting(
		'modernjournalist_settings',
		'modernjournalist_instagram',
		'sanitize_text_field'
	);

}

/**
 * Contact section description.
 */
function modernjournalist_display_section_contact_message()
{
	echo 'The contact information for the site, email and social media accounts.';
}

/**
 * Renders the text input fields.
 *
 * @param  Array $args Array of arguments passed by callback function.
 */
function modernjournalist_text_callback( $args )
{
	$option = get_option( $args[0] );
	echo '<input type="text" class="regular-text" id="' . esc_attr( $args[0] ) . '" name="' . esc_attr( $args[0] ) . '" value="' . esc_attr( $option ) . '" />';
}

/**
 * Renders the textareafields.
 *
 * @param  Array $args Array of arguments passed by callback function.
 */
function modernjournalist_textarea_callback( $args )
{
	$option = get_option( $args[0] );
	echo '<textarea class="regular-text" id="' . esc_attr( $args[0] ) . '" name="' . esc_attr( $args[0] ) . '" rows="5">' . esc_attr( $option ) . '</textarea>';
}

/**
 * Renders the textareafields.
 *
 * @param  Array $args Array of arguments passed by callback function.
 */
function modernjournalist_texteditor_callback( $args )
{
	$option = get_option( $args[0] );
	$settings = array(
		'media_buttons' => false,
		'teeny'         => false,
		'wpautop'         => true,
		'tinymce' => false,
		'textarea_rows' => get_option( 'default_post_edit_rows', 7 )
	);
	
wp_editor(esc_textarea( __(get_option($args[0] ))), esc_attr( $args[0] ), $settings);

}

/**
 * Renders the post dropdown fields.
 *
 * @param  Array $args Array of arguments passed by callback function.
 */
function modernjournalist_posts_callback( $args )
{
	$option = get_option( $args[0] );
	echo '<select name="' . esc_attr( $args[0] ) . '" id="' . esc_attr( $args[0] ) . '" name="' . esc_attr( $args[0] ) . '">';
	foreach ( $args[1] as $post ) {
		if ( $post->ID == esc_attr( $option ) ) {
			$selected = "selected";
		} else {
			$selected = '';
		}

		echo '<option value="' . esc_attr( $post->ID ) . '" ' . $selected . '>' . esc_attr( $post->post_title ) . '</option>';
	}
	echo '</select>';
}


/**
 * Renders the file upload fields.
 *
 */
function modernjournalist_image_callback( $args ) { 
	global $defaults;
	$option = get_option( $args[0] );
	$name = $args[1];
	
	?>
	<div class="media_upload ">
	<input type='hidden' class="hidden-input" name='<?php echo esc_attr( $args[0] ); ?>' data-test="" value='<?php echo esc_attr( $option ); ?>' id='<?php echo esc_attr( $args[0] ); ?>'>

    <div class='image_container' data-id="<?php echo esc_attr( $args[0] ); ?>">
    	<?php
    		if( esc_attr( $option ) ) {
                    echo "<img src='".esc_attr( $option )."' style='width:200px;height:auto;cursor:pointer;' name='".esc_attr( $args[0] )."'  class='choose-meta-image-button' title='Change Image' /><br />";
                    echo '<input type="button" class="remove-meta-image-button button"  data-id="'.esc_attr( $args[0] ).'" value="Remove Image" />';
                }
        ?>
    </div>
    <div class='button_container' name='<?php echo esc_attr( $args[0] ); ?>' >
    	<input type="button" id="meta-image-button" name='<?php echo esc_attr( $args[0] ); ?>' class="button choose-meta-image-button" value="<?php _e( 'Choose or Upload an Image', 'text_domain' )?>" />
		<p class="description">If there is no featured image, this image will be used instead.</p>
</div>
</div>
	<?php

}
