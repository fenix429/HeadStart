<?php
/**
 * The sidebar containing the footer widget area.
 *
 * @package HeadStart
 */

if ( ! is_active_sidebar( 'footer-1' ) ) {
	return;
}
?>

<div id="footer-widgets" class="widget-area" role="complementary">
	<div class="column clearfix">
		<?php dynamic_sidebar( 'footer-1' ); ?>
	</div>
</div><!-- #secondary -->
