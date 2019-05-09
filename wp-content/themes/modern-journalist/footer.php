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
 $meta_email = get_option('modern_journalist_email');
 $meta_facebook = get_option('modern_journalist_facebook');
 $meta_twitter = get_option('modern_journalist_twitter');
 $meta_linkedin= get_option('modern_journalist_linkedin');
 $meta_youtube = get_option('modern_journalist_youtube');
 $meta_instagram = get_option('modern_journalist_instagram');
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'modern-journalist' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'modern-journalist' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'modern-journalist' ), 'modern-journalist', '<a href="http://underscores.me/">Tucker Harris</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
