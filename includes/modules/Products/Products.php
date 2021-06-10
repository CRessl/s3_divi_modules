<?php

class S3DM_Products extends ET_Builder_Module_Type_PostBased {

	public $slug       = 's3dm_products';
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
		$this->name = esc_html__( 'Products', 's3dm-s3-divi-modules' );
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
					'__productsData',
				),
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose which selection you would prefer (Category = current Category | Single select = Select one Workgroup', 's3dm-s3-divi-modules' ),
				'default_on_front' => 'select',
			),
            'include_categories' => array(
				'label'            => esc_html__( 'Included Categories', 's3dm-s3-divi-modules' ),
				'type'             => 'categories',
				'option_category'  => 'basic_option',
				'description'      => esc_html__( 'Choose which categories you would like to include in the slider.', 's3dm-s3-divi-modules' ),
				'toggle_slug'      => 'main_content',
				'computed_affects' => array(
					'__productsData',
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
					'__productsData',
				),
                'show_if'          => array(
                    'query_type'   => 'category'
				),
				'default_on_front'          => 3,
			),
			'columns'  => array(
				'label'            => esc_html__( 'Spalten', 's3dm-s3-divi-modules' ),
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
            'linktext'  => array(
				'label'            => esc_html__( 'Linktext', 's3dm-s3-divi-modules' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose how much posts you would like to display per page.', 's3dm-s3-divi-modules' ),
			),
            'product' => array(
				'label'            => esc_html__( 'Product', 's3dm-s3-divi-modules' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Wähle eine Initiative aus', 's3dm-s3-divi-modules' ),
				'computed_affects' => array(
					'__productsData',
				),
				'dynamic_content' => 'url',
                'show_if'          => array(
                    'query_type'   => 'select'
                ),
			),
            '__productsData'                 => array(
				'type'                => 'computed',
				'computed_callback'   => array( 'S3DM_Products', '__get_products' ),
				'computed_depends_on' => array(
					'posts_number',
                    'initiatives',
					'query_type',
                    'include_categories'
				),
			),
		);
	}
    static function __get_products( $args = array(), $conditional_tags = array(), $current_page = array(), $is_ajax_request = true ) {

		
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
        $product = $this->props['product'];
        $categories = $this->props['include_categories'];
		$columns = $this->props['columns'];
        $linktext = $this->props['linktext'];

        if($query_type === 'category'){

            $query_args = array( 
                'numberposts'   => $post_number,
                'category'      => $categories,
                'post_type'     => 'ehi_product',
                'post_status'   => 'publish'
			);


            $products = get_posts($query_args);
            
            $output = $this->view->render('modules/Products/multiple', array(
                'products' => $products,
				'columns' => $columns,
                'linktext' => $linktext,
            ));


            if($post_number == '1'):

                $output = $this->view->render('modules/Products/single', array(
                    'products' => $products,
                    'linktext' => $linktext,
                ));

            endif;
		

        }

		if($query_type === 'select'):

			$canGetPostID = url_to_postid($initiatives);

			$output = "Couldn't fetch ID";

			if($canGetPostID):
				$product = get_post($canGetPostID);
				$output = $this->view->render('modules/Products/single', array(
					'product' => $product,
                    'linktext' => $linktext,
				));
			endif;

		endif;

		return $output;
		
	}

}

new S3DM_Products;


