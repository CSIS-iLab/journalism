<?php
/**
 * Custom Post Types: Themes
 *
 * @package Modern-Journalist
 */

/**
 * Register custom post type
 */
function modernjournalist_cpt_themes() {

	$labels = array(
		'name'                  => _x( 'Themes', 'Post Type General Name', 'modern-journalist' ),
		'singular_name'         => _x( 'Theme', 'Post Type Singular Name', 'modern-journalist' ),
		'menu_name'             => __( 'Themes', 'modern-journalist' ),
		'name_admin_bar'        => __( 'Themes', 'modern-journalist' ),
		'archives'              => __( 'Themes Archives', 'modern-journalist' ),
		'attributes'            => __( 'Themes Attributes', 'modern-journalist' ),
		'parent_item_colon'     => __( 'Parent Theme', 'modern-journalist' ),
		'all_items'             => __( 'All Themes', 'modern-journalist' ),
		'add_new_item'          => __( 'Add New Theme', 'modern-journalist' ),
		'add_new'               => __( 'Add Theme', 'modern-journalist' ),
		'new_item'              => __( 'New Theme', 'modern-journalist' ),
		'edit_item'             => __( 'Edit Theme', 'modern-journalist' ),
		'update_item'           => __( 'Update Theme', 'modern-journalist' ),
		'view_item'             => __( 'View Theme', 'modern-journalist' ),
		'view_items'            => __( 'View Themes', 'modern-journalist' ),
		'search_items'          => __( 'Search Theme', 'modern-journalist' ),
		'not_found'             => __( 'Not found', 'modern-journalist' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'modern-journalist' ),
		'featured_image'        => __( 'Featured Image', 'modern-journalist' ),
		'set_featured_image'    => __( 'Set featured image', 'modern-journalist' ),
		'remove_featured_image' => __( 'Remove featured image', 'modern-journalist' ),
		'use_featured_image'    => __( 'Use as featured image', 'modern-journalist' ),
		'insert_into_item'      => __( 'Insert into Theme', 'modern-journalist' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Theme', 'modern-journalist' ),
		'items_list'            => __( 'Themes list', 'modern-journalist' ),
		'items_list_navigation' => __( 'Themes list navigation', 'modern-journalist' ),
		'filter_items_list'     => __( 'Filter Themes list', 'modern-journalist' ),
	);
	$args = array(
		'label'                 => __( 'Theme', 'modern-journalist' ),
		'description'           => __( 'Themes', 'modern-journalist' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'taxonomies'            => array( ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-category',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'themes', $args );

}
add_action( 'init', 'modernjournalist_cpt_themes', 0 );

/*----------  Custom Meta Fields  ----------*/
/**
 * Add meta box
 *
 * @param post $post The post object.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function themes_add_meta_boxes( $post ) {
	add_meta_box( 'themes_meta_box', __( 'Theme Information', 'modern-journalist' ), 'themes_build_meta_box', 'themes', 'normal', 'high' );
	add_meta_box( 'featured_meta_box', __( 'Featured', 'modern-journalist' ), 'featured_build_meta_box', 'themes', 'side', 'high' );

}
add_action( 'add_meta_boxes_themes', 'themes_add_meta_boxes' );





/**
 * Build custom field meta box
 *
 * @param post $post The post object.
 */
function featured_build_meta_box( $post ) {
	// Make sure the form request comes from WordPress.
	wp_nonce_field( basename( __FILE__ ), 'featured_meta_box_nonce' );

	// Retrieve current value of fields.
		$current_is_featured = get_post_meta( $post->ID, '_theme_is_featured', true );

	?>
	<div class='inside'>
	
		<p>
			<input type="checkbox" name="is_featured" value="1" <?php checked( $current_is_featured, '1' ); ?> /> Show on homepage
		</p>

	</div>
<?php
}




/**
 * Build custom field meta box
 *
 * @param post $post The post object.
 */
function themes_build_meta_box( $post ) {
	// Make sure the form request comes from WordPress.
	wp_nonce_field( basename( __FILE__ ), 'themes_meta_box_nonce' );

	// Retrieve current value of fields.
	$current_dates = get_post_meta( $post->ID, '_themes_dates', true );
	$current_institution = get_post_meta( $post->ID, '_themes_institution', true );
	$current_faculty = get_post_meta( $post->ID, '_themes_faculty', true );
	$current_students = get_post_meta( $post->ID, '_themes_students', true );
	$current_partners = get_post_meta( $post->ID, '_themes_partners', true );


	?>
	<div class='inside'>
		<h3><?php esc_html_e( 'Dates', 'modern-journalist' ); ?></h3>
		<p>
			<input type="text" class="large-text" placeholder="May 2017" name="dates" value="<?php echo esc_attr( $current_dates ); ?>" />
		</p>

		<h3><?php esc_html_e( 'Institution', 'modern-journalist' ); ?></h3>
		<p>
			<input type="text" class="large-text"  name="institution" value="<?php echo esc_attr( $current_institution ); ?>" />
		</p>

		<h3><?php esc_html_e( 'Faculty', 'modern-journalist' ); ?></h3>
		<p>
			<input type="text" class="large-text"  name="faculty" value="<?php echo esc_attr( $current_faculty ); ?>" />
		</p>

		<h3><?php esc_html_e( 'Students', 'modern-journalist' ); ?></h3>
		<p>
			<?php
				wp_editor(
					$current_students,
					'_themes_students',
					array(
						'media_buttons' => false,
						'textarea_name' => 'students',
						'teeny' => false,
						'textarea_rows' => get_option('default_post_edit_rows', 7),
						'tinymce' => array(
							'menubar' => false,
							'toolbar1' => 'bold,italic,underline,strikethrough,subscript,superscript,bullist,numlist,undo,redo,link,unlink',
							'toolbar2' => false,
							'textarea_rows' => get_option('default_post_edit_rows', 7)
						),
					)
				);
			?>
		</p>

		<h3><?php esc_html_e( 'Substance Partners', 'modern-journalist' ); ?></h3>
		<p>
			<?php
				wp_editor(
					$current_partners,
					'_themes_partners',
					array(
						'media_buttons' => false,
						'textarea_name' => 'partners',
						'teeny' => false,
						'textarea_rows' => get_option('default_post_edit_rows', 7),
						'tinymce' => array(
							'menubar' => false,
							'toolbar1' => 'bold,italic,underline,strikethrough,subscript,superscript,bullist,numlist,undo,redo,link,unlink',
							'toolbar2' => false,
							'textarea_rows' => get_option('default_post_edit_rows', 7)
						),
					)
				);
			?>
		</p>

	<
<?php
}
/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/save_post
 */
function themes_save_meta_box_data( $post_id ) {
	// Verify meta box nonce.
	if ( ! isset( $_POST['themes_meta_box_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['themes_meta_box_nonce'] ) ), basename( __FILE__ ) ) ) { // Input var okay.
		return;
	}
	// Return if autosave.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	
	// Dates.
	if ( isset( $_REQUEST['dates'] ) ) { // Input var okay.
		update_post_meta( $post_id, '_themes_dates', sanitize_text_field( wp_unslash( $_POST['dates'] ) ) );  // Input var okay.
	}
	// Institution.
	if ( isset( $_REQUEST['institution'] ) ) { // Input var okay.
		update_post_meta( $post_id, '_themes_institution', sanitize_text_field( wp_unslash( $_POST['institution'] ) ) );  // Input var okay.
	}

	// Faculty.
	if ( isset( $_REQUEST['faculty'] ) ) { // Input var okay.
		update_post_meta( $post_id, '_themes_faculty', sanitize_text_field( wp_unslash( $_POST['faculty'] ) ) );  // Input var okay.
	}

	// Students
	if ( isset( $_REQUEST['students'] ) ) { // Input var okay.
		update_post_meta( $post_id, '_themes_students', wp_kses_post( wp_unslash( $_POST['students'] ) ) ); // Input var okay.
	}
	// Partners
	if ( isset( $_REQUEST['partners'] ) ) { // Input var okay.
		update_post_meta( $post_id, '_themes_partners', wp_kses_post( wp_unslash( $_POST['partners'] ) ) ); // Input var okay.
	}
	//Featured
	if ( isset( $_REQUEST['is_featured'] ) ) {
		update_post_meta( $post_id, '_theme_is_featured', intval( wp_unslash( $_POST['is_featured'] ) ) );
	} else {
		update_post_meta( $post_id, '_theme_is_featured', 0 );
	}
	
	
	
//	var_dump($_REQUEST);
//	die();


}
add_action( 'save_post_themes', 'themes_save_meta_box_data' );
