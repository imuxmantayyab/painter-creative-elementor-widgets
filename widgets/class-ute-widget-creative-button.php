<?php
/**
 * Creative Painter Button Elementor Widget
 *
 * @package UsmanCreativeElementorWidgets
 * @author  Usman Tayyab (https://www.linkedin.com/in/imuxmantayyab/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;

class UTE_Widget_Creative_Button extends Widget_Base {

	/**
	 * Widget slug
	 */
	public function get_name() {
		return 'ute_creative_button';
	}

	/**
	 * Widget title
	 */
	public function get_title() {
		return esc_html__( 'Creative Painter Button', 'painter-creative-elementor-widgets' );
	}

	/**
	 * Widget icon
	 */
	public function get_icon() {
		return 'eicon-button';
	}

	/**
	 * Widget category
	 */
	public function get_categories() {
		return array( 'painter-creative-widgets' );
	}

	/**
	 * Search keywords
	 */
	public function get_keywords() {
		return array( 'button', 'paint', 'brush', 'cta', 'roller', 'quote', 'creative', 'usman' );
	}

	/**
	 * Style dependencies
	 */
	public function get_style_depends() {
		return array( 'ute-animations', 'ute-creative-button' );
	}

	/**
	 * Script dependencies
	 */
	public function get_script_depends() {
		return array( 'ute-creative-widgets' );
	}

	/**
	 * Register controls
	 */
	protected function register_controls() {
		$this->register_content_controls();
		$this->register_paint_controls();
		$this->register_edge_controls();
		$this->register_layer_controls();
		$this->register_roller_controls();
		$this->register_style_typography_controls();
		$this->register_style_dimensions_controls();
		$this->register_style_border_shadow_controls();
		$this->register_hover_animation_controls();
	}

	/**
	 * 1. Content Controls Section
	 */
	protected function register_content_controls() {
		$this->start_controls_section(
			'section_button_content',
			array(
				'label' => esc_html__( 'Button Content', 'painter-creative-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		// Button Text
		$this->add_control(
			'button_text',
			array(
				'label'       => esc_html__( 'Button Text', 'painter-creative-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'Get Free Quote', 'painter-creative-elementor-widgets' ),
				'placeholder' => esc_html__( 'Enter button text', 'painter-creative-elementor-widgets' ),
			)
		);

		// Link
		$this->add_control(
			'button_link',
			array(
				'label'       => esc_html__( 'Link', 'painter-creative-elementor-widgets' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array( 'active' => true ),
				'placeholder' => esc_html__( 'https://your-link.com', 'painter-creative-elementor-widgets' ),
				'default'     => array(
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => false,
				),
			)
		);

		// HTML Tag
		$this->add_control(
			'button_html_tag',
			array(
				'label'       => esc_html__( 'HTML Tag', 'painter-creative-elementor-widgets' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'a'      => 'a',
					'button' => 'button',
					'div'    => 'div',
				),
				'default'     => 'a',
				'render_type' => 'template',
			)
		);

		// Alignment
		$this->add_responsive_control(
			'button_align',
			array(
				'label'                => esc_html__( 'Alignment', 'painter-creative-elementor-widgets' ),
				'type'                 => Controls_Manager::CHOOSE,
				'options'              => array(
					'left'    => array(
						'title' => esc_html__( 'Left', 'painter-creative-elementor-widgets' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'  => array(
						'title' => esc_html__( 'Center', 'painter-creative-elementor-widgets' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'   => array(
						'title' => esc_html__( 'Right', 'painter-creative-elementor-widgets' ),
						'icon'  => 'eicon-text-align-right',
					),
					'justify' => array(
						'title' => esc_html__( 'Justified', 'painter-creative-elementor-widgets' ),
						'icon'  => 'eicon-text-align-justify',
					),
				),
				'default'              => 'center',
				'selectors_dictionary' => array(
					'left'    => 'flex-start',
					'center'  => 'center',
					'right'   => 'flex-end',
					'justify' => 'stretch',
				),
				'selectors'            => array(
					'{{WRAPPER}} .ute-button-wrapper' => 'justify-content: {{VALUE}};',
					'{{WRAPPER}} .ute-button-wrapper--justify .ute-creative-button' => 'width: 100%;',
				),
			)
		);

		// Icon
		$this->add_control(
			'button_icon',
			array(
				'label'            => esc_html__( 'Icon (Optional)', 'painter-creative-elementor-widgets' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => array(),
				'render_type'      => 'template',
			)
		);

		// Icon Position
		$this->add_control(
			'button_icon_position',
			array(
				'label'       => esc_html__( 'Icon Position', 'painter-creative-elementor-widgets' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'before' => esc_html__( 'Before Text', 'painter-creative-elementor-widgets' ),
					'after'  => esc_html__( 'After Text', 'painter-creative-elementor-widgets' ),
				),
				'default'     => 'after',
				'condition'   => array(
					'button_icon[value]!' => '',
				),
				'render_type' => 'template',
			)
		);

		// Icon Spacing
		$this->add_responsive_control(
			'button_icon_spacing',
			array(
				'label'      => esc_html__( 'Icon Gap', 'painter-creative-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'range'      => array(
					'px' => array( 'min' => 0, 'max' => 50 ),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 12,
				),
				'selectors'  => array(
					'{{WRAPPER}} .ute-creative-button' => '--ute-icon-gap: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'button_icon[value]!' => '',
				),
			)
		);

		// Accessibility: ARIA Label
		$this->add_control(
			'button_aria_label',
			array(
				'label'       => esc_html__( 'ARIA Label (Accessibility)', 'painter-creative-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'placeholder' => esc_html__( 'Get a free quote for painting services', 'painter-creative-elementor-widgets' ),
			)
		);

		// Custom Button ID
		$this->add_control(
			'button_custom_id',
			array(
				'label'       => esc_html__( 'Button HTML ID', 'painter-creative-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'my-cta-button', 'painter-creative-elementor-widgets' ),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * 2. Paint Stroke Background Controls
	 */
	protected function register_paint_controls() {
		$this->start_controls_section(
			'section_paint_stroke',
			array(
				'label' => esc_html__( 'Paint Stroke Background', 'painter-creative-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		// Paint Shape
		$this->add_control(
			'paint_shape',
			array(
				'label'       => esc_html__( 'Paint Shape', 'painter-creative-elementor-widgets' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => UTE_Shapes::get_brush_shapes(),
				'default'     => 'roller-stop-stroke',
				'render_type' => 'template',
			)
		);

		// Custom SVG Shape (shown only when custom shape selected)
		$this->add_control(
			'custom_paint_svg',
			array(
				'label'       => esc_html__( 'Custom SVG Code', 'painter-creative-elementor-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 6,
				'placeholder' => '<svg viewBox="0 0 1000 240"><path d="..." /></svg>',
				'condition'   => array(
					'paint_shape' => 'custom',
				),
				'render_type' => 'template',
			)
		);

		// Paint Color (Default: Coral from reference #FF5E4D)
		$this->add_control(
			'paint_color',
			array(
				'label'     => esc_html__( 'Paint Color', 'painter-creative-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FF5E4D',
				'selectors' => array(
					'{{WRAPPER}} .ute-creative-button' => '--ute-paint-color: {{VALUE}};',
				),
			)
		);

		// Hover Paint Color
		$this->add_control(
			'paint_hover_color',
			array(
				'label'     => esc_html__( 'Hover Paint Color', 'painter-creative-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FEA502',
				'selectors' => array(
					'{{WRAPPER}} .ute-creative-button' => '--ute-paint-hover-color: {{VALUE}};',
				),
			)
		);

		// Gradient Toggle
		$this->add_control(
			'enable_gradient',
			array(
				'label'        => esc_html__( 'Enable Gradient Paint', 'painter-creative-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'painter-creative-elementor-widgets' ),
				'label_off'    => esc_html__( 'No', 'painter-creative-elementor-widgets' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);

		// Gradient Color 2
		$this->add_control(
			'paint_gradient_color2',
			array(
				'label'     => esc_html__( 'Gradient Second Color', 'painter-creative-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FF8E53',
				'condition' => array(
					'enable_gradient' => 'yes',
				),
			)
		);

		// Gradient Angle
		$this->add_control(
			'paint_gradient_angle',
			array(
				'label'     => esc_html__( 'Gradient Angle (deg)', 'painter-creative-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array( 'min' => 0, 'max' => 360 ),
				),
				'default'   => array( 'size' => 90 ),
				'condition' => array(
					'enable_gradient' => 'yes',
				),
			)
		);

		// Paint Opacity
		$this->add_control(
			'paint_opacity',
			array(
				'label'     => esc_html__( 'Paint Opacity', 'painter-creative-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array( 'min' => 0.1, 'max' => 1, 'step' => 0.05 ),
				),
				'default'   => array( 'size' => 1 ),
				'selectors' => array(
					'{{WRAPPER}} .ute-paint-layer--primary' => 'opacity: {{SIZE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * 3. Brush Edge & Texture Controls
	 */
	protected function register_edge_controls() {
		$this->start_controls_section(
			'section_brush_edges',
			array(
				'label' => esc_html__( 'Brush Edges & Irregularity', 'painter-creative-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		// Edge Roughness
		$this->add_control(
			'edge_roughness',
			array(
				'label'     => esc_html__( 'Edge Roughness / Noise', 'painter-creative-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array( 'min' => 0, 'max' => 100 ),
				),
				'default'   => array( 'size' => 0 ),
				'selectors' => array(
					'{{WRAPPER}} .ute-paint-layer--primary' => 'filter: contrast(calc(100% + {{SIZE}}%));',
				),
			)
		);

		// Stroke Rotation
		$this->add_responsive_control(
			'stroke_rotation',
			array(
				'label'     => esc_html__( 'Stroke Tilt / Rotation', 'painter-creative-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array( 'min' => -25, 'max' => 25, 'step' => 0.5 ),
				),
				'default'   => array( 'size' => 0 ),
				'selectors' => array(
					'{{WRAPPER}} .ute-paint-layer--primary' => 'transform: rotate({{SIZE}}deg);',
				),
			)
		);

		// Stroke Scale X
		$this->add_responsive_control(
			'stroke_scale_x',
			array(
				'label'     => esc_html__( 'Stroke Width Scale (X)', 'painter-creative-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array( 'min' => 0.7, 'max' => 1.5, 'step' => 0.05 ),
				),
				'default'   => array( 'size' => 1 ),
				'selectors' => array(
					'{{WRAPPER}} .ute-paint-layer--primary svg' => '--ute-stroke-scale-x: {{SIZE}};',
				),
			)
		);

		// Stroke Scale Y
		$this->add_responsive_control(
			'stroke_scale_y',
			array(
				'label'     => esc_html__( 'Stroke Height Scale (Y)', 'painter-creative-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array( 'min' => 0.7, 'max' => 2.0, 'step' => 0.05 ),
				),
				'default'   => array( 'size' => 1.5 ),
				'selectors' => array(
					'{{WRAPPER}} .ute-paint-layer--primary svg' => '--ute-stroke-scale-y: {{SIZE}};',
				),
			)
		);

		// Left Edge Variation (Bristle extension)
		$this->add_responsive_control(
			'edge_variation_left',
			array(
				'label'      => esc_html__( 'Left Edge Extension', 'painter-creative-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array( 'min' => -40, 'max' => 60 ),
				),
				'default'    => array( 'unit' => 'px', 'size' => 0 ),
				'selectors'  => array(
					'{{WRAPPER}} .ute-paint-layers' => 'left: {{SIZE}}{{UNIT}}; width: calc(100% - {{SIZE}}{{UNIT}});',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * 4. Multi-Layer Paint System Controls
	 */
	protected function register_layer_controls() {
		$this->start_controls_section(
			'section_paint_layers',
			array(
				'label' => esc_html__( 'Secondary Paint Layers', 'painter-creative-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		// Enable Secondary Layer
		$this->add_control(
			'enable_secondary_layer',
			array(
				'label'        => esc_html__( 'Enable Secondary Paint Shadow/Stroke', 'painter-creative-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'painter-creative-elementor-widgets' ),
				'label_off'    => esc_html__( 'No', 'painter-creative-elementor-widgets' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'render_type'  => 'template',
			)
		);

		// Secondary Paint Color
		$this->add_control(
			'secondary_paint_color',
			array(
				'label'     => esc_html__( 'Secondary Layer Color', 'painter-creative-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(215, 60, 42, 0.4)',
				'selectors' => array(
					'{{WRAPPER}} .ute-creative-button' => '--ute-secondary-paint-color: {{VALUE}};',
				),
				'condition' => array(
					'enable_secondary_layer' => 'yes',
				),
			)
		);

		// Secondary Offset X
		$this->add_responsive_control(
			'secondary_offset_x',
			array(
				'label'      => esc_html__( 'Secondary Offset X', 'painter-creative-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array( 'px' => array( 'min' => -50, 'max' => 50 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 4 ),
				'selectors'  => array(
					'{{WRAPPER}} .ute-paint-layer--secondary' => 'left: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'enable_secondary_layer' => 'yes',
				),
			)
		);

		// Secondary Offset Y
		$this->add_responsive_control(
			'secondary_offset_y',
			array(
				'label'      => esc_html__( 'Secondary Offset Y', 'painter-creative-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array( 'px' => array( 'min' => -50, 'max' => 50 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 5 ),
				'selectors'  => array(
					'{{WRAPPER}} .ute-paint-layer--secondary' => 'top: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'enable_secondary_layer' => 'yes',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * 5. Paint Roller Assembly Controls
	 */
	protected function register_roller_controls() {
		$this->start_controls_section(
			'section_paint_roller',
			array(
				'label' => esc_html__( 'Paint Roller Graphic', 'painter-creative-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		// Enable Roller (Default: Yes to match reference)
		$this->add_control(
			'enable_roller',
			array(
				'label'        => esc_html__( 'Enable Paint Roller', 'painter-creative-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'painter-creative-elementor-widgets' ),
				'label_off'    => esc_html__( 'No', 'painter-creative-elementor-widgets' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'render_type'  => 'template',
			)
		);

		// Roller Position
		$this->add_control(
			'roller_position',
			array(
				'label'       => esc_html__( 'Roller Placement', 'painter-creative-elementor-widgets' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'right'  => esc_html__( 'Right Side (Default)', 'painter-creative-elementor-widgets' ),
					'left'   => esc_html__( 'Left Side', 'painter-creative-elementor-widgets' ),
					'top'    => esc_html__( 'Top', 'painter-creative-elementor-widgets' ),
					'bottom' => esc_html__( 'Bottom', 'painter-creative-elementor-widgets' ),
					'custom' => esc_html__( 'Custom Coordinate Offset', 'painter-creative-elementor-widgets' ),
				),
				'default'     => 'right',
				'condition'   => array(
					'enable_roller' => 'yes',
				),
				'render_type' => 'template',
			)
		);

		// Roller Style Type
		$this->add_control(
			'roller_type',
			array(
				'label'       => esc_html__( 'Roller Model', 'painter-creative-elementor-widgets' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => UTE_Shapes::get_roller_types(),
				'default'     => 'horizontal',
				'condition'   => array(
					'enable_roller' => 'yes',
				),
				'render_type' => 'template',
			)
		);

		// Custom SVG Roller
		$this->add_control(
			'custom_roller_svg',
			array(
				'label'       => esc_html__( 'Custom SVG Roller Code', 'painter-creative-elementor-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 6,
				'placeholder' => '<svg viewBox="0 0 200 240"><g>...</g></svg>',
				'condition'   => array(
					'enable_roller' => 'yes',
					'roller_type'   => 'custom',
				),
				'render_type' => 'template',
			)
		);

		// Roller Sleeve Color (Default: Matches paint #FF5E4D)
		$this->add_control(
			'roller_sleeve_color',
			array(
				'label'     => esc_html__( 'Roller Sleeve (Paint) Color', 'painter-creative-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FF5E4D',
				'selectors' => array(
					'{{WRAPPER}} .ute-creative-button' => '--ute-roller-sleeve: {{VALUE}};',
				),
				'condition' => array(
					'enable_roller' => 'yes',
				),
			)
		);

		// Roller Rim / Cap Ring Color (Default: Matches sleeve #FF5E4D)
		$this->add_control(
			'roller_cap_color',
			array(
				'label'     => esc_html__( 'Roller Rim / Cap Ring Color', 'painter-creative-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FF5E4D',
				'selectors' => array(
					'{{WRAPPER}} .ute-creative-button' => '--ute-roller-cap-color: {{VALUE}};',
				),
				'condition' => array(
					'enable_roller' => 'yes',
				),
			)
		);

		// Roller Sleeve Hover Color (Default: #FEA502)
		$this->add_control(
			'roller_sleeve_hover_color',
			array(
				'label'     => esc_html__( 'Roller Sleeve Hover Color', 'painter-creative-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FEA502',
				'selectors' => array(
					'{{WRAPPER}} .ute-creative-button:hover' => '--ute-roller-hover-sleeve: {{VALUE}};',
				),
				'condition' => array(
					'enable_roller' => 'yes',
				),
			)
		);

		// Roller Rim / Cap Hover Color (Default: #FEA502)
		$this->add_control(
			'roller_cap_hover_color',
			array(
				'label'     => esc_html__( 'Roller Rim / Cap Hover Color', 'painter-creative-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FEA502',
				'selectors' => array(
					'{{WRAPPER}} .ute-creative-button:hover' => '--ute-roller-hover-cap: {{VALUE}};',
				),
				'condition' => array(
					'enable_roller' => 'yes',
				),
			)
		);

		// Roller Frame Color (Metal wire arm)
		$this->add_control(
			'roller_frame_color',
			array(
				'label'     => esc_html__( 'Steel Frame / Wire Color', 'painter-creative-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8C96A8',
				'selectors' => array(
					'{{WRAPPER}} .ute-creative-button' => '--ute-roller-frame: {{VALUE}};',
				),
				'condition' => array(
					'enable_roller' => 'yes',
				),
			)
		);

		// Roller Handle Color (Cobalt blue #2B4CFF from reference)
		$this->add_control(
			'roller_handle_color',
			array(
				'label'     => esc_html__( 'Grip / Handle Color', 'painter-creative-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2B4CFF',
				'selectors' => array(
					'{{WRAPPER}} .ute-creative-button' => '--ute-roller-handle: {{VALUE}};',
				),
				'condition' => array(
					'enable_roller' => 'yes',
				),
			)
		);

		// Roller Width Responsive
		$this->add_responsive_control(
			'roller_width',
			array(
				'label'      => esc_html__( 'Roller Width', 'painter-creative-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array( 'px' => array( 'min' => 40, 'max' => 250 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 100 ),
				'selectors'  => array(
					'{{WRAPPER}} .ute-creative-button' => '--ute-roller-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'enable_roller' => 'yes',
				),
			)
		);

		// Roller Height Responsive
		$this->add_responsive_control(
			'roller_height',
			array(
				'label'      => esc_html__( 'Roller Height', 'painter-creative-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array( 'px' => array( 'min' => 40, 'max' => 250 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 130 ),
				'selectors'  => array(
					'{{WRAPPER}} .ute-creative-button' => '--ute-roller-height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'enable_roller' => 'yes',
				),
			)
		);

		// Roller Offset X Responsive
		$this->add_responsive_control(
			'roller_offset_x',
			array(
				'label'      => esc_html__( 'Roller Offset X', 'painter-creative-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array( 'px' => array( 'min' => -150, 'max' => 150 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 26 ),
				'selectors'  => array(
					'{{WRAPPER}} .ute-creative-button' => '--ute-roller-offset-x: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'enable_roller' => 'yes',
				),
			)
		);

		// Roller Offset Y Responsive
		$this->add_responsive_control(
			'roller_offset_y',
			array(
				'label'      => esc_html__( 'Roller Offset Y', 'painter-creative-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array( 'px' => array( 'min' => -150, 'max' => 150 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 0 ),
				'selectors'  => array(
					'{{WRAPPER}} .ute-creative-button' => '--ute-roller-offset-y: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'enable_roller' => 'yes',
				),
			)
		);

		// Hide roller on mobile
		$this->add_control(
			'hide_roller_mobile',
			array(
				'label'        => esc_html__( 'Hide Roller on Mobile Devices', 'painter-creative-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'painter-creative-elementor-widgets' ),
				'label_off'    => esc_html__( 'No', 'painter-creative-elementor-widgets' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => array(
					'enable_roller' => 'yes',
				),
				'render_type'  => 'template',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * 6. Typography & Text Style
	 */
	protected function register_style_typography_controls() {
		$this->start_controls_section(
			'section_button_typography',
			array(
				'label' => esc_html__( 'Typography & Colors', 'painter-creative-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// Group Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .ute-creative-button',
			)
		);

		// Normal / Hover Tabs for Text Color
		$this->start_controls_tabs( 'tabs_text_colors' );

		// Normal Tab
		$this->start_controls_tab(
			'tab_text_color_normal',
			array(
				'label' => esc_html__( 'Normal', 'painter-creative-elementor-widgets' ),
			)
		);

		$this->add_control(
			'text_color_normal',
			array(
				'label'     => esc_html__( 'Text Color', 'painter-creative-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .ute-creative-button' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		// Hover Tab
		$this->start_controls_tab(
			'tab_text_color_hover',
			array(
				'label' => esc_html__( 'Hover', 'painter-creative-elementor-widgets' ),
			)
		);

		$this->add_control(
			'text_color_hover',
			array(
				'label'     => esc_html__( 'Hover Text Color', 'painter-creative-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .ute-creative-button:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * 7. Dimensions & Spacing Controls
	 */
	protected function register_style_dimensions_controls() {
		$this->start_controls_section(
			'section_button_dimensions',
			array(
				'label' => esc_html__( 'Padding & Dimensions', 'painter-creative-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// Padding
		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => esc_html__( 'Padding', 'painter-creative-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'top'      => 18,
					'right'    => 48,
					'bottom'   => 18,
					'left'     => 48,
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .ute-creative-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// Margin
		$this->add_responsive_control(
			'button_margin',
			array(
				'label'      => esc_html__( 'Margin', 'painter-creative-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ute-creative-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// Button Min Width
		$this->add_responsive_control(
			'button_min_width',
			array(
				'label'      => esc_html__( 'Minimum Width', 'painter-creative-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array( 'px' => array( 'min' => 100, 'max' => 800 ) ),
				'selectors'  => array(
					'{{WRAPPER}} .ute-creative-button' => 'min-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * 8. Border & Shadow Controls
	 */
	protected function register_style_border_shadow_controls() {
		$this->start_controls_section(
			'section_button_border_shadow',
			array(
				'label' => esc_html__( 'Border & Box Shadow', 'painter-creative-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'button_border',
				'selector' => '{{WRAPPER}} .ute-creative-button',
			)
		);

		$this->add_control(
			'button_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'painter-creative-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ute-creative-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .ute-creative-button',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * 9. Hover & Animation Controls
	 */
	protected function register_hover_animation_controls() {
		$this->start_controls_section(
			'section_button_hover_anim',
			array(
				'label' => esc_html__( 'Hover Effects & Animations', 'painter-creative-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// Hover Effect Type
		$this->add_control(
			'hover_effect',
			array(
				'label'       => esc_html__( 'Button Hover Effect', 'painter-creative-elementor-widgets' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'none'            => esc_html__( 'None (Default)', 'painter-creative-elementor-widgets' ),
					'lift'            => esc_html__( 'Lift Up', 'painter-creative-elementor-widgets' ),
					'press'           => esc_html__( 'Press Down', 'painter-creative-elementor-widgets' ),
					'paint_scale'     => esc_html__( 'Scale Up', 'painter-creative-elementor-widgets' ),
					'paint_rotation'  => esc_html__( 'Subtle Rotation Tilt', 'painter-creative-elementor-widgets' ),
					'skew'            => esc_html__( 'Dynamic Skew', 'painter-creative-elementor-widgets' ),
					'glow'            => esc_html__( 'Paint Glow', 'painter-creative-elementor-widgets' ),
				),
				'default'     => 'none',
				'render_type' => 'template',
			)
		);

		// Paint Layer Animation
		$this->add_control(
			'paint_animation',
			array(
				'label'       => esc_html__( 'Paint Stroke Animation', 'painter-creative-elementor-widgets' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'none'     => esc_html__( 'None (Default)', 'painter-creative-elementor-widgets' ),
					'expand'   => esc_html__( 'Paint Expansion', 'painter-creative-elementor-widgets' ),
					'movement' => esc_html__( 'Paint Movement / Dynamic Tilt', 'painter-creative-elementor-widgets' ),
				),
				'default'     => 'none',
				'render_type' => 'template',
			)
		);

		// Animation Duration
		$this->add_control(
			'anim_duration',
			array(
				'label'     => esc_html__( 'Animation Duration (s)', 'painter-creative-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array( 'min' => 0.1, 'max' => 1.5, 'step' => 0.05 ),
				),
				'default'   => array( 'size' => 0.35 ),
				'selectors' => array(
					'{{WRAPPER}} .ute-creative-button' => '--ute-anim-duration: {{SIZE}}s;',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render Frontend Output (PHP)
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$button_text = ! empty( $settings['button_text'] ) ? $settings['button_text'] : '';
		$html_tag    = ! empty( $settings['button_html_tag'] ) ? esc_attr( $settings['button_html_tag'] ) : 'a';
		$shape_key   = ! empty( $settings['paint_shape'] ) ? $settings['paint_shape'] : 'roller-stop-stroke';
		$roller_pos  = ! empty( $settings['roller_position'] ) ? esc_attr( $settings['roller_position'] ) : 'right';
		$roller_type = ! empty( $settings['roller_type'] ) ? $settings['roller_type'] : 'horizontal';
		$align       = ! empty( $settings['button_align'] ) ? esc_attr( $settings['button_align'] ) : 'center';

		// Classes
		$wrapper_classes = array( 'ute-button-wrapper', 'ute-button-wrapper--' . $align );
		$button_classes  = array( 'ute-creative-button' );

		// Hover classes
		if ( ! empty( $settings['hover_effect'] ) && 'none' !== $settings['hover_effect'] ) {
			$button_classes[] = 'ute-hover-' . esc_attr( $settings['hover_effect'] );
		}

		// Paint animation
		if ( ! empty( $settings['paint_animation'] ) && 'none' !== $settings['paint_animation'] ) {
			$button_classes[] = 'ute-paint-anim-' . esc_attr( $settings['paint_animation'] );
		}

		if ( 'yes' === $settings['hide_roller_mobile'] ) {
			$button_classes[] = 'ute-roller--hide-mobile';
		}

		// Attributes
		$this->add_render_attribute( 'wrapper', 'class', $wrapper_classes );
		$this->add_render_attribute( 'button', 'class', $button_classes );

		if ( ! empty( $settings['button_custom_id'] ) ) {
			$this->add_render_attribute( 'button', 'id', esc_attr( $settings['button_custom_id'] ) );
		}

		if ( ! empty( $settings['button_aria_label'] ) ) {
			$this->add_render_attribute( 'button', 'aria-label', esc_attr( $settings['button_aria_label'] ) );
		}

		if ( 'a' === $html_tag ) {
			if ( ! empty( $settings['button_link']['url'] ) ) {
				$this->add_link_attributes( 'button', $settings['button_link'] );
			}
		} else {
			$this->add_render_attribute( 'button', 'role', 'button' );
			$this->add_render_attribute( 'button', 'tabindex', '0' );
		}

		// Retrieve or sanitize SVG brush shape
		if ( 'custom' === $shape_key && ! empty( $settings['custom_paint_svg'] ) ) {
			$paint_svg = UTE_SVG_Sanitizer::sanitize( $settings['custom_paint_svg'] );
		} else {
			$paint_svg = UTE_Shapes::get_brush_svg( $shape_key );
		}

		// Retrieve or sanitize SVG roller
		$enable_roller = ( 'yes' === $settings['enable_roller'] );
		$roller_svg    = '';
		if ( $enable_roller ) {
			if ( 'custom' === $roller_type && ! empty( $settings['custom_roller_svg'] ) ) {
				$roller_svg = UTE_SVG_Sanitizer::sanitize( $settings['custom_roller_svg'] );
			} else {
				$roller_svg = UTE_Shapes::get_roller_svg( $roller_type );
			}
		}

		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<<?php echo esc_attr( $html_tag ); ?> <?php echo $this->get_render_attribute_string( 'button' ); ?>>
				
				<!-- Paint Layers Container -->
				<div class="ute-paint-layers" aria-hidden="true">
					<?php if ( 'yes' === $settings['enable_secondary_layer'] ) : ?>
						<div class="ute-paint-layer ute-paint-layer--secondary">
							<?php echo $paint_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
					<?php endif; ?>

					<div class="ute-paint-layer ute-paint-layer--primary">
						<?php echo $paint_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				</div>

				<!-- Button Content (Text + Icon) -->
				<span class="ute-button-content">
					<?php if ( ! empty( $settings['button_icon']['value'] ) && 'before' === $settings['button_icon_position'] ) : ?>
						<span class="ute-button-icon ute-button-icon--before" aria-hidden="true">
							<?php Icons_Manager::render_icon( $settings['button_icon'], array( 'aria-hidden' => 'true' ) ); ?>
						</span>
					<?php endif; ?>

					<span class="ute-button-text">
						<?php echo esc_html( $button_text ); ?>
					</span>

					<?php if ( ! empty( $settings['button_icon']['value'] ) && 'after' === $settings['button_icon_position'] ) : ?>
						<span class="ute-button-icon ute-button-icon--after" aria-hidden="true">
							<?php Icons_Manager::render_icon( $settings['button_icon'], array( 'aria-hidden' => 'true' ) ); ?>
						</span>
					<?php endif; ?>
				</span>

				<!-- Paint Roller Graphic -->
				<?php if ( $enable_roller && ! empty( $roller_svg ) ) : ?>
					<div class="ute-roller-wrap ute-roller--<?php echo esc_attr( $roller_pos ); ?>" aria-hidden="true">
						<?php echo $roller_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				<?php endif; ?>

			</<?php echo esc_attr( $html_tag ); ?>>
		</div>
		<?php
	}

	/**
	 * Live Editor Canvas Template (Underscore.js for real-time reactivity)
	 */
	protected function content_template() {
		?>
		<#
		var editorData = (typeof UTE_Editor_Data !== 'undefined' && UTE_Editor_Data)
			|| (typeof window !== 'undefined' && window.UTE_Editor_Data)
			|| (typeof parent !== 'undefined' && parent.UTE_Editor_Data)
			|| (typeof top !== 'undefined' && top.UTE_Editor_Data)
			|| {};

		var shapes  = editorData.shapes || {};
		var rollers = editorData.rollers || {};

		var buttonText = settings.button_text || 'Get Free Quote';
		var htmlTag    = settings.button_html_tag || 'a';
		var shapeKey   = settings.paint_shape || 'roller-stop-stroke';
		var rollerPos  = settings.roller_position || 'right';
		var align      = settings.button_align || 'center';

		var wrapperClasses = 'ute-button-wrapper ute-button-wrapper--' + align;
		var buttonClasses  = 'ute-creative-button';

		if ( settings.hover_effect && settings.hover_effect !== 'none' ) {
			buttonClasses += ' ute-hover-' + settings.hover_effect;
		}
		if ( settings.paint_animation && settings.paint_animation !== 'none' ) {
			buttonClasses += ' ute-paint-anim-' + settings.paint_animation;
		}
		if ( settings.hide_roller_mobile === 'yes' ) {
			buttonClasses += ' ute-roller--hide-mobile';
		}

		var paintSvg = '';
		if ( shapes && shapes[shapeKey] ) {
			paintSvg = shapes[shapeKey];
		} else if ( shapeKey === 'custom' && settings.custom_paint_svg ) {
			paintSvg = settings.custom_paint_svg;
		} else if ( shapes && shapes['roller-stop-stroke'] ) {
			paintSvg = shapes['roller-stop-stroke'];
		}

		var rollerSvg = '';
		if ( settings.enable_roller === 'yes' ) {
			var rType = settings.roller_type || 'horizontal';
			if ( rollers && rollers[rType] ) {
				rollerSvg = rollers[rType];
			} else if ( rType === 'custom' && settings.custom_roller_svg ) {
				rollerSvg = settings.custom_roller_svg;
			}
		}

		var iconHTML = '';
		if ( settings.button_icon && settings.button_icon.value ) {
			iconHTML = elementor.helpers.renderIcon( this, settings.button_icon, { 'aria-hidden': true }, 'i', 'object' );
		}

		var buttonUrl = (settings.button_link && settings.button_link.url) ? settings.button_link.url : '#';
		var customId = settings.button_custom_id ? ' id="' + settings.button_custom_id + '"' : '';
		var ariaLabel = settings.button_aria_label ? ' aria-label="' + settings.button_aria_label + '"' : '';
		#>
		<div class="{{ wrapperClasses }}">
			<{{ htmlTag }} class="{{ buttonClasses }}"<# if ( 'a' === htmlTag ) { #> href="{{ buttonUrl }}"<# } else { #> role="button" tabindex="0"<# } #>{{{ customId }}}{{{ ariaLabel }}}>
				
				<!-- Paint Layers Container -->
				<div class="ute-paint-layers" aria-hidden="true">
					<# if ( settings.enable_secondary_layer === 'yes' && paintSvg ) { #>
						<div class="ute-paint-layer ute-paint-layer--secondary">
							{{{ paintSvg }}}
						</div>
					<# } #>

					<div class="ute-paint-layer ute-paint-layer--primary">
						{{{ paintSvg }}}
					</div>
				</div>

				<!-- Button Content (Text + Icon) -->
				<span class="ute-button-content">
					<# if ( iconHTML && iconHTML.value && settings.button_icon_position === 'before' ) { #>
						<span class="ute-button-icon ute-button-icon--before" aria-hidden="true">
							{{{ iconHTML.value }}}
						</span>
					<# } #>

					<span class="ute-button-text">{{{ buttonText }}}</span>

					<# if ( iconHTML && iconHTML.value && settings.button_icon_position === 'after' ) { #>
						<span class="ute-button-icon ute-button-icon--after" aria-hidden="true">
							{{{ iconHTML.value }}}
						</span>
					<# } #>
				</span>

				<!-- Paint Roller Graphic -->
				<# if ( settings.enable_roller === 'yes' && rollerSvg ) { #>
					<div class="ute-roller-wrap ute-roller--{{ rollerPos }}" aria-hidden="true">
						{{{ rollerSvg }}}
					</div>
				<# } #>

			</{{ htmlTag }}>
		</div>
		<?php
	}
}
