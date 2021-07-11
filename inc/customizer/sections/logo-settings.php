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
function ctpress_customize_register_logo_settings( $wp_customize ) 
{
    /*Add postMessage support for site title and description.*/
    $wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

    /*Add selective refresh for site title and description.*/
    $wp_customize->selective_refresh->add_partial( 'blogname', array(
        'selector'        => '.site-title a',
        'render_callback' => 'ctpress_customize_partial_blogname',
    ) );
    $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
        'selector'        => '.site-description',
        'render_callback' => 'ctpress_customize_partial_blogdescription',
    ) );

    /*Add Display Site Title Setting.*/
    $wp_customize->add_setting( 'ctpress[site_title]', array(
        'default'           => true,
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'ctpress_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'ctpress[site_title]', array(
        'label'    => esc_html__( 'Display Site Title', 'ctpress' ),
        'section'  => 'title_tagline',
        'settings' => 'ctpress[site_title]',
        'type'     => 'checkbox',
        'priority' => 10,
    ) );

    /*Add Display Tagline Setting.*/
    $wp_customize->add_setting( 'ctpress[site_description]', array(
        'default'           => true,
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'ctpress_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'ctpress[site_description]', array(
        'label'    => esc_html__( 'Display Tagline', 'ctpress' ),
        'section'  => 'title_tagline',
        'settings' => 'ctpress[site_description]',
        'type'     => 'checkbox',
        'priority' => 11,
    ) );

    /*Add Retina Logo Headline.*/
    $wp_customize->add_control( new Ctpress_Customize_Header_Control(
        $wp_customize, 'ctpress[retina_logo_title]', array(
            'label'    => esc_html__( 'Retina Logo', 'ctpress' ),
            'section'  => 'title_tagline',
            'settings' => array(),
            'priority' => 8,
        )
    ) );

    /*Add Display date Setting.*/
    $wp_customize->add_setting( 'ctpress[theme-date]', array(
        'default'           => true,
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'ctpress_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'ctpress[theme-date]', array(
        'label'    => esc_html__( 'Display Date', 'ctpress' ),
        'section'  => 'title_tagline',
        'settings' => 'ctpress[theme-date]',
        'type'     => 'checkbox',
        'priority' => 12,
    ) );


	/*Add Setting and Control for logo position.*/
	$wp_customize->add_setting( 'ctpress[logo-position]', array(
		'default'           => 2,
		'type'              => 'option',		
		'sanitize_callback' => 'ctpress_sanitize_select',
	) );

	$wp_customize->add_control( 'ctpress[logo-position]', array(
		'label'    => esc_html__( 'Select Logo Position', 'ctpress' ),
		'section'  => 'title_tagline',
		'settings' => 'ctpress[logo-position]',
		'type'     => 'select',
		'priority' => 2,
		'choices'  => array(
			1 => esc_html__( 'Left Logo', 'ctpress' ),
            2 => esc_html__( 'Center Logo', 'ctpress' ),
            3 => esc_html__( 'Right Logo', 'ctpress' ),            
            4 => esc_html__( 'Right Logo Left Column', 'ctpress' ),
            5 => esc_html__( 'Left Logo Right Column', 'ctpress' ),
		),
	) );

}

add_action( 'customize_register', 'ctpress_customize_register_logo_settings' );

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
