
<div class="s3dm_workgroups_slider uk-child-width-1-<?= $this->e($columns) ?>" uk-grid>

    <?php foreach($initiatives as $initiative): ?>
        <?php $initiative_id = $initiative->ID; ?>
        <div class="s3dm_initiatives_item">

            <div class="image uk-cover-container">
                <?= the_post_thumbnail($initiative_id, 'medium_large', ['uk-cover' => '']); ?>
            </div>
            <div class="content">
                <h2><?php the_title($initiative_id); ?></h2>
            </div>

        </div>
    <?php endforeach; ?>

</div>