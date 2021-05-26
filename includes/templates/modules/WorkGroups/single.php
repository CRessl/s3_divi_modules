<div class="s3dm_workgroups_item uk-flex-center" uk-grid>
        <?php 
            $workgroup_id = $workgroups->ID; 
            $leitende = get_field('ehi_workgroups_contact', $workgroup_id);
            $vorsitzende = get_field('ehi_workgroups_manager', $workgroup_id);

        ?>
        
            <div class="uk-width-expand@m uk-width-1-1 uk-flex-middle uk-flex uk-padding-remove-top uk-padding-remove-bottom uk-padding">
                <div>
                    <h3 class="s3dm_workgroups_title"><?= $workgroups->post_title; ?></h3>
                    <?= $workgroups->post_content ?>
                </div>
            </div>
            <div class="s3dm_workgroups_slider_item_contact uk-width-auto@m">
                <div class="contactContainer">
                    <h3 class="uk-margin-small s3dm_workgroups_slider_item_contact_title">Kontakt</h3>
                    <p>
                    <?php if($leitende): ?>
                        <?php foreach($leitende as $kontakt):?>
                            
                                <b>Leitung:</b> <?php the_field('ehi_team_vorname',$kontakt->ID);?> <?php the_field('ehi_team_nachname',$kontakt->ID);?><br>
                                <b>E-Mail:</b> <?php the_field('ehi_team_email', $kontakt->ID);?><br>
                                <b>Telefon:</b> <?php the_field('ehi_team_telefon', $kontakt->ID);?><br>     
                           
                        <?php endforeach;?>
                    <?php endif; ?>

                    <?php if($vorsitzende): ?>
                        <?php foreach($vorsitzende as $vorsitz):?>
                            <b>Vorsitz:</b> <?php the_field('ehi_team_vorname',$vorsitz->ID);?> <?php the_field('ehi_team_nachname',$vorsitz->ID);?>, <?php the_field('ehi_team_unternehmen', $vorsitz->ID); ?>
                        <?php endforeach;?>    
                    <?php endif; ?>

                    </p>
                </div>
            </div>

</div>