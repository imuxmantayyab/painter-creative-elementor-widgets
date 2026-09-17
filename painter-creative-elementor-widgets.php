<?php
/**
 * Plugin Name:       Painter Creative Elementor Widgets
 * Plugin URI:        https://github.com/imuxmantayyab/painter-creative-elementor-widgets
 * Description:       Artistic hand-painted brush stroke CTA buttons and creative headings for Elementor, featuring organic paint edges, multi-layer brushes, realistic paint roller graphics, and GPU-accelerated micro-animations.
 * Version:           1.0.0
 * Author:            Usman Tayyab
 * Author URI:        https://www.linkedin.com/in/imuxmantayyab/
 * Text Domain:       painter-creative-elementor-widgets
 * Domain Path:       /languages
 * Requires at least: 5.8
 * Requires PHP:      7.4
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package UsmanCreativeElementorWidgets
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Plugin constants
define( 'UTE_PLUGIN_VERSION', '1.0.0' );
define( 'UTE_PLUGIN_FILE', __FILE__ );
define( 'UTE_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'UTE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'UTE_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

// Load classes
require_once UTE_PLUGIN_PATH . 'includes/class-ute-svg-sanitizer.php';
require_once UTE_PLUGIN_PATH . 'includes/class-ute-shapes.php';
require_once UTE_PLUGIN_PATH . 'includes/class-ute-assets.php';
require_once UTE_PLUGIN_PATH . 'includes/Admin/class-ute-admin-settings.php';
require_once UTE_PLUGIN_PATH . 'includes/Elementor/class-ute-category.php';
require_once UTE_PLUGIN_PATH . 'includes/Elementor/class-ute-elementor-init.php';
require_once UTE_PLUGIN_PATH . 'includes/class-ute-plugin.php';

/**
 * Bootstrap the plugin
 */
function ute_run_plugin() {
	return UTE_Plugin::instance();
}
ute_run_plugin();

/**
 * Plugin action links (adds Settings link to plugins table)
 */
add_filter( 'plugin_action_links_' . UTE_PLUGIN_BASENAME, 'ute_add_plugin_action_links' );
function ute_add_plugin_action_links( $links ) {
	$settings_link = sprintf(
		'<a href="%1$s">%2$s</a>',
		admin_url( 'admin.php?page=painter-creative-widgets' ),
		esc_html__( 'Settings', 'painter-creative-elementor-widgets' )
	);
	array_unshift( $links, $settings_link );
	return $links;
}
