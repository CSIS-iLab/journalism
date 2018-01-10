<?php
	/**
	 * The template for displaying all single posts
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
	 *
	 * @package Modern_Journalist
	 */
get_header();?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<article id="post-<?php the_ID();?>"<?php post_class();?>>
				<div class="content-wrapper-narrow entry-content">
				<?php
				while (have_posts()): the_post();
				get_template_part('template-parts/content', get_post_type());
				endwhile; // End of the loop.
				 ?>

					<div class="story-link-div"><div class="story-info">
					This story was writen by students participating in <em>Reporting on International Affairs</em>, a CSIS Practicum in Journalism.</div>

					<div class="story-link"><a href="/feature-stories"><i class="icon-arrow-long-left"></i>Read another story</a></div>
				</div>
			</article>


		</main><!-- #main -->

	</div><!-- #primary -->

<?php
	get_footer();
?>
