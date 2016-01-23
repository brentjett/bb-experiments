<?php
/*
Plugin Name: Beaver Builder Experiments
Version: 0.2
Description: A set of scratchwork and experiments for extending Beaver Builder.
Author: Brent Jett
Author URI: http://brentjett.design
*/

define( 'BB_EXPERIMENTS_DIR', plugin_dir_path( __FILE__ ) );

// Optionally Include Projects
function brj_include_experiments() {
    $experiments = array(
        array(
            'key' => 'bb-minimap',
            'label' => 'Beaver Builder Minimap',
            'include' => BB_EXPERIMENTS_DIR . '/bb-minimap/bb-minimap.php'
        ),
        array(
            'key' => 'bb-store-kit',
            'label' => 'Beaver Builder Store Kit',
            'include' => BB_EXPERIMENTS_DIR . '/bb-store-kit/bb-store-kit.php'
        ),
        array(
            'key' => 'bb-tutorials',
            'label' => 'Beaver Builder Tutorials Plugin Base',
            'include' => BB_EXPERIMENTS_DIR . '/bb-tutorials/bb-tutorials.php'
        ),
        array(
            'key' => 'bb-ui-themes',
            'label' => 'Beaver Builder UI Themes',
            'include' => BB_EXPERIMENTS_DIR . '/bb-ui-themes/bb-ui-themes.php'
        )
    );
    
    if (!empty($experiments)) {
        foreach($experiments as $proj) {
            if ( apply_filters('brj/include_experiment', true, $proj['key']) ) {
                require_once $proj['include'];
            }
        }
    }
}
add_action('plugins_loaded', 'brj_include_experiments');

function brj_check_include_experiment($bool = true, $key) {

    // @todo: Add UI Check Here

    return $bool;
}
add_filter('brj/include_experiment', 'brj_check_include_experiment', 10, 2);
?>
