<?php
/**
 * Assets Manager for Painter Creative Elementor Widgets
 *
 * @package UsmanCreativeElementorWidgets
 * @author  Usman Tayyab (https://www.linkedin.com/in/imuxmantayyab/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class UTE_Assets {

	/**
	 * Initialize assets hooks
	 */
	public static function init() {
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'register_frontend_assets' ) );
		add_action( 'elementor/editor/after_enqueue_scripts', array( __CLASS__, 'enqueue_editor_assets' ) );
		add_action( 'elementor/preview/enqueue_scripts', array( __CLASS__, 'enqueue_editor_assets' ) );
		add_action( 'elementor/preview/enqueue_styles', array( __CLASS__, 'enqueue_preview_styles' ) );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_admin_assets' ) );
	}

	/**
	 * Register frontend styles and scripts (enqueued on demand by Elementor widget depends)
	 */
	public static function register_frontend_assets() {
		$version = UTE_PLUGIN_VERSION;

		// Animations stylesheet
		wp_register_style(
			'ute-animations',
			UTE_PLUGIN_URL . 'assets/css/animations.css',
			array(),
			$version
		);

		// Button widget stylesheet
		wp_register_style(
			'ute-creative-button',
			UTE_PLUGIN_URL . 'assets/css/creative-button.css',
			array( 'ute-animations' ),
			$version
		);

		// Heading widget stylesheet
		wp_register_style(
			'ute-creative-heading',
			UTE_PLUGIN_URL . 'assets/css/creative-heading.css',
			array( 'ute-animations' ),
			$version
		);

		// Frontend micro-interactions & accessibility JS (Zero-dependency vanilla JS)
		wp_register_script(
			'ute-creative-widgets',
			UTE_PLUGIN_URL . 'assets/js/creative-widgets.js',
			array(),
			$version,
			true
		);
	}

	/**
	 * Enqueue styles specifically inside the Elementor preview iframe
	 */
	public static function enqueue_preview_styles() {
		$version = UTE_PLUGIN_VERSION;
		wp_enqueue_style( 'ute-animations', UTE_PLUGIN_URL . 'assets/css/animations.css', array(), $version );
		wp_enqueue_style( 'ute-creative-button', UTE_PLUGIN_URL . 'assets/css/creative-button.css', array( 'ute-animations' ), $version );
		wp_enqueue_style( 'ute-creative-heading', UTE_PLUGIN_URL . 'assets/css/creative-heading.css', array( 'ute-animations' ), $version );
	}

	/**
	 * Enqueue styles and scripts in Elementor Editor canvas and preview iframe
	 */
	public static function enqueue_editor_assets() {
		$version = UTE_PLUGIN_VERSION;

		wp_enqueue_style( 'ute-animations', UTE_PLUGIN_URL . 'assets/css/animations.css', array(), $version );
		wp_enqueue_style( 'ute-creative-button', UTE_PLUGIN_URL . 'assets/css/creative-button.css', array( 'ute-animations' ), $version );
		wp_enqueue_style( 'ute-creative-heading', UTE_PLUGIN_URL . 'assets/css/creative-heading.css', array( 'ute-animations' ), $version );

		wp_enqueue_script(
			'ute-editor-preview',
			UTE_PLUGIN_URL . 'assets/js/editor-preview.js',
			array( 'jquery' ),
			$version,
			true
		);

		// Pass inline SVG shapes and rollers to JavaScript editor environment for instant client-side rendering
		$shapes_data = array(
			'coral-banner-ref'   => UTE_Shapes::get_brush_svg( 'coral-banner-ref' ),
			'roller-stop-stroke' => UTE_Shapes::get_brush_svg( 'roller-stop-stroke' ),
			'rough-stroke-01'    => UTE_Shapes::get_brush_svg( 'rough-stroke-01' ),
			'classic-brush-02'   => UTE_Shapes::get_brush_svg( 'classic-brush-02' ),
			'dry-brush-03'       => UTE_Shapes::get_brush_svg( 'dry-brush-03' ),
			'marker-04'          => UTE_Shapes::get_brush_svg( 'marker-04' ),
			'organic-05'         => UTE_Shapes::get_brush_svg( 'organic-05' ),
			'double-brush-06'    => UTE_Shapes::get_brush_svg( 'double-brush-06' ),
			'underline-swipe-07' => UTE_Shapes::get_brush_svg( 'underline-swipe-07' ),
		);

		$rollers_data = array(
			'horizontal' => UTE_Shapes::get_roller_svg( 'horizontal' ),
			'offset'     => UTE_Shapes::get_roller_svg( 'offset' ),
			'detailed'   => UTE_Shapes::get_roller_svg( 'detailed' ),
			'minimal'    => UTE_Shapes::get_roller_svg( 'minimal' ),
			'small'      => UTE_Shapes::get_roller_svg( 'small' ),
			'large'      => UTE_Shapes::get_roller_svg( 'large' ),
		);

		wp_localize_script(
			'ute-editor-preview',
			'UTE_Editor_Data',
			array(
				'shapes'  => $shapes_data,
				'rollers' => $rollers_data,
			)
		);
	}

	/**
	 * Enqueue assets for plugin admin settings screen
	 *
	 * @param string $hook Admin screen hook.
	 */
	public static function enqueue_admin_assets( $hook ) {
		if ( false === strpos( $hook, 'painter-creative-widgets' ) ) {
			return;
		}

		wp_enqueue_style(
			'ute-admin-settings',
			UTE_PLUGIN_URL . 'assets/css/admin-settings.css',
			array(),
			UTE_PLUGIN_VERSION
		);

		wp_enqueue_script(
			'ute-admin-settings',
			UTE_PLUGIN_URL . 'assets/js/admin-settings.js',
			array( 'jquery' ),
			UTE_PLUGIN_VERSION,
			true
		);
	}
}
