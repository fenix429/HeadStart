<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package HeadStart
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<script>
   WebFontConfig = {
      google: {
	      families: ['Arvo:n7', 'Open Sans:n4,i4,n7,i7']
      }
   };

   (function(d) {
      var wf = d.createElement('script'), s = d.scripts[0];
      wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.5.18/webfont.js';
      s.parentNode.insertBefore(wf, s);
   })(document);
</script>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', '_hs' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			
		</div>

		<nav id="main-navigation" class="site-navigation visible-md visible-lg" role="navigation">
			<?php wp_nav_menu( array(
					'theme_location' => 'header',
					'container_id' => 'primary-menu',
					'container_class' => 'menu-container'
				) ); ?>
		</nav><!-- #site-navigation -->
		<div id="mobile-menu-container" class="visible-sm visible-xs"></div>
	</header><!-- #masthead -->

	<div id="content" class="site-content column">
