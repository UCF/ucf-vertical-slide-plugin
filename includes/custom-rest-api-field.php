<?php

	// Adding custom fields (ACF) to rest api responses
		function slider_custom_rest_api () {
			register_rest_field(
				'vertical_slider',
				'test_name',
				array(
				'get_callback' => 'get_custom_field'
			));
		}

		add_action('rest_api_init', 'slider_custom_rest_api');

		function get_custom_field ( $obj ) {

			return 'TEST';
		}

