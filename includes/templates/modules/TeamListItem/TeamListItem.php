<div class="s3dm_teamlist_item_content_wrapper uk-inline">
    <?php if($attachment):?>
        <?= $attachment; ?>
    <?php else: ?>
        <img src="https://via.placeholder.com/480" alt="<?= $this->e($name); ?>" width="480" height="480" />
    <?php endif; ?>
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