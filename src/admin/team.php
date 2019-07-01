<?php

function lj_add_team_metaboxes() {
	$metabox = new_cmb2_box( array(
		'id'           => 'lj_team',
		'title'        => __( 'Team Options', 'lj' ),
		'object_types' => array( 'options-page' ),
		'option_key'   => 'lj_team',
		'parent_slug'  =>  'edit.php?post_type=team'
	));

	$metabox->add_field( array(
		'name' => __( 'Team Introduction', 'lj' ),
		'id'   => 'intro',
		'type' => 'textarea',
	) );

	$metabox->add_field( array(
		'name' => __( 'Numbers', 'lj' ),
		'id'   => 'numbers',
		'type' => 'group'
	));

	$metabox->add_group_field( 'numbers', array(
		'name' => 'Title',
		'id'   => 'title',
		'type' => 'text_medium'
	));

	$metabox->add_group_field( 'numbers', array(
		'name' => 'Value',
		'id'   => 'value',
		'type' => 'text_small',
		'attributes' => array(
			'type' => 'number'
		)
	));

	$metabox->add_group_field( 'numbers', array(
		'name' => 'Suffix',
		'id'   => 'suffix',
		'type' => 'text_small'
	));

	$metabox->add_field( array(
		'name' => __( 'Work With Us', 'lj' ),
		'id'   => 'work_with_us',
		'type' => 'textarea',
	) );
}

function lj_add_team_member_metaboxes() {
	$metabox = new_cmb2_box( array(
		'id'           => 'lj_team_member',
		'title'        => __( 'Team Member Options', 'lj' ),
		'object_types' => array( 'team' )
	));

	$metabox->add_field( array(
		'name' => __( 'First Name', 'lj' ),
		'id'   => 'first_name',
		'type' => 'text_medium',
	) );

	$metabox->add_field( array(
		'name' => __( 'Last Name', 'lj' ),
		'id'   => 'last_name',
		'type' => 'text_medium',
	) );

	$metabox->add_field( array(
		'name' => __( 'Position', 'lj' ),
		'id'   => 'position',
		'type' => 'text_medium',
	) );

	$metabox->add_field( array(
		'name' => __( 'Photo', 'lj' ),
		'id'   => 'photo',
		'type' => 'file',
		'options' => array(
			'url' => false,
		),
	) );

	$metabox->add_field( array(
		'name' => __( 'About', 'lj' ),
		'id'   => 'copy',
		'type' => 'textarea_small',
	) );

	$metabox->add_field( array(
		'name' => __( 'LinkedIn', 'lj' ),
		'id'   => 'linkedin',
		'type' => 'text_url',
	) );

	$metabox->add_field( array(
		'name' => __( 'Email', 'lj' ),
		'id'   => 'email',
		'type' => 'text_email',
	) );
}

add_action( 'cmb2_admin_init', 'lj_add_team_metaboxes' );
add_action( 'cmb2_admin_init', 'lj_add_team_member_metaboxes' );

function set_team_member_title( $post_id, $post, $update ) {

	$post_title = get_the_title( $post_id );
	$post_meta = get_post_meta( $post_id );

	if ( isset( $_POST['first_name'] ) ) {
		if ( isset( $_POST['last_name'] ) ) {
			$post_title = $_POST['first_name'] . ' ' . $_POST['last_name'];
		} else {
			$post_title = $_POST['first_name'];
		}
	} elseif ( isset( $_POST['last_name'] ) ) {
		$post_title = $_POST['last_name'];
	}

	// Avoid infinite loops
	remove_action( 'save_post_team', 'set_team_member_title', 10 );

	wp_update_post(array(
		'ID'         => $post_id,
		'post_title' => $post_title
	));

	add_action( 'save_post_team', 'set_team_member_title', 10, 3 );
}
add_action( 'save_post_team', 'set_team_member_title', 10, 3 );
