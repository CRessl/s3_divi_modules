
<li class="uk-position-relative uk-margin">
    <?php if($this->e($link)): ?>
    <a href="<?= $this->e($link) ?>" class="uk-position-cover"></a>
    <?php endif;?>

    <?php if($this->e($settings['image_position']) == 'top'): ?>
        <?php if($this->e($settings['show_image']) == 'on'):?>
            <div class="s3dm_post_list_image">
                    <?= $image; ?>
            </div>
        <?php endif; ?>   
    <?php endif;?>

    <?php if($this->e($settings['show_date']) == 'on'): ?>
        <div class="s3dm_post_list_date">
            <span>
            <?= $this->e($date); ?>   
            </span>
        </div>
    <?php endif;?>
  

    <div class="s3dm_post_list_title <?= $this->e($title_size); ?>">
        <h3>
            <?= $this->e($title); ?>
        </h3>
    </div>

    <?php if($this->e($settings['show_tags']) == 'on'): ?>
        <?php if($this->e($tags)): ?>
            <div class="s3dm_post_list_tags">
                <?= $this->e($tags); ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if($this->e($settings['image_position']) == 'between'): ?>
        <?php if($this->e($settings['show_image']) == 'on'):?>
            <div class="s3dm_post_list_image">
                    <?= $image; ?>
            </div>
        <?php endif; ?>   
    <?php endif;?>

    <?php if($this->e($settings['show_excerpt']) == 'on'): ?>
        <?php if($this->e($excerpt)): ?>
            <div class="s3dm_post_list_excerpt">
                <p>
                    <?= $this->e($excerpt); ?>
                </p>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if($this->e($settings['image_position']) == 'bottom'): ?>
        <?php if($this->e($settings['show_image']) == 'on'):?>
            <div class="s3dm_post_list_image">
                    <?= $$image; ?>
            </div>
        <?php endif; ?>   
    <?php endif;?>

</li>

