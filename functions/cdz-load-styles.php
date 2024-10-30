<?php

namespace cdzLovelyTestimonials;

/*
 *	cdzFunction: Load Styles
 */

if ( ! function_exists( 'cdz_load_styles' ) ) {

	function cdz_load_styles() {

		$plugindir = plugins_url() . '/' . dirname( plugin_basename( __FILE__ ) );

		if ( ! is_admin() ) {

			wp_enqueue_style( 'cdz_lovely_testimonials_style', $plugindir . '/../assets/css/style.css' );
			wp_enqueue_style( 'cdz_font_awesome', $plugindir . '/../addons/font-awesome/css/font-awesome.css', null, '4.0.3' );
			
		}

	}

}