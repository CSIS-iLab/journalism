<?php
/**
 * Post Footer
 *
 * @package Aerospace
 */
?>
<div id="the-authors">
<h2 class="heading underline">Authors</h2>
<p class="meta-line">
				<?php
				    global $related_du;
				    $rel = $related_du->show( get_the_ID(), true );

				    // Display the title and excerpt of each related post
				    if( is_array( $rel ) && count( $rel ) > 0 ) {
				    	$a = 0;
				        foreach ( $rel as $r ) {
				            if ( is_object( $r ) ) {
				                if ($r->post_status != 'trash') {
				                	$a++;
				                    setup_postdata( $r );

				                    $name = get_the_title( $r->ID);
				                    $bio = get_the_content( $r->ID);
				                    $pic = get_the_post_thumbnail( $r->ID, 'thumbnail' );

				                    echo '<div class="author-list row">';
				                    	
				                     echo '<div class=" col-xs-12 col-md-2"><div class="author-img"><a href="' . esc_url( get_permalink($r->ID) ) . '">'. $pic .'</a></div></div>';
				                 
				                     echo '<div class="col-xs-12 col-md-10">';
				                    echo '<div class="author-name">';
				                    echo '<h4 class="subheading" >' . $name . '</h4>';
				                    echo '</div>';
				                    echo $bio;
				                    echo '</div>';
				                   echo '</div>';
				               	
				                };
				            }
				        }
				        wp_reset_postdata();
				    }

				?>

			</p>
</div>