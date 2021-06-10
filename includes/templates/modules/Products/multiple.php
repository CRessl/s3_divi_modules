<div class="uk-child-width-1-1 uk-child-width-1-<?= $this->e($columns); ?>" uk-grid>

    <?php foreach($products as $product): ?>
        <?php 
            
            $productID = $product->ID;
            $title = $product->post_title;
            $content = apply_filters( 'the_content', get_the_content(null, true, $productID) );
            $link = get_permalink($productID);
            
        ?>
        <div class="s3dm_product_container">
        <a href="<?= $link; ?>" class="uk-position-cover"></a>
        
            <h3><?= $title ?></h3>
            <?= $content ?>
            <a href="<?= $link; ?>"><?= $this->e($linktext); ?></a>
        </div>


    <?php endforeach; ?>

</div>