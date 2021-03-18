<ul class="uk-list" style="list-style-type: none;">

<?php foreach($templateData['posts'] as $viewData): ?>

    <li class="uk-position-relative">
        <?php if($viewData['link']): ?>
        <a href="<?= $viewData['link'] ?>" class="uk-position-cover"></a>
        <?php endif;?>

        <?php if($templateData['settings']['image_position'] == 'top'): ?>
            <?php if($templateData['settings']['show_image'] == 'on'):?>
                <div class="s3dm_post_list_image">
                        <?= $viewData['image'] ?>
                </div>
            <?php endif; ?>   
        <?php endif;?>

        <?php if($templateData['settings']['show_date'] == 'on'):?>
            
            <div class="s3dm_post_list_date">
                <span>
                    <?= $viewData['date']; ?>    
                </span>
            </div>
            
        <?php endif; ?>   

        <div class="s3dm_post_list_title">
            <h3>
                <?= $viewData['title']; ?>
            </h3>
        </div>

        <?php if($templateData['settings']['show_tags'] == 'on'): ?>
            <?php if($viewData['tags']): ?>
                <div class="s3dm_post_list_tags">
                    <?= $viewData['tags']; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if($templateData['settings']['image_position'] == 'between'): ?>
            <?php if($templateData['settings']['show_image'] == 'on'):?>
                <div class="s3dm_post_list_image">
                        <?= $viewData['image']; ?>
                </div>
            <?php endif; ?>   
        <?php endif;?>

        <?php if($templateData['settings']['show_excerpt'] == 'on'): ?>
        <div class="s3dm_post_list_excerpt">
            <p>
                <?= $viewData['excerpt']; ?>
            </p>
        </div>
        <?php endif; ?>

        <?php if($templateData['settings']['image_position'] == 'bottom'): ?>
            <?php if($templateData['settings']['show_image'] == 'on'): ?>
                <div class="s3dm_post_list_image">
                        <?= $viewData['image']; ?>
                </div>
            <?php endif; ?>   
        <?php endif;?>
    
    </li>

<?php endforeach; ?>
</ul>