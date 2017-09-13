<?php
/**
 * All add_action() calls.
 *
 * @version 1.1.0
 *
 * @package Nordby
 */

/**
 * Load translation.
 */
add_action( 'after_setup_theme', 'nordby_load_translation' );

/**
 * Enqueue styles.
 */
add_action( 'wp_enqueue_scripts', 'nordby_styles' );

/**
 * Register customizer setting.
 */
add_action( 'customize_register', 'nordby_customize_register' );
