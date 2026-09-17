<?php
/**
 * Elementor Custom Category Registration
 *
 * @package UsmanCreativeElementorWidgets
 * @author  Usman Tayyab (https://www.linkedin.com/in/imuxmantayyab/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class UTE_Category {

	/**
	 * Register category
	 *
	 * @param \Elementor\Elements_Manager $elements_manager Elements manager instance.
	 */
	public static function register_category( $elements_manager ) {
		$elements_manager->add_category(
			'painter-creative-widgets',
			array(
				'title' => esc_html__( 'Painter Creative Widgets', 'painter-creative-elementor-widgets' ),
				'icon'  => 'eicon-paint-brush',
			)
		);
	}
}
