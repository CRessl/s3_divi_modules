<?php
/*
Plugin Name: S3 Divi Modules
Plugin URI:  
Description: Some Custom Modules based on uikit
Version:     1.1.0
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
	
	load_assets();
}
add_action( 'divi_extensions_init', 's3dm_initialize_extension' );

function load_assets(){

	wp_enqueue_style( 'uikit-v3', plugins_url('/assets/css/uikit.min.css', __FILE__) );

	wp_enqueue_script( 'uikit-v3', plugins_url('/assets/js/uikit.min.js', __FILE__), array(), false, false );
	wp_enqueue_script('gsap', plugins_url('/assets/js/gsap.min.js', __FILE__), array(), true,  false);

}

endif;

//maybe deprecated later on as i implement my template engine

function s3dm_get_template_part($module, $name, $data = array()){

	$templateData = $data;
	include_once plugin_dir_path( __FILE__ ).'templates/'.$module.'/'.$name.'.php';

}
