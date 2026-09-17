<?php
/**
 * Elementor Integration Initializer
 *
 * @package UsmanCreativeElementorWidgets
 * @author  Usman Tayyab (https://www.linkedin.com/in/imuxmantayyab/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class UTE_Elementor_Init {

	/**
	 * Initialize Elementor hooks
	 */
	public static function init() {
		// Register custom category
		add_action( 'elementor/elements/categories_registered', array( 'UTE_Category', 'register_category' ) );

		// Register widgets (Elementor 3.5.0+ hook with fallback)
		if ( did_action( 'elementor/loaded' ) ) {
			add_action( 'elementor/widgets/register', array( __CLASS__, 'register_widgets' ) );
		}
	}

	/**
	 * Register Elementor Widgets
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public static function register_widgets( $widgets_manager ) {
		$options = get_option( 'ute_settings', array() );
		$enable_button  = isset( $options['enable_button'] ) ? (bool) $options['enable_button'] : true;
		$enable_heading = isset( $options['enable_heading'] ) ? (bool) $options['enable_heading'] : true;

		// Creative Painter Button
		if ( $enable_button ) {
			require_once UTE_PLUGIN_PATH . 'widgets/class-ute-widget-creative-button.php';
			if ( class_exists( 'UTE_Widget_Creative_Button' ) ) {
				$widgets_manager->register( new UTE_Widget_Creative_Button() );
			}
		}

		// Creative Brush Heading
		if ( $enable_heading ) {
			require_once UTE_PLUGIN_PATH . 'widgets/class-ute-widget-creative-heading.php';
			if ( class_exists( 'UTE_Widget_Creative_Heading' ) ) {
				$widgets_manager->register( new UTE_Widget_Creative_Heading() );
			}
		}

		/**
		 * Action hook to register custom widgets
		 *
		 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
		 */
		do_action( 'ute_register_widgets', $widgets_manager );
	}
}
