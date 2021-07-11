<?php
/**
 * Post Settings
 *
 * Register Homepage categories section, settings and controls for Theme Customizer
 *
 * @package ctpress
 */

/**
 * Adds post settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function ctpress_customize_register_homepage_cat_settings( $wp_customize ) {

	/*Add Sections for Logo Settings.*/
	$wp_customize->add_section( 'ctpress_home_catergory', array(
		'title'    => esc_html__( 'Homepage Category', 'ctpress' ),
		'priority' => 40,
		'panel'    => 'ctpress_options_panel',
		'capability'  => 'edit_theme_options', /*Capability needed to tweak*/
		'description' => __('Homepage Article category settings panel', 'ctpress'), /*//Descriptive tooltip*/
	) );

	/*Get Default Settings.*/
	$default = ctpress_default_options();
    $post_categories = get_categories( array(
        'orderby'       => 'name',
        'hide_empty'    => false,
    ) );
    $post_categories = array_column($post_categories, 'name', 'term_id');

    /*Add Setting Homepage 1 top left (second Lead) article category.*/
    $wp_customize->add_setting( 'ctpress[topleft]', array(
        'default'           => '',
        'type'              => 'option',        
        'sanitize_callback' => 'ctpress_text_sanitization',
    ) );

    $wp_customize->add_control( new CTPress_Select2_Custom_Control( $wp_customize,'ctpress-topleft', array(
            'label'    => esc_html__( 'Select Home top left category (Lead)', 'ctpress' ),
            'description' => esc_html__( 'Homepage 1 top area lead news/article category, Selected category sticky post will be shown here', 'ctpress' ),
            'section'  => 'ctpress_home_catergory',
            'settings' => 'ctpress[topleft]',
            'priority' => 10,
            'input_attrs' => array(
                'placeholder' => __( 'Please select a category', 'ctpress' ),
                'multiselect' => false,
            ),
            'choices'  => $post_categories
        )
    ) );

    /*Add Setting Homepage 1 top middle (second Lead) article category.*/
    $wp_customize->add_setting( 'ctpress[topmiddle]', array(
        'default'           => '',
        'type'              => 'option',        
        'sanitize_callback' => 'ctpress_text_sanitization',
    ) );

    $wp_customize->add_control( new CTPress_Select2_Custom_Control( $wp_customize, 'ctpress-topmiddle', array(
            'label'    => esc_html__( 'Select Home top middle category', 'ctpress' ),
            'description' => esc_html__( 'Homepage 1 top area middle article category, Selected category sticky post will be shown here', 'ctpress' ),
            'section'  => 'ctpress_home_catergory',
            'settings' => 'ctpress[topmiddle]',
            'priority' => 20,
            'input_attrs' => array(
                'placeholder' => __( 'Please select a category', 'ctpress' ),
                'multiselect' => false,
            ),
            'choices'  => $post_categories
        )
    ) );

    /*Add Setting Homepage 1 top right (third Lead) article category.*/
    $wp_customize->add_setting( 'ctpress[topright]', array(
        'default'           => '',
        'type'              => 'option',        
        'sanitize_callback' => 'ctpress_text_sanitization',
    ) );

    $wp_customize->add_control( new CTPress_Select2_Custom_Control( $wp_customize, 'ctpress-topright', array(
            'label'    => esc_html__( 'Select Home top right category', 'ctpress' ),
            'description' => esc_html__( 'Homepage 1 top area right side article category, Selected category sticky post will be shown here', 'ctpress' ),
            'section'  => 'ctpress_home_catergory',
            'settings' => 'ctpress[topright]',
            'priority' => 30,
            'input_attrs' => array(
                'placeholder' => __( 'Please select a category', 'ctpress' ),
                'multiselect' => false,
            ),
            'choices'  => $post_categories
        )
    ) );

    /*Add Setting Homepage 1 Full Body Category.*/
    $wp_customize->add_setting( 'ctpress[fullbody]', array(
        'default'           => '',
        'type'              => 'option',        
        'sanitize_callback' => 'ctpress_text_sanitization',
    ) );

    $wp_customize->add_control( new CTPress_Select2_Custom_Control( $wp_customize, 'ctpress-fullbody', array(
            'label'    => esc_html__( 'Select Home Full Body Category', 'ctpress' ),
            'description' => esc_html__( 'Homepage 1 top area full body categories', 'ctpress' ),
            'section'  => 'ctpress_home_catergory',
            'settings' => 'ctpress[fullbody]',
            'priority' => 30,
            'input_attrs' => array(
                'placeholder' => __( 'Please select one or multiple categories', 'ctpress' ),
                'multiselect' => true,
            ),
            'choices'  => $post_categories
        )
    ) );

    /*Add Setting Homepage 1 body one article category.*/
    $wp_customize->add_setting( 'ctpress[body_one]', array(
        'default'           => '',
        'type'              => 'option',        
        'sanitize_callback' => 'ctpress_text_sanitization',
    ) );

    $wp_customize->add_control( new CTPress_Select2_Custom_Control( $wp_customize, 'ctpress-body_one', array(
            'label'    => esc_html__( 'Select Home Body One category', 'ctpress' ),
            'description' => esc_html__( 'Homepage 1 body one article category, This section main article will be selected from category sticky post', 'ctpress' ),
            'section'  => 'ctpress_home_catergory',
            'settings' => 'ctpress[body_one]',
            'priority' => 30,
            'input_attrs' => array(
                'placeholder' => __( 'Please select a category', 'ctpress' ),
                'multiselect' => false,
            ),
            'choices'  => $post_categories
        )
    ) );

    /*Add Setting Homepage 1 body two article category.*/
    $wp_customize->add_setting( 'ctpress[body_two]', array(
        'default'           => '',
        'type'              => 'option',        
        'sanitize_callback' => 'ctpress_text_sanitization',
    ) );

    $wp_customize->add_control( new CTPress_Select2_Custom_Control( $wp_customize, 'ctpress-body_two', array(
            'label'    => esc_html__( 'Select Home Body Two category', 'ctpress' ),
            'description' => esc_html__( 'Homepage 1 body two article category, This section main article will be selected from category sticky post', 'ctpress' ),
            'section'  => 'ctpress_home_catergory',
            'settings' => 'ctpress[body_two]',
            'priority' => 30,
            'input_attrs' => array(
                'placeholder' => __( 'Please select a category', 'ctpress' ),
                'multiselect' => false,
            ),
            'choices'  => $post_categories
        )
    ) );

    /*Add Setting Homepage 1 body three article category.*/
    $wp_customize->add_setting( 'ctpress[body_three]', array(
        'default'           => '',
        'type'              => 'option',        
        'sanitize_callback' => 'ctpress_text_sanitization',
    ) );

    $wp_customize->add_control( new CTPress_Select2_Custom_Control( $wp_customize, 'ctpress-body_three', array(
            'label'    => esc_html__( 'Select Home Body Three category', 'ctpress' ),
            'description' => esc_html__( 'Homepage 1 body three article category, This section main article will be selected from category sticky post', 'ctpress' ),
            'section'  => 'ctpress_home_catergory',
            'settings' => 'ctpress[body_three]',
            'priority' => 30,
            'input_attrs' => array(
                'placeholder' => __( 'Please select a category', 'ctpress' ),
                'multiselect' => false,
            ),
            'choices'  => $post_categories
        )
    ) );

    /*Add Setting Homepage 1 Full Body Footer Full Category.*/
    $wp_customize->add_setting( 'ctpress[bodybottom]', array(
        'default'           => '',
        'type'              => 'option',        
        'sanitize_callback' => 'ctpress_text_sanitization',
    ) );

    $wp_customize->add_control( new CTPress_Select2_Custom_Control( $wp_customize, 'ctpress-bodybottom', array(
            'label'    => esc_html__( 'Footer Full Body Categories', 'ctpress' ),
            'description' => esc_html__( 'Homepage 1 bottom area footer body categories', 'ctpress' ),
            'section'  => 'ctpress_home_catergory',
            'settings' => 'ctpress[bodybottom]',
            'priority' => 30,
            'input_attrs' => array(
                'placeholder' => __( 'Please select one or multiple categories', 'ctpress' ),
                'multiselect' => true,
            ),
            'choices'  => $post_categories
        )
    ) );

    /*Add Setting Homepage 1 body sidebar article category.*/
    $wp_customize->add_setting( 'ctpress[right_sidebarcat]', array(
        'default'           => '',
        'type'              => 'option',        
        'sanitize_callback' => 'ctpress_text_sanitization',
    ) );

    $wp_customize->add_control( new CTPress_Select2_Custom_Control( $wp_customize, 'ctpress-right_sidebarcat', array(
            'label'    => esc_html__( 'Home Sidebar Article category', 'ctpress' ),
            'description' => esc_html__( 'Homepage 1 body sidebar article category, This section main article will be selected from category sticky post', 'ctpress' ),
            'section'  => 'ctpress_home_catergory',
            'settings' => 'ctpress[right_sidebarcat]',
            'priority' => 30,
            'input_attrs' => array(
                'placeholder' => __( 'Please select a category', 'ctpress' ),
                'multiselect' => false,
            ),
            'choices'  => $post_categories
        )
    ) );


}
add_action( 'customize_register', 'ctpress_customize_register_homepage_cat_settings' );
