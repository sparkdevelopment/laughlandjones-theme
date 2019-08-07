<?php

function lj_register_metabox_fabric_colour() {
	/**
	 * Registers options page menu item and form.
	 */
	$cmb = new_cmb2_box( array(
		'id'               => 'lj_colour_box',
		'title'            => esc_html__( 'Colour', 'lj' ),
		'object_types'     => array( 'term' ),
		'taxonomies'       => [ 'fabric_colour' ],
		'new_term_section' => true,
	) );

	$cmb->add_field( array(
		'name'           => 'Colour code',
		'id'             => 'lj_colour_code',
		'type'           => 'colorpicker',
	) );
}
add_action( 'cmb2_admin_init', 'lj_register_metabox_fabric_colour' );

function add_fabric_colour_columns($columns){
    $columns['colour'] = 'Colour';
    return $columns;
}
add_filter('manage_edit-fabric_colour_columns', 'add_fabric_colour_columns');

function add_fabric_colour_column_content( $content, $column_name, $term_id ){
    $term= get_term( $term_id, 'fabric_colour' );
    switch ( $column_name ) {
		case 'colour':
			$colour_code = get_term_meta( $term_id, 'lj_colour_code', true );
            $content = '<div style="height:1rem;width:1rem;background: ' . $colour_code . ';border:1px solid #eee;"></div>';
            break;
        default:
            break;
    }
    return $content;
}
add_filter( 'manage_fabric_colour_custom_column', 'add_fabric_colour_column_content', 10, 3 );
