<?php
/**
 * Adds Elementor_Child_Pages_Widget widget.
 */
class Elementor_Child_Pages_Widget extends \WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'elementor_child_pages_widget', // Base ID
			esc_html__('Elementor Child Pages Widget', 'elementor-child-pages'), // Name
			array(
				'description' => esc_html__('A widget for elementor or to use within a widget area to display a grid of the child pages of a parent page', 'elementor-child-pages')
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
    if (\Elementor\Plugin::$instance->editor->is_edit_mode() || is_page()) {
      $page_id = get_queried_object_id();
      $args = array(
        'post_type' => 'page',
        'post_parent' => $page_id,
				'posts_per_page' => -1,
				'orderby' => 'title',
				'order' => 'ASC'
      );
      $child_pages = new WP_Query($args);
      if ($child_pages->have_posts()) {
        ?>
        <div class="row">
        <?php
        while ($child_pages->have_posts()) {
          $child_pages->the_post();
          ?>
          <div <?php post_class('col-sm-12 col-md-4'); ?>>
            <a class="card child-pages-block" href="<?php echo get_the_permalink(); ?>">
              <?php
              $post_thumbnail_url = get_the_post_thumbnail_url(get_the_ID());
              if($post_thumbnail_url !== false) {
              ?>
              <img class="card-img-top" src="<?php echo $post_thumbnail_url; ?>" />
              <?php } ?>
              <div class="card-body">
                <h5 class="card-title">
                  <?php echo get_the_title(); ?>
                </h5>
								<?php /*
                <time datetime="<?php echo get_the_modified_date('Y\-m\-d', get_the_ID()); ?>">
                  Last updated: <?php echo get_the_modified_date('m \/ d \/ Y', get_the_ID()); ?>
								</time>
								*/ ?>
							</div>
            </a>
          </div>
          <?php
        }
        ?>
        </div>
        <?php
        wp_reset_postdata();
      }
      else {
        echo "There are no child pages for this page";
      }
      ?>
    <?php
    }
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form($instance) {

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
    return $instance;
	}

} // class Elementor_Child_Pages_Widget
// register Elementor_Child_Pages_Widget widget
function register_elementor_child_pages_widget() {
  register_widget('Elementor_Child_Pages_Widget');
}
add_action('widgets_init', 'register_elementor_child_pages_widget');
?>
