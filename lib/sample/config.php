<?php
    defined( 'ABSPATH' ) || exit;
    
    if ( ! class_exists( 'Redux' ) ) { 
        return;
    }
    /*This is your option name where all the Redux data is stored.*/
    $opt_name = "ctpress";
 
    // This line is only for altering the demo. Can be easily removed.
    // $opt_name = apply_filters( 'ctpress/opt_name', $opt_name );

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }


    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Theme Options', 'ctpress' ),
        'page_title'           => __( 'Theme Options', 'ctpress' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => false,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => false,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => true,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => false,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => '#2271b1',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    $args['share_icons'][] = array(
        'url'   => 'http://facebook.com/coderstime',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/coderstimes',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( __( '', 'ctpress' ), $v );
    } else {
        $args['intro_text'] = __( '', 'ctpress' );
    }

    // Add content after the form.
    $args['footer_text'] = __( '', 'ctpress' );

    Redux::setArgs( $opt_name, $args );


    Redux::setSection($opt_name, array(
            'title' => 'Homepage Setting',
            'id'    => 'homepage',
            'icon'  =>'el el-home',
            'fields' => array(                 
				 array(
                    'id'       => 'ganalytics',
                    'type'     => 'ace_editor',
                    'title'    => __( 'Google Analytics', 'ctpress' ),
                    'subtitle' => __( 'Google Analytics code here.', 'ctpress' ),
                    'mode'     => 'html',
                    'theme'    => 'monokai',
                    'desc'     => 'Google Analytics settings here ',
                    'default'  => ""
                ), 
                     
            ),
    ));

     Redux::setSection($opt_name, array(
            'title' => 'Header Setting',
            'id'    => 'logo_area',
            'icon'  =>' el-icon-wrench-alt',
            'fields' => array(
                array(
                    'title' => 'Main Logo setting',
                    'desc'  =>'Please upload your main logo here',
                    'type'  =>'media',
                    'id'    =>'logo',
                    'compiler' =>true,
                    'default' =>array(
                        'url' => get_template_directory_uri().'/assets/images/logo.svg'
                    ),
                ),
                array(
                    'title' => 'Favicon setting',
                    'desc'  =>'Please upload your favicon here',
                    'type'  =>'media',
                    'id'    =>'favicon',
                    'compiler' =>true,
                    'default' =>array(
                        'url' =>get_template_directory_uri().'/assets/images/favicon.png'
                    ),
                ),
                array(
                    'id'       => 'date-show',
                    'type'     => 'switch',
                    'title'    => __( 'Date Show', 'ctpress' ),
                    'subtitle' => __( 'Date time show/hide', 'ctpress' ),
                    'default'  => true,
                    'on'       => __( 'Show', 'ctpress' ),
                    'off'      => __( 'Hide', 'ctpress' )
                ),
                array(
                    'title' => 'logo linking',
                    'desc'  =>'Please set your logo link',
                    'type'  =>'text',
                    'id'    =>'logo_link',
                    'compiler' =>true,
                    'options'  =>array(
                        '1'     =>'main logo',
                    ),
                    'default'   =>array(
                        '1'     => get_home_url()
                    ),    
                ),               
            ),
        ));

     Redux::setSection($opt_name, array(
            'title' => 'Category Setting',
            'icon'  =>'el el-list-alt',
            'fields' => array(
                array(
                    'title' => 'Top Left Category',
                    'desc'  =>'Please edit your query',
                    'type'  =>'select',
                    'id'    =>'topleft',
                    'data'     => 'categories'
                ),
                array(
                    'title' => 'Top Middle Category',
                    'desc'  =>'Please edit your query',
                    'type'  =>'select',
                    'id'    =>'topmiddle',
                    'data'     => 'categories'
                ),
                array(
                    'title' => 'Top Right Category',
                    'desc'  =>'Please edit your query',
                    'type'  =>'select',
                    'id'    =>'topright',
                    'data'     => 'categories'
                ),
                array(
                    'title' => 'Full Body Category',
                    'desc'  =>'Please edit your query',
                    'type'  =>'select',
                    'multi'    => true,
                    'id'    =>'fullbody',
                    'data'     => 'categories'
                ),
                array(
                    'title' => 'Body One Category',
                    'desc'  =>'Please edit your query',
                    'type'  =>'select',
                    'id'    =>'body_one',
                    'data'     => 'categories'
                ),
                array(
                    'title' => 'Body Two Category',
                    'desc'  =>'Please edit your query',
                    'type'  =>'select',
                    'id'    =>'body_two',
                    'data'     => 'categories'
                ),
                array(
                    'title' => 'Body Three Category',
                    'desc'  =>'Please edit your query',
                    'type'  =>'select',
                    'id'    =>'body_three',
                    'data'     => 'categories'
                ),
                array(
                    'title' => 'Full Bottom Category',
                    'desc'  =>'Please edit your query',
                    'type'  =>'select',
                    'multi'    => true,
                    'id'    =>'bodybottom',
                    'data'     => 'categories'
                ),
                array(
                    'title' => 'Right Sidebar Category',
                    'desc'  =>'Please edit your query',
                    'type'  =>'select',
                    'id'    =>'right_sidebarcat',
                    'data'     => 'categories'
                ),
                array(
                    'title' => 'Trending Posts Categories',
                    'desc'  =>'Please edit your query',
                    'type'  =>'select',
                    'multi'    => true,
                    'id'    =>'trendingcat',
                    'data'     => 'categories'
                ),
                array(
                    'title' => 'Latest Post Categories',
                    'desc'  =>'Please edit your query',
                    'type'  =>'select',
                    'multi'    => true,
                    'id'    =>'latestpostcat',
                    'data'     => 'categories'
                ),
                array(
                    'title' => 'Popular Post Categories',
                    'desc'  =>'Please edit your query',
                    'type'  =>'select',
                    'multi'    => true,
                    'id'    =>'popularpostcat',
                    'data'     => 'categories'
                ),

                array(
                    'title' => 'top add visibility setting',
                    'desc'  =>'Please set your add visibility here',
                    'type'  =>'button_set',
                    'id'    =>'category_show',
                    'options'=>array(
                        '1' =>'show',
                        '2' =>'hide',
                    ),
                    'default'=>'1',
                ),
            ),
        ));


    Redux::setSection( $opt_name, array(
        'title'      => __( 'Comments', 'ctpress' ),
        'id'         => 'switch_buttonset-switch',
        'desc'       => __( 'Select your site commenting system. Default wordpress commenting system.', 'ctpress' ),
        'icon'  =>'el el-comment',
        'fields'     => array(            
            array(
                'id'       => 'comment_option',
                'type'     => 'switch',
                'title'    => __( 'Select One', 'ctpress' ),
                'subtitle' => __( 'Default wordpress Comment', 'ctpress' ),
                'default'  => 0,
                'on'       => 'Facebook Comment',
                'off'      => 'WordPress Comment',

            ),
            array(
                'id'        => 'fb_appId',
                'type'      => 'text',
                'required' => array( 'comment_option', '=', '1' ),
                'title'     => __( 'Facebook App ID', 'ctpress' ),
                // 'subtitle'  => __( 'Facebook App id', 'ctpress' ),
                'desc'      => __( 'Go to your facebook app, Copy app id, paste here ', 'ctpress' ) . '<a href="https://developers.facebook.com/apps/" target="_blank"> facebook App link</a>',
                'default'   => '492209628792946',
                'text_hint' => array(
                    'title'   => 'Facebook App id',
                    'content' => 'https://developers.facebook.com/apps/ go to this link, select your app and copy your app id'
                )
            ),

            array(
                'id'      => 'comments_preview_image',
                'type'    => 'select_image',
                'presets' => true,
                'title'   => __( 'Preview', 'ctpress' ),
                'default' => 1,
                'options' => array(
                    '1' => array(
                        'alt' => 'Facebook Comment',
                        'img' => ReduxFramework::$_url . '../sample/presets/facebook-comment.png',
                    ),
                    '2' => array(
                        'alt' => 'Wordpress Comment',
                        'img' => ReduxFramework::$_url . '../sample/presets/wordpress-comment.png',
                    ),
                ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'View Screen', 'ctpress' ),
        'id'         => 'select-select',
        'desc'       => __( 'How page and post visible to reader/visitor settings page ', 'ctpress' ),
        'fields'     => array(

            array(
                'id'       => 'post-screen',
                'type'     => 'select',
                'title'    => __( 'Select View Screen', 'ctpress' ),
                'subtitle' => __( 'Select a screen option how visible to visitor', 'ctpress' ),
                'desc'     => __( 'Website posts screen will be show with sidebar or no settings panel. Select a screen option how visible to visito', 'ctpress' ),
                'options'  => array(
                    '1' => esc_html__( 'Right Sidebar' ),
                    '2' => esc_html__( 'Left Sidebar' ),
                    '3' => esc_html__( 'No Sidebar' ),
                    '4' => esc_html__( 'Full width' ),
                ),
                'default'  => '1'
            ),

            array(
                'id'       => 'page-screen',
                'type'     => 'select',
                'title'    => __( 'Select View Screen', 'ctpress' ),
                'subtitle' => __( 'Select a page screen option how visible to visitor', 'ctpress' ),
                'desc'     => __( 'Website page screen will be show with sidebar or no settings panel Select page screen option how visible to visitor', 'ctpress' ),
                'options'  => array(
                    '1' => esc_html__( 'Right Sidebar' ),
                    '2' => esc_html__( 'Left Sidebar' ),
                    '3' => esc_html__( 'No Sidebar' ),
                    '4' => esc_html__( 'Full width' ),
                ),
                'default'  => '1'
            ),
           
        )
    ) );



	// header social icon link setting
    Redux::setSection($opt_name, array(
            'title' =>'Socail link setting',
            'icon'  =>' el-icon-website-alt',
            'fields'=>array(
                array(
                    'title' =>'Facebook Link',
                    'id'    =>'facebook',
                    'type'  =>'text',
                    'subtitle' => __( 'This must be a URL.', 'ctpress' ),
                    'desc'     => __( 'Give exact facebook page link', 'ctpress' ),
                    'validate' => 'url',
                    'default'  => 'https://facebook.com/coderstime/'
                ),
                array(
                    'title' =>'Twitter Link',
                    'id'    =>'twitter',
                    'type'  =>'text',
                    'subtitle' => __( 'This must be a URL.', 'ctpress' ),
                    'desc'     => __( 'Give exact Twitter page link', 'ctpress' ),
                    'validate' => 'url',
                    'default'  => 'https://twitter.com/'
                ),
                array(
                    'title' =>'Instagram Link',
                    'id'    =>'instagram',
                    'type'  =>'text',
                    'subtitle' => __( 'This must be a URL.', 'ctpress' ),
                    'desc'     => __( 'Give exact Instagram page link', 'ctpress' ),
                    'validate' => 'url',
                    'default'  => 'https://www.instagram.com/'
                ),
                array(
                    'title' =>'Youtube Link',
                    'id'    =>'youtube',
                    'type'  =>'text',
                    'subtitle' => __( 'This must be a URL.', 'ctpress' ),
                    'desc'     => __( 'Give exact Youtube page link', 'ctpress' ),
                    'validate' => 'url',
                    'default'  => 'https://www.youtube.com/'
                ),
                array(
                    'title' =>'LinkedIn Link',
                    'id'    =>'linkedin',
                    'type'  =>'text',
                    'subtitle' => __( 'This must be a URL.', 'ctpress' ),
                    'desc'     => __( 'Give exact Linkedin page link', 'ctpress' ),
                    'validate' => 'url',
                    'default'  => 'https://www.linkedin.com/'
                ),
                
            ),
        ));



     /*Footer section setting*/
     Redux::setSection( $opt_name, array(
            'title' => __( 'Footer', 'ctpress' ),
            'id'    => 'footer',
            'desc'  => __( 'Footer information control panel', 'ctpress' ),
            'icon'  =>' el-icon-wrench-alt',
            'fields' => array(
                array(
                    'title' => 'Footer Logo setting',
                    'desc'  =>'Please upload footer logo here',
                    'type'  =>'media',
                    'id'    =>'footer_logo',
                    'compiler' =>true,
                    'default' =>array(
                        'url' => get_template_directory_uri().'/assets/images/logo.svg'
                    ),
                ),
                array(
                    'title' => __( 'Site Basic Info', 'ctpress' ),
                    'desc'  => __( 'Your business basic information like office location and contact information','ctpress'),
                    'default' => '',
                    'type'  =>'editor',
                    'id'    =>'footer_info',
                    'args'    => array(
                        'wpautop'       => false,
                        'media_buttons' => false,
                        'textarea_rows' => 10,
                        //'tabindex' => 1,
                        //'editor_css' => '',
                        'teeny'         => false,
                        //'tinymce' => array(),
                        'quicktags'     => false,
                    )
                ),
                array(
                    'title' => __( 'Footer Logo Text', 'ctpress' ),
                    'desc'  => __( 'Site footer bottom logo text', 'ctpress' ),
                    'default' => '<h6>' . __( 'Editor: Your name', 'ctpress' ) . '</h6>',
                    'type'  =>'editor',
                    'id'    =>'footer_logo_bottom',
                    'args'    => array(
                        'wpautop'       => false,
                        'media_buttons' => false,
                        'textarea_rows' => 10,
                        //'tabindex' => 1,
                        //'editor_css' => '',
                        'teeny'         => false,
                        //'tinymce' => array(),
                        'quicktags'     => false,
                    )
                ),
            )
        ));