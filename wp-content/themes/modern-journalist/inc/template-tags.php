<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Modern_Journalist
 */

if ( ! function_exists( 'modern_journalist_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function modern_journalist_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'modern-journalist' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'modern_journalist_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function modern_journalist_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'modern-journalist' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'modern_journalist_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function modern_journalist_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */

		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'modern-journalist' ),
					array(
					    'span' => array(
					        'class' => array(),
					    ),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if (! function_exists('modern_journalist_share')) :
    /**
     * Prints HTML with published date..
     */
    function modern_journalist_share($id, $color)
    {

	global $post;

	// Get the post's URL that will be shared
	$post_url   = urlencode( esc_url( get_permalink($id) ) );

	// Get the post's title
	$post_title = urlencode( $post->post_title );

	// Compose the share links for Facebook, Twitter and Google+
	$facebook_link    = sprintf( 'https://www.facebook.com/sharer/sharer.php?u=%1$s', $post_url );
	$twitter_link     = sprintf( 'https://twitter.com/intent/tweet?text=%2$s&url=%1$s', $post_url, $post_title );
	$google_plus_link = sprintf( 'https://plus.google.com/share?url=%1$s', $post_url );
$mailto_link = sprintf( 'mailto:' );

	// Wrap the buttons
	$output = '<div class="post__share-buttons">';

			// Add the links inside the wrapper

			$output .= '<a target="_blank" class="post__share-icon" href="' . $facebook_link . '" alt="Share on Facebook" class="share-button "><img src=' . get_template_directory_uri() . '/img/icon-facebook' .  $color . '" /></a>';
			$output .= '<a target="_blank" class="post__share-icon" href="' . $twitter_link . '" alt="Share on Twitter" class="share-button "><img src=' . get_template_directory_uri() . '/img/icon-twitter' .  $color . '" /></a>';
			$output .= '<div class="post__share-icon" alt="Share on Facebook" class="share-button " onclick="window.print()"><img src=' . get_template_directory_uri() . '/img/icon-print' .  $color . '" /></div>';
			$output .= '<a target="_blank" class="post__share-icon" href="' . $mailto_link . '" alt="Share on Facebook" class="share-button"><img src=' . get_template_directory_uri() . '/img/icon-mail' .  $color . '" /></a>';

	$output .= '</div>';

	// Return the buttons and the original content
	return $output;
    }
endif;

if ( ! function_exists( 'modern_journalist_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function modern_journalist_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
			    'alt' => the_title_attribute( array(
			        'echo' => false,
			    ) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;

// function breezer_addDivToImage( $content ) {
//
//    // A regular expression of what to look for.
//    $pattern = '/(<img([^>]*)src="([^"]*)([^>]*)>)/i';
//
//    // What to replace it with. $1 refers to the content in the first 'capture group', in parentheses above
//    $replacement = '<a href="$3" rel="lightbox">$1</a>';
//
//    // run preg_replace() on the $content
//    $content = preg_replace( $pattern, $replacement, $content );
//
//    // return the processed content
//    return $content;
// }
//
// add_filter( 'the_content', 'breezer_addDivToImage' );

function picturefill($alt, $postID)
{

	$small  = wp_get_attachment_image_src($postID, 'thumbnail');
	$medium = wp_get_attachment_image_src($postID, 'medium_large');
	$large  = wp_get_attachment_image_src($postID, 'large');
	$full   = wp_get_attachment_image_src($postID, 'full');

//$output = '<source srcset="' . $small[0] . '" media="(min-width: 0px)">';
	$output .= '<picture>';
	$output .= '<source srcset="' . $medium[0] . '" media="(min-width: 100px)">';
	$output .= '<source srcset="' . $large[0] . '" media="(min-width: 1024px)">';
	$output .= '<img srcset="' . $full[0] . '" alt="' . $alt . '">';
	$output .= '</picture>';
//$output = "Hello";
	return $output;

};
