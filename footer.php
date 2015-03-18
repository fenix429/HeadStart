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
		<div class="site-info">
			<span class="copy">&copy; <?= __('Copyright', '_hs') ?> <?= date('Y'); ?> <?php bloginfo('name'); ?>. <?= __('All Rights Reserved.', '_hs') ?></span>
			<span class="poweredby"><?= __('Powered By:', '_hs') ?> <a href="http://eztouse.com" rel="designer">EZToUse.com</a></span>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
