<?php
/**
 * Returns theme options
 *
 * Uses sane defaults in case the user has not configured any theme options yet.
 *
 * @package Ctpress
 */

/**
* Get a single theme option
*
* @return mixed
*/
function ctpress_get_option( $option_name = '' ) 
{
	/*Get all Theme Options from Database.*/
	$theme_options = ctpress_theme_options();

	/*Return single option.*/
	if ( isset( $theme_options[ $option_name ] ) ) {
	// if ( array_key_exists( $option_name, $theme_options) ) {
		return $theme_options[ $option_name ];
	}

	return false;
}


/**
 * Get saved user settings from database or theme defaults
 *
 * @return array
 */
function ctpress_theme_options() {

	// Merge theme options array from database with default options array.
	$theme_options = wp_parse_args( get_option( 'ctpress', array() ), ctpress_default_options() );

	// Return theme options.
	return apply_filters( 'ctpress_theme_options', $theme_options );
}


/**
 * Returns the default settings of the theme
 *
 * @return array
 */
function ctpress_default_options() {

	$default_options = array(
		'logo'            		 => ['url'=>get_template_directory_uri().'/assets/images/logo.svg'],
		'footer-logo'            => ['url'=>get_template_directory_uri().'/assets/images/logo.svg'],
		'favicon'            	 => ['url'=>get_template_directory_uri().'/assets/images/favicon.png'],
		'logo-position'          => 2,
		'theme-date'             => true,
		'comment_option'         => 0,
		'fb_appId'         		 => '492209628792946',
		'post-screen'         	 => 1,
		'post-heading'         	 => 0,
		'post_img_cap'         	 => 0,
		'post-navigation'      	 => 0,
		'post-tags'      	 	 => 0,
		'post-comment'      	 => 0,
		'page-screen'         	 => 1,
		'page-heading'         	 => 0,
		'page_img_cap'         	 => 0,
		'header_social'       	 => false,
		'footer_social'       	 => false,
		'facebook'            	 => '#',
		'twitter'            	 => '#',
		'instagram'            	 => '#',
		'youtube'            	 => '#',
		'linkedin'            	 => '#',
		'footer_info'      		 => sprintf('<h6> Office 1 : </h6>
                           <p><span> Address  </span></p>
                           <p> Mobile:- <a href="tel:">phone 1</a>, <a href="tel:">phone2</a>, Email: <a href="mailto:info@%1$s">info@%1$s</a> </p>',$_SERVER['HTTP_HOST']),
		'footer_logo_bottom'     => '<h6> Edito: Jhon Mack </h6>',
		'footer_text'     	 	 => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus impedit voluptatem, blanditiis cum quibusdam, vel neque reiciendis porro, omnis adipisci, voluptas veniam minus officiis fugit laudantium beatae temporibus necessitatibus distinctio.</p>',
		'theme_bg_color'         => '#dd9933',
		'theme_color'          	 => '#363535',
		'theme_hover_color'      => '#111',
		'theme_h_color'      	 => '#111',
		'theme_p_color'      	 => '#363535',
		'theme_a_color'      	 => '#101010',
		'heading_color'      	 => '#111',
		'menu_search'        	 => 1,
		'menu_font_hv_clr'       => '#eb0254',
		'menu_font_hv_clr'       => '#eb0254',
		'site_title'             => true,
		'site_description'       => true,
		'excerpt_length'         => 25,
		'excerpt_more_text'      => '[...]',
		'read_more_link'         => esc_html__( 'Read more', 'ctpress' ),
		'meta_date'              => true,
		'meta_author'            => false,
		'meta_comments'          => false,
		'post_layout'            => 'above-title',
		'post_navigation'        => true,
		'credit_link'            => true,
	);

	return apply_filters( 'ctpress_default_options', $default_options );
}
