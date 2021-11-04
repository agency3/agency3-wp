<?php

if ( ! function_exists( 'agency3_theme_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
   * 
   * @since 1.0
   */
  function agency3_theme_setup() {
    /*
		 * Make theme available for translation.
     */
    load_theme_textdomain( 'agency3', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
    
    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Add post formats support
    add_theme_support( 'post-formats', 
      array(
        'link',
				'gallery',
				'image',
				'quote',
				'video',
      )
    );

    /**
     * Enable support for Post Thumbnails on posts and pages.
     * 
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );
    // custom thumbnail size
    // set_post_thumbnail_size( $width:integer, $height:integer, $crop:boolean|array );
		// i.e.: set_post_thumbnail_size( 1600, 9999 );
    // custom image size
    // add_image_size( $name:string, $width:integer, $height:integer, $crop:boolean|array );
    // i.e.: add_image_size( 'post-header', 1200, 400, true );

    // Register navigation menus
    register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary menu', 'agency3' ),
				'footer'  => __( 'Secondary menu', 'agency3' ),
			)
		);

    /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
    add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

    // Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

    // Set the maximum allowed width for any content in the theme, like oEmbeds and images added to posts.
	  $GLOBALS['content_width'] = apply_filters( 'agency3_theme_setup', 1200 );
  }
}

add_action( 'after_setup_theme', 'agency3_theme_setup' );