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
		'name' => __( 'Vertical Repeat', 'lj' ),
		'id'   => 'lj_vertical_repeat',
		'type' => 'text_small',
	) );

	$metabox->add_field( array(
		'name' => __( 'Horizontal Repeat', 'lj' ),
		'id'   => 'lj_horizontal_repeat',
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

	$metabox->add_field( array(
		'name' => __( 'Default Image', 'lj' ),
		'id'   => 'lj_default_image',
		'type' => 'file',
	) );

	$variations_group = $metabox->add_field( array(
		'description' => __( 'Variations', 'lj' ),
		'id'          => 'lj_variations',
		'type'        => 'group',
		'options'     => array(
			'group_title'       => __( 'Variation {#}', 'lj' ),
			'add_button'        => __( 'Add Variation', 'lj' ),
			'remove_button'     => __( 'Remove Variation', 'lj' ),
			'sortable'          => true,
			'remove_confirm' => esc_html__( 'Are you sure you want to remove this variation?', 'lj' ),
		),
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
		'name'       => 'Colour',
		'id'         => 'colour',
		'type'       => 'multicheck_inline',
		'options_cb' => 'cmb2_get_term_options',
		'get_terms_args' => array(
			'taxonomy'   => 'fabric_colour',
			'hide_empty' => false,
		),
	) );

	$metabox->add_field( [
		'name'       => __( 'Slideshow', 'lj' ),
		'id'         => 'lj_fabric_slideshow',
		'type'       => 'file_list',
	] );
}
add_action( 'cmb2_admin_init', 'lj_add_fabric_metaboxes' );

function cmb2_get_colours( $field ) {
	$args = $field->args( 'get_terms_args' );
	$args = is_array( $args ) ? $args : array();

	$args = wp_parse_args( $args, array( 'taxonomy' => 'category' ) );

	$taxonomy = $args['taxonomy'];

	$terms = (array) cmb2_utils()->wp_at_least( '4.5.0' )
		? get_terms( $args )
		: get_terms( $taxonomy, $args );

	// Initate an empty array
	$term_options = array();
	if ( ! empty( $terms ) ) {
		foreach ( $terms as $term ) {
			$term_options[ $term->term_id ] = $term->name;
		}
	}

	return $term_options;
}

function get_fabric_data( $term_id ) {
	if ( '' === $term_id ) {
		return;
	}

	$collection = get_term( $term_id, 'fabric_collection' );

	return [
		'name'  => $collection->name,
		'image' => get_term_meta( $term_id, 'lj_collection_cover', true ),
		'url'   => get_term_link( (int) $term_id, 'fabric_collection' ),
	];
}

function get_variations( $post_id = false, $variation_id = false ) {
	$variations = [];

	$variation_meta = get_post_meta( $post_id, 'lj_variations', true );

	if ( $variation_meta ) {

		foreach ( $variation_meta as $variation ) {
			$variation_array = [
				'no'        => $variation['variation_no'],
				'image_url' => $variation['image'],
				'colours'   => []
			];

			foreach( $variation['colour'] as $colour ) {
				$variation_array['colours'][ get_term_field( 'name', $colour, 'fabric_colour', 'string') ] = get_term_meta( $colour, 'lj_colour_code', true );
			}

			$variations[] = $variation_array;
		}

	}

	return $variation_id === false ? $variations : $variations[ $variation_id ];
}
