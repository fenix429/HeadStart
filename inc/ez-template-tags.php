<?php
/**
 * EZToUse.com Custom template tags.
 * 
 */

if ( ! function_exists( 'ez_get_permalink_by_slug' ) ) :
/**
 * Returns permalink via page slug
 * 
 * @return string
 */
function ez_get_permalink_by_slug( $slug ) {
	$post_obj = get_page_by_path( $slug );
	
	if( is_null( $post_obj ) ) {
		return false;
	} else {
		return get_permalink( $post_obj->ID );
	}
}
endif;

if ( ! function_exists( 'ez_print_archives' ) ) :
/**
 * Prints a wrapped archive list
 * 
 */
function ez_print_archives( $args = [] )
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

if ( ! function_exists( 'ez_print_random_posts' ) ) :
/**
 * Prints a wrapped list of Posts selected at random
 * 
 */
function ez_print_random_posts( $args = [] )
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

if ( ! function_exists( 'ez_print_popular_posts' ) ) :
/**
 * Prints a wrapped list of the most viewed Posts
 * 
 * NOTE: The Hooks included Below must be uncommented for this functionality
 */
function ez_print_popular_posts( $args = [] )
{
	$defaults = [
		'num_posts' => 5, 
		'classlist' => 'random-posts',
		'no_posts' => __( 'No Articles Found' )
	];

	$args = wp_parse_args( $args, $defaults );

	$query = new WP_Query( array( 'posts_per_page' => $args['num_posts'], 'meta_key' => 'ez_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );

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

if ( ! function_exists( 'ez_set_post_views' ) ) :
/**
 * Saves view count in Post meta
 * 
 * NOTE: Required for ez_print_popular_posts
 */
function ez_set_post_views( $post_id )
{
	$count_key = 'ez_post_views_count';
	
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

if ( ! function_exists( 'ez_track_post_views' ) ) :
/**
 * Updates view count for current Post
 * 
 * NOTE: Required for ez_print_popular_posts
 */
function ez_track_post_views( $post_id )
{
	if ( !is_single() ) return;

	if ( empty ( $post_id) ) {
		global $post;
		$post_id = $post->ID;   
	}
	
	ez_set_post_views($post_id);
}
/* TRACKING HOOKS for use with ez_print_popular_posts */
// track post views
//add_action( 'wp_head', 'ez_track_post_views');

// remove prefetching to keep the post view count accurate
//remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
endif;


