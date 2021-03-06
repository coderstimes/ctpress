<?php
/**
 * Post Settings
 *
 * Register Post Settings section, settings and controls for Theme Customizer
 *
 * @package ctpress
 */

/**
 * Adds post settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function ctpress_customize_register_post_settings( $wp_customize ) {

	/*Add Sections for Post Settings.*/
	$wp_customize->add_section( 'ctpress_section_post', array(
		'title'    => esc_html__( 'Post Settings', 'ctpress' ),
		'priority' => 40,
		'panel'    => 'ctpress_options_panel',
		'capability'  => 'edit_theme_options', /*Capability needed to tweak*/
		'description' => __('Allows you to customize post screen', 'ctpress'), /*//Descriptive tooltip*/
	) );

	/*Get Default Settings.*/
	$default = ctpress_default_options();

	/*Add Setting and Control for showing menu search.*/
	$wp_customize->add_setting( 'ctpress[post-screen]', array(
		'default'           => $default['post-screen'],
		'type'              => 'option',
		// 'transport'         => 'postMessage',
		'sanitize_callback' => 'ctpress_sanitize_select',
	) );

	$wp_customize->add_control( 'ctpress[post-screen]', array(
		'label'    => esc_html__( 'Select Post Screen Option', 'ctpress' ),
		'section'  => 'ctpress_section_post',
		'settings' => 'ctpress[post-screen]',
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
	$wp_customize->add_setting( 'ctpress[post-heading]', array(
		'default'           => $default['post-heading'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'ctpress_sanitize_select',
	) );

	$wp_customize->add_control( 'ctpress[post-heading]', array(
		'label'    => esc_html__( 'Select Heading Show Option', 'ctpress' ),
		'section'  => 'ctpress_section_post',
		'settings' => 'ctpress[post-heading]',
		'type'     => 'select',
		'priority' => 20,
		'choices'  => array(
			esc_html__( 'Above Featured Image', 'ctpress' ),
			esc_html__( 'Below Featured Image', 'ctpress' ),
		),
	) );

	/*Featured Image caption settings.*/
	$wp_customize->add_setting( 'ctpress[post_img_cap]', array(
		'default'           => $default['post_img_cap'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'ctpress_sanitize_select',
	) );

	$wp_customize->add_control( 'ctpress[post_img_cap]', array(
		'label'    => esc_html__( 'Featured Image Caption', 'ctpress' ),
		'section'  => 'ctpress_section_post',
		'settings' => 'ctpress[post_img_cap]',
		'type'     => 'select',
		'priority' => 35,
		'choices'  => array(
			1 => esc_html__( 'Below Image', 'ctpress' ),
            2 => esc_html__( 'Above Image', 'ctpress' ),
            3 => esc_html__( 'Overlay Image', 'ctpress' ),
            4 => esc_html__( 'Hide Caption', 'ctpress' ),
		),
	) );

	/*Hide Post Navigation Headline.*/
	$wp_customize->add_control( new ctpress_Customize_Header_Control(
		$wp_customize, 'post_navigation_settings', array(
			'label'    => esc_html__( 'Post Navigation Hide', 'ctpress' ),
			'section'  => 'ctpress_section_post',
			'settings' => array(),
			'priority' => 40,
		)
	) );

	/*Add Setting and Control for post navigation .*/
	$wp_customize->add_setting( 'ctpress[post-navigation]', array(
		'default'           => $default['post-navigation'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'ctpress_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'ctpress[post-navigation]', array(
		'label'    => esc_html__( 'Hide Navigation', 'ctpress' ),
		'section'  => 'ctpress_section_post',
		'settings' => 'ctpress[post-navigation]',
		'type'     => 'checkbox',
		'priority' => 42
	) );

	/*Hide Post Tags Headline.*/
	$wp_customize->add_control( new ctpress_Customize_Header_Control(
		$wp_customize, 'post_tag_settings', array(
			'label'    => esc_html__( 'Post Tags Hide', 'ctpress' ),
			'section'  => 'ctpress_section_post',
			'settings' => array(),
			'priority' => 50,
		)
	) );

	/*Add Setting and Control for post tags.*/
	$wp_customize->add_setting( 'ctpress[post-tags]', array(
		'default'           => $default['post-tags'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'ctpress_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'ctpress[post-tags]', array(
		'label'    => esc_html__( 'Hide Tags', 'ctpress' ),
		'section'  => 'ctpress_section_post',
		'settings' => 'ctpress[post-tags]',
		'type'     => 'checkbox',
		'priority' => 52
	) );

	/*Hide Post Comment.*/
	$wp_customize->add_control( new ctpress_Customize_Header_Control(
		$wp_customize, 'post_comment_settings', array(
			'label'    => esc_html__( 'Post Comment Hide', 'ctpress' ),
			'section'  => 'ctpress_section_post',
			'settings' => array(),
			'priority' => 60,
		)
	) );

	/*Add Setting and Control for post comment.*/
	$wp_customize->add_setting( 'ctpress[post-comment]', array(
		'default'           => $default['post-comment'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'ctpress_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'ctpress[post-comment]', array(
		'label'    => esc_html__( 'Hide Comment', 'ctpress' ),
		'section'  => 'ctpress_section_post',
		'settings' => 'ctpress[post-comment]',
		'type'     => 'checkbox',
		'priority' => 62
	) );

}
add_action( 'customize_register', 'ctpress_customize_register_post_settings' );

