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
		require( get_template_directory() . '/inc/customizer/sanitize-functions.php' );

		/*Load Custom Controls.*/
		require( get_template_directory() . '/inc/customizer/controls/headline-control.php' );

		/*Load Customizer Sections.*/
		require( get_template_directory() . '/inc/customizer/sections/theme-colors.php' );
		require( get_template_directory() . '/inc/customizer/sections/comment-settings.php' );
		require( get_template_directory() . '/inc/customizer/sections/post-settings.php' );
		require( get_template_directory() . '/inc/customizer/sections/page-settings.php' );
		require( get_template_directory() . '/inc/customizer/sections/social-link-settings.php' );
		require( get_template_directory() . '/inc/customizer/sections/footer-settings.php' );

		add_action( 'customize_register', [$this,'ctpress_customize_register'] );
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

		// Add Theme Options Panel.
		$wp_customize->add_panel( 'ctpress_options_panel', array(
			'priority'       => 120,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Theme Settings', 'ctpress' ),
		) );

		// Change default background section.
		$wp_customize->get_control( 'background_color' )->section = 'background_image';
		$wp_customize->get_control( 'background_color' )->label = esc_html__( 'Site background color', 'ctpress' );
		$wp_customize->get_section( 'background_image' )->title   = esc_html__( 'Background settings', 'ctpress' );
		$wp_customize->get_control( 'background_image' )->label = esc_html__( 'Site background Image', 'ctpress' );
	}

	/**
	 * Embed JS file to make Theme Customizer preview reload changes asynchronously.
	 */
	public function ctpress_customize_js() 
	{
		wp_enqueue_script( 'ctpress-customize-preview', get_template_directory_uri() . '/assets/js/customize-preview.js', array( 'customize-preview' ), '1.0.0', true );
	}


	/**
	 * Embed JS for Customizer Controls.
	 */
	public function ctpress_customizer_js() 
	{
		wp_enqueue_script( 'ctpress-customizer-controls', get_template_directory_uri() . '/assets/js/customizer-controls.js', array(), '1.0.0', true );
	}


	/**
	 * Embed CSS styles Customizer Controls.
	 */
	public function ctpress_customizer_css() 
	{
		wp_enqueue_style( 'ctpress-customizer-controls', get_template_directory_uri() . '/assets/css/customizer-controls.css', array(), '1.0.0' );
	}

	/**
    * This will output the custom WordPress settings to the live theme's WP head.
    * 
    * Used by hook: 'wp_head'
    * 
    * @see add_action('wp_head',$func)
    * @since MyTheme 1.0
    */
   public static function header_output() {
      ?>
      <!--Customizer CSS--> 
      <style type="text/css">
           <?php
           $data = [
           	'theme_bg_color' => ['--theme-bg-color',':root'],
           	'theme_color' => ['--theme-color',':root'],
           	'theme_hover_color' => ['--theme-hover-color',':root'],
           ];
           self::generate_css( $data ); 
           ?> 
      </style> 
      <!--/Customizer CSS-->
      <?php
   }


    /**
     * This will generate a line of CSS for use in header output. If the setting
     * ($mod_name) has no defined value, the CSS will not be output.
     * 
     * @uses get_theme_mod()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $mod_name The name of the 'theme_mod' option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since MyTheme 1.0
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