<?php
/**
 * 
 * Add custom links as list, grid or bubble option
 * each link item can be positioned manually if bubble layout is selected
 * 
 * 
*/


class S3DM_TeamList extends ET_Builder_Module {

	public $slug       = 's3dm_teamlist';
	public $vb_support = 'on';
	private $view;

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => 's3-advertising',
		'author_uri' => 'https://s3-advertising.com',
	);

	public function init() {
		$this->name = esc_html__( 'Team List', 's3dm-s3-divi-modules' );
		$this->child_slug = 's3dm_teamlist_item';

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
		return array();
	}


	public function render( $attrs, $content = null, $render_slug ) {


		$content = $this->props['content'];

		$output = sprintf( 
			'<div class="s3dm_teammember_container_wrapper uk-child-width-1-4@m uk-child-width-1-1" uk-grid>%1$s</div>',
			$content
		);
		
		return $output;
        
	}

	

}

new S3DM_TeamList;

