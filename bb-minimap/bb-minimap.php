<?php
/*
Plugin Name: Beaver Builder Mini-map
Version: 0.1
Author: Brent Jett
Description: A small script to allow you to see the parts of your layout at a glance.
*/
function brj_enqueue_minimap() {
    if (is_user_logged_in() && class_exists('FLBuilderModel') && FLBuilderModel::is_builder_active() ) {
        wp_enqueue_script('bb-minimap', plugins_url('bb-minimap.js', __FILE__), array('jquery', 'wp-util'));
        wp_enqueue_style('bb-minimap', plugins_url('css/bb-minimap.css', __FILE__));
    }
}
add_action('wp_enqueue_scripts', 'brj_enqueue_minimap');

function brj_print_minimap_templates() {
    require_once 'templates.php';
}
add_action('wp_footer', 'brj_print_minimap_templates');
?>
