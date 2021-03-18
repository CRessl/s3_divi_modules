<?php

class S3DM_PostTabSlider extends ET_Builder_Module_Type_PostBased {

	public $slug       = 's3dm_post_tab_slider';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => 's3-advertising',
		'author_uri' => 'https://s3-advertising.com',
	);

	public function init() {
		$this->name = esc_html__( 'Post Tab Slider', 's3dm-s3-divi-modules' );
	}

	public function get_fields() {
		return array(
            'posts_number'            => array(
				'label'            => esc_html__( 'Post Count', 'et_builder' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose how many posts you would like to display in the slider.', 'et_builder' ),
				'toggle_slug'      => 'main_content',
				'computed_affects' => array(
					'__posts',
				),
			),
            'include_categories'      => array(
				'label'            => esc_html__( 'Included Categories', 'et_builder' ),
				'type'             => 'categories',
				'meta_categories'  => array(
					'all'     => esc_html__( 'All Categories', 'et_builder' ),
					'current' => esc_html__( 'Current Category', 'et_builder' ),
				),
				'option_category'  => 'basic_option',
				'description'      => esc_html__( 'Choose which categories you would like to include in the slider.', 'et_builder' ),
				'toggle_slug'      => 'main_content',
				'computed_affects' => array(
					'__posts',
				),
			),
            'orderby'                 => array(
				'label'            => esc_html__( 'Order By', 'et_builder' ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'options'          => array(
					'date_desc'  => esc_html__( 'Date: new to old', 'et_builder' ),
					'date_asc'   => esc_html__( 'Date: old to new', 'et_builder' ),
					'title_asc'  => esc_html__( 'Title: a-z', 'et_builder' ),
					'title_desc' => esc_html__( 'Title: z-a', 'et_builder' ),
					'rand'       => esc_html__( 'Random', 'et_builder' ),
				),
				'toggle_slug'      => 'main_content',
				'description'      => esc_html__( 'Here you can adjust the order in which posts are displayed.', 'et_builder' ),
				'computed_affects' => array(
					'__posts',
				),
				'show_if'          => array(
					'use_current_loop' => 'off',
				),
				'default_on_front' => 'date_desc',
			),
            'show_image'              => array(
				'label'            => esc_html__( 'Show Featured Image', 'et_builder' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'default_on_front' => 'on',
				'toggle_slug'      => 'featured_image',
				'description'      => esc_html__( 'This setting will turn on and off the featured image in the slider.', 'et_builder' ),
				'mobile_options'   => true,
			),
            'show_excerpt'         => array(
				'label'            => esc_html__( 'Show Excerpt', 'et_builder' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'default_on_front' => 'on',
				'toggle_slug'      => 'elements',
				'description'      => esc_html__( 'This setting will display the excerpt of the post', 'et_builder' ),
				'mobile_options'   => true,
			),
            'show_meta'               => array(
				'label'            => esc_html__( 'Show Post Meta', 'et_builder' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'default_on_front' => 'on',
				'toggle_slug'      => 'elements',
				'description'      => esc_html__( 'This setting will turn on and off the meta section.', 'et_builder' ),
				'mobile_options'   => true,
			),
            'image_placement'         => array(
				'label'            => esc_html__( 'Featured Image Placement', 'et_builder' ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'options'          => array(
					'background' => et_builder_i18n( 'Background' ),
					'left'       => et_builder_i18n( 'Left' ),
					'right'      => et_builder_i18n( 'Right' ),
				),
				'default_on_front' => 'right',
				'depends_show_if'  => 'on',
				'toggle_slug'      => 'featured_image',
				'description'      => esc_html__( 'Select how you would like to display the featured image in slides', 'et_builder' ),
			),
            '__posts'                 => array(
				'type'                => 'computed',
				'computed_callback'   => array( 'S3DM_PostTabSlider', 'get_slider_posts' ),
				'computed_depends_on' => array(	
					'posts_number',
					'include_categories',
					'orderby',
				),
			),
		);
	}
    static function get_slider_posts( $args = array(), $conditional_tags = array(), $current_page = array(), $is_ajax_request = true ) {

        $defaults = array(
			'posts_number'       => '',
			'include_categories' => '',
			'orderby'            => '',
		);

        $queryArgs = array(
            'numberposts'        => $args['posts_number'],
            'category'           => $args['include_categories'],
            'post_status'        => array( 'publish', 'private' ),
        );

        if ( 'date_desc' !== $args['orderby'] ) {
			switch ( $args['orderby'] ) {
				case 'date_asc':
					$queryArgs['orderby'] = 'date';
					$queryArgs['order']   = 'ASC';
					break;
				case 'title_asc':
					$queryArgs['orderby'] = 'title';
					$queryArgs['order']   = 'ASC';
					break;
				case 'title_desc':
					$queryArgs['orderby'] = 'title';
					$queryArgs['order']   = 'DESC';
					break;
				case 'rand':
					$queryArgs['orderby'] = 'rand';
					break;
			}
		}


        $posts = get_posts($queryArgs);
		$postCount = 0;

		$componentID = rand(1, 500);

		foreach($posts as $sliderContents){

			$categories = wp_get_post_categories($sliderContents->ID);

            $cats = array();
     
            foreach($categories as $c){
                $cat = get_category( $c );
                $cats[] = '<div><span class="s3dm_tab_slider_category">'.$cat->name.'</span></div>';
            }

            $categoryList = implode('', $cats);

			$posts['postData'][$postCount]['title'] = get_the_title($sliderContents->ID);
			$posts['postData'][$postCount]['excerpt'] = get_the_excerpt($sliderContents->ID);
			$posts['postData'][$postCount]['image'] = get_the_post_thumbnail_url($sliderContents->ID, 'full');
			$posts['postData'][$postCount]['categories'] = $categoryList;
			$posts['postData'][$postCount]['link'] = get_the_permalink($sliderContents->ID);
			$posts['postData'][$postCount]['style'] = array('backgroundImage' => $posts['postData'][$postCount]['image']);

			$postCount++;
		}
		$posts['componentID'] = $componentID;
        return $posts;

    }

	public function render( $attrs, $content = null, $render_slug ) {

        $args = array(
            'numberposts'       => $this->props['posts_number'],
			'category' 			=> $this->props['include_categories'],
			'orderby'           => $this->props['orderby'],
        );

        $slider_posts = get_posts($args);

        $nav = '<div class="s3dm_switcher s3dm_tab_navigation uk-grid uk-child-width-1-'.$this->props['posts_number'].'" uk-switcher="connect:.s3dm_tab_contents; animation: uk-animation-fade">';

        foreach($slider_posts as $sliderContent){

            $title = get_the_title($sliderContent->ID);
            $categories = wp_get_post_categories($sliderContent->ID);

            $cats = array();
     
            foreach($categories as $c){
                $cat = get_category( $c );
                $cats[] = '<div><span class="s3dm_tab_slider_category">'.$cat->name.'</span></div>';
            }

            $cat_list = implode('', $cats);

            $nav .= '<div class="tab-content">';
				$nav .= '<div class="uk-padding-small uk-padding-remove-horizontal">';
					$nav .= '<div class="s3dm_tab_nav_category_list uk-grid-small uk-margin" uk-grid>'.$cat_list.'</div>';
					$nav .= '<div class="s3dm_tab_nav_post_title">'.$title.'</div>';
				$nav .= '</div>';
			$nav .= '</div>';



        }

        $nav .= '</div>';


        $content = '<div class="uk-switcher s3dm_tab_contents">';
        foreach($slider_posts as $sliderContentTab){

            $title = get_the_title($sliderContentTab->ID);
            $categories = wp_get_post_categories($sliderContentTab->ID);
            $excerpt = get_the_excerpt($sliderContentTab->ID);
            $link = '<a href="'.get_the_permalink($sliderContentTab->ID).'">Zum Artikel</a>';

            $cats = array();
     
            foreach($categories as $c){
                $cat = get_category( $c );
                $cats[] = '<div><span class="s3dm_tab_slider_category">'.$cat->name.'</span></div>';
            }

            $cat_list = implode('', $cats);

            $content .= '<div class="uk-grid uk-child-width-1-2@m uk-child-width-1-1 s3dm_grid_container" uk-grid>';
            
            //Title, Category and Exerpt
            $content .= '<div class="s3dm_grid_content">';
                $content .= '<div class="s3dm_tab_content_post_categories uk-grid-small" uk-grid>'.$cat_list.'</div>';
                $content .= '<div class="s3dm_tab_content_post_title"><h3>'.$title.'</h3></div>';
                $content .= '<div class="s3dm_tab_content_post_excerpt uk-margin-medium-bottom">'.$excerpt.'</div>';
				$content .= '<div class="s3dm_tab_content_post_link">'.$link.'</div>';
            $content .= '</div>';

			$imageURL = get_the_post_thumbnail_url($sliderContentTab->ID, 'full');
            //Image
            $content .= '<div class="s3dm_grid_image">';
                $content .= '<div class="s3dm_tab_content_post_image uk-background-cover uk-background-center-center" style="background-image: url('.$imageURL.');">'.get_the_post_thumbnail($sliderContentTab->ID, 'full').'</div>';
            $content .= '</div>';



            $content .= '</div>';


        }

        $content .= '</div>';

		
		$script = $this->getScript();


        $output = sprintf(
			'<div id="%4$s">
				<div class="s3dm-tab-slider-content-container uk-margin-large-bottom">
					%1$s
				</div>
				<div class="s3dm-tab-slider-tab-nav-container">                
					%2$s
				</div>
			</div>
			%3$s
			',
            $content,
			$nav,
			$script,
			's3dm_switcher_all_container_'
		);

		return $output;
	}


	public function getScript(){

		$script = ob_start();?>

		<script>

			var $element = document.querySelector('.s3dm_tab_contents');

			jQuery(document).on('shown', $element, function(event, element){
				
				var activeContentElement = event.target;
				var navActive = element;

				var text = jQuery(activeContentElement).find('.s3dm_grid_content');
				var image = jQuery(activeContentElement).find('.s3dm_grid_image')

				gsap.to(text, {x:0, opacity:1, duration: 0.5, delay:0.3});

				gsap.to(image, {x: 0,duration: 0.5,opacity: 1,delay: 0.3});

			});

			jQuery(document).on('beforehide', $element, function(event, element){

				var activeContentElement = event.target;
				var navActive = element;

				var text = jQuery(activeContentElement).find('.s3dm_grid_content');
				var image = jQuery(activeContentElement).find('.s3dm_grid_image')

				gsap.to(text, {x:-100, opacity:0, duration: 0.5, delay:0.3});

				gsap.to(image, {x: 100, duration: 0.5,opacity: 0, delay: 0.3});

			});
		
		</script>

		<?php

		$scriptOutput = ob_get_clean();

		return $scriptOutput;

	}
}

new S3DM_PostTabSlider;
