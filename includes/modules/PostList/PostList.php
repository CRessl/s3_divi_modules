<?php

class S3DM_PostList extends ET_Builder_Module_Type_PostBased {

	public $slug       = 's3dm_post_list';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => 's3-advertising',
		'author_uri' => 'https://s3-advertising.com',
	);

	public function init() {
		$this->name = esc_html__( 'Post List', 's3dm-s3-divi-modules' );
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
			),
            'layout' => array(
                'label'     => esc_html__('Layout', 's3dm-s3-divi-modules'),
                'type'      => 'select',
                'options'   => array(
                    'default'           => esc_html__('Default List', 's3dm-s3-divi-modules'),
                    'first_post_right'  => esc_html__('First post right', 's3dm-s3-divi-modules'),
                    'grid'              => esc_html__('Grid', 's3dm-s3-divi-modules'),
                ),
                'affects'   => array(
                    'show_image',
                    'show_excerpt'
                ),
                'computed_affects' => array(
                    '__posts',
                )
            ),
            'show_image' => array(
				'label'            => esc_html__( 'Show Featured Image', 's3dm-s3-divi-modules' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
                'toggle_slug'      => 'elements',
				'default_on_front' => 'off',
				'toggle_slug'      => 'featured_image',
				'description'      => esc_html__( 'This setting will turn on and off the featured image in the slider.', 's3dm-s3-divi-modules' ),
                'show_if_not'      => 'first_post_right',
                'affects'          => array(
                    'image_position'
                )
			),
            'image_position' => array(
                'label'     => esc_html__('Layout', 's3dm-s3-divi-modules'),
                'type'      => 'select',
                'options'   => array(
                    'top'          => esc_html__('Before Title and Meta', 's3dm-s3-divi-modules'),
                    'bottom'       => esc_html__('After Title and Meta', 's3dm-s3-divi-modules'),
                    'between'      => esc_html__('Between Title and Meta', 's3dm-s3-divi-modules'),
                ),
                'default_on_front'  => 'top'
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
                'show_if_not'      => 'first_post_right',
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
                    'show_author'
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
                'show_if'          => 'on',
                'affects'          => array(
                    'date_format'
                )
			),
            'date_format' => array(
				'label'            => esc_html__( 'Date Format', 'et_builder' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'If you would like to adjust the date format, input the appropriate PHP date format here.', 'et_builder' ),
				'default'          => 'M j, Y',
                'show_if'          => 'on',
                'computed_affects' => array(
                    '__postData'
                )
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
                'show_if'          => 'on',
			),
            '__postData'                 => array(
				'type'                => 'computed',
				'computed_callback'   => array( 'S3DM_PostList', 'get_post_data' ),
				'computed_depends_on' => array(	
					'posts_number',
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
    
    
    }


    public function render($attrs, $content = null, $render_slug){

        $layout = $this->props['layout'];
        
        $posts_per_page = $this->props['posts_number'];
        $categories = $this->props['include_categories'];
        $dateFormat = $this->props['date_format'];
        
        $show_meta = $this->props['show_meta'];
        $show_date = $this->props['show_date'];
        $show_image = $this->props['show_image'];
        $show_excerpt = $this->props['show_excerpt'];

        $image_position = $this->props['image_position'];

        $queryArgs = [
            'posts_per_page' => $posts_per_page,
            'include_categories' => $categories,
            'post_type' => 'post',
            'post_status' => 'publish',
        ];

        $postData = get_posts($queryArgs);

        $templateData = array();
        $count = 0;

        foreach($postData as $postObject){

            $postID = $postObject->ID;
        
            
            $templateData[$count]['title'] = get_the_title($postID);
            $templateData[$count]['date'] = get_the_date($dateFormat, $postID);
            $templateData[$count]['link'] = get_the_permalink($postID);
            $templateData[$count]['excerpt'] = strip_tags(apply_filters('the_excerpt', get_post_field('post_excerpt', $postObject)));
            $templateData[$count]['image'] = get_the_post_thumbnail($postID, 'full');
          

            $count++;
        }

        switch($layout){

            case 'default':

                //standard list with image options
                
                s3dm_get_template_part('post_list', 'default');
                $output = 'Default';

            break;

            case 'grid':

                // grid layout with selectable columns
                
                s3dm_get_template_part('post_list', 'grid');
                $output = 'Grid';

            break;

            case 'first_post_right':

                //special layout only for archive site 
                //new comment
                s3dm_get_template_part('post_list', 'first_post_right');
                $output = 'First Post Right';

            break;

        }

        return $layout;

    }//end of render function

}

new S3DM_PostList;