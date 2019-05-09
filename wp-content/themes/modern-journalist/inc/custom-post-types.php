<?php
/**
 * Testimonials
 *
 * @package      CoreFunctionality
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/
class J_Testimonials
{
    /**
     * Initialize all the things
     *
     * @since 1.2.0
     */
    public function __construct()
    {
        // Actions
        add_action('init', array( $this, 'register_cpt' ));
        add_filter('wp_insert_post_data', array( $this, 'set_testimonial_title' ), 99, 2);
    }
    /**
     * Register the custom post type
     *
     * @since 1.2.0
     */
    public function register_cpt()
    {
        $labels = array(
            'name'               => 'Testimonials',
            'singular_name'      => 'Testimonial',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Testimonial',
            'edit_item'          => 'Edit Testimonial',
            'new_item'           => 'New Testimonial',
            'view_item'          => 'View Testimonial',
            'search_items'       => 'Search Testimonials',
            'not_found'          => 'No Testimonials found',
            'not_found_in_trash' => 'No Testimonials found in Trash',
            'parent_item_colon'  => 'Parent Testimonial:',
            'menu_name'          => 'Testimonials',
        );
        $args = array(
            'labels'              => $labels,
            'hierarchical'        => true,
            'supports'            => array( 'editor', 'custom-fields' ),
            'public'              => true,
            'show_ui'             => true,
            'show_in_rest'        => true,
            'publicly_queryable'  => true,
            'exclude_from_search' => false,
            'has_archive'         => false,
            'query_var'           => true,
            'can_export'          => true,
            'rewrite'             => array( 'slug' => 'testimonial', 'with_front' => false ),
            'menu_icon'           => 'dashicons-format-quote',
            'template' => array(
                array( 'jourblocks/testimonial-meta' ),
            array( 'core/paragraph', array(
                'placeholder' => 'Add Description...',
            ) ),
        ),
            'template_lock'      => 'all',
        );
        register_post_type('testimonial', $args);
    }


    /**
     * Set testimonial title
     *
     */
    public function set_testimonial_title($data, $postarr)
    {
        if ('testimonial' == $data['post_type']) {
            $title = $this->get_citation($data['post_content']);
            if (empty($title)) {
                $title = 'Testimonial ' . $postarr['ID'];
            }
            $data['post_title'] = $title;
        }
        return $data;
    }
    /**
     * Get Citation
     *
     */
    public function get_citation($content)
    {
        $matches = array();
        $regex = '#<p>(.*?)</p>#';
        preg_match_all($regex, $content, $matches);
        if (!empty($matches) && !empty($matches[0]) && !empty($matches[0][0])) {
            return strip_tags($matches[0][0]);
        }
    }
}
new J_Testimonials();
