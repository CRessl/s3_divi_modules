<?php
/**
 * 
 * Add custom links as list, grid or bubble option
 * each link item can be positioned manually if bubble layout is selected
 * 
 * 
*/


class S3DM_Cluster extends ET_Builder_Module {

	public $slug       = 's3dm_cluster';
	public $vb_support = 'on';
	private $view;

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => 's3-advertising',
		'author_uri' => 'https://s3-advertising.com',
	);

	public function init() {
		$this->name = esc_html__( 'Cluster', 's3dm-s3-divi-modules' );
		$this->child_slug = 's3dm_cluster_item';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => __('Settings', 's3dm-s3-divi-modules'),
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

			'bubble_color' => array(
				'label'            => __('Bubble Color', 's3dm-s3-divi-modules'),
				'type'             => 'color-alpha',
				'toggle_slug'      => 'main_content',
                'default'          => et_builder_accent_color(),
			),
			'bubble_color_hover' => array(
				'label'            => __('Bubble Color hover', 's3dm-s3-divi-modules'),
				'type'             => 'color-alpha',
				'toggle_slug'      => 'main_content',
                'default'          => et_builder_accent_color(),
			),
			'stroke_width' => array(
				'label'            => __('Stroke Width', 's3dm-s3-divi-modules'),
				'type'             => 'range',
				'toggle_slug'      => 'main_content',
                'default_unit'     => 'px',
				'range_settings' => array(
					'min'  => '1',
					'max'  => '10',
					'step' => '0.1',
				),
			),
			'stroke_color' => array(
				'label'            => __('Stroke Color', 's3dm-s3-divi-modules'),
				'type'             => 'color-alpha',
				'toggle_slug'      => 'main_content',
                'default'          => et_builder_accent_color(),
			),


		);

		return $fields;
	}


	public function render( $attrs, $content = null, $render_slug ) {

		$stroke_width = $this->props['stroke_width'];
		$stroke_color = $this->props['stroke_color'];
		$bubble_color = $this->props['bubble_color'];
		$bubble_color_hover = $this->props['bubble_color_hover'];
		
		if(!$stroke_width){

			$stroke_width = '1px';

		}

		if(!$stroke_color){

			$stroke_color = '#000000';

		}

		if(!$bubble_color){
			$bubble_color = '#d3d3d3';
		}

		if(!$bubble_color_hover){
			$bubble_color_hover = '#00b2b2';
		}


        $content = array(
            'content' 		=> $this->props['content'],
			'min_height'	=>  $this->props['min_height'],
			
        );

		ET_Builder_Element::set_style( $render_slug, array(
            'selector'    => '%%order_class%% .s3dm_cluster_container',
            'declaration' => sprintf(
                'min-height: %1$s;',
                esc_html( $this->props['min_height'] )
            ),
        ) );

		ET_Builder_Element::set_style( $render_slug, array(
            'selector'    => '%%order_class%% .s3dm_cluster_container .s3dm_cluster_item',
            'declaration' => sprintf(
                'background-color: %1$s;',
                esc_html( $bubble_color )
            ),
        ) );

		ET_Builder_Element::set_style( $render_slug, array(
            'selector'    => '%%order_class%% .s3dm_cluster_container .s3dm_cluster_item:hover',
            'declaration' => sprintf(
                'background-color: %1$s;',
                esc_html( $bubble_color_hover )
            ),
        ) );

		ET_Builder_Element::set_style( $render_slug, array(
            'selector'    => '%%order_class%% #paths line',
            'declaration' => sprintf(
                'stroke-width: %1$s; stroke: %2$s;',
                esc_html( $stroke_width ),
				esc_html( $stroke_color )
			)
        ) );


		$output = $this->view->render('modules/Cluster/Cluster', $content);
		

		return $output;
        
	}

	

}

new S3DM_Cluster;

