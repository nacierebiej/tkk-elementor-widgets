<?php
	use Elementor\Controls_Manager;
	use Elementor\Scheme_Color;
	use Elementor\Group_Control_Typography;
	use Elementor\Scheme_Typography;
	use Elementor\Utils;
	use Elementor\Group_Control_Image_Size;
	use Elementor\Group_Control_Css_Filter;
	use Elementor\Group_Control_Border;
	use Elementor\Group_Control_Box_Shadow;

	$this->start_controls_section(
		'section_image',
		[
			'label' => __( 'Card Image', 'elementor' ),
		]
	);

	$this->add_control(
		'image',
		[
			'label' => __( 'Choose Image', 'elementor' ),
			'type' => Controls_Manager::MEDIA,
			'dynamic' => [
				'active' => true,
			],
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			],
		]
	);

	$this->add_group_control(
		Group_Control_Image_Size::get_type(),
		[
			'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
			'default' => 'large',
			'separator' => 'none',
		]
	);

	$this->add_responsive_control(
		'align',
		[
			'label' => __( 'Alignment', 'elementor' ),
			'type' => Controls_Manager::CHOOSE,
			'options' => [
				'left' => [
					'title' => __( 'Left', 'elementor' ),
					'icon' => 'fa fa-align-left',
				],
				'center' => [
					'title' => __( 'Center', 'elementor' ),
					'icon' => 'fa fa-align-center',
				],
				'right' => [
					'title' => __( 'Right', 'elementor' ),
					'icon' => 'fa fa-align-right',
				],
			],
			'selectors' => [
				'{{WRAPPER}}' => 'text-align: {{VALUE}};',
			],
		]
	);

	$this->add_control(
		'caption_source',
		[
			'label' => __( 'Caption', 'elementor' ),
			'type' => Controls_Manager::SELECT,
			'options' => [
				'none' => __( 'None', 'elementor' ),
				'attachment' => __( 'Attachment Caption', 'elementor' ),
				'custom' => __( 'Custom Caption', 'elementor' ),
			],
			'default' => 'none',
		]
	);

	$this->add_control(
		'caption',
		[
			'label' => __( 'Custom Caption', 'elementor' ),
			'type' => Controls_Manager::TEXT,
			'default' => '',
			'placeholder' => __( 'Enter your image caption', 'elementor' ),
			'condition' => [
				'caption_source' => 'custom',
			],
			'dynamic' => [
				'active' => true,
			],
		]
	);

	$this->add_control(
		'link_to',
		[
			'label' => __( 'Link to', 'elementor' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'none',
			'options' => [
				'none' => __( 'None', 'elementor' ),
				'file' => __( 'Media File', 'elementor' ),
				'custom' => __( 'Custom URL', 'elementor' ),
			],
		]
	);

	$this->add_control(
		'link',
		[
			'label' => __( 'Link to', 'elementor' ),
			'type' => Controls_Manager::URL,
			'dynamic' => [
				'active' => true,
			],
			'placeholder' => __( 'https://your-link.com', 'elementor' ),
			'condition' => [
				'link_to' => 'custom',
			],
			'show_label' => false,
		]
	);

	$this->add_control(
		'open_lightbox',
		[
			'label' => __( 'Lightbox', 'elementor' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'default',
			'options' => [
				'default' => __( 'Default', 'elementor' ),
				'yes' => __( 'Yes', 'elementor' ),
				'no' => __( 'No', 'elementor' ),
			],
			'condition' => [
				'link_to' => 'file',
			],
		]
	);

	$this->add_control(
		'view',
		[
			'label' => __( 'View', 'elementor' ),
			'type' => Controls_Manager::HIDDEN,
			'default' => 'traditional',
		]
	);

	$this->end_controls_section();

	$this->start_controls_section(
		'section_style_image',
		[
			'label' => __( 'Image', 'elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		]
	);

	$this->add_responsive_control(
		'width',
		[
			'label' => __( 'Width', 'elementor' ),
			'type' => Controls_Manager::SLIDER,
			'default' => [
				'unit' => '%',
			],
			'tablet_default' => [
				'unit' => '%',
			],
			'mobile_default' => [
				'unit' => '%',
			],
			'size_units' => [ '%', 'px', 'vw' ],
			'range' => [
				'%' => [
					'min' => 1,
					'max' => 100,
				],
				'px' => [
					'min' => 1,
					'max' => 1000,
				],
				'vw' => [
					'min' => 1,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .elementor-image img' => 'width: {{SIZE}}{{UNIT}};',
			],
		]
	);

	$this->add_responsive_control(
		'space',
		[
			'label' => __( 'Max Width', 'elementor' ) . ' (%)',
			'type' => Controls_Manager::SLIDER,
			'default' => [
				'unit' => '%',
			],
			'tablet_default' => [
				'unit' => '%',
			],
			'mobile_default' => [
				'unit' => '%',
			],
			'size_units' => [ '%' ],
			'range' => [
				'%' => [
					'min' => 1,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .elementor-image img' => 'max-width: {{SIZE}}{{UNIT}};',
			],
		]
	);

	$this->add_control(
		'separator_panel_style',
		[
			'type' => Controls_Manager::DIVIDER,
			'style' => 'thick',
		]
	);

	$this->start_controls_tabs( 'image_effects' );

	$this->start_controls_tab( 'normal',
		[
			'label' => __( 'Normal', 'elementor' ),
		]
	);

	$this->add_control(
		'opacity',
		[
			'label' => __( 'Opacity', 'elementor' ),
			'type' => Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'max' => 1,
					'min' => 0.10,
					'step' => 0.01,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .elementor-image img' => 'opacity: {{SIZE}};',
			],
		]
	);

	$this->add_group_control(
		Group_Control_Css_Filter::get_type(),
		[
			'name' => 'css_filters',
			'selector' => '{{WRAPPER}} .elementor-image img',
		]
	);

	$this->end_controls_tab();

	$this->start_controls_tab( 'hover',
		[
			'label' => __( 'Hover', 'elementor' ),
		]
	);

	$this->add_control(
		'opacity_hover',
		[
			'label' => __( 'Opacity', 'elementor' ),
			'type' => Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'max' => 1,
					'min' => 0.10,
					'step' => 0.01,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .elementor-image:hover img' => 'opacity: {{SIZE}};',
			],
		]
	);

	$this->add_group_control(
		Group_Control_Css_Filter::get_type(),
		[
			'name' => 'css_filters_hover',
			'selector' => '{{WRAPPER}} .elementor-image:hover img',
		]
	);

	$this->add_control(
		'background_hover_transition',
		[
			'label' => __( 'Transition Duration', 'elementor' ),
			'type' => Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'max' => 3,
					'step' => 0.1,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .elementor-image img' => 'transition-duration: {{SIZE}}s',
			],
		]
	);

	$this->add_control(
		'hover_animation',
		[
			'label' => __( 'Hover Animation', 'elementor' ),
			'type' => Controls_Manager::HOVER_ANIMATION,
		]
	);

	$this->end_controls_tab();

	$this->end_controls_tabs();

	$this->add_group_control(
		Group_Control_Border::get_type(),
		[
			'name' => 'image_border',
			'selector' => '{{WRAPPER}} .elementor-image img',
			'separator' => 'before',
		]
	);

	$this->add_responsive_control(
		'image_border_radius',
		[
			'label' => __( 'Border Radius', 'elementor' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors' => [
				'{{WRAPPER}} .elementor-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$this->add_group_control(
		Group_Control_Box_Shadow::get_type(),
		[
			'name' => 'image_box_shadow',
			'exclude' => [
				'box_shadow_position',
			],
			'selector' => '{{WRAPPER}} .elementor-image img',
		]
	);

	$this->end_controls_section();

	$this->start_controls_section(
		'section_style_caption',
		[
			'label' => __( 'Caption', 'elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
			'condition' => [
				'caption!' => '',
			],
		]
	);

	$this->add_control(
		'caption_align',
		[
			'label' => __( 'Alignment', 'elementor' ),
			'type' => Controls_Manager::CHOOSE,
			'options' => [
				'left' => [
					'title' => __( 'Left', 'elementor' ),
					'icon' => 'fa fa-align-left',
				],
				'center' => [
					'title' => __( 'Center', 'elementor' ),
					'icon' => 'fa fa-align-center',
				],
				'right' => [
					'title' => __( 'Right', 'elementor' ),
					'icon' => 'fa fa-align-right',
				],
				'justify' => [
					'title' => __( 'Justified', 'elementor' ),
					'icon' => 'fa fa-align-justify',
				],
			],
			'default' => '',
			'selectors' => [
				'{{WRAPPER}} .widget-image-caption' => 'text-align: {{VALUE}};',
			],
		]
	);

	$this->add_control(
		'text_color',
		[
			'label' => __( 'Text Color', 'elementor' ),
			'type' => Controls_Manager::COLOR,
			'default' => '',
			'selectors' => [
				'{{WRAPPER}} .widget-image-caption' => 'color: {{VALUE}};',
			],
			'scheme' => [
				'type' => Scheme_Color::get_type(),
				'value' => Scheme_Color::COLOR_3,
			],
		]
	);

	$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name' => 'caption_typography',
			'selector' => '{{WRAPPER}} .widget-image-caption',
			'scheme' => Scheme_Typography::TYPOGRAPHY_3,
		]
	);

	$this->add_responsive_control(
		'caption_space',
		[
			'label' => __( 'Spacing', 'elementor' ),
			'type' => Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .widget-image-caption' => 'margin-top: {{SIZE}}{{UNIT}};',
			],
		]
	);

	$this->end_controls_section();