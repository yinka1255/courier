<?php
/**
 * Logistic Transport Theme Customizer
 *
 * @package Logistic Transport
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function logistic_transport_customize_register( $wp_customize ) {

	//add home page setting pannel
	$wp_customize->add_panel( 'logistic_transport_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme Settings', 'logistic-transport' ),
	) );

	//Layouts
	$wp_customize->add_section( 'logistic_transport_left_right', array(
    	'title'      => __( 'Theme Layout Settings', 'logistic-transport' ),
		'priority'   => 30,
		'panel' => 'logistic_transport_panel_id'
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('logistic_transport_theme_options',array(
	        'default' => __( 'Right Sidebar', 'logistic-transport' ),
	        'sanitize_callback' => 'logistic_transport_sanitize_choices'
	) );

	$wp_customize->add_control('logistic_transport_theme_options',
	    array(
	        'type' => 'radio',
	        'section' => 'logistic_transport_left_right',
	        'choices' => array(
	            'Left Sidebar' => __('Left Sidebar','logistic-transport'),
	            'Right Sidebar' => __('Right Sidebar','logistic-transport'),
	            'One Column' => __('One Column','logistic-transport'),
	            'Three Columns' => __('Three Columns','logistic-transport'),
	            'Four Columns' => __('Four Columns','logistic-transport'),
	            'Grid Layout' => __('Grid Layout','logistic-transport')
	        ),
	    )
    );

    //topbar
	$wp_customize->add_section('logistic_transport_topbar',array(
		'title'	=> __('Social Icons','logistic-transport'),
		'priority'	=> null,
		'panel' => 'logistic_transport_panel_id',
	));

	$wp_customize->add_setting('logistic_transport_facebook_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('logistic_transport_facebook_url',array(
		'label'	=> __('Add Facebook link','logistic-transport'),
		'section'	=> 'logistic_transport_topbar',
		'setting'	=> 'logistic_transport_facebook_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('logistic_transport_twitter_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('logistic_transport_twitter_url',array(
		'label'	=> __('Add Twitter link','logistic-transport'),
		'section'	=> 'logistic_transport_topbar',
		'setting'	=> 'logistic_transport_twitter_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('logistic_transport_google_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('logistic_transport_google_url',array(
		'label'	=> __('Add Instagram link','logistic-transport'),
		'section'	=> 'logistic_transport_topbar',
		'setting'	=> 'logistic_transport_google_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('logistic_transport_linkdin_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('logistic_transport_linkdin_url',array(
		'label'	=> __('Add Linkdin link','logistic-transport'),
		'section'	=> 'logistic_transport_topbar',
		'setting'	=> 'logistic_transport_linkdin_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('logistic_transport_youtube_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('logistic_transport_youtube_url',array(
		'label'	=> __('Add Youtube link','logistic-transport'),
		'section'	=> 'logistic_transport_topbar',
		'setting'	=> 'logistic_transport_youtube_url',
		'type'		=> 'url'
	));

	//Header
	$wp_customize->add_section('logistic_transport_header',array(
		'title'	=> __('Header','logistic-transport'),
		'priority'	=> null,
		'panel' => 'logistic_transport_panel_id',
	));

	$wp_customize->add_setting('logistic_transport_call',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('logistic_transport_call',array(
		'label'	=> __('Call Number','logistic-transport'),
		'section'	=> 'logistic_transport_header',
		'setting'	=> 'logistic_transport_call',
		'type'	=> 'text'
	));

	$wp_customize->add_setting('logistic_transport_mail',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('logistic_transport_mail',array(
		'label'	=> __('Email Address','logistic-transport'),
		'section'	=> 'logistic_transport_header',
		'setting'	=> 'logistic_transport_mail',
		'type'	=> 'text'
	));

	$wp_customize->add_setting('logistic_transport_time',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('logistic_transport_time',array(
		'label'	=> __('Time','logistic-transport'),
		'section'	=> 'logistic_transport_header',
		'setting'	=> 'logistic_transport_time',
		'type'	=> 'text'
	));

	//home page slider
	$wp_customize->add_section( 'logistic_transport_slidersettings' , array(
    	'title'      => __( 'Slider Settings', 'logistic-transport' ),
		'priority'   => null,
		'panel' => 'logistic_transport_panel_id'
	) );

	$wp_customize->add_setting('logistic_transport_slider_hide_show',array(
       'default' => 'true',
       'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('logistic_transport_slider_hide_show',array(
	   'type' => 'checkbox',
	   'label' => __('Show / Hide slider','logistic-transport'),
	   'section' => 'logistic_transport_slidersettings',
	));

	for ( $count = 1; $count <= 4; $count++ ) {

		// Add color scheme setting and control.
		$wp_customize->add_setting( 'logistic_transport_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'logistic_transport_sanitize_dropdown_pages'
		) );

		$wp_customize->add_control( 'logistic_transport_slider_page' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'logistic-transport' ),
			'section'  => 'logistic_transport_slidersettings',
			'type'     => 'dropdown-pages'
		) );

	}

	//Services
	$wp_customize->add_section('logistic_transport_services',array(
		'title'	=> __('Services Section','logistic-transport'),
		'panel' => 'logistic_transport_panel_id',
	));	

	$categories = get_categories();
		$cat_posts = array();
			$i = 0;
			$cat_posts[]='Select';	
		foreach($categories as $category){
			if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_posts[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('logistic_transport_services_category',array(
		'default'	=> 'select',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('logistic_transport_services_category',array(
		'type'    => 'select',
		'choices' => $cat_posts,
		'label' => __('Select Category to display Latest Post','logistic-transport'),
		'description'=> __('Size of image should be 80 x 80 ','logistic-transport'),
		'section' => 'logistic_transport_services',
	));

	//About More
	$wp_customize->add_section('logistic_transport_discover',array(
		'title'	=> __('About Section','logistic-transport'),
		'panel' => 'logistic_transport_panel_id',
	));

	$post_list = get_posts();
	$i = 0;
	$posts[]='Select';	
	foreach($post_list as $post){
		$posts[$post->post_title] = $post->post_title;
	}

	$wp_customize->add_setting('logistic_transport_discover_post',array(
		'sanitize_callback' => 'logistic_transport_sanitize_choices',
	));
	$wp_customize->add_control('logistic_transport_discover_post',array(
		'type'    => 'select',
		'choices' => $posts,
		'label' => __('Select post','logistic-transport'),
		'section' => 'logistic_transport_discover',
	));

	//Footer
	$wp_customize->add_section('logistic_transport_footer_section',array(
		'title'	=> __('Copyright','logistic-transport'),
		'priority'	=> null,
		'panel' => 'logistic_transport_panel_id',
	));
	
	$wp_customize->add_setting('logistic_transport_footer_copy',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field',
	));	
	$wp_customize->add_control('logistic_transport_footer_copy',array(
		'label'	=> __('Copyright Text','logistic-transport'),
		'section'	=> 'logistic_transport_footer_section',
		'type'		=> 'text'
	));
	/** home page setions end here**/	
}
add_action( 'customize_register', 'logistic_transport_customize_register' );


/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Logistic_Transport_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );
		
		// Register custom section types.
		$manager->register_section_type( 'Logistic_Transport_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Logistic_Transport_Customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'priority'   => 9,
					'title'    => esc_html__( 'Transport Pro Theme', 'logistic-transport' ),
					'pro_text' => esc_html__( 'Go Pro','logistic-transport' ),
					'pro_url'  => esc_url( 'https://www.themescaliber.com/themes/transport-wordpress-theme/' ),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'logistic-transport-customize-controls', trailingslashit( get_template_directory_uri() ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'logistic-transport-customize-controls', trailingslashit( get_template_directory_uri() ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Logistic_Transport_Customize::get_instance();