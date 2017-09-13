<?php
/**
 * Functions that are not directly called from template files
 * and cannot be grouped into another file.
 *
 * @version 1.1.0
 *
 * @package Nordby
 */

function nordby_load_translation() {
	if ( ( ! defined( 'DOING_AJAX' ) && ! 'DOING_AJAX' ) || ! nordby_is_login_page() || ! nordby_is_wp_comments_post() ) {
		load_theme_textdomain( 'nordby' );
	} // End if().
}

if ( ! function_exists( 'nordby_is_login_page' ) ) {
	/**
	 * Check if we are on the login page
	 *
	 * @return bool true if on login page, otherwise false.
	 */
	function nordby_is_login_page() {
		return in_array( $GLOBALS['pagenow'], [ 'wp-login.php', 'wp-register.php' ], true );
	}
} // End if().

if ( ! function_exists( 'nordby_is_wp_comments_post' ) ) {
	/**
	 * Check if we are on the wp-comments-post.php
	 *
	 * @return bool true if on wp-comments-post.php, otherwise false.
	 */
	function nordby_is_wp_comments_post() {
		return in_array( $GLOBALS['pagenow'], [ 'wp-comments-post.php' ], true );
	}
} // End if().

/**
 * Enqueues styles and scripts.
 */
function nordby_styles() {
	wp_enqueue_style( 'nordby-style', get_theme_file_uri( '/assets/css/nordby.css' ), [ 'fanoe-style' ], false );

	/**
	 * Check if SCRIPT_DEBUG is defined and enabled.
	 */
	if ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) {
		$suffix = '.css';
	} else {
		$suffix = '.min.css';
	}

	wp_enqueue_style( 'fanoe-style', get_parent_theme_file_uri( "assets/css/fanoe$suffix" ) );

	$show_sidebar = get_theme_mod( 'sidebar_visibility' );
	if ( $show_sidebar == 'blog_view' ) {
		if ( is_single() ) {
			wp_dequeue_style( 'nordby-style' );
		}
	} elseif ( $show_sidebar == 'single_view' ) {
		if ( ! is_single() ) {
			wp_dequeue_style( 'nordby-style' );
		}
	}
}
