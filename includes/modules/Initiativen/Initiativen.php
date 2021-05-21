<?php

class S3DM_Initiatives extends ET_Builder_Module_Type_PostBased {

	public $slug       = 's3dm_initiativen';
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
		$this->name = esc_html__( 'Initiativen', 's3dm-s3-divi-modules' );
	}

	public function get_fields() {
		return array(
            'query_type' => array(
				'label'            => esc_html__( 'Post Count', 'et_builder' ),
				'type'             => 'select',
                'options'          => array(
                    'category'     => esc_html__('Category', 'et_builder'),
                    'select'       => esc_html__('Single select', 'et_builder'),   
				),
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose which selection you would prefer (Category = current Category | Single select = Select one Workgrioup', 'et_builder' ),
				'default_on_front' => 'select',
                'computed_affects' => array(
					'__eventData',
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
					'__initiativeData',
				),
                'show_if'           => array(
                    'query_type' => 'category',
                ),
                'default' => 'current'
			),
            'posts_number'  => array(
				'label'            => esc_html__( 'Post Count', 'et_builder' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose how much posts you would like to display per page.', 'et_builder' ),
				'computed_affects' => array(
					'__initiativeData',
				),
                'show_if'          => array(
                    'query_type'   => 'category'
				),
				'default_on_front'          => 3,
			),
            'initiatives' => array(
				'label'            => esc_html__( 'Initiative', 'et_builder' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose how much posts you would like to display per page.', 'et_builder' ),
				'computed_affects' => array(
					'__initiativeData',
				),
				'dynamic_content' => 'url',
                'show_if'          => array(
                    'query_type'   => 'select'
                ),
			),
            '__initiativeData'                 => array(
				'type'                => 'computed',
				'computed_callback'   => array( 'S3DM_Initiatives', 'get_initiatives' ),
				'computed_depends_on' => array(
					'posts_number',
                    'query_type',
                    'initiatives',
                    'include_categories'
				),
			),
		);
	}
    static function get_initiatives( $args = array(), $conditional_tags = array(), $current_page = array(), $is_ajax_request = true ) {

		

    }

	public function render( $attrs, $content = null, $render_slug ) {		

        $query_type = $this->props['query_type'];
        $post_number = $this->props['posts_number'];
        $initiatives = $this->props['initiatives'];
        $categories = $this->props['include_categories'];

        if($query_type === 'category' && $categories === 'current'){
            
            $current_category = get_queried_object();
            $catID = $category->term_id;

            $query_args = array(
                'numberposts'   => $post_number,
                'category'      => $catID,
                'post_type'     => 'workgroup',
                'post_status'   => 'publish'
			);


            $initiatives = get_posts($query_args);

            
            $output = $this->view->render('modules/Initiatives/multiple', array(
                'initiatives' => $initiatives
            ));


            if($post_number == '1'):

                $output = $this->view->render('modules/Initiatives/single', array(
                    'initiatives' => $initiatives
                ));

            endif;
		

        }

		if($query_type === 'select'):

			$canGetPostID = url_to_postid($initiatives);

			$output = "Couldn't fetch ID";

			if($canGetPostID):
				$initiatives = get_post($canGetPostID);
				$output = $this->view->render('modules/Initiatives/single', array(
					'initiatives' => $initiatives
				));
			endif;

		endif;

		return $output;
		
	}

	public function workgroups(){

		$workgroups = [];

		$args = array(
			'post_type' 	=> 'workgroup',
			'post_status'	=> 'publish',
		);

		$wg = get_posts($args);

		foreach($wg as $g){

			$workgroups[$g->ID] = $g->post_title;

		}

		return $workgroups;


	}

}

new S3DM_Initiatives;


