<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Adds Foo_Widget widget.
 */
class BSAQuickLinks extends \WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'bsa_quicklinks', // Base ID
			esc_html__('BSA Quick Links', 'bsa-elementor-widgets'), // Name
			array('description' => esc_html__('A widget to create a quick links FAB on mobile and list on desktop', 'bsa-elementor-widgets')) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
    $links = !empty($instance['links']) ? $instance['links'] : array();
    if (!empty($links)) {
      echo $args['before_widget'];
      ?>
      <div class="dropdown d-none d-md-block">
        <button type="button" class="btn btn-militar dropdown-toggle text-capitalize" data-toggle="dropdown">
          <i class="fa fa-link" aria-hidden="true"></i> Quicklinks
        </button>
        <div class="dropdown-menu">
          <?php foreach ($links as $link) { ?>
          <a href="<?php esc_attr_e($link['url']); ?>" class="dropdown-item"><?php esc_attr_e($link['label']); ?></a>
          <?php } ?>
        </div>
      </div>
      <div>
      <div class="d-block d-md-none fab">
        <button data-target="#fab-menu" data-toggle="collapse" type="button" class="btn d-flex justify-content-center align-items-center">
          <i class="fa fa-paperclip"></i>
        </button>
        <div id="fab-menu" class="menu collapse">
          <?php foreach ($links as $link) { ?>
            <a href="<?php esc_attr_e($link['url']); ?>" class="dropdown-item"><?php esc_attr_e($link['label']); ?></a>
          <?php } ?>
        </div>
      </div>
      <?php
    }
    echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form($instance) {
    $links = !empty($instance['links']) ? $instance['links'] : array();
    if (!is_array($links)) {
      $links = array($links);
    }
    ?>
    <div id="bsa-quick-links-inputs">
      <?php
      $links_count = 0;
      foreach ($links as $link) {
      ?>
      <div class="link">
        <h5 style="margin-bottom: 0;">Link <a style="float: right;" data-remove-quick-links-input href="javascript:void(0);">Remove</a></h5>
        <label>Label</label>
        <input type="text" class="widefat" name="<?php echo esc_attr($this->get_field_name('links')); ?>[<?php echo $links_count; ?>][label]" value="<?php echo esc_attr($link['label']); ?>">
        <label>URL</label>
        <input type="text" class="widefat" name="<?php echo esc_attr($this->get_field_name('links')); ?>[<?php echo $links_count; ?>][url]" value="<?php echo esc_attr($link['url']); ?>">
      </div>
      <?php
      $links_count++;
      }
      ?>
    </div>
    <p>
      <button data-field-name="<?php echo esc_attr($this->get_field_name('links')); ?>" class="button button-primary" type="button" data-add-quick-links-input>Add Another Link</button>
    </p>
    <?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['links'] = (!empty($new_instance['links'])) ? $new_instance['links'] : array();
		return $instance;
	}

} // class BSAQuickLinks

// register BSAQuickLinks widget
function register_bsa_quicklinks() {
	register_widget('BSAQuickLinks');
}
add_action('widgets_init', 'register_bsa_quicklinks');

function bsa_quicklinks_scripts($hook) {
  if ($hook !== 'widgets.php') {
    return;
  }
  wp_enqueue_script('bsa-quick-links', plugins_url('bsa-quick-links.js', __FILE__), array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'bsa_quicklinks_scripts');
?>
