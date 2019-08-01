<?php
/**
 * Home Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Modern Journalist
 */

get_header();

$site_title = get_bloginfo( 'name' );
$site_url = network_site_url( '/' );
$site_tagline = get_bloginfo( 'description' );

$modern_journalist_hero = get_option('modern_journalist_homepage_hero');
$modern_journalist_testimonialimage = get_option('modern_journalist_homepage_testimonialimg');

$modern_journalist_intro = get_option('modern_journalist_homepage_intro');
$csis_desc = get_option('modern_journalist_homepage_csis');
$feature_post1 = get_option('modern_journalist_homepage_featured_post_1');
$feature_post2 = get_option('modern_journalist_homepage_featured_post_2');
$feature_post3 = get_option('modern_journalist_homepage_featured_post_3');
$testimonial1 = get_option('modern_journalist_homepage_testimonal_1');
$testimonial2 = get_option('modern_journalist_homepage_testimonal_2');
$testimonial3 = get_option('modern_journalist_homepage_testimonal_3');
?>

<div id="primary" class="site-content">
<div id="content" role="main">

		<header class="home-hero">
			<div id="home-hero__vid-container">
				<video class="home-hero__vid" autoplay="" loop="" muted="">
					<source src="<?php echo esc_attr($modern_journalist_hero) ?>" type="video/mp4" alt="CSIS Journalism Bootcamp Video Roll">
				</video>
			</div>
			<div class="home-hero__site-info">
				<h1 class="home-hero__title">
					CSIS Journalism Bootcamp
				</h1>
				<?php
					if ($site_tagline) {
				?><div class="home-hero__tagline">
					<?php echo esc_attr($site_tagline) ?>
				</div>
			<?php } ?>
			</div>
		</header>

		<section class="home-about">
			<div class="home-about_program bigp">
				<?php echo '<p>' . stripslashes_deep($modern_journalist_intro) . '</p>'; ?>
			</div>
			<div class="home-about_csis">
				<h3>About CSIS</h3>
				<?php echo '<p>' . stripslashes_deep($csis_desc) . '</p>'; ?>
				<a href="https://www.csis.org/" class="inline-link" alt="Visit the CSIS homepage">Visit us at CSIS.org</a>
			</div>

		</section><!-- about the program-->

		<section class="home-feature">
			<h2 class="home-heading">Featured Stories</h2>
			<div class="home-feature_container">
				<div class="home-feature_main">
					<article>
						<?php
            // Featured Item
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
					</article>
				</div><!-- featured post main -->
				<div class="home-feature_sidebar">
<h3 class="home-subheading">Previous Projects</h3>
<div class="featured-sidebar-articles">
						<?php
						// Featured Item
						if ($feature_post2 || $feature_post3) {
								$featuredPostArgs = array(
								    'post__in' => array(
								        $feature_post2, $feature_post3
								    ),
								    'orderby' => 'post__in',
								    'posts_per_page' => 2
								);
								$featured_post = get_posts($featuredPostArgs);

								foreach ($featured_post as $post) : setup_postdata($post);
								$post->isFeaturedMain = 1;
								echo '<article>';
								$meta_date = get_post_meta(get_the_ID(), 'jourblocks_meta_date', true);
								if ($meta_date) {
										echo '<div class="post__date">' . esc_attr($meta_date) . '</div>';
								}
								the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
								echo '</article>';
								endforeach;
								wp_reset_postdata();
						}
					?>
				</div>
					<div class="blue-btn"><a href="/feature-stories" title="Feature Stories">Browse all stories</a></div>
				</div><!-- featured post sidebar -->
			</div><!-- featured post container -->
		</section><!-- featured post section -->

    <section class="home-testimonials">
<div class="home-testimonial__container">
			<h2 class="home-heading">What are they saying?</h2>

				<?php
						$featuredTestimonialArgs = array(
						    'post_type' => 'testimonial',
						    'post__in' => array(
						        $testimonial1, $testimonial2, $testimonial3
						    ),
						    'orderby' => 'post__in',
						    'posts_per_page' => 3
						);
						$featured_testimonial = get_posts($featuredTestimonialArgs);
						foreach($featured_testimonial as $post) : setup_postdata($post);
						$meta_name = get_post_meta(get_the_ID(), 'jourblocks_meta_testimonial_name', true);
		        $meta_institution = get_post_meta(get_the_ID(), 'jourblocks_meta_testimonial_institution', true);
						$meta_date = get_post_meta(get_the_ID(), 'jourblocks_meta_testimonial_date', true);

							echo '<article class="home-testimonials__single">';

							the_content();
							echo '<div class="home-testimonials__info">';
							if ($meta_name) {
			            echo'<span>' . esc_attr($meta_name) . '</span>';
			        }
			        if ($meta_institution) {
			            echo ', ' . esc_attr($meta_institution);
			        }
							if ($meta_date) {
			            echo ', ' . esc_attr($meta_date);
			        }
							echo '</div>';
							echo '</article>';
						endforeach;
						wp_reset_postdata();
					?>
</div>

<div class="testimonial-img">
			<img  class="home-testimonial-image" src="<?php echo esc_attr($modern_journalist_testimonialimage) ?>" ></div>
				<?php
				$imgid = attachment_url_to_postid( $modern_journalist_testimonialimage );
				echo '<div class="home-testimonial-caption caption"><figcaption>' . wp_get_attachment_caption( $imgid ) . '</figcaption></div>';
				 ?>

		</section><!-- testimonial section -->
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
