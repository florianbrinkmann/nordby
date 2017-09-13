<?php
/**
 * Customizer related functions.
 *
 * @version 1.1.0
 *
 * @package Nordby
 */

function nordby_customize_register( $wp_customize ) {
	$backgrounds   = array();
	$backgrounds[] = array(
		'slug'    => 'sidebar_visibility',
		'default' => 'always',
		'label'   => __( 'Choose whether the Sidebar is always visible (standard) or only in the blog view or in the single view.', 'nordby' )
	);
	foreach ( $backgrounds as $background ) {
		// SETTINGS
		$wp_customize->add_setting(
			$background['slug'], array(
				'default'           => $background['default'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'nordby_sanitize_radio'
			)
		);
		// CONTROLS
		$wp_customize->add_control( $background['slug'], array(
			'label'    => $background['label'],
			'section'  => 'content',
			'settings' => $background['slug'],
			'type'     => 'radio',
			'choices'  => array(
				'always'      => __( 'Always', 'nordby' ),
				'blog_view'   => __( 'Only in the blog view', 'nordby' ),
				'single_view' => __( 'Only in the single view', 'nordby' ),
			),
		) );
	}
}
