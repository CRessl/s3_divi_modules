<?php
/**
 * 
 * Add custom links as list, grid or bubble option
 * each link item can be positioned manually if bubble layout is selected
 * 
 * 
*/


class S3DM_ClusterItem extends ET_Builder_Module {

	public $slug       = 's3dm_cluster_item';
	public $vb_support = 'on';
	private $view;

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => 's3-advertising',
		'author_uri' => 'https://s3-advertising.com',
	);

	public function init() {
		$this->name = esc_html__( 'Cluster', 's3dm-s3-divi-modules' );
        $this->type             = 'child';
		$this->child_title_var  = 'title';
        
        $this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => __('Settings', 's3dm-s3-divi-modules'),
                    'connections' => __('Connections', 's3dm-s3-divi-modules'),
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

        $fields = array(
            'title'	=> array(
				'label'            => esc_html__( 'Item Title', 's3dm-s3-divi-modules' ),
				'type'             => 'text',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'main_content',
			),
            'icon'                 => array(
				'label'              => et_builder_i18n( 'Image' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => et_builder_i18n( 'Upload an image' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'et_builder' ),
				'update_text'        => esc_attr__( 'Set As Image', 'et_builder' ),
				'hide_metadata'      => true,
				'description'        => esc_html__( 'Upload your desired image, or type in the URL to the image you would like to display.', 's3dm-s3-divi-modules' ),
				'toggle_slug'        => 'main_content',
				'dynamic_content'    => 'image',
				'hover'              => 'tabs',
			),
            'position_left' => array(
				'label'            => __('Position left', 's3dm-s3-divi-modules'),
				'type'             => 'range',
				'toggle_slug'      => 'main_content',
                'default_unit'     => '%',
			),
			'position_top' => array(
				'label'             => __('Position top', 's3dm-s3-divi-modules'),
				'type'              => 'range',
				'toggle_slug'       => 'main_content',
                'default_unit'     => '%',
			),
            'use_category_name_as_title' => array(
				'label'           	=> esc_html__( 'Use Category Name as Title', 's3dm-s3-divi-modules' ),
				'type'             	=> 'yes_no_button',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'option_category' 	=> 'basic_option',
				'default_on_front'	=> 'off',
				'toggle_slug'     	=> 'main_content',
			),
            'current_category' => array(
				'label'             => esc_html__( 'Current Category', 's3dm-s3-divi-modules' ),
				'type'              => 'select',
                'options'           => $this->getCategorySlugList(),
				'option_category'   => 'basic_option',
				'description'       => esc_html__( 'Choose which category is currently displayed. Pleas choose only one', 's3dm-s3-divi-modules' ),
				'toggle_slug'       => 'connections',
                'defualt_on_front'  => 0,
			),
            'connections' => array(
                'label'            => esc_html__( 'Connect to Categories', 's3dm-s3-divi-modules' ),
				'type'             => 'categories',
				'option_category'  => 'basic_option',
				'renderer_options' => array(
					'use_terms' => false,
				),
				'description'      => esc_html__( 'Choose which to which category you would like to connect', 's3dm-s3-divi-modules' ),
				'toggle_slug'      => 'connections',
            ),
            
        );


		return $fields;
	} 



	public function render( $attrs, $content = null, $render_slug ) {

        $title                      = $this->props['title'];
        $current_category           = $this->props['current_category'];
        $category_link              = get_category_link_by_slug($current_category);
        $icon                       = $this->props['icon'];
		
		if($this->props['connections']):
        	$connections            = getConnectionListFromTermID($this->props['connections']);
		else:
			$connections 			= '';
		endif;

        $alt                        = s3dm_get_image_alt_text_from_url($icon);
		$title_text                 = s3dm_get_image_title_from_url($icon);
        $multi_view        	        = et_pb_multi_view_options( $this );

        $image_attrs = array(
			'src'    => '{{icon}}',
			'alt'    => esc_attr( $alt ),
			'title'  => esc_attr( $title_text ),
			'height' => 'auto',
			'width'  => 'auto',
		);

		$image = $multi_view->render_element(
			array(
				'tag'      => 'img',
				'attrs'    => $image_attrs,
				'required' => 'icon',
			)
		);

        $content = array(
            'title'             => $title,
            'current_category'  => $current_category,
            'connections'       => $connections,
            'link'              => $category_link,
            'image'             => $image,
        );

		$min = 1;
		$max = 1.3;
		$step = 0.1;

		$number = mt_rand(floor($min / $step), floor($max / $step)) * $step;
        
        //renders inline style as css
        ET_Builder_Element::set_style( $render_slug, array(
            'selector'    => '.s3dm_cluster_container %%order_class%%',
            'declaration' => sprintf(
                'top: %1$s; left: %2$s; transform: scale(%3$s);',
                esc_html( $this->props['position_top'] ),
                esc_html( $this->props['position_left'] ),
				$number
            ),
        ) );

		$output = $this->view->render('modules/ClusterItem/ClusterItem', $content);
		

		return $output;
        
	}

	public function getCategorySlugList(){

        $categoriesValue = [];


        $categories = get_categories(array(
            'oderby' => 'name',
            'hide_empty' => false,
            'child_of' => 13
        ));

        foreach($categories as $cat){


            $categoriesValue[$cat->slug] = $cat->name;


        }

        $categoriesValue[0] = 'Bitte eine Kategorie auswählen';

        
        return $categoriesValue;

        

    }

}

new S3DM_ClusterItem;

