<?php
/**
 * Enqueue scripts and styles.
 *
 * @since 1.0
 *
 * @return void
 */
function agency3_scripts() {
  $theme_version = wp_get_theme()->get( 'Version' );

  // Get directory
  $directory = trailingslashit( get_template_directory_uri() );

  // Styles
  wp_enqueue_style( 'styles', $directory . 'dist/css/app.css', array(), $theme_version, 'all' );

  // Scripts
  wp_register_script( 'scripts', $directory . 'dist/js/app.js', array(), $theme_version, true );

  // Localize scripts
  wp_localize_script( 'scripts', 'ajaxobject', array( 
      'ajaxurl'       => admin_url( 'admin-ajax.php' ),
    )
  );
  
  wp_enqueue_script( 'scripts' );
}

add_action( 'wp_enqueue_scripts', 'agency3_scripts' );