<?php

    /**
     * ReduxFrameworkPlugin main class
     *
     * @package     ReduxFramework\ReduxFrameworkPlugin
     * @since       3.0.0
     */

    // Exit if accessed directly
    defined( 'ABSPATH' ) || exit;

    if ( ! class_exists( 'ReduxFrameworkPlugin' ) ) {

        /**
         * Main ReduxFrameworkPlugin class
         *
         * @since       3.0.0
         */
        class ReduxFrameworkPlugin {

            /**
             * @const       string VERSION The plugin version, used for cache-busting and script file references
             * @since       3.0.0
             */

            const VERSION = '3.5.7';

            /**
             * @access      protected
             * @var         array $options Array of config options, used to check for demo mode
             * @since       3.0.0
             */
            protected $options = array();

            /**
             * Use this value as the text domain when translating strings from this plugin. It should match
             * the Text Domain field set in the plugin header, as well as the directory name of the plugin.
             * Additionally, text domains should only contain letters, number and hypens, not underscores
             * or spaces.
             *
             * @access      protected
             * @var         string $plugin_slug The unique ID (slug) of this plugin
             * @since       3.0.0
             */
            protected $plugin_slug = 'redux-framework';

            /**
             * @access      protected
             * @var         string $plugin_screen_hook_suffix The slug of the plugin screen
             * @since       3.0.0
             */
            protected $plugin_screen_hook_suffix = null;

            /**
             * @access      protected
             * @var         string $plugin_network_activated Check for plugin network activation
             * @since       3.0.0
             */
            protected $plugin_network_activated = null;

            /**
             * @access      private
             * @var         \ReduxFrameworkPlugin $instance The one true ReduxFrameworkPlugin
             * @since       3.0.0
             */
            private static $instance;

            /**
             * Get active instance
             *
             * @access      public
             * @since       3.1.3
             * @return      self::$instance The one true ReduxFrameworkPlugin
             */
            public static function instance() {
                if ( ! self::$instance ) {
                    self::$instance = new self;
                    self::$instance->includes();
                    self::$instance->hooks();
                }

                return self::$instance;
            }

            // Shim since we changed the function name. Deprecated.
            public static function get_instance() {
                if ( ! self::$instance ) {
                    self::$instance = new self;
                    self::$instance->includes();
                    self::$instance->hooks();
                }

                return self::$instance;
            }

          

            /**
             * Include necessary files
             *
             * @access      public
             * @since       3.1.3
             * @return      void
             */
            public function includes() {
                // Include ReduxCore
                if ( file_exists( dirname( __FILE__ ) . '/ReduxCore/framework.php' ) ) {
                    require_once dirname( __FILE__ ) . '/ReduxCore/framework.php';
                }

                if ( isset( ReduxFramework::$_as_plugin ) ) {
                    ReduxFramework::$_as_plugin = true;
                }

                if ( file_exists( dirname( __FILE__ ) . '/ReduxCore/redux-extensions/config.php' ) ) {
                    require_once dirname( __FILE__ ) . '/ReduxCore/redux-extensions/config.php';
                }

                // Include demo config, if demo mode is active
                if ( $this->options['demo'] && file_exists( dirname( __FILE__ ) . '/sample/sample-config.php' ) ) {
                    require_once dirname( __FILE__ ) . '/sample/sample-config.php';
                }
            }

            /**
             * Run action and filter hooks
             *
             * @access      private
             * @since       3.1.3
             * @return      void
             */
            private function hooks() {
                do_action( 'redux/plugin/hooks', $this );
            }

        
        }
    }
