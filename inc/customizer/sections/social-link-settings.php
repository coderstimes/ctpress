<?php
/**
 * Social Settings
 *
 * Register Social Settings section, settings and controls for Theme Customizer
 *
 * @package ctpress
 */

/**
 * Adds Social settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function ctpress_customize_register_social_settings( $wp_customize ) {

	// Add Sections for Post Settings.
	$wp_customize->add_section( 'ctpress_section_social', array(
		'title'    => esc_html__( 'Social Settings', 'ctpress' ),
		'priority' => 150,
		'panel'    => 'ctpress_options_panel',
	) );

	/*Get Default Settings.*/
	$default = ctpress_default_options();

	/*Hide Header social buttons.*/
	$wp_customize->add_control( new ctpress_Customize_Header_Control(
		$wp_customize, 'header_social_settings', array(
			'label'    => esc_html__( 'Header Social button Show/Hide Settings', 'ctpress' ),
			'section'  => 'ctpress_section_social',
			'settings' => array(),
			'priority' => 1,
		)
	) );

	/*Add Setting and Control for header social buttons comment.*/
	$wp_customize->add_setting( 'ctpress[header_social]', array(
		'default'           => $default['header_social'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'ctpress_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'ctpress[header_social]', array(
		'label'    => esc_html__( 'Hide Header Social', 'ctpress' ),
		'section'  => 'ctpress_section_social',
		'settings' => 'ctpress[header_social]',
		'type'     => 'checkbox',
		'priority' => 2
	) );

	/*Hide Footer social buttons.*/
	$wp_customize->add_control( new ctpress_Customize_Header_Control(
		$wp_customize, 'footer_social_settings', array(
			'label'    => esc_html__( 'Footer Social button', 'ctpress' ),
			'section'  => 'ctpress_section_social',
			'settings' => array(),
			'priority' => 3,
		)
	) );

	/*Add Setting and Control for header social buttons comment.*/
	$wp_customize->add_setting( 'ctpress[footer_social]', array(
		'default'           => $default['footer_social'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'ctpress_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'ctpress[footer_social]', array(
		'label'    => esc_html__( 'Hide Footer Social buttons', 'ctpress' ),
		'section'  => 'ctpress_section_social',
		'settings' => 'ctpress[footer_social]',
		'type'     => 'checkbox',
		'priority' => 4
	) );


	/*Add Social Text setting.*/
	$wp_customize->add_setting( 'ctpress[facebook]', array(
		'default'           => '',
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( 'ctpress[facebook]', array(
		'label'    => esc_html__( 'Your site Facebook page URL', 'ctpress' ),
		'section'  => 'ctpress_section_social',
		'settings' => 'ctpress[facebook]',
		'type'     => 'text',
		'priority' => 10,
	) );

	/*Add Twitter url setting.*/
	$wp_customize->add_setting( 'ctpress[twitter]', array(
		'default'           => '',
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( 'ctpress[twitter]', array(
		'label'    => esc_html__( 'Your site twitter page URL', 'ctpress' ),
		'section'  => 'ctpress_section_social',
		'settings' => 'ctpress[twitter]',
		'type'     => 'text',
		'priority' => 20,
	) );

	/*Add instagram url setting.*/
	$wp_customize->add_setting( 'ctpress[instagram]', array(
		'default'           => '',
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( 'ctpress[instagram]', array(
		'label'    => esc_html__( 'Your site instagram page URL', 'ctpress' ),
		'section'  => 'ctpress_section_social',
		'settings' => 'ctpress[instagram]',
		'type'     => 'text',
		'priority' => 30,
	) );

	/*Add youtube link setting.*/
	$wp_customize->add_setting( 'ctpress[youtube]', array(
		'default'           => '',
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( 'ctpress[youtube]', array(
		'label'    => esc_html__( 'Your site youtube channel URL', 'ctpress' ),
		'section'  => 'ctpress_section_social',
		'settings' => 'ctpress[youtube]',
		'type'     => 'text',
		'priority' => 40,
	) );

	/*Add linkedin link setting.*/
	$wp_customize->add_setting( 'ctpress[linkedin]', array(
		'default'           => '',
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( 'ctpress[linkedin]', array(
		'label'    => esc_html__( 'Your site linkedin page URL', 'ctpress' ),
		'section'  => 'ctpress_section_social',
		'settings' => 'ctpress[linkedin]',
		'type'     => 'text',
		'priority' => 50,
	) );
	
}
add_action( 'customize_register', 'ctpress_customize_register_social_settings' );

