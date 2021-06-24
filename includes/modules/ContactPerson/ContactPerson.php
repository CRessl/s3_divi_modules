<?php

class S3DM_ContactPerson extends ET_Builder_Module {

	public $slug       = 's3dm_post_contact';
	public $vb_support = 'on';
    private $view;

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => 's3-advertising',
		'author_uri' => 'https://s3-advertising.com',
	);

	public function init() {
		$this->name = esc_html__( 'Contact Person / Author', 's3dm-s3-divi-modules' );
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
            'show_image' => array(
				'label'            => esc_html__( 'Show Featured Image', 's3dm-s3-divi-modules' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
                'toggle_slug'      => 'featured_image',
				'default_on_front' => 'off',
				'description'      => esc_html__( 'This setting will turn on and off the featured image in the slider.', 's3dm-s3-divi-modules' ),
                'show_if_not'      => array(
                    'post_list_layout' => 'first_post_right'
                ),
                'affects'          => array(
                    'image_position'
                )
			),
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
				'toggle_slug'      => 'elements',
				'description'      => esc_html__( 'This setting will turn on and off the featured image in the slider.', 's3dm-s3-divi-modules' ),
				'mobile_options'   => true,
			),
            'show_meta' => array(
				'label'            => esc_html__( 'Show Post Meta', 's3dm-s3-divi-modules' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
                'affects' => array(
                    'show_email',
                    'show_phone'
                ),
				'default_on_front' => 'on',
				'toggle_slug'      => 'elements',
				'description'      => esc_html__( 'This setting will turn on and off the meta section.', 's3dm-s3-divi-modules' ),
			),
            'show_email' => array(
				'label'            => esc_html__( 'Show E-Mail', 's3dm-s3-divi-modules' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' )
				),
				'default_on_front' => 'on',
                'show_if'          => array(
                    'show_meta' => 'on'
                ),
				'toggle_slug'      => 'elements',
				'description'      => esc_html__( 'This setting will turn on and off the meta section.', 's3dm-s3-divi-modules' ),
			),
            'show_phone' => array(
				'label'            => esc_html__( 'Show phone number', 's3dm-s3-divi-modules' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'default_on_front' => 'on',
                'show_if'          => array(
                    'show_meta' => 'on'
                ),
				'toggle_slug'      => 'elements',
				'description'      => esc_html__( 'This setting will turn on and off the meta section.', 's3dm-s3-divi-modules' ),
			),
        );

        return $fields;

    }
   


    public function render( $attrs, $content = null, $render_slug ) {

        $currentPost = get_the_ID();
		$show_meta = $this->props['show_meta'];
		$show_image = $this->props['show_image'];
		$show_phone = $this->props['show_phone'];
		$show_email = $this->props['show_email'];
		$title_size = $this->props['title_size'];


		/*
		 *
		 * $contact contains an array of post objects
		 * therefore we need to iterate trough the array to get the object
		 * 
		*/

		$contact = get_field('ehi_post_contact', $currentPost);
		
		$output = '';

		foreach($contact as $contactPerson){

			$contactID = $contactPerson->ID;

			$image = wp_get_attachment_image(attachment_url_to_postid( get_field('ehi_team_bild', $contactID) ), 'medium', false, ['class' => 'uk-border-circle']);
			
			$phone = get_field('ehi_team_telefon', $contactID);
			$email = get_field('ehi_team_email', $contactID);
			$name = get_field('ehi_team_vorname', $contactID).' '.get_field('ehi_team_nachname', $contactID);
			$position = get_field('ehi_team_position', $contactID);
			$title = get_field('ehi_team_titel', $contactID);

			$output .= $this->view->render('modules/ContactPerson/ContactPerson', array(
				'title' 		=> $title,
				'name' 			=> $name,
				'image' 		=> $image,
				'phone' 		=> $phone,
				'email'			=> $email,
				'show_meta' 	=> $show_meta,
				'position' 		=> $position,
				'show_email' 	=> $show_email,
				'show_image' 	=> $show_image,
				'show_phone' 	=> $show_phone,
				'title_size' 	=> $title_size,
			));

		}

        return $output;

    }//end of render function

}

new S3DM_ContactPerson;