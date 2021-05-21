<div class="s3dm_workgroups_item uk-grid-match" uk-grid>
        <?php 
            $workgroup_id = $workgroups->ID; 
            $kontakte = get_field('ehi_workgroups_contact', $workgroup_id);
            $leitung = get_field('ehi_workgroups_manager', $workgroup_id);

        ?>
        
            <div class="uk-width-expand uk-flex-middle uk-flex uk-padding-remove-top uk-padding-remove-bottom uk-padding">
                <div>
                    <h2><?= $workgroups->post_title; ?></h2>
                    <?= $workgroups->post_content ?>
                </div>
            </div>
            <div class="s3dm_workgroups_slider_item_contact uk-width-auto section-workshopsMulti-bubble" style="width: 350px; height: 350px;">
                <div>
                    <h3>Kontakt</h3>
                    <?php if($leitung): ?>
                        <?php foreach($leitung as $leiter):?>
                            <p><b>Leitung:</b> <?php the_field('ehi_team_vorname',$leiter->ID);?> <?php the_field('ehi_team_',$leiter->ID);?></p>
                        <?php endforeach;?>
                    <?php endif; ?>
                    <?php if($kontakte): ?>
                        <?php foreach($kontakte as $kontakt):?>
                            <p><b>Kontakt: <?php the_field('ehi_team_vorname',$kontakt->ID);?> <?php the_field('ehi_team_nachname',$kontakt->ID);?></b></p>
                            <p><b>E-Mail:</b><?php the_field(' ehi_team_email',$kontakt->ID);?></p>
                            <p><b>Telefon:</b><?php the_field(' ehi_team_telefon',$kontakt->ID);?> </p>
                        <?php endforeach;?>    
                    <?php endif; ?>
                </div>
            </div>

</div>