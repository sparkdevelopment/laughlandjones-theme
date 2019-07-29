<?php

function lj_add_fabric_metaboxes() {
	$metabox = new_cmb2_box( array(
		'id'           => 'lj_fabric',
		'title'        => __( 'Fabric Options', 'lj' ),
		'object_types' => array( 'fabric' ),
	));

	$metabox->add_field( array(
		'name' => __( 'Pattern Number', 'lj' ),
		'id'   => 'lj_pattern',
		'type' => 'text_small',
	) );

	$metabox->add_field( array(
		'name' => __( 'Fabric Width', 'lj' ),
		'id'   => 'lj_width',
		'type' => 'text_small',
	) );

	$metabox->add_field( array(
		'name' => __( 'Rub Test', 'lj' ),
		'id'   => 'lj_rub_test',
		'type' => 'text_small',
	) );

	$metabox->add_field( array(
		'name' => __( 'Suitability', 'lj' ),
		'id'   => 'lj_suitability',
		'type' => 'text_medium',
	) );

	$metabox->add_field( array(
		'name' => __( 'Content', 'lj' ),
		'id'   => 'lj_content',
		'type' => 'text_medium',
	) );

	$variations_group = $metabox->add_field( array(
		'description' => __( 'Variations', 'lj' ),
		'id'          => 'lj_variations',
		'type'        => 'group',
	) );

	$metabox->add_group_field( $variations_group, array(
		'name' => __( 'Variation Number', 'lj' ),
		'id'   => 'variation_no',
		'type' => 'text_small',
	) );

	$metabox->add_group_field( $variations_group, array(
		'name' => __( 'Image', 'lj' ),
		'id'   => 'image',
		'type' => 'file',
	) );

	$metabox->add_group_field( $variations_group, array(
		'name' => 'Colour',
		'id'   => 'colour',
		'type' => 'colorpicker',
		'repeatable' => true,
	) );
}

add_action( 'cmb2_admin_init', 'lj_add_fabric_metaboxes' );
