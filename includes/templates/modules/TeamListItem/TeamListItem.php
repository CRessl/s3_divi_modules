<div class="s3dm_teamlist_item_content_wrapper uk-inline">
    <?= $attachment; ?>
    <div class="uk-overlay-primary uk-position-cover"></div>
    <div class="uk-overlay uk-position-bottom uk-padding-small <?= $this->e($title_size); ?>">
        <h3 class="s3dm_teamlist_name">
            <?= $this->e($name); ?>
        </h3>
        <p>
            <a href="mailto:<?= $this->e($email); ?>"><?= $this->e($email); ?></a>
        </p>
    </div>
</div>