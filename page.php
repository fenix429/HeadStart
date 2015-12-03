<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package HeadStart
 */

get_header(); ?>

	<!-- WPGEN:CONFIG WIDGETIZED_SIDEBAR:BEGIN -->
	<div id="primary" class="content-area with-sidebar">
	<!-- WPGEN:CONFIG WIDGETIZED_SIDEBAR:ELSE -->
	<div id="primary" class="content-area">
	<!-- WPGEN:CONFIG WIDGETIZED_SIDEBAR:END -->
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>
				
				<!-- WPGEN:CONFIG INCLUDE_COMMENTS:BEGIN -->
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>
				<!-- WPGEN:CONFIG INCLUDE_COMMENTS:END -->

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<!-- WPGEN:CONFIG WIDGETIZED_SIDEBAR:BEGIN -->
<?php get_sidebar(); ?>
<!-- WPGEN:CONFIG WIDGETIZED_SIDEBAR:END -->
<?php get_footer(); ?>
