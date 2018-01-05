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
function blockquote_shortcode( $atts ) {

	// Attributes
	$values = shortcode_atts(
		array(
			'quotecontent' => '',
		
			'style' => '',
			'size' => '',
			'highlight' => ''
		),
		$atts
	);



 $style = $values['style'];
 if($style == 'bold') {
	$styleClass = "quote-bold";
 } else {
 	$styleClass = "quote-lines";
 };

 $size = $values['size'];
  if($size == 'fullwidth') {
	$sizeClass = "quote-fullwidth";
 } else {
 	$sizeClass = "quote-halfwidth";
 };

$output = '<div class="blockquote ' . $sizeClass . ' ' . $styleClass .'" style="border-color: '. esc_attr($values['highlight']). '">
<div class="blockquote-content">' . esc_attr($values['quotecontent']) . '</div>';

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
			'highlight' => '',
			'style' => '',
			'image' => '',

		),
		$atts
	);



if($values['style'] == 'lgimage') {
$output .= '<div class="sectionhead section-lgimage">';
$output .= '<h2> '. $values['name'] . '</h2>';

}
else {
$output .= '<div class="sectionhead ">';
$output .= '<h2> '. esc_attr($values['name']) . '</h2>';

}
$output .= '</div>';

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
			'source' => ''
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
$output .= '<img src=" '. esc_html($values['image']) . '" alt="' .  $alt . '" title="'.  $title . '">';
$output .= '<div class="character-info"><div class="character-name">' . $values['name'] . '</div><div class="character-desc">' . $values['description'] . '</div></div><div class="character-source"> ' . $values['source'] . '</div>';
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
	$fontclass = "light-header";
 } else {
 	$fontclass = "dark-header";
 };

if($values['style'] == 'block') {
$output .= '<div id="block-header" class="post-header row ' . $fontclass . ' full-width" style="background-color: ' .  $highlight . '"><div class="boxed-header-left col-xs-12 col-md-6"><div class="post-meta"><h1 class="post-title">' . $title . '</h1>';

$output .= '<div class="post-intro">' . $values['intro'] . '</div>';
$output .= '<div class="post-date">' . get_the_date() .'</div>';
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
if (has_post_thumbnail(  $postID ) ): 
 $image = wp_get_attachment_url( get_post_thumbnail_id($postID), 'full' );
  

endif; 


$output .= '<div id="full-header"><div class="post-header row full-width" style="background-image: url(\' ' . $image . ' \')"></div>';

 

$output .= '<div class="post-meta"><h1 class="post-title">' . $title . '</h1>';
$output .= '<div class="post-date-authors">PUBLISHED <span class="post-date">' . get_the_date() . '</span> / BY ';
$output .= '<span class="post-authors">' . $values['authors']  . '</span></div>';
$output .= '<div class="post-intro">' . $values['intro'] . '</div>';

$output .= '</div>';


}



return $output;
}
add_shortcode( 'header', 'header_shortcode' );




// Add Shortcode
function dialog_shortcode( $atts ) {

	// Attributes
	$values = shortcode_atts(
		array(
			'content' => " "
			
		),
		$atts
	);


    $output ='<div class="dialog-container">'. $values['content']. '</div>';

return $output;
}   
add_shortcode( 'dialog', 'dialog_shortcode' );



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