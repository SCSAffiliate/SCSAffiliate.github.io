<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package likhh
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) : ?>

	<div  class="container menu-toggle__wrapper horizontal-middle clearfix" style="margin-left: -498px;">
		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<nav  class="header-nav verticalize-container "  aria-label="<?php esc_attr_e( 'Primary Menu', 'likhh' ); ?>"  tabindex="5000" style="overflow-y: hidden; outline: none;">
				<a href="#" class="close-navbar"><i class="icon-close"></i></a>

				<?php
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'menu_class'     => 'nav verticalize',
						'menu_id'     => 'navigation',
						'container'     => '',
					) );
				?>
			</nav><!-- .main-navigation -->
		<?php endif; ?>

	</div><!-- .site-header-menu -->
<?php endif; ?>



<div class="container clearfix">
	<header class="grid_12">
	<div class="titlebar">
		<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	</div>

			<!-- menuckb -->
			<button type="button" class="menu-icon menu-toggle"> 
			<!-- menuckb <span class="icon-bar"></span> -->
			</button>
	</header>
	<div id="content" class="grid_12">
	<div class="grid_1">&nbsp; </div>
	<div id="insidecontent" class="grid_10">
