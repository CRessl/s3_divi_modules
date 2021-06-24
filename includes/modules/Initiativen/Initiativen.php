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
		$this->name = esc_html__( 'Initiatives', 's3dm-s3-divi-modules' );
	}

	public function get_fields() {
		return array(
            'query_type' => array(
				'label'            => esc_html__( 'Post Count', 's3dm-s3-divi-modules' ),
				'type'             => 'select',
                'options'          => array(
                    'category'     => esc_html__('Category', 's3dm-s3-divi-modules'),
                    'select'       => esc_html__('Single select', 's3dm-s3-divi-modules'),   
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
				'label'            => esc_html__( 'Post Count', 's3dm-s3-divi-modules' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose how much posts you would like to display per page.', 's3dm-s3-divi-modules' ),
				'computed_affects' => array(
					'__initiativeData',
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
			'columns'  => array(
				'label'            => esc_html__( 'Columns', 's3dm-s3-divi-modules' ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'options'		   => array(
					'2'			   => 'Zwei Spalten',
					'3'			   => 'Drei Spalten',
					'4'			   => 'Vier Spalten'
				),
				'description'      => esc_html__( 'Choose how much posts you would like to display per page.', 's3dm-s3-divi-modules' ),
                'show_if'          => array(
                    'query_type'   => 'category'
				),
				'default_on_front'          => 3,
			),
            'initiatives' => array(
				'label'            => esc_html__( 'Initiative', 's3dm-s3-divi-modules' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose a initiative', 's3dm-s3-divi-modules' ),
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
		$title_size = $this->props['title_size'];

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
				'columns' => $columns,
				'title_size' => $title_size
            ));


            if($post_number == '1'):

                $output = $this->view->render('modules/Initiativen/single', array(
                    'initiatives' => $initiatives,
					'title_size' => $title_size
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


