<?php
/*
 * Plugin Name:       Tiny Slider
 * Plugin URI:        https://woocopilot.com/plugins/woo-custom-price/
 * Description:       Description Tiny Slider ....
 * Version:           1.0.0
 * Requires at least: 6.5
 * Requires PHP:      7.2
 * Author:            WooCopilot
 * Author URI:        https://woocopilot.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       tiny-slider
 * Domain Path:       /languages
 */

function tinys_load_textdomain() {
	load_plugin_textdomain('tinyslider', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action('plugin_loaded', 'tinys_load_textdomain');

function tinys_assets() {
	wp_enqueue_style('tinyslider-css','//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css',null,'1.0');
	wp_enqueue_script('tinyslider-js','//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js',null,'1.0',true);
	wp_enqueue_script('tinyslider-main-js',plugin_dir_url( __FILE__ ) . '/assets/js/tinyslider.js',array('jquery'),'1.0',true);
}

add_action('wp_enqueue_scripts', 'tinys_assets');

function tinys_init() {
	add_image_size('tiny-slider',800,600,true);
}
add_action('init', 'tinys_init');

function tinys_shortcode_tslider($arguments,$content) {
	$defaults = array(
		'width' => '800',
		'height' => '600',
		'id'=>''
	);
	$attributes = shortcode_atts($defaults, $arguments);
	$content = do_shortcode($content);

	$shortcode_output = <<<EOD
	<div style="width: {$attributes['width']};height: {$attributes['height']};">
		<div class="slider">
			 {$content}
		</div>
	</div>

EOD;
	return $shortcode_output;

}
add_action('tslider', 'tinys_shortcode_tslider');

function tinys_shortcode_tslide($arguments) {

}
add_action('tslide', 'tinys_shortcode_tslide');