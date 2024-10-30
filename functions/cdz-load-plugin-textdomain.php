<?php

namespace cdzLovelyTestimonials;

/*
 *	cdzFunction: Load Plugin Textdomain
 */

if ( ! function_exists( 'cdz_load_plugin_textdomain' ) ) {

	function cdz_load_plugin_textdomain() {

		load_plugin_textdomain( 'cdz', false, dirname( plugin_basename( __FILE__ ) ) . '/../languages/' );

	}

}