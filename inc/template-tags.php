<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package HeadStart
 */

if ( ! function_exists( '_hs_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function _hs_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', '_hs' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', '_hs' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', '_hs' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( '_hs_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function _hs_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', '_hs' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', '_hs' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     '_hs' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( '_hs_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function _hs_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( 'Posted on %s', 'post date', '_hs' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( 'by %s', 'post author', '_hs' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

}
endif;

if ( ! function_exists( '_hs_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function _hs_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', '_hs' ) );
		if ( $categories_list && _hs_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( 'Posted in %1$s', '_hs' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', '_hs' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tagged %1$s', '_hs' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', '_hs' ), __( '1 Comment', '_hs' ), __( '% Comments', '_hs' ) );
		echo '</span>';
	}

	edit_post_link( __( 'Edit', '_hs' ), '<span class="edit-link">', '</span>' );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function _hs_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( '_hs_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( '_hs_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so _hs_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so _hs_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in _hs_categorized_blog.
 */
function _hs_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( '_hs_categories' );
}
add_action( 'edit_category', '_hs_category_transient_flusher' );
add_action( 'save_post',     '_hs_category_transient_flusher' );

if ( ! function_exists( '_hs_get_permalink_by_slug' ) ) :
/**
 * Returns permalink via page slug
 * 
 * @return string
 */
function _hs_get_permalink_by_slug( $slug ) {
	$post_obj = get_page_by_path( $slug );
	
	if( is_null( $post_obj ) ) {
		return false;
	} else {
		return get_permalink( $post_obj->ID );
	}
}
endif;

if ( ! function_exists( '_hs_print_archives' ) ) :
/**
 * Prints a wrapped archive list
 * 
 */
function _hs_print_archives( $args = [] )
{
	$defaults = [
		'type'            => 'monthly',
		'limit'           => 6, // last six months
		'format'          => 'html', 
		'before'          => '',
		'after'           => '',
		'show_post_count' => false,
		'echo'            => 1,
		'order'           => 'DESC',
		'classlist'       => 'archives'
	];

	$args = wp_parse_args( $args, $defaults );

	?><ul class="<?= $args[classlist] ?>"><?php
	wp_get_archives( $args );
	?></ul><?php
}
endif;

if ( ! function_exists( '_hs_print_random_posts' ) ) :
/**
 * Prints a wrapped list of Posts selected at random
 * 
 */
function _hs_print_random_posts( $args = [] )
{
	$defaults = [
		'num_posts' => 5, 
		'classlist' => 'random-posts',
		'no_posts' => __( 'No Articles Found' )
	];

	$args = wp_parse_args( $args, $defaults );

	$query = new WP_Query( array ( 'posts_per_page' => $args['num_posts'], 'orderby' => 'rand' ) );

	?><ul class="<?= $args[classlist] ?>"><?php
	
	if ( !$query->have_posts() ) {
		?><li><?= $args['no_posts'] ?></li><?php
	}

	while ( $query->have_posts() ) {
		$query->the_post();

		?><li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li><?php
	}

	?></ul><?php

	wp_reset_postdata();
}
endif;

if ( ! function_exists( '_hs_print_popular_posts' ) ) :
/**
 * Prints a wrapped list of the most viewed Posts
 * 
 * NOTE: The Hooks included Below must be uncommented for this functionality
 */
function _hs_print_popular_posts( $args = [] )
{
	$defaults = [
		'num_posts' => 5, 
		'classlist' => 'random-posts',
		'no_posts' => __( 'No Articles Found' )
	];

	$args = wp_parse_args( $args, $defaults );

	$query = new WP_Query( array( 'posts_per_page' => $args['num_posts'], 'meta_key' => '_hs_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );

	?><ul class="<?= $args[classlist] ?>"><?php
	
	if ( !$query->have_posts() ) {
		?><li><?= $args['no_posts'] ?></li><?php
	}
	
	while ( $query->have_posts() ) {
		$query->the_post();

		?><li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li><?php
	}

	?></ul><?php

	wp_reset_postdata();
}
endif;

if ( ! function_exists( '_hs_set_post_views' ) ) :
/**
 * Saves view count in Post meta
 * 
 * NOTE: Required for _hs_print_popular_posts
 */
function _hs_set_post_views( $post_id )
{
	$count_key = '_hs_post_views_count';
	
	$count = get_post_meta( $post_id, $count_key, true );
	
	if ( $count == '' ) {
		$count = 0;
		delete_post_meta( $post_id, $count_key );
		add_post_meta( $post_id, $count_key, '0' );
	} else {
		$count++;
		update_post_meta( $post_id, $count_key, $count );
	}
}
endif;

if ( ! function_exists( '_hs_track_post_views' ) ) :
/**
 * Updates view count for current Post
 * 
 * NOTE: Required for _hs_print_popular_posts
 */
function _hs_track_post_views( $post_id )
{
	if ( !is_single() ) return;

	if ( empty ( $post_id) ) {
		global $post;
		$post_id = $post->ID;   
	}
	
	_hs_set_post_views($post_id);
}
/* TRACKING HOOKS for use with _hs_print_popular_posts */
// track post views
//add_action( 'wp_head', '_hs_track_post_views');

// remove prefetching to keep the post view count accurate
//remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
endif;
