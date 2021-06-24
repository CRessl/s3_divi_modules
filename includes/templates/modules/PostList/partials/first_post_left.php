

<?php if($this->e($first_post)): ?>
    
    <div class="uk-position-relative">
        <a href="<?= $this->e($link); ?>" class="uk-position-cover"></a>
        <div class="s3dm_post_list_headline_wrapper <?= $this->e($title_size); ?>">    
          <h3 class="s3dm_post_list_headline"><?= $this->e($title); ?></h3>
        </div>
        <div class="tags-container uk-margin-bottom">
        <?php foreach($tags as $tag): ?>
          <span class="tags"><?= $tag->name ?></span>
        <?php endforeach; ?>
        </div>
        <?= $image ?>

    </div>

<?php else: ?>
    
    <div class="uk-position-relative uk-margin-bottom s3dm_post_list_right_item">
        
        <a href="<?= $this->e($link); ?>" class="uk-position-cover"></a>    
        <div class="s3dm_post_list_headline_wrapper <?= $this->e($title_size); ?>">    
          <h3 class="s3dm_post_list_headline"><?= $this->e($title); ?></h3>
        </div>
        <div class="tags-container">
        <?php foreach($tags as $tag): ?>
          <span class="tags"><?= $tag->name ?></span>
        <?php endforeach; ?>
        </div>

    </div>

<?php endif; ?>

