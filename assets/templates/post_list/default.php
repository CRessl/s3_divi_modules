<ul class="uk-list">

<?php foreach($templateData as $viewData): ?>

    <li>
        <?php if($image_position == 'top'): ?>
            <?php if($show_image == 'on'):?>
                <div class="s3dm_post_list_image">
                        <?= $viewData['image'] ?>
                </div>
            <?php endif; ?>   
        <?php endif;?>

        <?php if($show_date == 'on'):?>
            
            <div class="s3dm_post_list_date">
                <span>
                    <?= $viewData['date'] ?>    
                </span>
            </div>
            
        <?php endif; ?>   

        <div class="s3dm_post_list_title">
            <h3>
                <?= $viewData['title'] ?>
            </h3>
        </div>

        <?php if($image_position == 'between'): ?>
            <?php if($show_image == 'on'):?>
                <div class="s3dm_post_list_image">
                        <?= $viewData['image'] ?>
                </div>
            <?php endif; ?>   
        <?php endif;?>

        <?php if($show_excerpt == 'on'): ?>
        <div class="s3dm_post_list_excerpt">
            <p>
                <?= $viewData['excerpt'] ?>
            </p>
        </div>
        <?php endif; ?>

        <?php if($image_position == 'bottom'): ?>
            <?php if($show_image == 'on'): ?>
                <div class="s3dm_post_list_image">
                        <?= $viewData['image'] ?>
                </div>
            <?php endif; ?>   
        <?php endif;?>
    
    </li>

<?php endforeach; ?>
</ul>