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

// Shortcode function
function ucf_vertical_slide_shortcode($atts) {
    ob_start();

    // Enqueue styles
    wp_enqueue_style('ucf-vertical-slide-styles', plugin_dir_url(__FILE__) . 'ucf-vertical-slide-styles.css');

    // Enqueue scripts
    wp_enqueue_script('ucf-vertical-slide-script', plugin_dir_url(__FILE__) . 'ucf-vertical-slide-script.js', array('jquery'), '1.0', true);

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
add_shortcode('ucf_vertical_slide', 'ucf_vertical_slide_shortcode');
