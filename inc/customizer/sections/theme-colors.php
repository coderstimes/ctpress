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
function ctpress_customize_register_menu_settings( $wp_customize ) {

	/*Add Sections for Menu Settings.*/
	$wp_customize->add_section( 'ctpress_section_theme', array(
		'title'    => esc_html__( 'Theme Colors', 'ctpress' ),
		'priority' => 40,
		'panel'    => 'ctpress_options_panel',
		'capability'  => 'edit_theme_options', /*Capability needed to tweak*/
		'description' => __('Allows you to customize theme color', 'ctpress'), /*//Descriptive tooltip*/
	) );

	/*Get Default Settings.*/
	$default = ctpress_default_options();

    /*Theme Background Color*/
	$wp_customize->add_setting(
		'ctpress[theme_bg_color]', array(
		  'default' 		  => $default['theme_bg_color'],
		  'sanitize_callback' => 'sanitize_hex_color',
		  'type' 			  => 'option',
		  'transport'         => 'postMessage',
		  'capability' 		  => 'edit_theme_options'
		)
	);  

	$wp_customize->add_control( new WP_Customize_Color_Control( 
		$wp_customize, 'ctpress[theme_bg_color]', array(
			'label' 	=> esc_html__( 'Theme background color settings', 'ctpress' ),
			'section'   => 'ctpress_section_theme',
			'settings'  => 'ctpress[theme_bg_color]'
		)
		)
	);

    /*Menu Font Color*/
	$wp_customize->add_setting(
		'ctpress[theme_color]', array(
		  'default' => $default['theme_color'],
		  'sanitize_callback' => 'sanitize_hex_color',
		  'type' => 'option',
		  'transport'         => 'postMessage',
		  'capability' => 'edit_theme_options'
		)
	);  

	$wp_customize->add_control( new WP_Customize_Color_Control( 
		$wp_customize, 'ctpress[theme_color]', array(
			'label' => esc_html__( 'Theme font color settings', 'ctpress' ),
			'section' => 'ctpress_section_theme',
			'settings' => 'ctpress[theme_color]'
		)
		)
	); 

    /*Menu Font hover Color*/
	$wp_customize->add_setting (
		'ctpress[theme_hover_color]', array(
			'default' 		  => $default['theme_hover_color'],
			'sanitize_callback' => 'sanitize_hex_color',
			'type' 			  => 'option',
			'transport'      	  => 'postMessage',
			'capability' 		  => 'edit_theme_options'
		)
	);  

	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'ctpress[theme_hover_color]', array(
			'label' => esc_html__( 'Theme font hover color settings', 'ctpress' ),
			'section' => 'ctpress_section_theme',
			'settings' => 'ctpress[theme_hover_color]'
		)
		)
	);  

	/*Add Menu Details Headline.*/
	$wp_customize->add_control( new ctpress_Customize_Header_Control(
		$wp_customize, 'menu_settings', array(
			'label'    => esc_html__( 'Menu Search Option Hide', 'ctpress' ),
			'section'  => 'ctpress_section_theme',
			'settings' => array(),
			'priority' => 10,
		)
	) );

	/*Add Setting and Control for showing menu search.*/
	$wp_customize->add_setting( 'ctpress[menu_search]', array(
		'default'           => $default['menu_search'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'ctpress_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'ctpress[menu_search]', array(
		'label'    => esc_html__( 'Hide search', 'ctpress' ),
		'section'  => 'ctpress_section_theme',
		'settings' => 'ctpress[menu_search]',
		'type'     => 'checkbox',
		'priority' => 20,
	) );

}
add_action( 'customize_register', 'ctpress_customize_register_menu_settings' );


