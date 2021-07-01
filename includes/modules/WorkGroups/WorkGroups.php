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
				'label'            => esc_html__( 'Query type', 's3dm-s3-divi-modules' ),
				'type'             => 'select',
                'options'          => array(
                    'category'     => esc_html__('Category', 's3dm-s3-divi-modules'),
                    'select'       => esc_html__('Single select', 's3dm-s3-divi-modules'),   
				),
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose which selection you would prefer (Category = current Category | Single select = Select one Workgrioup', 's3dm-s3-divi-modules' ),
				'default_on_front' => 'select',
				'computed_affects' => array(
					'__workgroupData',
				),
			),
            'include_categories' => array(
				'label'            => esc_html__( 'Included Categories', 's3dm-s3-divi-modules' ),
				'type'             => 'categories',
				'option_category'  => 'basic_option',
				'description'      => esc_html__( 'Choose which categories you would like to include in the slider.', 's3dm-s3-divi-modules' ),
				'toggle_slug'      => 'main_content',
				'computed_affects' => array(
					'__workgroupData',
				),
                'show_if'           => array(
                    'query_type' => 'category',
                ),
			),
            'posts_number'  => array(
				'label'            => esc_html__( 'Post Count', 's3dm-s3-divi-modules' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose how much posts you would like to display per page.', 's3dm-s3-divi-modules' ),
				'computed_affects' => array(
					'__workgroupData',
				),
                'show_if'          => array(
                    'query_type'   => 'category'
				),
				'default_on_front'          => 3,
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
            'workgroup' => array(
				'label'            => esc_html__( 'Work group', 's3dm-s3-divi-modules' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose how much posts you would like to display per page.', 's3dm-s3-divi-modules' ),
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
		
		$query_type = $args['query_type'];
        $post_number = $args['posts_number'];
        $workgroup = $args['workgroup'];
        $categories = $args['include_categories'];
		

		$workgroupsData = [];

		if($query_type === 'category'){

            $query_args = array(
                'numberposts'   => $post_number,
                'category'      => $categories,
                'post_type'     => 'workgroup',
                'post_status'   => 'publish'
			);

			$workgroups = get_posts($query_args);

			foreach($workgroups as $workgroup){

				$workgroup_id = $workgroup->ID;
				$leitende = get_field('ehi_workgroups_contact', $workgroup_id);
				$vorsitzende = get_field('ehi_workgroups_manager', $workgroup_id);

				$leiterData = [];
				$vorsitzData = [];

				if($leitende){

					foreach($leitende as $leiter){

						$leiterID = $leiter->ID;

						$leiterData[] = array(
							'firstname' => trim(get_field('ehi_team_vorname', $leiterID)),
							'lastname' 	=> trim(get_field('ehi_team_nachname', $leiterID)),
							'phone' => trim(get_field('ehi_team_telefon', $leiterID)),
							'email'	=> trim(get_field('ehi_team_email', $leiterID))
						);	

					}


				}

				if($vorsitzende){

					foreach($vorsitzende as $vorsitz){

						$vorsitzID = $vorsitz->ID;
						
						$company = trim(get_field('ehi_team_unternehmen', $vorsitzID));

						if($company){
							$companyValue = ' , '.$company;
						}else{
							$companyValue = '';
						}

						$vorsitzData[] = array(
							'firstname' => trim(get_field('ehi_team_vorname', $vorsitzID)),
							'lastname' 	=> trim(get_field('ehi_team_nachname', $vorsitzID)),
							'company' 	=> $companyValue
						);


					}

				}



				$workgroupsData[] = array(
					'title' => esc_html($workgroup->post_title),
					'content' => esc_html($workgroup->post_content),
					'leiter' => $leiterData,
					'vorsitz' => $vorsitzData
				);





			}


		}else{

			$workgroupID = getIdFromDynamicLinkfield($args['workgroup']);
			$workgroup = get_post($workgroupID);

			$leitende = get_field('ehi_workgroups_contact', $workgroupID);
			$vorsitzende = get_field('ehi_workgroups_manager', $workgroupID);

			$leiterData = [];
			$vorsitzData = [];

			if($leitende){

				foreach($leitende as $leiter){

					$leiterID = $leiter->ID;

					$leiterData[] = array(
						'firstname' => trim(get_field('ehi_team_vorname', $leiterID)),
						'lastname' 	=> trim(get_field('ehi_team_nachname', $leiterID)),
						'phone' => trim(get_field('ehi_team_telefon', $leiterID)),
						'email'	=> trim(get_field('ehi_team_email', $leiterID))
					);


				}


			}

			if($vorsitzende){

				foreach($vorsitzende as $vorsitz){

					$vorsitzID = $vorsitz->ID;

					$company = trim(get_field('ehi_team_unternehmen', $vorsitzID));

					if($company){
						$companyValue = ' , '.$company;
					}else{
						$companyValue = '';
					}


					$vorsitzData[] = array(
						'firstname' => trim(get_field('ehi_team_vorname', $vorsitzID)),
						'lastname' 	=> trim(get_field('ehi_team_nachname', $vorsitzID)),
						'company' 	=> $companyValue
					);


				}

			}



			$workgroupsData[] = array(
				'title' => esc_html($workgroup->post_title),
				'content' => esc_html($workgroup->post_content),
				'leiter' => $leiterData,
				'vorsitz' => $vorsitzData
			);


		}



		return $workgroupsData;
		

    }

	public function render( $attrs, $content = null, $render_slug ) {		

        $query_type = $this->props['query_type'];
        $post_number = $this->props['posts_number'];
        $workgroup = $this->props['workgroup'];
        $categories = $this->props['include_categories'];
		$title_size = $this->props['title_size'];


		$slider_defaults = array(
			'type' => 'fade',
			'rewind' => true,
			'speed' =>	600,
			'autoHeight' => true,
			'perPage'	=> 1,
			'gap'	=> 0,
			'padding'	=> 0,
			'arrows'	=> true,
			'autoplay'	=> false,
			'drag' => true,
		);

		$slide_options = json_encode($slider_defaults, JSON_HEX_QUOT);

		if($query_type === 'category'){

            $query_args = array(
                'numberposts'   => $post_number,
                'category'      => $categories,
                'post_type'     => 'workgroup',
                'post_status'   => 'publish'
			);


            $workgroups = get_posts($query_args);
            
            $output = $this->view->render('modules/WorkGroups/multiple', array(
                'workgroups' => $workgroups,
				'title_size' => $title_size,
				'slide_options' => $slide_options
            ));


            if($post_number == '1'):

                $output = $this->view->render('modules/WorkGroups/single', array(
                    'workgroups' => $workgroups,
					'title_size' => $title_size,
                ));

            endif;
		

        }

		if($query_type === 'select'):

			$canGetPostID = url_to_postid($workgroup);

			$output = "Couldn't fetch ID";

			if($canGetPostID):
				$workgroups = get_post($canGetPostID);
				$output = $this->view->render('modules/WorkGroups/single', array(
					'workgroups' 	=> $workgroups,
					'title_size' 	=> $title_size,
					
				));
			endif;

		endif;

		return $output;
		
	}

}

new S3DM_WorkGroups;


