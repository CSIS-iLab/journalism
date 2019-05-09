<?php
/*
Template Name: Featured Stories
*/
get_header(); ?>

<div id="main-content" class="main-content">


	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

	<?php
    // Start the Loop.
    while (have_posts()) : the_post();

    ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
        // Page thumbnail and title.
        the_title('<header class="entry-header"><h1 class="entry-title">', '</h1></header><!-- .entry-header -->');
    ?>

	<div class="entry-content">
		<?php the_content(); ?>

    <?php
// the query
$wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>100)); ?>

<?php if ($wpb_all_query->have_posts()) : ?>


    <!-- the loop -->
    <?php while ($wpb_all_query->have_posts()) : $wpb_all_query->the_post(); ?>
        <?php get_template_part('template-parts/content-postblock'); ?>
    <?php endwhile; ?>
    <!-- end of the loop -->

    <?php wp_reset_postdata(); ?>

<?php else : ?>
    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

	</div><!-- .entry-content -->
</article><!-- #post-## -->

<?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) {
                        comments_template();
                    }
                endwhile;
            ?>


		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_sidebar('content'); ?>
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
