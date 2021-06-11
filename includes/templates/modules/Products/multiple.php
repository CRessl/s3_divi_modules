

<div class="s3dm_products_grid_item s3dm_product_list_product_container">
    
    <div class="uk-card-default">

        <?php if($settings['show_image'] == 'on'): ?>
            <div class="s3dm_product_list_grid_product_image uk-position-relative">
            <?php if($settings['show_bubble']): ?>

                <?php if($member_price == 0):?>
                    <div class="bubble">
                        <p class="uk-margin-small-bottom">Für EHI-Mitglieder kostenlos</p>

                        <svg id="Gruppe_17" data-name="Gruppe 17" xmlns="http://www.w3.org/2000/svg" width="43.597" height="37.788" viewBox="0 0 43.597 37.788">
                            <text id="_" data-name="$" transform="translate(22.401 16.05)" font-size="15" font-family="SignikaNegative-SemiBold, Signika Negative" font-weight="600"><tspan x="-3.773" y="0">$</tspan></text>
                            <g id="Gruppe_16" data-name="Gruppe 16">
                                <g id="Ellipse_2" data-name="Ellipse 2" transform="translate(10.945 0)" fill="none" stroke="#000" stroke-width="1.3">
                                <ellipse cx="11.184" cy="11.02" rx="11.184" ry="11.02" stroke="none"/>
                                <ellipse cx="11.184" cy="11.02" rx="10.534" ry="10.37" fill="none"/>
                                </g>
                                <path id="Pfad_11" data-name="Pfad 11" d="M968.663,2283.768a7.779,7.779,0,0,1,5.186-1.225c3.041.365,4.331,1.817,5.966,2.025s7.33.285,8.092.342,2.695.836,3.162,2.224a9.417,9.417,0,0,1,.51,2.323l-10.288-.5" transform="translate(-960.207 -2258.885)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1.3"/>
                                <path id="Pfad_12" data-name="Pfad 12" d="M968.273,2293.888a11.944,11.944,0,0,1,3.027-1.3c.82-.03,9.96,2.9,11.229,3.072a6.758,6.758,0,0,0,2.924,0,7.361,7.361,0,0,0,3.239-1.032c1.345-.668,14.161-9.088,14.161-9.088a4.886,4.886,0,0,0-2.1-1.279c-1.365-.427-1.481-.466-2.515,0s-6.424,3-6.424,3" transform="translate(-960.232 -2258.815)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1.3"/>
                                <g id="Pfad_13" data-name="Pfad 13" transform="matrix(0.999, 0.035, -0.035, 0.999, 0.55, 21.753)" fill="none">
                                <path d="M1.073,0,7.463,0A1.056,1.056,0,0,1,8.528,1.049L8.521,14.693a1.059,1.059,0,0,1-1.066,1.05l-6.391,0A1.056,1.056,0,0,1,0,14.7L.007,1.053A1.059,1.059,0,0,1,1.073,0Z" stroke="none"/>
                                <path d="M 7.22767448425293 1.300122261047363 L 1.306925773620605 1.303142547607422 L 1.300134658813477 14.44662189483643 L 7.220883369445801 14.44360160827637 L 7.22767448425293 1.300122261047363 M 7.463817596435547 1.9073486328125e-06 C 8.051810264587402 1.9073486328125e-06 8.528104782104492 0.469538688659668 8.527804374694824 1.04902172088623 L 8.520754814147949 14.69338226318359 C 8.520454406738281 15.27303218841553 8.043344497680664 15.74318218231201 7.455114364624023 15.74348163604736 L 1.064554691314697 15.74674224853516 C 1.064374923706055 15.74674224853516 1.064170837402344 15.74674224853516 1.063991069793701 15.74674224853516 C 0.4759988784790039 15.74674224853516 -0.0002956390380859375 15.27720546722412 4.76837158203125e-06 14.69772243499756 L 0.007054328918457031 1.053361892700195 C 0.007354736328125 0.4737024307250977 0.4844646453857422 0.003552436828613281 1.072694778442383 0.003262519836425781 L 7.463254451751709 1.9073486328125e-06 C 7.463434219360352 1.9073486328125e-06 7.463638305664062 1.9073486328125e-06 7.463817596435547 1.9073486328125e-06 Z" stroke="none" fill="#000"/>
                                </g>
                            </g>
                        </svg>

                    </div>
                    <?php elseif($member_price || $member_price > 0): ?>
                        <div class="bubble">
                            <p class="uk-margin-small-bottom">PDF zum sofortigem Download</p>

                            <svg xmlns="http://www.w3.org/2000/svg" width="31.338" height="28.408" viewBox="0 0 31.338 28.408">
                                <g id="Gruppe_1" data-name="Gruppe 1" transform="translate(-265.163 -1182.972)">
                                    <line id="Linie_1" data-name="Linie 1" x1="0.332" y2="17.753" transform="translate(280.331 1184.5)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="3"/>
                                    <path id="Pfad_2" data-name="Pfad 2" d="M273.323,1196.539l9.465,6.049,8.9-6.049" transform="translate(-2.16 0.47)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="3"/>
                                </g>
                                <line id="Linie_2" data-name="Linie 2" x2="28.338" transform="translate(1.5 26.908)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="3"/>
                            </svg>


                        </div>
                    <?php endif; ?>

                <?php endif; ?>

                <?= $packshot; ?>
            </div>
        <?php endif; ?>
        
        <div class="uk-card-body uk-position-relative">  
            <a href="<?= $link; ?>" class="uk-position-cover"></a>
            <?php if($settings['show_meta'] == 'on'): ?>

                <?php if($settings['show_date'] == 'on'):?>
                    <div class="s3dm_products_date">
                        <span>
                        <?= $this->e($date); ?>  
                        </span>
                    </div>
                <?php endif; ?>


                <?php if($settings['show_tags'] == 'on' && $tags):?>
                    <div class="s3dm_product_list_tags">
                    <?php foreach($tags as $tag): ?>
                        <div class="tag"><?= $tag->name ?></div>
                    <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            <?php endif; ?>
            
            <div class="s3dm_product_list_title">
                <?php if($title): ?>
                    <h3>
                        <?= $this->e($title) ;?>
                    </h3>
                <?php endif;?>
                <?php if($subtitle): ?>
                    <h4>
                        <?= $this->e($subtitle) ;?>
                    </h4>
                <?php endif;?>
            </div>

            <div class="s3dm_product_list_product_format_page_container uk-margin-small-bottom">
                <?php if($format && $max_pages): ?>
                    <p><b><?= $this->e($format); ?>, <?= $this->e($max_pages); ?> Seiten</b></p>
                <?php endif; ?>

                <?php if($format && !$max_pages): ?>
                    <p><b><?= $this->e($format); ?></b></p>
                <?php endif; ?>

                <?php if(!$format && $max_pages): ?>
                    <p><b><?= $this->e($max_pages); ?> Seiten</b></p>
                <?php endif; ?>
            </div>

            <?php if($settings['show_excerpt'] == 'on'): ?>
                <div class="s3dm_product_list_excerpt uk-margin-medium-bottom">
                    <p class="uk-padding-remove"><?= $excerpt; ?></p>
                    <p class="uk-margin-remove">
                        <a class="uk-text-uppercase" href="<?= $this->e($link); ?>">
                            <?= $this->e($settings['linktext']); ?>
                        </a>
                    </p> 
                </div>
            <?php endif; ?>

            <?php if($settings['show_price'] == 'on'):?>
                <?php if($price): ?>
                    <div class="s3dm_product_list_product_price_container">
                        <p><span class="price"><?= $this->e($price); ?> €</span> zzgl. MwSt. </p>
                    </div>
                <?php endif; ?>
                <?php if($member_price == 0 || $member_price): ?>
                    <div class="s3dm_product_list_product_memberprice_container">
                        <p>Preis für Mitglieder: <?= $this->e($member_price); ?> € zzgl. MwSt.</p>
                    </div>
                <?php endif; ?>
            <?php endif;?>
               
        </div>

    </div>



</div>