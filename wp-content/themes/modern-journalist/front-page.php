<?php
    /**
     * Home Page
     *
     * @link https://codex.wordpress.org/Template_Hierarchy
     *
     * @package Modern_Journalist
     */
get_header();?>

<div id="home-header">

<div class="fullsize-video-bg">
	<div class="inner">
		
			
	 		<h1 class="home-title">Reporting on <br>International Affairs</h1>
 <div id="title-header">
		 		
	 		<div class="home-tagline">
	 		<?php
             $description = get_bloginfo('description', 'display');
         		if ($description || is_customize_preview()): ?>
				<div class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></div>
				<?php
                endif;
                ?>
          
               	<div class="button-container">
		 				<div id="home-pause">
		 					<i class="icon-pause"></i>
		 				</div>
		 			</div>
	 			</div>
	 		
			</div><!-- home-tagline-->
		</div><!-- title-header -->
	
	<div id="video-viewport">
		<?php
	    //$home_video_webm = get_option('modernjournalist_video_webm');
	    $home_video_mp4 = get_option('modernjournalist_video_mp4');
	    ?>
		<video width="1920" height="1280" playsinline autoplay muted id="bgvid">
			 <source src="<?php echo esc_html($home_video_mp4);  ?>" type="video/mp4">
			Sorry, your browser does not support this video.
		</video>
	</div>
</div>

</div><!-- home-header-->


<div id="home-aboutProgram">
	<div class="content-wrapper row">
		<div class="aboutBox col-med">
			<div class="col-xs-12">
				<?php
                    $program_desc = get_option('modernjournalist_program_description');

                    echo  stripslashes_deep($program_desc) ;
                ?>
			</div>
		</div><!-- about-box -->
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
	                	$csis_desc = get_option('modernjournalist_csis_description');
	                	echo '<p>' . stripslashes_deep($csis_desc) . '</p>';
	            	?>
				</div>
				<div class="full-col col-md-4">
					<div class="csis-photo">
						<div class="img-container fit-width">

						<?php
                    $csis_img = get_option('modernjournalist_csis_image');

                   
                ?>	
							<img id="" src="<?php  echo  stripslashes_deep($csis_img) ; ?>" alt="GSF event at CSIS" title="GSF event at CSIS" />
						</div>
					</div>
				</div>
			</div>
		</div><!-- aboutCsis -->
	</div><!-- content-wrapper-->
</div><!-- home-aboutCSIS-->


<div id="home-topics">
	<div class="content-wrapper">
		<div class="col-wide">
			<h2 class="heading underline">Featured Story</h2>
		</div>
		<div class="col-wide">
			<?php
	            $feature_post = get_option('modernjournalist_featured_story');
	            if ($feature_post) {
	                global $post;
	                setup_postdata($post);
	                $post   = $feature_post;
	                $postID = $post->ID;

	                $time_string = '<span class="meta-label">Published: </span><time class="entry-date published" datetime="%1$s">%2$s</time>';
	                $time_string = sprintf($time_string,
	                    esc_attr(get_the_date('c')),
	                    esc_html(get_the_date())
	                );

	                echo '<div class="related-posts home-related row">';
	                	echo '<div class="related-post col-xs-12 col-md-4 no-padding">';
	                			echo '<div class="related-post-img"><a href="' . get_permalink($post) . '">';
	                				the_post_thumbnail('medium-large');
	                			echo '</a></div>';

	                	echo '</div>';
	                echo '<div class="related-post related-info col-xs-12 col-md-8">';
	                	echo '<a href="' . get_permalink($post) . '" class=""><h4 class="subheading">';
	                		the_title();
	                	echo '</h4></a>';
	                	
	                	echo '<div class="entry-excerpt">';
	                		the_excerpt();
	                	echo '</div>';
	                	echo '<div class="entry-meta ">';
	                		echo '<p class="meta-line"><span class="meta-label">By: </span>';
	                			$authors = related_authors($post);
	                			echo $authors;
	                		echo '</p>';
	                		echo '<p class="posted-on meta-line">' . $time_string . '</p>'; // WPCS: XSS OK.
	                	echo '</div>';
	                echo '</div></div>';
	               

	            }
	            //modernjournalism_related_content();

	        ?>
			<?php wp_reset_query();?>
		</div><!--col-wide -->
	</div><!-- content-wrapper-->
</div><!-- home-topicsS-->


<div id="home-reports" class="content-wrapper">
	<div class="col-med">
		<div class="blueblock row">
			<div class="col-xs-8 col-md-10">
				<div class="browseReports">
					<h3 class="subheading darkbg">
						<a href="/feature-stories">Browse Stories<i class="icon-arrow-long-right"></i></a>
					</h3>
					<p>Explore the completed multimedia stories.</p>
				</div><!-- browse-reports -->
			</div>
			<div class="col-xs-4 col-md-2 no-padding">
				<div class="img-container fit-height">

					<?php
                    $browse_img = get_option('modernjournalist_browse_image');
                ?>	

					<?php
		                $imgSrc = stripslashes_deep($browse_img); 
		                //$imgID = 'pippin_get_image_id($imgSrc)';
		                $output = '<img src="' . $imgSrc . '" alt="International Globe">';
		                echo $output;
		            ?>
				</div>
			</div>
		</div><!-- blueblock -->
	</div><!-- col-med-->
	<div class="vertical-left">INTERACTIVE <span>/</span> LONGFORM</div>
</div><!--home-reports -->

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
			</div><!--testimonial-button-container -->
		</div><!--row -->
	</div><!-- testimonials-header -->
	<div class="row">
		<div class="carousel-wrap">
			<ul id="testimonial-list" class="clearfix">
			<?php
                $count = 0;
                $args  = array(
                    'post_type'  => 'testimonials',
                    'meta_query' => array(
                        array(
                            'key'     => '_testimonial_is_featured',
                            'value'   => '1',
                            'compare' => '==',
                        ),
                    ),

                );
                $the_query = new WP_Query($args);

                $postcount = $the_query->post_count;

                if ($the_query->have_posts()): while ($the_query->have_posts()): $the_query->the_post();
                    ?>

					<li data-count="<?php echo $count++; ?>">
						<div class="testimonial">
							<?php
                                $date = get_post_meta($post->ID, '_testimonials_date', true
                                );
                                $institution = get_post_meta($post->ID, '_testimonials_institution', true
                                );
                                $role = get_post_meta($post->ID, '_testimonials_role', true
                                );
                            ?>
							<div class="testimonial-quote"><?php the_content()?></div>

							<div class="testimonial-name"><?php the_title();?></div>
							<div class="testimonial-info"><?php echo $role?>, <?php echo $institution ?></div>
							<div class="testimonial-date"><?php echo $date ?></div>
						</div>
					</li>
						<?php endwhile;endif;?>
					<?php wp_reset_query();?>
			</ul>
		</div><!-- carousel-wrap -->
	</div><!-- row -->
</div><!-- home-testimonials-->


</main><!-- #content -->
<?php get_footer();?>
</div><!-- #page -->
</body>
</html>
