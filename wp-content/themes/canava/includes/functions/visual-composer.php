<?php
/**
 * @package     WordPress
 * @subpackage  Themes
 * @author      Binh Pham Thanh <binhpham@linethemes.com>
 */
if ( ! defined( 'ABSPATH' ) )
	exit;

if ( ! class_exists( 'Vc_Manager' ) )
	return;

add_action( 'wp_enqueue_scripts', 'canava_vc_scripts', 999 );
add_action( 'vc_before_init', 'canava_map_shortcodes' );

/**
 * Register an action to wrap the image comparison
 * shortcode
 */
add_action( 'wp', 'canava_image_compare_wrapper' );

if ( ! function_exists( 'canava_vc_scripts' ) ) {
	/**
	 * Unregister visual composer styles and scripts
	 * 
	 * @return  void
	 */
	function canava_vc_scripts() {
		wp_deregister_script( 'prettyphoto' );
		wp_deregister_style( 'prettyphoto' );
		wp_deregister_style( 'isotope' );
		wp_deregister_style( 'flexslider' );
		wp_deregister_style( 'waypoints' );
	}
}


if ( ! function_exists( 'canava_map_shortcodes' ) ) {
	function canava_map_shortcodes() {
		if ( shortcode_exists( 'sciba' ) ):

			vc_map( array(
				'base'        => 'sciba',
				'name'        => esc_html__( 'Canava: Image Comparison', 'canava' ),
				'icon'        => 'linethemes-shortcode',
				'category'    => esc_html__( 'Canava', 'canava' ),
				'params'      => array(
					array(
						'type'       => 'attach_image',
						'heading'    => esc_html__( 'Image Left', 'canava' ),
						'param_name' => 'leftsrc'
					),
					array(
						'type'             => 'textfield',
						'heading'          => esc_html__( 'Label For Image Left', 'canava' ),
						'param_name'       => 'leftlabel',
					),

					array(
						'type'       => 'attach_image',
						'heading'    => esc_html__( 'Image Right', 'canava' ),
						'param_name' => 'rightsrc'
					),
					array(
						'type'             => 'textfield',
						'heading'          => esc_html__( 'Label For Image Right', 'canava' ),
						'param_name'       => 'rightlabel',
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Mode', 'canava' ),
						'param_name' => 'mode',
						'value' => array(
							__( 'Horizontal', 'canava' ) => 'horizontal',
							__( 'Vertical', 'canava' ) => 'vertical'
						),
					)
				)
			) );

		endif;
	}
}


if ( ! function_exists( 'canava_image_compare_wrapper' ) ) {
	function canava_image_compare_wrapper( $atts, $content = '' ) {
		global $shortcode_tags;

		if ( isset( $shortcode_tags['sciba'] ) ) {
			$callback = $shortcode_tags['sciba'];
			$shortcode_tags['sciba'] = function( $atts, $content = '' ) use ( $callback ) {
				$atts = shortcode_atts( array(
						'leftsrc'    => '',
						'leftlabel'  => '',
						'rightsrc'   => '',
						'rightlabel' => '',
						'mode'       => 'horizontal'
					), $atts );

				if ( is_numeric( $atts['leftsrc'] ) && $image = wp_get_attachment_image_src( $atts['leftsrc'], 'full' ) ) {
					$atts['leftsrc'] = $image[0];
				}

				if ( is_numeric( $atts['rightsrc'] ) && $image = wp_get_attachment_image_src( $atts['rightsrc'], 'full' ) ) {
					$atts['rightsrc'] = $image[0];
				}

				return call_user_func_array( $callback, array( $atts, $content ) );
			};
		}
	}
}
