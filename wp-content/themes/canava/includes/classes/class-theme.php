<?php
/**
 * WARNING: This file is part of the theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

/**
 * @package  Canava
 * @author   Binh Pham Thanh <binhpham@linethemes.com>
 */
class Canava extends Canava_Base
{
	const VERSION = '1.0.0';
	const SLUG    = 'canava';

	/**
	 * Class construction
	 */
	protected function __construct() {
		/**
		 * Initialize the theme wrapper
		 */
		add_action( 'template_include', 'Canava_Wrapper::wrap' );

		/**
		 * Register action to setup this theme
		 */
		add_action( 'after_setup_theme', array( $this, 'setup' ) );

		/**
		 * Register filter that allow using shortcode
		 * in the widget text
		 */
		add_filter( 'widget_text', 'do_shortcode' );

		/**
		 * There was default supported features that required
		 * on all theme
		 */
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-formats', array( 'gallery', 'link', 'quote', 'status', 'video', 'audio' ) );
		add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', 'gallery', 'caption' ) );
		add_theme_support( 'post-thumbnails' );
	}

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @return  void
	 */
	public function setup() {
		/**
		 * Import the theme translation files
		 */
		$this->import_translation_files();

		/**
		 * Adding the theme supports
		 */
		$this->setup_theme_supports();

		/**
		 * Adding the supported image sizes
		 */
		$this->setup_image_sizes();

		/**
		 * Register the theme widget areas
		 */
		$this->setup_sidebars();

		/**
		 * Adding the menu locations
		 */
		$this->setup_menus();

		/**
		 * Load the theme supported features
		 */
		$this->setup_features();
	}

	/**
	 * This method will import the language files
	 * for this theme that make it available for translation
	 * 
	 * @return  void
	 */
	protected function import_translation_files() {
		load_theme_textdomain( 'canava', get_template_directory() . '/languages' );
	}

	/**
	 * Register all supported features in this theme
	 * 
	 * @return  void
	 */
	protected function setup_theme_supports() {
		// Enable woocommerce support
		add_theme_support( 'woocommerce' );
	}

	/**
	 * Register the theme menu locations
	 * 
	 * @return  void
	 */
	protected function setup_menus() {
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'canava' ),
			'top'     => esc_html__( 'Top Menu', 'canava' )
		) );
	}

	/**
	 * Register all supported image sizes that
	 * will be used in this theme
	 * 
	 * @return  void
	 */
	protected function setup_image_sizes() {
		add_image_size( 'small', 50, 50, true );
		add_image_size( 'blog-medium', 555, 0, false );
		add_image_size( 'blog-medium-crop', 555, 312, true );

		add_image_size( 'blog-large', 1110, 0, false );
		add_image_size( 'blog-large-crop', 1110, 624, true );

		// Portfolio Images
		add_image_size( 'portfolio-medium', 600, 0, false );
		add_image_size( 'portfolio-medium-crop', 600, 413, true );

		add_image_size( 'portfolio-large', 1200, 0, false );
		add_image_size( 'portfolio-large-crop', 1200, 830, true );
	}

	/**
	 * Register all available sidebars
	 * 
	 * @return  void
	 */
	protected function setup_sidebars() {
		register_sidebar( array(
			'name'          => esc_html__( 'Primary Sidebar', 'canava' ),
			'id'            => 'sidebar-primary',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		// Header Widgets
		register_sidebar( array(
			'name'          => esc_html__( 'Header Sidebar', 'canava' ),
			'id'            => 'header-widgets',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		// Footer Sidebars
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar #1', 'canava' ),
			'id'            => 'footer-1',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar #2', 'canava' ),
			'id'            => 'footer-2',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar #3', 'canava' ),
			'id'            => 'footer-3',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar #4', 'canava' ),
			'id'            => 'footer-4',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		// Content Bottom Sidebars
		register_sidebar( array(
			'name'          => esc_html__( 'Content Bottom #1', 'canava' ),
			'id'            => 'content-bottom-1',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Content Bottom #2', 'canava' ),
			'id'            => 'content-bottom-2',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Content Bottom #3', 'canava' ),
			'id'            => 'content-bottom-3',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Content Bottom #4', 'canava' ),
			'id'            => 'content-bottom-4',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

	/**
	 * Initialize the theme features
	 * 
	 * @return  void
	 */
	protected function setup_features() {
		/**
		 * Initialize theme customize
		 */
		Canava_ThemeCustomize::instance();

		/**
		 * Initialize custom sidebars manager
		 */
		Canava_Sidebars::instance();
		
		/**
		 * Initialize theme breadcrumb
		 */
		Canava_Breadcrumb::instance();	

		/**
		 * Initialize search feature
		 */
		Canava_Search::instance();

		/**
		 * Initialize support for WooCommerce
		 */
		Canava_Woocommerce::instance();

		/**
		 * Initialize support for Projects
		 */
		Canava_Projects::instance();
	}
}
