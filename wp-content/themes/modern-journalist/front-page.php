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
		
	 		<div class="button-container"><div id="home-pause"><i class="icon-pause"></i></div></div>
	 	</div>
	 	<img id="homepage-title" src="<?php echo get_template_directory_uri(); ?>/img/homepage_title.svg" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" />
	 	
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
				<h2 class="heading underline">Themes</h2>
			</div>
		<div class="col-xs-12 col-md-8">
			<p>In hac habitasse platea dictumst. Vivamus adipiscing fermentum quam volutpat aliquam. Integer et elit eget elit facilisis tristique. In hac habitasse platea dictumst. Vivamus adipiscing fermentum quam volutpat aliquam. Integer et elit eget elit facilisis tristique.</p>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="content-wrapper row">
		<div class="col-med">
		<div class="col-xs-12">
		</div>
		<?php 
		$args = array( 
		'post_type' => 'themes',
		);
		$the_query = new WP_Query( $args );
		?>
		<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<h4 class="subheading"><?php the_title(); ?></h4>
		<div class="theme-description"><?php the_content() ?></div>
		<?php modernjournalism_related_content(); ?>
</section>
		</div>
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
			<h3 class="subheading">Browse Reports</h3>
			<p>In hac habitasse platea dictumst. Vivamus adipiscing fermentum quam volutpat aliquam. Integer et elit eget elit facilisis tristique.</p>
		</div>
	</div>
	<div class="col-xs-4 col-md-2 "> 
		<div class="img-container fit-height">
		
			<img src="<?php echo get_template_directory_uri(); ?>/img/center-for-strategic-and-international-studies-office.jpg" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" />
	</div>
	</div>
</div>
</div>
</div><!-- home-reports-->

<div id="home-testimonials">
	<div class="content-wrapper">
	</div><!-- content-wrapper-->
</div><!-- home-testimonials-->

<div id="home-footer">
	<div class="content-wrapper">
		<div class="row">
		<div class=" col-md-4 ">
			<div class="home-footer-photo">
			<div class="img-container fit-height">
				<img id="" src="<?php echo get_template_directory_uri(); ?>/img/center-for-strategic-and-international-studies-office.jpg" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" />
			</div>
		</div>
	</div>
		
				<div class="col-md-8"> 
		<div class="learnMore">
			<div class="learn-header">
				<span class="large-title">Learn more</span>
			</div>
			<div class="learn-content row">
				<div class="col-xs-12 col-md-8"> 
			<p>In hac habitasse platea dictumst. Vivamus adipiscing fermentum quam volutpat aliquam. Integer et elit eget elit facilisis tristique. In hac habitasse platea dictumst. Vivamus adipiscing fermentum quam volutpat aliquam. Integer et elit eget elit facilisis tristique.</p>
				</div>
				<div class="col-xs-12 col-md-4">
			<p><span class="meta-label">Phone: </span>
				<?php
				$phone = get_option( 'modernjournalist_phone' );
				echo '<p>' . $phone . '</p>';
				?></p>
			<p><span class="meta-label">Email: </span>
				<?php
				$email = get_option( 'modernjournalist_email' );
				echo '<p>' . $email . '</p>';
				?></p>
				</div>
			</div>
		</div>
	</div>
		</div>
	</div><!-- content-wrapper-->
</div><!-- home-footer-->





	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();