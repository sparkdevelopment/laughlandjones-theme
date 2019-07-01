<?php

function lj_add_contact_us_studio_metaboxes() {
	$metabox = new_cmb2_box( array(
		'id'           => 'lj_contact_us_studio',
		'title'        => __( 'Studio Contact Details', 'lj' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'template-contact.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
	));

	$metabox->add_field( array(
		'name' => 'Address',
		'id'   => 'studio_address',
		'type' => 'textarea_small'
	));

	$metabox->add_field( array(
		'name' => 'Phone',
		'id'   => 'studio_phone',
		'type' => 'text_medium'
	));

	$metabox->add_field( array(
		'name' => 'Email',
		'id'   => 'studio_email',
		'type' => 'text_medium'
	));
}

add_action( 'cmb2_admin_init', 'lj_add_contact_us_studio_metaboxes' );

function lj_add_contact_us_warehouse_metaboxes() {
	$metabox = new_cmb2_box( array(
		'id'           => 'lj_contact_us_warehouse',
		'title'        => __( 'Warehouse Contact Details', 'lj' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'template-contact.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
	));

	$metabox->add_field( array(
		'name' => 'Address',
		'id'   => 'warehouse_address',
		'type' => 'textarea_small'
	));

	$metabox->add_field( array(
		'name' => 'Phone',
		'id'   => 'warehouse_phone',
		'type' => 'text_medium'
	));

	$metabox->add_field( array(
		'name' => 'Email',
		'id'   => 'warehouse_email',
		'type' => 'text_medium'
	));
}

add_action( 'cmb2_admin_init', 'lj_add_contact_us_warehouse_metaboxes' );
