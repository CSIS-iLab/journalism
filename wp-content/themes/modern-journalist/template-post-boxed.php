<?php
/*
 * Template Name: Boxed 
 * Template Post Type: post
 */
   get_header();  
if (has_post_thumbnail()) :
	$featured_img_url = get_the_post_thumbnail_url();
endif;
 ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<article id="post-<?php the_ID(); ?>" class="boxed-post" <?php post_class() ?>	>
		<header id="post-header" class="row">
			<div class="boxed-header-left col-xs-12 col-sm-6">
				<div id="post-meta">
					<?php
					// Post Title
					the_title( '<h1 class="entry-title">', '</h1>' );
					?>
					<?php modern_journalist_posted_on(); ?>
									<?php 
									$post = get_the_ID();
									related_authors($post); ?>

									<div class="authors">
									<?php
				    global $related_du;
				    $rel = $related_du->show( get_the_ID(), true );

				    // Display the title and excerpt of each related post
				    if( is_array( $rel ) && count( $rel ) > 0 ) {
				    	$a = 0;
				        foreach ( $rel as $r ) {
				            if ( is_object( $r ) ) {
				                if ($r->post_status != 'trash') {
				                	$a++;
				                    setup_postdata( $r );
				                    echo get_the_title( $r->ID );

				               		if ($a < count($rel)){
				               			echo ', ';
				               		}
				                };
				            }
				        }
				        wp_reset_postdata();
				    }

				?>
</div>
				</div>
				</div>
				<div class="boxed-header-right col-xs-12 col-sm-6">
					<div class="featured-img img-container fit-height">
				<img src="<?php echo $featured_img_url ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" />
			</div>
				</div>
				</div>
		</header><!-- .entry-header -->
		</div>
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
