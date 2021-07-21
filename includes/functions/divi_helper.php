<?php

//converts the value of the link to a post id
//don't know why they don't do the link in raw format but who cares
function getIdFromDynamicLinkfield($et_value){

	$json = preg_replace( '/^@ET-DC@(.*?)@$/', '$1', $et_value );
	$decoded = base64_decode($json);
	$array = json_decode($decoded);

	return $array->settings->post_id;

}


function getCategorySlugFromId($value){

	$array =  explode(',', $value);

	$cat_id = $value;

	if(is_array($array)){
		$cat_id = $array[0];
	}


	$term = get_term_by('id', $value, 'category');

	return $term->name;


}

function getConnectionListFromTermID($value){

	$array =  explode(',', $value);
	$classes = [];

	$classNames = '';

	if(!empty($array)):
		if(is_array($array)){
			
			foreach($array as $term_id){

				$term = get_term_by('id', $term_id, 'category');
				if(is_object($term)):
					$classes[] = $term->slug;
				endif;

			}

			$classNames = implode(',', $classes);
		}else{
			
			$term = get_term_by('id', $value, 'category');
			$classNames = $term->slug;
		
		}
	endif;
	

	return $classNames;

}

function get_category_link_by_slug($slug){

	$category_object = get_category_by_slug($slug);

	$cat_link = get_category_link($category_object);

	return $cat_link;



}


function get_base_plugin_path(){


	return dirname(__FILE__, 2);


}

function s3dm_get_classname($class){

	return str_replace('S3DM_', '',get_class($class));

}

function s3dm_templatePath($class){
	return get_base_plugin_path().'/templates/modules/'.s3dm_get_classname($class);
}