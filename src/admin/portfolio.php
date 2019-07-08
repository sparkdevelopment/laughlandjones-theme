<?php

function lj_add_portfolio_metaboxes() {
	$metabox = new_cmb2_box( array(
		'id'           => 'lj_portfolio',
		'title'        => __( 'Portfolio Options', 'lj' ),
		'object_types' => array( 'portfolio' ),
	));

	$metabox->add_field( array(
		'name' => __( 'Photo', 'lj' ),
		'id'   => 'photo',
		'type' => 'file',
		'options' => array(
			'url' => false,
		),
	) );

	$metabox->add_field( array(
		'name' => __( 'Location', 'lj' ),
		'id'   => 'location',
		'type' => 'text_medium',
	) );

	$metabox->add_field( array(
		'name' => __( 'Client', 'lj' ),
		'id'   => 'client',
		'type' => 'text_medium',
	) );

	$metabox->add_field( array(
		'name' => __( 'Geography', 'lj' ),
		'id'   => 'geography',
		'type' => 'text_medium',
	) );

	$metabox->add_field( array(
		'name' => __( 'Architecture', 'lj' ),
		'id'   => 'architecture',
		'type' => 'text_medium',
	) );

	$metabox->add_field( array(
		'name' => __( 'Size', 'lj' ),
		'id'   => 'size',
		'type' => 'text_medium',
	) );

	$metabox->add_field( array(
		'name' => __( 'Architect', 'lj' ),
		'id'   => 'architect',
		'type' => 'text_medium',
	) );

	$metabox->add_field( array(
		'name' => __( 'Interior Architecture', 'lj' ),
		'id'   => 'interior_architecture',
		'type' => 'text_medium',
	) );

	$metabox->add_field( array(
		'name' => __( 'Interior Design', 'lj' ),
		'id'   => 'interior_design',
		'type' => 'text_medium',
	) );

	$metabox->add_field( array(
		'name' => __( 'Completion', 'lj' ),
		'id'   => 'completion',
		'type' => 'text_medium',
	) );

	$metabox->add_field( array(
		'name' => __( 'Testimonial', 'lj' ),
		'id'   => 'testimonial',
		'type' => 'textarea_small',
	) );

	$metabox->add_field( array(
		'name' => __( 'Description', 'lj' ),
		'id'   => 'description',
		'type' => 'textarea_small',
	) );

	$metabox->add_field( array(
		'name'       => __( 'Homepage Gallery', 'lj' ),
		'id'         => 'photos',
		'type'       => 'file_list',
	) );
}

add_action( 'cmb2_admin_init', 'lj_add_portfolio_metaboxes' );
