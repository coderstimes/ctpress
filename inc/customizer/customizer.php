<?php
/**
 * Implement theme options in the Customizer
 *
 * @package Ctpress
 */

final class CTPressCustomizer {

	public function __construct ( ) 
	{
		/*Load Sanitize Functions.*/
		require( 'sanitize-functions.php' );

		/*Load Custom Controls.*/
		require( 'controls/headline-control.php' );

		/*Load Customizer Sections.*/
		require( 'sections/logo-settings.php' );
		require( 'sections/theme-colors.php' );
		require( 'sections/homepage-category-settings.php' );
		require( 'sections/comment-settings.php' );
		require( 'sections/post-settings.php' );
		require( 'sections/page-settings.php' );
		require( 'sections/social-link-settings.php' );
		require( 'sections/footer-settings.php' );

		add_action( 'customize_register', [ $this,'ctpress_customize_register' ] );
		add_action( 'customize_preview_init', [$this,'ctpress_customize_js'] );
		add_action( 'customize_controls_enqueue_scripts', [$this,'ctpress_customizer_js'] );
		add_action( 'customize_controls_print_styles', [$this,'ctpress_customizer_css'] );

		/*Output custom CSS to live site*/
		add_action( 'wp_head' , [ $this , 'header_output' ] );

	}

	/**
	 * Registers Theme Options panel and sets up some WordPress core settings
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	public function ctpress_customize_register( $wp_customize ) 
	{
		/*Add Theme Options Panel.*/
		$wp_customize->add_panel( 'ctpress_options_panel', array(
			'priority'       => 10,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Theme Settings', 'ctpress' ),
		) );

		// Change default background section.
		$wp_customize->get_control( 'background_color' )->section = 'background_image';
		$wp_customize->get_section( 'background_image' )->title   = esc_html__( 'Background settings', 'ctpress' );
		$wp_customize->get_control( 'background_image' )->label = esc_html__( 'Site background Image', 'ctpress' );
		$wp_customize->get_control( 'background_color' )->label = esc_html__( 'Site background color', 'ctpress' );
	}

	/**
	 * Embed JS file to make Theme Customizer preview reload changes asynchronously.
	 */
	public function ctpress_customize_js() 
	{
		wp_enqueue_script( 'ctpress-customize-preview', get_template_directory_uri() . '/assets/js/customize-preview.js', array( 'customize-preview', 'select2' ), time(), true );
	}

	/**
	 * Embed JS for Customizer Controls.
	 */
	public function ctpress_customizer_js() 
	{
		wp_enqueue_script( 'ctpress-customizer-controls', get_template_directory_uri() . '/assets/js/customizer-controls.js', array(), '1.0.3', true );
	}


	/**
	 * Embed CSS styles Customizer Controls.
	 */
	public function ctpress_customizer_css() 
	{
		wp_enqueue_style( 'ctpress-customizer-controls', get_template_directory_uri() . '/assets/css/customizer-controls.css', array(), '1.0.3' );
	}

	/**
    * This will output the custom WordPress settings to the live theme's WP head.
    * @since ctpress 1.0
    */
   public static function header_output() {
      ?>
      <!--Customizer CSS--> 
      <style>
         <?php
           $data = [
           	'theme_bg_color' 		=> ['--ctpress-bg-color',':root'],
           	'theme_color' 			=> ['--ctpress-color',':root'],
           	'theme_hover_color' 	=> ['--ctpress-hover-color',':root'],
           ];
           self::generate_css( $data ); 
          ?> 
      </style> 
      <!--/Customizer CSS-->
      <?php
   }


    /**
     * This will generate a line of CSS for use in header output. If the setting
     * @since ctpress 1.0
     */
    public static function generate_css( $data, $prefix='', $postfix='', $echo=true ) {
		$value = '';
		$theme_data = ctpress_theme_options();
		foreach ( $data as $key => $datum ) {
		     $value .= sprintf('%s { %s:%s; } ',
		        $datum[1],
		        $datum[0],
		        $prefix.$theme_data[$key].$postfix
		     );
		}

		if ( $echo ) {
			echo $value;
		}
      
      return $value;
    }

}

new CTPressCustomizer;


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

	/*Merge theme options array from database with default options array.*/
	$theme_options = wp_parse_args( get_option( 'ctpress', array() ), ctpress_default_options() );

	/*Return theme options.*/
	return apply_filters( 'ctpress_theme_options', $theme_options );
}


/**
 * Returns the default settings of the theme
 *
 * @return array
 */
function ctpress_default_options() {

	$default_options = array(
		'retina_logo'            => false,
		'site_title'             => true,
		'site_description'       => true,
		'footer_logo'            => ['url'=>false],
		'logo-position'          => 2,
		'theme-date'             => true,
		'comment_option'         => 0,
		'fb_appId'         		 => '492209628792946',
		'post-screen'         	 => 1,
		'post-heading'         	 => 0,
		'post_img_cap'         	 => 0,
		'post-navigation'      	 => 0,
		'post-tags'      	 	 	 => 0,
		'post-comment'      	 	 => 0,
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

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

function ctpress_body_classes( $classes ) {

	// Get theme options from database.
	$theme_options = ctpress_theme_options();


	// Check if sidebar is displayed on the left.
	if ( $logo_position = $theme_options['logo-position'] ) {
		switch( $logo_position ) {
         case 1 :  
         	$classes[] = 'logo-left';
            break;
         case 2 : 
            $classes[] = 'logo-center';
            break;
         case 3 :
            $classes[] = 'logo-right';
            break;
         case 4 :
            $classes[] = 'logo-right';
            break;
         case 5 :
            $classes[] = 'logo-left';
            break;
         default:
         break;
      }

		$classes[] = 'sidebar-left';
	}

	// Hide Site Title?
	if ( false === $theme_options['site_title'] ) {
		$classes[] = 'site-title-hidden';
	}

	// Hide Site Description?
	if ( false === $theme_options['site_description'] ) {
		$classes[] = 'site-description-hidden';
	}

	// Hide Date?
	if ( false === $theme_options['theme-date'] ) {
		$classes[] = 'theme-date-hidden';
	}

	// Hide Date?
	// if ( ( false === $theme_options['theme-date'] && ! is_single() )
	// 	or ( false === $theme_options['single_meta_date'] && is_single() ) ) {
	// 	$classes[] = 'date-hidden';
	// }

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'ctpress_body_classes' );

