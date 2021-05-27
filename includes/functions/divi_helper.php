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


	if(is_array($array)){
		
		foreach($array as $term_id){

			$term = get_term_by('id', $term_id, 'category');
			$classes[] = $term->slug;

		}

		$classNames = implode(',', $classes);
	}else{
		
		$term = get_term_by('id', $value, 'category');
		$classNames = $term->slug;
	
	}



	

	return $classNames;

}

function get_category_link_by_slug($slug){

	$category_object = get_category_by_slug($slug);

	$cat_link = get_category_link($category_object);

	return $cat_link;



}