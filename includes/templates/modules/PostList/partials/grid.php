<div class="s3dm_post_list_grid_container<?php if($is_product_list == 'on'):?> s3dm_post_list_product_container<?php endif;?>">
    <div class="uk-card-default">
        
        <?php if($settings['show_image'] == 'on'): ?>
            <div class="s3dm_post_list_grid_image">
                <?= $item['image'] ?>
            </div>
        <?php endif; ?>


        <div class="uk-card-body uk-position-relative">  
            <a href="<?= $item['link']; ?>" class="uk-position-cover"></a>
            
            <?php if($settings['show_date'] == 'on'):?>
                <div class="s3dm_post_list_date">
                    <span>
                    <?= $this->e($item['date']); ?>  
                    </span>
                </div>
            <?php endif; ?>
            
            <?php if($item['title']): ?>
                <div class="s3dm_post_list_title <?= $this->e($settings['title_size']); ?>">
                    <h3>
                        <?= $this->e($item['title']) ;?>
                    </h3>
                </div>
             <?php endif;?>
            
            
           
            <?php if($settings['show_tags'] == 'on' && $item['tags']): ?>
                
                <?= $item['tags']; ?> 
                
            <?php endif; ?>
            
            <?php if($settings['show_excerpt'] == 'on'): ?>
                <div class="s3dm_post_list_excerpt uk-margin-medium-bottom">
                    <p><?= $item['excerpt']; ?></p>
                </div>
            <?php endif; ?>


        </div>

    </div>


</div>