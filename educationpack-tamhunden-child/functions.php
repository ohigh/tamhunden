<?php
// Undgå at filen tilgås direkte
if ( !defined( 'ABSPATH' ) ) exit;

// Tilføj ChildTheme CSS

// Tilføj / overskriv CSS regler i '/style.css'
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles');

// Tilføj ny CSS fil med prioritet over plugin '/custom.css'
function custom_enqueue_styles(){
	wp_register_style( 'custom-css', get_stylesheet_directory_uri() . '/custom.css');
	wp_enqueue_style( 'custom-css' );
}
add_action( 'wp_enqueue_scripts', 'custom_enqueue_styles', 100);
// Tilføj custom JS 
function custom_enqueue_scripts(){
	//wp_register_script( 'my-custom-js', get_stylesheet_directory_uri() . '/scripts/custom-script.js');
	wp_register_script( 'my-quizz-js', get_stylesheet_directory_uri() . '/scripts/quizz-script.js');
	//wp_enqueue_script( 'my-custom-js' );
	wp_enqueue_script( 'my-quizz-js' );
}
add_action( 'wp_enqueue_scripts', 'custom_enqueue_scripts');
// Begræns længden på intro tekster til 12 ord
add_filter( 'excerpt_length', function($length) {
    return 12;
} );

// Custom funktion -- TAMHUNDEN
// 
// Fjern admin baren fra alle brugere der ikke har administrator rettigheder
add_action('after_setup_theme', 'remove_admin_bar');
 
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}
