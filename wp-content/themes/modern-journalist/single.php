<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Modern_Journalist
 */


get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main content-wrapper">
			<div class="content-wrapper-narrow entry-content">
		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation();

			

		endwhile; // End of the loop.
		?>
			</div> <!-- content-wrapper-narrow entry-content -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

?>
