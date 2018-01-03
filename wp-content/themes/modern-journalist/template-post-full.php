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

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
				<div class="featureImg" style="background-image:url('<?php echo $featured_img_url; ?>');">
					<?php
					// Post Title
					the_title( '<h1 class="entry-title">', '</h1>' );
					?>
				</div>
		</header><!-- .entry-header -->
		
		<?php the_content( 
		/* translators: %s: Name of current post. */
			
			 );?>
	</div><!-- row -->
	<?php 

get_template_part( 'components/post-footer' );
	?>
</article><!-- #post-<?php the_ID(); ?> -->
		</main><!-- #main -->

	</div><!-- #primary -->

<?php
get_footer();

?>
