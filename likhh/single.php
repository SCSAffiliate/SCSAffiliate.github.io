<?php
/**
 * The template for displaying all single posts
 *
 * @package likhh
 * @since likhh 1.0
 */

get_header(); ?>

	<div id = 'primary' class = 'content-area'>
		<main id = 'main' class = 'site-main' role = 'main'>

		<?php 
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );
		?>
		<footer class="entry-footer grid_10">
			<?php likhh_entry_footer(); ?>
		</footer><!-- .entry-footer -->
		<?php
		// Previous/next post navigation.
		the_post_navigation( array(
			'next_text' => '<span class="post-title">&gt;</span>',
			'prev_text' => '<span class="post-title">&lt;</span>',
			'screen_reader_text' => __( '&nbsp;&nbsp;&nbsp;', 'likhh' ),
		) );
		?>

		<!-- <div class="grid_1">&nbsp; </div> -->
		<hr class="grid_10">
		<?php
			// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
