<?php
/**
 * Creative Painter Heading Elementor Widget
 *
 * Full-width artistic brush stroke heading featuring paint layers,
 * realistic roller graphics, and GPU-accelerated micro-animations.
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
use Elementor\Group_Control_Text_Shadow;
use Elementor\Icons_Manager;

class UTE_Widget_Creative_Heading extends Widget_Base {

	/**
	 * Widget slug
	 */
	public function get_name() {
		return 'ute_creative_heading';
	}

	/**
	 * Widget title
	 */
	public function get_title() {
		return esc_html__( 'Creative Painter Heading', 'painter-creative-elementor-widgets' );
	}

	/**
	 * Widget icon
	 */
	public function get_icon() {
		return 'eicon-heading';
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
		return array( 'heading', 'title', 'paint', 'brush', 'roller', 'stroke', 'creative', 'usman' );
	}

	/**
	 * Style dependencies
	 */
	public function get_style_depends() {
		return array( 'ute-animations', 'ute-creative-heading' );
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
		$this->register_hover_animation_controls();
	}

	/**
	 * 1. Content Controls Section
	 */
	protected function register_content_controls() {
		$this->start_controls_section(
			'section_heading_content',
			array(
				'label' => esc_html__( 'Heading Content', 'painter-creative-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		// Heading Text
		$this->add_control(
			'heading_text',
			array(
				'label'       => esc_html__( 'Heading Text', 'painter-creative-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'Professional Painting Services', 'painter-creative-elementor-widgets' ),
				'placeholder' => esc_html__( 'Enter heading text', 'painter-creative-elementor-widgets' ),
			)
		);

		// Link
		$this->add_control(
			'heading_link',
			array(
				'label'       => esc_html__( 'Link (Optional)', 'painter-creative-elementor-widgets' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array( 'active' => true ),
				'placeholder' => esc_html__( 'https://your-link.com', 'painter-creative-elementor-widgets' ),
				'default'     => array(
					'url'         => '',
					'is_external' => false,
					'nofollow'    => false,
				),
			)
		);

		// HTML Tag
		$this->add_control(
			'heading_html_tag',
			array(
				'label'       => esc_html__( 'HTML Tag', 'painter-creative-elementor-widgets' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				),
				'default'     => 'h2',
				'render_type' => 'template',
			)
		);

		// Alignment
		$this->add_responsive_control(
			'heading_align',
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
					'{{WRAPPER}} .ute-heading-wrapper' => 'justify-content: {{VALUE}};',
					'{{WRAPPER}} .ute-heading-wrapper--justify .ute-creative-heading' => 'width: 100%;',
				),
			)
		);

		// Icon
		$this->add_control(
			'heading_icon',
			array(
				'label'       => esc_html__( 'Icon (Optional)', 'painter-creative-elementor-widgets' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
			)
		);

		// Icon Position
		$this->add_control(
			'heading_icon_position',
			array(
				'label'     => esc_html__( 'Icon Position', 'painter-creative-elementor-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'before' => esc_html__( 'Before Text', 'painter-creative-elementor-widgets' ),
					'after'  => esc_html__( 'After Text', 'painter-creative-elementor-widgets' ),
				),
				'default'   => 'before',
				'condition' => array(
					'heading_icon[value]!' => '',
				),
			)
		);

		// Icon Spacing
		$this->add_responsive_control(
			'heading_icon_gap',
			array(
				'label'      => esc_html__( 'Icon Spacing', 'painter-creative-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 50 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 12 ),
				'selectors'  => array(
					'{{WRAPPER}} .ute-creative-heading' => '--ute-icon-gap: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'heading_icon[value]!' => '',
				),
			)
		);

		// Custom CSS ID
		$this->add_control(
			'heading_custom_id',
			array(
				'label'       => esc_html__( 'Custom HTML ID', 'painter-creative-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'my-heading', 'painter-creative-elementor-widgets' ),
			)
		);

		// ARIA Label
		$this->add_control(
			'heading_aria_label',
			array(
				'label'       => esc_html__( 'Accessibility (ARIA Label)', 'painter-creative-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Descriptive title', 'painter-creative-elementor-widgets' ),
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

		// Custom SVG Shape
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

		// Paint Color
		$this->add_control(
			'paint_color',
			array(
				'label'     => esc_html__( 'Paint Color', 'painter-creative-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FF5E4D',
				'selectors' => array(
					'{{WRAPPER}} .ute-creative-heading' => '--ute-paint-color: {{VALUE}};',
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
					'{{WRAPPER}} .ute-creative-heading' => '--ute-paint-hover-color: {{VALUE}};',
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

		$this->end_controls_section();
	}

	/**
	 * 3. Brush Edges & Irregularity Controls
	 */
	protected function register_edge_controls() {
		$this->start_controls_section(
			'section_brush_edges',
			array(
				'label' => esc_html__( 'Brush Edges & Irregularity', 'painter-creative-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		// Paint Roughness (Contrast)
		$this->add_responsive_control(
			'paint_roughness',
			array(
				'label'     => esc_html__( 'Bristle Definition / Contrast', 'painter-creative-elementor-widgets' ),
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

		// Stroke Scale Y (Default 1.5)
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

		// Left Edge Variation
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

		// Secondary Shape
		$this->add_control(
			'secondary_layer_shape',
			array(
				'label'       => esc_html__( 'Secondary Stroke Shape', 'painter-creative-elementor-widgets' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => UTE_Shapes::get_brush_shapes(),
				'default'     => 'rough-stroke-01',
				'condition'   => array(
					'enable_secondary_layer' => 'yes',
				),
				'render_type' => 'template',
			)
		);

		// Secondary Paint Color
		$this->add_control(
			'secondary_paint_color',
			array(
				'label'     => esc_html__( 'Secondary Layer Color', 'painter-creative-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(240, 75, 55, 0.45)',
				'selectors' => array(
					'{{WRAPPER}} .ute-creative-heading' => '--ute-secondary-paint-color: {{VALUE}};',
				),
				'condition' => array(
					'enable_secondary_layer' => 'yes',
				),
			)
		);

		// Secondary Layer Offset X
		$this->add_responsive_control(
			'secondary_offset_x',
			array(
				'label'      => esc_html__( 'Secondary Offset X', 'painter-creative-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array( 'px' => array( 'min' => -50, 'max' => 50 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 6 ),
				'selectors'  => array(
					'{{WRAPPER}} .ute-paint-layer--secondary' => 'transform: translate({{SIZE}}{{UNIT}}, var(--ute-sec-offset-y, 4px)) rotate(var(--ute-sec-rot, 2deg));',
				),
				'condition'  => array(
					'enable_secondary_layer' => 'yes',
				),
			)
		);

		// Secondary Layer Offset Y
		$this->add_responsive_control(
			'secondary_offset_y',
			array(
				'label'      => esc_html__( 'Secondary Offset Y', 'painter-creative-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array( 'px' => array( 'min' => -50, 'max' => 50 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 4 ),
				'selectors'  => array(
					'{{WRAPPER}} .ute-paint-layer--secondary' => '--ute-sec-offset-y: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'enable_secondary_layer' => 'yes',
				),
			)
		);

		// Secondary Layer Rotation
		$this->add_responsive_control(
			'secondary_rotation',
			array(
				'label'     => esc_html__( 'Secondary Rotation (deg)', 'painter-creative-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array( 'min' => -20, 'max' => 20, 'step' => 0.5 ),
				),
				'default'   => array( 'size' => 2 ),
				'selectors' => array(
					'{{WRAPPER}} .ute-paint-layer--secondary' => '--ute-sec-rot: {{SIZE}}deg;',
				),
				'condition' => array(
					'enable_secondary_layer' => 'yes',
				),
			)
		);

		// Paint Texture Overlay
		$this->add_control(
			'enable_paint_texture',
			array(
				'label'        => esc_html__( 'Paint Canvas Texture (Blend Mode)', 'painter-creative-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'painter-creative-elementor-widgets' ),
				'label_off'    => esc_html__( 'No', 'painter-creative-elementor-widgets' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'render_type'  => 'template',
			)
		);

		// Specular Wet Paint Highlight
		$this->add_control(
			'enable_paint_highlight',
			array(
				'label'        => esc_html__( 'Wet Paint Shine (Specular Highlight)', 'painter-creative-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'painter-creative-elementor-widgets' ),
				'label_off'    => esc_html__( 'No', 'painter-creative-elementor-widgets' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'render_type'  => 'template',
			)
		);

		// Drop Shadow
		$this->add_control(
			'enable_paint_shadow',
			array(
				'label'        => esc_html__( 'Paint Drop Shadow Layer', 'painter-creative-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'painter-creative-elementor-widgets' ),
				'label_off'    => esc_html__( 'No', 'painter-creative-elementor-widgets' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'render_type'  => 'template',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * 5. Paint Roller Graphic Controls
	 */
	protected function register_roller_controls() {
		$this->start_controls_section(
			'section_heading_roller',
			array(
				'label' => esc_html__( 'Paint Roller Graphic', 'painter-creative-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		// Enable Roller Graphic
		$this->add_control(
			'enable_roller',
			array(
				'label'        => esc_html__( 'Enable Roller Graphic', 'painter-creative-elementor-widgets' ),
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
				'label'       => esc_html__( 'Roller Position', 'painter-creative-elementor-widgets' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'right'  => esc_html__( 'Right End (Default)', 'painter-creative-elementor-widgets' ),
					'left'   => esc_html__( 'Left Start', 'painter-creative-elementor-widgets' ),
					'top'    => esc_html__( 'Top', 'painter-creative-elementor-widgets' ),
					'bottom' => esc_html__( 'Bottom', 'painter-creative-elementor-widgets' ),
					'custom' => esc_html__( 'Custom Offset', 'painter-creative-elementor-widgets' ),
				),
				'default'     => 'right',
				'condition'   => array(
					'enable_roller' => 'yes',
				),
				'render_type' => 'template',
			)
		);

		// Roller Vector Design
		$this->add_control(
			'roller_type',
			array(
				'label'       => esc_html__( 'Roller Vector Design', 'painter-creative-elementor-widgets' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => UTE_Shapes::get_roller_types(),
				'default'     => 'horizontal',
				'condition'   => array(
					'enable_roller' => 'yes',
				),
				'render_type' => 'template',
			)
		);

		// Custom Roller SVG Code
		$this->add_control(
			'custom_roller_svg',
			array(
				'label'       => esc_html__( 'Custom Roller SVG Code', 'painter-creative-elementor-widgets' ),
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
					'{{WRAPPER}} .ute-creative-heading' => '--ute-roller-sleeve: {{VALUE}};',
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
					'{{WRAPPER}} .ute-creative-heading' => '--ute-roller-cap-color: {{VALUE}};',
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
					'{{WRAPPER}} .ute-creative-heading:hover' => '--ute-roller-hover-sleeve: {{VALUE}};',
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
					'{{WRAPPER}} .ute-creative-heading:hover' => '--ute-roller-hover-cap: {{VALUE}};',
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
					'{{WRAPPER}} .ute-creative-heading' => '--ute-roller-frame: {{VALUE}};',
				),
				'condition' => array(
					'enable_roller' => 'yes',
				),
			)
		);

		// Roller Handle Color
		$this->add_control(
			'roller_handle_color',
			array(
				'label'     => esc_html__( 'Grip / Handle Color', 'painter-creative-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2B4CFF',
				'selectors' => array(
					'{{WRAPPER}} .ute-creative-heading' => '--ute-roller-handle: {{VALUE}};',
				),
				'condition' => array(
					'enable_roller' => 'yes',
				),
			)
		);

		// Roller Width Responsive (Default: 100px)
		$this->add_responsive_control(
			'roller_width',
			array(
				'label'      => esc_html__( 'Roller Width', 'painter-creative-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array( 'px' => array( 'min' => 40, 'max' => 250 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 100 ),
				'selectors'  => array(
					'{{WRAPPER}} .ute-creative-heading' => '--ute-roller-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'enable_roller' => 'yes',
				),
			)
		);

		// Roller Height Responsive (Default: 130px)
		$this->add_responsive_control(
			'roller_height',
			array(
				'label'      => esc_html__( 'Roller Height', 'painter-creative-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array( 'px' => array( 'min' => 40, 'max' => 250 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 130 ),
				'selectors'  => array(
					'{{WRAPPER}} .ute-creative-heading' => '--ute-roller-height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'enable_roller' => 'yes',
				),
			)
		);

		// Roller Offset X Responsive (Default: 26px)
		$this->add_responsive_control(
			'roller_offset_x',
			array(
				'label'      => esc_html__( 'Roller Offset X', 'painter-creative-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array( 'px' => array( 'min' => -150, 'max' => 150 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 26 ),
				'selectors'  => array(
					'{{WRAPPER}} .ute-creative-heading' => '--ute-roller-offset-x: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'enable_roller' => 'yes',
				),
			)
		);

		// Roller Offset Y Responsive (Default: 0px)
		$this->add_responsive_control(
			'roller_offset_y',
			array(
				'label'      => esc_html__( 'Roller Offset Y', 'painter-creative-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array( 'px' => array( 'min' => -150, 'max' => 150 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 0 ),
				'selectors'  => array(
					'{{WRAPPER}} .ute-creative-heading' => '--ute-roller-offset-y: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'enable_roller' => 'yes',
				),
			)
		);

		// Roller Rotation
		$this->add_responsive_control(
			'roller_rotation',
			array(
				'label'     => esc_html__( 'Roller Angle / Tilt (deg)', 'painter-creative-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array( 'min' => -180, 'max' => 180 ),
				),
				'default'   => array( 'size' => 0 ),
				'selectors' => array(
					'{{WRAPPER}} .ute-creative-heading' => '--ute-roller-rotation: {{SIZE}}deg;',
				),
				'condition' => array(
					'enable_roller' => 'yes',
				),
			)
		);

		// Roller Scale
		$this->add_responsive_control(
			'roller_scale',
			array(
				'label'     => esc_html__( 'Roller Overall Scale', 'painter-creative-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array( 'min' => 0.4, 'max' => 2, 'step' => 0.05 ),
				),
				'default'   => array( 'size' => 1 ),
				'selectors' => array(
					'{{WRAPPER}} .ute-creative-heading' => '--ute-roller-scale: {{SIZE}};',
				),
				'condition' => array(
					'enable_roller' => 'yes',
				),
			)
		);

		// Hide on Mobile
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
			'section_heading_typography',
			array(
				'label' => esc_html__( 'Typography & Colors', 'painter-creative-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// Group Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'heading_typography',
				'selector' => '{{WRAPPER}} .ute-creative-heading',
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
					'{{WRAPPER}} .ute-creative-heading' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .ute-creative-heading:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		// Text Shadow
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'heading_text_shadow',
				'selector' => '{{WRAPPER}} .ute-creative-heading',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * 7. Dimensions & Spacing Controls
	 */
	protected function register_style_dimensions_controls() {
		$this->start_controls_section(
			'section_heading_dimensions',
			array(
				'label' => esc_html__( 'Padding & Dimensions', 'painter-creative-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// Padding
		$this->add_responsive_control(
			'heading_padding',
			array(
				'label'      => esc_html__( 'Padding', 'painter-creative-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'top'      => '18',
					'right'    => '48',
					'bottom'   => '18',
					'left'     => '48',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .ute-creative-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// Minimum Width
		$this->add_responsive_control(
			'heading_min_width',
			array(
				'label'      => esc_html__( 'Minimum Width', 'painter-creative-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array( 'px' => array( 'min' => 100, 'max' => 900 ) ),
				'selectors'  => array(
					'{{WRAPPER}} .ute-creative-heading' => 'min-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Minimum Height
		$this->add_responsive_control(
			'heading_min_height',
			array(
				'label'      => esc_html__( 'Minimum Height', 'painter-creative-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array( 'px' => array( 'min' => 40, 'max' => 200 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 64 ),
				'selectors'  => array(
					'{{WRAPPER}} .ute-creative-heading' => 'min-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * 8. Hover Effects & Micro-Animations
	 */
	protected function register_hover_animation_controls() {
		$this->start_controls_section(
			'section_heading_animation',
			array(
				'label' => esc_html__( 'Hover Effects & Animations', 'painter-creative-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// Heading Hover Effect
		$this->add_control(
			'heading_hover_effect',
			array(
				'label'   => esc_html__( 'Hover Transformation', 'painter-creative-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'none'            => esc_html__( 'None (Default)', 'painter-creative-elementor-widgets' ),
					'lift'            => esc_html__( 'Lift Up Smoothly', 'painter-creative-elementor-widgets' ),
					'press'           => esc_html__( 'Press Inwards', 'painter-creative-elementor-widgets' ),
					'skew'            => esc_html__( 'Brush Angle Skew', 'painter-creative-elementor-widgets' ),
					'paint_scale'     => esc_html__( 'Expand Overall Scale', 'painter-creative-elementor-widgets' ),
					'paint_rotation'  => esc_html__( 'Dynamic Brush Twist', 'painter-creative-elementor-widgets' ),
					'glow'            => esc_html__( 'Wet Paint Radial Glow', 'painter-creative-elementor-widgets' ),
				),
				'default' => 'none',
			)
		);

		// Paint Texture Animation
		$this->add_control(
			'paint_animation',
			array(
				'label'   => esc_html__( 'Paint Stroke Animation', 'painter-creative-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'none'     => esc_html__( 'None (Default)', 'painter-creative-elementor-widgets' ),
					'expand'   => esc_html__( 'Paint Stroke Spread on Hover', 'painter-creative-elementor-widgets' ),
					'movement' => esc_html__( 'Paint Stroke Shift / Offset', 'painter-creative-elementor-widgets' ),
					'pulse'    => esc_html__( 'Subtle Continuous Breath', 'painter-creative-elementor-widgets' ),
					'shimmer'  => esc_html__( 'Light Shimmer Across Wet Paint', 'painter-creative-elementor-widgets' ),
				),
				'default' => 'none',
			)
		);

		// Transition Duration
		$this->add_control(
			'transition_duration',
			array(
				'label'      => esc_html__( 'Transition Duration (s)', 'painter-creative-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array( 'min' => 0.1, 'max' => 1.5, 'step' => 0.05 ),
				),
				'default'    => array( 'size' => 0.35 ),
				'selectors'  => array(
					'{{WRAPPER}} .ute-creative-heading' => '--ute-anim-duration: {{SIZE}}s;',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render Frontend Output
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$heading_text = ! empty( $settings['heading_text'] ) ? $settings['heading_text'] : esc_html__( 'Professional Painting Services', 'painter-creative-elementor-widgets' );
		$html_tag     = ! empty( $settings['heading_html_tag'] ) ? esc_attr( $settings['heading_html_tag'] ) : 'h2';
		$shape_key    = ! empty( $settings['paint_shape'] ) ? $settings['paint_shape'] : 'roller-stop-stroke';
		$roller_type  = ! empty( $settings['roller_type'] ) ? $settings['roller_type'] : 'horizontal';
		$roller_pos   = ! empty( $settings['roller_position'] ) ? $settings['roller_position'] : 'right';
		$align        = ! empty( $settings['heading_align'] ) ? $settings['heading_align'] : 'center';

		$wrapper_classes = array(
			'ute-heading-wrapper',
			'ute-heading-wrapper--' . esc_attr( $align ),
		);

		$heading_classes = array(
			'ute-creative-heading',
		);

		// Hover transformation class
		if ( ! empty( $settings['heading_hover_effect'] ) && 'none' !== $settings['heading_hover_effect'] ) {
			$heading_classes[] = 'ute-hover-' . esc_attr( $settings['heading_hover_effect'] );
		}

		// Paint animation
		if ( ! empty( $settings['paint_animation'] ) && 'none' !== $settings['paint_animation'] ) {
			$heading_classes[] = 'ute-paint-anim-' . esc_attr( $settings['paint_animation'] );
		}

		if ( 'yes' === ( $settings['hide_roller_mobile'] ?? 'no' ) ) {
			$heading_classes[] = 'ute-roller--hide-mobile';
		}

		// Attributes
		$this->add_render_attribute( 'wrapper', 'class', $wrapper_classes );
		$this->add_render_attribute( 'heading', 'class', $heading_classes );

		if ( ! empty( $settings['heading_custom_id'] ) ) {
			$this->add_render_attribute( 'heading', 'id', esc_attr( $settings['heading_custom_id'] ) );
		}

		if ( ! empty( $settings['heading_aria_label'] ) ) {
			$this->add_render_attribute( 'heading', 'aria-label', esc_attr( $settings['heading_aria_label'] ) );
		}

		// Retrieve or sanitize SVG brush shape
		if ( 'custom' === $shape_key && ! empty( $settings['custom_paint_svg'] ) ) {
			$paint_svg = UTE_SVG_Sanitizer::sanitize( $settings['custom_paint_svg'] );
		} else {
			$paint_svg = UTE_Shapes::get_brush_svg( $shape_key );
		}

		// Retrieve or sanitize SVG roller
		$enable_roller = ( 'yes' === ( $settings['enable_roller'] ?? 'no' ) );
		$roller_svg    = '';
		if ( $enable_roller ) {
			if ( 'custom' === $roller_type && ! empty( $settings['custom_roller_svg'] ) ) {
				$roller_svg = UTE_SVG_Sanitizer::sanitize( $settings['custom_roller_svg'] );
			} else {
				$roller_svg = UTE_Shapes::get_roller_svg( $roller_type );
			}
		}

		$has_link = ! empty( $settings['heading_link']['url'] );
		if ( $has_link ) {
			$this->add_link_attributes( 'link', $settings['heading_link'] );
		}

		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<<?php echo esc_attr( $html_tag ); ?> <?php echo $this->get_render_attribute_string( 'heading' ); ?>>
				
				<!-- Paint Layers Container -->
				<div class="ute-paint-layers" aria-hidden="true">
					<?php if ( 'yes' === ( $settings['enable_secondary_layer'] ?? 'no' ) ) : ?>
						<div class="ute-paint-layer ute-paint-layer--secondary">
							<?php echo $paint_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
					<?php endif; ?>

					<div class="ute-paint-layer ute-paint-layer--primary">
						<?php echo $paint_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>

					<?php if ( 'yes' === ( $settings['enable_paint_texture'] ?? 'no' ) ) : ?>
						<div class="ute-paint-layer ute-paint-layer--texture">
							<?php echo $paint_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
					<?php endif; ?>

					<?php if ( 'yes' === ( $settings['enable_paint_highlight'] ?? 'no' ) ) : ?>
						<div class="ute-paint-layer ute-paint-layer--highlight">
							<?php echo $paint_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
					<?php endif; ?>

					<?php if ( 'yes' === ( $settings['enable_paint_shadow'] ?? 'no' ) ) : ?>
						<div class="ute-paint-layer ute-paint-layer--shadow">
							<?php echo $paint_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
					<?php endif; ?>
				</div>

				<!-- Heading Content (Text + Icon) -->
				<span class="ute-heading-content">
					<?php if ( $has_link ) : ?>
						<a <?php echo $this->get_render_attribute_string( 'link' ); ?>>
					<?php endif; ?>

					<?php if ( ! empty( $settings['heading_icon']['value'] ) && 'before' === ( $settings['heading_icon_position'] ?? 'before' ) ) : ?>
						<span class="ute-heading-icon ute-heading-icon--before" aria-hidden="true">
							<?php Icons_Manager::render_icon( $settings['heading_icon'], array( 'aria-hidden' => 'true' ) ); ?>
						</span>
					<?php endif; ?>

					<span class="ute-heading-text">
						<?php echo esc_html( $heading_text ); ?>
					</span>

					<?php if ( ! empty( $settings['heading_icon']['value'] ) && 'after' === ( $settings['heading_icon_position'] ?? 'before' ) ) : ?>
						<span class="ute-heading-icon ute-heading-icon--after" aria-hidden="true">
							<?php Icons_Manager::render_icon( $settings['heading_icon'], array( 'aria-hidden' => 'true' ) ); ?>
						</span>
					<?php endif; ?>

					<?php if ( $has_link ) : ?>
						</a>
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

		var headingText = settings.heading_text || 'Professional Painting Services';
		var htmlTag     = settings.heading_html_tag || 'h2';
		var shapeKey    = settings.paint_shape || 'roller-stop-stroke';
		var rollerPos   = settings.roller_position || 'right';
		var rollerType  = settings.roller_type || 'horizontal';
		var align       = settings.heading_align || 'center';

		var wrapperClasses = 'ute-heading-wrapper ute-heading-wrapper--' + align;
		var headingClasses = 'ute-creative-heading';

		if ( settings.heading_hover_effect && settings.heading_hover_effect !== 'none' ) {
			headingClasses += ' ute-hover-' + settings.heading_hover_effect;
		}

		if ( settings.paint_animation && settings.paint_animation !== 'none' ) {
			headingClasses += ' ute-paint-anim-' + settings.paint_animation;
		}

		if ( settings.hide_roller_mobile === 'yes' ) {
			headingClasses += ' ute-roller--hide-mobile';
		}

		var paintSvg = '';
		if ( shapes && shapes[shapeKey] ) {
			paintSvg = shapes[shapeKey];
		} else if ( shapeKey === 'custom' && settings.custom_paint_svg ) {
			paintSvg = settings.custom_paint_svg;
		} else if ( shapes && shapes['roller-stop-stroke'] ) {
			paintSvg = shapes['roller-stop-stroke'];
		}

		var enableRoller = ( settings.enable_roller === 'yes' );
		var rollerSvg    = '';
		if ( enableRoller ) {
			if ( rollers && rollers[rollerType] ) {
				rollerSvg = rollers[rollerType];
			} else if ( rollerType === 'custom' && settings.custom_roller_svg ) {
				rollerSvg = settings.custom_roller_svg;
			} else if ( rollers && rollers['horizontal'] ) {
				rollerSvg = rollers['horizontal'];
			}
		}

		var hasLink = settings.heading_link && settings.heading_link.url;
		#>
		<div class="{{ wrapperClasses }}">
			<{{ htmlTag }} class="{{ headingClasses }}">
				
				<!-- Paint Layers Container -->
				<div class="ute-paint-layers" aria-hidden="true">
					<# if ( settings.enable_secondary_layer === 'yes' ) { #>
						<div class="ute-paint-layer ute-paint-layer--secondary">
							{{{ paintSvg }}}
						</div>
					<# } #>

					<div class="ute-paint-layer ute-paint-layer--primary">
						{{{ paintSvg }}}
					</div>

					<# if ( settings.enable_paint_texture === 'yes' ) { #>
						<div class="ute-paint-layer ute-paint-layer--texture">
							{{{ paintSvg }}}
						</div>
					<# } #>

					<# if ( settings.enable_paint_highlight === 'yes' ) { #>
						<div class="ute-paint-layer ute-paint-layer--highlight">
							{{{ paintSvg }}}
						</div>
					<# } #>

					<# if ( settings.enable_paint_shadow === 'yes' ) { #>
						<div class="ute-paint-layer ute-paint-layer--shadow">
							{{{ paintSvg }}}
						</div>
					<# } #>
				</div>

				<!-- Heading Content (Text + Icon) -->
				<span class="ute-heading-content">
					<# if ( hasLink ) { #>
						<a href="{{ settings.heading_link.url }}">
					<# } #>

					<span class="ute-heading-text">
						{{{ headingText }}}
					</span>

					<# if ( hasLink ) { #>
						</a>
					<# } #>
				</span>

				<!-- Paint Roller Graphic -->
				<# if ( enableRoller && rollerSvg ) { #>
					<div class="ute-roller-wrap ute-roller--{{ rollerPos }}" aria-hidden="true">
						{{{ rollerSvg }}}
					</div>
				<# } #>

			</{{ htmlTag }}>
		</div>
		<?php
	}
}
