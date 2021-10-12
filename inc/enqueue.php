<?php

wp_enqueue_script( 'bootstrap-jquery', get_template_directory_uri() . '/js/bootstrap.min.js', array ( 'jquery' ), null, true);
  wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/bootstrap.js', array ( 'jquery' ), null, true);
  wp_enqueue_script( 'gototop', get_template_directory_uri() . '/js/jqury.min.js', array ( 'jquery' ),  null, true);
  wp_enqueue_script( 'somejavascripts', get_template_directory_uri() . '/js/theme.js', array ( 'jquery' ), null, true);
 
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }
add_action( 'wp_enqueue_scripts', 'homestay_add_theme_scripts' );

?>
