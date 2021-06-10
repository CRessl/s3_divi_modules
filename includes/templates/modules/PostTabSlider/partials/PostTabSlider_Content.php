<div class="s3dm_grid_content">
    <div class="s3dm_tab_content_post_categories uk-grid-small" uk-grid>
        <?= $categories ?>
    </div>
    <div class="s3dm_tab_content_post_title">
        <h3><?= $this->e($title) ?></h3>
    </div>
    <div class="s3dm_tab_content_post_excerpt uk-margin-medium-bottom">
        <?php if($excerpt):?>
            <?= $excerpt ?>
        <?php endif; ?>
    </div>
	<div class="s3dm_tab_content_post_link">
    <?= $link ?>
    </div>
</div>
<div class="s3dm_grid_image">
    <div class="s3dm_tab_content_post_image uk-background-cover uk-background-center-center" style="background-image: url(<?= $this->e($imageURL) ?>);">
        <?= $imageHTML ?>
    </div>
</div>