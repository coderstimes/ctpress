<?php 
/**
 * CTPress and definitions
 *
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since CodersTime Press 1.0
 * @author CodersTime
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
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'wp-block-styles' );
        add_theme_support( 'responsive-embeds' );

        $font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Lato:300,400,700' );
        add_editor_style( $font_url );

        add_theme_support(
            'post-formats',
            [
                'gallery',
                'image',
                'quote',
                'video',
            ]
        );

        /*Add theme support for AMP.*/
        add_theme_support( 'amp' );

        /*Switch default core markup for galleries and captions to output valid HTML5.*/
        add_theme_support( 'html5', array(
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'script', 
            'style'
        ) );

        /*Set up the WordPress core custom logo feature.*/
        add_theme_support( 'custom-logo', apply_filters( 'ctpress_custom_logo_args', array(
            'height'      => 100,
            'width'       => 300,
            'flex-height' => true,
            'flex-width'  => true,
        ) ) );

        /*Set up the WordPress core custom header feature.*/
        add_theme_support( 'custom-header', apply_filters( 'ctpress_custom_header_args', array(
            'header-text' => false,
            'width'       => 2680,
            'height'      => 600,
            'flex-width'  => true,
            'flex-height' => true,
        ) ) );

        /*Set up the WordPress core custom background feature.*/
        add_theme_support( 'custom-background', apply_filters( 'ctpress_custom_background_args', array(
            'default-color' => 'ededef',
        ) ) );


        function ctpress_excerpt( $limit ){
        	$full_content= explode(' ', preg_replace('/<img[^>]+./','',get_the_excerpt()));
        	$less_content= array_slice($full_content, 0, $limit);
        	$show_conent= implode(' ', $less_content);
        	return $show_conent;
        }

        function ctpress_content( $limit ){
            $full_content= explode(' ', preg_replace('/<img[^>]+./','',get_the_excerpt()));
            $less_content= array_slice($full_content, 0, $limit);
            $show_conent= implode(' ', $less_content);
            return $show_conent;
        }

        function ctpress_title( $limit ){
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

        /*Default content width.*/
        $content_width = 900;

        /*Set global variable for content width.*/
        $GLOBALS['content_width'] = apply_filters( 'ctpress_content_width', $content_width );

    }
endif;
add_action('after_setup_theme', 'ctpress_theme_functions');

final class codersTimePress {

    /**
     * call enqueue scripts for public and admin view
     * widget register
     * nav menu link attribute function all
     * nav menu style css call
     * nav menu submenu style css call
     * @return void
    */
    public function __construct ( ) 
    {
        define( 'CTPress_DIR', get_template_directory() );
        define( 'CTPress_URI', get_template_directory_uri() );

        add_action( 'init', array($this, 'ctpress_common_enqueue_register_files' ) );
        add_action( 'wp_enqueue_scripts', array( $this,'ctpress_public_scripts' ) );
        add_action( 'admin_enqueue_scripts', array( $this,'ctpress_admin_scripts' ) );
        /*ctpress common sidebar call*/
        add_action( 'widgets_init', [$this, 'ctpress_common_sidebar'] );

        /*menu and submenu boostrap 5 convert*/
        add_filter( 'nav_menu_link_attributes', [ $this,'add_additional_class_on_li' ], 10, 4 );
        /*ad class on ul li*/
        add_filter( 'nav_menu_css_class', function( $classes ) { $classes[] = 'nav-item'; return $classes; }, 10, 1 );
        add_filter( 'nav_menu_submenu_css_class', function( $subclass ) { return ['dropdown-menu'];} );
    }

    /**
     * Enqueue scripts for public view
     *
     * @return void
     */
    public function ctpress_public_scripts ( $screen ) 
    {
        wp_enqueue_style( 'bootstrap' );
        wp_enqueue_style( 'bootsnav' );
        wp_enqueue_style( 'style-ctpress' );
        wp_enqueue_style( 'ctpress-main-style' );
        wp_enqueue_script( 'ctpress-bootstrap' );
        /*theme common js*/
        wp_enqueue_script( 'ctpress-theme-common' );
        /*Register Comment Reply Script for Threaded Comments.*/
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }

    }

    /**
     * Enqueue scripts for our Customizer preview
     *
     * @return void
     */
    public function ctpress_admin_scripts ( ) 
    {   
        wp_enqueue_script('ctpress-select2', CTPress_URI .'/assets/js/select2.min.js', array('jquery'), '4.0.3', true );
        wp_enqueue_script('ctpress-select2-custom', CTPress_URI .'/assets/js/select2-custom.js', array('ctpress-select2'), '1.0.4', true );
        wp_enqueue_style('ctpress-select2', CTPress_URI .'/assets/js/select2.min.css',array(), '4.0.13' );
    }

    /**
     * Enqueue scripts register for our public view
     *
     * @return void
    */

    public function ctpress_common_enqueue_register_files ( ) 
    {

        wp_register_style( 'bootstrap', CTPress_URI . '/assets/bootstrap/bootstrap.min.css', [], '5.0.0' );
        wp_register_style( 'bootsnav', CTPress_URI . '/assets/bootsnav/bootsnav.min.css', [], filemtime( CTPress_DIR . '/assets/bootsnav/bootsnav.min.css') );
        wp_register_style( 'style-ctpress', CTPress_URI . '/assets/css/style.css', [], filemtime( CTPress_DIR . '/assets/css/style.css') );
        wp_register_style( 'ctpress-main-style', get_stylesheet_uri(), [], filemtime( CTPress_DIR . '/style.css') );
        wp_register_script( 'ctpress-bootstrap', CTPress_URI . '/assets/bootstrap/bootstrap.min.js', [ 'jquery' ], '5.0.0',true );
        wp_register_script( 'ctpress-theme-common', CTPress_URI . '/assets/js/theme.js', [ 'jquery' ], '1.0.0',true );
    }

    /**
     * Sidebar regisgter for common, page, posts, homepage, category
     *
     * @return void
    */

    public function ctpress_common_sidebar ( ) 
    {
        register_sidebar(array(
            'name'          => esc_html__( 'Common Sidebar', 'ctpress' ),
            'description'   => esc_html__( 'This sidebar for all pages and posts', 'ctpress' ),
            'id'            =>'common_sidebar',
            'before_title'  =>'<h3 class="py-3">',
            'after_title'   =>'</h3>',
            'before_widget' =>'<div class="common_sidebar sidebar_widget my-4">',
            'after_widget'  =>'</div>',
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
function ctpress_getviews( $postID ) 
{
    $count_key = 'post_views_count';
    $count = get_post_meta( $postID, $count_key, true) ? : 1;
    return $count;
}

function ctpress_setViews ( $postID ) 
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
 * Include settings Files
 */

/*load recent and popular custom widget*/
require get_template_directory() . '/widgets/latest-popular.php';

/*Include Customizer Options.*/
require get_template_directory() . '/inc/customizer/customizer.php';

/*Include Template Tags.*/
require get_template_directory() . '/inc/template-tags.php';

/*Include Gutenberg Features.*/
require get_template_directory() . '/inc/gutenberg.php';


