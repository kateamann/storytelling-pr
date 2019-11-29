<?php
/**
 * Storytelling PR.
 *
 * This file adds functions to the Storytelling PR Theme.
 *
 * @package 	Storytelling PR
 * @author  	Kate Amann
 * @since  		1.0.0
 * @license 	GPL-2.0+
 */


/**
 * Theme setup.
 *
 * Attach all of the site-wide functions to the correct hooks and filters. All
 * the functions themselves are defined below this setup function.
 *
 * @since 1.0.0
 */
function storytelling_pr_child_theme_setup() {

	// Defines the child theme
	$child_theme = wp_get_theme();
	
	define( 'CHILD_THEME_NAME', $child_theme->get( 'Name' ) );
	define( 'CHILD_THEME_URL', $child_theme->get( 'ThemeURI' ) );
	define( 'CHILD_THEME_VERSION', $child_theme->get( 'Version' ) );
	define( 'CHILD_TEXT_DOMAIN', $child_theme->get( 'TextDomain' ) );

	// Includes
	include_once( get_stylesheet_directory() . '/inc/genesis-changes.php' );
	include_once( get_stylesheet_directory() . '/inc/helper-functions.php' );
	include_once( get_stylesheet_directory() . '/inc/custom-login.php' );
	include_once( get_stylesheet_directory() . '/inc/navigation.php' );
	include_once( get_stylesheet_directory() . '/inc/custom-logo.php' );

	// Editor Styles
	// add_theme_support( 'editor-styles' );
	// add_editor_style( 'assets/css/editor-style.css' );

	// Image Sizes
	// add_image_size( 'storytelling_pr_featured', 400, 100, true );

	// Gutenberg

	// -- Wide Images
	add_theme_support( 'align-wide' );

	// -- Make media embeds responsive.
	add_theme_support( 'responsive-embeds' );

	// -- Disable custom font sizes
	add_theme_support( 'disable-custom-font-sizes' );

	// -- Editor Font Styles
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name'      => __( 'Small', CHILD_TEXT_DOMAIN ),
			'shortName' => __( 'S', CHILD_TEXT_DOMAIN ),
			'size'      => 12,
			'slug'      => 'small',
		),
		array(
			'name'      => __( 'Normal', CHILD_TEXT_DOMAIN ),
			'shortName' => __( 'M', CHILD_TEXT_DOMAIN ),
			'size'      => 16,
			'slug'      => 'normal',
		),
		array(
			'name'      => __( 'Large', CHILD_TEXT_DOMAIN ),
			'shortName' => __( 'L', CHILD_TEXT_DOMAIN ),
			'size'      => 20,
			'slug'      => 'large',
		),
		array(
			'name'      => __( 'Larger', CHILD_TEXT_DOMAIN ),
			'shortName' => __( 'XL', CHILD_TEXT_DOMAIN ),
			'size'      => 24,
			'slug'      => 'larger',
		),
	) );

	// -- Disable Custom Colors
	add_theme_support( 'disable-custom-colors' );

	// -- Editor Color Palette
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Lightest gray', CHILD_TEXT_DOMAIN ),
			'slug'  => 'light-gray',
			'color' => '#f5f5f5',
		),
		array(
			'name'  => __( 'Light gray', CHILD_TEXT_DOMAIN ),
			'slug'  => 'light-gray',
			'color' => '#eeeeee',
		),
		array(
			'name'  => __( 'Medium gray', CHILD_TEXT_DOMAIN ),
			'slug'  => 'medium-gray',
			'color' => '#999999',
		),
		array(
			'name'  => __( 'Dark gray', CHILD_TEXT_DOMAIN ),
			'slug'  => 'dark-gray',
			'color' => '#333333',
		),
	) );

}
add_action( 'genesis_setup', 'storytelling_pr_child_theme_setup', 15 );

//* Replace default style sheet
add_filter( 'stylesheet_uri', 'replace_default_style_sheet', 10, 2 );
function replace_default_style_sheet() {
	return get_stylesheet_directory_uri() . '/style.min.css';
}


/**
 * Global enqueues
 *
 * @since  1.0.0
 * @global array $wp_styles
 */
function storytelling_pr_global_enqueues() {

	// css
	wp_enqueue_style( CHILD_TEXT_DOMAIN . '-fonts', storytelling_pr_theme_fonts_url() );
    //wp_enqueue_style( CHILD_TEXT_DOMAIN . '-style', get_stylesheet_directory_uri() . '/style.css', array(), CHILD_THEME_VERSION );
    wp_enqueue_style( CHILD_TEXT_DOMAIN . '-fontawesome', '//use.fontawesome.com/releases/v5.7.2/css/all.css', array(), CHILD_THEME_VERSION );
    wp_enqueue_style( 'dashicons' );

	// Move jQuery to footer
	// if( ! is_admin() ) {
	// 	wp_deregister_script( 'jquery' );
	// 	wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
	// 	wp_enqueue_script( 'jquery' );
	// }
	
	// javascript
	// $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	// wp_enqueue_script(
	// 	CHILD_TEXT_DOMAIN . '-responsive-menu',
	// 	get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js",
	// 	array( 'jquery' ),
	// 	CHILD_THEME_VERSION,
	// 	true
	// );

	// wp_localize_script(
	// 	CHILD_TEXT_DOMAIN . '-responsive-menu',
	// 	'genesis_responsive_menu',
	// 	responsive_menu_settings()
	// );

}
add_action( 'wp_enqueue_scripts', 'storytelling_pr_global_enqueues' );



/**
 * Gutenberg scripts and styles
 *
 */
function storytelling_pr_gutenberg_scripts() {
	wp_enqueue_style( CHILD_TEXT_DOMAIN . '-fonts', storytelling_pr_theme_fonts_url() );
}
add_action( 'enqueue_block_editor_assets', 'storytelling_pr_gutenberg_scripts' );


/**
 * Theme Fonts URL
 *
 */
function storytelling_pr_theme_fonts_url() {
	$font_families = apply_filters( 'storytelling_pr_theme_fonts', array( 'Libre+Franklin:400,400i,700,700i' ) );
	$query_args = array(
		'family' => implode( '|', $font_families ),
		'subset' => 'latin,latin-ext',
	);
	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	return esc_url_raw( $fonts_url );
}




/**
 * Sets localization (do not remove).
 *
 * @since 1.0.0
 */
function storytelling_pr_localization_setup() {

	load_child_theme_textdomain( CHILD_TEXT_DOMAIN, get_stylesheet_directory() . '/languages' );

}
add_action( 'after_setup_theme', 'storytelling_pr_localization_setup' );