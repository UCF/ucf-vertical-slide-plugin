<?php

	function slider_custom_rest_fields() {
		register_rest_field(
			'vertical_slider',
			'custom_rest_api',
			array (
				'get_callback' => 'get_slides'
			)
			);
	}

	add_action( 'rest_api_init', 'slider_custom_rest_fields');

	function get_slides ( $post ) {
		$slides = get_field( 'vertical_sliders_fields', $post['id'] );
		return $slides;
	}
