<?php
/**
 * The sidebar containing the footer widget area.
 *
 * @package HeadStart
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div id="footer-widgets" class="widget-area" role="complementary">
	<div class="column clearfix">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</div><!-- #secondary -->
