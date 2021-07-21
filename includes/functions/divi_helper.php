<?php

add_filter('et_pb_all_fields_unprocessed_et_pb_text', 's3dm_add_title_size_selection', 10, 1);


function s3dm_add_title_size_selection($fields_unprocessed){

	$fields = [];

	$fields = array(
		'title_size'              => array(
			'label'            => esc_html__( 'Title size', 's3dm-s3-divi-modules' ),
			'type'             => 'select',
			'option_category'  => 'basic_option',
			'options'          => array(
				'ehi-h1'  => et_builder_i18n( 'H1' ),
				'ehi-h2' => et_builder_i18n( 'H2' ),
				'ehi-h3'  => et_builder_i18n( 'H3' ),
				'ehi-h4' => et_builder_i18n( 'H4' ),
			),
			'default_on_front' => 'ehi-h3',
			'toggle_slug'      => 'main_content',
			'description'      => esc_html__( 'This setting will turn on and off the featured image in the slider.', 's3dm-s3-divi-modules' ),
			'mobile_options'   => true,
		),
	);
	$all_fields = array_merge($fields, $fields_unprocessed);
	return $all_fields;

}



function s3dm_add_title_size_class($props, $attrs, $render_slug){


	if(isset($props['title_size']) && $render_slug === 'et_pb_text'){

		//get classes array to check for value
		$classesArray = explode(' ', $props['module_class']);

		if(!in_array($props['title_size'], $classesArray)){
			$props['module_class'] = implode(' ',$classesArray).' '.$props['title_size'];
		}

		
	}

	return $props;

};


add_filter('et_pb_module_shortcode_attributes', 's3dm_add_title_size_class', 9, 3);

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