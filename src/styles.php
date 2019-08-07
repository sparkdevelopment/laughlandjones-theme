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
		wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/public/css/app.css' );
		wp_enqueue_style( 'swiper', get_template_directory_uri() . '/node_modules/swiper/dist/css/swiper.min.css' );

		if ( is_post_type_archive( 'fabric' ) || is_tax( 'fabric_collection' ) || is_singular( 'fabric' ) ) {
			wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/node_modules/bootstrap/dist/css/bootstrap.css', [ 'theme-style' ] );
			wp_enqueue_style( 'bootstrap-multiselect', get_template_directory_uri() . '/node_modules/bootstrap-multiselect/dist/css/bootstrap-multiselect.css' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'tonik_register_styles' );
