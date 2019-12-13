<?php
/**
 * Genesis Changes
 *
 * @package 	Storytelling PR
 * @author  	Kate Amann
 * @since  		1.0.0
 * @license 	GPL-2.0+
 */

// Theme Supports
add_theme_support( 'html5', array( 
	'search-form', 
	'comment-form', 
	'comment-list', 
	'gallery', 
	'caption' 
) );

add_theme_support( 'genesis-responsive-viewport' );

add_theme_support( 'genesis-footer-widgets', 3 );

add_theme_support( 'genesis-structural-wraps', array( 
	'header', 
	'menu-secondary', 
	'site-inner', 
	'footer-widgets', 
	'footer' 
) );

add_theme_support( 'genesis-menus', array( 
	'primary' => 'Primary Navigation Menu', 
	'secondary' => 'Secondary Navigation Menu', 
	'mobile' => 'Mobile Menu' 
) );

// Adds support for accessibility.
add_theme_support( 'genesis-accessibility', array(
	'404-page',
	'drop-down-menu',
	'headings',
	'rems',
	'search-form',
	'skip-links',
	'screen-reader-text',
) );

// Remove Genesis Layout Settings
remove_theme_support( 'genesis-inpost-layouts' );

// Remove Genesis Scripts Settings
add_action( 'admin_menu' , 'remove_genesis_page_post_scripts_box' );
function remove_genesis_page_post_scripts_box() {

	$types = array( 'post','page' );

	remove_meta_box( 'genesis_inpost_scripts_box', $types, 'normal' ); 
}

//* Remove Genesis in-post SEO Settings
remove_action( 'admin_menu', 'genesis_add_inpost_seo_box' );


// Remove Edit link
add_filter( 'genesis_edit_post_link', '__return_false' );

// Remove Genesis Favicon (use site icon instead)
remove_action( 'wp_head', 'genesis_load_favicon' );

// Remove Header Description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

// Removes site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Remove sidebar layouts
unregister_sidebar( 'header-right' );


add_filter( 'genesis_pre_get_option_site_layout', 'spr_set_blog_layout' );
/**
 * Apply Content Sidebar content layout to blog.
 * 
 * @return string layout ID.
 */
function spr_set_blog_layout() {
    if ( is_single() || is_archive() || is_home() ) {
        return 'content-sidebar';
    }
}


/**
 * Remove Genesis Templates
 *
 */
function storytelling_pr_remove_genesis_templates( $page_templates ) {
	unset( $page_templates['page_archive.php'] );
	unset( $page_templates['page_blog.php'] );
	return $page_templates;
}
add_filter( 'theme_page_templates', 'storytelling_pr_remove_genesis_templates' );