<?php

namespace cdzLovelyTestimonials;

/*
 *	cdzFunction: Get Template
 */

if ( ! function_exists( 'cdz_get_template' ) ) {

	function cdz_get_template( $template, $pluginslug, $filename ) {

		$plugindir = dirname( __FILE__ ) . '/..';
		$themedir = get_template_directory();

		if ( file_exists( $themedir . '/' . $pluginslug . '/' . $filename ) ) {

			$template = $themedir . '/' . $pluginslug . '/' . $filename;

		} else if ( file_exists( $themedir . '/cdz-theme/templates/plugins/' . $pluginslug . '/' . $filename ) ) {

			$template = $themedir . '/cdz-theme/templates/plugins/' . $pluginslug . '/' . $filename;

		} else if ( file_exists( $plugindir . '/templates/' . $filename ) ) {

			$template = $plugindir . '/templates/' . $filename;

		}

		return $template;

	}

}