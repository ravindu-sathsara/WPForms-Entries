<?php
/*
Plugin Name: WPForms Entries 
Plugin URI: https://github.com/ravindu-sathsara/WPForms-Entries
Description: This is an add-on plugin designed to manage entries in the wp form plugin
Version: 1.0
Author: IR DEVELOPER
Author URI: https://github.com/ravindu-sathsara
License: Apache License 2.0 
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: data_management
Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

function data_management_plugin_registration() {
    add_action('admin_menu', 'data_management_plugin_menu');
}


function data_management_plugin_menu() {
    add_menu_page(
        'Data Management', // Page title
        'Data Management', // Menu title
        'manage_options', // Capability
        'data_management_dashboard', // Menu slug
        'data_management_plugin_dashboard_page', // Callback function for the dashboard page content
        'dashicons-superhero', // Icon URL or Dashicon name
        99 // Position (optional)
    );

    add_submenu_page(
        'data_management_dashboard', // Parent slug
        'Dashboard', // Page title
        'Dashboard', // Menu title
        'manage_options', // Capability
        'data_management_dashboard', // Menu slug
        'data_management_plugin_dashboard_page' // Callback function for the dashboard page content
    );
   
}

// Include dashboard and configuration files
require_once plugin_dir_path(__FILE__) . 'dashboard/dashboard.php';

// Hook the custom registration function
add_action('plugins_loaded', 'data_management_plugin_registration');