<?php

//converts the value of the link to a post id
//don't know why they don't do the link in raw format but who cares
function getIdFromDynamicLinkfield($et_value){

	$json = preg_replace( '/^@ET-DC@(.*?)@$/', '$1', $et_value );
	$decoded = base64_decode($json);
	$array = json_decode($decoded);

	return $array->settings->post_id;

}