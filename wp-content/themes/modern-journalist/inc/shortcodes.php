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



// Add Shortcode
function blockquote_shortcode( $atts , $content = null ) {

	// Attributes
	$values = shortcode_atts(
		array(
			'author' => '',
			'source' => 'Optional',
		),
		$atts
	);
$output = '<div class="blockquote">
<div class="blockquote-content">' . $content . '</div>
<div class="blockquote-author">' . esc_attr($values['author']) . '</div>';

if ($values['source'] != ""){
 $output .= '<div class="blockquote-source">' . esc_attr($values['source']) . '</div>';
};
$output .= '</div>' ;
return $output;

}
add_shortcode( 'blockquote', 'blockquote_shortcode' );

// Add Shortcode
function section_shortcode( $atts ) {

	// Attributes
	$values = shortcode_atts(
		array(
			'name' => '',
			'image' => ''
		),
		$atts
	);
$output .= '<div class="sectionhead full-width">' . esc_attr($values['name']) . '</div>';

 return $output;
}
add_shortcode( 'sectionhead', 'section_shortcode' );






// Add Shortcode
function character_shortcode( $atts , $content = null ) {

	// Attributes
	$values = shortcode_atts(
		array(
			'name' => '',
			'description' => 'Optional',
			'image' => '',
		),
		$atts
	);


	$img = wp_get_attachment_image_src($values['image'], "thumbnail");

        $imgSrc = $img[0];
        $imgID = get_attachment_id( $imgSrc );
        $attachment = get_post($imgID);
        $alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
        $title = $attachment->post_title;
  
$output = '<div class="character-detail">';
$output .= '<img src=" '. esc_html($imgSrc) . '" alt="' .  $alt . '" title="'.  $title . '">';
$output .= '<div class="character-info"><span class="character-name">' . $values['name'] . '</span><span class="character-desc">' . $values['description'] . '</span></div>';
$output .= '</div>' ;
return $output;

}
add_shortcode( 'character', 'character_shortcode' );




// Add Shortcode
function header_shortcode( $atts  ) {

	// Attributes
	$values = shortcode_atts(
		array(
			'intro' => '',
			'authors' => '',
			'style' => '', 
			'highlight' => '',
			'font' => ''
		),
		$atts
	);

 global $post;
 $postID = $post->ID;
 $title = get_the_title();

 $highlight = $values['highlight'];

 $font = $values['font'];
 if($font == 'light') {
	$fontclass = "dark-header";
 } else {
 	$fontclass = "light-header";
 };

if($values['style'] == 'block') {
$output .= '<div id="block-header" class="post-header row ' . $fontclass . ' full-width" style="background-color: ' .  $highlight . '"><div class="boxed-header-left col-xs-12 col-md-6"><div id="post-meta"><h1 class="post-title">' . $title . '</h1>';

$output .= '<div class="post-intro">' . $values['intro'] . '</div>';
$output .= '<div class="post-date"></div>';
$output .= '<div class="post-authors">' . $values['authors']  . '</div></div></div><div class="boxed-header-right col-xs-12 col-md-6">';

if (has_post_thumbnail(  $postID ) ): 
 $image = wp_get_attachment_url( get_post_thumbnail_id($postID), 'thumbnail' );
  $output .= '<div class="featured-img img-container fit-height">
				<img src="' . $image . '" alt="" />
			</div>';
endif; 
$output .= '</div></div>';

}
if($values['style'] == 'full') {

$output .= '<div id="full-header" class="post-header row full-width">';

 if (has_post_thumbnail(  $postID ) ): 
 $image = wp_get_attachment_url( get_post_thumbnail_id($postID), 'thumbnail' );
  $output .= '<div class="featured-img img-container fit-height">
				<img src="' . $image . '" alt="" />
			</div>';
endif; 


$output .= '<div id="post-meta"><h1 class="post-title">' . $title . '</h1>';

$output .= '<div class="post-intro">' . $values['intro'] . '</div>';
$output .= '<div class="post-date"></div>';
$output .= '<div class="post-authors">' . $values['authors']  . '</div>';

 
$output .= '</div>';


}



return $output;
}
add_shortcode( 'header', 'header_shortcode' );




// Add Shortcode
function imgGroup_shortcode( $atts ) {

	// Attributes
	$gallery = shortcode_atts(
		array(
			'description' => 'Optional',
			'source' => '',
			'layout' => 'column',
			'images' => ''
		),
		$atts
	);

 $image_ids = explode(',',$gallery['images']);

    foreach( $image_ids as $image_id ){
    $images = wp_get_attachment_image_src( $image_id );
    $output .='<div class="images"><img src="' . $images[0] . '" alt="' . $gallery['description'] .' "></div>';
    $images++;
    }
 
return $output;
}   
add_shortcode( 'img-group', 'imgGroup_shortcode' );