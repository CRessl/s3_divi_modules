

<div class="s3dm_products_grid_item s3dm_product_list_product_container">
    
    <div class="uk-card-default">

        <?php if($settings['show_image'] == 'on'): ?>
            <div class="s3dm_product_list_grid_product_image uk-position-relative">
            <?php if($settings['show_bubble']): ?>

                <?php if( $member_price === 0 && $price !== 0 || $price !== '0' && $member_price === '0' ):?>
                    <div class="bubble">
                        <p class="uk-margin-remove">Für EHI-Mitglieder kostenlos</p>
                    </div>
                    <?php elseif($member_price === 0 && $price === 0 || $member_price === '0' && $price === '0'): ?>
                        <div class="bubble">
                            <p class="uk-margin-remove">kostenloser Download</p>
                        </div>
                    <?php endif; ?>

                <?php endif; ?>

                <?= $packshot; ?>
            </div>
        <?php endif; ?>
        
        <div class="uk-card-body uk-position-relative">  
            <a href="<?= $permalink; ?>" class="uk-position-cover"></a>
            <?php if($settings['show_meta'] == 'on'): ?>

                <?php if($settings['show_date'] == 'on'):?>
                    <div class="s3dm_products_date">
                        <span>
                        <?= $this->e($date); ?>  
                        </span>
                    </div>
                <?php endif; ?>


                <?php if($settings['show_tags'] == 'on' && $tags):?>
                    <div class="s3dm_product_list_tags">
                    <?php foreach($tags as $tag): ?>
                        <div class="tag"><?= $tag->name ?></div>
                    <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            <?php endif; ?>
            
            <div class="s3dm_product_list_title">
                <?php if($title): ?>
                    <h3 class="<?= $this->e($settings['title_size']); ?>">
                        <?= $this->e($title) ;?>
                    </h3>
                <?php endif;?>
                <?php if($subtitle && $settings['show_subtitle']): ?>
                    <h3 class="<?= $this->e($settings['subtitle_size']); ?>">
                        <?= $this->e($subtitle) ;?>
                    </h3>
                <?php endif;?>
            </div>
            
            <?php if($settings['show_page_format'] === 'on'): ?>
                <div class="s3dm_product_list_product_format_page_container uk-margin-small-bottom">
                    <?php if($format && $max_pages): ?>
                        <p><b><?= $this->e($format); ?>, <?= $this->e($max_pages); ?> Seiten</b></p>
                    <?php endif; ?>

                    <?php if($format && !$max_pages): ?>
                        <p><b><?= $this->e($format); ?></b></p>
                    <?php endif; ?>

                    <?php if(!$format && $max_pages): ?>
                        <p><b><?= $this->e($max_pages); ?> Seiten</b></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <?php if($settings['show_excerpt'] == 'on'): ?>
                <div class="s3dm_product_list_excerpt uk-margin-medium-bottom">
                    <p class="uk-padding-remove"><?= $excerpt; ?></p>
                    <p class="uk-margin-remove">
                        <a href="<?= $this->e($permalink); ?>">
                            <?= $this->e($settings['linktext']); ?>
                        </a>
                    </p> 
                </div>
            <?php endif; ?>

            <?php if($settings['show_price'] == 'on'):?>
                <?php if($price): ?>
                    <div class="s3dm_product_list_product_price_container">
                        <p><span class="price"><?= $this->e($price); ?> €</span> zzgl. MwSt. </p>
                    </div>
                <?php endif; ?>
                <?php if($member_price == 0 || $member_price): ?>
                    <div class="s3dm_product_list_product_memberprice_container">
                        <p>Preis für Mitglieder: <?= $this->e($member_price); ?> € zzgl. MwSt.</p>
                    </div>
                <?php endif; ?>
            <?php endif;?>
               
        </div>

    </div>



</div>