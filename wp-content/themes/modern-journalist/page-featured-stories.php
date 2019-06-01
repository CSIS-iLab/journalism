<?php
/*
Template Name: Featured Stories
*/
get_header(); ?>

<div id="primary" class="site-content">
<main id="content" role="main">

<?php while ( have_posts() ) : the_post(); ?>

<h1 class="entry-title"><?php the_title(); ?></h1>

<div class="featured-stories">
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

<?php
                endwhile;
            ?>


		</main><!-- #content -->
	</div><!-- #primary -->


<?php
get_footer();
