<?php
		use Elementor\Controls_Manager;

		if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'PHP Include File', 'elementor' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'File Name', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => false,
				],
				'placeholder' => __( 'file-to-include.php', 'elementor' ),
				'default' => __( '', 'elementor' ),
			]
		);

		$this->end_controls_section();
?>
