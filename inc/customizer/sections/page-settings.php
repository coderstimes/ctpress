<?php
/**
 * Menu Settings
 *
 * Register Menu Settings section, settings and controls for Theme Customizer
 *
 * @package ctpress
 */

/**
 * Adds post settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function ctpress_customize_register_page_settings( $wp_customize ) {

	/*Add Sections for Menu Settings.*/
	$wp_customize->add_section( 'ctpress_section_page', array(
		'title'    => esc_html__( 'Page Settings', 'ctpress' ),
		'priority' => 40,
		'panel'    => 'ctpress_options_panel',
		'capability'  => 'edit_theme_options', /*Capability needed to tweak*/
		'description' => __('Allows you to customize page screen', 'ctpress'), /*//Descriptive tooltip*/
	) );

	/*Get Default Settings.*/
	$default = ctpress_default_options();

	/*Add Setting and Control for showing menu search.*/
	$wp_customize->add_setting( 'ctpress[page-screen]', array(
		'default'           => $default['page-screen'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'ctpress_sanitize_select',
	) );

	$wp_customize->add_control( 'ctpress[page-screen]', array(
		'label'    => esc_html__( 'Select Page Screen Option', 'ctpress' ),
		'section'  => 'ctpress_section_page',
		'settings' => 'ctpress[page-screen]',
		'type'     => 'select',
		'priority' => 10,
		'choices'  => array(
			1 => esc_html__( 'Right Sidebar', 'ctpress' ),
            2 => esc_html__( 'Left Sidebar', 'ctpress' ),
            3 => esc_html__( 'No Sidebar', 'ctpress' ),
            4 => esc_html__( 'Full width', 'ctpress' ),
		),
	) );

	/*Add Setting and Control for showing menu search.*/
	$wp_customize->add_setting( 'ctpress[page-heading]', array(
		'default'           => $default['page-heading'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'ctpress_sanitize_select',
	) );

	$wp_customize->add_control( 'ctpress[page-heading]', array(
		'label'    => esc_html__( 'Select Heading Show Option', 'ctpress' ),
		'section'  => 'ctpress_section_page',
		'settings' => 'ctpress[page-heading]',
		'type'     => 'select',
		'priority' => 20,
		'choices'  => array(
			esc_html__( 'Above Feature Image', 'ctpress' ),
			esc_html__( 'Below Feature Image', 'ctpress' ),
		),
	) );	

	/*Add Menu Details Headline.*/
	$wp_customize->add_control( new ctpress_Customize_Header_Control(
		$wp_customize, 'page_img_cap_settings', array(
			'label'    => esc_html__( 'Featured Image Caption Hide', 'ctpress' ),
			'section'  => 'ctpress_section_page',
			'settings' => array(),
			'priority' => 30,
		)
	) );

	/*Add Setting and Control for showing page image caption.*/
	$wp_customize->add_setting( 'ctpress[page_img_cap]', array(
		'default'           => $default['page_img_cap'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'ctpress_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'ctpress[page_img_cap]', array(
		'label'    => esc_html__( 'Hide Caption', 'ctpress' ),
		'section'  => 'ctpress_section_page',
		'settings' => 'ctpress[page_img_cap]',
		'type'     => 'checkbox',
		'priority' => 32
	) );

}
add_action( 'customize_register', 'ctpress_customize_register_page_settings' );

