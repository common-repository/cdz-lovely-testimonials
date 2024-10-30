<?php

namespace cdzLovelyTestimonials;

/*
 *	cdzFunction: Include Template Files
 */

if ( ! function_exists( 'cdz_include_template_files' ) ) {

	function cdz_include_template_files( $template ) {

		if ( is_single() AND get_post_type() == 'cdz_testimonial' ) {

			return cdz_get_template( $template, 'cdz-lovely-testimonials', 'cdz-testimonial.php' );
			
		} else if ( is_archive() AND get_post_type() == 'cdz_testimonial' ) {

			return cdz_get_template( $template, 'cdz-lovely-testimonials', 'cdz-archive.php' );

		}

		return $template;

	}

}