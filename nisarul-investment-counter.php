<?php
/*
Plugin Name: Investment Counter by Nisarul
Plugin URI: https://nisarul.com/
Description: Use shortcode [nisarul_investment_counter_string starting-at="1045200000" initial-time="1673382993"] to generate Comma separated number,  and [nisarul_investment_counter_time starting-at='1045200000' initial-time='1673382993'] to generate non-comma separated number.
Author: Nisarul Amin Naim
Author URI: https://www.fiverr.com/nisarul/
Text Domain:nisarul-investment-counter
Version: 1.0
*/

/**
 * Generates Comma separated string
 * @param array $atts
 * @param string $content
 * @return string
 */
function investment_counter_string( $atts, $content ) {
	$atts = shortcode_atts( [
		'initial-time'     => '1673382993',
        'starting-at' => '1045200000'
	] , $atts );

	$left_time = time() - (int) $atts['initial-time'];
	$return_time = (int) $atts['starting-at'] + $left_time;
	$return_string = number_format( $return_time, 0, '.', ',' );
	return $return_string;
}
add_shortcode( 'nisarul_investment_counter_string', 'investment_counter_string' );

/**
 * Generates integer number
 * @param array $atts
 * @param string $content
 * @return int
 */
function investment_counter_time($atts, $content) {
	$atts = shortcode_atts( [
		'initial-time' => '1673382993',
		'starting-at' => '1045200000'
	], $atts );

	$left_time = time() - (int) $atts['initial-time'];
	$return_time = (int) $atts['starting-at'] + $left_time;
	 return $return_time;
}
add_shortcode( 'nisarul_investment_counter_time', 'investment_counter_time' );
