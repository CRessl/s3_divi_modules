<div class="s3dm_grid_content uk-flex-first@m uk-flex-last">
    <div class="s3dm_tab_content_post_categories uk-grid-small" uk-grid>
        <?= $categories ?>
    </div>
    <div class="s3dm_tab_content_post_title <?= $this->e($title_size); ?>">
        <h3><?= $this->e($title) ?></h3>
    </div>
    <div class="s3dm_tab_content_post_excerpt uk-margin-medium-bottom">
        <?php if($excerpt):?>
            <?= $excerpt ?>
        <?php endif; ?>
    </div>
	<div class="s3dm_tab_content_post_link">
        <a href="<?= $this->e($link); ?>"><?= $this->e($linktext) ?></a>
    </div>
</div>
<div class="s3dm_grid_image uk-flex-first uk-flex-last@m">
    <div class="s3dm_tab_content_post_image">
        <?= $imageHTML ?>
    </div>
</div>