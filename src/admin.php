<?php

include_once('admin/fabric.php');
include_once('admin/home.php');
include_once('admin/portfolio.php');
include_once('admin/team.php');
include_once('admin/contact_us.php');
include_once('admin/our_approach.php');
include_once('admin/fabric-collection.php');
include_once('admin/fabrics.php');

add_action( 'admin_init', 'hide_editor' );

function hide_editor() {
	// Set pages
	$pages = [];
	$templates =['template-home.php','template-our-approach.php','template-contact.php','template-fabrics.php'];

	// Get the Post ID
	$post_id = isset( $_GET['post'] ) ? $_GET['post'] : ( isset( $_POST['post_ID'] ) ? $_POST['post_ID'] : null );
	if ( ! isset( $post_id ) ) return;

	// Hide the editor on the pages names in $pages array
	$page_name = get_the_title($post_id);
	if ( in_array( $page_name, $pages ) ) {
		remove_post_type_support('page', 'editor');
	}

	// Hide the editor on a page with a template in $templates array
	$template_file = get_post_meta($post_id, '_wp_page_template', true);
	if( in_array( $template_file, $templates ) ) {
		remove_post_type_support('page', 'editor');
	}
}
