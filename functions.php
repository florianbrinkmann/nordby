<?php
function nordby_textdomain() {
    load_child_theme_textdomain( 'nordby', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'nordby_textdomain' );
/**
 * Enqueues scripts and styles for front-end.
 *
 */
function nordby_styles() {
	global $wp_styles;
	wp_enqueue_style( 'nordby-style',  get_stylesheet_directory_uri() . '/css/child.css', array('fanoe-style'), false );
    
    wp_enqueue_style( 'fanoe-style', get_template_directory_uri() . '/style.css' );

	$show_sidebar = get_theme_mod( 'sidebar_visibility' ); 
	if($show_sidebar =='blog_view'){ 
		if(is_single()){
			wp_dequeue_style('nordby-style');
		}
	}elseif($show_sidebar == 'single_view'){
		if(!is_single()){
			wp_dequeue_style('nordby-style');
		}
	}
}
add_action( 'wp_enqueue_scripts', 'nordby_styles' );

function nordby_customize_register( $wp_customize ) {
	$backgrounds = array();
	$backgrounds[] = array(
		'slug'=>'sidebar_visibility', 
		'default' => 'always',
		'label' => __( 'Choose whether the Sidebar is always visible (standard) or only in the blog view or in the single view.', 'nordby' )
	);
	foreach( $backgrounds as $background ) {
		// SETTINGS
		$wp_customize->add_setting(
			$background['slug'], array(
				'default' => $background['default'],
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'nordby_sanitize_radio'
			)
		);
		// CONTROLS
		$wp_customize->add_control($background['slug'], array(
			'label'      => $background['label'],
			'section'    => 'content',
			'settings'   => $background['slug'],
			'type'       => 'radio',
			'choices'    => array(
				'always'   => __('Always', 'nordby'),
				'blog_view' => __('Only in the blog view', 'nordby'),
				'single_view' => __('Only in the single view', 'nordby'),
			),
		));
	}
}
add_action( 'customize_register', 'nordby_customize_register' );

function nordby_sanitize_radio( $value ) {
	return $value;
}

// Custom CSS for Link Colors
function nordby_insert_custom(){
	$text_color   = get_header_textcolor();
	$header_image = get_header_image();
	$design_color = get_theme_mod('design_color');
	?>
    <style>@media screen and (min-width:1000px){.js #sidebar{border-color:<?php echo $design_color ; ?>}}
    <?php
} 
add_action('wp_head', 'nordby_insert_custom');