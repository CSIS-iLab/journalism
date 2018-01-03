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
     
    $output = '<div class="row"><div class="pdf-icon"><a href="'. esc_attr($values['url']) .'"  target="" class=""><i class="icon-doc"></i></a></div><div class="pdf-info"><p><a href="'. esc_attr($values['url']) .'"  target="" class="">'. esc_attr($values['title']). '</a><br><span class="meta-label">Last updated '. esc_attr($values['updated']) .'</span></div></div>';
 return $output;
}
add_shortcode( 'pdf', 'pdf_shortcode' );



// Extended subscription function with subscription type variable
function subscribe_multilink_shortcode( $atts ) {
    extract( shortcode_atts( array(
        'subtype' => 'RSS',
        'subtypeurl' => 'http://feeds.feedburner.com/ElegantThemes', 
    ), $atts, 'multilink' ) );
  
    $output = 'Be sure to subscribe to future Elegant Themes updates.' . esc_attr($values['subtype']);
      return $output;
   
}
add_shortcode( 'subscribe', 'subscribe_multilink_shortcode' );
