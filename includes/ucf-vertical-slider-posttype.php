<?php
/**
 * Handles the registration of the people custom post type.
 * @author Ramin Farhadi
 * @since 1.0.0
 **/

 if ( ! function_exists( 'ucf_vertical_slide_shortcode' ) ) {

	function vertical_slider_register_cpt() {

		$labels = array(
			'name'               => _x( 'Vertical Sliders', 'General Name of Sliders' ),
			'singular_name'      => _x( 'Vertical Slider', 'Single Slider' ),
			'add_new'            => _x( 'Add New', 'Slider' ),
			'add_new_item'       => __( 'Add New Slider' ),
			'edit_item'          => __( 'Edit Slider' ),
			'new_item'           => __( 'New Vertical Slider' ),
			'all_items'          => __( 'All Vertical Sliders' ),
			'view_item'          => __( 'View Vertical Slider' ),
			'search_items'       => __( 'Search Sliders' ),
			'not_found'          => __( 'No sliders found' ),
			'not_found_in_trash' => __( 'No sliders found in the Trash' ),
			'parent_item_colon'  => __( 'Parent Sliders:' ),
			'menu_name'          => __( 'Vertical Sliders' ),
		);
		$args = array(
			'labels'        => $labels,
			'description'   => 'Holds our vertical sliders and slider specific data',
			'public'        => true,
			'menu_position' => 5,
			'supports'      => array( 'title' ),
			'has_archive'   => true,
			'show_in_rest'  => true,
			'rest_base'     => 'vertical_slider',
		);
		register_post_type('vertical_slider', $args);

	}

	add_action('init', 'vertical_slider_register_cpt');


 }

