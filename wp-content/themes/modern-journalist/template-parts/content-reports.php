<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Modern_Journalist
 */

?>

<article id="post-<?php the_ID(); ?>" class="col-wide" <?php post_class(); ?>>
	<div class="row post-entry">
		<div class="col-xs-12 col-md-8 no-padding">
		<header class="entry-info">
			<?php
			$permalink = get_permalink();
				the_title( '<h3 class="entry-title"><a href="' . esc_url( $permalink ) . '" rel="bookmark">', '</a></h3>' );
			
		?>
			<div class="entry-meta stories">

			<?php
			$photo =  get_the_post_thumbnail();  

			if ( 'post' === get_post_type() ) : ?>

			<p class="meta-line"><span class="meta-label">By: </span>
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

			</p>

			<p class="meta-line"><span class="meta-label">Published: </span>
				<?php modern_journalist_posted_on(); ?>
			</p>
			<?php
			endif; ?>
</div>
			<div class="entry-excerpt"><p><?php 

			 $post = get_post($r->ID);
  					$excerpt = get_the_excerpt();
                    echo $excerpt;
			 ?></p></div>

		</header><!-- .entry-info -->
	</div>

	<div class="col-xs-12 col-md-4 no-padding">
	<?php
		echo '<a href="' .  esc_url( $permalink ) . '" rel="bookmark"><div class="img-container fit-width">' .   $photo .'</div></a>';
			
		//echo '<a href="' .  esc_url( $permalink ) . '" rel="bookmark"><div class="img-container fit-width"><picture>';
//picturefill($alt, $postid);

		 //echo '</picture></div></a>';


	?>
	</div>

</div><!-- row -->

</article><!-- #post-<?php the_ID(); ?> -->
