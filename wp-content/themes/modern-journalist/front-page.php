<?php
/**
 * Home Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Modern_Journalist
 */


get_header(); ?>

<div id="home-header">
	<div id="vid-block">
		<video playsinline autoplay muted poster="#" id="bgvid">
		    <source src="#" type="video/webm">
		    <source src="http://csisjournalism.staging.wpengine.com/wp-content/uploads/2017/12/press_sec_podium.mp4" type="video/mp4">
		</video>
</div>

<div id="home-intro">

	<div id="vid-overlay">
		<div id="title-header">
		
	 		<div class="button-container">
	 			<div id="home-pause">
	 				<i class="icon-pause"></i>
	 			</div>
	 		</div>
	 	</div>
	 	<img id="homepage-title" src="<?php echo get_template_directory_uri(); ?>/img/homepage_title_lg.svg" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" />
	 	
	 	<div class="home-tagline">
	 	<?php
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
					<?php
					endif;
					?>
		</div><!-- home-tagline-->
	
	</div><!-- content-wrapper-->
</div><!-- home-intro-->
</div><!-- home-header-->
<div id="home-aboutProgram">
	<div class="content-wrapper row">
		<div class="aboutBox col-med">
			<div class="col-xs-12">
				<?php
				$program_desc = get_option( 'modernjournalist_program_description' );
				echo '<p>' . $program_desc . '</p>'; 
				?>
			</div>
					
		</div>
		<div class="vertical-right">
			CSIS <span>&#8212</span>  EXECUTIVE EDUCATION
		</div>
	</div><!-- content-wrapper-->
</div><!-- home-aboutProgram-->

<div id="home-aboutCSIS">
	<div class="content-wrapper">
		<div class="col-med aboutCsis ">
			<div class="row">
		<div class="col-xs-12 col-md-8 ">
			<h4 class="subheading">About CSIS</h4>
			<?php
				$csis_desc = get_option( 'modernjournalist_csis_description' );
				echo '<p>' . $csis_desc . '</p>';
				?>
		</div>
		<div class="full-col col-md-4">
			<div class="csis-photo">
				<div class="img-container fit-width">
				<img id="" src="<?php echo get_template_directory_uri(); ?>/img/center-for-strategic-and-international-studies-office.jpg" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" />
			</div>
			</div>
		</div>
		</div>
	</div>
	</div><!-- content-wrapper-->
</div><!-- home-aboutCSIS-->


<div id="home-topics">
	<div class="content-wrapper">
		<div class="col-wide row">
			<div class="col-xs-12">
				<h2 class="heading underline">Featured Story</h2>
			</div>
		<div class="col-xs-12 col-md-8">
			<?php
				$stories_desc = get_option( 'modernjournalist_stories_description' );
				
				?>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="content-wrapper row">
		<div class="col-med">

		<?php 
		$args = array( 
		'post_type' => 'themes',
		);
		$the_query = new WP_Query( $args );
		?>
		
		<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>


		<?php modernjournalism_related_content(); ?>
		


	
		<?php endwhile; else: ?> <p>Sorry, there are no posts to display</p> <?php endif; ?>
		<?php wp_reset_query(); ?>
	
</div>
	</div>
	</div><!-- content-wrapper-->
</div><!-- home-topicsS-->	


<div id="home-reports" class="content-wrapper">
	<div class="col-med">
	<div class="blueblock row">
		<div class="col-xs-8 col-md-10">
			<div class="browseReports">
			<h3 class="subheading">Browse Reports<i class="icon-arrow-long-right"></i></h3>
			<p>In hac habitasse platea dictumst volutpat aliquam.</p>
		</div>
	</div>
	<div class="col-xs-4 col-md-2 no-padding"> 
		<div class="img-container fit-width">
		
			<img src="<?php echo get_template_directory_uri(); ?>/img/center-for-strategic-and-international-studies-office.jpg" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" />
	</div>
	</div>
</div>
</div>
<div class="vertical-left">
			IN-DEPTH <span>&</span> INTERACTIVE LONGFORM 
		</div>
</div><!-- home-reports-->

<div id="home-testimonials">
	<div class="content-wrapper testimonials-header">
		<h2 class="heading">What they're saying</h2>
		<div class="row">
			<div class="testimonial-button-container">
			<div class="testimonial-button button-prev">
				<i class="icon-arrow-long-left"></i>
			</div>
			<div class="testimonial-button button-next">
				<i class="icon-arrow-long-right"></i>
			</div>
</div>
		</div>
	</div>
	<div class="row">
		<div class="carousel-wrap">
			<ul id="testimonial-list" class="clearfix">
			<?php 
			$count = 0;
		$args = array( 
		'post_type' => 'testimonials',
		);
		$the_query = new WP_Query( $args );
		?>
		
		<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); 
			?>
	<li data-count="<?php echo $count ++; ?>"> 
		<div class="testimonial">
		<?php

		 $date = get_post_meta( $post->ID, '_testimonials_date', true
		 );
		$institution = get_post_meta( $post->ID, '_testimonials_institution', true
		 );
		 $role = get_post_meta( $post->ID, '_testimonials_role', true
		 );
		 ?>
		<div class="testimonial-quote"><?php the_content() ?></div>

		<div class="testimonial-name"><?php the_title(); ?></div>
		<div class="testimonial-info"><?php echo $role ?>, <?php echo $institution ?></div>
		<div class="testimonial-date"><?php echo $date ?></div>
	</div>
	</li>
		<?php endwhile; endif; ?>
		<?php wp_reset_query(); ?>
			</ul>
		</div>
	</div>
</div><!-- home-testimonials-->






	</main><!-- #main -->



</div><!-- #primary -->
<?php get_footer(); ?>



</body>
</html>
