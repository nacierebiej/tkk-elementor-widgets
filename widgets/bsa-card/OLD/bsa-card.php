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
    
    //INPUT CONTROL
		include('bsa-card-control-title.php');

  }

  /**
   * Renders the widget frontend output
   *
   * Gets the widget icon that will be displayed on the frontend
   *
   * @return String
   **/
  protected function render() {
    
    //RENDER INPUT
    include('bsa-card-render-title.php');

  }
}
?>