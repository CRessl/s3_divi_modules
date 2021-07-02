<?php

class S3DM_ExtendedPostSlider extends ET_Builder_Module_Type_PostBased {

	public $slug       = 's3dm_extended_post_slider';
	public $vb_support = 'on';
	private $view;

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => 's3-advertising',
		'author_uri' => 'https://s3-advertising.com',
	);

	public function __construct(){
        parent::__construct();
        $this->setView();
    }

	public function setView(){
        $this->view = Plates();
    }

	public function init() {
		$this->name = __( 'Extended Post Slider', 's3dm-s3-divi-modules' );
	}

	public function get_fields() {
		return array(
            'post_type'  => array(
				'label'            => __( 'Post Type', 's3dm-s3-divi-modules' ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'options'          => et_get_registered_post_type_options( false, false ),
				'description'      => __( 'Choose posts of which post type you would like to display.', 's3dm-s3-divi-modules' ),
				'computed_affects' => array(
					'__postData',
				),
				'default'          => 'post',
			),
            'posts_number'  => array(
				'label'            => __( 'Post Count', 's3dm-s3-divi-modules' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => __( 'Choose how much posts you would like to display per page.', 's3dm-s3-divi-modules' ),
				'computed_affects' => array(
					'__postData',
				),
				'default'          => 3,
			),
            'include_categories'            => array(
				'label'            => __( 'Included Categories', 's3dm-s3-divi-modules' ),
				'type'             => 'categories',
				'meta_categories'  => array(
					'all'     => __( 'All Categories', 's3dm-s3-divi-modules' ),
					'current' => __( 'Current Category', 's3dm-s3-divi-modules' ),
				),
				'option_category'  => 'basic_option',
				'renderer_options' => array(
					'use_terms' => false,
				),
				'description'      => __( 'Choose which categories you would like to include in the feed.', 's3dm-s3-divi-modules' ),
				'computed_affects' => array(
					'__postData',
				),
			),
            'show_more'                     => array(
				'label'            => __( 'Show Read More Button', 's3dm-s3-divi-modules' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'off' => et_builder_i18n( 'No' ),
					'on'  => et_builder_i18n( 'Yes' ),
				),
				'affects'	=> array(
					'button_text',
				),
				'description'      => __( 'Here you can define whether to show "read more" link after the excerpts or not.', 's3dm-s3-divi-modules' ),
				'default_on_front' => 'off',
			),
			'button_text'                     => array(
				'label'            => __( 'Read More Button Text', 's3dm-s3-divi-modules' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'depends_show_if'  => 'on',
				'description'      => __( 'Here you can define which text the button should have', 's3dm-s3-divi-modules' ),
			),
            'show_author'                   => array(
				'label'            => __( 'Show Author', 's3dm-s3-divi-modules' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'description'      => __( 'Turn on or off the author link.', 's3dm-s3-divi-modules' ),
				'default_on_front' => 'on',
			),
			'show_date'                     => array(
				'label'            => __( 'Show Date', 's3dm-s3-divi-modules' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'description'      => __( 'Turn the date on or off.', 's3dm-s3-divi-modules' ),
				'default_on_front' => 'on',
				'mobile_options'   => true,
				'hover'            => 'tabs',
			),
			'show_categories'               => array(
				'label'            => __( 'Show Categories', 's3dm-s3-divi-modules' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'description'      => __( 'Turn the category links on or off.', 's3dm-s3-divi-modules' ),
				'default_on_front' => 'on',
			),
			'show_arrows'               => array(
				'label'            => __( 'Show navigation arrows', 's3dm-s3-divi-modules' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'description'      => __( 'Show or hide navigation arrows.', 's3dm-s3-divi-modules' ),
				'default_on_front' => 'on',
			),
            'meta_date'                     => array(
				'label'            => __( 'Date Format', 's3dm-s3-divi-modules' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => __( 'If you would like to adjust the date format, input the appropriate PHP date format here.', 's3dm-s3-divi-modules' ),
				'default'          => 'M j, Y',
			),
            'slider_animation'   => array(
				'label'            => __( 'Slider animation', 's3dm-s3-divi-modules' ),
				'type'             => 'select',
				'option_category'  => 'configuration',
                'options'          => array(
                    'slide'        => __( 'Slide', 's3dm-s3-divi-modules' ),
                    'fade'        => __( 'Fade', 's3dm-s3-divi-modules' ),
                    'loop'        => __( 'Loop', 's3dm-s3-divi-modules' ),
                ),
				'description'      => __( 'If you would like to adjust the date format, input the appropriate PHP date format here.', 's3dm-s3-divi-modules' ),
				'default'          => 'fade',
			),
			'autoplay'               => array(
				'label'            => __( 'Activate autoplay', 's3dm-s3-divi-modules' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'description'      => __( 'Activate autoplay.', 's3dm-s3-divi-modules' ),
				'default_on_front' => 'on',
			),
            'slider_duration'                     => array(
				'label'            => __( 'Slider interval', 's3dm-s3-divi-modules' ),
				'type'             => 'number',
				'option_category'  => 'configuration',
				'description'      => __( 'Slider interval in seconds', 's3dm-s3-divi-modules' ),
			),
            '__postData'                 => array(
				'type'                => 'computed',
				'computed_callback'   => array( 'S3DM_ExtendedPostSlider', 'get_post_data' ),
				'computed_depends_on' => array(	
					'post_type',
					'posts_number',
					'include_categories',
				),
			),
		);
	}
    static function get_post_data( $args = array(), $conditional_tags = array(), $current_page = array(), $is_ajax_request = true ) {

        $defaults = array(
            'post_type'             => '',
            'posts_number'          => '',
            'include_categories'    => '',
            'meta_date'             => 'd.m.Y'
        );

        //merges args from computed field with defaults
        $args = wp_parse_args( $args, $defaults );

        $queryArgs = array(
            'numberposts'   => $args['posts_number'],
            'category'      => $args['include_categories'],
            'orderby'       => 'date',
            'order'         => 'DESC',
            'post_type'     => $args['post_type'],
            'post_status'   => 'publish',
        );

        $sliderPosts = get_posts($queryArgs);

        $format = $args['meta_date'];

        $postData = array();
        $postCount = 0;
		$class_prefix = 's3dm_extended_post_slider';
		
        foreach($sliderPosts as $post){

            $postID = $post->ID;

            $title = get_the_title($postID);
            $excerpt = strip_tags(apply_filters('the_excerpt', get_post_field('post_excerpt', $post)));
            $link = get_the_permalink($postID);
            $date = get_the_date($format, $postID);
            $image = get_the_post_thumbnail_url($postID, 'full');
            $categories = wp_get_post_categories($postID);
            $author = $post->post_author;


            $cats = array();
			

            foreach($categories as $c){
                $cat = get_category( $c );
				$category_link = get_category_link( $c );
                $cats[] = '<div><a href="'.$category_link.'" target="_self"><span class="'.$class_prefix.'_category">'.$cat->name.'</span></a></div>';
            }

            $categoryList = implode('', $cats);



            $postData['posts'][$postCount] = array(
                'title' => $title,
                'excerpt' => $excerpt,
                'link'  => $link,
                'categories' => $categoryList,
                'date'  => $date,
                'imageSrc' => $image,
                'author' => $author,
            );

            $postCount++;

        }

        $postData['moduleID'] = 's3dm_extended_slider_id_'.rand(10, 500);

        
        return $postData;

    }

	protected function _render_module_wrapper( $output = '', $render_slug = '' ) {
		return $output;
	} 

	public function render( $attrs, $content = null, $render_slug ) {

       
		$class_prefix = $this->slug.'_';
		$args = array(
			'posts_number' => $this->props['posts_number'],
			'include_categories' => $this->props['include_categories'],
			'post_type' => $this->props['post_type'],
		);

        $sliderPosts = $this->get_post_data($args);

        $show_categories = $this->props['show_categories'];
        $show_date = $this->props['show_date'];
        $show_author = $this->props['show_author'];
		$show_button = $this->props['show_more'];
		$show_arrows = $this->props['show_arrows'];

        $interval = $this->props['slider_duration'];
		$autoplay = $this->props['autoplay'];
        $animation = $this->props['slider_animation'];

        if(is_numeric($interval)):
            $interval = intval($interval)*1000;
        else:
            $interval = '3000';
        endif;

        

        $slider = '<div class="splide__track">';
		$slider.= 	'<ul class="splide__list">';
		

        foreach($sliderPosts['posts'] as $postData){

            $slider .= $this->view->render('modules/ExtendedPostSlider/partials/ExtendedPostSlider_Item', array(
				'class_prefix' => $class_prefix,
				'title' => $postData['title'],
				'imageSrc' =>$postData['imageSrc'],
				'excerpt' => $postData['excerpt'],
				'date' => $postData['date'],
				'link' => $postData['link'],
				'categories' => $postData['categories'],
				'author' => $postData['author'],
				'button_text' => $this->props['button_text'],
				'show_date' => $show_date,
				'show_categories' => $show_categories,
				'show_button' => $show_button,
				'module_text_color' => $this->props['module_text_color'],
			));

        }

		$slider .= 	'</ul>';
        $slider .= '</div>';

		$splideOptions = array(
			'interval'			=> $interval,
			'type'				=> $animation,
			'perPage'			=> 1,
			'padding'			=> 0,
			'gap'				=> 0,
			'rewind'			=> true,
			'speed'				=> 1000,
			'waitForTransition'	=> true,
			'pagination'		=> false
		);

		if($autoplay == 'on'):
			$splideOptions['autoplay'] = true;
		endif;

		$splideJSON = "'".json_encode($splideOptions, JSON_HEX_QUOT)."'";
        
        $moduleID = $sliderPosts['moduleID'];

        $output = sprintf(
			'<div id="%2$s" class="splide '.$this->slug.'" data-splide=%3$s>
			    %1$s
			</div>',
            $slider,
			$moduleID,
			$splideJSON
		);

	

		return $output;
	}

}

new S3DM_ExtendedPostSlider;