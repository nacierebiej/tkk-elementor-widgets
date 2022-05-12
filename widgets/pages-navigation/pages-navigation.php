<?php
namespace BSAElementorWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Dimensions;

// Include pages navigation walker
require_once('class-walker-pages-navigation.php');
use BSAElementorWidgets\Walkers\Walker_Pages_Navigation;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class BSAPagesNavigation extends Widget_Base {
	private $all_pages = array();
	private $hidden_pages_ids = array();

  /**
   * Sets the hidden pages IDs in the class
   **/
	public function setHiddenPagesIDs() {
		$args = array(
			'posts_per_page' => '-1',
			'post_type' => 'page',
			'meta_query' => array(
				array(
					'key' => 'hide',
					'value' => '1'
				)
			)
		);
		$hidden_pages = new \WP_Query($args);
		foreach ($hidden_pages->posts as $post) {
			$this->hidden_pages_ids[] = -$post->ID;
		}
		wp_reset_postdata();
	}

  /**
   * Sets all pages in the class
   **/
	public function setAllPages() {
		// Childposts
		$args = array(
      'post_type' => 'page',
			'posts_per_page' => '-1',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'post__not_in' => $this->hidden_pages_ids
		);

		$this->all_pages = new \WP_Query($args);
		wp_reset_postdata();
	}

	/**
   * Gets the Widget name
   *
   * Gets the widget name that is going to be used on code
   *
   * @return String
   **/
  public function get_name() {
    return 'bsa_pages_navigation';
  }

  /**
   * Gets the Widget title
   *
   * Gets the widget title that will be displayed on the frontend
   *
   * @return String
   **/
  public function get_title() {
    return __('BSA Pages Navigation', 'bsa-elementor-widgets');
  }

  /**
   * Gets the Widget icon
   *
   * Gets the widget icon that will be displayed on the frontend
   *
   * @return String
   **/
  public function get_icon() {
    return 'fa fa-code';
  }

  /**
   * Get the category of the widget
   *
   * Gets the widget category inside which the widget will be displayed on the frontend
   *
   * @return String
   **/
  public function get_categories() {
    return ['bsa-widgets'];
  }

  /**
   * Sets up the widget's backend panel
   *
   * Gets the widget icon that will be displayed on the frontend
   *
   * @return String
   **/
  protected function _register_controls() {
		$this->start_controls_section(
			'general_section',
			[
				'label' => __( 'General Styles', 'bsa-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			// Normal / Hover tabs
			$this->start_controls_tabs(
				'general_hover_tabs'
			);
				// Normal tab
				$this->start_controls_tab(
					'general_normal_tab',
					[
						'label' => __( 'Normal', 'bsa-elementor-widgets' )
					]
				);
					// Current page BG
					$this->add_control(
						'general_bg',
						[
							'label' => __( 'Background Color', 'bsa-elementor-widgets' ),
							'type' => Controls_Manager::COLOR,
							'scheme' => [
								'type' => Scheme_Color::get_type(),
								'value' => Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .menu ul li a' => 'background-color: {{VALUE}}'
							]
						]
					);
					// Current page color
					$this->add_control(
						'general_color',
						[
							'label' => __( 'Font Color', 'bsa-elementor-widgets' ),
							'type' => Controls_Manager::COLOR,
							'scheme' => [
								'type' => Scheme_Color::get_type(),
								'value' => Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .menu ul li a' => 'color: {{VALUE}}'
							]
						]
					);
				$this->end_controls_tab();

				// Hover tab
				$this->start_controls_tab(
					'general_hover_tab',
					[
						'label' => __( 'Hover', 'bsa-elementor-widgets' )
					]
				);
					// Current page BG
					$this->add_control(
						'general_bg_hover',
						[
							'label' => __( 'Background Color', 'bsa-elementor-widgets' ),
							'type' => Controls_Manager::COLOR,
							'scheme' => [
								'type' => Scheme_Color::get_type(),
								'value' => Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .menu ul li a:hover' => 'background-color: {{VALUE}}'
							]
						]
					);
					// Current page color
					$this->add_control(
						'general_color_hover',
						[
							'label' => __( 'Font Color', 'bsa-elementor-widgets' ),
							'type' => Controls_Manager::COLOR,
							'scheme' => [
								'type' => Scheme_Color::get_type(),
								'value' => Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .menu ul li a:hover' => 'color: {{VALUE}}'
							]
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();


		$this->start_controls_section(
			'general_alt_section',
			[
				'label' => __( 'General Alternative Styles', 'bsa-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			// Normal / Hover tabs
			$this->start_controls_tabs(
				'general_alt_hover_tabs'
			);
				// Normal tab
				$this->start_controls_tab(
					'general_alt_normal_tab',
					[
						'label' => __( 'Normal', 'bsa-elementor-widgets' )
					]
				);
					// Current page BG
					$this->add_control(
						'general_alt_bg',
						[
							'label' => __( 'Background Color', 'bsa-elementor-widgets' ),
							'type' => Controls_Manager::COLOR,
							'scheme' => [
								'type' => Scheme_Color::get_type(),
								'value' => Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .menu > ul > li > .children > li > .children > li a' => 'background-color: {{VALUE}}'
							]
						]
					);
					// Current page color
					$this->add_control(
						'general_alt_color',
						[
							'label' => __( 'Font Color', 'bsa-elementor-widgets' ),
							'type' => Controls_Manager::COLOR,
							'scheme' => [
								'type' => Scheme_Color::get_type(),
								'value' => Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .menu > ul > li > .children > li > .children > li a' => 'color: {{VALUE}}'
							]
						]
					);
				$this->end_controls_tab();

				// Hover tab
				$this->start_controls_tab(
					'general_alt_hover_tab',
					[
						'label' => __( 'Hover', 'bsa-elementor-widgets' )
					]
				);
					// Current page BG
					$this->add_control(
						'general_alt_bg_hover',
						[
							'label' => __( 'Background Color', 'bsa-elementor-widgets' ),
							'type' => Controls_Manager::COLOR,
							'scheme' => [
								'type' => Scheme_Color::get_type(),
								'value' => Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .menu > ul > li > .children > li > .children > li a:hover' => 'background-color: {{VALUE}}'
							]
						]
					);
					// Current page color
					$this->add_control(
						'general_alt_color_hover',
						[
							'label' => __( 'Font Color', 'bsa-elementor-widgets' ),
							'type' => Controls_Manager::COLOR,
							'scheme' => [
								'type' => Scheme_Color::get_type(),
								'value' => Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .menu > ul > li > .children > li > .children > li a:hover' => 'color: {{VALUE}}'
							]
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'current_page_section',
			[
				'label' => __( 'Current Page', 'bsa-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			// Levels tabs
			$this->start_controls_tabs(
				'current_page_levels_tabs'
			);
				// Level 1 Tab
				$this->start_controls_tab(
					'current_page_levels_lvl1_tab',
					[
						'label' => __( 'Level 1', 'bsa-elementor-widgets' )
					]
				);
					// Current page BG
					$this->add_control(
						'current_page_lvl1_bg',
						[
							'label' => __( 'Background Color', 'bsa-elementor-widgets' ),
							'type' => Controls_Manager::COLOR,
							'scheme' => [
								'type' => Scheme_Color::get_type(),
								'value' => Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .menu > ul > .current_page_item' => 'background-color: {{VALUE}}'
							]
						]
					);
					// Current page color
					$this->add_control(
						'current_page_lvl1_color',
						[
							'label' => __( 'Font Color', 'bsa-elementor-widgets' ),
							'type' => Controls_Manager::COLOR,
							'scheme' => [
								'type' => Scheme_Color::get_type(),
								'value' => Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .menu > ul > .current_page_item > a' => 'color: {{VALUE}}'
							]
						]
					);
				$this->end_controls_tab();

				// Level 2 tab
				$this->start_controls_tab(
					'current_page_levels_lvl2_tab',
					[
						'label' => __( 'Level 2', 'bsa-elementor-widgets' )
					]
				);
					// Current page BG
					$this->add_control(
						'current_page_lvl2_bg',
						[
							'label' => __( 'Background Color', 'bsa-elementor-widgets' ),
							'type' => Controls_Manager::COLOR,
							'scheme' => [
								'type' => Scheme_Color::get_type(),
								'value' => Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .menu > ul > li > .children > .current_page_item > a' => 'background-color: {{VALUE}}'
							]
						]
					);
					// Current page color
					$this->add_control(
						'current_page_lvl2_color',
						[
							'label' => __( 'Font Color', 'bsa-elementor-widgets' ),
							'type' => Controls_Manager::COLOR,
							'scheme' => [
								'type' => Scheme_Color::get_type(),
								'value' => Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .menu > ul > li > .children > .current_page_item > a' => 'color: {{VALUE}}'
							]
						]
					);
				$this->end_controls_tab();

				// Level 3 tab
				$this->start_controls_tab(
					'current_page_levels_lvl3_tab',
					[
						'label' => __( 'Level 3', 'bsa-elementor-widgets' )
					]
				);
					// Current page BG
					$this->add_control(
						'current_page_lvl3_bg',
						[
							'label' => __( 'Background Color', 'bsa-elementor-widgets' ),
							'type' => Controls_Manager::COLOR,
							'scheme' => [
								'type' => Scheme_Color::get_type(),
								'value' => Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .menu > ul > li > .children > .page_item_has_children.current_page_item > a' => 'background-color: {{VALUE}}',
								'{{WRAPPER}} .menu > ul > li > .children > li > .children > .current_page_item > a' => 'background-color: {{VALUE}}'
							]
						]
					);
					// Current page color
					$this->add_control(
						'current_page_lvl3_color',
						[
							'label' => __( 'Font Color', 'bsa-elementor-widgets' ),
							'type' => Controls_Manager::COLOR,
							'scheme' => [
								'type' => Scheme_Color::get_type(),
								'value' => Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .menu > ul > li > .children > .page_item_has_children.current_page_item > a' => 'color: {{VALUE}}',
								'{{WRAPPER}} .menu > ul > li > .children > li > .children > .current_page_item > a' => 'color: {{VALUE}}'
							]
						]
					);
				$this->end_controls_tab();

			$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'current_page_parent_section',
			[
				'label' => __( 'Current Page Parent', 'bsa-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			// Levels tabs
			$this->start_controls_tabs(
				'current_page_parent_hover_tabs'
			);
				// Normal tab
				$this->start_controls_tab(
					'current_page_parent_normal_tab',
					[
						'label' => __( 'Normal', 'bsa-elementor-widgets' )
					]
				);
					// Current page parent BG
					$this->add_control(
						'current_page_parent_normal_bg',
						[
							'label' => __( 'Background Color', 'bsa-elementor-widgets' ),
							'type' => Controls_Manager::COLOR,
							'scheme' => [
								'type' => Scheme_Color::get_type(),
								'value' => Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .menu > ul > .current_page_root > a' => 'background-color: {{VALUE}}',
								'{{WRAPPER}} .menu > ul > .current_page_parent > a' => 'background-color: {{VALUE}}',
								'{{WRAPPER}} .menu > ul > li > .children .current_page_parent > a' => 'background-color: {{VALUE}}'
							]
						]
					);
					// Current page color
					$this->add_control(
						'current_page_parent_normal_color',
						[
							'label' => __( 'Font Color', 'bsa-elementor-widgets' ),
							'type' => Controls_Manager::COLOR,
							'scheme' => [
								'type' => Scheme_Color::get_type(),
								'value' => Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .menu > ul > .current_page_root > a' => 'color: {{VALUE}}',
								'{{WRAPPER}} .menu > ul > .current_page_parent > a' => 'color: {{VALUE}}',
								'{{WRAPPER}} .menu > ul > li > .children .current_page_parent > a' => 'color: {{VALUE}}'
							]
						]
					);
				$this->end_controls_tab();
				// Hover tab
				$this->start_controls_tab(
					'current_page_parent_hover_tab',
					[
						'label' => __( 'Hover', 'bsa-elementor-widgets' )
					]
				);
					// Current page parent BG
					$this->add_control(
						'current_page_parent_hover_bg',
						[
							'label' => __( 'Background Color', 'bsa-elementor-widgets' ),
							'type' => Controls_Manager::COLOR,
							'scheme' => [
								'type' => Scheme_Color::get_type(),
								'value' => Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .menu > ul > .current_page_root > a:hover' => 'background-color: {{VALUE}}',
								'{{WRAPPER}} .menu > ul > .current_page_parent > a:hover' => 'background-color: {{VALUE}}',
								'{{WRAPPER}} .menu > ul > li > .children .current_page_parent > a:hover' => 'background-color: {{VALUE}}'
							]
						]
					);
					// Current page color
					$this->add_control(
						'current_page_parent_hover_color',
						[
							'label' => __( 'Font Color', 'bsa-elementor-widgets' ),
							'type' => Controls_Manager::COLOR,
							'scheme' => [
								'type' => Scheme_Color::get_type(),
								'value' => Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .menu > ul > .current_page_root > a:hover' => 'color: {{VALUE}}',
								'{{WRAPPER}} .menu > ul > .current_page_parent > a:hover' => 'color: {{VALUE}}',
								'{{WRAPPER}} .menu > ul > li > .children .current_page_parent > a:hover' => 'color: {{VALUE}}'
							]
						]
					);
				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'active_elements_section',
			[
				'label' => __( 'Active Elements', 'bsa-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'active_element_border_radius',
				[
					'label' => __( 'Border Radius', 'plugin-domain' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .current_page_item > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .current_page_root > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .current_page_parent > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);

		$this->end_controls_section();

  }

  /**
   * Renders the widget frontend output
   *
   * Gets the widget icon that will be displayed on the frontend
   *
   * @return String
   **/
  protected function render() {
		if (\Elementor\Plugin::$instance->editor->is_edit_mode() || is_page()) {
			wp_enqueue_script('bsa-elementor-widgets-js');
			// Set hidden pages and all pages ids
			$this->setHiddenPagesIDs();
			$this->setAllPages();
			// Get current page ID
			$current_page_id = get_queried_object_id();
			$top_ancestor = $current_page_id;
			$above_page = 0;

			// Get page ancestors
			$ancestors = get_post_ancestors($top_ancestor);
			// If we have ancestors, grab the last ancestor as the top ancestor
			if (!empty($ancestors)) {
				$top_ancestor = end($ancestors);
				if (sizeof($ancestors) > 1) {
					$above_page = prev($ancestors);
				}
			}

			// Get current page children
			$current_page_children = $top_ancestor !== $current_page_id ? $this->get_childposts(get_queried_object_id()) : array();
			$above_page_children = $above_page !== 0 ? $this->get_childposts($above_page) : array();

			// Get top ancestor's childpages
			$child_pages = $this->get_childposts($top_ancestor);

			$pages = array_merge(array(get_post($top_ancestor)), $child_pages);
			?>
			<button type="button" class="btn btn-outline-dark mobile-pages-navigation-toggler">
				<?php echo get_the_title($current_page_id); ?>
				<i class="fa fa-caret-down"></i>
			</button>
			<div class="menu">
				<ul>
					<?php
					$current_page_children_ids = array();
					foreach($current_page_children as $current_page_child) {
						$current_page_children_ids[] = $current_page_child->ID;
					}
					$root_page_children_ids = array();
					foreach($child_pages as $child_page) {
						$root_page_children_ids[] = $child_page->ID;
					}
					$above_page_children_ids = array();
					foreach ($above_page_children as $above_page_child) {
						$above_page_children_ids[] = $above_page_child->ID;
					}

					$walker = new Walker_Pages_Navigation();
					$walker->setRootPage($top_ancestor);
					$walker->setRootPageChildren($root_page_children_ids);
					$walker->setAbovePageChildren($above_page_children_ids);
					$walker->setCurrentPageChildren($current_page_children_ids);
					$r = array(
						'walker' => $walker
					);
					echo walk_page_tree($pages, 0, $current_page_id, $r);
					?>
				</ul>
			</div>
			<?php
		}
	}

	/**
	 * Get the page ancestors
	 *
	 * Get the full page ancestors hierarchy from a page ID
	 *
	 * @param $post_id The post ID to search hierarchy from
	 * @return Array
	 **/
	public function get_childposts($parent_post_id = 0, $post_type = "page")
	{
		$post_ancestors = array();
		$post_ancestors = get_page_children($parent_post_id, $this->all_pages->posts);
		return $post_ancestors;
	}
}
?>
