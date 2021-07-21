<?php

/* Insert Fact Finder Code Snippets so we can initialize it */
if(et_get_option('s3dm_factfinder_activation') == 'on'):

    add_action('wp_head', 'header_fact_finder');    
    add_action('wp_body_open', 'insert_factfinder_communication');

endif;

function header_fact_finder(){

    ?>
    <!-- Do not change the order of the scripts to ensure all required polyfills are loaded before our script -->
    <script src="<?= plugins_url('/scripts/factfinder/dist/vendor/custom-elements-es5-adapter.js', dirname(__FILE__, 2)) ?>"></script>
    <script src="<?= plugins_url('/scripts/factfinder/dist/vendor/webcomponents-loader.js',dirname(__FILE__, 2)) ?>"></script>
    <script defer src="<?= plugins_url('/scripts/factfinder/dist/bundle.js', dirname(__FILE__, 2)) ?>"></script>
    <?php
    }; 

/*
 * 
 * Get all the relevant settings for the communication parameters
 * The search result items are configured in the module
 * 
*/


function insert_factfinder_communication(){

    $ff_url = et_get_option('s3dm_factfinder_url');
    $ff_version = et_get_option('s3dm_factfinder_version');
    $ff_channel = et_get_option('s3dm_factfinder_channel');
    $ff_api_version = et_get_option('s3dm_factfinder_api_version');
    $ff_param_whitelist = et_get_option('s3dm_factfinder_paramater_whitelist');
    $ff_use_asn = et_get_option('s3dm_factfinder_use_asn');
    $ff_use_param_whitelist = et_get_option('s3dm_factfinder_use_parameter_whitelist');
    $ff_use_url_params = et_get_option('s3dm_factfinder_use_url_parameter');
    $ff_use_aso = et_get_option('s3dm_factfinder_use_aso');
    $ff_use_browser_history = et_get_option('s3dm_factfinder_use_browser_history');
    $ff_search_result_page_title = et_get_option('s3dm_factfinder_result_page');
    $ff_disable_cache = et_get_option('s3dm_factfinder_disable_cache');

    $ff_result_page = get_page_by_title($ff_search_result_page_title);

    $api_version = (et_get_option('s3dm_factfinder_version') == 'ng') ? 'api="'.$ff_api_version.'"' : '';
    $use_url_parameters = ($ff_use_url_params == 'on') ? 'use-url-parameters="true"' : 'use-url-parameters="false"';
    $parameter_whitelist = ($ff_use_param_whitelist == 'on') ? 'parameter-whitelist="'.$ff_param_whitelist.'"' : '';
    $ff_asn = ($ff_use_asn == 'on') ? 'use-asn="true"' : '';
    $ff_aso = ($ff_use_aso == 'on') ? 'use-aso="true"' : '';
    $ff_browser_history = ($ff_use_browser_history == 'on') ? 'use-browser-history="true"' : '';
    $ff_cache = ($ff_disable_cache == 'off') ? 'disable-cache="false"' : 'disable-cache="true"';
    $ff_search_immediate = ($ff_result_page->ID == get_the_ID()) ? 'search-immediate="true"' : '';

    $ff_communication = sprintf(
        '<ff-communication url="%1$s" version="%2$s" channel="%3$s" %4$s %5$s %6$s %7$s %8$s %9$s %10$s %11$s></ff-communication>',
        $ff_url,                //%1$s
        $ff_version,            //%2$s
        $ff_channel,            //%3$s
        $api_version,           //%4$s
        $use_url_parameters,    //%5$s
        $parameter_whitelist,   //%6$s
        $ff_asn,                //%7$s
        $ff_cache,              //%8$s
        $ff_browser_history,    //%9$s
        $ff_aso,                //%10$s
        $ff_search_immediate,   //%11$s
    );

    echo $ff_communication;

}