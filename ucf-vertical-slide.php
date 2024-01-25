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

// Shortcode function
function ucf_vertical_slide_shortcode( $atts ) {
    ob_start();

    ?>
    <div class="container-fluid bg-inverse">
    <div id="slider-context" class="row overflow sliderParentRow" onmousewheel="scrollFunc(event)">
        <!-- Content will be dynamically inserted here -->
    </div>
    <div id="sliderPagination"></div>
    </div>
    <?php

    return ob_get_clean();
}

// Register the shortcode
add_shortcode( 'ucf_vertical_slide', 'ucf_vertical_slide_shortcode' );


function ucf_vertical_slide_enqueue_assets() {
	$plugin_data = get_plugin_data( UCF_VERTICAL_SLIDE__FILEPATH );
	$version = $plugin_data['Version'];

	// Enqueue styles
    wp_enqueue_style( 'ucf-vertical-slide-styles', UCF_VERTICAL_SLIDE__STATIC_URL . '/css/style.min.css', null, $version );

    // Enqueue scripts
    wp_enqueue_script( 'ucf-vertical-slide-script', UCF_VERTICAL_SLIDE__STATIC_URL . '/js/script.min.js', array( 'jquery' ), $version, true );
}

add_action( 'wp_enqueue_scripts', 'ucf_vertical_slide_enqueue_assets', 10, 0 );
