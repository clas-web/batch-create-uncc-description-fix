<?php
/*
Plugin Name: Batch Create UNCC - Description Fix
Plugin URI: https://github.com/clas-web/batch-create-uncc-description-fix
Description: Overrides two plugins that overwrite the description added in Batch Create UNCC.
The two plugins are "New Blog Templates" and "New Blog Defaults (CETS)."
Author: Crystal Barton
Author URI: https://www.linkedin.com/in/crystalbarton
Version: 1.0.0
Network: true
*/


// Blog Templates
add_filter( 'blog_template_exclude_settings', 'batch_create_uncc_fix_blogtemplates' );

// New Blog Defaults (CETS)
add_filter( 'site_option_cets_blog_defaults_options', 'batch_create_uncc_fix_new_blog_defaults' );
add_filter( 'default_site_option_cets_blog_defaults_options', 'batch_create_uncc_fix_new_blog_defaults' );


/**
 * When using the Blog Templates plugin:
 * Add blog description to the excluded options when overwriting for the blog template.
 * @param  string  $exclude_settings  The current excluded settings SQL.
 * @return  string  The modified excluded settings SQL.
 */
if( !function_exists('batch_create_uncc_fix_blogtemplates') ):
function batch_create_uncc_fix_blogtemplates( $exclude_settings )
{
	$exclude_settings .= " AND `option_name` != 'blogdescription'";
	return $exclude_settings;
}
endif;


/**
 * When using the New Blog Defaults (CETS) plugin:
 * Remove the blog description from the values that are saved to the options.
 * @param  Array  $value  The current values.
 * @return  Array  The modified values without the blog description.
 */
if( !function_exists('batch_create_uncc_fix_new_blog_defaults') ):
function batch_create_uncc_fix_new_blog_defaults( $value )
{
	if( isset($value['blogdescription']) ) unset($value['blogdescription']);
	return $value;
}
endif;

