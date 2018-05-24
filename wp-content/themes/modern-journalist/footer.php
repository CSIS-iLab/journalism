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

<footer id="home-footer" class="site-footer">
	<div class="content-wrapper">
		<div class="row">
			<div class=" col-md-4 footer-image">
				<div class="home-footer-photo">
					<div class="img-container fit-height">
						<img id="" src="/wp-content/themes/modern-journalist/img/center-for-strategic-and-international-studies-office.jpg" alt="<?php bloginfo('name');?>" title="<?php bloginfo('name');?>" />
					</div>
				</div>
			</div>

		<div class="col-md-8 footer-info">
			<div class="learnMore">
				<div class="learn-header">
					<div class="footer-csis">
						<a href="https://www.csis.org/" alt="Center for Strategic and International Studies" title="Center for Strategic and International Studies"><img src="/wp-content/themes/modern-journalist/img/csis_logo_white.svg" alt="CSIS" title="<?php bloginfo('name');?>"></a>
					</div>
				</div>
				<div class="learn-content row">
					<div class="col-xs-12 col-md-8">

				<?php
                    $learn_more = get_option('modernjournalist_footer_description');
                    echo '<p class="learn-more-text">' . $learn_more . '</p>';
                ?>

					</div>
					<div class="col-xs-12 col-md-4">
						<div class="contact-info">
							<div><span class="meta-label"><i class="icon-mail"></i></span>
							</div>
									<?php
					                    $email = get_option('modernjournalist_email');
					                    if ($email) {
					                        echo '<div class="meta-info"><a href="mailto:' . esc_attr($email) . '?subject=' . esc_attr(get_bloginfo('name')) . '">' . $email . '</a></div>';
					                    }
					                ?>
							</div>
							<div class="contact-info">
								<div><span class="meta-label"><i class="icon-location"></i></span></div>
								<div class="meta-info">1616 Rhode Island Ave., NW <br> Washington, DC 20036</div>
							</div>

						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-md-6">
						</div>
						<div class="col-xs-12 col-med-6">
							<ul class="socialContainer">
								<li class="follow-text">FOLLOW US</li>

							<?php

                                $facebook = get_option('modernjournalist_facebook');

                                $twitter = get_option('modernjournalist_twitter');

                                $linkedin = get_option('modernjournalist_linkedin');

                                $youtube = get_option('modernjournalist_youtube');

                                $instagram = get_option('modernjournalist_instagram');

                                if ($facebook) {
                                    echo '<li><a href="https://www.facebook.com/' . $facebook . '" target="_blank"><i class="icon icon-facebook"></i> </a></li>';
                            }?>
								<?php if ($twitter) {
								        echo '<li><a href="https://www.twitter.com/' . $twitter . '" target="_blank"><i class="icon icon-twitter"></i></a></li>';
								}?>
								<?php if ($linkedin) {
								        echo '<li><a href="https://www.linkedin.com/company/' . $linkedin . '" target="_blank"><i class="icon icon-linkedin"></i></a></li>';
								}?>
								<?php if ($youtube) {
								        echo '<li><a href="https://www.youtube.com/user/' . $youtube . '" target="_blank"><i class="icon icon-youtube"></i> </a></li>';
								}?>
								<?php if ($instagram) {
								        echo '<li><a href="https://www.instagram.com/' . $instagram . '" target="_blank"><i class="icon icon-instagram"></i></a></li>';
								}?>

							</ul><!-- .nav-socialContainer -->
						</div>
	    			</div><!-- header-bottom -->
				</div>
			</div>
		</div><!-- row-->
	</div><!-- content-wrapper-->

	<div class="site-credit">
		<div class="content-wrapper">
			©<?php echo date('Y'); ?> by the Center for Strategic and International Studies. All rights reserved. | <a style="color: #A7B3B6;" href="https://www.csis.org/privacy-policy" target="_blank" rel="nofollow" alt="Privacy Policy" title="Privacy Policy">Privacy Policy</a>
		</div><!-- .site-info -->
	</div>
</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer();?> 

</body>
</html>
