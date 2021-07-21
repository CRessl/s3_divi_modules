<?php

if ( ! class_exists( 'ET_Builder_Element' ) ) {
	return;
}

require dirname( __FILE__, 2 ) . '/vendor/autoload.php';

function Plates($path = ''){
	if(!$path){
		return new League\Plates\Engine(dirname( __FILE__, 1 ).'/templates');
	}
	
	return new League\Plates\Engine($path);
	
}

$module_files = glob( __DIR__ . '/modules/*/*.php' );

// Load custom Divi Builder modules
foreach ( (array) $module_files as $module_file ) {
	if ( $module_file && preg_match( "/\/modules\/\b([^\/]+)\/\\1\.php$/", $module_file ) ) {
		require_once $module_file;
	}
}



//some comment here
