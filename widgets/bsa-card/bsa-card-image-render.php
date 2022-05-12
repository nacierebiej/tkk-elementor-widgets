<?php
use Elementor\Group_Control_Image_Size;


$settings = $this->get_settings_for_display();

if ( empty( $settings['image']['url'] ) ) {
	return;
}

$has_caption = $this->has_caption( $settings );

$this->add_render_attribute( 'wrapper', 'class', 'elementor-image' );

if ( ! empty( $settings['shape'] ) ) {
	$this->add_render_attribute( 'wrapper', 'class', 'elementor-image-shape-' . $settings['shape'] );
}

$link = $this->get_link_url( $settings );

if ( $link ) {
	$this->add_render_attribute( 'link', [
		'href' => $link['url'],
		'data-elementor-open-lightbox' => $settings['open_lightbox'],
	] );

	if ( Plugin::$instance->editor->is_edit_mode() ) {
		$this->add_render_attribute( 'link', [
			'class' => 'elementor-clickable',
		] );
	}

	if ( ! empty( $link['is_external'] ) ) {
		$this->add_render_attribute( 'link', 'target', '_blank' );
	}

	if ( ! empty( $link['nofollow'] ) ) {
		$this->add_render_attribute( 'link', 'rel', 'nofollow' );
	}
} ?>
<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
	<?php if ( $has_caption ) : ?>
		<figure class="wp-caption">
	<?php endif; ?>
	<?php if ( $link ) : ?>
			<a <?php echo $this->get_render_attribute_string( 'link' ); ?>>
	<?php endif; ?>
		<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings ); ?>
	<?php if ( $link ) : ?>
			</a>
	<?php endif; ?>
	<?php if ( $has_caption ) : ?>
			<figcaption class="widget-image-caption wp-caption-text"><?php echo $this->get_caption( $settings ); ?></figcaption>
	<?php endif; ?>
	<?php if ( $has_caption ) : ?>
		</figure>
	<?php endif; ?>
</div>