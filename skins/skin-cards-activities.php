<?php
namespace BSAElementorWidgets\Skins;

use Elementor\Group_Control_Image_Size;

if (!defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if (\class_exists('\ElementorPro\Modules\Posts\Skins\Skin_Cards')) {
	class Skin_Activities extends \ElementorPro\Modules\Posts\Skins\Skin_Cards {
		public function get_id() {
			return 'activities';
		}

		public function get_title() {
			return __( 'Activities', 'elementor-pro' );
		}

		protected function render_title() {
			if ( ! $this->get_instance_value( 'show_title' ) ) {
				return;
			}
			$link = get_post_meta(get_the_ID(), 'event_url', true);
			$tag = $this->get_instance_value( 'title_tag' );
			?>
			<<?php echo $tag; ?> class="elementor-post__title">
				<a target="_blank" href="<?php echo $link !== "" ? $link : "javascript:void(0);"; ?>">
					<?php the_title(); ?>
				</a>
			</<?php echo $tag; ?>>
			<?php
		}

		protected function render_thumbnail() {
			$thumbnail = $this->get_instance_value( 'thumbnail' );

			if ( 'none' === $thumbnail && ! Plugin::elementor()->editor->is_edit_mode() ) {
				return;
			}

			$settings = $this->parent->get_settings();
			$setting_key = $this->get_control_id( 'thumbnail_size' );
			$settings[ $setting_key ] = [
				'id' => get_post_thumbnail_id(),
			];

			// $thumbnail_html = Group_Control_Image_Size::get_attachment_image_html( $settings, $setting_key );
			// if ( empty( $thumbnail_html ) ) {
			// 	return;
			// }
			$thumbnail_id = get_post_thumbnail_id();
			if ($thumbnail_id !== '') {
				$thumbnail = Group_Control_Image_Size::get_attachment_image_src($thumbnail_id, $setting_key, $settings);
			}
			else {
				$thumbnail = ELEMENTOR_ASSETS_URL . 'images/placeholder.png';
			}

			$link = get_post_meta(get_the_ID(), 'event_url', true);
			?>
			<div style="height: 280px; width: 100%; background:url(<?php echo $thumbnail; ?>); background-size: cover; background-position: center; background-repeat: no-repeat;"></div>
			<?php
			/*
			<a class="elementor-post__thumbnail__link" href="<?php echo $link !== "" ? $link : "" ?>">
				<div class="elementor-post__thumbnail"><?php echo $thumbnail_html; ?></div>
			</a>
			*/ ?>
			<?php
		}
	}
}


?>
