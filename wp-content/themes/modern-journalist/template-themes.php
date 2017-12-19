

<?php
/*
Template Name: The Experience
*/
get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main content-wrapper">

	<header class="page-header">
			<div class="title-container">
			<?php the_title('<h1 class="page-title">', '</h1>'); ?>
			<div class="archive-description row">
                 <?php the_content() ?>
            </div><!-- .archive-description  -->
			 </div><!-- .title-container -->
		</header><!-- .page-header -->
		<section class="archive-content row">
        <?php
		
		$custom_query = new WP_Query(array('post_type'=>'themes', 'post_status'=>'publish'));  ?>
  		
          			<?php 
  			if ( $custom_query->have_posts() ) : ?>
		
				<?php
				/* Start the Loop */
				while ( $custom_query->have_posts() ) : $custom_query->the_post(); 
						get_template_part( 'template-parts/content', get_post_type() );
				endwhile;

			endif; ?>

          </section>
	</main><!-- main -->
</div><!-- #container -->

<?php get_footer(); ?>