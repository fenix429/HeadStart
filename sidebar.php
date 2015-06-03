<?php
/**
 * The sidebar containing a secondary widget area.
 *
 * @package HeadStart
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
