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
		'supports'              => array( 'title', 'editor', 'excerpt' ),
		'taxonomies'            => array( 'post_tag' ),
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


