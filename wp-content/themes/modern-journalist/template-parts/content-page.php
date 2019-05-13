<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Modern_Journalist
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> class="page-content">


	<?php modern_journalist_post_thumbnail(); ?>

	<div class="entry-content">
		<div class="">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</div><!-- .entry-header -->

		<?php
		the_content();

		wp_link_pages( array(
		    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'modern-journalist' ),
		    'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'modern-journalist' ),
						array(
						    'span' => array(
						        'class' => array(),
						    ),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
