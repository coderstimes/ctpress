<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package ctpress
 */


/**
 * Check if we are on a blog page or single post.
 *
 * @return bool
 */
function ctpress_is_blog_page() {
	return ( 'post' === get_post_type() ) && ( is_home() || is_archive() || is_single() );
}



/**
 * Add custom CSS to scale down logo image for retina displays.
 *
 * @return void
 */
function ctpress_retina_logo() {
	// Return early if there is no logo image or option for retina logo is disabled.
	if ( ! has_custom_logo() or false === ctpress_get_option( 'retina_logo' ) ) {
		return;
	}

	// Get Logo Image.
	$logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );

	// Create CSS.
	$css = '.site-logo .custom-logo { width: ' . absint( floor( $logo[1] / 2 ) ) . 'px; }';

	// Add Custom CSS.
	wp_add_inline_style( 'ctpress-stylesheet', $css );
}
add_filter( 'wp_enqueue_scripts', 'ctpress_retina_logo', 11 );


/**
 * Change excerpt length for default posts
 *
 * @param int $length Length of excerpt in number of words.
 * @return int
 */
function ctpress_excerpt_length( $length ) {

	if ( is_admin() ) {
		return $length;
	}

	// Get excerpt length from database.
	$excerpt_length = ctpress_get_option( 'excerpt_length' );

	// Return excerpt text.
	if ( $excerpt_length >= 0 ) :
		return absint( $excerpt_length );
	else :
		return 55; // Number of words.
	endif;
}
add_filter( 'excerpt_length', 'ctpress_excerpt_length' );


/**
 * Change excerpt more text for posts
 *
 * @param String $more_text Excerpt More Text.
 * @return string
 */
function ctpress_excerpt_more( $more_text ) {

	if ( is_admin() ) {
		return $more_text;
	}

	return esc_html( ' ' . ctpress_get_option( 'excerpt_more_text' ) );
}
add_filter( 'excerpt_more', 'ctpress_excerpt_more' );
