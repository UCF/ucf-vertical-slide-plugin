<?php
/*
Plugin Name: UCF Vertical Slide Plugin
Description: Custom vertical slide plugin for UCF.
Version: 1.0.0
Author: UCF Web Communications
License: GPL3
GitHub Plugin URI: UCF/ucf-vertical-slide-plugin
*/

if ( ! defined( 'WPINC' ) ) {
    die;
}

define( 'UCF_VERTICAL_SLIDE__PLUGIN_URL', plugins_url( basename( dirname( __FILE__ ) ) ) );
define( 'UCF_VERTICAL_SLIDE__STATIC_URL', UCF_VERTICAL_SLIDE__PLUGIN_URL . '/static' );
define( 'UCF_VERTICAL_SLIDE__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'UCF_VERTICAL_SLIDE__FILEPATH', __FILE__ );

// adding the custom post type path
include_once 'includes/ucf-vertical-slider-posttype.php';
// Shortcode function
include_once 'includes/ucf-vertical-slide-shortcode.php';
//Adding the functions.php
include_once 'includes/custom-rest-api-field.php';
// Adding assets (CSS/ JS)
include_once 'includes/ucf-vertical-slide-assets.php'
?>



