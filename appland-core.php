<?php
/**
 * Plugin Name: Appland Core
 * Plugin URI: https://themeforest.net/user/codepixar/portfolio
 * Description: This plugin adds the core features to the Appland WordPress theme. You must have to install this plugin to work with this theme.
 * Version: 2.9.4
 * Author: DroitThemes
 * Author URI: https://themeforest.net/user/droitthemes/portfolio
 * Text domain: appland-core
 */

if ( !defined('ABSPATH') )
    die('-1');

/**
 * Defining plugin constants
 */
define('APPLAND_CORE_FILE', plugin_dir_path(__FILE__));
define('APPLAND_CORE_DIR', plugins_url(__FILE__));

/**
 * Register the plugin text domain
 *
 * @return void
 */
add_action( 'plugins_loaded', function() {
    load_plugin_textdomain( 'appland-core', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
});

// Require the Shortcode main function File
require plugin_dir_path(__FILE__) . '/inc/vc_config.php';
// require plugin_dir_path(__FILE__) . '/inc/vc-custom-radio/vc-custom-radio.php';
require plugin_dir_path(__FILE__) . '/shortcodes/shortcodes.php';

// Instagram
// require plugin_dir_path(__FILE__) . '/widgets/instagram/instagram-api.php';
// require plugin_dir_path(__FILE__) . '/widgets/instagram/instagram-settings.php';
// require plugin_dir_path(__FILE__) . '/widgets/instagram/instagram-widget.php';

// Twitter Widget
require plugin_dir_path(__FILE__) . '/widgets/twitter/twitter-widget.php';

// Custom Functions
require plugin_dir_path(__FILE__) . '/inc/extra.php';
require plugin_dir_path(__FILE__) . '/inc/appland-widgets.php';
// Chaoz Widget
