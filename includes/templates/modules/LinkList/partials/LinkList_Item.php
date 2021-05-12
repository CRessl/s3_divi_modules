<style>

.s3dm_link_list_item_bubble.<?= $this->e($countClass);?>{

    top: <?= $this->e($css['top']); ?>;
    left: <?= $this->e($css['left']); ?>;

}

</style>
<div class="<?= $this->e($classes) ?>" <?= $this->e($attributes) ?> connect="<?= $this->e($connect); ?>">

    <div class="uk-position-relative">
       
        <div class="s3dm_link_list_item_content_container">

            <?php if($is_cat == 'on' && $link_category): ?>
                <a href="<?= $this->e($category_link); ?>" class="uk-position-cover"></a>
            <?php else: ?>  
                <a href="<?= $this->e($link); ?>" class="uk-position-cover"></a>
            <?php endif; ?>


            <?php if($use_image == 'on'): ?>
                <div class="s3dm_link_list_item_image">
                    <?= $image ?>
                </div>
            <?php endif; ?>
            
            
            <div class="s3dm_link_list_item_content">
                <p><?= $this->e($title) ?></p>
            </div>
        </div>
    </div>

</div>