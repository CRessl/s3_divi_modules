<?php

class S3DM_LinkListItem extends ET_Builder_Module {

	public $slug       = 's3dm_link_list_item';
	public $vb_support = 'on';
	private $view;

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => 's3-advertising',
		'author_uri' => 'https://s3-advertising.com',
	);

	public function init() {
		$this->name 			= esc_html__( 'Link List', 's3dm-s3-divi-modules' );
        $this->type             = 'child';
		$this->child_title_var  = 'title';
		$this->main_css_element = '%%order_class%%.s3dm_link_list_item';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => __('Settings', 's3dm-s3-divi-modules'),
					'position' => __('Position', 's3dm-s3-divi-modules'),
				),
			),
		);
	
	}

	public function __construct(){
        parent::__construct();
        $this->setView();
    }

    public function setView(){
        $this->view = Plates();
    }

	public function get_fields() {
		
		global $layout;

		$fields = array(
			'title'	=> array(
				'label'            => esc_html__( 'Item Title', 's3dm-s3-divi-modules' ),
				'type'             => 'text',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'main_content',
			),
			'is_category' => array(
				'label'           	=> esc_html__( 'Is category', 's3dm-s3-divi-modules' ),
				'type'             	=> 'yes_no_button',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'option_category' 	=> 'basic_option',
				'default_on_front'	=> 'off',
				'toggle_slug'     	=> 'main_content',
			),
			'init_scale' => array(
				'label' 		=> __('Size initial (Scaling)', 's3dm-s3-divi-modules'),
				'type' 			=> 'range',
				'toggle_slug'   => 'position',
				'allowed_units'    => array( ' ' ),
				'default'          => '1',
				'default_unit'     => ' ',
				'default_on_front' => '1',
				'range_settings'   => array(
					'min'  => '0',
					'max'  => '1',
					'step' => '0.1',
				),
			),
			'category_slug' => array(
				'label'           	=> esc_html__( 'Current Item category', 's3dm-s3-divi-modules' ),
				'type'             	=> 'select',
				'options'		   	=> $this->get_categories(),
				'option_category' 	=> 'basic_option',
				'toggle_slug'     	=> 'main_content',
				'description'      	=> esc_html__( '', 's3dm-s3-divi-modules' ),
				'show_if'			=> array(
					'is_category'	=> 'on'
				),
				'searchable'        => true,
				'computed_affects' => array(
					'__categoryClass',
				),
			),
			'link_category' => array(
				'label'           	=> esc_html__( 'Link to category', 's3dm-s3-divi-modules' ),
				'type'             	=> 'yes_no_button',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'option_category' 	=> 'basic_option',
				'default_on_front'	=> 'on',
				'toggle_slug'     	=> 'main_content',
				'description'      	=> esc_html__( '', 's3dm-s3-divi-modules' ),
				'show_if'			=> array(
					'is_category'	=> 'on'
				),
			),
			'connect_category' => array(
				'label'           	=> esc_html__( 'Connect to chosen category', 's3dm-s3-divi-modules' ),
				'type'             	=> 'select',
				'options'		   	=> $this->get_categories_classes(),
				'option_category' 	=> 'basic_option',
				'toggle_slug'     	=> 'main_content',
				'description'      	=> esc_html__( '', 's3dm-s3-divi-modules' ),
				'show_if'			=> array(
					'is_category'	=> 'on'
				),
				'searchable'        => true
			),
			'link'       => array(
				'label'           	=> esc_html__( 'Link URL', 'et_builder' ),
				'type'            	=> 'text',
				'option_category' 	=> 'basic_option',
				'description'     	=> esc_html__( 'Input the destination URL for your button.', 's3dm-s3-divi-modules' ),
				'toggle_slug'     	=> 'main_content',
				'dynamic_content' 	=> 'url',
				'show_if'      		=> array(
					'link_category'	=> 'off'
				),
			),
			'use_image' => array(
				'label'            => esc_html__( 'Use Image', 's3dm-s3-divi-modules' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'default_on_front' => 'on',
				'toggle_slug'      => 'main_content',
				'description'      => esc_html__( 'This setting will turn on and off the date section.', 's3dm-s3-divi-modules' ),
			),
			'src'                 => array(
				'label'              => et_builder_i18n( 'Image' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => et_builder_i18n( 'Upload an image' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'et_builder' ),
				'update_text'        => esc_attr__( 'Set As Image', 'et_builder' ),
				'hide_metadata'      => true,
				'show_if'			 => array(
					'use_image'	=> 'on',
				),
				'description'        => esc_html__( 'Upload your desired image, or type in the URL to the image you would like to display.', 'et_builder' ),
				'toggle_slug'        => 'main_content',
				'dynamic_content'    => 'image',
				'hover'              => 'tabs',
			),
			'position_left' => array(
				'label' => __('Position left', 's3dm-s3-divi-modules'),
				'type' => 'range',
				'toggle_slug'     => 'position'
			),
			'position_top' => array(
				'label' => __('Position top', 's3dm-s3-divi-modules'),
				'type' => 'range',
				'toggle_slug'     => 'position'
			),
			'__categoryClass'                 => array(
				'type'                => 'computed',
				'computed_callback'   => array( 'S3DM_LinkListItem', 'get_category_class' ),
				'computed_depends_on' => array(	
					'category',
				),
			),
			
		);

		return $fields;
	}

	static function get_category_class( $args = array(), $conditional_tags = array(), $current_page = array(), $is_ajax_request = false ) {

        $categoryObject = get_category($args['category']);        
        return $categoryObject->slug;

    }


	protected function _render_module_wrapper( $output = '', $render_slug = '' ) {
		return $output;
	}

	public function render( $attrs, $content = null, $render_slug ) {
		
		global $layout, $s3dm_link_list_item_number;

		$s3dm_link_list_item_number++;

		$link 				= $this->props['link'];
		$title 				= $this->props['title'];
		$src				= $this->props['src'];
		$position_left		= $this->props['position_left'];
		$position_top  		= $this->props['position_top'];
		$multi_view        	= et_pb_multi_view_options( $this );
		$is_cat 			= $this->props['is_category'];
		$category			= get_category_by_slug($this->props['category_slug']);

		if(is_object($category)){
			$category = $category->term_id;
		}else{
			$category = '';
		}

		$link_category		= $this->props['link_category'];
		
		$category_name 		= '';
		$cat_class 			= '';
		$category_link		= '';


		if($category && !empty($category)):
			$category_name 		= get_cat_name($category);
			$cat_class 			= get_category( $category )->slug;
			$category_link		= get_category_link($category);
		endif;

		$connectClass		= $this->props['connect_category'];

		$width 				= $this->props['width'];
		$height 			= $this->props['height'];
		
		$alt = s3dm_get_image_alt_text_from_url($src);
		$title_text = s3dm_get_image_title_from_url($src);

		$attributes = 'top='.$position_top.' left='.$position_left.' width='.$width.' height='.$height.'';

		$css = [
			'top' => $position_top,
			'left' => $position_left,
			'width'	=> $width,
			'height' => $height
		];
		

		$style = [];

		if($layout == 'list'):

			$classes = $this->slug.' '.$cat_class.' s3dm_link_list_item_'.$s3dm_link_list_item_number;
			$style['background'] = 'transparent';

		else:

			$classes = $this->slug.' s3dm_link_list_item_bubble '.$cat_class.' s3dm_link_list_item_'.$s3dm_link_list_item_number;

		endif;

		

		$style_string = $this->convertStyleArray($style);

		$use_image = $this->props['use_image'];

		$image_attrs = array(
			'src'    => '{{src}}',
			'alt'    => esc_attr( $alt ),
			'title'  => esc_attr( $title_text ),
			'height' => 'auto',
			'width'  => 'auto',
		);

		$image = $multi_view->render_element(
			array(
				'tag'      => 'img',
				'attrs'    => $image_attrs,
				'required' => 'src',
			)
		);

		$output = $this->view->render('modules/LinkList/partials/LinkList_Item', array(
			'classes' 				=> $classes,
			'image' 				=> $image,
			'title' 				=> $title,
			'link' 					=> $link,
			'use_image' 			=> $use_image,
			'is_cat' 				=> $is_cat,
			'link_category' 		=> $link_category,
			'category_name'			=> $category_name,
			'category_link'			=> $category_link,
			'attributes'			=> $attributes,
			'connect' 				=> $connectClass,
			'countClass'			=> 's3dm_link_list_item_'.$s3dm_link_list_item_number,
			'css'					=> $css
		));

		return $output;
	}


	public function convertStyleArray($array){

		$styles = array();

		foreach($array as $styleKey => $styleValue){

			$styles[] = $styleKey.':'.$styleValue;

		}

		return implode ( '; ' , $styles );


	}

	public function get_categories(){
		$categories = array();
		$args = array(
			'hide_empty'      => false,
		);
		$wp_cat = get_categories($args);

		foreach($wp_cat as $cat){

			$categories[$cat->slug] = $cat->name;

		}

		return $categories;
	}

	public function get_categories_classes(){

		$categories = array();
		$args = array(
			'hide_empty'      => false,
		);
		$wp_cat = get_categories($args);

		foreach($wp_cat as $cat){

			$categories[$cat->slug] = $cat->name;

		}

		return $categories;

	}

}

new S3DM_LinkListItem;
