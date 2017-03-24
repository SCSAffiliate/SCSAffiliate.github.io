<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package likhh
 */

if ( ! function_exists( 'likhh_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function likhh_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

			$posted_on = sprintf(
				/* translators: 'post date */
				esc_html_x( 'Posted on %s', 'post date', 'likhh' ),
				'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
			);

			$byline = sprintf(
				/* translators: 'post author */
				esc_html_x( 'by %s', 'post author', 'likhh' ),
				'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
			);

			echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'likhh_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function likhh_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			if ( is_front_page() === true ) {
				$title     = wp_get_document_title();
				$permalink = home_url( '/' );
			} else {
				$title     = wp_get_document_title();
				$permalink = get_permalink();
			}
	?>
		<span class="byline">
			<span class="author vcard">
				<span class="screen-reader-text"><?php esc_html_e( 'Author:', 'likhh' ) ?> </span>
				<span class="meta-info-text"><?php esc_html_e( 'Author:', 'likhh' ) ?> </span>
				<a class="url fn n" href="<?php esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php the_author() ?></a>
				<br/>
			</span>
		</span>

		<span class="posted-on">
			<span class="screen-reader-text"><?php esc_html_e( 'Published:', 'likhh' ) ?></span>
			<span class="meta-info-text"><?php esc_html_e( 'Published:', 'likhh' ) ?></span>
			<a href="#" rel="bookmark"><time class="entry-date published updated"> <?php the_time( get_option( 'date_format' ) ) ?></time></a>
		</span>
		<span class="cat-links">
			<span class="screen-reader-text"><?php esc_html_e( 'Categories:', 'likhh' ) ?> </span>
			<span class="meta-info-text"><?php esc_html_e( 'Categories:', 'likhh' ) ?> </span>
		<?php the_category( ', ' ) ?>
		</span>
		<span class="tags-links">
			<span class="screen-reader-text"><?php esc_html_e( 'Tags:', 'likhh' ) ?> </span> 
			<span class="meta-info-text"><?php esc_html_e( 'Tags:', 'likhh' ) ?> </span> 
		<?php echo get_the_tag_list( '',', ','' ); ?>
			
			</span>		

<?php
		} // End if().

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			/* translators: %s: post title */
			comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'likhh' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
			echo '</span>';
		}
		if ( comments_open() ) : ?>
		<p class="postmetadata"><?php edit_post_link( 'Edit', '', ' | ' ); ?> <?php comments_popup_link( esc_html__( 'No Comments &#187;', 'likhh' ) , esc_html__( '1 Comment &#187;', 'likhh' ) , esc_html__( '% Comments &#187;', 'likhh' ) ); ?></p>
		<?php endif;
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function likhh_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'likhh_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'likhh_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so likhh_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so likhh_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in likhh_categorized_blog.
 */
function likhh_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'likhh_categories' );
}
add_action( 'edit_category', 'likhh_category_transient_flusher' );
add_action( 'save_post',     'likhh_category_transient_flusher' );
