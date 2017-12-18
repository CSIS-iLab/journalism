<?php
/**
 * Archive: Themes
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Modern-Journalist
 */

// if ( get_archive_top_content() ) {
//     $description = get_archive_top_content();
// } else {
    $description = get_the_archive_description();
// }

$description = '<div class="archive-description-desc col-xs-12 col-sm">' . $description . '</div>';

// if ( get_archive_bottom_content() ) {
//     $description_extra = '<div class="archive-description-extra col-xs-12 col-sm-3">' . get_archive_bottom_content() . '</div>';
// }

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main content-wrapper">
		<header class="page-header">
			<div class="title-container">
			<?php the_archive_title('<h1 class="page-title">', '</h1>'); ?>
			<div class="archive-description row">
                <p>In hac habitasse platea dictumst. Vivamus adipiscing fermentum quam volutpat aliquam. Integer et elit eget elit facilisis tristique. In hac habitasse platea dictumst. Vivamus adipiscing fermentum quam volutpat aliquam. Integer et elit eget elit facilisis tristique.</p>
            </div><!-- .archive-description  -->
			 </div><!-- .title-container -->
		</header><!-- .page-header -->
		<section class="archive-content row">
			<?php if (have_posts() ) : 
        
        /* Start the Loop */
        while ( have_posts() ) : the_post();

            
                get_template_part('template-parts/content-themes', get_post_type());
            

        endwhile;
        ?>
        
        <?php
        

        endif; ?>

	</main><!-- #main -->
</div><!-- #primary -->