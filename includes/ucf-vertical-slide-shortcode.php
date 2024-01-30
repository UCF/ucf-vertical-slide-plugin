<?php

if ( ! function_exists( 'ucf_vertical_slide_shortcode' ) )
	{
		function ucf_vertical_slide_shortcode( $atts )
			{
				ob_start();
				$defaults = array(
					'slug' => '',
					'id' => ''
				);

				// Getting the Id and Slug from shortcode
				$atts = shortcode_atts($defaults, $atts, 'ucf_vertical_slide');
				$slider_slug = $atts['slug'];
				$slider_id = $atts['id'];

				?>

				<div class="container-fluid bg-inverse">
				<div id="slider-context" class="row overflow slider-parent-row" onmousewheel="scrollFunc(event)">
					<!-- Content will be dynamically inserted here -->
				</div>
				<div id="slider-pagination"></div>
				</div>
				<?php
				return ob_get_clean();
			}
	}

	// Register the shortcode
	add_shortcode( 'ucf_vertical_slide', 'ucf_vertical_slide_shortcode' );


?>
