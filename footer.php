<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package HeadStart
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<!-- WPGEN:CONFIG WIDGETIZED_FOOTER:BEGIN -->
		<?php get_sidebar( 'footer' ); ?>
		<!-- WPGEN:CONFIG WIDGETIZED_FOOTER:END -->

		<!-- WPGEN:CONFIG FOOTER_NAVIGATION:BEGIN -->
		<nav id="site-map" class="site-navigation" role="navigation">
			<?php wp_nav_menu( array(
				'theme_location' => 'footer',
				'container_class' => 'menu-container'
			) ); ?>
		</nav><!-- #site-navigation -->
		<!-- WPGEN:CONFIG FOOTER_NAVIGATION:END -->
		
		<div class="site-info">
			<span class="copy">&copy; <?php esc_html_e( 'Copyright', '_hs' ) ?> <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All Rights Reserved.', '_hs' ) ?></span>
			<span class="seperator">|</span>
			<a class="privacy" href="<?php echo esc_url( _hs_get_permalink_by_slug( 'privacy-notice' ) ); ?>"><?php esc_html_e( 'Privacy Notice', '_hs' ); ?></a>
			<span class="seperator">|</span> 
			<span class="poweredby"><?php esc_html_e( 'Powered By:', '_hs' ) ?> <a href="http://eztouse.com" rel="designer">EZToUse.com</a></span>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
