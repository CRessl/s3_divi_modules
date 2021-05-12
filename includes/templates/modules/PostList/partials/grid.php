<?php

/*
 *  'title' => get_the_title($postID),
                    'image' => get_the_post_thumbnail($postID, 'full'),
                    'tags'  => get_the_tags($postID),
                    'excerpt' => strip_tags(apply_filters('the_excerpt', get_post_field('post_excerpt', $data))),
                    'date' => get_the_date($dateFormat, $postID),
                    'link' => get_the_permalink($postID),
                    'settings' => $settings
 * 
 *
*/
?>

<div>
    <div class="uk-card-default">
        
        <?php if($settings['show_image'] == 'on'): ?>
            <div class="s3dm_post_list_grid_image">
                <?= $image ?>
            </div>
        <?php endif; ?>

        <div class="uk-card-body">  
            <a href={link} class="uk-position-cover"></a>

            <?php if($settings['show_date'] == 'on'):?>
                <div class="s3dm_post_list_date">
                    <span>
                    <?= $this->e($date); ?>  
                    </span>
                </div>
            <?php endif; ?>
            
            <div class="s3dm_post_list_title">
                <h3>
                    <?= $this->e($title) ;?>
                </h3>
            </div>
            
            <?php if($settings['show_tags'] == 'on'): ?>
                <?php foreach($tags as $tag): ?>
                    <span class="tags"><?= $tag->name ?></span>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if($settings['show_excerpt'] == 'on'): ?>
                <?= $this->e($excerpt); ?>
            <?php endif; ?>

        </div>

    </div>


</div>