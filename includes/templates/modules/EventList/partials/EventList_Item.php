
<li>
    <div class="<?= $this->e($prefix) ?>_date">
        <p class="<?= $this->e($prefix) ?>_date_text">
            <?= $this->e($start_date); ?>
            <?php if($this->e($end_date)): ?>
            - <?= $this->e($end_date); ?>
            <?php endif; ?>
        </p>
    </div>
    <div class="<?= $this->e($prefix) ?>_title <?= $this->e($title_size); ?>">
        <h3>
            <?= $this->e($title) ?>
        </h3>
    </div>
    <div class="<?= $this->e($prefix) ?>_link">
        <a href="<?= $this->e($link) ?>" class="uk-button uk-button-default">
            <?= $this->e($button_text) ?>
        </a>
    </div>
</li>