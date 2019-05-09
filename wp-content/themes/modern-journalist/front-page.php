<?php
/**
 * Home Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Modern Journalist
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main content-wrapper" role="main">

		<section class="home-hero">
		<?php
		$modern_journalist_intro = get_option('modern_journalist_homepage_intro');
		   echo '<p>' . $modern_journalist_intro . '</p>';
		?>
		</section><!-- about the program-->

		<section class="home-csis">
			<?php
			$csis_desc = get_option('modern_journalist_homepage_csis');
			  echo '<p>' . $csis_desc . '</p>';
			?>
		</section><!-- about csis section-->

		<section class="home-feature">
			<?php
            // Featured Item
            $feature_post1 = get_option('modern_journalist_homepage_featured_post_1');
            if ($feature_post1) {
                $featuredPostArgs = array(
                    'post__in' => array(
                        $feature_post1
                    ),
                    'orderby' => 'post__in',
                    'posts_per_page' => 1
                );
                $featured_post = get_posts($featuredPostArgs);

                foreach ($featured_post as $post) : setup_postdata($post);
                $post->isFeaturedMain = 1;
                get_template_part('template-parts/content-postblock');
                endforeach;
                wp_reset_postdata();
            }
        ?>
		</section><!-- featured post section -->

    <section class="home-testimonials">
			<?php
			$args = array(
			    'post_type'      => 'testimonial',
			    'posts_per_page' => -1,
			    'post_status'    => 'publish',
			    'meta_key'     => 'jourblocks_meta_testimonial_show',
			);
			$the_query = new WP_Query($args);
			?>
			<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
			<div class="testimonial-container">
				<div class="testimonial-content"><?php the_content() ;?></div>
					<div class="testimonial-meta">
					<?php
					$meta_name = get_post_meta(get_the_ID(), 'jourblocks_meta_testimonial_name', true);
					$meta_institution = get_post_meta(get_the_ID(), 'jourblocks_meta_testimonial_institution', true);
					$meta_date = get_post_meta(get_the_ID(), 'jourblocks_meta_testimonial_date', true);
					echo '<p>' . $meta_name . '</p>';
					echo '<p>' . $meta_institution . '</p>';
					echo '<p>' . $meta_date . '</p>';

					?>
				</div>
				</div>
			<?php endwhile; else: ?> <p>Sorry, there are no testimonials to display.</p> <?php endif; ?>
			<?php wp_reset_query(); ?>

		</section><!-- testimonial section -->

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
