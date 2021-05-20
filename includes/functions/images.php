<?php

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


function get_full_size_image_url($src){

	$fullSizeUrl = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $src );
	return $fullSizeUrl;

}