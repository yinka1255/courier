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
 * Assets management class
 */
class Canava_Assets
{
	/**
	 * Class instance handler
	 * 
	 * @var  Canava_Advanced
	 */
	private static $instance;

	/**
	 * Initialize advanced theme settings section
	 * 
	 * @return  void
	 */
	public static function instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
			self::$instance->hooks();
		}

		return self::$instance;
	}

	/**
	 * Method to register actions/filters hooks
	 * 
	 * @return  void
	 */
	private function hooks() {
		add_action( 'init',                 array( $this, 'register' ), 5 );
		add_action( 'wp_enqueue_scripts',   array( $this, 'enqueue' ) );
		add_action( 'wp_enqueue_scripts',   array( $this, 'enqueue_fonts' ) );
		add_action( 'wp_footer',            array( $this, 'print_custom_script' ) );
		add_action( 'customize_save_after', array( $this, 'compile_scheme_styles' ) );

		// Register filters
		add_filter( 'content_width', array( $this, 'content_width' ) );
	}

	/**
	 * Register assets
	 * 
	 * @return  void
	 */
	public function register() {
		$theme = wp_get_theme( get_template_directory() );

		wp_register_style( 'theme-components', get_template_directory_uri() . '/assets/css/components.css', array(), $theme->get( 'Version' ) );
		wp_register_style( 'theme-sidebars', get_template_directory_uri() . '/assets/admin/css/sidebars.css', array(), $theme->get( 'Version' ) );
		wp_register_style( 'theme-widgets', get_template_directory_uri() . '/assets/admin/css/widgets.css', array(), $theme->get( 'Version' ) );
		wp_register_style( 'theme-sample-data', get_template_directory_uri() . '/assets/admin/css/sample-data.css', array(), $theme->get( 'Version' ) );

		if ( is_child_theme() ) {
			wp_register_style( 'theme-base', get_template_directory_uri() . '/assets/css/style.css', array( 'theme-components' ), $theme->get( 'Version' ) );
			wp_register_style( 'theme', get_stylesheet_uri(), array( 'theme-base' ), $theme->get( 'Version' ) );
		}
		else {
			wp_register_style( 'theme', get_template_directory_uri() . '/assets/css/style.css', array( 'theme-components' ), $theme->get( 'Version' ) );
		}

		wp_register_script( 'theme-page-options', get_template_directory_uri() . '/assets/admin/js/page-options.js', array( 'jquery', 'op-options-controls' ), $theme->get( 'Version' ), true );
		wp_register_script( 'theme-project-settings', get_template_directory_uri() . '/assets/admin/js/project-settings.js', array( 'jquery', 'op-options-controls' ), $theme->get( 'Version' ), true );
		wp_register_script( 'theme-sidebars', get_template_directory_uri() . '/assets/admin/js/sidebars.js', array( 'jquery' ), $theme->get( 'Version' ), true );
		wp_register_script( 'theme-customizer-controls', get_template_directory_uri() . '/assets/admin/js/customizer-controls.js', array( 'jquery', 'op-options-controls', 'customize-base' ), $theme->get( 'Version' ), true );
		wp_register_script( 'theme-customizer-preview', get_template_directory_uri() . '/assets/admin/js/customizer-preview.js', array( 'jquery', 'customize-preview' ), $theme->get( 'Version' ), true );
		wp_register_script( 'theme-sample-data', get_template_directory_uri() . '/assets/admin/js/sample-data.js', array( 'jquery' ), $theme->get( 'Version' ), true );
		
		wp_register_script( 'theme-3rd', get_template_directory_uri() . '/assets/js/components.js', array( 'jquery' ), $theme->get( 'Version' ), true );
		wp_register_script( 'theme', get_template_directory_uri() . '/assets/js/theme.js', array( 'jquery', 'theme-3rd' ), $theme->get( 'Version' ), true );
	}

	/**
	 * Enqueue assets
	 * 
	 * @return  void
	 */
	public function enqueue() {
		global $wp_customize;

		/**
		 * Theme stylesheets
		 */
		wp_enqueue_style( 'theme' );

		/**
		 * Theme scripts
		 */
		wp_enqueue_script( 'theme' );
		wp_localize_script( 'theme', '_themeConfig', $this->javascript_theme_config() );

		/**
		 * Customizer variables
		 */
		if ( $wp_customize ) {
			wp_localize_script( 'theme', '_customizeSettings', array(
				'home' => get_home_url(),
				'blog' => ( get_option( 'show_on_front' ) == 'posts' )
					? get_home_url()
					: get_permalink( get_option( 'page_for_posts' ) )
			) );
		}

		/**
		 * Comment script
		 */
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		/**
		 * Generate inline styles for theme
		 */
		$inline_styles = $this->dynamic_styles();
		$inline_styles.= op_option( 'scheme_styles' );
		$inline_styles.= op_option( 'custom_css' );

		wp_add_inline_style( 'theme', $inline_styles );
	}

	/**
	 * Enqueue the google fonts
	 * 
	 * @return  void
	 */
	public function enqueue_fonts() {
		global $_options_plus_fonts;

		$body_font    = op_option( 'body_font' );
		$heading_font = op_option( 'heading_font' );
		$menu_font    = op_option( 'menu_font' );

		if ( isset( $_options_plus_fonts['google'][$body_font['family']] ) ||
			 isset( $_options_plus_fonts['google'][$heading_font['family']] ) ||
			 isset( $_options_plus_fonts['google'][$menu_font['family']] ) ) {

			$fonts   = array();
			$subsets = array( 'latin' );

			if ( isset( $_options_plus_fonts['google'][$body_font['family']] ) ) {
				$fonts[] = sprintf( '%s:%s',
					$body_font['family'],
					str_replace( ', ', ',', $_options_plus_fonts['google'][$body_font['family']]['variants'] )
				);
			}

			if ( isset( $_options_plus_fonts['google'][$heading_font['family']] ) ) {
				$fonts[] = sprintf( '%s:%s',
					$heading_font['family'],
					str_replace( ', ', ',', $_options_plus_fonts['google'][$heading_font['family']]['variants'] )
				);
			}

			if ( isset( $_options_plus_fonts['google'][$menu_font['family']] ) ) {
				$fonts[] = sprintf( '%s:%s',
					$menu_font['family'],
					str_replace( ', ', ',', $_options_plus_fonts['google'][$menu_font['family']]['variants'] )
				);
			}

			// Load subsets
			if ( op_option( 'cyrillic_subsets_enabled' ) )
				$subsets[] = 'cyrillic';
			if ( op_option( 'cyrillic_ext_subsets_enabled' ) )
				$subsets[] = 'cyrillic-ext';
			if ( op_option( 'greek_subsets_enabled' ) )
				$subsets[] = 'greek';
			if ( op_option( 'greek_ext_subsets_enabled' ) )
				$subsets[] = 'greek-ext';
			if ( op_option( 'vietnamese_subsets_enabled' ) )
				$subsets[] = 'vietnamese';
			if ( op_option( 'latin_ext_subsets_enabled' ) )
				$subsets[] = 'latin-ext';
			if ( op_option( 'devanagari_subsets_enabled' ) )
				$subsets[] = 'devanagari';

			$path     = get_stylesheet_directory() . '/webfonts/';
			$uri      = sprintf( 'http://fonts.googleapis.com/css?family=%s&subset=%s', implode( '|', $fonts ), implode( ',', $subsets ) );
			$filename = md5( $uri ) . '.css';

			if ( ! is_dir( $path ) ) {
				wp_mkdir_p( $path );
			}

			if ( ! is_file( $path . '/' . $filename ) ) {
				wp_remote_get( $uri, array(
					'stream' => true,
					'filename' => $path . '/' . $filename
				) );
			}

			wp_enqueue_style( 'theme-fonts', get_stylesheet_directory_uri() . '/webfonts/' . $filename );
		}
	}

	/**
	 * Remove unusable assets
	 * 
	 * @return  void
	 */
	public function remove_unuse_assets() {
		wp_dequeue_style( 'prettyphoto' );
		wp_dequeue_script( 'prettyphoto' );
	}

	/**
	 * Print the custom script
	 * 
	 * @return  void
	 */
	public function print_custom_script() {
		$script = op_option( 'custom_js' );

		if ( ! empty( $script ) )
			printf( '<script type="text/javascript">%s</script>', $script );
	}

	/**
	 * Return the content width number
	 * 
	 * @return  int
	 */
	public function content_width() {
		return (int) op_option( 'content_width', 1110 );
	}

	/**
	 * Generate custom styles based on theme options
	 * 
	 * @return  string
	 */
	function dynamic_styles() {
		global $_options_plus_fonts;

		$styles = array();

		// Typography
		$heading_fontsize = op_option( 'heading_fontsize' );
		$heading_fontstyle = op_option( 'heading_font' );

		if ( isset( $heading_fontstyle['color'] ) )
			unset( $heading_fontstyle['color'] );

		$styles['body'] = op_typography_styles( op_option( 'body_font' ) );
		$styles['h1, h2, h3, h4, h5, h6'] = op_typography_styles( $heading_fontstyle );

		if ( is_array( $heading_fontsize ) ) {
			foreach ( $heading_fontsize as $index => $size ) {
				if ( $size == 0 ) continue;
				$styles['h' . ( $index + 1 )]['font-size'] = $size . 'px';
			}
		}

		// Menu Font
		$styles['#site-header #site-navigator .menu > li a'] = op_typography_styles( op_option( 'menu_font' ) );

		// Logo
		list( $logo_margin_top, $logo_margin_bottom ) = op_option( 'logo_margin', array( 0, 0 ) );
		$styles['#masthead .brand'] = array(
			'margin-top'    => sprintf( '%dpx', (int) $logo_margin_top ),
			'margin-bottom' => sprintf( '%dpx', (int) $logo_margin_bottom )
		);

		list( $logo_width, $logo_height ) = op_option( 'logo_size', array( 0, 0 ) );
		$logo_size = op_option( 'logo_size', array( 0, 0 ) );
		$logo_width = (int) $logo_size[0];
		$logo_height = (int) $logo_size[1];
		
		if ( $logo_width > 0 || $logo_height > 0 ) {
			$styles['#masthead .brand .logo img'] = array();

			if ( $logo_width > 0 ) $styles['#masthead .brand .logo img']['width'] = sprintf( '%dpx', $logo_width );
			if ( $logo_height > 0 ) $styles['#masthead .brand .logo img']['height'] = sprintf( '%dpx', $logo_height );
		}

		// Topbar styles
		$styles['#headerbar'] = array(
			'background-color' => op_option( 'topbar_bgcolor' ),
			'color' => op_option( 'topbar_textcolor' )
		);

		$predefined_patterns = canava_background_patterns();

		// Boxed Style
		$styles['body.layout-boxed'] = op_background_styles( $predefined_patterns, op_option( 'boxed_background' ) );

		// Page Header
		$styles['#site-content #page-header'] = op_background_styles( $predefined_patterns, op_option( 'pagetitle_background' ) );
		$styles['#site-content #page-header .title,
				 #site-content #page-header .subtitle'] = array( 'color' => op_option( 'pagetitle_textcolor' ) );

		// Page Callout
		$styles['#site-content #page-callout'] = array( 'background-color' => op_option( 'page_callout_background' ) );
		$styles['#site-content #page-callout .callout-content'] = array( 'color' => op_option( 'page_callout_textcolor' ) );

		// Page Footer
		$styles['#site-footer'] = op_background_styles( $predefined_patterns, op_option( 'footer_widgets_background' ) );
		$styles['#site-footer']['color'] = op_option( 'footer_widgets_textcolor' );

		// Layout Width
		$selector = '.wrapper,' .
					'.page-fullwidth #page-body .wrapper .content-wrap .content .vc_row_wrap,' .
					'.page-fullwidth #page-body #respond,' .
					'.page-fullwidth #page-body .nocomments';

		$content_width = (int) op_option( 'content_width', 1110 );
		$styles[$selector] = array(
			'width' => "{$content_width}px"
		);

		$selector = 'body.layout-boxed #site-wrapper,' .
					'body.layout-boxed #site-wrapper #masthead-sticky,' .
					'body.layout-boxed.header-v4 #site-wrapper #masthead,' .
					'body.layout-boxed.header-v3 #site-header #masthead,' .
					'body.layout-boxed.header-v1 #site-header #masthead';

		$masthead_width = $content_width + 100;
		$styles[$selector] = array(
			'width' => "{$masthead_width}px"
		);

		$selector = 'body.layout-boxed #site-wrapper,' .
					'body.layout-boxed #site-wrapper #masthead-sticky,' .
					'body.layout-boxed #site-wrapper #masthead.header-v7';

		$wrapper_width = $content_width + 250;
		$styles['.side-menu.layout-boxed #site-wrapper'] = array(
			'width' => "{$wrapper_width}px"
		);

		return str_replace(
				array( "\t", "\r\n", "\n" ),
				array( ' ', ' ', ' ' ),
				op_generate_styles( $styles )
			);
	}

	/**
	 * Generate the custom styles for scheme color
	 * 
	 * @return  string
	 */
	function compile_color_styles() {
		if ( count( func_get_args() ) == 3 ) {
			ob_start();
			include get_template_directory() . '/assets/less/_color.less';
			
			return str_replace(
				array( '@scheme3', '@scheme2', '@scheme' ),
				array_reverse( func_get_args() ),
				ob_get_clean()
			);
		}
	}

	/**
	 * Return the config parameters that will accessible by
	 * javascript
	 * 
	 * @return  array
	 */
	function javascript_theme_config() {
		$params = array(
			'stickyHeader'    => op_option( 'header_sticky' ),
			'responsiveMenu'  => true,
			'blogLayout'      => op_option( 'blog_archive_layout' ),

			// Pagination config
			'pagingStyle'     => op_option( 'blog_archive_pagination_style' ),
			'pagingContainer' => '#main-content > .main-content-wrap > .content-inner',
			'pagingNavigator' => '.navigation.paging-navigation.loadmore'
		);


		if ( is_post_type_archive( 'nproject' ) ||
			 is_page_template( 'templates/template-projects.php' ) ||
			 is_tax( 'nproject-category' ) ||
			 is_tax( 'nproject-tag' ) ) {
			$params['pagingContainer'] = '#main-content > .main-content-wrap > .content-inner > .projects > .projects-wrap > .projects-items';
		}


		// Pagination container for search results page
		if ( is_search() ) {
			$params['pagingContainer'] = '#main-content > .main-content-wrap > .content-inner > .search-results';
		}

		if ( is_page() ) {
			$page_options = get_post_meta( get_the_ID(), '_page_options', true );

			if ( is_array( $page_options ) && isset( $page_options['onepage_nav_script'] ) && $page_options['onepage_nav_script'] == true ) {
				$params['onepageNavigator'] = true;
			}
		}

		return apply_filters( 'theme/javascript_theme_config', $params );
	}

	/**
	 * Handler for customize_save action, we will compile scheme styles
	 * at this point
	 * 
	 * @param   WP_Customize_Manager  $customize  Customize object
	 * @return  void
	 */
	function compile_scheme_styles( $customize ) {
		set_theme_mod( 'scheme_styles',
			$this->compile_color_styles(
				$customize->get_setting( 'scheme_color' )->value(),
				$customize->get_setting( 'scheme2_color' )->value(),
				$customize->get_setting( 'scheme3_color' )->value()
			)
		);
	}
}

/**
 * Initialize assets management
 */
Canava_Assets::instance();
