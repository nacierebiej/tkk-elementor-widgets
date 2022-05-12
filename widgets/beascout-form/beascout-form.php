<?php
if (!defined('ABSPATH'))
{ exit; }
class Scouting_BeAScoutForm_Widget extends WP_Widget {

  /**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'scouting_beascoutform_widget', // Base ID
			esc_html__('BeAScout Form', 'bsa-child'), // Name
			array(
        'description' => esc_html__('A widget to insert a form to take users from scouting.org to beascout.scouting.org and show results', 'bsa-child')
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
	public function widget( $args, $instance ) {
    // Widget
    $beascout_form_action = (!empty($instance['beascout_form_action'])) ? $instance['beascout_form_action'] : 'https://beascout.scouting.org/list/';
    $beascout_form_input_program = (!empty($instance['beascout_form_input_program'])) ? $instance['beascout_form_input_program'] : 'pack';
    $beascout_form_input_placeholder = (!empty($instance['beascout_form_input_placeholder'])) ? $instance['beascout_form_input_placeholder'] : 'ZIP Code';
    $beascout_form_button_label = (!empty($instance['beascout_form_button_label'])) ? $instance['beascout_form_button_label'] : 'Find Scouting Near You';

    $beascout_form_utm_source = (!empty($instance['utm_source'])) ? $instance['utm_source'] : '';
    $beascout_form_utm_medium = (!empty($instance['utm_medium'])) ? $instance['utm_medium'] : '';
    $beascout_form_utm_campaign = (!empty($instance['utm_campaign'])) ? $instance['utm_campaign'] : '';
    $beascout_form_align = (!empty($instance['beascout_form_align']) ? $instance['beascout_form_align'] : 'bsa-form-custom-center');

    echo $args['before_widget'];
    ?>
<form action="<?php echo $beascout_form_action; ?>" class="scouting_beascout_form">
  <div class="bsa-form-custom <?php echo $beascout_form_align; ?> ">
    <input name="zip" type="text" placeholder="<?php echo $beascout_form_input_placeholder; ?>"
      class="bsa-form-custom__item zipcode"><button type="submit"
      class="bsa-form-custom__item"><?php echo $beascout_form_button_label; ?></button>
  </div>
  <input name="program[]" type="hidden" value="<?php echo $beascout_form_input_program; ?>">
  <input name="utm_source" type="hidden" value="<?php echo $beascout_form_utm_source; ?>">
  <input name="utm_medium" type="hidden" value="<?php echo $beascout_form_utm_medium; ?>">
  <input name="utm_campaign" type="hidden" value="<?php echo $beascout_form_utm_campaign; ?>">
</form>
<?php
    echo $args['after_widget'];
	}

  /**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
    $beascout_form_action = !empty($instance['beascout_form_action']) ? $instance['beascout_form_action'] : esc_html__('https://beascout.scouting.org/list/', 'bsa-child');
    $beascout_form_input_program = !empty($instance['beascout_form_input_program']) ? $instance['beascout_form_input_program'] : esc_html__('pack', 'bsa-child');
    $beascout_form_input_placeholder = !empty($instance['beascout_form_input_placeholder']) ? $instance['beascout_form_input_placeholder'] : esc_html__('ZIP Code', 'bsa-child');
    $beascout_form_button_label = !empty($instance['beascout_form_button_label']) ? $instance['beascout_form_button_label'] : esc_html__('Find Scouting Units Near You', 'bsa-child');

    $beascout_form_utm_source = !empty($instance['utm_source']) ? $instance['utm_source'] : '';
    $beascout_form_utm_medium = !empty($instance['utm_medium']) ? $instance['utm_medium'] : '';
    $beascout_form_utm_campaign = !empty($instance['utm_campaign']) ? $instance['utm_campaign'] : '';

    $beascout_form_align_component = (!empty($instance['beascout_form_align']) ? : 'bsa-form-custom-center');
    ?>
<p>
  <label
    for="<?php echo esc_attr($this->get_field_id('beascout_form_action')); ?>"><?php esc_attr_e('Form Action:', 'bsa-child'); ?></label>
  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('beascout_form_action')); ?>"
    name="<?php echo esc_attr($this->get_field_name('beascout_form_action')); ?>" type="text"
    value="<?php echo esc_attr($beascout_form_action); ?>">
</p>
<p>
  <label
    for="<?php echo esc_attr($this->get_field_id('beascout_form_input_program')); ?>"><?php esc_attr_e('Program (pack, scoutsBSA, crew or ship):', 'bsa-child'); ?></label>
  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('beascout_form_input_program')); ?>"
    name="<?php echo esc_attr($this->get_field_name('beascout_form_input_program')); ?>" type="text"
    value="<?php echo esc_attr($beascout_form_input_program); ?>">
</p>
<p>
  <label
    for="<?php echo esc_attr($this->get_field_id('beascout_form_input_placeholder')); ?>"><?php esc_attr_e('Form Input Placeholder:', 'bsa-child'); ?></label>
  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('beascout_form_input_placeholder')); ?>"
    name="<?php echo esc_attr($this->get_field_name('beascout_form_input_placeholder')); ?>" type="text"
    value="<?php echo esc_attr($beascout_form_input_placeholder); ?>">
</p>
<p>
  <label
    for="<?php echo esc_attr($this->get_field_id('beascout_form_button_label')); ?>"><?php esc_attr_e('Form Button Label:', 'bsa-child'); ?></label>
  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('beascout_form_button_label')); ?>"
    name="<?php echo esc_attr($this->get_field_name('beascout_form_button_label')); ?>" type="text"
    value="<?php echo esc_attr($beascout_form_button_label); ?>">
</p>
<p>
  <label
    for="<?php echo esc_attr($this->get_field_id('utm_source')); ?>"><?php esc_attr_e('UTM Source:', 'bsa-child'); ?></label>
  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('utm_source')); ?>"
    name="<?php echo esc_attr($this->get_field_name('utm_source')); ?>" type="text"
    value="<?php echo esc_attr($beascout_form_utm_source); ?>">
</p>
<p>
  <label
    for="<?php echo esc_attr($this->get_field_id('utm_medium')); ?>"><?php esc_attr_e('UTM Medium:', 'bsa-child'); ?></label>
  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('utm_medium')); ?>"
    name="<?php echo esc_attr($this->get_field_name('utm_medium')); ?>" type="text"
    value="<?php echo esc_attr($beascout_form_utm_medium); ?>">
</p>
<p>
  <label
    for="<?php echo esc_attr($this->get_field_id('utm_campaign')); ?>"><?php esc_attr_e('UTM Campaign:', 'bsa-child'); ?></label>
  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('utm_campaign')); ?>"
    name="<?php echo esc_attr($this->get_field_name('utm_campaign')); ?>" type="text"
    value="<?php echo esc_attr($beascout_form_utm_campaign); ?>">
</p>

<p>
  <label for="">Align</label>
  <select name="<?php echo esc_attr($this->get_field_name('beascout_form_align')); ?>"
    id="<?php echo esc_attr($this->get_field_id('beascout_form_align')); ?>" class="widefat">
    <option value="bsa-form-custom-center" <?php selected( $beascout_form_utm_campaign, 'center' ); ?> >Center</option>
    <option value="bsa-form-custom-left" <?php selected( $beascout_form_utm_campaign, 'left' ); ?> >Left</option>
    <option value="bsa-form-custom-right" <?php selected( $beascout_form_utm_campaign, 'right' ); ?> >Right</option>
  </select>
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
	public function update( $new_instance, $old_instance ) {
    /*
    $instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

    return $instance;
    */
    $instance = array();

    $instance['beascout_form_action'] = (!empty($new_instance['beascout_form_action'])) ? sanitize_text_field($new_instance['beascout_form_action']) : '';
    $instance['beascout_form_input_program'] = (!empty($new_instance['beascout_form_input_program'])) ? sanitize_text_field($new_instance['beascout_form_input_program']) : '';
    $instance['beascout_form_input_placeholder'] = (!empty($new_instance['beascout_form_input_placeholder'])) ? sanitize_text_field($new_instance['beascout_form_input_placeholder']) : '';
    $instance['beascout_form_button_label'] = (!empty($new_instance['beascout_form_button_label'])) ? sanitize_text_field($new_instance['beascout_form_button_label']) : '';

    $instance['utm_source'] = (!empty($new_instance['utm_source'])) ? sanitize_text_field($new_instance['utm_source']) : '';
    $instance['utm_medium'] = (!empty($new_instance['utm_medium'])) ? sanitize_text_field($new_instance['utm_medium']) : '';
    $instance['utm_campaign'] = (!empty($new_instance['utm_campaign'])) ? sanitize_text_field($new_instance['utm_campaign']) : '';

    $instance['beascout_form_align'] = (!empty($new_instance['beascout_form_align'])) ? sanitize_text_field( $new_instance['beascout_form_align'] ) : '';

    return $instance;
	}
} // class Scouting_BeAScoutForm_Widget
// Register widget
function register_scouting_beascoutform_widget() {
  register_widget('Scouting_BeAScoutForm_Widget');
}
add_action('widgets_init', 'register_scouting_beascoutform_widget');

// Register widget scripts and styles
function register_scouting_beascoutform_scripts_styles() {
  // Register Style
  wp_register_style('scouting_beascoutform_styles', plugins_url('css/style.css', __FILE__));
  // Register Script
  wp_register_script('scouting_beascoutform_scripts', plugins_url('js/main.js', __FILE__), array('jquery'), null, true);
  // Add script and style
  wp_enqueue_style('scouting_beascoutform_styles');
  wp_enqueue_script('scouting_beascoutform_scripts');
}
add_action('wp_enqueue_scripts', 'register_scouting_beascoutform_scripts_styles');
?>
