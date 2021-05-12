<?php


//Add custom setting tab

add_filter('et_epanel_tab_names', 's3dm_builder_settings_panels_names');

function s3dm_builder_settings_panels_names($tabs){

	$tabs['s3dm_plugin_settings'] = _x( 'S3 Module Settings', 's3dm settings', 's3dm-s3-divi-modules' );
	return $tabs;

}

add_filter('epanel_page_maintabs', 's3dm_builder_settings_panels');

function s3dm_builder_settings_panels($panels){


	array_push($panels, 's3dm_plugin_settings');

	return $panels;

}



add_filter('et_epanel_layout_data', 'add_factfinder_settings');

function add_factfinder_settings($options){

	$wp_pages = get_pages();

	$pages = [];

	foreach($wp_pages as $wp_page):

		$pages[] = $wp_page->post_title;

	endforeach;


	$themename = 's3dm-s3-divi-modules';
	$prefix = 's3dm_';

	$settings = array (
		
			array( 
				"name" => "wrap-".$prefix."plugin_settings",
				"type" => "contenttab-wrapstart",
			),

			array( 
				"type" => "subnavtab-start",
			),
			
			array( 
				"name" => $prefix."plugin_settings_default",
				"type" => "subnav-tab",
				"desc" => esc_html__( "Default", 's3dm-s3-divi-modules') 
			),
			
			array( 
				"name" => $prefix."plugin_settings_factfinder",
				"type" => "subnav-tab",
				"desc" => esc_html__( "FACT-Finder", 's3dm-s3-divi-modules') 
			),
			
			array( 
				"type" => "subnavtab-end",
			),
			array( "name" => $prefix."plugin_settings_default",
				   "type" => "subcontent-start",
			),
			array(
				"name"              => esc_html__( "Activate FACT-Finder", 's3dm-s3-divi-modules' ),
				"id"                => $prefix."factfinder_activation",
				"std"               => "off",
				"type"              => "checkbox",
				'is_global'         => true,
				"desc"              => esc_html__(  'If deactivated the settings in the FACT-Finder Tab are ignored', 's3dm-s3-divi-modules' ),
			),

			array(
				"name"              => esc_html__( "FACT-Finder Search result Page", 's3dm-s3-divi-modules' ),
				"id"                => $prefix."factfinder_result_page",
				"type"              => "select",
				"options" 			=> $pages,
				'is_global'         => true,
				"desc"              => esc_html__(  'Set the default search result page', 's3dm-s3-divi-modules' ),
			),
			
			array( "name" => $prefix."plugin_settings_default",
				   "type" => "subcontent-end",
			),

			////////////////////////////////
			//Factfinder Settings Start
			////////////////////////////////

			array( "name" => $prefix."plugin_settings_factfinder",
				   "type" => "subcontent-start",
			),

			array(
				"name"              => esc_html__( "FACT-Finder URL", 's3dm-s3-divi-modules' ),
				"id"                => $prefix."factfinder_url",
				"std"               => "",
				"type"              => "text",
				'is_global'         => true,
				"desc"              => esc_html__('Set the FACT-Finder URL for the communication markup', 's3dm-s3-divi-modules')
			),

			

			array(
				"name"              => esc_html__( "FACT-Finder Version", 's3dm-s3-divi-modules' ),
				"id"                => $prefix."factfinder_version",
				"std"               => "ng",
				"type"              => "select",
				'options' 			=> array(
					'ng'	=> 'ng',
					'7.1'	=> '7.1',
					'7.2'	=> '7.2',
					'7.3'	=> '7.3',		
				),
				'is_global'         => true,
				"desc"              => esc_html__('Set the FACT-Finder Version for the communication markup', 's3dm-s3-divi-modules')
			),

			array(
				"name"              => esc_html__( "FACT-Finder API Version", 's3dm-s3-divi-modules' ),
				"id"                => $prefix."factfinder_api_version",
				"std"               => "v4",
				"type"              => "select",
				'options' 			=> array(
					'v2'	=> 'v2',
					'v3'	=> 'v3',
					'v4'	=> 'v4'	
				),
				'is_global'         => true,
				"desc"              => esc_html__('Set the FACT-Finder API Version for the communication markup. Only necessary if you are using FactFinder NG', 's3dm-s3-divi-modules')
			),

			array(
				"name"              => esc_html__( "FACT-Finder Channel", 's3dm-s3-divi-modules' ),
				"id"                => $prefix."factfinder_channel",
				"std"               => "",
				"type"              => "text",
				'is_global'         => true,
				"desc"              => esc_html__('Set the FACT-Finder Channel for the communication markup', 's3dm-s3-divi-modules')
			),

			array(
				"name"              => esc_html__( "Use URL Parameter", 's3dm-s3-divi-modules' ),
				"id"                => $prefix."factfinder_use_url_parameter",
				"std"               => "on",
				"type"              => "checkbox",
				'is_global'         => true,
				"desc"              => esc_html__( 'If set to false, FACT-Finder parameters are not pushed to the URL unless explicitly whitelisted. Note that this attribute has no effect when only-search-params is set.', 's3dm-s3-divi-modules' ),
			),

			array(
				"name"              => esc_html__( 'Use "only-search-params"', $themename ),
				"id"                => $prefix."factfinder_use_only_search_params",
				"std"               => "on",
				"type"              => "checkbox",
				'is_global'         => true,
				"desc"              => esc_html__( 'If set, only current search related parameters are pushed to the URL, i.e. query, filter, sort, page and productsPerPage. This can be used in conjunction with parameter-whitelist. Note that setting this attribute overrides the behavior of use-url-parameters.', $themename ),
			),

			array(
				"name"              => esc_html__( 'Use parameter whitelist', 's3dm-s3-divi-modules' ),
				"id"                => $prefix."factfinder_use_parameter_whitelist",
				"std"               => "off",
				"type"              => "checkbox",
				'is_global'         => true,
				"desc"              => esc_html__('If deactivated, the value of the FACT-Finder Parameter Whitelist are ignored in the FACT-Finder Communication Service', 's3dm-s3-divi-modules')
			),

			array(
				"name"              => esc_html__( "FACT-Finder Parameter Whitelist", 's3dm-s3-divi-modules' ),
				"id"                => $prefix."factfinder_paramater_whitelist",
				"std"               => "",
				"type"              => "text",
				'is_global'         => true,
				"desc"              => esc_html__('Comma separated values; if set, only specified parameters are pushed to the URL. E.g. parameter-whitelist="query,page".', 's3dm-s3-divi-modules')
			),

			array(
				"name"              => esc_html__( 'Use ASN (After Serach Navigation)', 's3dm-s3-divi-modules' ),
				"id"                => $prefix."factfinder_use_asn",
				"std"               => "off",
				"type"              => "checkbox",
				'is_global'         => true,
				"desc"              => esc_html__( 'Determines if the the ASN is returned. Can be set to "false" to increase performance, if the ASN is not required.', 's3dm-s3-divi-modules' ),
			),

			array(
				"name"              => esc_html__( 'Disable Cache', 's3dm-s3-divi-modules' ),
				"id"                => $prefix."factfinder_disable_cache",
				"std"               => "off",
				"type"              => "checkbox",
				'is_global'         => true,
				"desc"              => esc_html__( 'Controls the usage of search result caches. true = cache is ignored, false cache is used.', 's3dm-s3-divi-modules' ),
			),

			array(
				"name"              => esc_html__( "Use ASO(Automated Search Optimization)", 's3dm-s3-divi-modules' ),
				"id"                => $prefix."factfinder_use_aso",
				"std"               => "on",
				"type"              => "checkbox",
				'is_global'         => true,
				"desc"              => esc_html__( 'Allows activating/deactivating of automated search optimization. true = the search result is automatically optimized. false = the search result is not optimized.', 's3dm-s3-divi-modules' ),
			),

			array(
				"name"              => esc_html__( "Use browser history", 's3dm-s3-divi-modules' ),
				"id"                => $prefix."factfinder_use_browser_history",
				"std"               => "on",
				"type"              => "checkbox",
				'is_global'         => true,
				"desc"              => esc_html__( 'If set to true, the search history is pushed to the browser history, even without using URL parameter.', 's3dm-s3-divi-modules' ),
			),


			

			array( "name" => $prefix."plugin_settings_factfinder",
				   "type" => "subcontent-end",
			),

			//////////////////////////
			//Factfinder Settings End
			/////////////////////////

			array( 
				"name" => "wrap-".$prefix."plugin_settings",
				"type" => "contenttab-wrapend",
			),
	);

	return array_merge($options, $settings);

}