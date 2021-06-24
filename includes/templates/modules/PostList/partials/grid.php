<div class="s3dm_post_list_grid_container<?php if($is_product_list == 'on'):?> s3dm_post_list_product_container<?php endif;?>">
    <div class="uk-card-default">
        
        <?php if($settings['show_image'] == 'on' && $is_product_list == 'off'): ?>
            <div class="s3dm_post_list_grid_image">
                <?= $image ?>
            </div>
        <?php endif; ?>


        <div class="uk-card-body uk-position-relative">  
            <a href="<?= $permalink; ?>" class="uk-position-cover"></a>
            
            <?php if($settings['show_date'] == 'on' && $is_product_list == 'off'):?>
                <div class="s3dm_post_list_date">
                    <span>
                    <?= $this->e($date); ?>  
                    </span>
                </div>
            <?php endif; ?>
            
            <?php if($title): ?>
                <div class="s3dm_post_list_title <?= $this->e($title_size); ?>">
                    <h3>
                        <?= $this->e($title) ;?>
                    </h3>
                </div>
             <?php endif;?>
            
            
           
            <?php if($settings['show_tags'] == 'on' && $tags && $is_product_list == 'off'): ?>
                <?php foreach($tags as $tag): ?>
                    <span class="tags"><?= $tag->name ?></span>
                <?php endforeach; ?>
            <?php endif; ?>
            
            <?php if($settings['show_excerpt'] == 'on'): ?>
                <div class="s3dm_post_list_excerpt uk-margin-medium-bottom">
                    <p class="<?php if($is_product_list == 'on'): ?>uk-padding-remove<?php endif;?>"><?= $excerpt; ?></p>
                    <?php if($is_product_list == 'on'): ?>
                        <p class="uk-margin-remove"><a class="uk-text-uppercase" href="<?= $this->e($link); ?>">Mehr...</a></p>
                    <?php endif;?>
                </div>
            <?php endif; ?>


        </div>

    </div>


</div>