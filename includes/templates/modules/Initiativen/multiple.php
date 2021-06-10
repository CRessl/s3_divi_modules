<div class="s3dm_initiatives_container uk-flex-center uk-child-width-1-<?= $this->e($columns) ?>@m uk-child-width-1-1" uk-grid uk-height-match=".s3dm_initiative_content">

    <?php foreach($initiatives as $initiative): ?>
        <?php 
            $initiative_id = $initiative->ID; 
            $thumbURL = get_the_post_thumbnail_url($initiative_id, 'medium_large');
            $link = get_field('ehi_initiative_link', $initiative_id);
        ?>
        <div class="s3dm_initiative_item">

            <?php if($link):?>

                <a href="<?= $link; ?>" class="uk-cover" target="_blank"></a>

            <?php endif;?>
            <div class="s3dm_initiative_image uk-cover-container uk-background-cover" style="background-image:url(<?= $thumbURL; ?>)">
                <img src="<?= $thumbURL; ?>" class="uk-invisible">
            </div>
            <div class="s3dm_initiative_content uk-padding uk-text-center" >
                <h4 class="s3dm_initiative_title"><?= esc_html($initiative->post_title); ?></h4>
            </div>

        </div>
    <?php endforeach; ?>

</div>