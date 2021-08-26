<?php
/**
* Enqueue parent stylesheet
* @since Business Infinity 1.0
*/
function business_infinity_scripts(){
	$theme_version = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'fansee-business-parent', get_template_directory_uri() . '/style.css', array(), $theme_version );
	wp_enqueue_script( 'fansee-business-sticky-header', get_stylesheet_directory_uri() . '/assets/js/jquery.sticky.js', array('jquery') );
	wp_enqueue_script( 'fansee-business-main-js', get_stylesheet_directory_uri() . '/assets/js/main-script.js', array('jquery') );
}
add_action( 'wp_enqueue_scripts', 'business_infinity_scripts' );

/**
* Add options for top header
* @since Business Infinity 1.0
*/
function business_infinity_customizer_register(){
	$panel = array(
		'id' => Fansee_Business_Customizer::get_id( 'business-infinity' ),
		'args' => array(
			'title'    => esc_html__( 'Business Infinity', 'business-infinity' ),
			'priority' => 10,
		)
	);

	$customizer = new Fansee_Business_Customizer();
	$customizer->fields = array(
		array(
		    'id'     => 'general',
		    'title'  => esc_html__( 'General', 'business-infinity' ),
		    'fields' => array(
		    	array(
		    		'id'      	  => 'enable-dark-mode',
		    		'label'   	  => esc_html__( 'Enable Dark Mode' , 'business-infinity' ),
		    		'default' 	  => true,
		    		'type'	  	  => 'toggle'
		    	),
		    )
		),
		array(
			'id' => 'header',
			'title' => esc_html__( 'Header', 'business-infinity' ),
			'fields' => array(
				array(
					'id'      => 'enable-sticky-header',
					'label'   => esc_html__( 'Enable Sticky Header', 'business-infinity' ),
					'default' => true,
					'type'    => 'toggle'
				),
				array(
					'id'      => 'logo-size',
					'label'   => esc_html__( 'Logo Size', 'business-infinity' ),
					'default' => 350,
					'type'    => 'number'
				)
			)
		)
	);

	$customizer->add( $panel );
}
add_action( 'init', 'business_infinity_customizer_register' );

function business_infinity_body_class( $classes ){

	$dark_mode = fansee_business_get( 'enable-dark-mode' );
	$sticky_header = fansee_business_get( 'enable-sticky-header' );
	
	if( $dark_mode ){
		$classes[] = 'business-infinity-dark-mode';
	}

	if( $sticky_header ){
		$classes[] = 'business-infinity-sticky-header';
	}

	$pos = business_infinity_get_sidebar_position();
	if( $pos ){
		if( $pos == 'show' ){
			$pos = 'right';
		}
		$classes[] = $pos . '-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'business_infinity_body_class' );

function business_infinity_slider_args( $args ){
	$mode = fansee_business_get( 'slider-mode' );
	if( 'category' == $mode ){

		$cat_id = fansee_business_get( 'slider-category' ) || 1;
		$args = array(
			'cat' => array( $cat_id ),
			'post_type' => 'post'
		);
	}

	return $args;
}
add_filter( 'fansee_business_slider_args', 'business_infinity_slider_args' );

/**
 * Modify default customizer placement
 * @since Fansee Business 1.0
 */
function business_infinity_customize_register( $wp_customize ){
	$color_section = 'fansee-business-color-section';
	$wp_customize->get_setting( 'background_color' )->default = '000000';
	$wp_customize->get_setting( 'header_textcolor' )->default = 'ffffff';
}
add_action( 'customize_register', 'business_infinity_customize_register' );


/**
 * get sidebar position
 * @since Business Infinity 1.0
 */
function business_infinity_get_sidebar_position(){
	if( is_search() ){
		return false;
	}elseif( is_singular( 'post' ) || is_page() || is_home() ){

		if( is_home() && is_front_page() ){
			$pos = fansee_business_get( 'sidebar-position' );
			return $pos;
		}

		if( is_front_page() ){
			return false;
		}
		
		$id = fansee_business_get_page_id();
		$meta_id = 'fansee-business-sidebar-position';
		$pos = get_post_meta( $id, $meta_id, true );
		if( $pos == '' ){
			$pos = 'show';
		}
		return $pos;
	}else{
		$pos = fansee_business_get( 'sidebar-position' );
		return $pos;
	}
}

/**
 * Determines if the page needs sidebar
 * overriding parent function
 * @since Fansee Business 1.0
 */
function fansee_business_has_sidebar(){
	$pos = business_infinity_get_sidebar_position();
	if( !$pos ){
		return false;
	}
	return $pos != 'hide';
}

function business_infinity_dynamic_styles(){
	$logo_width = fansee_business_get( 'logo-size' );
	?>
	<style type="text/css">
		.site-header .custom-logo{
			max-width: <?php echo esc_attr( $logo_width ); ?>px;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'business_infinity_dynamic_styles' );