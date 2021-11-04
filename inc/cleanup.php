<?php

/**
 * Clean up WordPress junk at start
 */
function agency3_start() {
  // Clean up head
  add_action('init', 'head_cleanup');

  // Remove injected css for recent comments widget
  add_filter( 'wp_head', 'remove_wp_widget_recent_comments_style', 1 );

  // Clean up comment styles in the head
  add_action( 'wp_head', 'remove_recent_comments_style', 1 );

  // Clean up gallery output
  add_filter( 'gallery_style', 'gallery_style' );

  // Clean up excerpt
  add_filter( 'excerpt_more', 'excerpt_more' );
}
add_action( 'after_setup_theme', 'agency3_start', 16 );

/**
 * Clean up actions
 */
// Clean up WordPress head mess
function head_cleanup() {
  // Remove category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );

	// Remove post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
  
	// Remove EditURI link
	remove_action( 'wp_head', 'rsd_link' );

	// Remove Windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );

	// Remove index link
	remove_action( 'wp_head', 'index_rel_link' );

	// Remove previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );

	// Remove start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );

	// Remove links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

	// Remove WP version
	remove_action( 'wp_head', 'wp_generator' );

  // Remove print emoji
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); 
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' ); 
  remove_action( 'wp_print_styles', 'print_emoji_styles' ); 
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
}

// Remove injected CSS for recent comments widget
function remove_wp_widget_recent_comments_style() {
  if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
     remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
  }
}

// Remove injected CSS from recent comments widget
function remove_recent_comments_style() {
  global $wp_widget_factory;
  if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
    remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
  }
}

// Remove injected CSS from gallery
function gallery_style( $css ) {
  return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}

// Removes the annoying […] to a Read More link
function excerpt_more( $more ) {
	global $post;
	// edit here if you like
  return '<a class="excerpt-read-more" href="'. get_permalink( $post->ID ) . '" title="'. __('Read', 'jointswp') . get_the_title( $post->ID ).'">'. __( '... Read more &raquo;', 'jointswp' ) .'</a>';
}