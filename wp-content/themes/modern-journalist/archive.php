<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Modern_Journalist
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main content-wrapper">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			$args = array('order' => 'ASC');
			$query = new WP_Query($args);
			$query = new WP_Query($args);
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */

				if(get_post_type() == 'themes' || is_post_type_archive('themes')) {
// echo out the title, excerpt
					get_template_part( 'template-parts/content-themes' );

					
				}
				else {
?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php
			    if ( has_post_thumbnail() ) {
			        echo '<div class="col-xs-12 col-md-' . $thumbnail_size . ' entry-thumbnail"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
			        the_post_thumbnail( 'medium_large' );

			    }
			    ?>
				<?php
				if ( is_singular() ) :
					the_title( '<h3 class="entry-title">', '</h3>' );
				else :
					the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
				endif;

				if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php modern_journalist_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php
				endif; ?>
			</header><!-- .entry-header -->

		<div class="entry-content">
        <?php the_excerpt(); ?>
        </div><!-- .entry-content -->

		</article><!-- #post-<?php the_ID(); ?> -->

			<?php	}

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
