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
				'computed_affects' => array(
					'__initiativeData',
				),
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose which selection you would prefer (Category = current Category | Single select = Select one Workgrioup', 'et_builder' ),
				'default_on_front' => 'select',
			),
            'include_categories' => array(
				'label'            => esc_html__( 'Included Categories', 's3dm-s3-divi-modules' ),
				'type'             => 'categories',
				'option_category'  => 'basic_option',
				'description'      => esc_html__( 'Choose which categories you would like to include in the slider.', 's3dm-s3-divi-modules' ),
				'toggle_slug'      => 'main_content',
				'computed_affects' => array(
					'__initiativeData',
				),
                'show_if'           => array(
                    'query_type' => 'category',
                ),
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
			'columns'  => array(
				'label'            => esc_html__( 'Spalten', 'et_builder' ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'options'		   => array(
					'2'			   => 'Zwei Spalten',
					'3'			   => 'Drei Spalten',
					'4'			   => 'Vier Spalten'
				),
				'description'      => esc_html__( 'Choose how much posts you would like to display per page.', 'et_builder' ),
                'show_if'          => array(
                    'query_type'   => 'category'
				),
				'default_on_front'          => 3,
			),
            'initiatives' => array(
				'label'            => esc_html__( 'Initiative', 'et_builder' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Wähle eine Initiative aus', 'et_builder' ),
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
                    'initiatives',
					'query_type',
                    'include_categories'
				),
			),
		);
	}
    static function get_initiatives( $args = array(), $conditional_tags = array(), $current_page = array(), $is_ajax_request = true ) {

		
		$query_type = $args['query_type'];
			
		$initiativesData = [];


		if($query_type === 'select'){

			$initiativesID = getIdFromDynamicLinkfield($args['initiatives']);
			$initiatives = get_post($initiativesID);

			$initiativesData = array(
				'title' 	=> esc_html($initiatives->post_title),
				'image' 	=> get_the_post_thumbnail_url($initiatives->ID, 'medium_large'),
				'content' 	=> esc_html($initiatives->post_content)
			);

			


		}else{

			
			$query_args = array(
				'numberposts'   => $args['posts_number'],
				'category'      => $args['include_categories'],
				'post_type'		=> 'initiatives',
				'post_status'   => 'publish'
			);

			$initiatives = get_posts($query_args);


			foreach($initiatives as $initiative){

				$initiativesData[] = array(
					'title' => esc_html($initiative->post_title),
					'image' => get_the_post_thumbnail_url($initiative->ID, 'medium_large')
				);


			}
			
			

		}

		
		return $initiativesData;
		
    }

	public function render( $attrs, $content = null, $render_slug ) {		

        $query_type = $this->props['query_type'];
        $post_number = $this->props['posts_number'];
        $initiatives = $this->props['initiatives'];
        $categories = $this->props['include_categories'];
		$columns = $this->props['columns'];

        if($query_type === 'category'){

            $query_args = array( 
                'numberposts'   => $post_number,
                'category'      => $categories,
                'post_type'     => 'initiatives',
                'post_status'   => 'publish'
			);


            $initiatives = get_posts($query_args);
            
            $output = $this->view->render('modules/Initiativen/multiple', array(
                'initiatives' => $initiatives,
				'columns' => $columns
            ));


            if($post_number == '1'):

                $output = $this->view->render('modules/Initiativen/single', array(
                    'initiatives' => $initiatives
                ));

            endif;
		

        }

		if($query_type === 'select'):

			$canGetPostID = url_to_postid($initiatives);

			$output = "Couldn't fetch ID";

			if($canGetPostID):
				$initiatives = get_post($canGetPostID);
				$output = $this->view->render('modules/Initiativen/single', array(
					'initiatives' => $initiatives
				));
			endif;

		endif;

		return $output;
		
	}

}

new S3DM_Initiatives;


