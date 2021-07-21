<div class="s3dm_event_list">
    <div uk-slider="finite:true">
        <ul class="uk-slider-items uk-grid-divider uk-child-width-1-<?= $columns ?>@m uk-child-width-1-3@s uk-child-width-1-1">

            <?php foreach($data as $postObject): ?>
                <?php $this->insert('partials/EventListItem', array(
                            'start_date' 	=> tribe_get_start_date( $postObject, true, $dateFormat ),
                            'end_date'		=> tribe_get_end_date( $postObject, true, $dateFormat ),
                            'title' 		=> $postObject->post_title,
                            'link' 			=> tribe_get_event_meta( $postObject->ID, '_EventURL', true ),
                            'prefix' 		=> $prefix,
                            'title_size' 	=> $title_size
                        ));
                ?>
            <?php endforeach; ?>

        </ul>
        <a class="uk-position-center-left" href="" uk-slidenav-previous uk-slider-item="previous"></a>
        <a class="uk-position-center-right" href="" uk-slidenav-next uk-slider-item="next"></a>
    </div>
</div>
