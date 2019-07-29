<?php

function lj_register_metabox_fabric_collection() {
	/**
	 * Registers options page menu item and form.
	 */
	$cmb = new_cmb2_box( array(
		'id'               => 'lj_fabric_collection_box',
		'title'            => esc_html__( 'Fabrics Options', 'lj' ),
		'object_types'     => array( 'term' ),
		'taxonomies'       => [ 'fabric_collection' ],
		'new_term_section' => true,
	) );

	$cmb->add_field( array(
		'name'           => 'Collection cover',
		'id'             => 'lj_collection_cover',
		'type'           => 'file',
		'options' => array(
			'url' => false, // Hide the text input for the url
		),
	) );
}
add_action( 'cmb2_admin_init', 'lj_register_metabox_fabric_collection' );
