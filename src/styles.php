<?php
/**
 * ------------------------------------------------------------------------
 * Theme's CSS Assets
 * ------------------------------------------------------------------------
 * This file is for registering your theme's stylesheets. In here you
 * should also deregister all unwanted assets which can be
 * shipped with various third-parity plugins.
 */

if ( ! function_exists( 'tonik_register_styles' ) ) {
	/**
	 * Registers theme's CSS styles.
	 *
	 * @todo Change function prefix to your textdomain.
	 * @todo Update prefix in the hook function and if statement.
	 *
	 * @return void
	 */
	function tonik_register_styles() {
		// Get version from Heroku or default to manual versioning
		$version = getenv( 'SOURCE_VERSION' );

		wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/public/css/app.css', [], $version );
		wp_enqueue_style( 'swiper', get_template_directory_uri() . '/node_modules/swiper/dist/css/swiper.min.css', [], $version );

		if ( is_post_type_archive( 'fabric' ) || is_tax( 'fabric_collection' ) || is_singular( 'fabric' ) || is_page_template( 'template-basket.php' ) ) {
			wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/node_modules/bootstrap/dist/css/bootstrap.css', [ 'theme-style' ], $version );
			wp_enqueue_style( 'bootstrap-multiselect', get_template_directory_uri() . '/node_modules/bootstrap-multiselect/dist/css/bootstrap-multiselect.css', [], $version );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'tonik_register_styles' );
