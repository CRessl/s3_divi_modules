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
        $this->view = Plates(s3dm_templatePath($this));
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
			$postData[$count]['link'] = tribe_get_event_meta( $postObject->ID, '_EventURL', true );
			$count++;
		}

		return $postData; 

    }

	public function render( $attrs, $content = null, $render_slug ) {

	
		$numberposts 	= $this->props['posts_number'];
		$dateFormat 	= $this->props['meta_date'];
		$columns 		= $this->props['columns'];
		$title_size		= $this->props['title_size'];

		if(!$columns){
			$columns = 3;
		}

		if(!$numberposts):
			$numberposts = 5;
		endif;

		$args = array(
			'start_date' => 'now',
			'posts_per_page' => $numberposts,
		);
       
		$data = tribe_get_events($args);
			

		$post_list = $this->view->render('EventList', array(
			'columns' => $columns,
			'data' => $data,
			'prefix' => $this->slug,
			'dateFormat' => $dateFormat,
			'title_size' => $title_size,
			'module_classname' => $this->module_classname( $render_slug ),
		));

		return $post_list;
		
	}

}

new S3DM_EventList;
