<div id="s3dm_switcher_all_container_">
	<div class="s3dm-tab-slider-content-container uk-margin-medium-bottom uk-position-relative">
        <div class="uk-switcher s3dm_tab_contents">
            <?php $indexcounter = 0; ?>
            <?php foreach($posts['postData'] as $postData): ?>
                
                <div class="uk-grid uk-child-width-1-2@m uk-child-width-1-1 s3dm_grid_container" uk-grid indexcount="<?= $indexcounter; ?>">
                    
                    <?php $this->insert('partials/PostTabSlider_Content', array(
                        'categories' => $postData['categories'],
                        'title' => $postData['title'],
                        'imageURL' => $postData['image'],
                        'imageHTML' => $postData['wpImageHTML'],
                        'excerpt' => $postData['excerpt'],
                        'link' => $postData['link'],
                        'title_size' => $title_size,
                        'linktext'  => $linktext,
                    ));
                    // OUTPUT END
                    ?>

                </div>
                <?php $indexcounter++; ?>
            <?php endforeach; ?>
            
            

        </div>
        <div class="s3dm_tab_slider_navigation_buttons uk-position-bottom-left">

            <div class="s3dm_tab_slider_navigation_background">        
                <i class="fas fa-chevron-left s3dm_tab_navigation_content s3dm_tab_navigation_prev disabled" style="padding-right: 15px;"></i>
                <i class="fas fa-chevron-right s3dm_tab_navigation_content s3dm_tab_navigation_next" style="padding-left: 15px;"></i>
            </div>

        </div>
    </div>
    <!-- POST TAB SLIDER CONTENT END -->
    
    <!-- POST TAB SLIDER NAV START -->
    <div class="s3dm_switcher s3dm_tab_navigation uk-grid uk-child-width-1-<?= $this->e($posts_number);?>" uk-switcher="connect:.s3dm_tab_contents; animation: uk-animation-fade">
                
        <?php foreach($posts['postData'] as $postData): ?>
            <?php               
                $this->insert('partials/PostTabSlider_Nav', array(
                       'categories' => $postData['categories'],
                       'title' => $postData['title'],
                       'title_size' => $title_size
                ));  
            ?>
        <?php endforeach; ?>

    </div>
    <!-- POST TAB SLIDER NAV END -->           

</div>


<script>
    jQuery(document).ready(function(){

        var $element = jQuery('.s3dm_tab_contents');

        var navElements = jQuery('.s3dm_tab_navigation_content');
        var nextNav = jQuery('.s3dm_tab_navigation_next');
        var prevNav = jQuery('.s3dm_tab_navigation_prev');

        var max_items = $element.find('.s3dm_grid_container').length - 1;

        var initialContent = $element.find('.uk-active');
        var initalContentText = initialContent.find('.s3dm_grid_content');
        var initalContentImage = initialContent.find('.s3dm_grid_image');

        if(initialContent.length > 0){
            gsap.to(initalContentText, {x:0, opacity:1, duration: 0.5, delay:0.3});
            gsap.to(initalContentImage, {x: 0,duration: 0.5,opacity: 1,delay: 0.3});
        }

        navElements.on('click', function(event){
            
            var $clickedNav = jQuery(this);
            var currentIndex = parseInt($element.find('.uk-active').attr('indexcount'));

            var nextIndex = currentIndex + 1;
            var prevIndex = currentIndex - 1;
            

            //Do only something if element is not disabled
            if(!$clickedNav.hasClass('disabled')){

                if($clickedNav.hasClass('s3dm_tab_navigation_next')){

                    UIkit.switcher('.s3dm_switcher').show(nextIndex);

                }

                if($clickedNav.hasClass('s3dm_tab_navigation_prev')){

                    UIkit.switcher('.s3dm_switcher').show(prevIndex);


                }
                
            }
            
           

        })

        jQuery(document).on('shown', $element, function(event, element){
            
            var activeContentElement = event.target;
            var navActive = element;

            var text = jQuery(activeContentElement).find('.s3dm_grid_content');
            var image = jQuery(activeContentElement).find('.s3dm_grid_image')

            gsap.to(text, {x:0, opacity:1, duration: 0.5, delay:0.3});

            gsap.to(image, {x: 0,duration: 0.5,opacity: 1,delay: 0.3});

            var currentIndex = parseInt($element.find('.uk-active').attr('indexcount'));

            var nextIndex = currentIndex + 1;
            var prevIndex = currentIndex - 1;

            if(nextIndex > max_items){
                nextNav.addClass('disabled');
            }

            if(nextIndex <= max_items){
                nextNav.removeClass('disabled');
            }

            if(prevIndex < 0){
                prevNav.addClass('disabled');
            }

            if(prevIndex >= 0){
                prevNav.removeClass('disabled');
            }


        });

        jQuery(document).on('beforehide', $element, function(event, element){

            var activeContentElement = event.target;
            var navActive = element;

            var text = jQuery(activeContentElement).find('.s3dm_grid_content');
            var image = jQuery(activeContentElement).find('.s3dm_grid_image')

            gsap.to(text, {x:-100, opacity:0, duration: 0.5, delay:0.3});

            gsap.to(image, {x: 100, duration: 0.5,opacity: 0, delay: 0.3});

        });



    });

</script>