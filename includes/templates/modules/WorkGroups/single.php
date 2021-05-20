
<div class="s3dm_workgroups_item">
    <?php foreach ($workgroups as $group): ?>
        <?php 
            $workgroup_id = $group->ID; 
            $kontakte = get_field('ehi_workgroups_contact', $workgroup_id);
            $leitung = get_field('ehi_workgroups_manager', $workgroup_id);

        ?>
        <li class="s3dm_workgroups_slider_item">

            <div class="uk-width-auto">
                <h2><?php the_title($workgroup_id); ?></h2>
                <?php the_content($workgroup_id); ?>
            </div>
            <div class="s3dm_workgroups_slider_item_contact" style="width: 300px; height: 300px; border-radius: 50%; background: blue; color:#fff;">
                <h3>Kontakt</h3>
                
                <?php if($leitung): ?>
                    <?php foreach($leitung as $leiter):?>
                        <p><b>Leitung:</b> <?php the_field('ehi_team_vorname',$leiter->ID);?> <?php the_field('ehi_team_vorname',$leiter->ID);?></p>
                    <?php endforeach;?>
                <?php endif; ?>
                
                <?php if($kontakte): ?>
                    <?php foreach($kontakte as $kontakt):?>
                        <p><b>Kontakt: <?php the_field('ehi_team_vorname',$kontakt->ID);?> <?php the_field('ehi_team_vorname',$kontakt->ID);?></b></p>
                        <p><b>E-Mail:</b><?php the_field(' ehi_team_email',$kontakt->ID);?></p>
                        <p><b>Telefon:</b><?php the_field(' ehi_team_telefon',$kontakt->ID);?> </p>
                    <?php endforeach;?>    
                <?php endif; ?>
            </div>



        </li>

    <?php endforeach; ?>
</div>