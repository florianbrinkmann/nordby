<?php
/**
 * Functions that are not directly called from template files
 * and cannot be grouped into another file.
 *
 * @version 1.1.0
 *
 * @package Nordby
 */

/**
 * Load the translation.
 */
function nordby_load_translation() {
	if ( ( ! defined( 'DOING_AJAX' ) && ! 'DOING_AJAX' ) || ! nordby_is_login_page() || ! nordby_is_wp_comments_post() ) {
		load_theme_textdomain( 'nordby' );
	} // End if().
}

/**
 * Check if we are on the login page
 *
 * @return bool true if on login page, otherwise false.
 */
function nordby_is_login_page() {
	return in_array( $GLOBALS['pagenow'], [ 'wp-login.php', 'wp-register.php' ], true );
}

/**
 * Check if we are on the wp-comments-post.php
 *
 * @return bool true if on wp-comments-post.php, otherwise false.
 */
function nordby_is_wp_comments_post() {
	return in_array( $GLOBALS['pagenow'], [ 'wp-comments-post.php' ], true );
}

/**
 * Enqueues styles and scripts.
 */
function nordby_styles() {

	/**
	 * Check if SCRIPT_DEBUG is defined and enabled.
	 */
	if ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) {
		$suffix = '.css';
	} else {
		$suffix = '.min.css';
	}

	/**
	 * Check for RTL language and enqueue the right style.
	 */
	if ( is_rtl() ) {
		wp_enqueue_style( 'nordby-style', get_theme_file_uri( "assets/css/nordby-rtl$suffix" ), [ 'fanoe-style' ] );
	} else {
		wp_enqueue_style( 'nordby-style', get_theme_file_uri( "assets/css/nordby$suffix" ), [ 'fanoe-style' ] );
	} // End if().
}
