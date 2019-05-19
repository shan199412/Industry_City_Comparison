<?php

/*
Plugin Name: Industry Comparison
Description: Short Code: [Industry-City-Comparison]
Version: 1.1
Author: Zoe
*/

// User cannot access the plugin directly
if (!defined('ABSPATH')) {
	exit;
}

// Add short code for the plugin
function generate_icc_short_code() {
	include 'Industry-city-comparison.php';
}

add_shortcode('Industry-City-Comparison', 'generate_icc_short_code');

// Add the scripts
function add_icc_scripts() {
	wp_enqueue_script('indcity_script', plugins_url('/js/indcity_script.js',__FILE__), array('jquery'),'1.1', true);
	wp_enqueue_script('inddia_script', plugins_url('/js/inddia_script.js',__FILE__), array('jquery'),'1.1', true);
	wp_enqueue_style( 'indcity_style', plugins_url('/css/indcity_style.css', __FILE__), array(), '1.1');
	wp_enqueue_style( 'inddia_style', plugins_url('/css/inddia_style.css', __FILE__), array(), '1.1');

}

add_action('wp_enqueue_scripts', 'add_icc_scripts');
