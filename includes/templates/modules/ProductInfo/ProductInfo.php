
<div class="uk-child-width-1-2@m uk-child-width-1-1" uk-grid>
    <div class="s3dm_product_info_image_container uk-position-relative uk-text-center">
        <?php  if($product['price'] == 0 && $product['member_price'] == 0): ?>
            <div class="bubble uk-flex uk-flex-middle">
                <p class="uk-margin-remove">kostenloser Download</p>
            </div>
        <?php endif; ?>
        <?php  if($product['price'] != 0 && $product['member_price'] == 0): ?>
            <div class="bubble uk-flex uk-flex-middle">
                <p class="uk-margin-remove">Für EHI-Mitglieder kostenlos</p>
            </div>
        <?php endif; ?>
        <?= $product['packshot'] ?>
    </div>
    <div class="s3dm_product_info_content_container">
        <div class="s3dm_product_info_title_container">
            <?php if($product['title']): ?>
                <h3 class="<?= $this->e($settings['title_size']); ?>"><?= $this->e($product['title']) ?></h3>
            <?php endif; ?>
            <?php if($product['subtitle']): ?>
                <h3 class="<?= $this->e($settings['subtitle_size']); ?>"><?= $this->e($product['subtitle']) ?></h3>
            <?php endif; ?>
        </div>
        <div class="s3dm_product_info_detail uk-margin-small-top">
            <ul class="uk-list">
                
                <?php if($product['authors']): ?>
                    <li><b>Autor:in:</b> <?= $this->e($product['authors']); ?></li> 
                <?php endif; ?>

                <?php if($product['articlenumber']): ?>
                    <li><b>Produktnummer:</b> <?= $this->e($product['articlenumber']); ?></li> 
                <?php endif; ?>

                <?php if($product['max_pages']): ?>
                    <li><b>Seitenanzahl:</b> <?= $this->e($product['max_pages']); ?></li> 
                <?php endif; ?>

                <?php if($product['publish_year']): ?>
                    <li><b>Erscheinungsjahr:</b> <?= $this->e($product['publish_year']); ?></li> 
                <?php endif; ?>

                <?php if($product['isbn']): ?>
                    <li><b>ISBN:</b> <?= $this->e($product['isbn']); ?></li> 
                <?php endif; ?>

                <?php if($product['format']): ?>
                    <li><b>Format:</b> <?= $this->e($product['format']); ?></li> 
                <?php endif; ?>
            </ul>
        </div>
        <div class="s3dm_product_info_price_container uk-margin-medium-top">
            <div>
                <span class="price"><?= $this->e($product['price']); ?> €</span> zzgl. MwSt.
            </div>
            <div>
                <span class="member_price">Preis für Mitglieder: <?= $this->e($product['member_price']); ?> € zzgl. MwSt.</span>
            </div>
        </div>
        <div class="s3dm_product_info_button_container uk-margin-medium-top">
            <a class="ehi-color-btn s3dm_product_info_button uk-display-inline-block" href="<?= $this->e($settings['link']); ?>">
                <?= $this->e($settings['button_text']); ?>
            </a>
        </div>

    </div>
</div>