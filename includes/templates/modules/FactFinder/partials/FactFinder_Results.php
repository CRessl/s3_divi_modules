<?php

/**
 * 
 * 
 * 
 * 'layout' => $this->props['layout'],  
 * 'show_image' => $this->props['show_image'],
 * 'show_date'  => $this->props['show_date'],
*/

?>

<ff-record-list>
    <?php if($layout == 'grid'): ?>

        <div class="uk-child-width-1-<?= $this->e($columns); ?>" uk-grid>
            <ff-record class="" uk-grid>
                <div class="uk-grid-width-1-3@m uk-width-1-1">
                    <img src="{{record.image}}" alt="" title="{{record.title}}">
                </div>
                <div class="uk-grid-width-2-3@m uk-width-1-1 uk-position-relative">
                    <a href="{{record.permalink}}" title="{{record.title}}" class="uk-position-cover"></a>
                    <h3>{{record.title}}</h3>
                    <div class="categories">
                        {{record.categories}}
                    </div>
                    <p>{{record.shorttext}}</p>
                </div>
            </ff-record>
        </div>

    <?php else: ?>

    

            <ff-record class="" uk-grid>
                <div class="uk-grid-width-1-3@m uk-width-1-1">
                    <img src="{{record.image}}" alt="" title="{{record.title}}">
                </div>
                <div class="uk-grid-width-2-3@m uk-width-1-1 uk-position-relative">
                    <a href="{{record.permalink}}" title="{{record.title}}" class="uk-position-cover"></a>
                    <h3>{{record.title}}</h3>
                    <div class="categories">
                        {{record.categories}}
                    </div>
                    <p>{{record.shorttext}}</p>
                </div>
            </ff-record>

        

    <?php endif; ?>
</ff-record-list>
