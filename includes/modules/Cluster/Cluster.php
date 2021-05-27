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


        $content = array(
            'content' 		=> $this->props['content'],
			
        );

		ET_Builder_Element::set_style( $render_slug, array(
            'selector'    => '%%order_class%% .s3dm_cluster_container',
            'declaration' => sprintf(
                'min-height: %1$s;',
                esc_html( $this->props['min_height'] )
            ),
        ) );


		$output = $this->view->render('modules/Cluster/Cluster', $content);
		

		return $output;
        
	}

	

}

new S3DM_Cluster;

