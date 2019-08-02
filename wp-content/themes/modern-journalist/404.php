<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Modern_Journalist
 */

get_header();
?>

	<div id="primary" class="page">
		<main id="content" role="main" class="site-content">


			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'modern-journalist' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'modern-journalist' ); ?>
	Maybe try visiting the <a href="/" alt="Visit the homepage">homepage</a>, or browse the <a href="/featured-stories" alt="Browse the list of featured stories">collection of published stories</a>.
</p>



				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
