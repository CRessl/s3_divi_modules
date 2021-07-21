<div class="splide" data-splide='<?= $settings['splideOptions']; ?>'>
    <div class="splide__track">
        <ul class="splide__list">

        <?php foreach($postData as $item): ?>
            <?php $this->insert('partials/ExtendedPostSliderItem', array(
                
                    'class_prefix' => $class_prefix,
                    'title' => $item['title'],
                    'imageSrc' =>$item['imageSrc'],
                    'excerpt' => $item['excerpt'],
                    'date' => $item['date'],
                    'link' => $item['link'],
                    'categories' => $item['categories'],
                    'author' => $item['author'],
                    'button_text' => $settings['button_text'],
                    'show_date' => $settings['show_date'],
                    'show_categories' => $settings['show_categories'],
                    'show_button' => $settings['show_button'],
                    'module_text_color' => $settings['module_text_color'],

                )); ?>
                
        <?php endforeach; ?>

        </ul>
    </div>
</div>