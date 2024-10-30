<?php

namespace cdzLovelyTestimonials;

/*
 *	cdzClass: Testimonial Category
 */

class cdz_Testimonial_Category {

	function __construct() {

		/*
		 *	Register taxonomy
		 */

		add_action( 'init', array( &$this, 'register_taxonomy' ) );

		/*
		 *	Add form fields remover
		 */

		add_action( 'cdz_testimonial_category_add_form_fields', array( &$this, 'add_form_fields_remover' ), 10, 2 );

	}

	function register_taxonomy() {
	
		$labels = array(
			'name'							=>	__( 'Testimonial Categories', 'cdz' ),
			'singular_name'					=>	__( 'Testimonial Category', 'cdz' ),
			'menu_name'						=>	__( 'Categories', 'cdz' ),
			'all_items'						=>	__( 'All Testimonial Categories', 'cdz' ),
			'edit_item'						=>	__( 'Edit Testimonial Category', 'cdz' ),
			'view_item'						=>	__( 'View Testimonial Category', 'cdz' ),
			'update_item'					=>	__( 'Update Testimonial Category', 'cdz' ),
			'add_new_item'					=>	__( 'Add New Testimonial Category', 'cdz' ),
			'new_item_name'					=>	__( 'New Testimonial Category Name', 'cdz' ),
			'search_items'					=>	__( 'Search Testimonial Categories', 'cdz' ),
			'popular_items'					=>	NULL,
			'separate_items_with_commas'	=>	__( 'Separate testimonial categories with commas', 'cdz' ),
			'add_or_remove_items'			=>	__( 'Add or remove testimonial categories', 'cdz' ),
			'choose_from_most_used'			=>	__( 'Choose from the most used testimonial categories', 'cdz' ),
			'not_found'						=>	__( 'No testimonial categories found.', 'cdz' ),
		);

		$args = array(
			'label'				=>	__( 'Category' ),
			'labels'			=>	$labels,
			'show_in_nav_menus'	=>	true,
			'hierarchical'		=>	true,
			'rewrite'			=>	array( 'slug' => 'testimonial-category' ),
		);

		register_taxonomy( 'cdz_testimonial_category',
			apply_filters( 'cdz_testimonial_category_objects', array('cdz_testimonial') ),
			apply_filters( 'cdz_testimonial_category_args', $args )
		);

	}

	function add_form_fields_remover() {

		echo '<style>.form-field{display:none;}.form-field.form-required{display:block;}</style>';

	}

}