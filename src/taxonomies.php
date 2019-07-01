<?php
/**
 * ------------------------------------------------------------------------
 * Theme's Taxonomies
 * ------------------------------------------------------------------------
 * This file is for registering your theme post taxonomies. Taxonomies
 * allow users to easily categories content.
 */

if ( ! function_exists( 'lj_register_portfolio_entry_status_taxonomy' ) ) {
	/**
	 * Registers a `team` custom post type.
	 *
	 * @todo Change function prefix to your textdomain.
	 * @todo Update prefix in the hook function and if statement.
	 *
	 * @return void
	 */
	function lj_register_portfolio_entry_status_taxonomy() {
		register_taxonomy('portfolio_entry_status','portfolio',array(
			'hierarchical' => false,
			'rewrite' => false,
			'labels' => array(
				'name'                       => _x( 'Portfolio Item Status', 'taxonomy general name', 'lj' ),
				'singular_name'              => _x( 'Portfolio Item Status', 'taxonomy singular name', 'lj' ),
				'menu_name'                  => _x( 'Item Statuses', 'admin menu', 'lj' ),
				'all_items'                  => __( 'All Item Statuses', 'lj' ),
				'edit_item'                  => __( 'Edit Item Status', 'lj' ),
				'view_item'                  => __( 'View Item Status', 'lj' ),
				'update_item'                => __( 'Update Item Status', 'lj' ),
				'add_new_item'               => __( 'Add New Item Status', 'lj' ),
				'new_item_name'              => __( 'New Item Status Name', 'lj' ),
				'parent_item'                => __( 'Parent Item Status: ', 'lj' ),
				'parent_item_colon'          => __( 'Parent Item Status: ', 'lj' ),
				'search_items'               => __( 'Search Item Statuses', 'lj' ),
				'popular_items'              => __( 'Popular Item Statuses', 'lj' ),
				'separate_items_with_commas' => __( 'Separate items with commas', 'lj' ),
				'add_or_remove_items'        => __( 'Add or remove items', 'lj' ),
				'choose_from_most_used'      => __( 'Choose from the most used items', 'lj' ),
				'not_found'                  => __( 'No item statuses found.', 'lj' ),
				'back_to_items'              => __( 'Back to statuses', 'lj' ),
			)
		));
	}
	add_action( 'init', 'lj_register_portfolio_entry_status_taxonomy', 0 );
}

if ( ! function_exists( 'lj_add_portfolio_rewrite' ) ) {
	function lj_add_portfolio_rewrite() {
		add_rewrite_rule('^portfolio/in-progress', 'index.php?portfolio_entry_status=in-progress', 'top');
	}
	add_action('init', 'lj_add_portfolio_rewrite');
}
