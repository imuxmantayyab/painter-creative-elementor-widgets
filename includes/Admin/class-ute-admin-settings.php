<?php
/**
 * Admin Settings & Dashboard for Painter Creative Elementor Widgets
 *
 * @package UsmanCreativeElementorWidgets
 * @author  Usman Tayyab (https://www.linkedin.com/in/imuxmantayyab/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class UTE_Admin_Settings {

	/**
	 * Option key
	 */
	const OPTION_KEY = 'ute_settings';

	/**
	 * Initialize admin hooks
	 */
	public static function init() {
		add_action( 'admin_menu', array( __CLASS__, 'add_admin_menu' ) );
		add_action( 'admin_init', array( __CLASS__, 'register_settings' ) );
	}

	/**
	 * Add menu to WordPress Admin
	 */
	public static function add_admin_menu() {
		add_menu_page(
			esc_html__( 'Painter Creative Widgets', 'painter-creative-elementor-widgets' ),
			esc_html__( 'Creative Widgets', 'painter-creative-elementor-widgets' ),
			'manage_options',
			'painter-creative-widgets',
			array( __CLASS__, 'render_settings_page' ),
			'dashicons-art',
			99
		);
	}

	/**
	 * Register settings and fields
	 */
	public static function register_settings() {
		register_setting(
			'ute_settings_group',
			self::OPTION_KEY,
			array(
				'type'              => 'array',
				'sanitize_callback' => array( __CLASS__, 'sanitize_settings' ),
				'default'           => array(
					'enable_button'  => 1,
					'enable_heading' => 1,
				),
			)
		);
	}

	/**
	 * Sanitize settings inputs
	 *
	 * @param array $input Input values.
	 * @return array
	 */
	public static function sanitize_settings( $input ) {
		$sanitized = array();
		$sanitized['enable_button']  = ! empty( $input['enable_button'] ) ? 1 : 0;
		$sanitized['enable_heading'] = ! empty( $input['enable_heading'] ) ? 1 : 0;
		return $sanitized;
	}

	/**
	 * Render settings page
	 */
	public static function render_settings_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$options = get_option( self::OPTION_KEY, array(
			'enable_button'  => 1,
			'enable_heading' => 1,
		) );

		$elementor_active  = did_action( 'elementor/loaded' );
		$elementor_version = defined( 'ELEMENTOR_VERSION' ) ? ELEMENTOR_VERSION : 'Not installed';
		?>
		<div class="wrap ute-admin-wrap">
			<div class="ute-admin-header">
				<div class="ute-admin-brand">
					<span class="dashicons dashicons-art ute-brand-icon"></span>
					<div>
						<h1><?php esc_html_e( 'Painter Creative Elementor Widgets', 'painter-creative-elementor-widgets' ); ?></h1>
						<p class="ute-brand-sub"><?php esc_html_e( 'Artistic hand-painted brush stroke CTA buttons & creative headings for Elementor', 'painter-creative-elementor-widgets' ); ?> &bull; v<?php echo esc_html( UTE_PLUGIN_VERSION ); ?></p>
					</div>
				</div>
				<div class="ute-admin-author">
					<span><?php esc_html_e( 'Developed by', 'painter-creative-elementor-widgets' ); ?> <strong>Usman Tayyab</strong></span>
					<a href="https://www.linkedin.com/in/imuxmantayyab/" target="_blank" rel="noopener noreferrer" class="button button-secondary">
						<span class="dashicons dashicons-external"></span> <?php esc_html_e( 'LinkedIn Profile', 'painter-creative-elementor-widgets' ); ?>
					</a>
				</div>
			</div>

			<?php settings_errors(); ?>

			<div class="ute-admin-grid">
				<div class="ute-admin-main">
					<form method="post" action="options.php" class="ute-settings-form">
						<?php
						settings_fields( 'ute_settings_group' );
						$enable_btn = isset( $options['enable_button'] ) ? $options['enable_button'] : 1;
						$enable_hdg = isset( $options['enable_heading'] ) ? $options['enable_heading'] : 1;
						?>

						<div class="ute-card">
							<div class="ute-card-header">
								<h2><?php esc_html_e( 'Available Widgets', 'painter-creative-elementor-widgets' ); ?></h2>
								<p><?php esc_html_e( 'Toggle widgets on or off. Disabled widgets will not load assets on your site, keeping your pages lightweight.', 'painter-creative-elementor-widgets' ); ?></p>
							</div>
							<div class="ute-card-body">
								<div class="ute-widget-toggle-row">
									<div class="ute-widget-info">
										<span class="dashicons dashicons-button ute-widget-icon"></span>
										<div>
											<strong><?php esc_html_e( 'Creative Painter Button', 'painter-creative-elementor-widgets' ); ?></strong>
											<p><?php esc_html_e( 'Authentic hand-painted brush stroke CTA button with rough edges, layered paints, realistic paint roller, and fluid animations.', 'painter-creative-elementor-widgets' ); ?></p>
										</div>
									</div>
									<label class="ute-switch">
										<input type="checkbox" name="ute_settings[enable_button]" value="1" <?php checked( 1, $enable_btn ); ?> />
										<span class="ute-slider"></span>
									</label>
								</div>

								<div class="ute-widget-toggle-row">
									<div class="ute-widget-info">
										<span class="dashicons dashicons-heading ute-widget-icon"></span>
										<div>
											<strong><?php esc_html_e( 'Creative Brush Heading', 'painter-creative-elementor-widgets' ); ?></strong>
											<p><?php esc_html_e( 'Expressive headlines featuring organic paint highlights, multi-layer brushes, underlined swipes, and responsive typography.', 'painter-creative-elementor-widgets' ); ?></p>
										</div>
									</div>
									<label class="ute-switch">
										<input type="checkbox" name="ute_settings[enable_heading]" value="1" <?php checked( 1, $enable_hdg ); ?> />
										<span class="ute-slider"></span>
									</label>
								</div>
							</div>
							<div class="ute-card-footer">
								<?php submit_button( esc_html__( 'Save Changes', 'painter-creative-elementor-widgets' ), 'primary', 'submit', false ); ?>
							</div>
						</div>
					</form>

					<div class="ute-card">
						<div class="ute-card-header">
							<h2><?php esc_html_e( 'Quick Design Presets Included', 'painter-creative-elementor-widgets' ); ?></h2>
						</div>
						<div class="ute-card-body">
							<div class="ute-presets-grid">
								<div class="ute-preset-pill">
									<strong>1. Coral Brush (Default)</strong>
									<span>Exact reference look with rough edges, bright coral paint, and blue-handled roller.</span>
								</div>
								<div class="ute-preset-pill">
									<strong>2. Orange Paint</strong>
									<span>Energetic saturated orange acrylic swipe.</span>
								</div>
								<div class="ute-preset-pill">
									<strong>3. Blue Brush</strong>
									<span>Cool modern corporate cyan-blue stroke.</span>
								</div>
								<div class="ute-preset-pill">
									<strong>4. Black Marker</strong>
									<span>Bold artistic edgy marker highlighter with angled tips.</span>
								</div>
								<div class="ute-preset-pill">
									<strong>5. Minimal Paint</strong>
									<span>Subtle, clean paint stroke for minimalist landing pages.</span>
								</div>
								<div class="ute-preset-pill">
									<strong>6. Professional CTA</strong>
									<span>Commercial service contractor CTA matching modern trade websites.</span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="ute-admin-sidebar">
					<div class="ute-card">
						<div class="ute-card-header">
							<h3><?php esc_html_e( 'System Status', 'painter-creative-elementor-widgets' ); ?></h3>
						</div>
						<div class="ute-card-body ute-sysinfo">
							<div class="ute-sys-item">
								<span><?php esc_html_e( 'Elementor Status:', 'painter-creative-elementor-widgets' ); ?></span>
								<?php if ( $elementor_active ) : ?>
									<span class="ute-badge ute-badge-success"><?php esc_html_e( 'Active', 'painter-creative-elementor-widgets' ); ?> (v<?php echo esc_html( $elementor_version ); ?>)</span>
								<?php else : ?>
									<span class="ute-badge ute-badge-danger"><?php esc_html_e( 'Not Detected', 'painter-creative-elementor-widgets' ); ?></span>
								<?php endif; ?>
							</div>
							<div class="ute-sys-item">
								<span><?php esc_html_e( 'WordPress Version:', 'painter-creative-elementor-widgets' ); ?></span>
								<strong><?php echo esc_html( get_bloginfo( 'version' ) ); ?></strong>
							</div>
							<div class="ute-sys-item">
								<span><?php esc_html_e( 'PHP Version:', 'painter-creative-elementor-widgets' ); ?></span>
								<strong><?php echo esc_html( phpversion() ); ?></strong>
							</div>
						</div>
					</div>

					<div class="ute-card">
						<div class="ute-card-header">
							<h3><?php esc_html_e( 'About Developer', 'painter-creative-elementor-widgets' ); ?></h3>
						</div>
						<div class="ute-card-body ute-author-card">
							<p class="ute-author-name"><strong>Usman Tayyab</strong></p>
							<p class="ute-author-title"><strong><?php esc_html_e( 'Senior WordPress Architect & Team Lead (TPM)', 'painter-creative-elementor-widgets' ); ?></strong></p>
							<p class="ute-author-tagline"><?php esc_html_e( 'I build WordPress products that are fast, scalable, and built to last.', 'painter-creative-elementor-widgets' ); ?></p>
							
							<p><?php esc_html_e( 'Listed contributor on Xpro Elementor Addons (40,000+ active installs), having architected 140+ widgets, a full theme builder, and 100+ premium starter sites from scratch.', 'painter-creative-elementor-widgets' ); ?></p>
							
							<p><?php esc_html_e( '4+ years engineering across custom plugin & theme architecture (PHP OOP), Elementor addon development, VPS server management, and Core Web Vitals optimization.', 'painter-creative-elementor-widgets' ); ?></p>
							
							<p class="ute-author-status"><em><?php esc_html_e( 'Open to senior engineering roles, product teams, and high-impact freelance projects.', 'painter-creative-elementor-widgets' ); ?></em></p>
							
							<div class="ute-author-links">
								<p><a href="https://www.linkedin.com/in/imuxmantayyab/" target="_blank" rel="noopener noreferrer" class="button button-primary ute-btn-block">
									<?php esc_html_e( 'Connect on LinkedIn', 'painter-creative-elementor-widgets' ); ?>
								</a></p>
								<p><a href="https://github.com/imuxmantayyab/painter-creative-elementor-widgets" target="_blank" rel="noopener noreferrer" class="button button-secondary ute-btn-block">
									<?php esc_html_e( 'View on GitHub', 'painter-creative-elementor-widgets' ); ?>
								</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
