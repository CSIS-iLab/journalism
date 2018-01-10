<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Modern_Journalist
 */
if (!function_exists('modern_journalist_posted_on')):
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function modern_journalist_posted_on()
{
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if (get_the_time('U') !== get_the_modified_time('U')) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf($time_string,
			esc_attr(get_the_date('c')),
			esc_html(get_the_date()),
			esc_attr(get_the_modified_date('c')),
			esc_html(get_the_modified_date())
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x('%s', 'post date', 'modern-journalist'),
			$time_string
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}

endif;

if (!function_exists('modern_journalist_entry_footer')):
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function modern_journalist_entry_footer()
{
		// Hide category and tag text for pages.
		if ('post' === get_post_type()) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list(esc_html__(', ', 'modern-journalist'));
			if ($categories_list) {
				/* translators: 1: list of categories. */
				printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'modern-journalist') . '</span>', $categories_list); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'modern-journalist'));
			if ($tags_list) {
				/* translators: 1: list of tags. */
				printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'modern-journalist') . '</span>', $tags_list); // WPCS: XSS OK.
			}
		}

		if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'modern-journalist'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__('Edit <span class="screen-reader-text">%s</span>', 'modern-journalist'),
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

function related_authors($post)
{
	global $related_du;
	$relt = $related_du->show(get_the_ID(), true);
	$output;
	// Display the title and excerpt of each related post
	if (is_array($relt) && count($relt) > 0) {
		$a = 0;
		foreach ($relt as $r) {
			if (is_object($r)) {
				if ($r->post_status != 'trash') {
					$a++;
					setup_postdata($r);
					$output .= get_the_title($r->ID);

					if ($a < count($relt)) {
						$output .= ', ';
					}

				}
				;
			}

		}

		return $output;
		wp_reset_postdata();
	}

}

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
