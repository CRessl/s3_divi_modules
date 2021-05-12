<?php
/*
Plugin Name: S3 Divi Modules
Plugin URI:  
Description: Some Custom Modules based on uikit
Version:     1.1.6
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
	require_once plugin_dir_path( __FILE__ ) . 'includes/settings_config.php';
	require_once plugin_dir_path( __FILE__ ) . 'includes/factfinder_functions.php';
	
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

function get_full_size_image_url($src){

	$fullSizeUrl = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $src );
	return $fullSizeUrl;

}


function s3dm_get_image_title_from_url($src){

	$full_Size_url = get_full_size_image_url($src);
	$imageID = attachment_url_to_postid($full_Size_url);

	$image_title = get_the_title($imageID);

	return $image_title;

}

function s3dm_get_image_alt_text_from_url($src){

	$full_Size_url = get_full_size_image_url($src);
	$imageID = attachment_url_to_postid($full_Size_url);

	$image_alt = get_post_meta( $imageID, '_wp_attachment_image_alt', true);

	return $image_alt;
}

