<?php

if ( ! class_exists( 'ET_Builder_Element' ) ) {
	return;
}

require_once dirname( __FILE__, 2 ) . '/includes/classes/views/TemplateEngine.php';

function s3dm_view(){
	return new TemplateEngine(dirname( __FILE__, 2 ).'/templates/modules');
}


$module_files = glob( __DIR__ . '/modules/*/*.php' );

// Load custom Divi Builder modules
foreach ( (array) $module_files as $module_file ) {
	if ( $module_file && preg_match( "/\/modules\/\b([^\/]+)\/\\1\.php$/", $module_file ) ) {
		require_once $module_file;
	}
}
