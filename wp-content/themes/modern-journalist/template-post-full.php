<?php
/*
 * Template Name: Full Width Photo
 * Template Post Type: post
 */
  
 get_header();  
if (has_post_thumbnail()) :
	$featured_img_url = get_the_post_thumbnail_url();
endif;

?>


<article id="post-<?php the_ID(); ?>" class="col-wide" <?php post_class(); ?>>
	<div class="row post-entry">
		<header class="entry-header">
				<div class="featureImg" style="background-image:url('<?php echo $featured_img_url; ?>');">
					<?php
					// Post Title
					the_title( '<h1 class="entry-title">', '</h1>' );
					?>
				</div>
		</header><!-- .entry-header -->
		
		<?php the_content( sprintf(
		/* translators: %s: Name of current post. */
			
			) );?>
	</div><!-- row -->
</article><!-- #post-<?php the_ID(); ?> -->
