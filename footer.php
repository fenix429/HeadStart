<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package HeadStart
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php get_sidebar( 'footer' ); ?>

		<?php /*
		<nav id="site-map" class="site-navigation" role="navigation">
			<?php wp_nav_menu( array(
				'theme_location' => 'footer',
				'container_class' => 'menu'
			) ); ?>
		</nav><!-- #site-navigation -->
		*/ ?>

		<div class="site-info">
			<span class="copy">&copy; <?= __('Copyright', '_hs') ?> <?= date('Y'); ?> <?php bloginfo('name'); ?>. <?= __('All Rights Reserved.', '_hs') ?></span>
			<span class="seperator">|</span>
			<a class="privacy" href="<?= _hs_get_permalink_by_slug('privacy-notice') ?>"><?php _e('Privacy Notice', '_hs'); ?></a>
			<span class="seperator">|</span> 
			<span class="poweredby"><?= __('Powered By:', '_hs') ?> <a href="http://eztouse.com" rel="designer">EZToUse.com</a></span>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
