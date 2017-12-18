<?php
/**
 * Custom Post Types: Testimonials
 *
 * @package Modern-Journalist
 */

/**
 * Register custom post type
 */
function modernjournalist_cpt_testimonials() {

	$labels = array(
		'name'                  => _x( 'Testimonials', 'Post Type General Name', 'modernjournalist' ),
		'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'modernjournalist' ),
		'menu_name'             => __( 'Testimonials', 'modernjournalist' ),
		'name_admin_bar'        => __( 'Testimonials', 'modernjournalist' ),
		'archives'              => __( 'Testimonials Archives', 'modernjournalist' ),
		'attributes'            => __( 'Testimonials Attributes', 'modernjournalist' ),
		'parent_item_colon'     => __( 'Parent Testimonial', 'modernjournalist' ),
		'all_items'             => __( 'All Testimonials', 'modernjournalist' ),
		'add_new_item'          => __( 'Add New Testimonial', 'modernjournalist' ),
		'add_new'               => __( 'Add Testimonial', 'modernjournalist' ),
		'new_item'              => __( 'New Testimonial', 'modernjournalist' ),
		'edit_item'             => __( 'Edit Testimonial', 'modernjournalist' ),
		'update_item'           => __( 'Update Testimonial', 'modernjournalist' ),
		'view_item'             => __( 'View Testimonial', 'modernjournalist' ),
		'view_items'            => __( 'View Testimonials', 'modernjournalist' ),
		'search_items'          => __( 'Search Testimonial', 'modernjournalist' ),
		'not_found'             => __( 'Not found', 'modernjournalist' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'modernjournalist' ),
		'featured_image'        => __( 'Featured Image', 'modernjournalist' ),
		'set_featured_image'    => __( 'Set featured image', 'modernjournalist' ),
		'remove_featured_image' => __( 'Remove featured image', 'modernjournalist' ),
		'use_featured_image'    => __( 'Use as featured image', 'modernjournalist' ),
		'insert_into_item'      => __( 'Insert into Testimonial', 'modernjournalist' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Testimonial', 'modernjournalist' ),
		'items_list'            => __( 'Testimonials list', 'modernjournalist' ),
		'items_list_navigation' => __( 'Testimonials list navigation', 'modernjournalist' ),
		'filter_items_list'     => __( 'Filter Testimonials list', 'modernjournalist' ),
	);
	$args = array(
		'label'                 => __( 'Testimonial', 'modernjournalist' ),
		'description'           => __( 'Testimonials', 'modernjournalist' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt' ),
		'taxonomies'            => none,
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-format-quote',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'testimonials', $args );

}
add_action( 'init', 'modernjournalist_cpt_testimonials', 0 );

/*----------  Custom Meta Fields  ----------*/
/**
 * Add meta box
 *
 * @param post $post The post object.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function testimonials_add_meta_boxes( $post ) {
	add_meta_box( 'testimonials_meta_box', __( 'Testimonials Information', 'modernjournalist' ), 'testimonials_build_meta_box', 'testimonials', 'normal', 'high' );
	add_meta_box( 'featuredt_meta_box', __( 'Featured', 'modern-journalist' ), 'featuredt_build_meta_box', 'testimonials', 'side', 'low' );
}
add_action( 'add_meta_boxes_testimonials', 'testimonials_add_meta_boxes' );


/**
 * Build custom field meta box
 *
 * @param post $post The post object.
 */
function featuredt_build_meta_box( $post ) {
	// Make sure the form request comes from WordPress.
	wp_nonce_field( basename( __FILE__ ), 'featuredt_meta_box_nonce' );

	// Retrieve current value of fields.
		$current_is_featured = get_post_meta( $post->ID, '_testimonial_is_featured', true );

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
function testimonials_build_meta_box( $post ) {
	// Make sure the form request comes from WordPress.
	wp_nonce_field( basename( __FILE__ ), 'testimonials_meta_box_nonce' );

	// Retrieve current value of fields.
	$current_date = get_post_meta( $post->ID, '_testimonials_date', true );
	$current_role = get_post_meta( $post->ID, '_testimonials_role', true );
	$current_institution = get_post_meta( $post->ID, '_testimonials_institution', true );

	?>
	<div class='inside'>
	
		<h3><?php esc_html_e( 'Role', 'modernjournalist' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="role" value="<?php echo esc_attr( $current_role ); ?>" />
		</p>

		<h3><?php esc_html_e( 'Institution', 'modernjournalist' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="institution" value="<?php echo esc_attr( $current_institution ); ?>" />
		</p>

		<h3><?php esc_html_e( 'Date', 'modernjournalist' ); ?></h3>
		<p>
			<input type="text" class="medium-text" placeholder="May 2017" name="date" value="<?php echo esc_attr( $current_date ); ?>" />
		</p>
	</div>
<?php
}
/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/save_post
 */
function testimonials_save_meta_box_data( $post_id ) {
	// Verify meta box nonce.
	if ( ! isset( $_POST['testimonials_meta_box_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['testimonials_meta_box_nonce'] ) ), basename( __FILE__ ) ) ) { // Input var okay.
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
	

	// Role.
	if ( isset( $_REQUEST['role'] ) ) {  // Input var okay.
		update_post_meta( $post_id, '_testimonials_role', sanitize_text_field( $_POST['role'] ) );  // Input var okay.
	}
	// Institution.
	if ( isset( $_REQUEST['institution'] ) ) {
		update_post_meta( $post_id, '_testimonials_institution', sanitize_text_field( $_POST['institution'] ) );
	}
	
	// Date
	if ( isset( $_REQUEST['date'] ) ) {
		update_post_meta( $post_id, '_testimonials_date', sanitize_text_field( $_POST['date'] ) );
	}
	//Featured
	if ( isset( $_REQUEST['is_featured'] ) ) {
		update_post_meta( $post_id, '_testimonial_is_featured', intval( wp_unslash( $_POST['is_featured'] ) ) );
	} else {
		update_post_meta( $post_id, '_testimonial_is_featured', 0 );
	}

}
add_action( 'save_post_testimonials', 'testimonials_save_meta_box_data' );
