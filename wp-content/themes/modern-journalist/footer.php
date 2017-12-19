<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Modern_Journalist
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="content-wrapper">
			<div class="site-info">
			<div class="row">
				<div class="col-xs-12 col-md-8">
					<?php
					$footerdesc = get_option( 'modernjournalist_footer_description' );
					echo  $footerdesc ;
					?>
				</div>
				<div class="col-xs-12 col-md-4">
					<div class="contact-info">
						<div>
							<span class="meta-label"><i class="icon-mail"></i></span>
						</div>
						<?php
						$email = get_option( 'modernjournalist_email' );
						echo '<div>' . $email . '</div>';
						?>
					</div>
					<div class="contact-info">
						<div>
							<span class="meta-label"><i class="icon-location"></i></span>
						</div>
						<div>1616 Rhode Island Ave., NW <br> Washington, DC 20036</div>
					</div>
				
				</div>
			</div>
		</div>
	</div>
		<div class="site-credit">
			<div class="content-wrapper">
			© 2017 by the Center for Strategic and International Studies. All rights reserved.
		</div><!-- .site-info -->
	</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>


</body>
</html>
