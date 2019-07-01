<?php

function lj_add_our_approach_metaboxes() {
	$metabox = new_cmb2_box( array(
		'id'           => 'lj_our_approach',
		'title'        => __( 'Our Approach Options', 'lj' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'template-our-approach.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
	));

	$metabox->add_field( array(
		'name' => 'Interior Architecture',
		'id'   => 'interior_architecture',
		'type' => 'textarea_small'
	));

	$metabox->add_field( array(
		'name' => 'Interior Design',
		'id'   => 'interior_design',
		'type' => 'textarea_small'
	));

	$metabox->add_field( array(
		'name' => 'Purchasing & Logistics',
		'id'   => 'purchasing_logistics',
		'type' => 'textarea_small'
	));

	$metabox->add_field( array(
		'name' => 'Workflow',
		'id'   => 'workflow',
		'type' => 'textarea_small'
	));

	$metabox->add_field( array(
		'name' => 'Artisans',
		'id'   => 'artisans',
		'type' => 'textarea_small'
	));
}

add_action( 'cmb2_admin_init', 'lj_add_our_approach_metaboxes' );
