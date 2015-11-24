<?php
/*
Plugin Name: Beaver Builder Experiments
Version: 0.1
Description: A set of scratchwork and experiments for extending Beaver Builder.
Author: Brent Jett
Author URI: http://brentjett.design
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
define( 'BB_EXPERIMENTS_DIR', plugin_dir_path( __FILE__ ) );
define( 'BB_EXPERIMENTS_URL', plugins_url( '/', __FILE__ ) );

require_once BB_EXPERIMENTS_DIR . '/bb-ui-themes/bb-ui-themes.php';

?>
