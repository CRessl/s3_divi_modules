<?php

class S3DM_EventList extends ET_Builder_Module_Type_PostBased {

	public $slug       = 's3dm_event_list';
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
		$this->name = esc_html__( 'Event List', 's3dm-s3-divi-modules' );
	}

	public function get_fields() {
		return array(
            'posts_number'  => array(
				'label'            => esc_html__( 'Post Count', 's3dm-s3-divi-modules' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose how much posts you would like to display per page.', 's3dm-s3-divi-modules' ),
				'computed_affects' => array(
					'__eventData',
				),
				'default'          => 3,
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
			'columns' => array(
				'label'            => esc_html__( 'Columns', 's3dm-s3-divi-modules' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose how much posts you would like to display per page.', 's3dm-s3-divi-modules' ),
				'default'          => 3,
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
				'description'      => esc_html__( 'Here you can define whether to show "read more" link after the excerpts or not.', 's3dm-s3-divi-modules' ),
				'default_on_front' => 'off',
			),
			'button_text'                     => array(
				'label'            => esc_html__( 'Read More Button Text', 'et_builder' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'depends_show_if'  => 'on',
				'description'      => esc_html__( 'Here you can define which text the button should have', 'et_builder' ),
			),
            'meta_date'                     => array(
				'label'            => esc_html__( 'Date Format', 'et_builder' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'If you would like to adjust the date format, input the appropriate PHP date format here.', 'et_builder' ),
				'default'          => 'M j, Y',
                'depends_show_if'  => 'on',
				'computed_affects' => array(
					'__eventData',
				)
			),
            '__eventData'                 => array(
				'type'                => 'computed',
				'computed_callback'   => array( 'S3DM_EventList', 'get_events' ),
				'computed_depends_on' => array(
					'posts_number',
					'meta_date'
				),
			),
		);
	}
    static function get_events( $args = array(), $conditional_tags = array(), $current_page = array(), $is_ajax_request = true ) {

		$defaults = array(
            'posts_number'          => 5,
            'meta_date'             => 'd.m.Y'
        );

        //merges args from computed field with defaults
        $args = wp_parse_args( $args, $defaults );

		$numberposts = $args['posts_number'];
		$dateFormat = $args['meta_date'];

		$query_args = array(
			'start_date' => 'now',
			'posts_per_page' => $numberposts,
		);

		$data = tribe_get_events($query_args);
	

		$postData = array();
		$count = 0;

		foreach($data as $postObject){

			$postData[$count]['date'] = tribe_get_start_date( $postObject, true, $dateFormat );
			$postData[$count]['title'] = $postObject->post_title;
			$postData[$count]['link'] = get_the_permalink($postObject->ID);
			$count++;
		}

		return $postData; 

    }

	public function render( $attrs, $content = null, $render_slug ) {

	
		$numberposts 	= $this->props['posts_number'];
		$dateFormat 	= $this->props['meta_date'];
		$button_text 	= $this->props['button_text'];
		$columns 		= $this->props['columns'];
		$title_size		= $this->props['title_size'];

		if(!$columns){
			$columns = 3;
		}

		if(!$button_text):
			$button_text = 'Zum Event';
		endif;

		if(!$numberposts):
			$numberposts = 5;
		endif;

		$args = array(
			'start_date' => 'now',
			'posts_per_page' => $numberposts,
		);
       
		$data = tribe_get_events($args);
			

		$post_list = '<div uk-slider="finite:true"><ul class="uk-slider-items uk-grid-divider uk-child-width-1-'.$columns.'@m uk-child-width-1-3@s uk-child-width-1-1">';

		foreach($data as $postObject){

			$post_list .= $this->view->render('modules/EventList/partials/EventList_Item', array(
				'columns' 		=> $columns,
				'start_date' 	=> tribe_get_start_date( $postObject, true, $dateFormat ),
				'end_date'		=> tribe_get_end_date( $postObject, true, $dateFormat ),
				'title' 		=> $postObject->post_title,
				'link' 			=> get_the_permalink($postObject->ID),
				'button_text' 	=> $button_text,
				'prefix' 		=> $this->slug,
				'title_size' 	=> $title_size
			));

		}
		
		$post_list .= '</ul>';
		$post_list .= '<a class="uk-position-center-left" href="" uk-slidenav-previous uk-slider-item="previous"></a><a class="uk-position-center-right" href="" uk-slidenav-next uk-slider-item="next"></a>';
		$post_list .= '</div>';
		$output = sprintf(
			'<div class="%2$s">
				%1$s
			</div>
			',
            $post_list,
			$this->slug
		);


		return $output;
		


		
	}

}

new S3DM_EventList;
