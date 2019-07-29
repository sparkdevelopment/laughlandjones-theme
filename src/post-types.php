<?php
/**
 * ------------------------------------------------------------------------
 * Theme's Post Types
 * ------------------------------------------------------------------------
 * This file is for registering your theme post types. Custom post types
 * allow users to easily create and manage various types of content.
 */

if ( ! function_exists( 'lj_register_team_post_type' ) ) {
	/**
	 * Registers a `team` custom post type.
	 *
	 * @todo Change function prefix to your textdomain.
	 * @todo Update prefix in the hook function and if statement.
	 *
	 * @return void
	 */
	function lj_register_team_post_type() {
		register_post_type(
			'team', array(
				'public'      => true,
				'supports'    => false,
				'description' => __( 'Collection of team members.', 'lj' ),
				'labels'      => array(
					'name'               => _x( 'Team Members', 'post type general name', 'lj' ),
					'singular_name'      => _x( 'Team Member', 'post type singular name', 'lj' ),
					'menu_name'          => _x( 'Team Members', 'admin menu', 'lj' ),
					'name_admin_bar'     => _x( 'Team Member', 'add new on admin bar', 'lj' ),
					'add_new'            => _x( 'Add New', 'team member', 'lj' ),
					'add_new_item'       => __( 'Add New Team Member', 'lj' ),
					'new_item'           => __( 'New Team Member', 'lj' ),
					'edit_item'          => __( 'Edit Team Member', 'lj' ),
					'view_item'          => __( 'View Team Member', 'lj' ),
					'all_items'          => __( 'All Team Members', 'lj' ),
					'search_items'       => __( 'Search Team Members', 'lj' ),
					'parent_item_colon'  => __( 'Parent Team Members: ', 'lj' ),
					'not_found'          => __( 'No team members found.', 'lj' ),
					'not_found_in_trash' => __( 'No team members found in Trash.', 'lj' ),
				),
				'has_archive' => true,
				'menu_icon' => 'dashicons-groups'
			)
		);
	}
}
add_action( 'init', 'lj_register_team_post_type' );

if ( ! function_exists( 'lj_register_portfolio_post_type' ) ) {
	/**
	 * Registers a `portfolio` custom post type.
	 *
	 * @todo Change function prefix to your textdomain.
	 * @todo Update prefix in the hook function and if statement.
	 *
	 * @return void
	 */
	function lj_register_portfolio_post_type() {
		register_post_type(
			'portfolio', array(
				'public'             => true,
				'supports'           => array( 'title' ),
				'description'        => __( 'Collection of portfolio items.', 'lj' ),
				'has_archive'        => true,
				'menu_icon'          => 'dashicons-portfolio',
				'labels'             => array(
					'name'               => _x( 'Portfolio Items', 'post type general name', 'lj' ),
					'singular_name'      => _x( 'Portfolio Item', 'post type singular name', 'lj' ),
					'menu_name'          => _x( 'Portfolio Items', 'admin menu', 'lj' ),
					'name_admin_bar'     => _x( 'Portfolio Item', 'add new on admin bar', 'lj' ),
					'add_new'            => _x( 'Add New', 'portfolio item', 'lj' ),
					'add_new_item'       => __( 'Add New Portfolio Item', 'lj' ),
					'new_item'           => __( 'New Portfolio Item', 'lj' ),
					'edit_item'          => __( 'Edit Portfolio Item', 'lj' ),
					'view_item'          => __( 'View Portfolio Item', 'lj' ),
					'all_items'          => __( 'All Portfolio Items', 'lj' ),
					'search_items'       => __( 'Search Portfolio Items', 'lj' ),
					'parent_item_colon'  => __( 'Parent Portfolio Items: ', 'lj' ),
					'not_found'          => __( 'No portfolio items found.', 'lj' ),
					'not_found_in_trash' => __( 'No portfolio items found in Trash.', 'lj' ),
				)
			)
		);
	}
}
add_action( 'init', 'lj_register_portfolio_post_type' );

if ( ! function_exists( 'lj_register_fabric_post_type' ) ) {
	/**
	 * Registers a `fabric` custom post type.
	 *
	 * @todo Change function prefix to your textdomain.
	 * @todo Update prefix in the hook function and if statement.
	 *
	 * @return void
	 */
	function lj_register_fabric_post_type() {
		register_post_type(
			'fabric', array(
				'public'             => true,
				'supports'           => array( 'title' ),
				'description'        => __( 'Individual fabrics.', 'lj' ),
				'has_archive'        => 'fabrics',
				'menu_icon'          => 'dashicons-products',
				'labels'             => array(
					'name'               => _x( 'Fabrics', 'post type general name', 'lj' ),
					'singular_name'      => _x( 'Fabric', 'post type singular name', 'lj' ),
					'menu_name'          => _x( 'Fabrics', 'admin menu', 'lj' ),
					'name_admin_bar'     => _x( 'Fabric', 'add new on admin bar', 'lj' ),
					'add_new'            => _x( 'Add New', 'fabric', 'lj' ),
					'add_new_item'       => __( 'Add New Fabric', 'lj' ),
					'new_item'           => __( 'New Fabric', 'lj' ),
					'edit_item'          => __( 'Edit Fabric', 'lj' ),
					'view_item'          => __( 'View Fabric', 'lj' ),
					'all_items'          => __( 'All Fabrics', 'lj' ),
					'search_items'       => __( 'Search Fabrics', 'lj' ),
					'parent_item_colon'  => __( 'Parent Fabrics: ', 'lj' ),
					'not_found'          => __( 'No fabrics found.', 'lj' ),
					'not_found_in_trash' => __( 'No fabrics found in Trash.', 'lj' ),
				),
				'rewrite'             => true,
			)
		);
	}
}
add_action( 'init', 'lj_register_fabric_post_type' );

function lj_fabrics_cpt_generating_rule($wp_rewrite) {
    $rules = array();
    $terms = get_terms( array(
        'taxonomy' => 'fabric_collection',
        'hide_empty' => false,
    ) );

    $post_type = 'fabric';

    foreach ($terms as $term) {

        $rules['fabrics/' . $term->slug . '/([^/]*)$'] = 'index.php?post_type=' . $post_type. '&' . $post_type. '=$matches[1]&name=$matches[1]';

    }

    // merge with global rules
    $wp_rewrite->rules = $rules + $wp_rewrite->rules;
}
add_filter('generate_rewrite_rules', 'lj_fabrics_cpt_generating_rule');

function lj_change_fabrics_link( $permalink, $post ) {

    if( $post->post_type == 'fabric' ) {
        $resource_terms = get_the_terms( $post, 'fabric_collection' );
        $term_slug = '';
        if( ! empty( $resource_terms ) ) {
            foreach ( $resource_terms as $term ) {

                // The featured resource will have another category which is the main one
                if( $term->slug == 'featured' ) {
                    continue;
                }

                $term_slug = $term->slug;
                break;
            }
        }
        $permalink = get_home_url() ."/fabrics/" . $term_slug . '/' . $post->post_name;
    }
    return $permalink;

}
add_filter('post_type_link',"lj_change_fabrics_link",10,2);
