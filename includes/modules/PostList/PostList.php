<?php

class S3DM_PostList extends ET_Builder_Module_Type_PostBased {

	public $slug       = 's3dm_post_list';
	public $vb_support = 'on';
    private $view;

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => 's3-advertising',
		'author_uri' => 'https://s3-advertising.com',
	);

	public function init() {
		$this->name = esc_html__( 'Post List', 's3dm-s3-divi-modules' );
	}

    public function __construct(){
        parent::__construct();
        $this->setView();
    }

    public function setView(){
        $this->view = Plates();
    }

    public function get_fields(){

        $fields = array(
            'posts_number' => array(
				'label'            => esc_html__( 'Post Count', 's3dm-s3-divi-modules' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose how many posts you would like to display in the slider.', 's3dm-s3-divi-modules' ),
				'toggle_slug'      => 'main_content',
				'computed_affects' => array(
					'__postData',
				),
			),
            'post_type'  => array(
				'label'            => esc_html__( 'Post Type', 's3dm-s3-divi-modules' ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'options'          => et_get_registered_post_type_options( false, false ),
				'description'      => esc_html__( 'Choose posts of which post type you would like to display.', 's3dm-s3-divi-modules' ),
				'computed_affects' => array(
					'__postData',
				),
                'affects'          => array(
                    'include_categories'
                ),
				'toggle_slug'      => 'main_content',
				'default'          => 'post',
			),
            'include_categories' => array(
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
					'__postData',
				),
                'show_if'           => array(
                    'post_type' => 'post',
                    'post_type' => 'ehi_products'
                )
			),
            'post_list_layout' => array(
                'label'     => esc_html__('Layout', 's3dm-s3-divi-modules'),
                'type'      => 'select',
                'options'   => array(
                    'default'           => esc_html__('Default List', 's3dm-s3-divi-modules'),
                    'first_post_left'  => esc_html__('First post left', 's3dm-s3-divi-modules'),
                    'grid'              => esc_html__('Grid', 's3dm-s3-divi-modules'),
                ),
                'toggle_slug' => 'main_content',
                'affects'   => array(
                    'show_image',
                    'show_excerpt'
                ),
                'default_on_front' => 'default',
            ),
            'columns' => array(
                'label'     => esc_html__('Layout', 's3dm-s3-divi-modules'),
                'type'      => 'select',
                'options'   => array(
                    '2'     => esc_html__('Two Columns', 's3dm-s3-divi-modules'),
                    '3'     => esc_html__('Three Columns', 's3dm-s3-divi-modules'),
                    '4'     => esc_html__('Four Columns', 's3dm-s3-divi-modules'),
                ),
                'show_if'   => array(
                    'post_list_layout' => 'grid'
                ),
                'toggle_slug' => 'main_content',
                'default_on_front' => '3',
            ),
            'show_image' => array(
				'label'            => esc_html__( 'Show Featured Image', 's3dm-s3-divi-modules' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
                'toggle_slug'      => 'featured_image',
				'default_on_front' => 'off',
				'description'      => esc_html__( 'This setting will turn on and off the featured image in the slider.', 's3dm-s3-divi-modules' ),
                'show_if_not'      => array(
                    'post_list_layout' => 'first_post_left'
                ),
                'affects'          => array(
                    'image_position'
                )
			),
            'image_position' => array(
                'label'     => esc_html__('Image position', 's3dm-s3-divi-modules'),
                'type'      => 'select',
                'toggle_slug' => 'featured_image',
                'options'   => array(
                    'top'          => esc_html__('Before Title and Meta', 's3dm-s3-divi-modules'),
                    'bottom'       => esc_html__('After Title and Meta', 's3dm-s3-divi-modules'),
                    'between'      => esc_html__('Between Meta and Excerpt', 's3dm-s3-divi-modules'),
                ),
                'default_on_front'  => 'top',
                'show_if'   => array(
                    'show_image' => 'on',
                    'post_list_layout' => 'default'
                )
            ),
            'show_excerpt' => array(
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
                'show_if_not'      => array(
                    'post_list_layout' => 'first_post_left',
                )
			),
            'show_meta' => array(
				'label'            => esc_html__( 'Show Post Meta', 's3dm-s3-divi-modules' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
                'affects'          => array(
                    'show_date',
                    'show_tags',
                ),
				'default_on_front' => 'on',
				'toggle_slug'      => 'elements',
				'description'      => esc_html__( 'This setting will turn on and off the meta section.', 's3dm-s3-divi-modules' ),
			),
            'show_date' => array(
				'label'            => esc_html__( 'Show Date', 's3dm-s3-divi-modules' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'default_on_front' => 'on',
				'toggle_slug'      => 'elements',
				'description'      => esc_html__( 'This setting will turn on and off the date section.', 's3dm-s3-divi-modules' ),
                'show_if'          => array(
                    'show_meta' => 'on'
                ),
                'affects'          => array(
                    'date_format'
                )
			),
            'date_format' => array(
				'label'            => esc_html__( 'Date Format', 's3dm-s3-divi-modules' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'If you would like to adjust the date format, input the appropriate PHP date format here.', 's3dm-s3-divi-modules' ),
				'default'          => 'M j, Y',
                'show_if'          => array(
                    'show_date' => 'on',
                ),
                'computed_affects' => array(
                    '__postData'
                ),
                'toggle_slug'      => 'elements',
			),
            'show_tags' => array(
				'label'            => esc_html__( 'Show Tags', 's3dm-s3-divi-modules' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'default_on_front' => 'on',
				'toggle_slug'      => 'elements',
				'description'      => esc_html__( 'This setting will turn on and off the tag section.', 's3dm-s3-divi-modules' ),
                'show_if'          => array(
                    'show_meta' => 'on'
                ),
			),
            '__postData'                 => array(
				'type'                => 'computed',
				'computed_callback'   => array( 'S3DM_PostList', 'get_post_data' ),
				'computed_depends_on' => array(	
					'posts_number',
                    'post_type',
					'include_categories',
                    'date_format'
				),
			),
        );

        return $fields;
    

    }
    static function get_post_data( $args = array(), $conditional_tags = array(), $current_page = array(), $is_ajax_request = true ) {
    
        $defaults = array(
            'post_type'             => 'post',
            'posts_number'          => '',
            'include_categories'    => '',
            'date_format'             => 'd.m.Y'
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

        $posts = get_posts($queryArgs);
        $fsBuilder = [];

       


        foreach($posts as $data){

            $postID = $data->ID;

            $tags = get_the_tags($postID);

            $tagData = [];
    
            foreach($tags as $tag){
    
                $tagData[] = '<span className="tags">'.$tag->name.'</span>';
    
            }
    
            $tagRender = implode(' ', $tagData);


            $fsBuilder[] = array(
                'title' => get_the_title($postID),
                'image' => get_the_post_thumbnail($postID, 'full'),
                'tags'  => $tagRender,
                'excerpt' => strip_tags(apply_filters('the_excerpt', get_post_field('post_excerpt', $data))),
                'date' => get_the_date($args['date_format'], $postID),
                'link' => get_the_permalink($postID)
            );

        }
    
        return $fsBuilder;

    }


    public function render( $attrs, $content = null, $render_slug ) {

        $layout = $this->props['post_list_layout'];

        $settings = array(

            'show_meta' => $this->props['show_meta'],
            'show_date' => $this->props['show_date'],
            'show_image' => $this->props['show_image'],
            'show_excerpt' => $this->props['show_excerpt'],
            'image_position' => $this->props['image_position'],
            'show_tags' => $this->props['show_tags'],

        );
        
        
        $posts_per_page = $this->props['posts_number'];
        $categories = $this->props['include_categories'];
        $dateFormat = $this->props['date_format'];
        
        $queryArgs = array(
            'numberposts' => $posts_per_page,
            'category'  => $categories
        );

        if(!$categories){
            unset($queryArgs['category']);
        }

        $postData = get_posts($queryArgs);

        
        if($layout === 'default'):
            
            ob_start();
            echo '<ul class="uk-list" style="list-style-type:none;">';
            foreach($postData as $data){
                $postID = $data->ID;

                echo $this->view->render('modules/PostList/partials/'.$layout, array(
                    'title' => get_the_title($postID),
                    'image' => get_the_post_thumbnail($postID, 'full'),
                    'tags'  => get_the_tags($postID),
                    'excerpt' => strip_tags(apply_filters('the_excerpt', get_post_field('post_excerpt', $data))),
                    'date' => get_the_date($dateFormat, $postID),
                    'link' => get_the_permalink($postID),
                    'settings' => $settings
                ));
            }
            echo '</ul>';

            $layoutOutput = ob_get_clean();
         
        endif;


        if($layout === 'grid'):

            ob_start();
            echo '<div class="s3dm_post_list_grid uk-grid uk-grid-match uk-child-width-1-1 uk-child-width-1-'.$this->props['columns'].'@m" uk-grid>';
            foreach($postData as $data){
                $postID = $data->ID;
              
                echo $this->view->render('modules/PostList/partials/'.$layout, array(
                    'title' => get_the_title($postID),
                    'image' => get_the_post_thumbnail($postID, 'full'),
                    'tags'  => get_the_tags($postID),
                    'excerpt' => strip_tags(apply_filters('the_excerpt', get_post_field('post_excerpt', $data))),
                    'date' => get_the_date($dateFormat, $postID),
                    'link' => get_the_permalink($postID),
                    'settings' => $settings
                ));
            }
            echo '</div>';

            $layoutOutput = ob_get_clean();
            
        endif;


        if($layout === 'first_post_left'):
            $count = 0;

            ob_start();
            echo '<div class="topics-news uk-child-width-1-2@m uk-child-width" uk-grid>';
                echo '<div>';
                    $postID = $postData[0]->ID;
                        
                    echo $this->view->render('modules/PostList/partials/'.$layout, array(
                        'first_post' => true,
                        'title' => get_the_title($postID),
                        'image' => get_the_post_thumbnail($postID, 'full'),
                        'tags'  => get_the_tags($postID),
                        'excerpt' => strip_tags(apply_filters('the_excerpt', get_post_field('post_excerpt', $postData[0]))),
                        'date' => get_the_date($dateFormat, $postID),
                        'link' => get_the_permalink($postID), 
                    ));

                echo '</div>';
                echo '<div>';
                unset($postData[0]);
                foreach($postData as $data){

                    $postID = $data->ID;

                    echo $this->view->render('modules/PostList/partials/'.$layout, array(
                        'first_post' => false,
                        'title' => get_the_title($postID),
                        'image' => get_the_post_thumbnail($postID, 'full'),
                        'tags'  => get_the_tags($postID),
                        'excerpt' => strip_tags(apply_filters('the_excerpt', get_post_field('post_excerpt', $data))),
                        'date' => get_the_date($dateFormat, $postID),
                        'link' => get_the_permalink($postID),
                    ));


                }
                echo '</div>';
            echo '</div>';

            $layoutOutput = ob_get_clean();


        endif;


        $output = sprintf(
            '<div>%1$s</div>',
            $layoutOutput
        );

        return $output;

    }//end of render function

}

new S3DM_PostList;