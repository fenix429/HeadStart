<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package HeadStart
 */

/**
 * Because of using post_type=any we have to manually weed out the attachments from the query_posts results.
 *
 * @param String $where SQL Where Clause.
 * @return WHERE statement that strips out attachment
 * @author Joost De Valk
 **/
function _hs_strip_attachments( $where ) {
	$where .= ' AND post_type != "attachment"';
	return $where;
}
add_filter( 'posts_where', '_hs_strip_attachments' );

get_header(); ?>

	<!-- WPGEN:CONFIG WIDGETIZED_SIDEBAR:BEGIN -->
	<div id="primary" class="content-area with-sidebar">
	<!-- WPGEN:CONFIG WIDGETIZED_SIDEBAR:ELSE -->
	<div id="primary" class="content-area">
	<!-- WPGEN:CONFIG WIDGETIZED_SIDEBAR:END -->
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', '_hs' ); ?></h1>
					<h2><?php esc_html_e( 'Let me help you find what you came here for:', '_hs' ); ?></h2>
				</header><!-- .page-header -->

				<div class="page-content">
					
					<?php
						$s = preg_replace( '/(.*)-(html|htm|php|asp|aspx)$/', '$1', $wp_query->query_vars['name'] );
						$posts = get_posts( 'post_type=any&name=' . esc_sql( $s ) );
						$s = str_replace( '-', ' ', $s );
						if ( count( $posts ) === 0 ) {
							$posts = get_posts( 'post_type=any&s=' . esc_sql( $s ) );
						}
					?>

					<?php if ( count( $posts ) > 0 ) : ?>

							<p><?php esc_html_e( 'Were you looking for one of the following posts or pages', '_hs' ); ?></p>

							<ul>
							
							<?php foreach ( $posts as $post ) : ?>
								<li><a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"><?php echo esc_html( $post->post_title ); ?></a></li>
							<?php endforeach; ?>
							</ul>

					<?php endif; ?>
						
					<label for="s"><strong>Search</strong> for it:</label>
					<form style="display:inline;" action="<?php bloginfo( 'siteurl' );?>">
						<input type="search" value="<?php echo esc_attr( $s ); ?>" id="s" name="s" placeholder="Search for ..."> <input type="submit" value="Search">
					</form>
					

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<!-- WPGEN:CONFIG WIDGETIZED_SIDEBAR:BEGIN -->
<?php get_sidebar(); ?>
<!-- WPGEN:CONFIG WIDGETIZED_SIDEBAR:END -->
<?php get_footer(); ?>
