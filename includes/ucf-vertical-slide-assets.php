<?php
function ucf_vertical_slide_enqueue_assets() {
	global $my_json_data; // Access the global variable
	$plugin_data = get_plugin_data( UCF_VERTICAL_SLIDE__FILEPATH );
	$version = $plugin_data['Version'];

	// Enqueue styles
    wp_enqueue_style( 'ucf-vertical-slide-styles', UCF_VERTICAL_SLIDE__STATIC_URL . '/css/style.min.css', null, $version );

    // Enqueue scripts
    wp_enqueue_script( 'ucf-vertical-slide-script', UCF_VERTICAL_SLIDE__STATIC_URL . '/js/script.min.js', array( 'jquery' ), $version, true );

}

add_action( 'wp_enqueue_scripts', 'ucf_vertical_slide_enqueue_assets', 10, 0 );
?>
