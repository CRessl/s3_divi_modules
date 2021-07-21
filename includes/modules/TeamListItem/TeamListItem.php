<?php
/**
 * 
 * Add custom links as list, grid or bubble option
 * each link item can be positioned manually if bubble layout is selected
 * 
 * 
*/


class S3DM_TeamListItem extends ET_Builder_Module {

	public $slug       = 's3dm_teamlist_item';
	public $vb_support = 'on';
	private $view;

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => 's3-advertising',
		'author_uri' => 'https://s3-advertising.com',
	);

	public function init() {
		$this->name = esc_html__( 'Team List Item', 's3dm-s3-divi-modules' );
        $this->type             = 'child';
		$this->child_title_var  = 'title';
        
	}

	public function __construct(){
        parent::__construct(); 
        $this->setView();
    }

    public function setView(){
        $this->view = Plates(s3dm_templatePath($this));
    }


	public function get_fields() {

        $fields = array(

            'title' => array(
                'label'            => esc_html__( 'Title', 's3dm-s3-divi-modules' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Title of the Element', 's3dm-s3-divi-modules' ),
            ),
            'teammember' => array(
                'label'            => esc_html__( 'Teammember', 's3dm-s3-divi-modules' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose a teammember', 's3dm-s3-divi-modules' ),
				'computed_affects' => array(
					'__teamMemberData',
				),
				'dynamic_content' => 'url',
            ),
			'__teamMemberData'                 => array(
				'type'                => 'computed',
				'computed_callback'   => array( 'S3DM_TeamListItem', 'get_teammember_infos' ),
				'computed_depends_on' => array(
					'teammember',
				),
			),
        );

		return $fields;
	}

	static function get_teammember_infos( $args = array(), $conditional_tags = array(), $current_page = array(), $is_ajax_request = true ) {

		
		$teammember = $args['teammember'];
		$teammemberID = getIdFromDynamicLinkfield($teammember);
		$teammemberData = [];

		$image = get_field('ehi_team_bild', $teammemberID);
        $name = trim(get_field('ehi_team_vorname', $teammemberID)).' '.trim(get_field('ehi_team_nachname', $teammemberID));
        $email = get_field('ehi_team_email', $teammemberID);
        $attachment = wp_get_attachment_image_url(attachment_url_to_postid($image), 'contact_480', false);

		$teammemberData = array(
			'name' => $name,
            'image' => $image,
            'email' => $email,
            'attachment' => $attachment
		);
		
		return $teammemberData;
		
    }

	public function render( $attrs, $content = null, $render_slug ) {
		global $title_size;

        $teamMemberID = url_to_postid($this->props['teammember']);

        $image = get_field('ehi_team_bild', $teamMemberID);
		
        $name = trim(get_field('ehi_team_vorname', $teamMemberID)).' '.trim(get_field('ehi_team_nachname', $teamMemberID));
        $email = get_field('ehi_team_email', $teamMemberID);
        $attachment = wp_get_attachment_image(attachment_url_to_postid($image), 'contact_480', false, array('class' => 'uk-display-block'));

        $output = $this->view->render('TeamListItem', array(
            'name' => $name,
            'image' => $image,
            'email' => $email,
            'attachment' => $attachment,
			'title_size' => $title_size
         ));
		
		
		return $output;
        
	}

	

}

new S3DM_TeamListItem;

