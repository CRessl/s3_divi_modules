<div class="s3dm_cluster_container">

    <?= $content ?>

</div>
<svg height="<?= $this->e($min_height); ?> " width="100%" id="paths">

</svg>

<?php // some js here? ?>

<script>
jQuery(document).ready(function() {
    var windowWidth = jQuery(window).width();
    var linkListContainer = jQuery('.s3dm_cluster_container');
    var itemsToConnect = jQuery('.s3dm_cluster_item_content');

    var itemsToAnimate = itemsToConnect.parents('.s3dm_cluster_item');

    var itemStyle = [];
    connect_items(itemsToConnect);


    // set some global properties
    TweenMax.set(itemsToAnimate, {transformOrigin:"50% 50%"});

    var lines = jQuery('#paths line');
                
    var count = 20;

    // loop through each element
    itemsToAnimate.each(function(i, el) {
    
        // set some individual properties
        //TweenMax.set(el, {borderRadius:0});

        var tl = new TimelineMax();

        // create your tween of the timeline in a variable
        tl.to(el, {
            x: "random(-15, 15)",
            y: "random(-15, 15)",
            ease: Power1.easeInOut,
            duration: 1.5, 
            repeat: -1,
            repeatRefresh: true,
            smoothChildTiming: true,
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

        tl.play();
        // store the tween timeline in the javascript DOM node
        el.animation = tl;
        
        //create the event handler
        jQuery(el).on("mouseenter",function(){
            this.animation.pause();
        }).on("mouseleave",function(){
            this.animation.resume();
        });
    
    });
    
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
                newLine.setAttribute('stroke', 'black');
                newLine.setAttribute('stroke-width', '2');

                jQuery("#paths").append(newLine);

            }

        });

    });




}
   




</script>