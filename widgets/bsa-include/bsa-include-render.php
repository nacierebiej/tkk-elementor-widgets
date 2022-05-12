<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$settings = $this->get_settings_for_display();

if ( empty( $settings['title'] ) ) {
	return;
}

$title = $settings['title'];

$filePath = get_template_directory().'/'.$title;

if( file_exists($filePath) ){
	include($filePath);
}else{
	$filePathShort = explode("wp-content", $filePath);
	echo "<strong>(404) File not found:</strong><br>"."/wp-content".$filePathShort[1];
}
?>
