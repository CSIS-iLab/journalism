<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Modern_Journalist
 */

 $meta_authors = get_post_meta( get_the_ID(), 'jourblocks_meta_authors', true );
 $meta_date = get_post_meta( get_the_ID(), 'jourblocks_meta_date', true );
 $meta_intro = get_post_meta( get_the_ID(), 'jourblocks_meta_intro', true );
 $meta_color = get_post_meta( get_the_ID(), 'jourblocks_meta_color', true );
 $meta_media = get_post_meta( get_the_ID(), 'jourblocks_meta_media', true );
 $meta_header = get_post_meta( get_the_ID(), 'jourblocks_meta_header', true );
$mediaid = attachment_url_to_postid( $meta_media );

function readableColour($bg){
    $r = hexdec(substr($bg,0,2));
    $g = hexdec(substr($bg,2,2));
    $b = hexdec(substr($bg,4,2));

    $squared_contrast = (
        $r * $r * .299 +
        $g * $g * .587 +
        $b * $b * .114
    );

    if($squared_contrast > pow(130, 2)){
        return '#000000';
    }else{
        return '#FFFFFF';
    }
}

$fontColor = readableColour($meta_color);
if($meta_color == '' || $meta_color == '#ffffff'){
  $borderColor = '#D3D3D3';
}else{
  $borderColor = 'none';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
	<header class="entry-header <?php echo esc_attr( $meta_header )?>"
    <?php
    echo 'style=" --post-color: ' . esc_attr($meta_color) .'; --post-text: ' . esc_attr($fontColor) .'; --post-border: ' . esc_attr($borderColor) .'"';
    ?>
    >
    <?php if ($meta_header == 'color-block'): ?>
    <div class="entry-header__image">
      <div class="post__image-wrapper">
      <img class="post__image" src="<?php echo esc_attr($meta_media) ?>">
    </div>
      <div class="entry-header__caption"><figcaption><?php echo wp_get_attachment_caption($mediaid) ?></figcaption></div>

    </div>

  <?php endif?>
    <div class="entry-header__text" style="<?php
    if ($meta_header == 'background-img'):
      echo 'background-image: url(\'' . esc_attr($meta_media) . '\');';
    endif;
    ?>">
    	<div class="post__date"><?php echo esc_attr( $meta_date )?></div>
    		<?php
    		if ( is_singular() ) :
    			the_title( '<h1 class="entry-title">', '</h1>' );
    		else :
    			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
    		endif;

    		if ( 'post' === get_post_type() ) :
    			?>
    			<div class="post__intro large-text"><?php echo esc_attr( $meta_intro )?></div>
    			<div class="post__authors">By <?php echo esc_attr( $meta_authors )?></div>
    		<?php endif; ?>
        <div id="header-share">
          <?php echo modern_journalist_share(  $post->ID ); ?>
        </div>



</div>
<?php if ($meta_header == 'half-page'): ?>
<div class="entry-header__image">
  <div class="post__image" style="background-image: url(' <?php echo esc_attr($meta_media) ?>'">
  </div>
</div>
<?php endif?>

<?php if ($meta_header == 'cut-out'): ?>
<div class="entry-header__image" style="background-image: url(' <?php echo esc_attr($meta_media) ?>'">

</div>
<?php endif?>

<?php if ($meta_header == 'background-img' || $meta_header == 'half-page' || $meta_header == 'cut-out') : ?>
  <div class="entry-header__caption"><figcaption><?php echo wp_get_attachment_caption($mediaid) ?></figcaption></div>


<?php endif?>

	</header><!-- .entry-header -->


	<div class="entry-content" <?php
  echo 'style=" --post-color: ' . esc_attr($meta_color) .'; --post-text: ' . esc_attr($fontColor) .'; --post-border: ' . esc_attr($borderColor) .'"';
  ?>>
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'modern-journalist' ),
				array(
				    'span' => array(
				        'class' => array(),
				    ),
				)
			),
			get_the_title()
		) );

		?>


      <?php echo modern_journalist_share(  $post->ID ); ?>

  <div class="post__footer">
<p>This story was writen by students participating in Reporting on International Affairs, a CSIS Practicum in Journalism.</p>
<div class="blue-btn"><a href="/feature-stories" title="Featured Stories">Read another story</a></div>
  </div>

	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
