

<?php if($this->e($first_post)): ?>
    
    <div class="uk-position-relative">
        <a href="<?= $this->e($link); ?>" class="uk-position-cover"></a>    
        <h4 class="s3dm_post_list_headline"><?= $this->e($title); ?></h4>
        
        <div class="tags-container uk-margin-bottom">
        <?php foreach($tags as $tag): ?>
          <span class="tags"><?= $tag->name ?></span>
        <?php endforeach; ?>
        </div>
        <?= $image ?>

    </div>

<?php else: ?>
    
    <div class="uk-position-relative">
        
        <a href="<?= $this->e($link); ?>" class="uk-position-cover"></a>    
        <h4 class="s3dm_post_list_headline"><?= $this->e($title); ?></h4>
        <div class="tags-container uk-margin-bottom">
        <?php foreach($tags as $tag): ?>
          <span class="tags"><?= $tag->name ?></span>
        <?php endforeach; ?>
        </div>

    </div>

<?php endif; ?>

