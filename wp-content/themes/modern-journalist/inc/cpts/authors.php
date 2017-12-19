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
		'taxonomies'            => array( ),
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

