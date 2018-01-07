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
			'position' => '',
			'accent' => '', 
			'highlightcolor' => ''
		),
		$atts
	);

 $style = $values['style'];
 if($style == 'quotes') {
	$styleClass = "quote-quotes";
 } elseif ($style == 'highlighted') {
 	$styleClass = "quote-highlight";
 }else {
 	$styleClass = "quote-lines";
 };


$position = $values['position'];
  if($position == 'fullwidth') {
	$sizeClass = "quote-fullwidth";
 } elseif ($position == 'left'){
 	$sizeClass = "quote-left";
 }else {
 	$sizeClass = "quote-right";
 }
 ;



$output .= '<div class="blockquote ' . $sizeClass . ' ' . $styleClass .'" style="border-color: '. esc_attr($values['accent']). '">';


 
$output .=   '<div class="blockquote-content ' .  esc_attr($values['highlightcolor']) . '  "';
$output .='>';
if($style == 'quotes') {
$output .=  '<i class="icon-quote start" style="color: '. esc_attr($values['accent']). '"></i>';
}

$output .=  esc_attr($values['quotecontent']);

if($style == 'quotes') {
$output .=  '<i class="icon-quote" style="color: '. esc_attr($values['accent']). '"></i>';
}

$output .= '</div>';

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
			'image' => ''


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

 

$str = $highlight;
$hex = ltrim($str, '#');

//break up the color in its RGB components
$r = hexdec(substr($hex,0,2));
$g = hexdec(substr($hex,2,2));
$b = hexdec(substr($hex,4,2));

//do simple weighted avarage
//
//(This might be overly simplistic as different colors are perceived
// differently. That is a green of 128 might be brighter than a red of 128.
// But as long as it's just about picking a white or black text color...)
if($r + $g + $b > 382){
    $backgroundcalc  = "lightbg";
}else{
    $backgroundcalc  = "darkbg";
};

if($values['style'] == 'block') {
	
$output .= '<div id="block-header" class="post-header row ' . $backgroundcalc  . ' full-width" style="background-color: ' .  $highlight . '"><div class="boxed-header-left col-xs-12 col-md-6"><div class="post-meta"><h1 class="post-title">' . $title . '</h1>';

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
function dialog_shortcode( $atts, $content = null ) {

	// Attributes
	$values = shortcode_atts(
		array(
			'content' => '',
		),
		$atts
	);


$paragraphs = preg_split( '|(?<=</p>)\s+(?=<p)|', $content, -1, PREG_SPLIT_NO_EMPTY);
$output .='<div class="dialog-container">';
foreach ($paragraphs as &$line) {
  
    if (strpos($line, ':') !== false) {
    $newline = preg_replace('/(.*)(?=:)/', "<span>$1</span>", $line);
    $output .= '<div>' . $newline . '</div>';
	}

}

$output .='</div>';
   

return $output;
}   
add_shortcode( 'dialog', 'dialog_shortcode' );



// Add Shortcode
function imgGroup_shortcode( $atts, $content = null ) {

	// Attributes
	$gallery = shortcode_atts(
		array(
			'content' => '',
			'source' => '',
			'position' => '',
			'images' => ''
		),
		$atts
	);



 $image_ids = explode(',',$gallery['images']);
 $count = count($image_ids);
 switch ($count) {
    case 1:
        $colcount = 8;
        break;
    case 2:
        $colcount = 5;
        break;
    case 3:
        $colcount = 3;
        break;
    case 4:
        $colcount = 2;
        break;
}
if ($gallery['position'] == 'fullwidth'){
 $output .='<div class="image-group row group-full">';
} elseif ($gallery['position'] == 'left'){
$output .='<div class="image-group  row group-left">';
} elseif ($gallery['position'] == 'right'){
$output .='<div class="image-group  row group-right">';
};
    foreach( $image_ids as $image_id ){
    $images = wp_get_attachment_image_src( $image_id , 'large');

  if ($gallery['position'] == 'fullwidth'){
    $output .='<div class="images col-xs-12 col-md-' . $colcount . '">';
} else {
	$output .='<div class="images col-xs-12">';
}


    $output .= '<div class="gallery"><a href="' . $images[0] . '" rel="lightbox"><img src="' . $images[0] . '" alt="' . $gallery['content'] .' "></a></div>';
    $output .= '</div>';
    $images++;
    }
 $coldesc = 12 - $colcount * $count;
   if ($gallery['position'] == 'fullwidth'){
$output .='<div class="images col-xs-12 col-md-' . $coldesc . '">' . $content . '</div>';
} else {
$output .='<div class="img-desc col-xs-12">' . $content . '</div>';
	}
$output .='</div>';

return $output;

}   
add_shortcode( 'img-group', 'imgGroup_shortcode' );



// Add Shortcode
function textimg_shortcode( $atts, $content = null ) {
	// Attributes
	$values = shortcode_atts(
		array(
			'content' => '',
			'image' => '',
			'darkbg' => ''
		),
		$atts
	);

 $img = wp_get_attachment_image_src($values['image'], "thumbnail");

        $imgSrc = $img[0];
        $imgID = get_attachment_id( $imgSrc );
        $attachment = wp_get_attachment_url($imgID);
        $alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
        $title = $attachment->post_title;
  
if ($values['darkbg'] == 'true') {
$backgroundclass="darkbg";

} else {
	$backgroundclass="lightbg";
}


$output .= '<div class="textimg-container" style="background-image: url(\' ' . $attachment . ' \')">';
$output .= '<div class="textimg-spacing"><div class="textimg-text '. $backgroundclass .'"> ' . $content;


if ( ! empty( wp_get_attachment_caption($imgID) ) ) {
$output .= '<div class="img-desc">' . wp_get_attachment_caption($imgID) . '</div>';
}

$output .= '</div></div>';
$output .= '</div>';
return $output;
}   
add_shortcode( 'textimg', 'textimg_shortcode' );




// Add Shortcode
function singleimg_shortcode( $atts ) {
	// Attributes
	$values = shortcode_atts(
		array(
			'position' => '',
			'image' => '',
		
		),
		$atts
	);


$position = $values['position'];
  if($position == 'fullwidth') {
	$positionClass = "img-fullwidth";
 } elseif ($position == 'left'){
 	$positionClass = "img-left";
 }else {
 	$positionClass = "img-right";
 }
 ;


 $img = wp_get_attachment_image_src($values['image'], "thumbnail");

        $imgSrc = $img[0];
        $imgID = get_attachment_id( $imgSrc );
        $attachment = wp_get_attachment_url($imgID);
        $alt = get_post_meta($imgID, '_wp_attachment_image_alt', true);
        $title = $attachment->post_title;
 

$output .= '<div class"' . $positionClass . '"><a href="' . $attachment . '" rel="lightbox"><img src="' . $attachment . ' \')" alt= "' .  $alt . '"></a>';

$output .= '<div class="img-desc">' . wp_get_attachment_caption($imgID) . '</div></div>';

return $output;
}   
add_shortcode( 'singleimg', 'singleimg_shortcode' );





// Add Shortcode
function audiowidget_shortcode( $atts  ) {

	// Attributes
	$values = shortcode_atts(
		array(
			'title' => '',
			'url' => 'Optional'
		),
		$atts
	);
	
$output = '<div class="audiowidget">';
$
$output .= '<!--[if lt IE 9]><script>document.createElement("audio");</script><![endif]-->';
$output .= '<audio class="wp-audio-shortcode" id="audio-1-1" preload="none" style="width: 100%;" controls="controls"><source type="audio/wav" src="'. esc_html($values['url']) . '" /><a href="'. esc_html($values['url']) . '">'. esc_html($values['url']) . '</a></audio>';
$output .= '</div>';
return $output;

}
add_shortcode( 'audiowidget', 'audiowidget_shortcode' );


