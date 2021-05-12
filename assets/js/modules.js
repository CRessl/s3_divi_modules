jQuery(document).ready(function ($) {

    /* Slider Height */
    var contentSlideHeights = $(".s3dm_extended_post_slider .s3dm_extended_post_slider_content > div").map(function ()
    {
        return $(this).outerHeight();
    }).get();

    var maxSlideHeight = Math.max.apply(null, contentSlideHeights);

    $('.s3dm_extended_post_slider .s3dm_extended_post_slider_content').height(maxSlideHeight);

    setTimeout(function(){
        var elms = document.getElementsByClassName('s3dm_extended_post_slider' );
            for ( var i = 0, len = elms.length; i < len; i++ ) {
                new Splide( elms[ i ] ).mount();
            }
    }, 500)
    
    

});