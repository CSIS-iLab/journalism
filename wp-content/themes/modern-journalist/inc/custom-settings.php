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
function modernjournalist_add_options_page() {

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
function modernjournalist_display_options_page() {
	echo '<h1>Modern Journalist Theme Settings</h1>';
	echo '<form method="post" action="options.php" style="width: 80%;">';
	do_settings_sections( 'modernjournalist-options-page' );
	settings_fields( 'modernjournalist_settings' );
	submit_button();
	echo '</form>';
}




add_action( 'admin_init', 'modernjournalist_admin_init_section_homepage' );
/**
 * Creates the "Homepage" settings section.
 */
function modernjournalist_admin_init_section_homepage() {

	add_settings_section(
		'modernjournalist_settings_section_homepage',
		'Homepage',
		'modernjournalist_display_section_homepage_message',
		'modernjournalist-options-page'
	);


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
		'modernjournalist_stories_description',
		'Stories Description',
		'modernjournalist_texteditor_callback',
		'modernjournalist-options-page',
		'modernjournalist_settings_section_homepage',
		array( 'modernjournalist_stories_description' )
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
		'modernjournalist_stories_description',
		'wp_filter_post_kses'
	);



}


add_action( 'admin_init', 'modernjournalist_admin_init_section_footer' );
/**
 * Creates the "Footer" settings section.
 */
function modernjournalist_admin_init_section_footer() {

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
function modernjournalist_display_section_footer_message() {
	echo 'Information visible in the site\'s footer.';
}

add_action( 'admin_init', 'modernjournalist_admin_init_section_contact' );
/**
 * Creates the "Contact" settings section.
 */
function modernjournalist_admin_init_section_contact() {

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
function modernjournalist_display_section_contact_message() {
	echo 'The contact information for the site, email and social media accounts.';
}



/**
 * Renders the text input fields.
 *
 * @param  Array $args Array of arguments passed by callback function.
 */
function modernjournalist_text_callback( $args ) {
	$option = get_option( $args[0] );
	echo '<input type="text" class="regular-text" id="' . esc_attr( $args[0] ) . '" name="' . esc_attr( $args[0] ) . '" value="' . esc_attr( $option ) . '" />';
}

/**
 * Renders the textareafields.
 *
 * @param  Array $args Array of arguments passed by callback function.
 */
function modernjournalist_textarea_callback( $args ) {
	$option = get_option( $args[0] );
	echo '<textarea class="regular-text" id="' . esc_attr( $args[0] ) . '" name="' . esc_attr( $args[0] ) . '" rows="5">' . esc_attr( $option ) . '</textarea>';
}


/**
 * Renders the textareafields.
 *
 * @param  Array $args Array of arguments passed by callback function.
 */
function modernjournalist_texteditor_callback( $args ) {
	$option = get_option( $args[0] );
	echo  wp_editor( esc_attr( $option ), esc_attr( $args[0] ), $settings = array( 
					'media_buttons' => false, 
					'teeny' => true, 
					'textarea_rows' => get_option('default_post_edit_rows', 7)
					)  );


}


/**
 * Renders the post dropdown fields.
 *
 * @param  Array $args Array of arguments passed by callback function.
 */
function modernjournalist_posts_callback( $args ) {
	$option = get_option( $args[0] );
	echo '<select name="' . esc_attr( $args[0] ) . '" id="' . esc_attr( $args[0] ) . '" name="' . esc_attr( $args[0] ) . '">';
	foreach( $args[1] as $post ) {
		if ( $post->ID == esc_attr( $option ) ) {
			$selected = "selected";
		} else {
			$selected = '';
		}

		echo '<option value="' . esc_attr( $post->ID ) . '" ' . $selected . '>' . esc_attr( $post->post_title ) . '</option>';
	}
	echo '</select>';
}



