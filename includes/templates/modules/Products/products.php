<?php if($query_type === 'category'): ?>  

<div class="s3dm_products_slider_container" uk-slider="finite:true;">
    <div class="uk-position-relative">
        <div class="uk-slider-container">
            <ul class="uk-slider-items uk-padding-remove uk-child-width-1-1 uk-child-width-1-2@m uk-child-width-1-<?= $columns; ?>@l" uk-height-match="target: .s3dm_products_grid_item .uk-card-body" uk-grid>

            <?php foreach($items as $item): ?>
                <?= $this->insert('partials/'.$query_type.'/item', $item); ?>
            <?php endforeach; ?>


            </ul>
        </div>
        <a class="uk-position-center-left-out" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
        <a class="uk-position-center-right-out" href="#" uk-slidenav-next uk-slider-item="next"></a>
			
			
    </div>
</div>

<?php endif; ?> 

<?php if($query_type === 'select'):?>
    
    <?php foreach($items as $item): ?>
        <?= $this->insert('partials/'.$query_type.'/item', $item); ?>
    <?php endforeach; ?>

<?php endif; ?>