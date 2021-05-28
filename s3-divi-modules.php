<?php
/*
Plugin Name: S3 Divi Modules
Plugin URI:  
Description: Some Custom Modules based on uikit
Version:     1.2.1
Author:      S3 Advertising
Author URI:  https://s3-advertising.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: s3dm-s3-divi-modules
Domain Path: /languages


S3 Divi Modules is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

S3 Divi Modules is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with S3 Divi Modules. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/


if ( ! function_exists( 's3dm_initialize_extension' ) ):
/**
 * Creates the extension's main class instance.
 *
 * @since 1.0.0
 */
function s3dm_initialize_extension() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/S3DiviModules.php';
	s3dm_load_settings_files();
	s3dm_load_helper_functions();
	
	//add our own image sizes
	s3dm_add_image_sizes();

	//load our own assets
	s3dm_load_assets();

}
add_action( 'divi_extensions_init', 's3dm_initialize_extension' );

function s3dm_load_assets(){

	wp_enqueue_style( 'uikit-v3', plugins_url('/assets/css/uikit.min.css', __FILE__) );
	wp_enqueue_style( 'factfinder', plugins_url('/assets/css/factfinder.css', __FILE__) );
	wp_enqueue_style( 'splider', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@2.4.21/dist/css/themes/splide-default.min.css');

	wp_enqueue_script( 'uikit-v3', plugins_url('/assets/js/uikit.min.js', __FILE__), array('jquery'), false, false );
	
	wp_enqueue_script( 'splider' , 'https://cdn.jsdelivr.net/npm/@splidejs/splide@2.4.21/dist/js/splide.min.js', false, false);
	wp_enqueue_script( 'modules', plugins_url('/assets/js/modules.js', __FILE__), array('jquery'), false, false );
	
	// for ze cool animations
	wp_enqueue_script('gsap', plugins_url('/assets/js/gsap.min.js', __FILE__), array(), true,  false);

}

endif;

function s3dm_add_image_sizes(){

	add_image_size('link_list_bubble_image', 300, 9999, true, false);

}


function s3dm_load_helper_functions(){

	$functions = plugin_dir_path( __FILE__ ).'includes/functions/*.php';

	foreach (glob($functions) as $function)
	{
		require_once $function;
	}

}

function s3dm_load_settings_files(){

	$settings = plugin_dir_path( __FILE__ ).'includes/config/*.php';

	foreach (glob($settings) as $setting)
	{
		require_once $setting;
	}

}




