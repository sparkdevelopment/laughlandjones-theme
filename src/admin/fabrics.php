<?php

function lj_register_options_submenu_for_page_post_type() {
	/**
	 * Registers options page menu item and form.
	 */
	$cmb = new_cmb2_box( array(
		'id'           => 'lj_options_submenu_page',
		'title'        => esc_html__( 'Fabrics Options', 'lj' ),
		'object_types' => array( 'options-page' ),
		/*
		 * The following parameters are specific to the options-page box
		 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
		 */
		'option_key'      => 'lj_fabric_options', // The option key and admin menu page slug.
		// 'icon_url'        => '', // Menu icon. Only applicable if 'parent_slug' is left empty.
		// 'menu_title'      => esc_html__( 'Options', 'cmb2' ), // Falls back to 'title' (above).
		'parent_slug'     => 'edit.php?post_type=fabric', // Make options page a submenu item of the themes menu.
		// 'capability'      => 'manage_options', // Cap required to view options-page.
		// 'position'        => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
		// 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
		// 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
		// 'save_button'     => esc_html__( 'Save Theme Options', 'cmb2' ), // The text for the options-page save button. Defaults to 'Save'.
		// 'disable_settings_errors' => true, // On settings pages (not options-general.php sub-pages), allows disabling.
		// 'message_cb'      => 'lj_options_page_message_callback',
		'vertical_tabs' => true,
		'tabs' => [
			[
				'id'     => 'content',
				'icon'   => 'dashicons-admin-generic',
				'title'  => 'Content',
				'fields' => [
					'lj_fabrics_intro',
					'lj_fabrics_featured1',
					'lj_fabrics_featured2',
					'lj_fabrics_featured3',
				],
			],
			[
				'id'     => 'redirect',
				'icon'   => 'dashicons-arrow-right-alt',
				'title'  => 'Redirect',
				'fields' => [
					'lj_fabrics_redirect_enable',
					'lj_fabrics_redirect_collection',
				],
			],
			[
				'id'     => 'holding-page',
				'icon'   => 'dashicons-visibility',
				'title'  => 'Holding Page',
				'fields' => [
					'lj_fabrics_holding_enable',
					'lj_fabrics_holding_image',
					'lj_fabrics_holding_text',
				],
			],
		],
	) );

	$cmb->add_field( array(
		'name' => esc_html__( 'Introduction', 'lj' ),
		'desc' => esc_html__( 'Introductory text at the top of the Fabrics page', 'lj' ),
		'id'   => 'lj_fabrics_intro',
		'type' => 'textarea',
	) );

	$cmb->add_field( array(
		'name'             => 'Featured collection 1',
		'id'               => 'lj_fabrics_featured1',
		'taxonomy'         => 'fabric_collection',
		'type'             => 'select',
		'remove_default'   => 'false',
		'show_option_none' => true,
		'options_cb'       => 'cmb2_get_term_options',
		'query_args'       => array(
			'orderby' => 'title',
			'hide_empty' => true,
		),
	) );

	$cmb->add_field( array(
		'name'             => 'Featured collection 2',
		'id'               => 'lj_fabrics_featured2',
		'taxonomy'         => 'fabric_collection',
		'type'             => 'select',
		'remove_default'   => 'false',
		'show_option_none' => true,
		'options_cb'       => 'cmb2_get_term_options',
		'query_args'       => array(
			'orderby' => 'title',
			'hide_empty' => true,
		),
	) );

	$cmb->add_field( array(
		'name'             => 'Featured collection 3',
		'id'               => 'lj_fabrics_featured3',
		'taxonomy'         => 'fabric_collection',
		'type'             => 'select',
		'remove_default'   => 'false',
		'show_option_none' => true,
		'options_cb'       => 'cmb2_get_term_options',
		'query_args'       => array(
			'orderby' => 'title',
			'hide_empty' => true,
		),
	) );

	$cmb->add_field( [
		'name' => 'Enable Holding Page',
		'id'   => 'lj_fabrics_holding_enable',
		'type' => 'switch',
	] );

	$cmb->add_field( [
		'name' => 'Image',
		'id'   => 'lj_fabrics_holding_image',
		'type' => 'file'
	] );

	$cmb->add_field( [
		'name' => 'Text',
		'id'   => 'lj_fabrics_holding_text',
		'type' => 'textarea',
	] );

	$cmb->add_field( [
		'name' => 'Enable Collection Redirect',
		'id'   => 'lj_fabrics_redirect_enable',
		'type' => 'switch',
		'description' => 'If enabled, allows you to redirect the Fabrics landing page to a single collection',
	] );

	$cmb->add_field( array(
		'name'             => 'Collection',
		'id'               => 'lj_fabrics_redirect_collection',
		'taxonomy'         => 'fabric_collection',
		'type'             => 'select',
		'remove_default'   => 'false',
		'show_option_none' => true,
		'options_cb'       => 'cmb2_get_term_options',
		'query_args'       => array(
			'orderby' => 'title',
			'hide_empty' => true,
		),
	) );
}
add_action( 'cmb2_admin_init', 'lj_register_options_submenu_for_page_post_type' );

function cmb2_get_term_options( $field ) {
	$args = $field->args( 'get_terms_args' );
	$args = is_array( $args ) ? $args : array();

	$args = wp_parse_args( $args, array( 'taxonomy' => 'fabric_collection' ) );

	$taxonomy = $args['taxonomy'];

	$terms = (array) cmb2_utils()->wp_at_least( '4.5.0' )
		? get_terms( $args )
		: get_terms( $taxonomy, $args );

	// Initiate an empty array
	$term_options = array();
	if ( ! empty( $terms ) ) {
		foreach ( $terms as $term ) {
			$term_options[ $term->term_id ] = $term->name;
		}
	}

	return $term_options;
}
