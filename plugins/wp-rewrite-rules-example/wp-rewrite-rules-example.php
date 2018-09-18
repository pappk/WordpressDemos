<?php
/*
Plugin Name: WP Rewrite Rules Example
Description: Example plugin to demonstrate the usage of rewrite rules
Version: 1.0.0
Author: pappk
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define('WPRRE_PLUGIN_URL', plugin_dir_url( __FILE__ ));
define('WPRRE_PLUGIN_RELATIVE_PATH', substr( WPRRE_PLUGIN_URL, strlen( home_url() ) + 1 ));

/**
 * Register rewrite rules
 */
function wprre_add_rewrite_rules() {
	global $wp_rewrite;

	// pattern with regexps
  $wp_rewrite->add_external_rule( '^report/([\w\d-]+)/?', WPRRE_PLUGIN_RELATIVE_PATH.'sub-directory/handler.php?report_name=$1' );
  $wp_rewrite->add_external_rule( '^wp_report/([\w\d-]+)/?', WPRRE_PLUGIN_RELATIVE_PATH.'sub-directory/wp_handler.php?report_name=$1' );
}
add_action('init', 'wprre_add_rewrite_rules');

/**
 * Register custom GET query parameter names
 */
function wprre_custom_rewrite_tag() {
  add_rewrite_tag('%report_name%', '([^&]+)');
}
add_action('init', 'wprre_custom_rewrite_tag', 10, 0);


/**
 * Plugin activation hook
 */
register_activation_hook( __FILE__, 'wprre_activation' );
function wprre_activation()
{
    wprre_add_rewrite_rules();
    flush_rewrite_rules();
}
