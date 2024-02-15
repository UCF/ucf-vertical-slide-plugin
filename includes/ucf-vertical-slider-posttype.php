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

add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$sub_fields = array();

	$sub_fields[] = array(
		'key' => 'field_65b9b45f3b704',
		'label' => 'Image',
		'name' => 'img_url',
		'type' => 'image',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'uploader' => '',
		'return_format' => 'url',
		'acfe_thumbnail' => 0,
		'preview_size' => 'medium',
		'library' => 'all',
		'parent_repeater' => 'field_65b3e1c66adff',
	);

	$sub_fields[] = array(
		'key' => 'field_65b3e2296ae01',
		'label' => 'Title',
		'name' => 'title',
		'type' => 'text',
		'instructions' => 'Enter the Main title of the slider.',
		'required' => 0,
		'conditional_logic' => 0,
		'default_value' => 'Main Title',
		'placeholder' => 'Main Title',
		'parent_repeater' => 'field_65b3e1c66adff',
	);

	$sub_fields[] = array(
		'key' => 'field_65b3e23d6ae02',
		'label' => 'Sub title',
		'name' => 'sub_title',
		'type' => 'text',
		'instructions' => 'Enter the subtitle of the slider',
		'required' => 0,
		'conditional_logic' => 0,
		'default_value' => 'Sub Title',
		'placeholder' => 'Sub Title',
		'parent_repeater' => 'field_65b3e1c66adff',
	);

	$sub_fields[] = array(
		'key' => 'field_65b3e24b6ae03',
		'label' => 'Description',
		'name' => 'description',
		'type' => 'textarea',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'default_value' => '',
		'acfe_textarea_code' => 0,
		'maxlength' => '',
		'rows' => '',
		'placeholder' => '',
		'parent_repeater' => 'field_65b3e1c66adff',
	);


	acf_add_local_field_group( array(
	'key' => 'group_65b3e1c5dfe7f',
	'title' => 'Vertical Slider Fields',
	'fields' => array(
		array(
			'key' => 'field_65b3e1c66adff',
			'label' => 'Vertical Sliders Fields',
			'name' => 'vertical_sliders_fields',
			'type' => 'repeater',
			'required' => 0,
			'conditional_logic' => 0,
			'acfe_repeater_stylised_button' => 0,
			'layout' => 'block',
			'button_label' => 'Add Slide',
			'rows_per_page' => 20,
			'sub_fields' => $sub_fields,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'vertical_slider',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'left',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 1,
	'acfe_display_title' => '',
	'acfe_autosync' => '',
	'acfe_form' => 0,
	'acfe_meta' => '',
	'acfe_note' => '',
) );
} );

