<?php
/**
 * ------------------------------------------------------------------------
 * Theme's Includes
 * ------------------------------------------------------------------------
 * The `function.php` file is should responsible only for including theme's
 * components. Your theme custom logic should be distributed
 * across separate files in the `/src` directory.
 */

// Bootstrap CMB2
if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

require_once 'src/styles.php';
require_once 'src/scripts.php';

require_once 'src/admin.php';
require_once 'src/navs.php';
require_once 'src/supports.php';
require_once 'src/post-types.php';
require_once 'src/thumbnails.php';
require_once 'src/taxonomies.php';
