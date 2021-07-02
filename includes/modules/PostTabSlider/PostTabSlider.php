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
        
		$templateLoc = new League\Plates\Engine(get_base_plugin_path().'/templates/modules/PostTabSlider');
		$this->view = $templateLoc;

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
			'title_size'              => array(
				'label'            => esc_html__( 'Title size', 's3dm-s3-divi-modules' ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'options'          => array(
					'ehi-h1'  => et_builder_i18n( 'H1' ),
					'ehi-h2' => et_builder_i18n( 'H2' ),
					'ehi-h3'  => et_builder_i18n( 'H3' ),
					'ehi-h4' => et_builder_i18n( 'H4' ),
				),
				'default_on_front' => 'ehi-h2',
				'toggle_slug'      => 'elements',
				'description'      => esc_html__( 'This setting will turn on and off the featured image in the slider.', 's3dm-s3-divi-modules' ),
				'mobile_options'   => true,
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
			'linktext' => array(
				'label'            => esc_html__( 'Link Text', 's3dm-s3-divi-modules' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose which Link Text you would like to display.', 's3dm-s3-divi-modules' ),
				'toggle_slug'      => 'main_content',
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
			$imageURL = get_the_post_thumbnail_url($sliderContents->ID, 'et-pb-portfolio-module-image');
			
			if(!$imageURL):
				$imageURL = get_the_post_thumbnail_url($sliderContents->ID, 'full');
			endif;

			$wpImageHTML = get_the_post_thumbnail($sliderContents->ID, 'et-pb-portfolio-module-image');

			if(!$wpImageHTML):
				$wpImageHTML = get_the_post_thumbnail($sliderContents->ID, 'full');
			endif;

            $cats = array();
     
            foreach($categories as $c){
                $cat = get_category( $c );
                $cats[] = '<div><span class="s3dm_tab_slider_category">'.$cat->name.'</span></div>';
            }

            $categoryList = implode('', $cats);

			if ( has_excerpt($sliderContents->ID) ) {

				$trim_text = get_the_excerpt($sliderContents->ID);
				$truncate = wordwrap($trim_text, 270, "\0");
				$excerpt = '<p>'.preg_replace('/^(.*?)\0(.*)$/is', '$1', $truncate).' ...</p>';

			} else {
				$excerpt = wpautop( et_delete_post_first_video( strip_shortcodes( truncate_post( 270, false, $sliderContents, true ) ) ) );
			}

			$posts['postData'][$postCount]['title'] = get_the_title($sliderContents->ID);
			$posts['postData'][$postCount]['excerpt'] = $excerpt;
			$posts['postData'][$postCount]['image'] = $imageURL;
			$posts['postData'][$postCount]['wpImageHTML'] = $wpImageHTML;
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
            'posts_number'       	=> $this->props['posts_number'],
			'include_categories' 	=> $this->props['include_categories'],
			'orderby'           	=> $this->props['orderby'],
        );

		$title_size = $this->props['title_size'];

        $slider_posts = $this->get_slider_posts($args);

		$platesRender = $this->view->render('PostTabSlider', array(
			'posts' => $slider_posts,
			'title_size' => $title_size,
			'posts_number' => $this->props['posts_number'],
			'linktext' => $this->props['linktext']
		));


		return $platesRender;
	}

}

new S3DM_PostTabSlider;
