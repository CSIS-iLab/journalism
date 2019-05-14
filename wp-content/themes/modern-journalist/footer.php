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
 $meta_description = get_option('modern_journalist_description');
  $meta_image = get_option('modern_journalist_footer_image');
 $meta_email = get_option('modern_journalist_email');
 $meta_facebook = get_option('modern_journalist_facebook');
 $meta_twitter = get_option('modern_journalist_twitter');
 $meta_linkedin= get_option('modern_journalist_linkedin');
 $meta_youtube = get_option('modern_journalist_youtube');
 $meta_instagram = get_option('modern_journalist_instagram');
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
    <div class="site-footer-container">
		<div class="footer__info">
      <div class="footer__csis-logo">
  			<a href="<?php echo esc_url( __( 'https://csis.org/', 'modern-journalist' ) ); ?>">
          <img src="<?php echo get_template_directory_uri(); ?>/img/csis_logo_white.svg" /></a>
  			</a>
      </div>
      <div class="footer__csis-about">
  			<p><?php echo stripslashes_deep($meta_description) ?></p>
      </div>
	  </div><!-- .footer__info -->
    <div class="footer__contact">
      <div>
      <div class="footer__follow">
        <span>Follow Us</span>
        <div class="footer__follow-icon">
          <a href="<?php echo esc_url( $meta_facebook); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/icon-facebook.svg" /></a>
        </div>
        <div class="footer__follow-icon">
          <a href="<?php echo esc_url( $meta_twitter); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/icon-twitter.svg" /></a>
        </div>
        <div class="footer__follow-icon">
          <a href="<?php echo esc_url( $meta_linkedin); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/icon-linkedin.svg" /></a>
        </div>
        <div class="footer__follow-icon">
          <a href="<?php echo esc_url( $meta_youtube); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/icon-youtube.svg" /></a>
        </div>
        <div class="footer__follow-icon">
          <a href="<?php echo esc_url( $meta_instagram); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/icon-instagram.svg" /></a>
        </div>
      </div>
      <div class="footer__contact-info">
        <div class="footer__contact-email">
          <div class="footer__follow-icon">
            <img src="<?php echo get_template_directory_uri(); ?>/img/icon-mail.svg" /></a>
          </div>
          <span>
          <?php echo esc_attr($meta_email) ?>
        </span>

        </div>
        <div class="footer__contact-address">
          <div class="footer__follow-icon">
            <img src="<?php echo get_template_directory_uri(); ?>/img/icon-pin.svg" /></a>
          </div>
          <span>
          1616 Rhode Island Ave., NW <br/>
          Washington, DC 20036
        </span>
        </div>
      </div>
      </div>
    </div>
<div class="footer__image objfit">
      <img src="<?php echo esc_url($meta_image) ?>" /></a>

</div>
    <div class="footer__copyright">
      <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> by the Center for Strategic and International Studies. All rights reserved. | <a href="https://www.csis.org/privacy-policy" target="_blank" rel="nofollow">Privacy Policy</a></p>
    </div>
  </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
