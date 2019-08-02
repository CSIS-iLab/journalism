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

			<section id="myCarousel"
			         class="carousel slide"
			         aria-roledescription="carousel"
			         aria-label="Highlighted television shows">
			  <button class="pause">
			    Stop Carousel
			  </button>
			  <div class="carousel-inner">
			    <a class="previous carousel-control"
			       role="button"
			       tabindex="0"
			       aria-controls="myCarousel-items"
			       aria-label="Previous Slide">
			      <svg width="32"
			           height="32"
			           version="1.1"
			           xmlns="http://www.w3.org/2000/svg">
			        <path xmlns="http://www.w3.org/2000/svg" d="M15.5,8l8-8,.5.5.5.5L22,3.5l-7.4,7.4c-2.7,2.8-4.9,5.1-5,5.1s3.4,3.4,7.5,7.5L24.5,31l-.5.5-.5.5-8-8-8-8Z" transform="translate(-7.5)" stroke="black"
							fill="black"/>
			      </svg>
			    </a>
			    <a class="next carousel-control"
			       role="button"
			       tabindex="0"
			       aria-controls="myCarousel-items"
			       aria-label="Next Slide">
			      <svg width="32"
			           height="32"
			           version="1.1"
			           xmlns="http://www.w3.org/2000/svg">
								 <path xmlns="http://www.w3.org/2000/svg" d="M15.5,8l8-8,.5.5.5.5L22,3.5l-7.4,7.4c-2.7,2.8-4.9,5.1-5,5.1s3.4,3.4,7.5,7.5L24.5,31l-.5.5-.5.5-8-8-8-8Z"  transform="rotate(180), translate(-32 -32)"  stroke="black"
	 							fill="black"/>
			      </svg>
			    </a>
			    <div id="myCarousel-items"
			         class="carousel-items"
			         aria-live="off">
					<?php
					$args = array(
					    'orderby' => 'date',
					    'post_type' => 'testimonial',
					    'posts_per_page' => 3
					);
					$the_query = new WP_Query( $args );
					?>
					<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
					$index = ($wp_query->current_post ++) + 1;

					 	$name = get_post_meta( get_the_ID(), 'jourblocks_meta_testimonial_name', true );
						$institution = get_post_meta( get_the_ID(), 'jourblocks_meta_testimonial_institution', true );
						$date = get_post_meta( get_the_ID(), 'jourblocks_meta_testimonial_date', true );

					?>
						<div class="carousel-item <?php if ($index == 1){	echo 'active'; };
						 ?>"
			           role="group"
			           aria-roledescription="slide"
			           aria-label="<?php echo $index; ?> of 6">

								<blockquote class="testimonials">
									<p class="testimonial-content">
										<?php the_content(); ?>
									</p>

									<div class="testimonial-caption home-testimonials__info">
										<?php echo esc_attr($name); ?><br /> <span><?php echo esc_attr($institution); ?>, <?php echo esc_attr($date); ?></span>
									</div>

								</blockquote>

			        <!-- .carousel-caption -->
			      </div>
					<?php endwhile; else: ?> <p>Sorry, there are no posts to display</p> <?php endif; ?>
					<?php wp_reset_query(); ?>

  </div>
			  </div>
			  <!-- carousel-inner -->
			</section>
			<!-- /.carousel -->



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
