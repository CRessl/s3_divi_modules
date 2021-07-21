<li class="splide__slide s3dm_extended_post_slider_item" style="background-image: url('<?= $this->e($imageSrc) ?>'); background-size: cover;">
			
    <?php if($this->e($show_button) === 'off'): ?>
        <a href="<?= $this->e($link) ?>" class="uk-position-cover" style="z-index: 1"></a>
    <?php endif; ?>

    <img class="uk-hidden@s" src="<?= $this->e($imageSrc) ?>" alt="<?= $this->e($title) ?>">
    <div class="s3dm_extended_post_slider_mobile_content uk-hidden@s">
        <div class="et_pb_row">

            <?php if($this->e($show_date) === 'on'):?>
                <div class="<?= $this->e($class_prefix)?>date">
                    <?= $this->e($date) ?>
                </div>
            <?php endif;?>

            <?php if($this->e($show_categories) === 'on'):?>
                <div class="<?= $this->e($class_prefix)?>categories uk-grid-small uk-margin-top" uk-grid>
                    <?= $categories ?>
                </div>
            <?php endif;?>

            <h1 style="color:<?= $this->e($module_text_color)?>">
                <?= $this->e($title)?>
            </h1>

            <p class="uk-light" style="color:<?= $this->e($module_text_color)?>">
                <?= $this->e($excerpt)?>
            </p>

            <?php if($this->e($show_button) === 'on'): ?>
                <div class="<?= $this->e($class_prefix)?>button">
                    <a class="uk-button uk-button-primary <?= $this->e($class_prefix)?>button" href="<?= $this->e($link) ?>">
                    <?= $this->e($button_text) ?>
                    </a>
                </div>
            <?php endif;?>

        </div>
    </div>


    <div class="<?= $this->e($class_prefix)?>content uk-visible@s" style="width: 100%;">

        <div class="et_pb_row" style="padding: 14% 0;">

            <?php if($this->e($show_date) === 'on'):?>
                <div class="<?= $this->e($class_prefix)?>date">
                    <?= $this->e($date) ?>
                </div>
            <?php endif;?>

            <?php if($this->e($show_categories) === 'on'):?>
                <div class="<?= $this->e($class_prefix)?>categories uk-grid-small uk-margin-top" uk-grid>
                    <?= $categories ?>
                </div>
            <?php endif;?>

            <h1 style="color:<?= $this->e($module_text_color)?>">
                <?= $this->e($title)?>
            </h1>
            
            <p class="uk-light" style="color:<?= $this->e($module_text_color)?>">
                <?= $this->e($excerpt)?>
            </p>

            <?php if($this->e($show_button) === 'on'): ?>
                <div class="<?= $this->e($class_prefix)?>button">
                    <a class="uk-button uk-button-primary <?= $this->e($class_prefix)?>button" href="<?= $this->e($link) ?>">
                    <?= $this->e($button_text) ?>
                    </a>
                </div>
            <?php endif;?>

        </div>

    </div>

    <div class="uk-position-cover uk-visible@s s3dm_slider_dark_bg_overlay"></div>

</li>
