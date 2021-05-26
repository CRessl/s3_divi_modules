<?php 

$initiativeID = $initiatives->ID;
$thumbURL = get_the_post_thumbnail_url($initiativeID, 'medium_large');


?>


<div class="s3dm_initiative uk-grid-match uk-child-width-1-2@m uk-child-width-1-1 uk-grid-collapse" uk-grid>
        <div class="s3dm_initiative_content_container uk-flex-first@m" >
            <div class="s3dm_initiative_content uk-padding">
                <h3 class="s3dm_initiative_content_title">
                    <?= $this->e($initiatives->post_title); ?>
                </h3>
                <p>
                    <?= $this->e($initiatives->post_content); ?>
                </p>
            </div>
        </div>
        <div class="s3dm_initiative_image uk-background-cover uk-flex-first uk-flex-last@m" style="background-image:url(<?= $thumbURL; ?>);">
            <img src="<?= $thumbURL; ?>" class="uk-invisible">
        </div>
</div>