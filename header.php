<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package HeadStart
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link href="http://fonts.googleapis.com/css?family=Arvo:700|Open+Sans:400italic,700italic,400,700" rel="stylesheet" type="text/css" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', '_hs' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			
		</div>

		<nav id="main-navigation" class="site-navigation" role="navigation">
			<?php wp_nav_menu( array(
					'theme_location' => 'header',
					'container_id' => 'primary-menu',
					'container_class' => 'menu'
				) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content column">
