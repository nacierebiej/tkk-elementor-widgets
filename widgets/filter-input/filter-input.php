<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Adds Elementor_Filter_Input_Widget widget.
 */
class Elementor_Filter_Input_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'elementor_filter_input_widget', // Base ID
			esc_html__('Elementor Filter Input', 'elementor-filter-input'), // Name
			array(
				'description' => esc_html__('A jQuery filter for contents input widget for elementor or to use within a widget area', 'elementor-filter-input')
			) // Args
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
	public function widget($args, $instance) {
		$searchScopeID = !empty($instance['searchScopeID']) ? $instance['searchScopeID'] : '';
		$itemTag = !empty($instance['itemTag']) ? $instance['itemTag'] : '';
		$inputPlaceholder = !empty($instance['inputPlaceholder']) ? $instance['inputPlaceholder'] : 'Search';
		echo $args['before_widget'];
		if ($searchScopeID !== '' && $itemTag !== '') {
			?>
			<input placeholder="<?php echo $inputPlaceholder ?>" id="elementorFilterInputWidgetInput" class="form-control" type="search">
			<?php
			wp_enqueue_script('elementor-filter-input-scripts');
			wp_localize_script('elementor-filter-input-scripts', 'jetsSearchAjax', array(
				'searchScopeID' => $searchScopeID,
				'itemTag' => $itemTag
			));
		}
		else {
			echo "Please provide a search scope and an item tag.";
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
		$searchScopeID = !empty($instance['searchScopeID']) ? $instance['searchScopeID'] : '';
		$itemTag = !empty($instance['itemTag']) ? $instance['itemTag'] : '';
		$inputPlaceholder = !empty($instance['inputPlaceholder']) ? $instance['inputPlaceholder'] : 'Search';
		?>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('searchScopeID')); ?>"><?php esc_attr_e('Search Scope ID:', 'elementor-filter-input'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('searchScopeID')); ?>" name="<?php echo esc_attr($this->get_field_name('searchScopeID')); ?>" type="text" value="<?php echo esc_attr($searchScopeID); ?>">
		</p>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('itemTag')); ?>"><?php esc_attr_e('Item Tag:', 'elementor-filter-input'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('itemTag')); ?>" name="<?php echo esc_attr($this->get_field_name('itemTag')); ?>" type="text" value="<?php echo esc_attr($itemTag); ?>">
		</p>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('inputPlaceholder')); ?>"><?php esc_attr_e('Placeholder for input:', 'elementor-filter-input'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('inputPlaceholder')); ?>" name="<?php echo esc_attr($this->get_field_name('inputPlaceholder')); ?>" type="text" value="<?php echo esc_attr($inputPlaceholder); ?>">
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

		$instance['searchScopeID'] = (!empty($new_instance['searchScopeID'])) ? sanitize_text_field($new_instance['searchScopeID']) : '';
		$instance['itemTag'] = (!empty($new_instance['itemTag'])) ? sanitize_text_field($new_instance['itemTag']) : '';
		$instance['inputPlaceholder'] = (!empty($new_instance['inputPlaceholder'])) ? sanitize_text_field($new_instance['inputPlaceholder']) : '';
		return $instance;
	}

} // class Elementor_Filter_Input_Widget
// register Elementor_Filter_Input_Widget widget
function register_elementor_filter_input_widget() {
  register_widget('Elementor_Filter_Input_Widget');
}
add_action('widgets_init', 'register_elementor_filter_input_widget');

function elementor_filter_input_scripts_styles() {
  // Register elementor jets search script to enqueue if the widget is used
  wp_register_script('elementor-filter-input-scripts', plugins_url('js/main.js', __FILE__), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'elementor_filter_input_scripts_styles');
?>
