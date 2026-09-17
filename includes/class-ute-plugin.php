<?php
/**
 * Main Plugin Class
 *
 * @package UsmanCreativeElementorWidgets
 * @author  Usman Tayyab (https://www.linkedin.com/in/imuxmantayyab/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class UTE_Plugin {

	/**
	 * Minimum Elementor version required
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.5.0';

	/**
	 * Minimum PHP version required
	 */
	const MINIMUM_PHP_VERSION = '7.4';

	/**
	 * Singleton instance
	 *
	 * @var UTE_Plugin
	 */
	private static $_instance = null;

	/**
	 * Main Instance getter
	 *
	 * @return UTE_Plugin
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'i18n' ) );
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Load Textdomain
	 */
	public function i18n() {
		load_plugin_textdomain( 'painter-creative-elementor-widgets', false, dirname( plugin_basename( UTE_PLUGIN_FILE ) ) . '/languages/' );
	}

	/**
	 * Initialize plugin
	 */
	public function init() {
		// Check PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}

		// Check if Elementor is installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			// Admin settings can still be viewed to see status
			UTE_Admin_Settings::init();
			return;
		}

		// Check Elementor version
		if ( defined( 'ELEMENTOR_VERSION' ) && version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Initialize components
		UTE_Assets::init();
		UTE_Admin_Settings::init();
		UTE_Elementor_Init::init();

		/**
		 * Action hook after plugin is completely loaded
		 */
		do_action( 'ute_plugin_loaded' );
	}

	/**
	 * Admin notice for missing Elementor
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'painter-creative-elementor-widgets' ),
			'<strong>' . esc_html__( 'Painter Creative Elementor Widgets', 'painter-creative-elementor-widgets' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'painter-creative-elementor-widgets' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post( $message ) );
	}

	/**
	 * Admin notice for minimum Elementor version
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'painter-creative-elementor-widgets' ),
			'<strong>' . esc_html__( 'Painter Creative Elementor Widgets', 'painter-creative-elementor-widgets' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'painter-creative-elementor-widgets' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post( $message ) );
	}

	/**
	 * Admin notice for minimum PHP version
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'painter-creative-elementor-widgets' ),
			'<strong>' . esc_html__( 'Painter Creative Elementor Widgets', 'painter-creative-elementor-widgets' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'painter-creative-elementor-widgets' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post( $message ) );
	}
}
