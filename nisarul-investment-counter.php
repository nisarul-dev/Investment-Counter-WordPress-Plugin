<?php
/*
Plugin Name: Investment Counter by Nisarul
Plugin URI: https://github.com/nisarul-media/Investment-Counter-WordPress-Plugin
Description: Use shortcode [nisarul_investment_counter_string starting_time='2023-01-11 00:00:00' starting_money='1045200000' increasing_rate='1'] to generate Comma separated number,  and [nisarul_investment_counter_time starting_time='2023-01-11 00:00:00' starting_money='1045200000' increasing_rate='1'] to generate non-comma separated number.
Author: Nisarul Amin Naim
Author URI: https://www.fiverr.com/nisarul/
Text Domain:nisarul-investment-counter
Version: 2.0
*/

/**
 * Summary of investment_counter_fnc
 * @param mixed $starting_time
 * @param mixed $starting_money
 * @param mixed $increasing_rate
 * @return mixed
 */
function investment_counter_fnc( $starting_time, $starting_money, $increasing_rate ) {
	$time_in_sec = 0;

	$starting_time_obj = new DateTime( $starting_time );
	$current_time_obj = new DateTime();

	$diff_time_obj = $starting_time_obj->diff( $current_time_obj );

	if ( $diff_time_obj->invert ) {
		return (int) $starting_money;
	} else {
		if ( $diff_time_obj->days != 0 )
			$time_in_sec = $diff_time_obj->days * 24 * 60 * 60;
		if ( $diff_time_obj->h != 0 )
			$time_in_sec += $diff_time_obj->h * 60 * 60;
		if ( $diff_time_obj->i != 0 )
			$time_in_sec += $diff_time_obj->i * 60;
		if ( $diff_time_obj->s != 0 )
			$time_in_sec += $diff_time_obj->s;
	}

	return (int) ( $starting_money + ( $increasing_rate * $time_in_sec ) );
}

/**
 * Generates Comma separated string
 * @param array $atts
 * @param string $content
 * @return string
 */
function investment_counter_string( $atts, $content ) {
	$atts = shortcode_atts( [
		'starting_time'   => '2023-01-11 00:00:00',
		'starting_money'  => '1045200000',
		'increasing_rate' => '1',
	] , $atts );
	extract( $atts );

	return number_format(
		investment_counter_fnc(
			$starting_time,
			$starting_money,
			$increasing_rate
		),
		0,
		'.',
		',',
	);
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
		'starting_time' => '2023-01-11 00:00:00',
		'starting_money' => '1045200000',
		'increasing_rate' => '1',
	], $atts );
	extract( $atts );

	return investment_counter_fnc( $starting_time, $starting_money, $increasing_rate );
}
add_shortcode( 'nisarul_investment_counter_time', 'investment_counter_time' );
