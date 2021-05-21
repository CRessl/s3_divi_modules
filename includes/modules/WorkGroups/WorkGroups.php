<?php

class S3DM_WorkGroups extends ET_Builder_Module_Type_PostBased {

	public $slug       = 's3dm_work_groups';
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
		$this->name = esc_html__( 'Work Groups', 's3dm-s3-divi-modules' );
	}

	public function get_fields() {
		return array(
            'query_type' => array(
				'label'            => esc_html__( 'Query type', 'et_builder' ),
				'type'             => 'select',
                'options'          => array(
                    'category'     => esc_html__('Category', 'et_builder'),
                    'select'       => esc_html__('Single select', 'et_builder'),   
				),
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose which selection you would prefer (Category = current Category | Single select = Select one Workgrioup', 'et_builder' ),
				'default_on_front' => 'select',
				'computed_affects' => array(
					'__workgroupData',
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
					'__workgroupData',
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
					'__workgroupData',
				),
                'show_if'          => array(
                    'query_type'   => 'category'
				),
				'default_on_front'          => 3,
			),
            'workgroup' => array(
				'label'            => esc_html__( 'Work group', 'et_builder' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose how much posts you would like to display per page.', 'et_builder' ),
				'computed_affects' => array(
					'__workgroupData',
				),
				'dynamic_content' => 'url',
                'show_if'          => array(
                    'query_type'   => 'select'
                ),
			),
            '__workgroupData'                 => array(
				'type'                => 'computed',
				'computed_callback'   => array( 'S3DM_WorkGroups', 'get_workgroups' ),
				'computed_depends_on' => array(
					'query_type',
					'posts_number',
					'include_categories',
                    'workgroup'
				),
			),
		);
	}
    static function get_workgroups( $args = array(), $conditional_tags = array(), $current_page = array(), $is_ajax_request = true ) {
		
		
		$workgroupsData = [];

		$query_args = array(
			'numberposts'   => $args['posts_number'],
			'category'      => $args['include_categories'],
			'post_type'     => 'workgroup',
			'post_status'   => 'publish'
		);

		$workgroups = get_posts($query_args);

		//if query type != single_select then check which type of category is included

		if($args['query_type'] === 'category'):

			//if category is current category then check the queried object and get posts then
			if($args['include_categories'] === 'current'){
			
				$workgroups = 'No archive page found found';
				$current_category = get_queried_object();

				//if category object is found, then get all the posts from posts number
				if($current_category):
				
					$catID = $current_category->term_id;
					
					$query_args = array(
						'numberposts'   => $post_number,
						'category'      => $catID,
						'post_type'     => 'workgroup',
						'post_status'   => 'publish'
					);
	
					$workgroups = get_posts($query_args);
				endif;
	
			}else{
				
				$query_args = array(
					'numberposts'   => $post_number,
					'category'      => $args['include_categories'],
					'post_type'     => 'workgroup',
					'post_status'   => 'publish'
				);
	
				$workgroups = get_posts($query_args);
	
			}

		endif;


		if($args['query_type'] === 'select'):

			$workgroupID = getIdFromDynamicLinkfield($args['workgroup']);
			$workgroups = get_post($workgroupID);
			$contact = get_field('ehi_workgroups_contact'. $workgroupID);
			$manager = get_field('ehi_workgroups_manager'. $workgroupID);

			$workgroupsData = [
				'title' => esc_html($workgroups->post_title),
				'content' => esc_html($workgroups->post_content),
				'contact' => $contact,
				'manager' => $manager
			];



		endif;
		


		


		return $workgroupsData;


    }

	public function render( $attrs, $content = null, $render_slug ) {		

        $query_type = $this->props['query_type'];
        $post_number = $this->props['posts_number'];
        $workgroup = $this->props['workgroup'];
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


            $workgroups = get_posts($query_args);

            
            $output = $this->view->render('modules/WorkGroups/multiple', array(
                'workgroups' => $workgroups
            ));


            if($post_number == '1'):

                $output = $this->view->render('modules/WorkGroups/single', array(
                    'workgroups' => $workgroups
                ));

            endif;
		

        }

		if($query_type === 'select'):

			$canGetPostID = url_to_postid($workgroup);

			$output = "Couldn't fetch ID";

			if($canGetPostID):
				$workgroups = get_post($canGetPostID);
				$output = $this->view->render('modules/WorkGroups/single', array(
					'workgroups' => $workgroups
				));
			endif;

		endif;

		return $output;
		
	}

}

new S3DM_WorkGroups;


