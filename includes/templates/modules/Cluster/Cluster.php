<div class="s3dm_bubble_switcher uk-position-top-right uk-margin-medium uk-grid-small uk-width-small uk-child-width-1-2 uk-visible@m" style="z-index:100;" uk-grid>
    <div class="bubble-vision active">
        <svg data-name="Ebene 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 45 45">
            <line class="connection-line" x1="26.54" y1="15.32" x2="23.6" y2="17"/>
            <line class="connection-line" x1="33.25" y1="17.68" x2="33.83" y2="22.91"/>
            <line class="connection-line" x1="25.13" y1="29.56" x2="27.78" y2="30.47"/>
            <circle class="bubble-circle" cx="35.33" cy="30.47" r="7.56"/>
            <circle class="bubble-circle" cx="14.87" cy="24.44" r="11.47"/>
            <circle class="bubble-circle" cx="31.41" cy="12.2" r="5.79"/>
        </svg>
    </div>
    <div class="grid-vision">
        <svg data-name="Ebene 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 45 45">
            <rect class="kachel" x="4.13" y="4.14" width="16.91" height="16.91"/>
            <rect class="kachel" x="4.13" y="23.94" width="16.91" height="16.91"/>
            <rect class="kachel" x="23.96" y="4.14" width="16.91" height="16.91"/>
            <rect class="kachel" x="23.96" y="23.94" width="16.91" height="16.91"/>
        </svg>
    </div>
</div>
<div class="s3dm_cluster_container content-wrapper uk-margin-remove-top" style="min-height: <?= $this->e($min_height); ?>;">
    
    <?= $content ?>

</div>
<svg class="s3dm_cluster_lines_hide_mobile" height="<?= $this->e($min_height); ?>" width="100%" id="paths" style="position: absolute; z-index: -1; top:0;">

</svg>



<?php // some js here? ?>

<script>
var animationTimeline = gsap.timeline({
    paused:true,
});

jQuery(document).ready(function() {

    var windowWidth = jQuery(window).width();
    var linkListContainer = jQuery('.s3dm_cluster_container');
    var itemsToConnect = jQuery('.s3dm_cluster_container .s3dm_cluster_item_content');

    var itemsToAnimate = itemsToConnect.parents('.s3dm_cluster_item');

    connect_items(itemsToConnect);
        // set some global properties

    var lines = jQuery('#paths line');
                
    var count = 20;

    // loop through each element
    itemsToAnimate.each(function(i, el) {

        // set some individual properties
        //TweenMax.set(el, {borderRadius:0});
        var tl_bubble = gsap.timeline({
            ease: Power1.easeInOut,
            
        });
        
        var scaletl = gsap.timeline({paused: true});

        scaletl.to(el,{
            scale: 1.5,
            duration: 0.5,
            ease: "back.out(2)",
            zIndex: 99,
        });

        // create your tween of the timeline in a variable
        tl_bubble.to(el, {
            x: "random(-15, 15)",
            y: "random(-15, 15)",
            repeat: -1,
            repeatRefresh: true,
            duration: 1.5,
            onUpdate: function(){

            var element = jQuery(el).find('.s3dm_cluster_item_content');
            var from = element.attr('connect_to');
            var to = element.attr('connections').split(',');
            
            to.forEach(function(item,index){

                //line to update
                var svg_line = jQuery('[from_to="'+from+','+item+'"]');

                //current iteration element
                var fromElement = jQuery(el);

                //item to connect to
                var toElement = jQuery('[connect_to="'+item+'"]').parents('.s3dm_cluster_item');


                var currentItemWidth = fromElement.get(0).getBoundingClientRect().width;
                var currentItemHeight = fromElement.get(0).getBoundingClientRect().height;
                
                var connectWidth = toElement.get(0).getBoundingClientRect().width;
                var connectHeight = toElement.get(0).getBoundingClientRect().height;

                var currentItemPositions = fromElement.position();
                var nextItemPositions = toElement.position();

                var x1 = currentItemPositions.left + (currentItemWidth /2);
                var y1 = currentItemPositions.top + (currentItemHeight /2);

                var x2 = nextItemPositions.left + (connectWidth / 2);
                var y2 = nextItemPositions.top + (connectHeight / 2);

            
                svg_line.attr('x1', x1);
                svg_line.attr('y1', y1);
                svg_line.attr('x2', x2);
                svg_line.attr('y2', y2);

            });

            }
        });
        
        animationTimeline.add(tl_bubble, 0);
        // store the tween timeline in the javascript DOM node
        el.animation = tl_bubble;
        el.scale = scaletl;

        //create the event handler
        jQuery(el).on("mouseenter",function(){
            this.animation.pause();
            this.scale.play();
        }).on("mouseleave",function(){
            this.scale.reverse();
            this.animation.resume(); 
        });

    });
    
    jQuery('.bubble-vision').on('click', function(){

        if(jQuery(this).hasClass('active')){
            return;
        }

        //What this does: Returns the function as soon as current Selection is already active
        jQuery(this).toggleClass('active');
        jQuery('.grid-vision').toggleClass('active');
        jQuery('.s3dm_cluster_lines_hide_mobile').toggleClass('uk-hidden');

        animationTimeline.resume();
        linkListContainer.removeClass('s3dm_cluster_container_grid uk-grid uk-grid-match uk-child-width-1-4 uk-padding-large uk-padding-remove-horizontal').addClass('s3dm_cluster_container'); 
        linkListContainer.removeAttr('uk-grid');
        linkListContainer.removeAttr('uk-height-match');

    });

    jQuery('.grid-vision').on('click', function(){
        
        
        //What this does: Returns the function as soon as current Selection is already active
        if(jQuery(this).hasClass('active')){
            return;
        }

        jQuery(this).toggleClass('active');
        jQuery('.bubble-vision').toggleClass('active');

        animationTimeline.pause();
        linkListContainer.addClass('s3dm_cluster_container_grid uk-grid-match uk-child-width-1-4 uk-padding-large uk-padding-remove-horizontal').removeClass('s3dm_cluster_container');
        linkListContainer.attr('uk-grid', true);
        linkListContainer.attr('uk-height-match', 'target: .s3dm_cluster_item_content')

        
        
        jQuery('.s3dm_cluster_lines_hide_mobile').toggleClass('uk-hidden');

    });

    if(windowWidth < 980){
        linkListContainer.addClass('s3dm_cluster_container_grid uk-child-width-1-4 uk-padding-large uk-padding-remove-horizontal').removeClass('s3dm_cluster_container'); 
    }else{
        animationTimeline.play();
    }

   



    
    
});

jQuery(window).resize(function(){

    var windowWidth = jQuery(window).width();
    var linkListContainer = jQuery('.content-wrapper');
    
    /*if(windowWidth > 980){
    
        linkListContainer.removeClass('s3dm_cluster_container_grid uk-grid uk-child-width-1-4 uk-padding-large uk-padding-remove-horizontal').addClass('s3dm_cluster_container');
        if(animationTimeline.paused()){
            animationTimeline.restart(0);
        }
       

    }else{
    
        linkListContainer.addClass('s3dm_cluster_container_grid uk-grid uk-child-width-1-4 uk-padding-large uk-padding-remove-horizontal').removeClass('s3dm_cluster_container');
        animationTimeline.pause();
    }*/

});



function connect_items(items){

    items.each(function(index, item){
        
        var $this = jQuery(this);

        var connectionsString = item.attributes.connections.nodeValue;
        var connections = connectionsString.split(",");

        var currentItem = jQuery(item).parents('.s3dm_cluster_item');

        connections.forEach(function(connectionClass,index){

            var connectionElement = jQuery('[connect_to="'+connectionClass+'"]').parents('.s3dm_cluster_item');

            if(connectionElement.length > 0){

                //then do the connections
                var currentItemWidth = currentItem.get(0).getBoundingClientRect().width;
                var currentItemHeight = currentItem.get(0).getBoundingClientRect().height;
                
                var connectWidth = connectionElement.get(0).getBoundingClientRect().width;
                var connectHeight = connectionElement.get(0).getBoundingClientRect().height;

                var currentItemPositions = currentItem.position();
                var nextItemPositions = connectionElement.position();

                var x1 = currentItemPositions.left + (currentItemWidth /2);
                var y1 = currentItemPositions.top + (currentItemHeight /2);

                var x2 = nextItemPositions.left + (connectWidth / 2);
                var y2 = nextItemPositions.top + (connectHeight / 2);

                var newLine = document.createElementNS('http://www.w3.org/2000/svg', 'line');
                newLine.setAttribute('x1', x1);
                newLine.setAttribute('y1', y1);
                newLine.setAttribute('x2', x2);
                newLine.setAttribute('y2', y2);
                newLine.setAttribute('from_to', item.attributes.connect_to.nodeValue+','+connectionClass);

                jQuery("#paths").append(newLine);

            }

        });

    });




}
   




</script>