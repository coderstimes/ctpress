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
function ctpress_customize_register_logo_settings( $wp_customize ) {

    $wp_customize->remove_section('title_tagline');

	/*Add Sections for Logo Settings.*/
	$wp_customize->add_section( 'ctpress_section_logo', array(
		'title'    => esc_html__( 'Logo Settings', 'ctpress' ),
		'priority' => 40,
		'panel'    => 'ctpress_options_panel',
		'capability'  => 'edit_theme_options', /*Capability needed to tweak*/
		'description' => __('Allows you to customize logo and logo position, After publish check result in live site', 'ctpress'), /*//Descriptive tooltip*/
	) );

	/*Get Default Settings.*/
	$default = ctpress_default_options();

	/*Add Setting and Control for showing menu search.*/
	$wp_customize->add_setting( 'ctpress[logo-position]', array(
		'default'           => $default['logo-position'],
		'type'              => 'option',		
		'sanitize_callback' => 'ctpress_sanitize_select',
	) );

	$wp_customize->add_control( 'ctpress[logo-position]', array(
		'label'    => esc_html__( 'Select Post Screen Option', 'ctpress' ),
		'section'  => 'ctpress_section_logo',
		'settings' => 'ctpress[logo-position]',
		'type'     => 'select',
		'priority' => 10,
		'choices'  => array(
			1 => esc_html__( 'Left Logo' ),
            2 => esc_html__( 'Center Logo' ),
            3 => esc_html__( 'Right Logo' ),            
            4 => esc_html__( 'Right Logo Left Column' ),
            5 => esc_html__( 'Left Logo Right Column' ),
		),
	) );


	$wp_customize->add_setting( 'ctpress[logo][url]', array(
        'default'			=> $default['logo']['url'], /*Add Default Image URL */
        'type'              => 'option',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ctpress_section_logo_url', array(
        'label' => esc_html__( 'Upload Main Logo', 'ctpress' ),
        'priority' => 20,
        'section' => 'ctpress_section_logo',
        'settings' => 'ctpress[logo][url]',
        'button_labels' => array(
        	/*All These labels are optional*/
            'select' => 'Select Logo',
            'remove' => 'Remove Logo',
            'change' => 'Change Logo',
        ),
    )));
    
	$wp_customize->add_setting( 'ctpress[favicon][url]', array(
        'type'              => 'option',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ));
 
    $wp_customize->add_control( new WP_Customize_Site_Icon_Control( $wp_customize, 'ctpress_section_favicon_url', array(
        'label' => esc_html__( 'Upload Site Icon', 'ctpress' ),
        'description' => sprintf(
			'<p>' . __( 'Site Icons are what you see in browser tabs, bookmark bars, and within the WordPress mobile apps. Upload one here!', 'ctpress' ) . '</p>' .
			/* translators: %s: Site icon size in pixels. */
			'<p>' . __( 'Site Icons should be square and at least %s pixels.', 'ctpress' ) . '</p>',
			'<strong>512 &times; 512</strong>'
		),
        'priority' => 30,
        'section' => 'ctpress_section_logo',
        'settings' => 'ctpress[favicon][url]',
        'height'      => 512,
        'width'       => 512,
    )));

    $wp_customize->add_setting( 'ctpress[footer_logo][url]', array(
        'default'           => $default['footer_logo']['url'], /*Add Default Image URL */
        'type'              => 'option',
        'sanitize_callback' => 'esc_url_raw',
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ctpress_section_flogo', array(
        'label' => esc_html__( 'Upload Footer Logo', 'ctpress' ),
        'priority' => 40,
        'section' => 'ctpress_section_logo',
        'settings' => 'ctpress[footer_logo][url]',
    )));

}
add_action( 'customize_register', 'ctpress_customize_register_logo_settings' );


?>

