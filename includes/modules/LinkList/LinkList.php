<?php
/**
 * 
 * Add custom links as list, grid or bubble option
 * each link item can be positioned manually if bubble layout is selected
 * 
 * 
*/


class S3DM_LinkList extends ET_Builder_Module {

	public $slug       = 's3dm_link_list';
	public $vb_support = 'on';
	private $view;

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => 's3-advertising',
		'author_uri' => 'https://s3-advertising.com',
	);

	public function init() {
		$this->name = esc_html__( 'Link List', 's3dm-s3-divi-modules' );
		$this->child_slug = 's3dm_link_list_item';
		$this->main_css_element = '%%order_class%%.s3dm_link_list';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => __('List items', 's3dm-s3-divi-modules'),
					'layout'	=> __('Layout', 's3dm-s3-divi-modules'),
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
		return array(
			'list_layout' => array(
				'label'            => esc_html__( 'Layout', 'et_builder' ),
				'type'             => 'select',
                'options'          => array(
					'list'         => esc_html__( 'List', 'et_builder' ),
					'bubbles'      => esc_html__( 'Bubble', 'et_builder' ),
				),
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose how which layout should be displayed', 'et_builder' ),
				'toggle_slug'      => 'layout',
			),
		);
	}
	function before_render() {
		global $s3dm_link_list_item_number, $layout;

		$layout = $this->props['list_layout'];
		$s3dm_link_list_item_number  = 0;

	}


	protected function _render_module_wrapper( $output = '', $render_slug = '' ) {
		return $output;
	}

	public function render( $attrs, $content = null, $render_slug ) {

		/**	
		 * 
		 * Make this global so we can use it in child element
		 */
		global $layout, $s3dm_link_list_item_number;
		

		$height = $this->props['height'];
		$maxHeight = $this->props['height'];
		if(!$height){
			$height = '800px';
			$maxHeight = '800px';
		}


		$templateArgs = array(
			'content' => $this->content,
			'classes' => $this->slug.' uk-position-relative',
			'height' => $height,
			'maxHeight' => $maxHeight
		);

		
		if($layout == 'bubbles'):
			$templateArgs['classes'] = $this->slug.' uk-position-relative s3dm_link_list_layout_'.$layout;
		endif;

		$output = $this->view->render('modules/LinkList/LinkList', $templateArgs);
		

		return $output;
        
	}

	

}

new S3DM_LinkList;

