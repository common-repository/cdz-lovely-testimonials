<?php

namespace cdzLovelyTestimonials;

/*
 *	cdzClass: Testimonial
 */

class cdz_Testimonial {

	function __construct() {

		/*
		 *	Register Post type
		 */
		
		add_action( 'init', array( &$this, 'register_post_type' ) );

		/*
		 *	Post Updated Messages
		 */

		add_filter( 'post_updated_messages', array( &$this, 'post_updated_messages' ) );

		/*
		 *	Add Meta Boxes
		 */

		add_action( 'add_meta_boxes', array( &$this, 'add_meta_boxes' ) );

		/*
		 *	Save Meta
		 */
		
		add_action( 'save_post', array( &$this, 'save_meta' ), 1, 2 );

		/*
		 *	Manage CPT columns
		 */

		add_action( 'manage_edit-cdz_testimonial_columns', array( &$this, 'manage_columns' ) );

		/*
		 *	Manage posts custom column
		 */

		add_action( 'manage_cdz_testimonial_posts_custom_column', array( &$this, 'manage_posts_custom_column' ) );

		/*
		 *	Make column sortable
		 */

		add_filter('manage_edit-cdz_testimonial_sortable_columns', array( &$this, 'manage_sortable_columns' ) );

	}

	function register_post_type() {

		$labels = array(
			'name'					=>	__( 'Testimonials', 'cdz' ),
			'singular_name'			=>	__( 'Testimonial', 'cdz' ),
			'menu_name'				=>	__( 'Testimonials', 'cdz' ),
			'all_items'				=>	__( 'All Testimonials', 'cdz' ),
			'add_new'				=>	__( 'Add Testimonial', 'cdz' ),
			'add_new_item'			=>	__( 'Add New Testimonial', 'cdz' ),
			'edit_item'				=>	__( 'Edit Testimonial', 'cdz' ),
			'new_item'				=>	__( 'New Testimonial', 'cdz' ),
			'view_item'				=>	__( 'View Testimonial', 'cdz' ),
			'search_items'			=>	__( 'Search Testimonials', 'cdz' ),
			'not_found'				=>	__( 'No testimonials found', 'cdz' ),
			'not_found_in_trash'	=>	__( 'No testimonials found in Trash', 'cdz' ),
		);

		$args =	array(
			'labels'				=>	$labels,
			'public'				=>	true,
			'show_in_nav_menus'		=>	false,
			'show_in_menu'			=>	true,
			'menu_position'			=>	21,
			'menu_icon'				=>	'dashicons-admin-page',
			'has_archive'			=>	true,
			'rewrite'				=>	array( 'slug' => 'testimonial' ),
			'can_export'			=>	true,
			'supports'				=>	array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		);

		/*
		 *	Use the order attribute:
		 *	$loop = new WP_Query( array( 'post_type', 'slider_item', 'orderby' => 'menu_order', 'order'=>'ASC') );
		 */

		register_post_type( 'cdz_testimonial', apply_filters( 'cdz_testimonial_args', $args ) );

	}

	function post_updated_messages( $messages ) {

		global $post, $post_ID;

		$messages['cdz_testimonial'] = array(
			0	=>	'',
			1	=>	sprintf( __( 'Testimonial updated. <a href="%s">View testimonial</a>', 'cdz' ), esc_url( get_permalink($post_ID) ) ),
			2	=>	__( 'Custom field updated.', 'cdz' ),
			3	=>	__( 'Custom field deleted.', 'cdz' ),
			4	=>	__( 'Testimonial updated.', 'cdz' ),
			5	=>	isset( $_GET['revision'] ) ? sprintf( __( 'Testimonial restored to revision from %s', 'cdz' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6	=>	sprintf( __( 'Testimonial published. <a href="%s">View testimonial</a>', 'cdz' ), esc_url( get_permalink($post_ID) ) ),
			7	=>	__( 'Testimonial saved.', 'cdz' ),
			8	=>	sprintf( __( 'Testimonial submitted. <a target="_blank" href="%s">Preview testimonial</a>', 'cdz' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
			9	=>	sprintf(
						__( 'Testimonial scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview testimonial</a>', 'cdz' ),
						date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) )
					),
			10	=>	sprintf( __( 'Testimonial draft updated. <a target="_blank" href="%s">Preview testimonial</a>', 'cdz' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
		);

		return $messages;

	}

	/*
	 *	Meta Boxes
	 */

	function add_meta_boxes() {

		add_meta_box( 'cdz_testimonial_box_author', __( 'Testimonial info', 'cdz' ), array( &$this, 'box_author' ), 'cdz_testimonial', 'normal', 'high' );
		//add_meta_box( 'cdz_testimonial_box_settings', __( 'Settings', 'cdz' ), array( &$this, 'box_settings' ), 'cdz_testimonial', 'normal', 'high' );

	}
	
	function box_author() {

		global $post;

		/*
		 *	Noncename needed to verify where the data originated
		 */

		echo '<input type="hidden" name="cdz_testimonial_meta_noncename" id="cdz_testimonial_meta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
		
		/*
		 *	Get meta
		 */

		$cdz_testimonial_author_label		= get_post_meta( $post->ID, 'cdz_testimonial_author_label', true );
		$cdz_testimonial_author				= get_post_meta( $post->ID, 'cdz_testimonial_author', true );
		$cdz_testimonial_website_label		= get_post_meta( $post->ID, 'cdz_testimonial_website_label', true );
		$cdz_testimonial_website_url		= get_post_meta( $post->ID, 'cdz_testimonial_website_url', true );

		/*
		 *	Fields
		 */

		echo '<p><label for="cdz_testimonial_author_label">' . __( 'Author Label', 'cdz' ) . ' - <i>"' . __( 'Author', 'cdz' ) . ':"</i></label></p>';
		echo '<input type="text" name="cdz_testimonial_author_label" value="' . $cdz_testimonial_author_label  . '" id="cdz_testimonial_author_label" class="widefat" />';

		echo '<p><label for="cdz_testimonial_author">' . __( 'Author', 'cdz' ) . '</label></p>';
		echo '<input type="text" name="cdz_testimonial_author" value="' . $cdz_testimonial_author  . '" id="cdz_testimonial_author" class="widefat" />';

		echo '<p><label for="cdz_testimonial_website_label">' . __( 'Website Label', 'cdz' ) . ' - <i>"' . __( 'Website', 'cdz' ) . ':"</i></label></p>';
		echo '<input type="text" name="cdz_testimonial_website_label" value="' . $cdz_testimonial_website_label  . '" id="cdz_testimonial_website_label" class="widefat" />';

		echo '<p><label for="cdz_testimonial_website_url">' . __( 'Website URL', 'cdz' ) . '</label></p>';
		echo '<input type="text" name="cdz_testimonial_website_url" value="' . $cdz_testimonial_website_url  . '" id="cdz_testimonial_website_url" class="widefat" />';

	}
	
	function box_settings() {

		global $post;

		/*
		 *	Noncename needed to verify where the data originated
		 */

		echo '<input type="hidden" name="cdz_testimonial_meta_noncename" id="cdz_testimonial_meta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

		/*
		 *	Get meta
		 */

		$cdz_testimonial_featured			= get_post_meta( $post->ID, 'cdz_testimonial_featured', true );
		$cdz_testimonial_read_more_label	= get_post_meta( $post->ID, 'cdz_testimonial_read_more_label', true );

		/*
		 *	Fields
		 */

		echo '<p><label for="cdz_testimonial_read_more_label">' . __( '"Read More" Label', 'cdz' ) . '</label></p>';
		echo '<input type="text" name="cdz_testimonial_read_more_label" value="' . $cdz_testimonial_read_more_label  . '" class="widefat" />';

		echo '<p><label for="cdz_testimonial_featured">' . __( 'Feature this work?', 'cdz' ) . '</label></p>';
		echo '<input type="checkbox" name="cdz_testimonial_featured" id="cdz_testimonial_featured" value="1" ' . checked( 1, $cdz_testimonial_featured, false ) . ' />';

	}

	function save_meta( $post_id, $post ) {

		if ( ! isset( $_POST['cdz_testimonial_meta_noncename'] ) ) { return $post->ID; }

		/*
		 *	Verify this came from the our screen and with proper authorization
		 */

		if ( ! wp_verify_nonce( $_POST['cdz_testimonial_meta_noncename'], plugin_basename(__FILE__) )) { return $post->ID; }

		/*
		 *	User allowed to edit the post or page?
		 */

		if ( ! current_user_can( 'edit_post', $post->ID ) ) { return $post->ID; }

		/*
		 *	Get Data and put them into an array to make it easier to loop though
		 */

		$cdz_testimonial_meta['cdz_testimonial_author_label']		= $_POST['cdz_testimonial_author_label'];
		$cdz_testimonial_meta['cdz_testimonial_author']				= $_POST['cdz_testimonial_author'];
		$cdz_testimonial_meta['cdz_testimonial_website_label']		= $_POST['cdz_testimonial_website_label'];
		$cdz_testimonial_meta['cdz_testimonial_website_url']		= $_POST['cdz_testimonial_website_url'];

		// $cdz_testimonial_meta['cdz_testimonial_featured']			= isset( $_POST['cdz_testimonial_featured'] ) ? $_POST['cdz_testimonial_featured'] : '';
		// $cdz_testimonial_meta['cdz_testimonial_read_more_label']	= $_POST['cdz_testimonial_read_more_label'];

		/*
		 *	Add values of $cdz_testimonial_meta as custom fields
		 */

		foreach ( $cdz_testimonial_meta as $key => $value ) {

			/*
			 *	Don't store custom data twice
			 */

			if( $post->post_type == 'revision' ) { return; }

			/*
			 *	If $value is an array, make it a CSV (unlikely)
			 */

			$value = implode( ',', (array)$value );

			/*
			 *	If the custom field already has a value
			 */

			if( get_post_meta( $post->ID, $key, FALSE ) ) {

				update_post_meta( $post->ID, $key, $value );

			} else {

				add_post_meta($post->ID, $key, $value);

			}

			/*
			 *	Delete if blank
			 */

			if( !$value ) {

				delete_post_meta($post->ID, $key);

			}
		}
	}

	/*
	 *	Manage columns
	 */

	function manage_columns( $old_columns ) {

		/*
		 *	Doc: http://codex.wordpress.org/Plugin_API/Filter_Reference/manage_edit-post_type_columns
		 */

		var_dump( $old_columns );
		
		$columns['cb']							= '<input type="checkbox" />';
		$columns['title']						= __( 'Title', 'cdz' );
		$columns['cdz_testimonial_thumb']		= __( 'Image', 'cdz' );
		$columns['cdz_testimonial_groups']		= __( 'Groups', 'cdz' );
		$columns['cdz_testimonial_categories']	= __( 'Categories', 'cdz' );
		$columns['cdz_testimonial_featured']	= __( 'Featured', 'cdz' );
		$columns['menu_order']					= __( 'Order', 'cdz' );
		//$columns['date']						= __( 'Date', 'cdz' );

  		return $columns;
	}

	function manage_posts_custom_column( $name ) {
		
		global $post;

		if		( $name == 'menu_order' )					{ echo $post->menu_order; }
		else if	( $name == 'cdz_testimonial_thumb' )		{ echo get_the_post_thumbnail( $post->ID, 'cdz_testimonial_thumb' ); }
		else if	( $name == 'cdz_testimonial_groups' )		{ the_terms( $post->ID, 'cdz_testimonial_portfolio', '', ', ' ); }
		else if	( $name == 'cdz_testimonial_categories' )	{ the_terms( $post->ID, 'cdz_testimonial_category', '', ', ' ); }
		else if	( $name == 'cdz_testimonial_groups' )		{ the_terms( $post->ID, 'cdz_testimonial_portfolio', '', ', ' ); }
		else if	( $name == 'cdz_testimonial_featured' )		{ echo get_post_meta( $post->ID, 'cdz_testimonial_featured', true ) ? __( 'Yes', 'cdz' ) : __( 'No', 'cdz' ); }

	}

	function manage_sortable_columns( $columns ) {

		$columns['menu_order'] = 'menu_order';
		$columns['cdz_testimonial_featured'] = 'cdz_testimonial_featured';

		return $columns;
	}

}