<?php if($layout === 'first_post_left'):  ?>
    
    <div class="topics-news uk-child-width-1-2@m uk-child-width" uk-grid>
        <div>
            <?= $this->insert('partials/'.$layout, array(
                    'item' => $items[0],
                    'settings' => $settings
                    )
                ); ?>
        </div>
        <div>
            <?php 
                $count = 0; //Add counter so we can skip the first one
                foreach($items as $item): 
            ?>
            
            <?php if($count != 0): //show all except first one ?>
                <?= $this->insert('partials/'.$layout, array(
                    'item' => $item,
                    'settings' => $settings
                    )
                ); ?>   
            <?php endif; ?>

            <?php 
                $count++; //count upwards for our script to work
                endforeach; 
            ?>
        </div>
    </div>


<?php endif; ?>

<?php if($layout == 'grid'): ?>

    <div class="s3dm_post_list_grid uk-grid uk-grid-match uk-child-width-1-1 uk-child-width-1-<?= $this->e($columns); ?>@m" uk-grid>
        <?php foreach($items as $item): ?>
            
            <?= $this->insert('partials/'.$layout, array(
                'item' => $item,
                'settings' => $settings
                )
            ); ?>

        <?php endforeach; ?>
    </div>

<?php endif; ?>

<?php if($layout == 'default'): ?>

    <ul class="uk-list" style="list-style-type:none;">
        <?php foreach($items as $item): ?>
            
            <?= $this->insert('partials/'.$layout, array(
                'item' => $item,
                'settings' => $settings
                )
            ); ?>

        <?php endforeach; ?>
    </ul>

<?php endif;?>