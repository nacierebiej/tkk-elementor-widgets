<?php
namespace BSAElementorWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class BSAPhpExternalFileClass extends Widget_Base {
  /**
   * Gets the Widget name
   *
   * Gets the widget name that is going to be used on code
   *
   * @return String
   **/
  public function get_name() {
    return 'bsaIncluder';
  }

  /**
   * Gets the Widget title
   *
   * Gets the widget title that will be displayed on the frontend
   *
   * @return String
   **/
  public function get_title() {
    return __('BSA PHP External File', 'bsa-elementor-widgets');
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
	include('bsa-include-register-controls.php');
	//include('bsa-card-image-register-controls.php');
	//include('bsa-card-description-register-controls.php');

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
	//Aqui se da salida al diseño que carga elementor en el editor al soltar el widget
	//echo '<div style="background: #ffffff; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.3); border-radius: 4px;">';
	//	echo '<div style="padding: 20px;">';
	//		include('bsa-card-title-render.php');
	//	echo '</div>';
	//	
	//	include('bsa-card-image-render.php');
	//	
	//	echo '<div style="padding: 20px;">';
	//		include('bsa-card-description-render.php');
	//	echo '</div>';
	//echo '</div>';
	include('bsa-include-render.php');

  }

}
?>