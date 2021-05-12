
<div class="uk-width-1-1 uk-width-1-<?= $this->e($columns) ?>@m">
    <div class="<?= $this->e($prefix) ?>_date">
        <?= $this->e($date); ?>
    </div>
    <div class="<?= $this->e($prefix) ?>_title">
        <h4>
            <?= $this->e($title) ?>
        </h4>
    </div>
    <div class="<?= $this->e($prefix) ?>_link">
        <a href="<?= $this->e($link) ?>" class="uk-button uk-button-default">
            <?= $this->e($button_text) ?>
        </a>
    </div>
</div>