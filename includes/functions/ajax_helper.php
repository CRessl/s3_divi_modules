<?php 

function s3dm_reactajax_get_post_types(){

    $post_types = get_post_types([], 'objects');
    $posts = array();
    foreach ($post_types as $post_type) {
        $posts[]['label'] = $post_type->name;
        $posts[]['value'] = $post_type->labels->singular_name;
    }
    $posts = json_encode($posts);

    return $posts;


}

add_action('wp_ajax_s3dm_reactajax_get_post_types', 's3dm_reactajax_get_post_types');
add_action('wp_ajax_nopriv_s3dm_reactajax_get_post_types', 's3dm_reactajax_get_post_types');

function s3dm_reactajax_get_posts() {
     
    $queryData = array();
    
    $queryData['numberposts'] = 10;
    $queryData['post_type']   = 'post';
    $queryData['post_status'] = 'publish';

    if(isset($_POST['post_type'])){

        $queryData['post_type'] = $_POST['post_type'];

    }

    if(isset($_POST['offset'])){
        $queryData['offset'] = $_POST['offset'];
    }


    $posts = get_posts($queryData);
    $data = array();
    foreach($posts as $post){

        $data[$post->ID] = $post->post_title;

    }

              
    $post_data = json_encode($data);
          
    return $post_data;
    exit;
 }

 add_action('wp_ajax_s3dm_reactajax_get_posts', 's3dm_reactajax_get_posts');
 add_action('wp_ajax_nopriv_s3dm_reactajax_get_posts', 's3dm_reactajax_get_posts');
