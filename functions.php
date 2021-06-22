<?php 
/**
 * Beautinhealth and definitions
 *
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since CodersTime publications 1.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'ctpress_theme_functions' ) ) :

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Ctpress 1.0
*/

    function ctpress_theme_functions ( ) {

        /*Add default posts and comments RSS feed links to head.*/
        add_theme_support( 'automatic-feed-links' );
    	add_theme_support( 'title-tag' );
        // add_theme_support( 'custom-logo' );
        // add_theme_support( 'custom-background' );
        add_theme_support( 'post-thumbnails' );

         add_theme_support(
            'html5',
            [
                'comment-list',
                'comment-form',
                'search-form',
                'gallery',
                'caption',
                'style',
                'script',
            ]
        );

        add_theme_support(
            'post-formats',
            [
                'link',
                'gallery',
                'image',
                'quote',
                'video',
                'audio',
            ]
        );

        $defaults = array(
            'height'               => 100,
            'width'                => 400,
            'flex-height'          => true,
            'flex-width'           => true,
            'unlink-homepage-logo' => true, 
        );
 
        // add_theme_support( 'custom-logo', $defaults );

        /*Add theme support for AMP.*/
        add_theme_support( 'amp' );

        function more_excerpt( $limit ){
        	$full_content= explode(' ', preg_replace('/<img[^>]+./','',get_the_excerpt()));
        	$less_content= array_slice($full_content, 0, $limit);
        	$show_conent= implode(' ', $less_content);
        	return $show_conent;
        }

        function more_content( $limit ){
            $full_content= explode(' ', preg_replace('/<img[^>]+./','',get_the_excerpt()));
            $less_content= array_slice($full_content, 0, $limit);
            $show_conent= implode(' ', $less_content);
            return $show_conent;
        }

        function title_more( $limit ){
        	$full_content= explode(' ', get_the_title());
        	$less_content= array_slice($full_content, 0, $limit);
        	$show_conent= implode(' ', $less_content);
        	return $show_conent;
        }

    	if ( function_exists('register_nav_menus')) {
    			register_nav_menus([
    		    'main_menu'=> esc_html__( 'Main menu', 'ctpress' )
    		]);
    	}

    }
endif;
add_action('after_setup_theme', 'ctpress_theme_functions');

final class codersTimePress {

    public function __construct ( ) 
    {
        add_action( 'init', [ $this, 'ctpress_common_enqueue_register_files' ] );
        add_action( 'wp_enqueue_scripts',[ $this,'ctpress_public_assets' ] );
        /*ctpress common sidebar call*/
        add_action( 'widgets_init', [$this, 'ctpress_common_sidebar'] );

        /*menu and submenu boostrap 5 convert*/
        add_filter( 'nav_menu_link_attributes', [ $this,'add_additional_class_on_li' ], 10, 4 );
        /*ad class on ul li*/
        add_filter( 'nav_menu_css_class', function( $classes ) { $classes[] = 'nav-item'; return $classes; }, 10, 1 );
        add_filter( 'nav_menu_submenu_css_class', function( $subclass ) { return ['dropdown-menu'];} );
    }

    /*
    * CSS and JavaScript file enqueue/load
    */
    public function ctpress_public_assets ( $screen ) 
    {
        wp_enqueue_style( 'bootstrap' );
        wp_enqueue_style( 'bootsnav_style' );
        wp_enqueue_style( 'style-inews' );
        wp_enqueue_style( 'style' );
        wp_enqueue_script( 'bootstrap' );
    }

    /*
    * Common css and javaScript file register 
    */

    public function ctpress_common_enqueue_register_files ( ) 
    {
        $asset_file_link = get_template_directory_uri() . '/';
        $folder_path= __DIR__ . '/';

        wp_register_style( 'bootstrap', $asset_file_link . 'assets/bootstrap/bootstrap.min.css', [], '5.0.0' );
        wp_register_style( 'bootsnav_style', $asset_file_link . 'assets/bootsnav/bootsnav.css', [], filemtime($folder_path.'assets/bootsnav/bootsnav.css') );
        wp_register_style( 'style-inews', $asset_file_link . 'assets/css/style.css', [], filemtime($folder_path.'assets/css/style.css') );
        wp_register_style( 'style', $asset_file_link . 'style.css', [], filemtime($folder_path.'style.css') );
        
        wp_register_script( 'bootstrap', $asset_file_link . 'assets/bootstrap/bootstrap.min.js', [ 'jquery' ], '5.0.0',true );
    }

    public function ctpress_common_sidebar ( ) 
    {
        register_sidebar(array(
            'name'          => esc_html__( 'Common Sidebar', 'ctpress' ),
            'description'   => esc_html__( 'This sidebar for all pages and posts', 'ctpress' ),
            'id'            =>'common_sidebar',
            'before_title'  =>'<h3 class="py-3">',
            'after_title'   =>'</h3>',
            'before_widget' =>'<div class="common_sidebar sidebar_widget my-4">',
            'after_widget' =>'</div>',
        ));
        register_sidebar(array(
            'name'          => esc_html__( 'Page Sidebar', 'ctpress' ),
            'description'   => esc_html__( 'This sidebar for all page', 'ctpress' ),
            'id'            =>'page_sidebar',
            'before_title'  =>'<h3 class="py-3">',
            'after_title'   =>'</h3>',
            'before_widget' =>'<div class="page_sidebar sidebar_widget my-4">',
            'after_widget' =>'</div>',
        ));
        register_sidebar(array(
            'name'          => esc_html__( 'Post Sidebar', 'ctpress' ),
            'description'   => esc_html__( 'This sidebar for all post', 'ctpress' ),
            'id'            =>'post_sidebar',
            'before_title'  =>'<h3 class="py-3">',
            'after_title'   =>'</h3>',
            'before_widget' =>'<div class="post_sidebar sidebar_widget my-4">',
            'after_widget' =>'</div>',
            'before_sidebar' => '<div class="before_sidebar">',
            'after_sidebar'  => '</div>',
        ));
        register_sidebar(array(
            'name'          => esc_html__( 'Homepage Sidebar', 'ctpress' ),
            'description'   => esc_html__( 'This sidebar for Homepage two column', 'ctpress' ),
            'id'            =>'home_sidebar',
            'before_title'  =>'<h3 class="py-3">',
            'after_title'   =>'</h3>',
            'before_widget' =>'<div class="home_sidebar sidebar_widget my-4">',
            'after_widget' =>'</div>',
            'before_sidebar' => '<div class="before_sidebar">',
            'after_sidebar'  => '</div>',
        ));
        register_sidebar(array(
            'name'          => esc_html__( 'Category Sidebar', 'ctpress' ),
            'description'   => esc_html__( 'This sidebar for Category two column', 'ctpress' ),
            'id'            =>'category_sidebar',
            'before_title'  =>'<h3 class="py-3">',
            'after_title'   =>'</h3>',
            'before_widget' =>'<div class="category_sidebar sidebar_widget my-4">',
            'after_widget' =>'</div>',
            'before_sidebar' => '<div class="before_sidebar">',
            'after_sidebar'  => '</div>',
        ));

        register_sidebar(array(
            'name'          => esc_html__( 'Homepage 1 Sidebar', 'ctpress' ),
            'description'   => esc_html__( 'This sidebar for homepage 1 sidebar (Latest Popular news)', 'ctpress' ),
            'id'            =>'homepage_sidebar',
            'before_title'  =>'<h3 class="py-3">',
            'after_title'   =>'</h3>',
            'before_widget' =>'<div class="homepage_sidebar sidebar_widget my-4">',
            'after_widget' =>'</div>',
            'before_sidebar' => '<div class="before_sidebar">',
            'after_sidebar'  => '</div>',
        ));
    }

    /*ad class on ul li a*/
    public function add_additional_class_on_li( $atts, $item, $args, $depth ) 
    {
        if ( in_array('menu-item-has-children', $item->classes )) {
            $item->classes[] = 'dropdown';
            $atts['class'] = 'nav-link dropdown-toggle';
            $atts['id'] = 'navbarDropdown_' . $item->ID;
            $atts['href'] = '#';
            $atts['role'] = 'button';
            $atts['data-bs-toggle'] = 'dropdown';
            $atts['aria-expanded'] = 'false';
        } else {
            $atts['class'] = 'nav-link';
        }
        
        return $atts;
    }
}

new codersTimePress();

/*post view number function*/
function getPostViews( $postID ) 
{
    $count_key = 'post_views_count';
    $count = get_post_meta( $postID, $count_key, true) ? : 1;
    return $count;
}

function setPostViews ( $postID ) 
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true) ? : 0;
    update_post_meta( $postID, $count_key, $count += 1 ); 
}

if ( ! function_exists( 'ctpress_get_post_image' ) ) :
    function ctpress_get_post_image ( $size = 'medium' ) {
        $image_id = get_post_thumbnail_id();
        $medium_img = wp_get_attachment_image_src( $image_id, $size );
        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true) ?: get_the_title();
        
        if ( $medium_img ) :
            return sprintf('<figure class="img-holder text-center"><img class="img-responsive" src="%s" alt="%s"></figure>', $medium_img[0], $image_alt );
        else:
            return;
        endif;
    }
endif;



/**
 * Include Files
 */

/*load recent and popular custom widget*/
require get_template_directory() . '/widgets/latest-popular.php';

/*Framework/Settings files*/
require get_template_directory() . '/lib/ReduxCore/framework.php';
require get_template_directory() . '/lib/sample/config.php';


// Include Customizer Options.
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/default-options.php';

// Include Template Functions.
// require get_template_directory() . '/inc/template-functions.php';

// Include Template Tags.
require get_template_directory() . '/inc/template-tags.php';

// Include Gutenberg Features.
require get_template_directory() . '/inc/gutenberg.php';

// Include support functions for Theme Addons.
// require get_template_directory() . '/inc/addons.php';

