<?php
/**
 * @package HeadStart
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if( function_exists('get_field') AND get_field('hide_title') ): ?>
		    <?php the_field('custom_header'); ?>
		<?php else: ?>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php endif; ?>

		<div class="entry-meta">
			<?php _hs_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', '_hs' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php _hs_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
