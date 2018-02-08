<?php
	/**
	 * Template part for displaying theme archive
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package Modern_Journalist
	 */
	$dates = get_post_meta($post->ID, '_themes_dates', true
	);
	$institution = get_post_meta($post->ID, '_themes_institution', true
	);
	$faculty = get_post_meta($post->ID, '_themes_faculty', true
	);
	$students = get_post_meta($post->ID, '_themes_students', true
	);
	$partners = get_post_meta($post->ID, '_themes_partners', true
	);

	//$index = $wp_query->current_post + 1;

	$num_padded = sprintf("%02d", $count);
?>


<article id="post-<?php the_ID();?>">
	<div class="archive-entry col-wide">
		<div class="row">
			<div class="col-xs-12 entry-header">
				<?php
				  the_title('<h3 class="entry-title"><span>' . $num_padded . '</span> ', '</h3>');
				?>
			</div>
		</div>
		<div class="entry-content-container">
			<div class="entry-content row">
				<div class="col-xs-12 col-md-8 theme-content">
					<?php the_content();?>
					<div>
					 	<div class="substance-partners">
							<?php echo $partners ?>
					 	</div>
					</div>
						<div class="theme-gallery">

						<?php
						$galleryArray = get_post_gallery_ids($post->ID);

						foreach ($galleryArray as $id) {
						$attachment_title = get_the_title($id)

						//$attachment_description = get_the_excerpt($id)
						?>
						<div class="photo-entry">
							<div class="gallery">
								<a href="<?php echo wp_get_attachment_url($id) ?>" rel='lightbox'>
								<img src="<?php echo wp_get_attachment_thumb_url($id) ?>">

								</a>
							</div>
							<div class="photo-details">
								<?php echo $attachment_title;
									//echo $attachment_description;
				 				?>
							</div>
						</div>
					<?php
					}?>
					</div><!-- theme-gallery -->
				</div><!-- theme-content -->


				<div class="col-xs-12 col-md-4 entry-meta">
					<div>

						<div class="entry-meta-top">
							<div>
							<span class="meta-label">Date: </span>
						</div>
							<div>
								<?php echo $dates ?>
							</div>
						</div>

						<div class="clearfix"></div>
						<div class="entry-meta-top">
							<div class="meta-inline"><span class="meta-label meta-inline">Institution: </span>
								<?php echo $institution ?>
							</div>
			 			</div>

			 			<div class="clearfix"></div>

			 			<div class="entry-meta-bottom">
							<div class="meta-inline"><span class="meta-label meta-inline">Faculty Advisor: </span>
								<?php echo $faculty ?>
							</div>
			 			</div>

				 		<div class="clearfix"></div>

				 			<div>
								<div>
									<span class="meta-label">Students: </span>
								</div>
								<div>
									<?php echo $students ?>
								</div>
					 		</div>
				 		<div class="clearfix"></div>
					</div>
				</div><!-- .entry-meta -->
			</div><!-- .entry-content -->
		</div><!-- .entry-content-container -->
		<footer class="entry-footer col-xs-12 ">
			<div class="related-posts row">
 				<?php
				global $related;
				$rel = $related->show(get_the_ID(), true);

				// Display the title and excerpt of each related post
				if (is_array($rel) && count($rel) > 0) {
		  			foreach ($rel as $r) {
					  if (is_object($r)) {
						  if ($r->post_status != 'trash') {
							  setup_postdata($r);
							  echo '<div class="related-post ">';

							  echo '<div class="related-post-img col-md-4">

							  		<a href="' . esc_url(get_permalink($r->ID)) . '"><div class="img-container fit-width">' . get_the_post_thumbnail($r->ID) . '	  </div></a>
						</div>';

							  echo '<div class="related-post-content col-xs-12 col-md-8">';
							  echo '<h3 class="entry-title"><a href="' . esc_url(get_permalink($r->ID)) . '"> ' . get_the_title($r->ID) . '<i class="icon-arrow-long-right"></i></a></h3>';
							  
							  $post    = get_post($r->ID);
							  $excerpt = get_the_excerpt();
							  echo $excerpt;
							  echo '</div></div>';
						  };
					  }
		  			}
		  			wp_reset_postdata();
	  			}

  				?>
		
		</div>
			<div class="vertical-left">FINAL PROJECT</div>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID();?> -->
