<?php
/*
Plugin Name: Tutorials for Beaver Builder
Version: 0.1
Author: Brent Jett
Description: This is a prototype for a tutorial plugin.
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
define( 'BB_TUTORIALS_DIR', plugin_dir_path( __FILE__ ) );
define( 'BB_TUTORIALS_URL', plugins_url( '/', __FILE__ ) );

require_once BB_TUTORIALS_DIR . '/classes/class-bb-tutorials.php';

add_action('init', 'BB_Tutorials::init');
add_action('wp_enqueue_scripts', 'BB_Tutorials::enqueue');
add_filter('template_include', 'BB_Tutorials::get_template');
register_activation_hook( __FILE__, 'BB_Tutorials::activate' );
?>
