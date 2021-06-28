

<div class="s3dm_contact_person uk-padding uk-padding-remove-horizontal">
   
        <?php if($image):?>
        <div class="s3dm_contact_person_image_container uk-margin">
            <?= $image ?>
        </div>
        <?php endif;?>

        
        <div class="s3dm_contact_person_content <?= $this->e($title_size); ?>">
            <?php if($name):?>
                <h3 class="s3dm_contact_person_name"><?= $this->e($name); ?></h3>
            <?php endif;?>
            <?php if($show_meta == 'on'):?>
                <?php if($position):?>
                    <p class="s3dm_contact_person_position"><?= $this->e($position); ?></p>
                <?php endif; ?>
                <?php if($show_phone == 'on'):?>
                    <p class="s3dm_contact_person_tel">Tel: <?= $this->e($phone); ?></p>
                <?php endif;?>
                <?php if($show_email == 'on'):?>
                    <p class="s3dm_contact_person_email"><a href="mailto:<?= $this->e($email); ?>"><?= $this->e($email); ?></a></p>
                <?php endif;?>
            <?php endif; ?>
        </div>

</div>