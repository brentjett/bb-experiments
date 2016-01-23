<?php
/*
Plugin Name: Template Store for Beaver Builder
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
define( 'FL_STORE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'FL_STORE_PLUGIN_URL', plugins_url( '/', __FILE__ ) );
define( 'FL_STORE_PLUGIN_SLUG', plugin_basename(__FILE__));
define( 'FL_STORE_MODULE_CATEGORY', 'Store Modules');

function brj_template_store_init() {
    if (class_exists('FLBuilderModule')) {
        require_once FL_STORE_PLUGIN_DIR . '/modules/brj-template-collection/brj-template-collection.php';
    }
}
add_action('init', 'brj_template_store_init');
?>
