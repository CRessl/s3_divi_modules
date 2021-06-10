<div class="s3dm_teamlist_item_content_wrapper uk-inline">
    <?= $attachment; ?>
    <div class="uk-overlay-primary uk-position-cover"></div>
    <div class="uk-overlay uk-position-bottom uk-padding-small">
        <h4>
            <?= $this->e($name); ?>
        </h4>
        <p>
            <a href="mailto:<?= $this->e($email); ?>"><?= $this->e($email); ?></a>
        </p>
    </div>
</div>