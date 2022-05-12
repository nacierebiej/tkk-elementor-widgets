<?php
$editor_content = $this->get_settings_for_display( 'editor' );

$editor_content = $this->parse_text_editor( $editor_content );

$this->add_render_attribute( 'editor', 'class', [ 'elementor-text-editor', 'elementor-clearfix' ] );

$this->add_inline_editing_attributes( 'editor', 'advanced' );
?>
<div <?php echo $this->get_render_attribute_string( 'editor' ); ?>><?php echo $editor_content; ?></div>