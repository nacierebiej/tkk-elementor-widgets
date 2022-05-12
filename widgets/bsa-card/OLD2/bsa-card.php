<?php
namespace BSAElementorWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class BSACard extends Widget_Base {
  /**
   * Gets the Widget name
   *
   * Gets the widget name that is going to be used on code
   *
   * @return String
   **/
  public function get_name() {
    return 'bsaCard';
  }

  /**
   * Gets the Widget title
   *
   * Gets the widget title that will be displayed on the frontend
   *
   * @return String
   **/
  public function get_title() {
    return __('BSA Card', 'bsa-elementor-widgets');
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
	
	//Title
	include_once('bsa-card-title-register-control.php');
	include_once('bsa-card-image-register-control.php');
	include_once('bsa-card-description-register-control.php');
	
  }









						//Dependencies for Image Widget
						/**
						 * Check if the current widget has caption
						 *
						 * @access private
						 * @since 2.3.0
						 *
						 * @param array $settings
						 *
						 * @return boolean
						 */
						private function has_caption( $settings ) {
							return ( ! empty( $settings['caption_source'] ) && 'none' !== $settings['caption_source'] );
						}

						/**
						 * Retrieve image widget link URL.
						 *
						 * @since 1.0.0
						 * @access private
						 *
						 * @param array $settings
						 *
						 * @return array|string|false An array/string containing the link URL, or false if no link.
						 */
						private function get_link_url( $settings ) {
							if ( 'none' === $settings['link_to'] ) {
								return false;
							}

							if ( 'custom' === $settings['link_to'] ) {
								if ( empty( $settings['link']['url'] ) ) {
									return false;
								}
								return $settings['link'];
							}

							return [
								'url' => $settings['image']['url'],
							];
						}
						//End Dependencies for Image Widget






  /**
   * Renders the widget frontend output
   *
   * Gets the widget icon that will be displayed on the frontend
   *
   * @return String
   **/
  protected function render() {

	//Title
	include_once('bsa-card-title-render.php');
	include_once('bsa-card-image-render.php');
	include_once('bsa-card-description-render.php');

  }
}
?>