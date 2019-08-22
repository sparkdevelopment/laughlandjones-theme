<?php
/**
 * ------------------------------------------------------------------------
 * Theme's Custom Image Sizes
 * ------------------------------------------------------------------------
 * This file is for registering custom image
 * sizes for using as for thumbnails.
 */

if ( ! function_exists( 'tonik_register_thumbnails' ) ) {
	/**
	 * Registers theme's additional thumbnail sizes.
	 *
	 * @todo Change function prefix to your textdomain.
	 * @todo Update prefix in the hook function and if statement.
	 *
	 * @return void
	 */
	function tonik_register_thumbnails() {
		add_image_size( 'custom-thumbnail', 800, 600, true );
		add_image_size( 'lj-home-mobile-p', 400, 600, true );
		add_image_size( 'lj-home-mobile-l', 800, 533, true );
		add_image_size( 'lj-home-normal-p', 650, 975, true );
		add_image_size( 'lj-home-normal-l', 1250, 833, true );
		add_image_size( 'lj-home-retina-p', 900, 1350, true );
		add_image_size( 'lj-home-retina-l', 1750, 1167, true );
		add_image_size( 'lj-team-mobile', 250, 700, true );
		add_image_size( 'lj-team-retina', 500, 1400, true );
		add_image_size( 'lj-portfolio-p', 650, 975, true );
		add_image_size( 'lj-portfolio-l', 1250, 833, true );
		add_image_size( 'lj-collection-cover', 1024, 768, true );
	}
}
add_action( 'after_setup_theme', 'tonik_register_thumbnails' );
