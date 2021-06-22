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
function ctpress_customize_register_comment_settings( $wp_customize ) {

	/*Add Sections for Menu Settings.*/
	$wp_customize->add_section( 'ctpress_section_comment', array(
		'title'    => esc_html__( 'Comment Settings', 'ctpress' ),
		'priority' => 40,
		'panel'    => 'ctpress_options_panel',
		'capability'  => 'edit_theme_options', /*Capability needed to tweak*/
		'description' => __('Allows you to customize comment display', 'ctpress'), /*//Descriptive tooltip*/
	) );

	/*Get Default Settings.*/
	$default = ctpress_default_options();

	/*Add Setting and Control for showing menu search.*/
	$wp_customize->add_setting( 'ctpress[comment_option]', array(
		'default'           => $default['comment_option'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'ctpress_sanitize_select',
	) );

	$wp_customize->add_control( 'ctpress[comment_option]', array(
		'label'    => esc_html__( 'Select Comment API', 'ctpress' ),
		'section'  => 'ctpress_section_comment',
		'settings' => 'ctpress[comment_option]',
		'type'     => 'select',
		'priority' => 1,
		'choices'  => array(
			esc_html__( 'WordPress', 'ctpress' ),
			esc_html__( 'Facebook', 'ctpress' ),
		),
	) );	


	/*Facebook appid setting.*/
	$wp_customize->add_setting( 'ctpress[fb_appId]', array(
		'default'           => $default['fb_appId'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'ctpress[fb_appId]', array(
		'label'    => esc_html__( 'Facebook App ID', 'ctpress' ),
		'section'  => 'ctpress_section_comment',
		'settings' => 'ctpress[fb_appId]',
		'type'     => 'text',
		'priority' => 20,
	) );

}
add_action( 'customize_register', 'ctpress_customize_register_comment_settings' );


