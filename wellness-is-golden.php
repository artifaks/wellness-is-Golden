<?php
/**
 * Plugin Name: Wellness is Golden
 * Plugin URI: 
 * Description: Herbal Medicine Application with Search and Admin Interface
 * Version: 1.0.0
 * Author: Your Name
 * License: GPL v2 or later
 */

if (!defined('ABSPATH')) {
    exit;
}

// Include the main plugin class
require_once plugin_dir_path(__FILE__) . 'includes/class-wellness-golden.php';

// Initialize the plugin
function run_wellness_golden() {
    $plugin = new Wellness_Golden();
    $plugin->run();
}
run_wellness_golden();
