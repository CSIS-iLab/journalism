<?php
/**
 * Custom Post Types: Authors
 *
 * @package Modern-Journalist
 */

/**
 * Register custom post type
 */
function modernjournalist_cpt_authors() {

	$labels = array(
		'name'                  => _x( 'Authors', 'Post Type General Name', 'modern-journalist' ),
		'singular_name'         => _x( 'Author', 'Post Type Singular Name', 'modern-journalist' ),
		'menu_name'             => __( 'Authors', 'modern-journalist' ),
		'name_admin_bar'        => __( 'Authors', 'modern-journalist' ),
		'archives'              => __( 'Authors Archives', 'modern-journalist' ),
		'attributes'            => __( 'Authors Attributes', 'modern-journalist' ),
		'parent_item_colon'     => __( 'Parent Author', 'modern-journalist' ),
		'all_items'             => __( 'All Authors', 'modern-journalist' ),
		'add_new_item'          => __( 'Add New Author', 'modern-journalist' ),
		'add_new'               => __( 'Add Author', 'modern-journalist' ),
		'new_item'              => __( 'New Author', 'modern-journalist' ),
		'edit_item'             => __( 'Edit Author', 'modern-journalist' ),
		'update_item'           => __( 'Update Author', 'modern-journalist' ),
		'view_item'             => __( 'View Author', 'modern-journalist' ),
		'view_items'            => __( 'View Authors', 'modern-journalist' ),
		'search_items'          => __( 'Search Author', 'modern-journalist' ),
		'not_found'             => __( 'Not found', 'modern-journalist' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'modern-journalist' ),
		'featured_image'        => __( 'Featured Image', 'modern-journalist' ),
		'set_featured_image'    => __( 'Set featured image', 'modern-journalist' ),
		'remove_featured_image' => __( 'Remove featured image', 'modern-journalist' ),
		'use_featured_image'    => __( 'Use as featured image', 'modern-journalist' ),
		'insert_into_item'      => __( 'Insert into Author', 'modern-journalist' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Author', 'modern-journalist' ),
		'items_list'            => __( 'Authors list', 'modern-journalist' ),
		'items_list_navigation' => __( 'Authors list navigation', 'modern-journalist' ),
		'filter_items_list'     => __( 'Filter Authors list', 'modern-journalist' ),
	);
	$args = array(
		'label'                 => __( 'Author', 'modern-journalist' ),
		'description'           => __( 'Authors', 'modern-journalist' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'            => array('category',),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-id',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'menu_position' => 40,
	);
	register_post_type( 'authors', $args );

}
add_action( 'init', 'modernjournalist_cpt_authors', 0 );



/*----------  Custom Meta Fields  ----------*/
/**
 * Add meta box
 *
 * @param post $post The post object.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function authors_add_meta_boxes( $post ) {
add_meta_box( 'authors_meta_box', __( 'Author Details', 'modern-journalist' ), 'authors_build_meta_box', 'authors', 'normal', 'high' );
	
}
add_action( 'add_meta_boxes_authors', 'authors_add_meta_boxes' );




/**
 * Build custom field meta box
 *
 * @param post $post The post object.
 */
function authors_build_meta_box( $post ) {
	// Make sure the form request comes from WordPress.
	wp_nonce_field( basename( __FILE__ ), 'authors_meta_box_nonce' );

	// Retrieve current value of fields.
	$current_institution = get_post_meta( $post->ID, '_authors_institution', true );

	?>
	<div class='inside'>

		<h3><?php esc_html_e( 'Institution', 'modern-journalist' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="institution" value="<?php echo esc_attr( $current_institution ); ?>" />
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
function authors_save_meta_box_data( $post_id ) {
	// Verify meta box nonce.
	if ( ! isset( $_POST['authors_meta_box_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['authors_meta_box_nonce'] ) ), basename( __FILE__ ) ) ) { // Input var okay.
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

	// Institution.
	if ( isset( $_REQUEST['institution'] ) ) {
		update_post_meta( $post_id, '_authors_institution', sanitize_text_field( $_POST['institution'] ) );
	}
	
	
}
add_action( 'save_post_authors', 'authors_save_meta_box_data' );

