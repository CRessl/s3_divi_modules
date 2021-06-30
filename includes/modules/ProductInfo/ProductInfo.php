<?php

class S3DM_ProductInfo extends ET_Builder_Module_Type_PostBased{

    public $slug       = 's3dm_product_info';
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
		$this->name = esc_html__( 'Product Info', 's3dm-s3-divi-modules' );

        $this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => __('Settings', 's3dm-s3-divi-modules'),
                    'order_options' => __('Order Button Options', 's3dm-s3-divi-modules'),
				),
			),
		);
	}

    public function get_fields(){

        return array(
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
				'toggle_slug'      => 'main_content',
				'description'      => esc_html__( 'This setting will turn on and off the featured image in the slider.', 's3dm-s3-divi-modules' ),
				'mobile_options'   => true,
			),
            'subtitle_size'              => array(
				'label'            => esc_html__( 'Subtitle size', 's3dm-s3-divi-modules' ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'options'          => array(
					'ehi-h1'  => et_builder_i18n( 'H1' ),
					'ehi-h2' => et_builder_i18n( 'H2' ),
					'ehi-h3'  => et_builder_i18n( 'H3' ),
					'ehi-h4' => et_builder_i18n( 'H4' ),
				),
				'default_on_front' => 'ehi-h2',
				'toggle_slug'      => 'main_content',
				'description'      => esc_html__( 'This setting will turn on and off the featured image in the slider.', 's3dm-s3-divi-modules' ),
				'mobile_options'   => true,
			),
            'show_price'                     => array(
				'label'            => esc_html__( 'Show price', 'et_builder' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'off' => et_builder_i18n( 'No' ),
					'on'  => et_builder_i18n( 'Yes' ),
				),
				'description'      => esc_html__( 'Here you can define whether to show "read more" link after the excerpts or not.', 's3dm-s3-divi-modules' ),
				'default_on_front' => 'on',
                'toggle_slug'      => 'main_content',
			),
            'show_order_button'                     => array(
				'label'            => esc_html__( 'Show "To order" Button', 'et_builder' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'off' => et_builder_i18n( 'No' ),
					'on'  => et_builder_i18n( 'Yes' ),
				),
                'toggle_slug'      => 'order_options',
				'affects'	=> array(
					'button_text',
				),
				'description'      => esc_html__( 'Here you can define whether to show "read more" link after the excerpts or not.', 's3dm-s3-divi-modules' ),
				'default_on_front' => 'on',
			),
            'button_text'  => array(
				'label'            => esc_html__( 'Button Text', 's3dm-s3-divi-modules' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose how much posts you would like to display per page.', 's3dm-s3-divi-modules' ),
                'show_if'          => array(
                    'show_order_button' => 'on'
                ),
                'toggle_slug'      => 'order_options',  
			),
            'button_link'  => array(
				'label'            => esc_html__( 'Button Link', 's3dm-s3-divi-modules' ),
				'type'             => 'text',
                'dynamic_content'  => 'url',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose how much posts you would like to display per page.', 's3dm-s3-divi-modules' ),
                'show_if'          => array(
                    'show_order_button' => 'on'
                ),
                'toggle_slug'      => 'order_options',  
			),
        );

    }

    public function render($attrs, $content = null, $render_slug){

        $button_text = $this->props['button_text'];
        $title_size = $this->props['title_size'];
        $button_link = $this->props['button_link'];
        $subtitle_size = $this->props['subtitle_size'];

        $post_type = $postType = get_post_type();
        $settings = array(

            'show_order_button' => $this->props['show_order_button'],
            'show_price'        => $this->props['show_price'],
            'link'              => $button_link,
            'button_text'       => $button_text,
            'title_size'        => $title_size,
            'subtitle_size'     => $subtitle_size,

        );

        if($post_type == 'ehi_product'){

            $product_id = get_the_ID();

            $title = get_the_title($product_id);
            $packshot = wp_get_attachment_image(get_field('ehi_product_image', $product_id), 'full', false);
            $price = get_field('ehi_product_price', $product_id);
            $member_price = get_field('ehi_product_member_price', $product_id);
            $product_type = get_field('ehi_product_type', $product_id);
            $format = get_field('ehi_product_format', $product_id);
            $isbn = get_field('ehi_product_isbn', $product_id);
            $articlenumber = get_field('ehi_product_articlenumber', $product_id);
            $max_pages = get_field('ehi_product_max_pages', $product_id);
            $authors_objects = get_field('ehi_product_authors', $product_id);

            $authors = [];

            foreach($authors_objects as $author){

                $authors[] = $author->name;

            }

            $authors = implode(', ', $authors);


            $publish_year = get_field('ehi_product_publish_year', $product_id);
            $subtitle = get_field('ehi_product_subtitle', $product_id);

            $product = array(
                'title' => $title,
                'subtitle' => $subtitle,
                'packshot' => $packshot,
                'price' => $price,
                'member_price' => $member_price,
                'product_type'  => $product_type,
                'format' => $format,
                'isbn' => $isbn,
                'articlenumber' => $articlenumber,
                'max_pages' => $max_pages,
                'authors' => $authors,
                'publish_year' => $publish_year,
            );
            
    
            $productInfo = $this->view->render('modules/ProductInfo/item', array(
                'settings'      => $settings,
                'button_text'   => $button_text,
                'post_type'     => $post_type,
                'product'       => $product
            ));
    
            $output = sprintf(
                '<div class="%2$s">
                    %1$s
                </div>
                ',
                $productInfo,
                $this->module_classname( $render_slug )
            );
        
            return $output;
        }

        return 'Post is no product';

        


    }


}

new S3DM_ProductInfo;