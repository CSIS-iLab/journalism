<?php

/**
 * Custom shortcodes for the theme
 *
 * @package Modern-Journalist
 */

/**
 * Inline PDF link in theme post content
 */
// Add Shortcode
function pdf_shortcode( $atts ) {
    //set default attributes and values
    $values = shortcode_atts( array(
        'url'   	=> '#',
        'title'	=> 'abc',
        'updated'	=> 'updated',
    ), $atts );
     
    $output = '<div class="row"><div class="pdf-icon"><a href="'. esc_attr($values['url']) .'"  target="" class=""><i class="icon-doc"></i></a></div><div class="pdf-info"><p><a href="'. esc_attr($values['url']) .'"  target="" class="">'. esc_attr($values['title']). '</a><br><span class="meta-label">Last Updated:</span>'. esc_attr($values['updated']) .'</div></div>';
 return $output;
}
add_shortcode( 'pdf', 'pdf_shortcode' );