<?php

class S3DM_FACTFinder extends ET_Builder_Module_Type_PostBased {

	public $slug       = 's3dm_factfinder_results';
	public $vb_support = 'on';
    private $view;

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => 's3-advertising',
		'author_uri' => 'https://s3-advertising.com',
	);

	public function init() {
		$this->name = esc_html__( 'FACT Finder result list', 's3dm-s3-divi-modules' );

        $this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => __('Layout options', 's3dm-s3-divi-modules'),
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

    public function get_fields(){

        $fields = array(
            'layout' => array(
                'label'             => esc_html__('Layout', 's3dm-s3-divi-modules'),
                'type'              => 'select',
                'options'           => array(
                    'list'  => esc_html__('List', 's3dm-s3-divi-modules'),
                    'grid'  => esc_html__('Grid', 's3dm-s3-divi-modules'),
                ),
                'toggle_slug'       => 'main_content',
                'default_on_front'  => 'default',
            ),
            'show_image' => array(
                'label'             =>  esc_html__('Show Image', 's3dm-s3-divi-modules'),
                'type'              => 'yes_no_button',
                'default_on_front'  => 'on',
                'toggle_slug'       => 'main_content',    
            ),
            'show_image' => array(
                'label'             =>  esc_html__('Show Image', 's3dm-s3-divi-modules'),
                'type'              => 'yes_no_button',
                'default_on_front'  => 'on',
                'toggle_slug'       => 'main_content',    
            ),
            'columns' => array(
                'label'             => esc_html__('Columns', 's3dm-s3-divi-modules'),
                'type'              => 'text',
                'toggle_slug'       => 'main_content',
                'default_on_front'  => 'default',
            ),
        );

        return $fields;
    

    }

    public function render( $attrs, $content = null, $render_slug ) {

        
              
        $output = $this->view->render('modules/factfinder/partials/factfinder_result_list', array(
                'layout'        => $this->props['layout'],
                'show_image'    => $this->props['show_image'],
                'show_date'     => $this->props['show_date'],
                'columns'       => $this->props['columns']
        ));


        return $output;

    }//end of render function

}

new S3DM_FACTFinder;