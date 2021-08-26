<?php
/**
 * front page theme options
 * @since Fansee Business 1.0
 */
if( !class_exists( 'Fansee_Business_Frontpage_Customizer' ) ){
	class Fansee_Business_Frontpage_Customizer extends Fansee_Business_Customizer{

		public $fields = array();

		public function __construct( $panel ){

			$this->fields = array(
				array(
					'id'    => 'general-frontpage-section',
					'title' => esc_html__( 'General', 'business-infnity' ),
					'fields' => $this->general_options()
				),
				array(
					'id'     => 'slider-frontpage-section',
					'title'  => esc_html__( 'Slider', 'business-infnity' ),
					'fields' => $this->slider_options()
				),
				array(
				    'id'     => 'about-section',
				    'title'  => esc_html__( 'About', 'business-infnity' ),
				    'fields' => $this->about_options()
				),
				array(
				    'id'     => 'service-section',
				    'title'  => esc_html__( 'Service', 'business-infnity' ),
				    'fields' => $this->service_options()
				),
				array(
				    'id'     => 'team-section',
				    'title'  => esc_html__( 'Team', 'business-infnity' ),
				    'fields' => $this->team_options()
				),
				array(
				    'id'     => 'cta-section',
				    'title'  => esc_html__( 'Call to action', 'business-infnity' ),
				    'fields' => $this->cta_options()
				),
				array(
				    'id'     => 'testimonial-section',
				    'title'  => esc_html__( 'Testimonial', 'business-infnity' ),
				    'fields' => $this->testimonial_options()
				),
				array(
				    'id'     => 'blog-section',
				    'title'  => esc_html__( 'Blog', 'business-infnity' ),
				    'fields' => $this->blog_options()
				)
			);

			$this->add( $panel );
		}

		public function general_options(){
			return array(
				array(
					'id'      => 'svg-bg-color',
					'label'   => esc_html__( 'SVG Shape Color', 'business-infnity' ),
					'type'    => 'color',
					'default' => '#1c1c1c',
				),
				array(
				    'id'      => 'show-content',
				    'label'   => esc_html__( 'Show Front Page Content', 'business-infnity' ),
				    'type'    => 'toggle',
				    'default' => true
				),
				array(
				    'id'      => 'show-content-above',
				    'label'   => esc_html__( 'Show Content Above', 'business-infnity' ),
				    'type'    => 'toggle',
				    'default' => false,
				    'active_callback' => array( __CLASS__, 'show_frontpage_content_above' )
				)
			);
		}

		public static function slider_page_mode_cb( $control ){
			return self::get( "enable-slider" ) && self::get( 'slider-mode' ) == 'page';
		}

		public static function slider_category_mode_cb( $control ){
			return self::get( "enable-slider" ) && self::get( 'slider-mode' ) == 'category';
		}

	    public function slider_options(){
			return array(
				array(
					'id'      => 'enable-slider',
					'label'   => esc_html__( 'Enable Slider', 'business-infnity' ),
					'type'    => 'toggle',
					'default' => true
				),
				array(
					'id'      => 'slider-mode',
					'label'   => esc_html__( 'Slider Mode', 'business-infnity' ),
					'type'    => 'select',
					'default' => 'page',
					'choices' => array(
						'page' => esc_html__( 'Page', 'business-infnity' ),
						'category' => esc_html__( 'Category', 'business-infnity' )
					),
					'active_callback' => array( __CLASS__, 'module_callback' )
				),
				array(
					'id'    => 'slider-pages',
					'label' => esc_html__( 'Pages', 'business-infnity' ),
					'type'  => 'page-repeater',
					'limit' => 3,
					'default' => '',
					'active_callback' => array( __CLASS__, 'slider_page_mode_cb' )
				),
				array(
					'id'    => 'slider-category',
					'label' => esc_html__( 'Category Id', 'business-infnity' ),
					'type'  => 'number',
					'default' => '',
					'active_callback' => array( __CLASS__, 'slider_category_mode_cb' )
				),
				array(
					'id' => 'slider-style',
					'label' => esc_html__( 'Style', 'business-infnity' ),
					'type'  => 'select',
					'default' => 'curve',
					'choices' => array(
						'default' => esc_html__( 'Default', 'business-infnity' ),
						'curve'   => esc_html__( 'Curve', 'business-infnity' )
					)
				),
				array(
					'id'    => 'slider-autoplay',
					'label' => esc_html__( 'Auto Play', 'business-infnity' ),
					'type'  => 'toggle',
					'default' => false,
					'active_callback' => array( __CLASS__, 'module_callback' )
				),			
				array(
					'id'    => 'slider-dots',
					'label' => esc_html__( 'Dots', 'business-infnity' ),
					'type'  => 'toggle',
					'default' => true,
					'active_callback' => array( __CLASS__, 'module_callback' )
				),			
				array(
					'id'    => 'slider-infinite',
					'label' => esc_html__( 'Infinite Scroll', 'business-infnity' ),
					'type'  => 'toggle',
					'default' => true,
					'active_callback' => array( __CLASS__, 'module_callback' )
				),
				array(
					'id'      => 'enable-slider-shortcode',
					'label'   => esc_html__( 'Enable Shortcode', 'business-infnity' ),
					'type'    => 'toggle',
					'default' => false
				),
				array(
					'id'    => 'slider-shortcode',
					'label' => esc_html__( 'Shortcode', 'business-infnity' ),
					'type'  => 'text',
					'default' => '',
					'active_callback' => array( __CLASS__, 'module_shortcode_callback' )
				)
			);
		}

		public function about_options(){
			return array(
				array(
					'id'      => 'enable-about',
					'label'   => esc_html__( 'Enable', 'business-infnity' ),
					'type'    => 'toggle',
					'default' => false
				),
				array(
					'id'    => 'about-page',
					'label' => esc_html__( 'Page', 'business-infnity' ),
					'type'  => 'dropdown-pages',
					'default' => '0',
					'active_callback' => array( __CLASS__, 'module_callback' )
				),
				array(
					'id'    => 'about-btn-text',
					'label' => esc_html__( 'Button Text', 'business-infnity' ),
					'type'  => 'text',
					'default' => esc_html__( 'Know More' ,'business-infnity' ),
					'active_callback' => array( __CLASS__, 'module_callback' )
				),
				array(
					'id'      => 'enable-about-shortcode',
					'label'   => esc_html__( 'Enable Shortcode', 'business-infnity' ),
					'type'    => 'toggle',
					'default' => false
				),
				array(
					'id'    => 'about-shortcode',
					'label' => esc_html__( 'Shortcode', 'business-infnity' ),
					'type'  => 'text',
					'active_callback' => array( __CLASS__, 'module_shortcode_callback' )
				)
			);
		}

		public function service_options(){
			return array(
				array(
					'id'      => 'enable-service',
					'label'   => esc_html__( 'Enable', 'business-infnity' ),
					'type'    => 'toggle',
					'default' => false
				),
				array(
					'id'      => 'service-shape',
					'label'   => esc_html__( 'Enable Shape', 'business-infnity' ),
					'type'    => 'toggle',
					'default' => false,
					'active_callback' => array( __CLASS__, 'module_callback' )
				),
				array(
					'id'    => 'service-page',
					'label' => esc_html__( 'Content Page', 'business-infnity' ),
					'type'  => 'dropdown-pages',
					'default' => '0',
					'active_callback' => array( __CLASS__, 'module_callback' )
				),
				array(
					'id'    => 'service-btn-text',
					'label' => esc_html__( 'Button Text', 'business-infnity' ),
					'type'  => 'text',
					'default' => esc_html__( 'More Services' ,'business-infnity' ),
					'active_callback' => array( __CLASS__, 'module_callback' )
				),
				array(
					'id'    => 'service-pages',
					'label' => esc_html__( 'Sub Pages', 'business-infnity' ),
					'type'  => 'page-repeater',
					'limit' => 6,
					'active_callback' => array( __CLASS__, 'module_callback' )
				),
				array(
					'id'      => 'enable-service-shortcode',
					'label'   => esc_html__( 'Enable Shortcode', 'business-infnity' ),
					'type'    => 'toggle',
					'default' => false
				),
				array(
					'id'    => 'service-shortcode',
					'label' => esc_html__( 'Shortcode', 'business-infnity' ),
					'type'  => 'text',
					'active_callback' => array( __CLASS__, 'module_shortcode_callback'  )
				)
			);
		}

		public function team_options(){
			return array(
				array(
					'id'      => 'enable-team',
					'label'   => esc_html__( 'Enable', 'business-infnity' ),
					'type'    => 'toggle',
					'default' => false
				),
				array(
					'id'      => 'team-shape',
					'label'   => esc_html__( 'Enable Shape', 'business-infnity' ),
					'type'    => 'toggle',
					'default' => false,
					'active_callback' => array( __CLASS__, 'module_callback' )
				),
				array(
					'id'    => 'team-page',
					'label' => esc_html__( 'Content Page', 'business-infnity' ),
					'type'  => 'dropdown-pages',
					'default' => '0',
					'active_callback' => array( __CLASS__, 'module_callback' )
				),
				array(
					'id'    => 'team-btn-text',
					'label' => esc_html__( 'Button Text', 'business-infnity' ),
					'type'  => 'text',
					'default' => esc_html__( 'View All Member' ,'business-infnity' ),
					'active_callback' => array( __CLASS__, 'module_callback' )
				),
				array(
					'id'    => 'team-pages',
					'label' => esc_html__( 'Sub Pages', 'business-infnity' ),
					'type'  => 'page-repeater',
					'description' => esc_html__( 'Recommended Title: Team Member Name', 'business-infnity' ) . ' <span>' . esc_html__( 'Designation', 'business-infnity' ) . '</span>',
					'limit' => 5,
					'active_callback' => array( __CLASS__, 'module_callback' )
				),
				array(
					'id'    => 'team-posts-per-page',
					'label' => esc_html__( 'Total team to show', 'business-infnity' ),
					'type'  => 'number',
					'input_attrs' => array( 'max' => 4, 'min' => 1 ),
					'default' => 3,
					'active_callback' => array( __CLASS__, 'module_callback' )
				),
				array(
					'id'    => 'team-col',
					'label' => esc_html__( 'Total column per row', 'business-infnity' ),
					'type'  => 'number',
					'input_attrs' => array( 'max' => 4, 'min' => 1 ),
					'default' => 3,
					'active_callback' => array( __CLASS__, 'module_callback' )
				),		
				array(
					'id'    => 'team-archive-page',
					'label' => esc_html__( 'Select a Team Archive Page', 'business-infnity' ),
					'type'  => 'dropdown-pages',
					'default' => 0,
					'active_callback' => array( __CLASS__, 'module_callback' )
				),
				
				array(
					'id'      => 'enable-team-shortcode',
					'label'   => esc_html__( 'Enable Shortcode', 'business-infnity' ),
					'type'    => 'toggle',
					'default' => false
				),
				array(
					'id'    => 'team-shortcode',
					'label' => esc_html__( 'Shortcode', 'business-infnity' ),
					'type'  => 'text',
					'active_callback' => array( __CLASS__, 'module_shortcode_callback' )
				)
			);
		}

		public function cta_options(){
			return array(
				array(
					'id'      => 'enable-cta',
					'label'   => esc_html__( 'Enable', 'business-infnity' ),
					'type'    => 'toggle',
					'default' => false
				),
				array(
					'id'    => 'cta-page',
					'label' => esc_html__( 'Content Page', 'business-infnity' ),
					'type'  => 'dropdown-pages',
					'default' => '0',
					'active_callback' => array( __CLASS__, 'module_callback' )
				),
				array(
					'id'    => 'cta-btn-link',
					'label' => esc_html__( 'Button Link', 'business-infnity' ),
					'type'  => 'text',
					'default' => '#',
					'active_callback' => array( __CLASS__, 'module_callback' )
				),
				array(
					'id'    => 'cta-btn-text',
					'label' => esc_html__( 'Button Text', 'business-infnity' ),
					'type'  => 'text',
					'default' => esc_html__( 'GET IN TOUCH' ,'business-infnity' ),
					'active_callback' => array( __CLASS__, 'module_callback' )
				),
				array(
					'id'      => 'enable-cta-shortcode',
					'label'   => esc_html__( 'Enable Shortcode', 'business-infnity' ),
					'type'    => 'toggle',
					'default' => false
				),
				array(
					'id'    => 'cta-shortcode',
					'label' => esc_html__( 'Shortcode', 'business-infnity' ),
					'type'  => 'text',
					'active_callback' => array( __CLASS__, 'module_shortcode_callback' )
				)
			);
		}

		public function testimonial_options(){
			return array(
				array(
					'id'      => 'enable-testimonial',
					'label'   => esc_html__( 'Enable', 'business-infnity' ),
					'type'    => 'toggle',
					'default' => false
				),
				array(
					'id'      => 'testimonial-shape',
					'label'   => esc_html__( 'Enable Shape', 'business-infnity' ),
					'type'    => 'toggle',
					'default' => false,
					'active_callback' => array( __CLASS__, 'module_callback' )
				),
				array(
					'id'    => 'testimonial-page',
					'label' => esc_html__( 'Content Page', 'business-infnity' ),
					'type'  => 'dropdown-pages',
					'default' => '0',
					'active_callback' => array( __CLASS__, 'module_callback' )
				),
				array(
					'id'    => 'testimonial-pages',
					'label' => esc_html__( 'Sub Pages', 'business-infnity' ),
					'type'  => 'page-repeater',
					'limit' => 3,
					'active_callback' => array( __CLASS__, 'module_callback' )
				),
				array(
					'id'      => 'enable-testimonial-shortcode',
					'label'   => esc_html__( 'Enable Shortcode', 'business-infnity' ),
					'type'    => 'toggle',
					'default' => false
				),
				array(
					'id'    => 'testimonial-shortcode',
					'label' => esc_html__( 'Shortcode', 'business-infnity' ),
					'type'  => 'text',
					'active_callback' => array( __CLASS__, 'module_shortcode_callback' )
				)
			);
		}

		public function blog_options(){
			return array(
				array(
					'id'      => 'enable-blog',
					'label'   => esc_html__( 'Enable', 'business-infnity' ),
					'type'    => 'toggle',
					'default' => false
				),
				array(
					'id'      => 'blog-shape',
					'label'   => esc_html__( 'Enable Shape', 'business-infnity' ),
					'type'    => 'toggle',
					'default' => false,
					'active_callback' => array( __CLASS__, 'module_callback' )
				),
				array(
					'id'    => 'blog-page',
					'label' => esc_html__( 'Content Page', 'business-infnity' ),
					'type'  => 'dropdown-pages',
					'default' => '0',
					'active_callback' => array( __CLASS__, 'module_callback' )
				),
				array(
					'id'    => 'blog-posts-per-page',
					'label' => esc_html__( 'Total posts to show', 'business-infnity' ),
					'type'  => 'number',
					'input_attrs' => array( 'max' => 4, 'min' => 1 ),
					'default' => 4,
					'active_callback' => array( __CLASS__, 'module_callback' )
				),
				array(
					'id'    => 'blog-col',
					'label' => esc_html__( 'Total column per row', 'business-infnity' ),
					'type'  => 'number',
					'input_attrs' => array( 'max' => 4, 'min' => 1 ),
					'default' => 4,
					'active_callback' => array( __CLASS__, 'module_callback' )
				),
				array(
					'id'      => 'enable-blog-shortcode',
					'label'   => esc_html__( 'Enable Shortcode', 'business-infnity' ),
					'type'    => 'toggle',
					'default' => false
				),
				array(
					'id'    => 'blog-shortcode',
					'label' => esc_html__( 'Shortcode', 'business-infnity' ),
					'type'  => 'text',
					'active_callback' => array( __CLASS__, 'module_shortcode_callback' )
				)
			);
		}

		public static function show_frontpage_content_above(){
	        return self::get( 'show-content' );
	    }

	    public static function get_module_name( $control ){
	    	$id = str_replace( 'fansee-business-', '', $control->id );
	    	$arr = explode( '-', $id );
	    	if( is_array( $arr ) && isset( $arr[0] ) ){
	    		return $arr[0];
	    	}

	    	return false;
	    }
	    
	    public static function module_callback( $control ){
	    	$name = self::get_module_name( $control );
	    	if( $name ){
	    		return self::get( "enable-{$name}" );
	    	}

	    	return true;
	    }

	    public static function module_shortcode_callback( $control ){
	    	$name = self::get_module_name( $control );
	    	if( $name ){
	    		return self::get( "enable-{$name}-shortcode" );
	    	}
	    	return true;
	    }
	}
}
