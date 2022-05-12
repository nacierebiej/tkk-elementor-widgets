<?php
namespace BSAElementorWidgets;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class BSAElementorWidgetsPlugin {
	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;
	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_register_script( 'bsa-elementor-widgets-js', plugins_url( '/assets/js/bsa-elementor-widgets.min.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_enqueue_style('bsa-elementor-widgets', plugins_url('/assets/css/style.min.css', __FILE__));
	}
	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {
		// Include elementor-derived widgets
		require_once(__DIR__ . '/widgets/pages-navigation/pages-navigation.php');
		require_once(__DIR__ . '/widgets/bsa-include/bsa-include.php');
		require_once(__DIR__ . '/widgets/bsa-card/bsa-card.php');
		require_once(__DIR__ . '/skins/skin-cards-activities.php');
	}
	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();
    // Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\BSAPagesNavigation() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\BSAPhpExternalFileClass() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\BSACard() );
	}
	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {
		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );
		// Register widgets
    add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
    // Register widgets categories
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );

		// Register custom skin for posts
		add_action( 'elementor/widget/posts/skins_init', [$this, 'register_skin_for_posts_widget'] );
	}

	public function register_skin_for_posts_widget($widget) {
		$widget->add_skin(new Skins\Skin_Activities($widget));
	}

  public function add_elementor_widget_categories( $elements_manager ) {
    $elements_manager->add_category(
      'bsa-widgets',
      [
        'title' => __( 'BSA Widgets', 'bsa-elementor-widgets' ),
        'icon' => 'fa fa-plug',
      ]
    );
  }
}
// Instantiate Plugin Class
BSAElementorWidgetsPlugin::instance();

// Include native widgets
require_once(__DIR__ . '/widgets/filter-input/filter-input.php');
require_once(__DIR__ . '/widgets/pages-navigation/pages-navigation-native.php');
require_once(__DIR__ . '/widgets/beascout-form/beascout-form.php');
require_once(__DIR__ . '/widgets/quick-links/quick-links.php');
require_once(__DIR__ . '/widgets/child-pages/child-pages.php');
?>
