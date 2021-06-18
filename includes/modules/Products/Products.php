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
				'toggle_slug'      => 'main_content',
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
				'default_on_front' => 3,
				'toggle_slug'      => 'main_content',
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
				'default_on_front' => 3,
				'toggle_slug'      => 'main_content',
			),
            'linktext'  => array(
				'label'            => esc_html__( 'Linktext', 's3dm-s3-divi-modules' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose how much posts you would like to display per page.', 's3dm-s3-divi-modules' ),
				'toggle_slug'      => 'main_content',
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
				'toggle_slug'      => 'main_content',
			),
			'show_image' => array(
				'label'            => esc_html__( 'Show Product Image', 's3dm-s3-divi-modules' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'affects' => array(
					'show_bubble'
				),
                'toggle_slug'      => 'elements',
				'default_on_front' => 'off',
				'description'      => esc_html__( 'This setting will turn on and off the featured image in the slider.', 's3dm-s3-divi-modules' ),
			),
			'show_bubble' => array(
				'label'            => esc_html__( 'Show price bubble', 's3dm-s3-divi-modules' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'show_if' => array(
					'show_image'	=> 'on',
				),
                'toggle_slug'      => 'elements',
				'default_on_front' => 'off',
				'description'      => esc_html__( 'This setting will turn on and off the featured image in the slider.', 's3dm-s3-divi-modules' ),
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
			),
			'show_link' => array(
				'label'            => esc_html__( 'Show Link', 's3dm-s3-divi-modules' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'default_on_front' => 'on',
				'toggle_slug'      => 'elements',
				'description'      => esc_html__( 'This setting will display the link of the post', 's3dm-s3-divi-modules' ),
			),
			'show_price' => array(
				'label'            => esc_html__( 'Show price', 's3dm-s3-divi-modules' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'default_on_front' => 'on',
				'toggle_slug'      => 'elements',
				'description'      => esc_html__( 'This setting will display the price of the post', 's3dm-s3-divi-modules' ),
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
					'show_page_format',
                ),
				'default_on_front' => 'on',
				'toggle_slug'      => 'elements',
				'description'      => esc_html__( 'This setting will turn on and off the meta section.', 's3dm-s3-divi-modules' ),
			),
			'show_page_format' => array(
				'label'            => esc_html__( 'Show max pages and format', 's3dm-s3-divi-modules' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'show_if'	=> array(
					'show_meta' => 'on'
				),
				'default_on_front' => 'off',
				'toggle_slug'      => 'elements',
				'description'      => esc_html__( 'This setting will display the max pages and format of the post', 's3dm-s3-divi-modules' ),
			),
            'show_date' => array(
				'label'            => esc_html__( 'Show Date', 's3dm-s3-divi-modules' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'default_on_front' => 'off',
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
                    '__productsData'
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
				'default_on_front' => 'off',
				'toggle_slug'      => 'elements',
				'description'      => esc_html__( 'This setting will turn on and off the tag section.', 's3dm-s3-divi-modules' ),
                'show_if'          => array(
                    'show_meta' => 'on'
                ),
			),
            '__productsData' => array(
				'type'                => 'computed',
				'computed_callback'   => array( 'S3DM_Products', '__get_products' ),
				'computed_depends_on' => array(
					'posts_number',
                    'product',
					'query_type',
                    'include_categories',
					'date_format'
				),
			),
		);
	}
    static function __get_products( $args = array(), $conditional_tags = array(), $current_page = array(), $is_ajax_request = true ) {

		$defaults = array(
			'posts_number' 			=> '',
			'product'				=> '',
			'query_type' 			=> '',
			'include_categories'    => '',
			'date_format' 			=> '',
		);

		$args = wp_parse_args( $args, $defaults);

		$date_format = $args['date_format'];

		$queryArgs = array(

			'category' 	=> $args['include_categories'],
			'post_type'		=> 'ehi_product',
			'numberposts'	=> $args['posts_number'],
			'post_status'	=> 'publish'

		);

		if(!$args['include_categories']){
			unset($queryArgs['category']);
		}

		if($args['query_type'] === 'category'){

			$products = get_posts($queryArgs);

			foreach($products as $product){

				$productID = $product->ID;

				$title = get_the_title($productID);
				$subtitle = get_field('ehi_product_subtitle', $productID);
				$permalink = get_the_permalink($productID);
				$tags = get_the_tags($productID);
				$date = get_the_date($date_format, $productID);

				$packshot = wp_get_attachment_image_url(get_field('ehi_product_image', $productID), 'full', false);
				$price = get_field('ehi_product_price', $productID);
				$member_price = get_field('ehi_product_member_price', $productID);
				$excerpt = strip_tags(apply_filters('the_excerpt', get_post_field('post_excerpt', $product)));
				$max_pages = get_field('ehi_product_max_pages', $productID);
				$format = get_field('ehi_product_format', $productID);


				$productData[] = array(
					
					'packshot' 		=> $packshot,
					'date'			=> $date,
					'title' 		=> $title,
					'subtitle' 		=> $subtitle,
					'tags' 			=> $tags,
					'format'		=> $format,
					'max_pages'		=> $max_pages,
					'excerpt'		=> $excerpt,
					'price'			=> $price,
					'member_price'	=> $member_price,
					'permalink' 	=> $permalink,

				);

			}

		}

		if($args['query_type'] === 'select'){

			$productID = getIdFromDynamicLinkfield($args['product']);
			$product = get_post($productID);

			$title = get_the_title($productID);
			$subtitle = get_field('ehi_product_subtitle', $productID);
			$permalink = get_the_permalink($productID);
			$tags = get_the_tags($productID);
			$date = get_the_date($date_format, $productID);

			$packshot = wp_get_attachment_image_url(get_field('ehi_product_image', $productID), 'full', false);
			$price = get_field('ehi_product_price', $productID);
			$member_price = get_field('ehi_product_member_price', $productID);
			$excerpt = strip_tags(apply_filters('the_excerpt', get_post_field('post_excerpt', $product)));

			if(!$excerpt){
				$truncate = truncate_post( 270, false, $product, true );
				$excerpt = $truncate;
			}

			$max_pages = get_field('ehi_product_max_pages', $productID);
			$format = get_field('ehi_product_format', $productID);

			$productData[0] = array(
					
				'packshot' 		=> $packshot,
				'date'			=> $date,
				'title' 		=> $title,
				'subtitle' 		=> $subtitle,
				'tags' 			=> $tags,
				'format'		=> $format,
				'max_pages'		=> $max_pages,
				'excerpt'		=> $excerpt,
				'price'			=> $price,
				'member_price'	=> $member_price,
				'permalink' 	=> $permalink,

			); 



		}


		
		
		return $productData;
		
    }

	public function render( $attrs, $content = null, $render_slug ) {		

		$query_type					= $this->props['query_type'];
		$include_categories 		= $this->props['include_categories'];
		$posts_number 				= $this->props['posts_number'];
		$columns					= $this->props['columns'];
		$date_format				= $this->props['date_format'];

		//settings for all elements
		$linktext 					= $this->props['linktext'];
		$show_meta 					= $this->props['show_meta'];
		$show_image 				= $this->props['show_image'];
		$show_bubble				= $this->props['show_bubble'];
		$show_date 					= $this->props['show_date'];
		$show_tags 					= $this->props['show_tags'];
		$show_excerpt				= $this->props['show_excerpt'];
		$show_price					= $this->props['show_price'];
		$show_link					= $this->props['show_link'];
		$show_page_format			= $this->props['show_page_format'];


		$settings = array(

			'linktext' 			=> $linktext,
			'show_meta' 		=> $show_meta,
			'show_date' 		=> $show_date,
			'show_image' 		=> $show_image,
			'show_tags' 		=> $show_tags,
			'show_excerpt' 		=> $show_excerpt,
			'show_price'		=> $show_price,
			'show_bubble'		=> $show_bubble,
			'show_link'			=> $show_link,
			'show_page_format'	=> $show_page_format,


		);


		if($query_type === 'category'){

			$output = '<div class="uk-child-width-1-1 uk-child-width-1-'.$columns.'" uk-grid>';


			$queryArgs = array(
				'post_type' 	=> 'ehi_product',
				'numberposts' 	=> $posts_number,
				'post_status' 	=> 'publish',
				'category' 		=> $include_categories
			);

			$products = get_posts($queryArgs);

			foreach($products as $product){

				$productData = array();
				$productID = $product->ID;

				$title = get_the_title($productID);
				$subtitle = get_field('ehi_product_subtitle', $productID);
				$permalink = get_the_permalink($productID);
				$tags = get_the_tags($productID);
				$date = get_the_date($date_format, $productID);
				
				//gets image html from image field
				$packshot = wp_get_attachment_image(get_field('ehi_product_image', $productID), 'full', false, array('class' => 's3dm_post_list_product_image'));
				$price = get_field('ehi_product_price', $productID);
				$member_price = get_field('ehi_product_member_price', $productID);
				$excerpt = strip_tags(apply_filters('the_excerpt', get_post_field('post_excerpt', $product)));

				if(!$excerpt){
					$truncate = truncate_post( 270, false, $product, true );
					$excerpt = $truncate;
				}



				$max_pages = get_field('ehi_product_max_pages', $productID);
				$format = get_field('ehi_product_format', $productID);

				$templateData = array(
					
					'packshot' 		=> $packshot,
					'date'			=> $date,
					'title' 		=> $title,
					'subtitle' 		=> $subtitle,
					'tags' 			=> $tags,
					'format'		=> $format,
					'max_pages'		=> $max_pages,
					'excerpt'		=> $excerpt,
					'price'			=> $price,
					'member_price'	=> $member_price,
					'permalink' 	=> $permalink,
					'settings'		=> $settings,

				);

				$output .= $this->view->render('modules/Products/multiple', $templateData); 


			}

			$output .= '</div>';

		}

		if($query_type === 'select'){

			$product = get_post(url_to_post_id($this->props['product']));

		}

		return $output;
		
	}

}

new S3DM_Products;


