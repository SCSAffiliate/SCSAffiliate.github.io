<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package likhh
 */

?>

	</div><!-- #insidecontent -->
	</div><!-- #content -->
	<div class="grid_1">&nbsp; </div>

	<footer id="colophon" class="site-footer grid_10" >
		<div class="site-info">
			<?php
			/* translators: WordPress */ ?>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'likhh' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'likhh' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span> 
			<?php
			/* translators: Theme by */
						printf( esc_html__( 'Theme: %1$s by %2$s.', 'likhh' ), 'Likhh', '<a href="http://magusdigitalmedia.com/" >Magus Digital Media</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #container -->

<?php wp_footer(); ?>

</body>
</html>
