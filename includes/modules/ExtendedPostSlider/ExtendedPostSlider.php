<?php

class S3DM_ExtendedPostSlider extends ET_Builder_Module_Type_PostBased {

	public $slug       = 's3dm_extended_post_slider';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => 's3-advertising',
		'author_uri' => 'https://s3-advertising.com',
	);

	public function init() {
		$this->name = esc_html__( 'Extended Post Slider', 's3dm-s3-divi-modules' );
	}

	public function get_fields() {
		return array(
            'post_type'  => array(
				'label'            => esc_html__( 'Post Type', 'et_builder' ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'options'          => et_get_registered_post_type_options( false, false ),
				'description'      => esc_html__( 'Choose posts of which post type you would like to display.', 'et_builder' ),
				'computed_affects' => array(
					'__postData',
				),
				'default'          => 'post',
			),
            'posts_number'  => array(
				'label'            => esc_html__( 'Post Count', 'et_builder' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose how much posts you would like to display per page.', 'et_builder' ),
				'computed_affects' => array(
					'__postData',
				),
				'default'          => 3,
			),
            'include_categories'            => array(
				'label'            => esc_html__( 'Included Categories', 'et_builder' ),
				'type'             => 'categories',
				'meta_categories'  => array(
					'all'     => esc_html__( 'All Categories', 'et_builder' ),
					'current' => esc_html__( 'Current Category', 'et_builder' ),
				),
				'option_category'  => 'basic_option',
				'renderer_options' => array(
					'use_terms' => false,
				),
				'description'      => esc_html__( 'Choose which categories you would like to include in the feed.', 'et_builder' ),
				'computed_affects' => array(
					'__postData',
				),
			),
            'show_more'                     => array(
				'label'            => esc_html__( 'Show Read More Button', 'et_builder' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'off' => et_builder_i18n( 'No' ),
					'on'  => et_builder_i18n( 'Yes' ),
				),
				'affects'	=> array(
					'button_text',
				),
				'description'      => esc_html__( 'Here you can define whether to show "read more" link after the excerpts or not.', 'et_builder' ),
				'default_on_front' => 'off',
			),
			'button_text'                     => array(
				'label'            => esc_html__( 'Read More Button Text', 'et_builder' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'depends_show_if'  => 'on',
				'description'      => esc_html__( 'Here you can define which text the button should have', 'et_builder' ),
			),
            'show_author'                   => array(
				'label'            => esc_html__( 'Show Author', 'et_builder' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'description'      => esc_html__( 'Turn on or off the author link.', 'et_builder' ),
				'default_on_front' => 'on',
			),
			'show_date'                     => array(
				'label'            => esc_html__( 'Show Date', 'et_builder' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'description'      => esc_html__( 'Turn the date on or off.', 'et_builder' ),
				'default_on_front' => 'on',
				'mobile_options'   => true,
				'hover'            => 'tabs',
			),
			'show_categories'               => array(
				'label'            => esc_html__( 'Show Categories', 'et_builder' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'description'      => esc_html__( 'Turn the category links on or off.', 'et_builder' ),
				'default_on_front' => 'on',
			),
			'show_arrows'               => array(
				'label'            => esc_html__( 'Show navigation arrows', 'et_builder' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'description'      => esc_html__( 'Show or hide navigation arrows.', 'et_builder' ),
				'default_on_front' => 'on',
			),
            'meta_date'                     => array(
				'label'            => esc_html__( 'Date Format', 'et_builder' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'If you would like to adjust the date format, input the appropriate PHP date format here.', 'et_builder' ),
				'default'          => 'M j, Y',
			),
            'slider_animation'   => array(
				'label'            => esc_html__( 'Slider animation', 'et_builder' ),
				'type'             => 'select',
				'option_category'  => 'configuration',
                'options'          => array(
                    'slide'        => esc_html__( 'Slide', 'et_builder' ),
                    'fade'        => esc_html__( 'Fade', 'et_builder' ),
                    'scale'        => esc_html__( 'Scale', 'et_builder' ),
                    'pull'        => esc_html__( 'Pull', 'et_builder' ),
                    'push'        => esc_html__( 'Push', 'et_builder' ),
                ),
				'description'      => esc_html__( 'If you would like to adjust the date format, input the appropriate PHP date format here.', 'et_builder' ),
				'default'          => 'fade',
			),
            'slider_duration'                     => array(
				'label'            => esc_html__( 'Slider interval', 'et_builder' ),
				'type'             => 'number',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Slider interval in seconds', 'et_builder' ),
			),
			'slider_min_height'	=> array(
				'label'  => esc_html__( 'Slider min height', 'et_builder' ),
				'type'             => 'number',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Slider min-height in px', 'et_builder' ),
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
                $cats[] = '<div><span class="'.$class_prefix.'_category">'.$cat->name.'</span></div>';
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

        $animation = $this->props['slider_animation'];

        if(is_numeric($interval)):
            $interval = intval($interval)*1000;
        else:
            $interval = '3000';
        endif;

        

        $slider = '<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1"><ul class="uk-slideshow-items">';

		
        $slideNav = '<a class="uk-position-center-left uk-position-small uk-hidden-hover uk-light" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>';
        $slideNav .= '<a class="uk-position-center-right uk-position-small uk-hidden-hover uk-light" href="#" uk-slidenav-next uk-slideshow-item="next"></a>';
		

        foreach($sliderPosts['posts'] as $postData){

            $slider .= '<li class="uk-background-cover" style="background-image: url('.$postData['imageSrc'].');" >';
			
			if($show_button == 'off'):
				$slider .= '<a href="'.$postData['link'].'" class="uk-position-cover" style="z-index: 10"></a>';
			endif;

            $slider .=  '<img uk-cover src="'.$postData['imageSrc'].'" alt="'.$postData['title'].'">';
            $slider .=  '<div class="'.$class_prefix.'content uk-position-center-left" style="z-index: 2; width:100%;">';

            $slider .=      '<div class="et_pb_row">';

            if($show_date === 'on'):
                $slider .= '<div class="'.$class_prefix.'date">'.$postData['date'].'</div>';
            endif;

            if($show_categories === 'on'):
                $slider .= '<div class="'.$class_prefix.'categories uk-grid-small uk-margin-top" uk-grid>'.$postData['categories'].'</div>';
            endif;

            $slider .=          '<h1 style="color:'.$this->props['module_text_color'].'">'.$postData['title'].'</h1>';
            $slider .=          '<p class="uk-light" style="color:'.$this->props['module_text_color'].'">'.$postData['excerpt'].'</p>';

            if($show_button === 'on'):
                $slider .= '<div class="'.$class_prefix.'button"><a class="uk-button uk-button-primary '.$class_prefix.'button" href="'.$postData['link'].'">'.$this->props['button_text'].'</a></div>';
            endif;

            $slider .=      '</div>';
            $slider .=  '</div>';
            $slider .= '<div class="uk-position-cover" style="opacity: 0.5; background: #000; z-index: 1;"></div>';
            $slider .= '</li>';


        }

        $slider .= '</ul>';
		if($show_arrows == 'on'):
        	$slider .= $slideNav;
		endif;
        $slider .= '</div>';
        
        $moduleID = $sliderPosts['moduleID'];

		$output = '<div id="'.$moduleID.'">';

        $output .= sprintf(
			'<div uk-slideshow="min-height: '.$this->props['slider_min_height'].'; animation:'.$animation.'; duration:'.$interval.'; autoplay:true;">
			    %1$s
			</div>',
            $slider
		);

		$output .= '</div>';

		return $output;
	}

}

new S3DM_ExtendedPostSlider;
