<?php
/**
 * Likhh functions and definitions
 *
 * @package likhh
 */

if ( ! function_exists( 'likhh_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since likhh 1.0
	 */
	function likhh_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on likhh, use a find and replace
		 * to change 'likhh' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'likhh', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 990, 804, true );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'likhh' ),
		) );

			/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			) );

			// Set up the WordPress core custom background feature.
			add_theme_support( 'custom-background', apply_filters( 'likhh_custom_background_args', array(
				'default-color' => 'ffffff',
				'default-image' => '',
			) ) );

			// Add theme support for selective refresh for widgets.
			add_theme_support( 'customize-selective-refresh-widgets' );

			/*
			 * This theme styles the visual editor to resemble the theme style,
			 * specifically font, colors, icons, and column width.
			 */
			add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', likhh_fonts_url() ) );
	}
endif; // likhh_setup.
add_action( 'after_setup_theme', 'likhh_setup' );

if ( ! function_exists( 'likhh_fonts_url' ) ) :
	/**
	 * Register Google fonts for likhh.
	 *
	 * @since likhh 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function likhh_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';
		/* translators: If there are characters in your language that are not supported by Noto Sans, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Lora font: on or off', 'likhh' ) ) {
			$fonts[] = 'Lora:400italic,700italic,400,700';
		}
		/* translators: To add an additional character subset specific to your language, translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language. */
		$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'likhh' );
		if ( 'cyrillic' == $subset ) {
			$subsets .= ',cyrillic,cyrillic-ext';
		} elseif ( 'greek' == $subset ) {
			$subsets .= ',greek,greek-ext';
		} elseif ( 'devanagari' == $subset ) {
			$subsets .= ',devanagari';
		} elseif ( 'vietnamese' == $subset ) {
			$subsets .= ',vietnamese';
		}
		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), '//fonts.googleapis.com/css' );
		}
			return $fonts_url;
	}
endif;
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function likhh_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'likhh_content_width', 640 );
}
add_action( 'after_setup_theme', 'likhh_content_width', 0 );



/**
 * Enqueue scripts and styles.
 */
function likhh_scripts() {
	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Theme stylesheet.
	wp_enqueue_style( 'likhh-style', get_stylesheet_uri() );

	wp_enqueue_style( 'normalize', get_template_directory_uri() . '/css/normalize.css', array( 'likhh-style' ), '20150930' );
	wp_enqueue_style( 'likhh_base', get_template_directory_uri() . '/css/base.css', array( 'likhh-style' ), '20150930' );
	wp_enqueue_style( 'likhh_grid', get_template_directory_uri() . '/css/grid.css', array( 'likhh-style' ), '20150930' );
	wp_enqueue_style( 'likhh_ckbcustom', get_template_directory_uri() . '/css/ckbcustom.css', array( 'likhh-style' ), '20150930' );

	wp_enqueue_script( 'jquery-nicescroll', get_template_directory_uri() . '/js/jquery.nicescroll.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'jquery-jpreloader', get_template_directory_uri() . '/js/jpreloader.min.js', array(), null, true );
	wp_enqueue_script( 'jquery-retina', get_template_directory_uri() . '/js/retina.min.js', array(), null, true );
	wp_enqueue_script( 'likhh-common', get_template_directory_uri() . '/js/common.js', array(), null, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/*
	 * Load our Google Fonts.
	 */
	$fonts_url = likhh_fonts_url();
	if ( ! empty( $fonts_url ) ) {
		wp_enqueue_style( 'likhh-fonts', esc_url_raw( $fonts_url ), array(), null );
	}

}
add_action( 'wp_enqueue_scripts', 'likhh_scripts' );


if ( ! function_exists( 'likhh_post_thumbnail' ) ) :
	/**
	 * Display an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 *
	 * @since likhh 1.0
	 */
	function likhh_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
		?>

		<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php echo esc_url( get_permalink() ); ?>" aria-hidden="true">
		<?php
			the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) );
		?>
	</a>

	<?php endif; // End is_singular()
	}
endif;



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
