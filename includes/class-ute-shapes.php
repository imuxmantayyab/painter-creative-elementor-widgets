<?php
/**
 * Built-in Brush Shapes & Roller Illustrations Manager
 *
 * @package UsmanCreativeElementorWidgets
 * @author  Usman Tayyab (https://www.linkedin.com/in/imuxmantayyab/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class UTE_Shapes {

	/**
	 * Get list of available brush stroke shapes
	 *
	 * @return array
	 */
	public static function get_brush_shapes() {
		$shapes = array(
			'roller-stop-stroke' => esc_html__( 'Roller Stamp & Bristle Stroke (Default)', 'painter-creative-elementor-widgets' ),
			'coral-banner-ref'   => esc_html__( 'Coral Banner Stroke', 'painter-creative-elementor-widgets' ),
			'rough-stroke-01'    => esc_html__( 'Rough Hand-Painted Stroke', 'painter-creative-elementor-widgets' ),
			'classic-brush-02'   => esc_html__( 'Classic Acrylic Brush', 'painter-creative-elementor-widgets' ),
			'dry-brush-03'       => esc_html__( 'Dry Bristle Stroke', 'painter-creative-elementor-widgets' ),
			'marker-04'          => esc_html__( 'Broad Marker Swipe', 'painter-creative-elementor-widgets' ),
			'organic-05'         => esc_html__( 'Fluid Organic Paint Blob', 'painter-creative-elementor-widgets' ),
			'double-brush-06'    => esc_html__( 'Double Overlapping Stroke', 'painter-creative-elementor-widgets' ),
			'underline-swipe-07' => esc_html__( 'Tapered Underline Swipe', 'painter-creative-elementor-widgets' ),
			'custom'             => esc_html__( 'Custom SVG Shape', 'painter-creative-elementor-widgets' ),
		);

		/**
		 * Filter available paint brush shapes
		 *
		 * @param array $shapes Key-value pair of shapes.
		 */
		return apply_filters( 'ute_paint_shapes', $shapes );
	}

	/**
	 * Get list of available roller types
	 *
	 * @return array
	 */
	public static function get_roller_types() {
		$rollers = array(
			'horizontal' => esc_html__( 'Straight Handle - Square Arm (Option 1)', 'painter-creative-elementor-widgets' ),
			'offset'     => esc_html__( 'Straight Handle - Offset S-Curve Arm (Option 2)', 'painter-creative-elementor-widgets' ),
			'detailed'   => esc_html__( 'Detailed Paint Roller (Classic)', 'painter-creative-elementor-widgets' ),
			'minimal'    => esc_html__( 'Minimalist Outline Roller', 'painter-creative-elementor-widgets' ),
			'small'      => esc_html__( 'Small Trim Roller', 'painter-creative-elementor-widgets' ),
			'large'      => esc_html__( 'Heavy Duty Industrial Roller', 'painter-creative-elementor-widgets' ),
			'custom'     => esc_html__( 'Custom SVG Roller', 'painter-creative-elementor-widgets' ),
		);

		/**
		 * Filter available paint roller types
		 *
		 * @param array $rollers Key-value pair of rollers.
		 */
		return apply_filters( 'ute_paint_rollers', $rollers );
	}

	/**
	 * Get SVG content for a brush shape
	 *
	 * @param string $shape_key Shape identifier.
	 * @return string
	 */
	public static function get_brush_svg( $shape_key ) {
		$valid_shapes = array(
			'coral-banner-ref'   => 'coral-banner-ref.svg',
			'roller-stop-stroke' => 'roller-stop-stroke.svg',
			'rough-stroke-01'    => 'rough-stroke-01.svg',
			'classic-brush-02'   => 'classic-brush-02.svg',
			'dry-brush-03'       => 'dry-brush-03.svg',
			'marker-04'          => 'marker-04.svg',
			'organic-05'         => 'organic-05.svg',
			'double-brush-06'    => 'double-brush-06.svg',
			'underline-swipe-07' => 'underline-swipe-07.svg',
		);

		if ( ! isset( $valid_shapes[ $shape_key ] ) ) {
			$shape_key = 'roller-stop-stroke';
		}

		$file_path = UTE_PLUGIN_PATH . 'assets/svg/brushes/' . $valid_shapes[ $shape_key ];

		if ( file_exists( $file_path ) ) {
			return file_get_contents( $file_path );
		}

		return '';
	}

	/**
	 * Get SVG content for a paint roller
	 *
	 * @param string $roller_key Roller identifier.
	 * @return string
	 */
	public static function get_roller_svg( $roller_key ) {
		$valid_rollers = array(
			'horizontal' => 'paint-roller-horizontal.svg',
			'offset'     => 'paint-roller-offset.svg',
			'detailed'   => 'paint-roller-detailed.svg',
			'minimal'    => 'paint-roller-minimal.svg',
			'small'      => 'paint-roller-small.svg',
			'large'      => 'paint-roller-large.svg',
		);

		if ( ! isset( $valid_rollers[ $roller_key ] ) ) {
			$roller_key = 'detailed';
		}

		$file_path = UTE_PLUGIN_PATH . 'assets/svg/rollers/' . $valid_rollers[ $roller_key ];

		if ( file_exists( $file_path ) ) {
			return file_get_contents( $file_path );
		}

		return '';
	}
}
