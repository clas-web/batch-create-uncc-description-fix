<?php
/*
Plugin Name: Batch Create UNCC - Description Fix
Plugin URI: 
Description: Overrides two plugins that overwrite the description added in Batch Create UNCC.
The two plugins are "New Blog Templates" and "New Blog Defaults (CETS)."
Author: Crystal Barton
Author URI: 
Version: 1.0.0
Network: true
Text Domain: batch_create, blogtemplates, wpmu-new-blog-defaults
*/


//========================================================================================
//========================================================================== filters =====

// Blog Templates
add_filter( 'blog_template_exclude_settings', 'batch_create_uncc_fix_blogtemplates' );

// New Blog Defaults (CETS)
add_filter( 'site_option_cets_blog_defaults_options', 'batch_create_uncc_fix_new_blog_defaults' );
add_filter( 'default_site_option_cets_blog_defaults_options', 'batch_create_uncc_fix_new_blog_defaults' );


//========================================================================================
//======================================================================== functions =====

if( !function_exists('batch_create_uncc_fix_blogtemplates') ):
function batch_create_uncc_fix_blogtemplates( $exclude_settings )
{
	$exclude_settings .= " AND `option_name` != 'blogdescription'";
	return $exclude_settings;
}
endif;


if( !function_exists('batch_create_uncc_fix_new_blog_defaults') ):
function batch_create_uncc_fix_new_blog_defaults( $value )
{
	if( isset($value['blogdescription']) ) unset($value['blogdescription']);
	return $value;
}
endif;

