
<li class="uk-position-relative uk-margin">
    <?php if($this->e($item['link'])): ?>
    <a href="<?= $this->e($link) ?>" class="uk-position-cover"></a>
    <?php endif;?>

    <?php if($this->e($settings['image_position']) == 'top'): ?>
        <?php if($this->e($settings['show_image']) == 'on'):?>
            <div class="s3dm_post_list_image">
                    <?= $item['image']; ?>
            </div>
        <?php endif; ?>   
    <?php endif;?>

    <?php if($this->e($settings['show_date']) == 'on'): ?>
        <div class="s3dm_post_list_date">
            <span>
            <?= $this->e($item['date']); ?>   
            </span>
        </div>
    <?php endif;?>
  

    <div class="s3dm_post_list_title <?= $this->e($settings['title_size']); ?>">
        <h3>
            <?= $this->e($item['title']); ?>
        </h3>
    </div>

    <?php if($this->e($settings['show_tags']) == 'on'): ?>
        <?php if($item['tags']): ?>
            <div class="s3dm_post_list_tags">
                <?= $item['tags']; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if($this->e($settings['image_position']) == 'between'): ?>
        <?php if($this->e($settings['show_image']) == 'on'):?>
            <div class="s3dm_post_list_image">
                    <?= $item['image']; ?>
            </div>
        <?php endif; ?>   
    <?php endif;?>

    <?php if($this->e($settings['show_excerpt']) == 'on'): ?>
        <?php if($this->e($item['excerpt'])): ?>
            <div class="s3dm_post_list_excerpt">
                <p>
                    <?= $this->e($item['excerpt']); ?>
                </p>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if($this->e($settings['image_position']) == 'bottom'): ?>
        <?php if($this->e($settings['show_image']) == 'on'):?>
            <div class="s3dm_post_list_image">
                <?= $item['image']; ?>
            </div>
        <?php endif; ?>   
    <?php endif;?>

</li>

