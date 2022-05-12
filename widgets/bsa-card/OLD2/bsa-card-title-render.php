<?php
    // Get settings
    $settings = $this->get_settings_for_display();
    //
	//$card_title = $settings['card_title'] !== '' ? $settings['card_title'] : 'default text';  
	
	if ( empty( $settings['card_title'] ) ) {
		return;
	}

	$this->add_render_attribute( 'card_title', 'class', 'elementor-heading-title' );

	if ( ! empty( $settings['size'] ) ) {
		$this->add_render_attribute( 'card_title', 'class', 'elementor-size-' . $settings['size'] );
	}

	$this->add_inline_editing_attributes( 'card_title' );

	$title = $settings['card_title'];

	if ( ! empty( $settings['link']['url'] ) ) {
		$this->add_render_attribute( 'url', 'href', $settings['link']['url'] );

		if ( $settings['link']['is_external'] ) {
			$this->add_render_attribute( 'url', 'target', '_blank' );
		}

		if ( ! empty( $settings['link']['nofollow'] ) ) {
			$this->add_render_attribute( 'url', 'rel', 'nofollow' );
		}

		$title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $title );
	}

	$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string( 'card_title' ), $title );

	echo $title_html;