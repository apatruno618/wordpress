<?php
/**
 * theme options
 * @since Business Infinity 1.0
 */
if( !class_exists( 'Fansee_Business_Theme_Options_Customizer' ) ){
	class Fansee_Business_Theme_Options_Customizer extends Fansee_Business_Customizer{

		public $fields = array();

		public function __construct( $panel ){

			$this->fields = array(
				
				array(
				    'id'     => 'typography',
				    'title'  => esc_html__( 'Typography','business-infinity' ),
				    'fields' => $this->typography_options()
				),
				array(
				    'id'     => 'color-section',
				    'title'  => esc_html__( 'Color' ,'business-infinity' ),
				    'fields' => $this->color_options()
				),
				array(
				    'id'     => 'header_image', //default section
				    'fields' => $this->header_options()
				),
				array(
				    'id'     => 'breadcrumb-section',
				    'title'  => esc_html__( 'Breadcrumb' ,'business-infinity' ),
				    'fields' => $this->breadcrumb_options()
				),
				array(
				    'id'     => 'sidebar-section',
				    'title'  => esc_html__( 'Sidebar', 'business-infinity' ),
				    'fields' => $this->sidebar_options()
				),            
				array(
				    'id'     => 'post-section',
				    'title'  => esc_html__( 'Blog', 'business-infinity' ),
				    'fields' => $this->post_options()
				),                
				array(
				    'id'     => 'footer-section',
				    'title'  => esc_html__( 'Footer', 'business-infinity' ),
				    'fields' => $this->footer_options()
				),
				array(
				    'id'     => 'advanced-options-section',
				    'title'  => esc_html__( 'Advanced', 'business-infinity' ),
				    'fields' => $this->advanced_options()
				)
			);

			$this->add( $panel );
		}

		public static function get_fonts(){
			$fonts = fansee_business_get_fonts();
			$f = array();
			foreach( $fonts as $k => $v ){
				$f[$k] = $v['family'];
			}

			return $f;
		}

		public function typography_options(){
	        $message = esc_html__( 'The value is in px.', 'business-infinity' );
	        return array(  
	            array(
	                'id'          => 'site-info-font',
	                'label'       => esc_html__( 'Site Identity Font Family', 'business-infinity' ),
	                'description' => esc_html__( 'Font family for site title and tagline. Defaults to Hind', 'business-infinity' ),
	                'default'     => 'hind',
	                'type'        => 'select',
	                'choices'     => self::get_fonts(),
	            ),
	            array(
	                'id'      => 'body-font',
	                'label'   =>  esc_html__( 'Body Font Family.', 'business-infinity' ),
	                'description' => esc_html__( 'Defaults to Hind.', 'business-infinity' ),
	                'default' => 'hind',
	                'type'    => 'select',
	                'choices' => self::get_fonts(),
	            ),
	            array(
	                'id'          => 'heading-font',
	                'label'       =>  esc_html__( 'Headings Font Family.', 'business-infinity' ),
	                'description' =>  esc_html__( 'h1 to h6. Defaults to Quicksand.', 'business-infinity' ),
	                'default'     => 'quicksand',
	                'type'        => 'select',
	                'choices'     => self::get_fonts(),
	            )
	        );
	    }

	    public function color_options(){	
			return array(
				array(
					'id'      => 'primary-color',
					'label'   => esc_html__( 'Primary Color', 'business-infinity' ),
					'default' => '#1e1e1e
					',
					'type'    => 'color',
				),
				array(
					'id'      => 'body-paragraph-color',
					'label'   => esc_html__( 'Body Text Color', 'business-infinity' ),
					'default' => '#5f5f5f',
					'type'    => 'color',
				),
				array(
					'id'      => 'link-color',
					'label'   => esc_html__( 'Link Color', 'business-infinity' ),
					'default' => '#ffffff',
					'type'    => 'color',
				),
				array(
					'id'      => 'link-hover-color',
					'label'   => esc_html__( 'Link Hover Color', 'business-infinity' ),
					'default' => '#737373',
					'type'    => 'color',
				),
			);
		}

		public function breadcrumb_options(){	
			return array(
				array(
				    'id'	  => 'show-breadcrumb',
				    'label'   => esc_html__( 'Show Breadcrumb', 'business-infinity' ),
				    'default' => true,
				    'type'    => 'toggle',
				)
			);
		}

		public function sidebar_options(){
			return array(
				array(
				'id'      => 'sidebar-position',
				'label'   => esc_html__( 'Sidebar' , 'business-infinity' ),
				'type'    => 'select',
				'default' => 'show',
				'choices' => array(
				    'show' => esc_html__( 'Show' , 'business-infinity' ),
				    'hide' => esc_html__( 'Hide', 'business-infinity' ),
				)
			));
		}

		public function post_options(){
			return array(
	            array(
	                'id'      => 'post-category',
	                'label'   =>  esc_html__( 'Show Categories or Tags', 'business-infinity' ),
	                'default' => true,
	                'type'    => 'toggle',
	            ),
	            array(
	                'id'      => 'post-date',
	                'label'   => esc_html__( 'Show Date', 'business-infinity' ),
	                'default' => true,
	                'type'    => 'toggle',
	            ),
	            array(
	                'id'      => 'post-author',
	                'label'   =>  esc_html__( 'Show Author', 'business-infinity' ),
	                'default' => true,
	                'type'    => 'toggle',
	            )
	     	);
		}

		public function header_options(){	
			return array(
				array(
					'id'      => 'hide-in-archive-page',
					'label'   => esc_html__( 'Hide in Archive pages.', 'business-infinity' ),
					'default' => true,
					'type'    => 'toggle'
				),
				array(
					'id'      	  => 'banner-title',
					'label'   	  => esc_html__( 'Title' , 'business-infinity' ),
					'default' 	  => esc_html__( 'Blog' , 'business-infinity' ),
					'type'	  	  => 'text'
				),
			    array(
			        'id'      => 'banner-title-color',
			        'label'   => esc_html__( 'Text Color' , 'business-infinity' ),
			        'type'    => 'color',
			        'default' => '#ffffff'
			    ),
			    array(
			        'id'      => 'banner-bg-color',
			        'label'   => esc_html__( 'Background Color' , 'business-infinity' ),
			        'type'    => 'color',
			        'default' => '#000000'
			    ),
			    array(
			    	'id' 	   => 'banner-bg-overlay',
			    	'label'    => esc_html__( 'Background Overlay', 'business-infinity' ),
			    	'default'  => 7,
			    	'type' 	   => 'number',
			    	'input_attrs' => array(
		                'min'   => 0,
		                'max'   => 10,
		                'step'  => 1,
		            ),
			    ),
				array(
				    'id'      	=> 'banner-height',
				    'label'   	=> esc_html__( 'Height (px)', 'business-infinity' ),
				    'type'    	=> 'slider',
		            'description' => esc_html__( 'The value is in px. Defaults to 420px.' , 'business-infinity' ),
		            'default' => array(
		        		'desktop' => 220,
		        		'tablet'  => 220,
		        		'mobile'  => 220,
		        	),
		    		'input_attrs' =>  array(
		                'min'   => 1,
		                'max'   => 1000,
		                'step'  => 1,
		            ),
				),
			);
		}

		public 	function footer_options(){
			return array(
				array(
					'id'      => 'footer-social-menu',
					'label'   => esc_html__( 'Show Social Menu', 'business-infinity' ),
					'description' => esc_html__( 'Please add Social menus for enabling Social menus. Go to Menus for setting up', 'business-infinity' ),
					'default' => true,
					'type'    => 'toggle',
				),
				array(
					'id'      => 'footer-copyright-text',
					'label'   => esc_html__( 'Copyright Text', 'business-infinity' ),
					'default' => esc_html__( 'Copyright &copy; All right reserved', 'business-infinity' ),
					'type'    => 'textarea'
				)
			);
		}

		public 	function advanced_options(){
			return array(
				array(
					'id'	  => 'pre-loader',
					'label'   => esc_html__( 'Show Preloader', 'business-infinity' ),
					'default' => true,
					'type'    => 'toggle',
				),
				array(
					'id'	  => 'enable-search',
					'label'   => esc_html__( 'Enable Search', 'business-infinity' ),
					'default' => true,
					'type'    => 'toggle',
				),
				array(
					'id'	  => 'enable-scroll-to-top',
					'label'   => esc_html__( 'Enable Scroll To Top', 'business-infinity' ),
					'default' => true,
					'type'    => 'toggle',
				)
			);
		}

	}
}
