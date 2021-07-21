<?php if($query_type === 'select'): ?>
    <?php $this->insert('partials/item', array(
        'workgroups' => $workgroups,
        'title_size' => $title_size,
    ));
    ?>
<?php endif; ?>

<?php if($query_type === 'category'): ?>

    <?php if(count($workgroups) == 1): ?>
        <?php $this->insert('partials/item', array(
            'workgroups' => $workgroups,
            'title_size' => $title_size,
        ));
        ?>
    <?php endif; ?>

    <?php if(count($workgroups) > 1): ?>
        <?php $this->insert('partials/items', array(
            'workgroups' => $workgroups,
            'title_size' => $title_size,
            'slide_options' => $slide_options
        ));
        ?>
    <?php endif; ?>


<?php endif; ?>

