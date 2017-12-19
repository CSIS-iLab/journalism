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
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function modern_journalist_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'modern-journalist' ),
		 $time_string
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

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
			$categories_list = get_the_category_list( esc_html__( ', ', 'modern-journalist' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'modern-journalist' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'modern-journalist' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'modern-journalist' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'modern-journalist' ),
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



	if ( ! function_exists( 'modernjournalism_related_content' ) ) :
	/**
	 * Displays related content to the current post
	 * @param  Array $rel Array of related posts
	 * @return String      HTML of related posts
	 */
	function modernjournalism_related_content(){
		global $related;
		$rel = $related->show( get_the_ID(), true );

		$time_string = '<span class="meta-label">Published</span><time class="entry-date published" datetime="%1$s">%2$s</time>';

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);
		

		// Display the title and excerpt of each related post
		if ( is_array( $rel ) && count( $rel ) > 0 ) {
			global $post;
			echo '<div class="related-posts col-xs-12 row">';
			foreach( $rel as $post ) : setup_postdata($post);
				if ($post->post_status != 'trash') {
					echo '<div class="related-post col-xs-12 col-md">';
					echo '<div class="related-post-img"><a href="'.get_permalink().'">';
					the_post_thumbnail('medium-large');
					echo '</a></div><div class="related-post-content">';
					echo '<a href="'.get_permalink().'" class="related-post-title">';
					the_title();
					echo '</a>';
					//aerospace_authors_list();
					echo '<div class="posted-on">' . $time_string . '</div>'; // WPCS: XSS OK.
					echo '</div></div>';
				}
			endforeach;
			wp_reset_postdata();
			echo '</div>';
		}
	}
endif;

	