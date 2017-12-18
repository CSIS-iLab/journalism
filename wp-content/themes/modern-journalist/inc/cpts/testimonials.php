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
		'name'                  => _x( 'Testimonials', 'Post Type General Name', 'modern-journalist' ),
		'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'modern-journalist' ),
		'menu_name'             => __( 'Testimonials', 'modern-journalist' ),
		'name_admin_bar'        => __( 'Testimonials', 'modern-journalist' ),
		'archives'              => __( 'Testimonials Archives', 'modern-journalist' ),
		'attributes'            => __( 'Testimonials Attributes', 'modern-journalist' ),
		'parent_item_colon'     => __( 'Parent Testimonial', 'modern-journalist' ),
		'all_items'             => __( 'All Testimonials', 'modern-journalist' ),
		'add_new_item'          => __( 'Add New Testimonial', 'modern-journalist' ),
		'add_new'               => __( 'Add Testimonial', 'modern-journalist' ),
		'new_item'              => __( 'New Testimonial', 'modern-journalist' ),
		'edit_item'             => __( 'Edit Testimonial', 'modern-journalist' ),
		'update_item'           => __( 'Update Testimonial', 'modern-journalist' ),
		'view_item'             => __( 'View Testimonial', 'modern-journalist' ),
		'view_items'            => __( 'View Testimonials', 'modern-journalist' ),
		'search_items'          => __( 'Search Testimonial', 'modern-journalist' ),
		'not_found'             => __( 'Not found', 'modern-journalist' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'modern-journalist' ),
		'featured_image'        => __( 'Featured Image', 'modern-journalist' ),
		'set_featured_image'    => __( 'Set featured image', 'modern-journalist' ),
		'remove_featured_image' => __( 'Remove featured image', 'modern-journalist' ),
		'use_featured_image'    => __( 'Use as featured image', 'modern-journalist' ),
		'insert_into_item'      => __( 'Insert into Testimonial', 'modern-journalist' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Testimonial', 'modern-journalist' ),
		'items_list'            => __( 'Testimonials list', 'modern-journalist' ),
		'items_list_navigation' => __( 'Testimonials list navigation', 'modern-journalist' ),
		'filter_items_list'     => __( 'Filter Testimonials list', 'modern-journalist' ),
	);
	$args = array(
		'label'                 => __( 'Testimonial', 'modern-journalist' ),
		'description'           => __( 'Testimonials', 'modern-journalist' ),
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

