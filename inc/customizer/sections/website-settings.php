<?php
/**
 * Site Identity Settings
 *
 * Register settings to hide site title and tagline in Site Identity section
 *
 * @package ctpress
 */

/**
 * Adds Site Title settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function ctpress_customize_register_website_settings( $wp_customize ) {

	// Add postMessage support for site title and description.
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Add selective refresh for site title and description.
	// $wp_customize->selective_refresh->add_partial( 'blogname', array(
	// 	'selector'        => '.site-title a',
	// 	'render_callback' => 'ctpress_customize_partial_blogname',
	// ) );
	
	// $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
	// 	'selector'        => '.site-description',
	// 	'render_callback' => 'ctpress_customize_partial_blogdescription',
	// ) );

	// Add Retina Logo Headline.
	// $wp_customize->add_control( new Ctpress_Customize_Header_Control(
	// 	$wp_customize, 'ctpress[logo_title]', array(
	// 		'label'    => esc_html__( 'Retina Logo', 'ctpress' ),
	// 		'section'  => 'title_tagline',
	// 		'settings' => array(),
	// 		'priority' => 8,
	// 	)
	// ) );

	// Add Retina Logo Setting.
	// $wp_customize->add_setting( 'ctpress[logo]', array(
	// 	'default'           => false,
	// 	'type'              => 'option',
	// 	'transport'         => 'refresh',
	// 	'sanitize_callback' => 'ctpress_sanitize_checkbox',
	// ) );

	// $wp_customize->add_control( 'ctpress[logo]', array(
	// 	'label'    => esc_html__( 'Scale down logo image for retina displays', 'ctpress' ),
	// 	'section'  => 'title_tagline',
	// 	'settings' => 'ctpress[logo]',
	// 	'type'     => 'checkbox',
	// 	'priority' => 9,
	// ) );

	// Add Display Site Title Setting.
	// $wp_customize->add_setting( 'ctpress[site_title]', array(
	// 	'default'           => true,
	// 	'type'              => 'option',
	// 	'transport'         => 'postMessage',
	// 	'sanitize_callback' => 'ctpress_sanitize_checkbox',
	// ) );

	// $wp_customize->add_control( 'ctpress[site_title]', array(
	// 	'label'    => esc_html__( 'Display Site Title', 'ctpress' ),
	// 	'section'  => 'title_tagline',
	// 	'settings' => 'ctpress[site_title]',
	// 	'type'     => 'checkbox',
	// 	'priority' => 10,
	// ) );

	/*Add Display Tagline Setting.*/
	// $wp_customize->add_setting( 'ctpress[site_description]', array(
	// 	'default'           => true,
	// 	'type'              => 'option',
	// 	'transport'         => 'postMessage',
	// 	'sanitize_callback' => 'ctpress_sanitize_checkbox',
	// ) );

	// $wp_customize->add_control( 'ctpress[site_description]', array(
	// 	'label'    => esc_html__( 'Display Tagline', 'ctpress' ),
	// 	'section'  => 'title_tagline',
	// 	'settings' => 'ctpress[site_description]',
	// 	'type'     => 'checkbox',
	// 	'priority' => 11,
	// ) );
}
// add_action( 'customize_register', 'ctpress_customize_register_website_settings' );

/**
 * Render the site title for the selective refresh partial.
 */
function ctpress_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 */
function ctpress_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
