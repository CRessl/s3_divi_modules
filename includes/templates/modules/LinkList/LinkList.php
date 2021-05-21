<div class="<?= $this->e($classes) ?>" style="width: 100%; height: <?= $this->e($height); ?>; max-height: <?= $this->e($maxHeight); ?>;">
    <div class="wrapper">
        <?= $content ?>
    </div>
    <svg height="800" width="100%" id="paths">

    </svg>
</div>

<script>
jQuery(document).ready(function() {
    var windowWidth = jQuery(window).width();
    var linkListContainer = jQuery('.s3dm_link_list');
    var itemsToConnect = jQuery('.s3dm_link_list_item');

    var itemStyle = [];

    connect_items(itemsToConnect);
    
    /* gsap.to(itemsToConnect, {
        x: "random(-25, 25)",
        y: "random(-25, 25)",
        ease: " none",
        duration: 3, 
        repeat: -1,
        repeatRefresh: true,
    }); */


    /*
    itemsToConnect.each(function(i, el){
        
        var $this = jQuery(this);

        // create a timeline for this element in paused state
        var tl = new TimelineMax();
        // create your tween of the timeline in a variable
        tl.to(el, {
            x: "random(-25, 25)",
            y: "random(-25, 25)",
            ease: " none",
            duration: 3, 
            repeat: -1,
            repeatRefresh: true,
            onUpdate : function(){
                
            }
        });

        // store the tween timeline in the javascript DOM node
        el.animation = tl;

        //create the event handler
        jQuery(el).on("mouseenter",function(){
            this.animation.pause();
        }).on("mouseleave",function(){
            this.animation.resume();
        });

    });*/

    

    
});

jQuery(window).on('resize', function(){

    var itemsToConnect = jQuery('.s3dm_link_list_item');
    var windowWidth = jQuery(window).width();

    //connect_items(itemsToConnect);

    if(windowWidth <= 768){
        itemsToConnect.toggleClass('s3dm_link_list_mobile_list_view');
    }

});

function updateConnection(itemIndex, item){

    var pathItem = jQuery('#paths').find('line[index='+itemIndex+']');
    
    var currentPositions = jQuery(item).position();
    console.log(currentPosition);
    



}

function connect_items(items){

    items.each(function(index, item){
        
        var $this = jQuery(this);

        var connectTo = item.attributes.connect.nodeValue;
        var connectItem;

        if(connectTo){
            connectItem = jQuery('.'+connectTo);
        }

        if(connectTo && connectItem.length > 0 && connectItem){

            var currentItemWidth = $this.outerWidth();
            var currentItemHeight = $this.outerHeight();

            var connectWidth = connectItem.outerWidth();
            var connectHeight = connectItem.outerHeight();

            var currentItemPositions = $this.position();
            var nextItemPositions = connectItem.position();

            var x1 = currentItemPositions.left + (currentItemWidth /2);
            var y1 = currentItemPositions.top + (currentItemHeight /2);

            var x2 = nextItemPositions.left + (connectWidth / 2);
            var y2 = nextItemPositions.top + (connectHeight / 2);

            var aLine = document.createElementNS('http://www.w3.org/2000/svg', 'line');
            aLine.setAttribute('x1', x1);
            aLine.setAttribute('y1', y1);
            aLine.setAttribute('x2', x2);
            aLine.setAttribute('y2', y2);
            aLine.setAttribute('index', index);
            aLine.setAttribute('stroke', 'black');
            aLine.setAttribute('stroke-width', '2');

            jQuery("#paths").append(aLine);

        }

    });
}

</script>