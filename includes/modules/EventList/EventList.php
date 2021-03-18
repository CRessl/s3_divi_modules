<?php

class S3DM_EventList extends ET_Builder_Module_Type_PostBased {

	public $slug       = 's3dm_event_list';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => 's3-advertising',
		'author_uri' => 'https://s3-advertising.com',
	);

	public function init() {
		$this->name = esc_html__( 'Event List', 's3dm-s3-divi-modules' );
	}

	public function get_fields() {
		return array(
            'posts_number'  => array(
				'label'            => esc_html__( 'Post Count', 'et_builder' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose how much posts you would like to display per page.', 'et_builder' ),
				'computed_affects' => array(
					'__eventData',
				),
				'default'          => 3,
			),
            'show_more'                     => array(
				'label'            => esc_html__( 'Show Read More Button', 'et_builder' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'off' => et_builder_i18n( 'No' ),
					'on'  => et_builder_i18n( 'Yes' ),
				),
				'affects'	=> array(
					'button_text',
				),
				'description'      => esc_html__( 'Here you can define whether to show "read more" link after the excerpts or not.', 'et_builder' ),
				'default_on_front' => 'off',
			),
			'button_text'                     => array(
				'label'            => esc_html__( 'Read More Button Text', 'et_builder' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'depends_show_if'  => 'on',
				'description'      => esc_html__( 'Here you can define which text the button should have', 'et_builder' ),
			),
            'meta_date'                     => array(
				'label'            => esc_html__( 'Date Format', 'et_builder' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'If you would like to adjust the date format, input the appropriate PHP date format here.', 'et_builder' ),
				'default'          => 'M j, Y',
                'depends_show_if'  => 'on',
				'computed_affects' => array(
					'__eventData',
				)
			),
            '__eventData'                 => array(
				'type'                => 'computed',
				'computed_callback'   => array( 'S3DM_EventList', 'get_events' ),
				'computed_depends_on' => array(
					'posts_number',
					'meta_date'
				),
			),
		);
	}
    static function get_events( $args = array(), $conditional_tags = array(), $current_page = array(), $is_ajax_request = true ) {

		$defaults = array(
            'posts_number'          => 5,
            'meta_date'             => 'd.m.Y'
        );

        //merges args from computed field with defaults
        $args = wp_parse_args( $args, $defaults );

		$numberposts = $args['posts_number'];
		$dateFormat = $args['meta_date'];

		$query_args = array(
			'start_date' => 'now',
			'posts_per_page' => $numberposts,
		);

		$data = tribe_get_events($query_args);
	

		$postData = array();
		$count = 0;

		foreach($data as $postObject){

			$postData[$count]['date'] = tribe_get_start_date( $postObject, true, $dateFormat );
			$postData[$count]['title'] = $postObject->post_title;
			$postData[$count]['link'] = get_the_permalink($postObject->ID);
			$count++;
		}

		return $postData; 

    }

	public function render( $attrs, $content = null, $render_slug ) {

	
		$numberposts = $this->props['posts_number'];
		$dateFormat = $this->props['meta_date'];
		$button_text = $this->props['button_text'];

		if(!$button_text):
			$button_text = 'Mehr...';
		endif;

		if(!$numberposts):
			$numberposts = 5;
		endif;

		$args = array(
			'start_date' => 'now',
			'posts_per_page' => $numberposts,
		);

		
       
		$data = tribe_get_events($args);
			

		$post_list = '<div uk-grid class="uk-grid-divider">';

		foreach($data as $postObject){

			$post_list .= '<div class="uk-width-1-1 uk-width-1-'.$numberposts.'@m">';
			$post_list .= '<div class="'.$this->slug.'_date">'.tribe_get_start_date( $postObject, true, $dateFormat ).'</div>';
			$post_list .= '<div class="'.$this->slug.'_title"><h4>'.$postObject->post_title.'</h4></div>';
			$post_list .= '<div class="'.$this->slug.'_link">';
			$post_list .= '<a href="'.get_the_permalink($postObject->ID).'" class="uk-button uk-button-default">'.$button_text.'</a>';
			$post_list .= '</div>';
			$post_list .= '</div>';

		}

		$post_list .= '</div>';

		$output = sprintf(
			'<div class="%2$s">
				%1$s
			</div>
			',
            $post_list,
			$this->slug
		);


		return $output;
		


		
	}

}

new S3DM_EventList;
