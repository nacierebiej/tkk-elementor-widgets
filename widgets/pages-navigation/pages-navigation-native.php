<?php
/**
 * Adds Foo_Widget widget.
 */

 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WPPagesNavigation extends WP_Widget {
	private $all_pages = array();
	private $hidden_pages_ids = array();

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'bsa_pages_navigation', // Base ID
			esc_html__('BSA Pages Navigation', 'bsa-elementor-widgets'), // Name
			array('description' => esc_html__('A widget to create an aside navigation with the pages hierarchy on pages', 'bsa-elementor-widgets')) // Args
		);
		$this->setHiddenPagesIDs();
		$this->setAllPages();
	}

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
		$hidden_pages = new WP_Query($args);
		foreach ($hidden_pages->posts as $post) {
			$this->hidden_pages_ids[] = -$post->ID;
		}
		wp_reset_postdata();
	}

	public function setAllPages() {
		// Childposts
		$args = array(
      'post_type' => 'page',
			'posts_per_page' => '-1',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'post__not_in' => $this->hidden_pages_ids
		);
		$this->all_pages = new WP_Query($args);
		wp_reset_postdata();
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
		if (\Elementor\Plugin::$instance->editor->is_edit_mode() || is_page()) {
			wp_enqueue_script('bsa-elementor-widgets-js');
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

			//$walker_page = new Walker_Page();
			echo $args['before_widget'];
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

					$walker = new BSAElementorWidgets\Walkers\Walker_Pages_Navigation();
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
			echo $args['after_widget'];
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
		$title = !empty($instance['title']) ? $instance['title'] : esc_html__('New title', 'bsa-elementor-widgets');
		?>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'bsa-elementor-widgets'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
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
		$instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';

		return $instance;
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

} // class WPPagesNavigation

// register WPPagesNavigation widget
function register_wp_pages_navigation() {
	register_widget('WPPagesNavigation');
}
add_action('widgets_init', 'register_wp_pages_navigation');

require_once('class-walker-pages-navigation.php');
?>
