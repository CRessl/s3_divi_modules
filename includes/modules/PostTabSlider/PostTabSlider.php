<?php

class S3DM_PostTabSlider extends ET_Builder_Module_Type_PostBased {

	public $slug       = 's3dm_post_tab_slider';
	public $vb_support = 'on';
	private $view;

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => 's3-advertising',
		'author_uri' => 'https://s3-advertising.com',
	);

	public function init() {
		$this->name = esc_html__( 'Post Tab Slider', 's3dm-s3-divi-modules' );
	}

	public function __construct(){
        parent::__construct();
        $this->setView();
    }

    public function setView(){
        $this->view = Plates();
    }

	public function get_fields() {
		return array(
            'posts_number'            => array(
				'label'            => esc_html__( 'Post Count', 's3dm-s3-divi-modules' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose how many posts you would like to display in the slider.', 's3dm-s3-divi-modules' ),
				'toggle_slug'      => 'main_content',
				'computed_affects' => array(
					'__posts',
				),
			),
            'include_categories'      => array(
				'label'            => esc_html__( 'Included Categories', 's3dm-s3-divi-modules' ),
				'type'             => 'categories',
				'meta_categories'  => array(
					'all'     => esc_html__( 'All Categories', 's3dm-s3-divi-modules' ),
					'current' => esc_html__( 'Current Category', 's3dm-s3-divi-modules' ),
				),
				'option_category'  => 'basic_option',
				'description'      => esc_html__( 'Choose which categories you would like to include in the slider.', 's3dm-s3-divi-modules' ),
				'toggle_slug'      => 'main_content',
				'computed_affects' => array(
					'__posts',
				),
			),
            'orderby'                 => array(
				'label'            => esc_html__( 'Order By', 's3dm-s3-divi-modules' ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'options'          => array(
					'date_desc'  => esc_html__( 'Date: new to old', 's3dm-s3-divi-modules' ),
					'date_asc'   => esc_html__( 'Date: old to new', 's3dm-s3-divi-modules' ),
					'title_asc'  => esc_html__( 'Title: a-z', 's3dm-s3-divi-modules' ),
					'title_desc' => esc_html__( 'Title: z-a', 's3dm-s3-divi-modules' ),
					'rand'       => esc_html__( 'Random', 's3dm-s3-divi-modules' ),
				),
				'toggle_slug'      => 'main_content',
				'description'      => esc_html__( 'Here you can adjust the order in which posts are displayed.', 's3dm-s3-divi-modules' ),
				'computed_affects' => array(
					'__posts',
				),
				'show_if'          => array(
					'use_current_loop' => 'off',
				),
				'default_on_front' => 'date_desc',
			),
            'show_image'              => array(
				'label'            => esc_html__( 'Show Featured Image', 's3dm-s3-divi-modules' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'default_on_front' => 'on',
				'toggle_slug'      => 'featured_image',
				'description'      => esc_html__( 'This setting will turn on and off the featured image in the slider.', 's3dm-s3-divi-modules' ),
				'mobile_options'   => true,
			),
            'show_excerpt'         => array(
				'label'            => esc_html__( 'Show Excerpt', 's3dm-s3-divi-modules' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'default_on_front' => 'on',
				'toggle_slug'      => 'elements',
				'description'      => esc_html__( 'This setting will display the excerpt of the post', 's3dm-s3-divi-modules' ),
				'mobile_options'   => true,
			),
            'show_meta'               => array(
				'label'            => esc_html__( 'Show Post Meta', 's3dm-s3-divi-modules' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'default_on_front' => 'on',
				'toggle_slug'      => 'elements',
				'description'      => esc_html__( 'This setting will turn on and off the meta section.', 's3dm-s3-divi-modules' ),
				'mobile_options'   => true,
			),
            'image_placement'         => array(
				'label'            => esc_html__( 'Featured Image Placement', 's3dm-s3-divi-modules' ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'options'          => array(
					'background' => et_builder_i18n( 'Background' ),
					'left'       => et_builder_i18n( 'Left' ),
					'right'      => et_builder_i18n( 'Right' ),
				),
				'default_on_front' => 'right',
				'depends_show_if'  => 'on',
				'toggle_slug'      => 'featured_image',
				'description'      => esc_html__( 'Select how you would like to display the featured image in slides', 's3dm-s3-divi-modules' ),
			),
            '__posts'                 => array(
				'type'                => 'computed',
				'computed_callback'   => array( 'S3DM_PostTabSlider', 'get_slider_posts' ),
				'computed_depends_on' => array(	
					'posts_number',
					'include_categories',
					'orderby',
				),
			),
		);
	}
    static function get_slider_posts( $args = array(), $conditional_tags = array(), $current_page = array(), $is_ajax_request = true ) {

        $defaults = array(
			'posts_number'       => '',
			'include_categories' => '',
			'orderby'            => '',
		);

        $queryArgs = array(
            'numberposts'        => $args['posts_number'],
            'category'           => $args['include_categories'],
            'post_status'        => array( 'publish', 'private' ),
        );

        if ( 'date_desc' !== $args['orderby'] ) {
			switch ( $args['orderby'] ) {
				case 'date_asc':
					$queryArgs['orderby'] = 'date';
					$queryArgs['order']   = 'ASC';
					break;
				case 'title_asc':
					$queryArgs['orderby'] = 'title';
					$queryArgs['order']   = 'ASC';
					break;
				case 'title_desc':
					$queryArgs['orderby'] = 'title';
					$queryArgs['order']   = 'DESC';
					break;
				case 'rand':
					$queryArgs['orderby'] = 'rand';
					break;
			}
		}


        $posts = get_posts($queryArgs);
		$postCount = 0;

		$componentID = rand(1, 500);

		foreach($posts as $sliderContents){

			$categories = wp_get_post_categories($sliderContents->ID);

            $cats = array();
     
            foreach($categories as $c){
                $cat = get_category( $c );
                $cats[] = '<div><span class="s3dm_tab_slider_category">'.$cat->name.'</span></div>';
            }

            $categoryList = implode('', $cats);

			$posts['postData'][$postCount]['title'] = get_the_title($sliderContents->ID);
			$posts['postData'][$postCount]['excerpt'] = get_the_excerpt($sliderContents->ID);
			$posts['postData'][$postCount]['image'] = get_the_post_thumbnail_url($sliderContents->ID, 'full');
			$posts['postData'][$postCount]['categories'] = $categoryList;
			$posts['postData'][$postCount]['link'] = get_the_permalink($sliderContents->ID);
			$posts['postData'][$postCount]['style'] = array('backgroundImage' => $posts['postData'][$postCount]['image']);

			$postCount++;
		}
		$posts['componentID'] = $componentID;
        return $posts;

    }

	public function render( $attrs, $content = null, $render_slug ) {

        $args = array(
            'numberposts'       => $this->props['posts_number'],
			'category' 			=> $this->props['include_categories'],
			'orderby'           => $this->props['orderby'],
        );

        $slider_posts = get_posts($args);

        $nav = '<div class="s3dm_switcher s3dm_tab_navigation uk-grid uk-child-width-1-'.$this->props['posts_number'].'" uk-switcher="connect:.s3dm_tab_contents; animation: uk-animation-fade">';

        foreach($slider_posts as $sliderContent){

            $title = get_the_title($sliderContent->ID);
            $categories = wp_get_post_categories($sliderContent->ID);

            $cats = array();
     
            foreach($categories as $c){
                $cat = get_category( $c );
                $cats[] = '<div><span class="s3dm_tab_slider_category">'.$cat->name.'</span></div>';
            }

            $cat_list = implode('', $cats);

			$nav .= $this->view->render('modules/PostTabSlider/partials/PostTabSlider_Nav', array(
                   'categories' => $cat_list,
				   'title' => $title
            ));
           

        }

        $nav .= '</div>';


        $content = '<div class="uk-switcher s3dm_tab_contents">';
        foreach($slider_posts as $sliderContentTab){

            $title = get_the_title($sliderContentTab->ID);
            $categories = wp_get_post_categories($sliderContentTab->ID);
 
			if ( has_excerpt($sliderContentTab->ID) ) {

				$trim_text = get_the_excerpt($sliderContentTab->ID);
				$truncate = wordwrap($trim_text, 270, "\0");
				$excerpt = '<p>'.preg_replace('/^(.*?)\0(.*)$/is', '$1', $truncate).' ...</p>';

			} else {
				$excerpt = wpautop( et_delete_post_first_video( strip_shortcodes( truncate_post( 270, false, $sliderContentTab, true ) ) ) );
			}

            $link = '<a href="'.get_the_permalink($sliderContentTab->ID).'">Zum Artikel</a>';
			//Title, Category and Exerpt
			$imageURL = get_the_post_thumbnail_url($sliderContentTab->ID, 'full');
			$wpImageHTML = get_the_post_thumbnail($sliderContentTab->ID, 'full');

            $cats = array();
     
            foreach($categories as $c){
                $cat = get_category( $c );
                $cats[] = '<div><span class="s3dm_tab_slider_category">'.$cat->name.'</span></div>';
            }

            $cat_list = implode('', $cats);

            $content .= '<div class="uk-grid uk-child-width-1-2@m uk-child-width-1-1 s3dm_grid_container" uk-grid>';
        	
			$content .= $this->view->render('modules/PostTabSlider/partials/PostTabSlider_Content', array(
				'categories' => $cat_list,
				'title' => $title,
				'imageURL' => $imageURL,
				'imageHTML' => $wpImageHTML,
				'excerpt' => $excerpt,
				'link' => $link,
		 	));
			 
            $content .= '</div>';


        }

        $content .= '</div>';

		
		$script = $this->getScript();


        $output = sprintf(
			'<div id="%4$s">
				<div class="s3dm-tab-slider-content-container uk-margin-large-bottom">
					%1$s
				</div>
				<div class="s3dm-tab-slider-tab-nav-container">                
					%2$s
				</div>
			</div>
			%3$s
			',
            $content,
			$nav,
			$script,
			's3dm_switcher_all_container_'
		);

		return $output;
	}


	public function getScript(){

		$script = ob_start();?>

		<script>
		jQuery(document).ready(function(){

			var $element = jQuery('.s3dm_tab_contents');

			var initialContent = $element.find('.uk-active');
			var initalContentText = initialContent.find('.s3dm_grid_content');
			var initalContentImage = initialContent.find('.s3dm_grid_image');
			console.log(initialContent);

			if(initialContent.length > 0){
				gsap.to(initalContentText, {x:0, opacity:1, duration: 0.5, delay:0.3});
				gsap.to(initalContentImage, {x: 0,duration: 0.5,opacity: 1,delay: 0.3});
			}

			jQuery(document).on('shown', $element, function(event, element){
				
				var activeContentElement = event.target;
				var navActive = element;

				var text = jQuery(activeContentElement).find('.s3dm_grid_content');
				var image = jQuery(activeContentElement).find('.s3dm_grid_image')

				gsap.to(text, {x:0, opacity:1, duration: 0.5, delay:0.3});

				gsap.to(image, {x: 0,duration: 0.5,opacity: 1,delay: 0.3});

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

		<?php

		$scriptOutput = ob_get_clean();

		return $scriptOutput;

	}
}

new S3DM_PostTabSlider;
