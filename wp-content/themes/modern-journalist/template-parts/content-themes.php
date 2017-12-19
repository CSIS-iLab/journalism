<?php
/**
 * Template part for displaying theme archive
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Modern_Journalist
 */


$dates = get_post_meta( $post->ID, '_themes_dates', true
 );
$institution = get_post_meta( $post->ID, '_themes_institution', true
 );
 $faculty = get_post_meta( $post->ID, '_themes_faculty', true
 );
 $students = get_post_meta( $post->ID, '_themes_students', true
 );
 $partners = get_post_meta( $post->ID, '_themes_partners', true
 );
$count ++;

$num_padded = sprintf("%02d", $count);
 ?>


<article id="post-<?php the_ID(); ?>">
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
    		<div class="col-xs-12 col-md-8">
            	<?php the_content(); ?>

            	<div class="theme-gallery row">
            	
				<?php 
				$galleryArray = get_post_gallery_ids($post->ID); 

	 			foreach ($galleryArray as $id) { 
			 	$attachment_title = get_the_title($id)

			 	//$attachment_description = get_the_excerpt($id)
			 	?>
			 	<div class="photo-entry">
			 		<div class="gallery-photo">
	    				<img src="<?php echo wp_get_attachment_url( $id ); ?>">
	    			</div>
	    			<div class="photo-details">
						<?php echo $attachment_title; 
						//echo $attachment_description; 
						?>
					</div>
				</div>
					<?php
					}?>
				</div>
				<div>
				         <div class="substance-partners">
				         	<?php echo $partners ?>
				         </div>
					</div>
			</div>

			<div class="col-xs-12 col-md-4 entry-meta">
	        	<div class="">
	        
			        <div class="entry-meta-top">
			        	<div>
			        		<span class="meta-label">Dates: </span>
			        	</div>
			        	<div>
			        		<?php echo $dates ?>	
			        	</div>
			        </div>

			        <div class="clearfix"></div>
			        
			        <div class="entry-meta-top">
			         	<div>
			         		<span class="meta-label">Institution: </span>
			         	</div>
			         	<div>
			         		<?php echo $institution ?>
			         	</div>
			         </div>

			         <div class="clearfix"></div>

			         <div class="entry-meta-top">
			         	<div>
			         		<span class="meta-label">Faculty Advisor: </span>
			         	</div>
			         	<div>
			         		<?php echo $faculty ?>
			         	</div>
			         </div>

			         <div class="clearfix"></div>

			         <div class="entry-meta-bottom">
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
		<div class="related-posts row"
          <?php
    global $related;
    $rel = $related->show( get_the_ID(), true );

    // Display the title and excerpt of each related post
    if( is_array( $rel ) && count( $rel ) > 0 ) {
        foreach ( $rel as $r ) {
            if ( is_object( $r ) ) {
                if ($r->post_status != 'trash') {
                    setup_postdata( $r );
                    echo '<div class="related-post col-xs-12">';
       
			        
			       echo '<div class="related-post-img col-md-3"><a href="' . esc_url( get_permalink($r->ID) ) . '">'. get_the_post_thumbnail( $r->ID  ).'</a></div>';
			        
			    
			     echo '<div class="related-post-content col-xs-12 col-md-9">';
                    echo '<h3 class="entry-title"><a href="' . esc_url( get_permalink($r->ID) ) . '"> '.get_the_title( $r->ID ) . '<i class="icon-arrow-long-right"></i></a></h3>';
                    the_excerpt();
                     echo '</div></div>';
                };
            }
        }
        wp_reset_postdata();
    }

?>
<div class="vertical-left">
			FINAL PROJECT
		</div>
	</div>
</footer><!-- .entry-footer -->
    

</article><!-- #post-<?php the_ID(); ?> -->
