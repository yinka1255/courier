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
 * This class will implement support for the plugin Projects
 *
 * @package  Canava
 * @author   Binh Pham Thanh <binhpham@linethemes.com>
 */
class Canava_Projects extends Canava_Feature
{
	/**
	 * Modify the project post type settings
	 * 
	 * @return  void
	 */
	public function post_type_args( $args ) {
		$projects_archive = get_theme_mod( 'projects_archive_page_id', null );
		$projects_archive = is_numeric( $projects_archive ) && get_post( $projects_archive )
			? get_page_uri( $projects_archive ) : true;

		$args['has_archive'] = $projects_archive;
		$args['rewrite'] = array(
			'slug' => get_theme_mod( 'projects_permalink_base', nProjects::TYPE_NAME ),
			'with_front' => false
		);

		return $args;
	}

	/**
	 * Modify the projects category settings
	 * 
	 * @param   array  $args  Category taxonomy arguments
	 * @return  array
	 */
	public function taxonomy_category_args( $args ) {
		$theme_options = get_theme_mods();
		$args['rewrite'] = array(
			'slug' => get_theme_mod( 'projects_category_permalink_base', 'nproject-category' )
		);

		return $args;
	}

	/**
	 * Modify the projects tag settings
	 * 
	 * @param   array  $args  Tag taxonomy arguments
	 * @return  array
	 */
	public function taxonomy_tag_args( $args ) {
		$args['rewrite'] = array(
			'slug' => get_theme_mod( 'projects_tag_permalink_base', 'nproject-tag' )
		);

		return $args;
	}

	/**
	 * Register panel for Projects
	 * 
	 * @param   array  $sections  List of sections
	 * @return  array
	 */
	public function customize_panels( $sections ) {
		$sections[ 'projects' ] = array(
			'title'       => esc_html__( 'Projects', 'canava' ),
			'description' => '',
			'priority'    => 9
		);

		return $sections;
	}

	/**
	 * Register section for Projects
	 * 
	 * @param   array  $sections  List of sections
	 * @return  array
	 */
	public function customize_sections( $sections ) {
		$sections[ 'projects-general' ] = array(
			'title'       => esc_html__( 'General', 'canava' ),
			'description' => '',
			'panel'       => 'projects'
		);

		$sections[ 'projects-archive' ] = array(
			'title'       => esc_html__( 'Project Archive', 'canava' ),
			'description' => '',
			'panel'       => 'projects'
		);

		$sections[ 'projects-single' ] = array(
			'title'       => esc_html__( 'Project Single', 'canava' ),
			'description' => '',
			'panel'       => 'projects'
		);

		$sections[ 'projects-related' ] = array(
			'title'       => esc_html__( 'Related Projects', 'canava' ),
			'description' => '',
			'panel'       => 'projects'
		);

		return $sections;
	}

	/**
	 * Register controls for Projects
	 * 
	 * @param   array  $controls  List of controls
	 * @return  array
	 */
	public function customize_controls( $controls ) {
		/**
		 * General section
		 */
		$controls['projects_permalink_base'] = array(
			'type'    => 'text',
			'label'   => esc_html__( 'Permalink Base', 'canava' ),
			'section' => 'projects-general',
			'default' => 'nproject'
		);

		$controls['projects_category_permalink_base'] = array(
			'type'    => 'text',
			'label'   => esc_html__( 'Category Permalink Base', 'canava' ),
			'section' => 'projects-general',
			'default' => 'nproject-category'
		);

		$controls['projects_tag_permalink_base'] = array(
			'type'    => 'text',
			'label'   => esc_html__( 'Tag Permalink Base', 'canava' ),
			'section' => 'projects-general',
			'default' => 'nproject-tag'
		);

		/**
		 * Archive section
		 */
		$controls['projects_archive_sidebar_layout'] = array(
			'type'    => 'radio-images',
			'label'   => esc_html__( 'List Sidebar Position', 'canava' ),
			'section' => 'projects-archive',
			'choices' => array(
				'no-sidebar' => array(
					'src' => op_directory_uri() . '/assets/img/no-sidebar.png',
					'tooltip' => esc_html__( 'No Sidebar', 'canava' )
				),
				'sidebar-left' => array(
					'src' => op_directory_uri() . '/assets/img/sidebar-left.png',
					'tooltip' => esc_html__( 'Sidebar Left', 'canava' )
				),
				'sidebar-right' => array(
					'src' => op_directory_uri() . '/assets/img/sidebar-right.png',
					'tooltip' => esc_html__( 'Sidebar Right', 'canava' )
				)
			),
			'default' => 'sidebar-right'
		);

		$controls['projects_archive_sidebar'] = array(
			'type'    => 'dropdown-sidebars',
			'section' => 'projects-archive',
			'label'   => esc_html__( 'Project List Sidebar', 'canava' ),
			'default' => 'sidebar-primary'
		);

		$controls['projects_archive_layout'] = array(
			'type'    => 'radio-images',
			'label'   => esc_html__( 'List Layout', 'canava' ),
			'section' => 'projects-archive',
			'choices' => array(
				'grid' => array(
					'src'     => op_directory_uri() . '/assets/img/blog-grid.png',
					'tooltip' => esc_html__( 'Grid', 'canava' )
				),
				'masonry' => array(
					'src'     => op_directory_uri() . '/assets/img/blog-masonry.png',
					'tooltip' => esc_html__( 'Masonry Grid', 'canava' )
				),
				'grid-alt' => array(
					'src'     => op_directory_uri() . '/assets/img/portfolio-no-margin.png',
					'tooltip' => esc_html__( 'Grid Alt', 'canava' )
				),
				'justified' => array(
					'src'     => op_directory_uri() . '/assets/img/portfolio-justify.png',
					'tooltip' => esc_html__( 'Justified Grid', 'canava' )
				)
			),
			'default' => 'grid'
		);

		$controls['projects_grid_columns'] = array(
			'type'    => 'dropdown',
			'section' => 'projects-archive',
			'label'   => esc_html__( 'Grid Columns', 'canava' ),
			'default' => 3,
			'choices' => array(
				2 => esc_html__( '2 Columns', 'canava' ),
				3 => esc_html__( '3 Columns', 'canava' ),
				4 => esc_html__( '4 Columns', 'canava' ),
				5 => esc_html__( '5 Columns', 'canava' ),
			)
		);

		$controls['projects_archive_filter'] = array(
			'type'    => 'switcher',
			'section' => 'projects-archive',
			'label'   => esc_html__( 'Show Items Filter', 'canava' ),
			'default' => true
		);

		$controls['projects_archive_pagination_style'] = array(
			'type'    => 'radio-images',
			'label'   => esc_html__( 'Pagination Style', 'canava' ),
			'section' => 'projects-archive',
			'default' => 'numeric',
			'choices' => array(
				'pager' => array(
					'src'     => op_directory_uri() . '/assets/img/paging-pager.png',
					'tooltip' => esc_html__( 'Pager', 'canava' )
				),
				'numeric' => array(
					'src'     => op_directory_uri() . '/assets/img/paging-numeric.png',
					'tooltip' => esc_html__( 'Numeric', 'canava' )
				),
				'pager-numeric' => array(
					'src'     => op_directory_uri() . '/assets/img/paging-pager-numeric.png',
					'tooltip' => esc_html__( 'Pager & Numeric', 'canava' )
				),
				'loadmore' => array(
					'src'     => op_directory_uri() . '/assets/img/paging-loadmore.png',
					'tooltip' => esc_html__( 'Load More', 'canava' )
				)
			)
		);

		$controls['projects_posts_per_page'] = array(
			'type'     => 'spinner',
			'section'  => 'projects-archive',
			'label'    => esc_html__( 'Posts Per Page', 'canava' ),
			'default'  => get_option( 'posts_per_page' )
		);

		/**
		 * Project Single
		 */
		$controls['projects_single_sidebar_layout'] = array(
			'type'    => 'radio-images',
			'label'   => esc_html__( 'Single Sidebar Position', 'canava' ),
			'section' => 'projects-single',
			'choices' => array(
				'no-sidebar' => array(
					'src'     => op_directory_uri() . '/assets/img/no-sidebar.png',
					'tooltip' => esc_html__( 'No Sidebar', 'canava' )
				),
				'sidebar-left' => array(
					'src'     => op_directory_uri() . '/assets/img/sidebar-left.png',
					'tooltip' => esc_html__( 'Sidebar Left', 'canava' )
				),
				'sidebar-right' => array(
					'src'     => op_directory_uri() . '/assets/img/sidebar-right.png',
					'tooltip' => esc_html__( 'Sidebar Right', 'canava' )
				)
			),
			'default' => 'sidebar-right'
		);

		$controls['projects_single_sidebar'] = array(
			'type'    => 'dropdown-sidebars',
			'section' => 'projects-single',
			'label'   => esc_html__( 'Single Project Sidebar', 'canava' ),
			'default' => 'sidebar-primary'
		);

		$controls['projects_single_gallery_type'] = array(
			'type'    => 'radio-images',
			'section' => 'projects-single',
			'label'   => esc_html__( 'Gallery Type', 'canava' ),
			'default' => 'list',
			'choices' => array(
				'list'   => array(
					'src'     => op_directory_uri() . '/assets/img/list.png',
					'tooltip' => esc_html__( 'List', 'canava' )
				),
				'slider' => array(
					'src'     => op_directory_uri() . '/assets/img/slider.png',
					'tooltip' => esc_html__( 'Slider', 'canava' )
				),
				'grid'   => array(
					'src'     => op_directory_uri() . '/assets/img/portfolio-no-margin.png',
					'tooltip' => esc_html__( 'Grid', 'canava' )
				)
			)
		);

		$controls['projects_single_gallery_columns'] = array(
			'type'    => 'dropdown',
			'section' => 'projects-single',
			'label'   => esc_html__( 'Gallery Columns', 'canava' ),
			'default' => 3,
			'choices' => array(
				2 => esc_html__( '2 Columns', 'canava' ),
				3 => esc_html__( '3 Columns', 'canava' ),
				4 => esc_html__( '4 Columns', 'canava' ),
				5 => esc_html__( '5 Columns', 'canava' ),
			)
		);

		$controls['projects_single_content_position'] = array(
			'type'    => 'radio-images',
			'section' => 'projects-single',
			'label'   => esc_html__( 'Content Position', 'canava' ),
			'default' => 'left',
			'choices' => array(
				'left' => array(
					'src'     => op_directory_uri() . '/assets/img/left-content.png',
					'tooltip' => esc_html__( 'Content Left', 'canava' )
				),
				'right' => array(
					'src'     => op_directory_uri() . '/assets/img/right-content.png',
					'tooltip' => esc_html__( 'Content Right', 'canava' )
				),
				'fullwidth' => array(
					'src'     => op_directory_uri() . '/assets/img/full-content.png',
					'tooltip' => esc_html__( 'Content Full Width', 'canava' )
				)
			)
		);

		$controls['projects_single_content_sticky'] = array(
			'type'    => 'switcher',
			'section' => 'projects-single',
			'label'   => esc_html__( 'Enable Sticky Content', 'canava' ),
			'default' => true
		);

		$controls['projects_single_navigator_enabled'] = array(
			'type'    => 'switcher',
			'label'   => esc_html__( 'Show Single Navigator', 'canava' ),
			'section' => 'projects-single',
			'default' => true
		);

		/**
		 * Project Related
		 */
		$controls['projects_related_box_enabled'] = array(
			'type'    => 'switcher',
			'label'   => esc_html__( 'Show Related Projects', 'canava' ),
			'section' => 'projects-related',
			'default' => true
		);

		$controls['projects_related_title'] = array(
			'type'    => 'text',
			'label'   => esc_html__( 'Widget Title', 'canava' ),
			'section' => 'projects-related',
			'default' => esc_html__( 'Related Projects', 'canava' )
		);

		$controls['projects_related_type'] = array(
			'type' => 'dropdown',
			'section' => 'projects-related',
			'label' => esc_html__( 'Show Related Items Based On', 'canava' ),
			'default' => 'tag',
			'choices' => array(
				'tag'      => esc_html__( 'Tag', 'canava' ),
				'category' => esc_html__( 'Category', 'canava' ),
				'random'   => esc_html__( 'Random', 'canava' ),
				'recent'   => esc_html__( 'Recent', 'canava' )
			)
		);

		$controls['projects_related_style'] = array(
			'type'    => 'dropdown',
			'section' => 'projects-related',
			'label'   => esc_html__( 'Related Project Style', 'canava' ),
			'default' => 'grid',
			'choices' => array(
				'grid'      => esc_html__( 'Grid', 'canava' ),
				'masonry'   => esc_html__( 'Grid Masonry', 'canava' ),
				'grid-alt' => esc_html__( 'Grid Alt', 'canava' )
			)
		);

		$controls['projects_related_columns_count'] = array(
			'type'    => 'dropdown',
			'section' => 'projects-related',
			'label'   => esc_html__( 'Columns Count', 'canava' ),
			'choices' => array(
				1 => esc_html__( '1 Column', 'canava' ),
				2 => esc_html__( '2 Columns', 'canava' ),
				3 => esc_html__( '3 Columns', 'canava' ),
				4 => esc_html__( '4 Columns', 'canava' ),
				5 => esc_html__( '5 Columns', 'canava' )
			),
			'default' => 4
		);
		
		$controls['projects_related_posts_count'] = array(
			'type'    => 'spinner',
			'section' => 'projects-related',
			'label'   => esc_html__( 'Number Of Related Projects', 'canava' ),
			'min'     => 1,
			'default' => 4
		);

		return $controls;
	}

	/**
	 * Override theme options for Projects
	 * 
	 * @param   array  $options  Theme options
	 * @return  array
	 */
	public function override_options( $options ) {
		if ( ! $this->enabled() || is_admin() ) return $options;

		if ( is_post_type_archive( nProjects::TYPE_NAME ) ||
			 is_tax( nProjects::TYPE_CATEGORY ) ||
			 is_tax( nProjects::TYPE_TAG ) ||
			 is_page_template( 'templates/template-projects.php' ) ) {
			$options['sidebar_layout']  = isset( $options['projects_archive_sidebar_layout'] )
				? $options['projects_archive_sidebar_layout']
				: $options['sidebar_layout'];

			$options['sidebar_default']  = isset( $options['projects_archive_sidebar'] )
				? $options['projects_archive_sidebar']
				: $options['sidebar_default'];

			$options['blog_archive_pagination_style'] = isset( $options['projects_archive_pagination_style'] )
				? $options['projects_archive_pagination_style']
				: $options['blog_archive_pagination_style'];
		}
		elseif ( is_singular( nProjects::TYPE_NAME ) ) {
			$project_settings = get_post_meta( get_the_ID(), '_project_settings', true );
			$project_settings = is_array( $project_settings ) ? $project_settings : array();

			if ( isset( $project_settings['project_settings_enabled'] ) && $project_settings['project_settings_enabled'] == true ) {
				foreach ( $project_settings as $name => $value )
					if ( isset( $options[$name] ) )
						$options[$name] = $value;
			}

			$options['sidebar_layout']  = isset( $options['projects_single_sidebar_layout'] )
				? $options['projects_single_sidebar_layout']
				: $options['sidebar_layout'];

			$options['sidebar_default']  = isset( $options['projects_single_sidebar'] )
				? $options['projects_single_sidebar']
				: $options['sidebar_default'];
		}

		return $options;
	}

	/**
	 * Return the classes for archive wrapper tag
	 * 
	 * @param   array  $classes  The archive classes
	 * @return  array
	 */
	public function archive_class( $classes ) {
		$classes[] = sprintf( 'projects-%s', op_option( 'projects_archive_layout', 'grid' ) );
		$classes[] = op_option( 'projects_archive_filter', true ) ? 'projects-has-filter' : 'projects-no-filter';

		return $classes;
	}

	/**
	 * Return the name that identify thumbnail size
	 * for project listing page
	 * 
	 * @param   string  $size  The thumbnail size name
	 * @return  string
	 */
	public function archive_thumbnail_size( $size ) {
		if ( op_option( 'projects_archive_layout', 'grid' ) == 'masonry' )
			$size = 'portfolio-medium';
		else
			$size = 'portfolio-medium-crop';

		return $size;
	}

	/**
	 * Return the number to limit items can be shown
	 * on the archive page
	 * 
	 * @param   int  $value  The number of items
	 * @return  int
	 */
	public function posts_per_page( $value ) {
		if ( is_post_type_archive( nProjects::TYPE_NAME ) ||
			 is_tax( nProjects::TYPE_CATEGORY ) ||
			 is_tax( nProjects::TYPE_TAG ) ) {

			$value = op_option( 'projects_posts_per_page', 10 );
		}

		return $value;
	}

	/**
	 * Register metabox
	 *
	 * @return  void
	 */
	public function add_metabox() {
		add_meta_box( 'projects-options', esc_html__( 'Project Settings', 'canava' ),
			array( $this, 'display_metabox' ),
			nProjects::TYPE_NAME, 
			'normal',
			'high'
		);
	}

	/**
	 * Display the metabox that associated with an post
	 * object
	 * 
	 * @param   object  $post  The given post object
	 * @return  void
	 */
	public function display_metabox( $post ) {
		if ( nProjects_Helper::current_post_type() == nProjects::TYPE_NAME ):

			$project_settings = get_post_meta( $post->ID, '_project_settings', true );
			$project_settings = is_array( $project_settings ) ? $project_settings : array();
			
			$project_settings_container= new \OptionsPlus\Options\Container( array(
				'show_tabs' => false,
				'sections'  => array( 'all' => array( 'title', 'all' ) ),
				'controls'  => array(
					'project_settings_enabled' => array(
						'type'    => 'switcher',
						'label'   => esc_html__( 'Enable Custom Settings', 'canava' ),
						'section' => 'all',
						'default' => false
					),

					'projects_single_gallery_type' => array(
						'type'    => 'radio-images',
						'section' => 'all',
						'label'   => esc_html__( 'Gallery Type', 'canava' ),
						'default' => op_option( 'projects_single_gallery_type', 'list' ),
						'choices' => array(
							'list'   => array(
								'src'     => op_directory_uri() . '/assets/img/list.png',
								'tooltip' => esc_html__( 'List', 'canava' )
							),
							'slider' => array(
								'src'     => op_directory_uri() . '/assets/img/slider.png',
								'tooltip' => esc_html__( 'Slider', 'canava' )
							),
							'grid'   => array(
								'src'     => op_directory_uri() . '/assets/img/portfolio-no-margin.png',
								'tooltip' => esc_html__( 'Grid', 'canava' )
							)
						)
					),

					'projects_single_gallery_columns' => array(
						'type'    => 'dropdown',
						'section' => 'all',
						'label'   => esc_html__( 'Gallery Columns', 'canava' ),
						'default' => op_option( 'projects_single_gallery_columns', 3 ),
						'choices' => array(
							2 => esc_html__( '2 Columns', 'canava' ),
							3 => esc_html__( '3 Columns', 'canava' ),
							4 => esc_html__( '4 Columns', 'canava' ),
							5 => esc_html__( '5 Columns', 'canava' ),
						)
					),

					'projects_single_content_position' => array(
						'type'    => 'radio-images',
						'section' => 'all',
						'label'   => esc_html__( 'Content Position', 'canava' ),
						'default' => op_option( 'projects_single_content_position', 'fullwidth' ),
						'choices' => array(
							'left' => array(
								'src'     => op_directory_uri() . '/assets/img/left-content.png',
								'tooltip' => esc_html__( 'Content Left', 'canava' )
							),
							'right' => array(
								'src'     => op_directory_uri() . '/assets/img/right-content.png',
								'tooltip' => esc_html__( 'Content Right', 'canava' )
							),
							'fullwidth' => array(
								'src'     => op_directory_uri() . '/assets/img/full-content.png',
								'tooltip' => esc_html__( 'Content Full Width', 'canava' )
							)
						)
					),

					'projects_single_content_sticky' => array(
						'type'    => 'switcher',
						'section' => 'all',
						'label'   => esc_html__( 'Enable Sticky Content', 'canava' ),
						'default' => true
					)
				)
			) );

			$project_settings_container->bind( $project_settings );
			$project_settings_container->render();
		endif;
	}

	/**
	 * Save the settings for individual project
	 *
	 * @param   int  $post_id  The post ID
	 * @return  void
	 */
	public function save_project_settings( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE || nProjects_Helper::current_post_type() != nProjects::TYPE_NAME )
			return;

		if ( isset( $_REQUEST ) && isset( $_REQUEST['op-options'] ) ) {
			$data = stripslashes_deep( $_REQUEST['op-options'] );
			$data['project_settings_enabled']       = isset( $data['project_settings_enabled'] );
			$data['projects_single_content_sticky'] = isset( $data['projects_single_content_sticky'] );

			update_post_meta( $post_id, '_project_settings', $data );
		}
	}

	/**
	 * Enqueue assets for the administrator panel
	 * 
	 * @return  void
	 */
	public function admin_enqueue_scripts( $hook ) {
		if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
			wp_enqueue_script( 'theme-project-settings' );
		}
	}

	/**
	 * Return the template location of the shortcode
	 * 
	 * @return  string
	 */
	public function shortcode_template() {
		return 'templates/shortcodes/projects.php';
	}

	/**
	 * Return an array that definition parameters
	 * for shortcode on Visual Composer
	 * 
	 * @param   array  $params  Shortcode parameters
	 * @return  array
	 */
	public function shortcode_parameters( $params ) {
		// General tab
		$params[] = array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Widget Title', 'canava' ),
			'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'canava' ),
			'param_name'  => 'widget_title'
		);

		$params[] = array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Categories', 'canava' ),
			'description' => esc_html__( 'If you want to narrow output, enter category names here. Note: Only listed categories will be included.', 'canava' ),
			'param_name'  => 'categories'
		);

		$params[] = array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Tags', 'canava' ),
			'description' => esc_html__( 'If you want to narrow output, enter tag names here. Note: Only listed tags will be included.', 'canava' ),
			'param_name'  => 'tags'
		);

		$params[] = array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Display Mode', 'canava' ),
			'param_name' => 'mode',
			'std'        => 3,
			'value'      => array(
				__( 'Grid Classic', 'canava' )   => 'grid',
				__( 'Grid Masonry', 'canava' )   => 'masonry',
				__( 'Grid Alt', 'canava' ) => 'grid-alt',
				__( 'Carousel', 'canava' )       => 'carousel'
			)
		);

		$params[] = array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Columns', 'canava' ),
			'description' => esc_html__( 'The number of columns will be shown', 'canava' ),
			'param_name'  => 'columns',
			'std'         => 3,
			'value'       => array(
				__( '1 Column', 'canava' )  => 1,
				__( '2 Columns', 'canava' ) => 2,
				__( '3 Columns', 'canava' ) => 3,
				__( '4 Columns', 'canava' ) => 4,
				__( '5 Columns', 'canava' ) => 5,
			)
		);

		$params[] = array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Show Items Filter', 'canava' ),
			'param_name' => 'filter',
			'std'        => 'yes',
			'value'      => array(
				__( 'Yes', 'canava' ) => 'yes',
				__( 'No', 'canava' )  => 'no'
			)
		);

		$params[] = array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Filter By', 'canava' ),
			'param_name' => 'filter_by',
			'std'        => 'category',
			'value'      => array(
				__( 'Categories', 'canava' ) => 'category',
				__( 'Tags', 'canava' )       => 'tag'
			)
		);

		$params[] = array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Limit', 'canava' ),
			'description' => esc_html__( 'The number of posts will be shown', 'canava' ),
			'param_name'  => 'limit',
			'value'       => 9
		);

		$params[] = array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Offset', 'canava' ),
			'description' => esc_html__( 'The number of posts to pass over', 'canava' ),
			'param_name'  => 'offset',
			'value'       => 0
		);

		$params[] = array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Thumbnail Size', 'canava' ),
			'description' => esc_html__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'canava' ),
			'param_name'  => 'thumbnail_size'
		);

		$params[] = array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Order By', 'canava' ),
			'description' => esc_html__( 'Select how to sort retrieved posts.', 'canava' ),
			'param_name'  => 'order',
			'std'         => 'date',
			'value'       => array(
				__( 'Date', 'canava' )          => 'date',
				__( 'ID', 'canava' )            => 'ID',
				__( 'Author', 'canava' )        => 'author',
				__( 'Title', 'canava' )         => 'title',
				__( 'Modified', 'canava' )      => 'modified',
				__( 'Random', 'canava' )        => 'rand',
				__( 'Comment count', 'canava' ) => 'comment_count',
				__( 'Menu order', 'canava' )    => 'menu_order'
			)
		);

		$params[] = array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Order Direction', 'canava' ),
			'description' => esc_html__( 'Designates the ascending or descending order.', 'canava' ),
			'param_name'  => 'direction',
			'std'         => 'DESC',
			'value'       => array(
				__( 'Ascending', 'canava' )          => 'ASC',
				__( 'Descending', 'canava' )            => 'DESC'
			)
		);

		$params[] = array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra Class', 'canava' ),
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'canava' ),
			'param_name'  => 'class'
		);

		// Carousel Options
		$params[] = array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Autoplay?', 'canava' ),
			'param_name' => 'autoplay',
			'group'      => esc_html__( 'Carousel Options', 'canava' ),
			'std'        => 'yes',
			'value'      => array(
				__( 'Yes', 'canava' ) => 'yes',
				__( 'No', 'canava' ) => 'no'
			)
		);

		$params[] = array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Stop On Hover?', 'canava' ),
			'description' => esc_html__( 'Rewind speed in milliseconds', 'canava' ),
			'param_name'  => 'hover_stop',
			'group'       => esc_html__( 'Carousel Options', 'canava' ),
			'std'         => 'yes',
			'value'       => array(
				__( 'Yes', 'canava' ) => 'yes',
				__( 'No', 'canava' ) => 'no'
			)
		);

		$params[] = array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Slider Controls', 'canava' ),
			'param_name'  => 'controls',
			'group'       => esc_html__( 'Carousel Options', 'canava' ),
			'std'         => 'navigation,rewind-navigation,pagination,pagination-numbers',
			'value'       => array(
				__( 'Navigation', 'canava' )         => 'navigation',
				__( 'Rewind Navigation', 'canava' )  => 'rewind-navigation',
				__( 'Pagination', 'canava' )         => 'pagination',
				__( 'Pagination Numbers', 'canava' ) => 'pagination-numbers'
			)
		);

		$params[] = array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Scroll Per Page?', 'canava' ),
			'param_name' => 'scroll_page',
			'group'       => esc_html__( 'Carousel Options', 'canava' ),
			'std'        => 'yes',
			'value'      => array(
				__( 'Yes', 'canava' ) => 'yes',
				__( 'No', 'canava' ) => 'no'
			)
		);

		$params[] = array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Allow Mouse Drag?', 'canava' ),
			'param_name' => 'mouse_drag',
			'group'      => esc_html__( 'Carousel Options', 'canava' ),
			'std'        => 'yes',
			'value'      => array(
				__( 'Yes', 'canava' ) => 'yes',
				__( 'No', 'canava' ) => 'no'
			)
		);

		$params[] = array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Allow Touch Drag?', 'canava' ),
			'param_name' => 'touch_drag',
			'group'      => esc_html__( 'Carousel Options', 'canava' ),
			'std'        => 'yes',
			'value'      => array(
				__( 'Yes', 'canava' ) => 'yes',
				__( 'No', 'canava' ) => 'no'
			)
		);

		// Speed
		$params[] = array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Autoplay Speed', 'canava' ),
			'description' => esc_html__( 'Autoplay speed in milliseconds', 'canava' ),
			'param_name'  => 'autoplay_speed',
			'group'       => esc_html__( 'Speed', 'canava' ),
			'value'       => 5000
		);

		$params[] = array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Slide Speed', 'canava' ),
			'description' => esc_html__( 'Slide speed in milliseconds', 'canava' ),
			'param_name'  => 'slide_speed',
			'group' => esc_html__( 'Speed', 'canava' ),
			'value'       => 200
		);

		$params[] = array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Pagination Speed', 'canava' ),
			'description' => esc_html__( 'Pagination speed in milliseconds', 'canava' ),
			'param_name'  => 'pagination_speed',
			'group' => esc_html__( 'Speed', 'canava' ),
			'value'       => 200
		);

		$params[] = array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Rewind Speed', 'canava' ),
			'description' => esc_html__( 'Rewind speed in milliseconds', 'canava' ),
			'param_name'  => 'rewind_speed',
			'group' => esc_html__( 'Speed', 'canava' ),
			'value'       => 200
		);

		// Responsive
		$params[] = array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Enable Responsive?', 'canava' ),
			'param_name' => 'responsive',
			'group'      => esc_html__( 'Responsive', 'canava' ),
			'std'        => 'yes',
			'value'      => array(
				__( 'Yes', 'canava' ) => 'yes',
				__( 'No', 'canava' ) => 'no'
			)
		);

		$params[] = array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Items On Tablet', 'canava' ),
			'description' => esc_html__( 'The maximum amount of items displayed at a time on tablet device', 'canava' ),
			'param_name'  => 'tablet_items',
			'group'       => esc_html__( 'Responsive', 'canava' ),
			'value'       => array_combine( range( 1, 6 ), range( 1, 6 ) ),
			'std'         => 2
		);

		$params[] = array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Items On Mobile', 'canava' ),
			'description' => esc_html__( 'The maximum amount of items displayed at a time on mobile device', 'canava' ),
			'param_name'  => 'mobile_items',
			'group'       => esc_html__( 'Responsive', 'canava' ),
			'value'       => array_combine( range( 1, 6 ), range( 1, 6 ) ),
			'std'         => 1
		);

		$params[] = array(
			'type' => 'css_editor',
			'param_name' => 'css',
			'group' => esc_html__( 'Design Options', 'canava' )
		);
		return $params;
	}

	/**
	 * Setting up the projects support
	 * 
	 * @return  void
	 */
	protected function setup() {
		/**
		 * Add template for projects shortcode
		 */
		add_filter( 'nprojects/shortcode_template', array( $this, 'shortcode_template' ) );

		add_filter( 'nprojects/shortcode_parameters', array( $this, 'shortcode_parameters' ) );

		/**
		 * Change project post type settings
		 */
		add_filter( 'nprojects/post_type_args', array( $this, 'post_type_args' ) );

		/**
		 * Change project category settings
		 */
		add_filter( 'nprojects/taxonomy_category_args', array( $this, 'taxonomy_category_args' ) );

		/**
		 * Change project tag settings
		 */
		add_filter( 'nprojects/taxonomy_tag_args', array( $this, 'taxonomy_tag_args' ) );

		/**
		 * Override the theme options
		 */
		add_filter( 'op/prepare_options', array( $this, 'override_options' ) );

		/**
		 * Register filter to adding specific classes for projects archive
		 */
		add_filter( 'projects/archive-class', array( $this, 'archive_class' ) );

		/**
		 * Return the thumbnail size name
		 */
		add_filter( 'projects/archive-thumbnail-size', array( $this, 'archive_thumbnail_size' ) );

		/**
		 * Pagination option
		 */
		add_filter( 'option_posts_per_page', array( $this, 'posts_per_page' ) );

		/**
		 * Register theme customize panels
		 */
		add_action( 'theme/customize-panels', array( $this, 'customize_panels' ) );

		/**
		 * Register theme customize sections
		 */
		add_action( 'theme/customize-sections', array( $this, 'customize_sections' ) );

		/**
		 * Register theme customize controls
		 */
		add_action( 'theme/customize-controls', array( $this, 'customize_controls' ) );

		/**
		 * Register project metabox
		 */
		add_action( 'add_meta_boxes', array( $this, 'add_metabox' ) );

		/**
		 * Register action for save project settings
		 */
		add_action( 'save_post', array( $this, 'save_project_settings' ) );

		/**
		 * Register action to enqueue admin assets
		 */
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}

	/**
	 * Return the flag that allow to initialize
	 * this feature
	 * 
	 * @return  boolean
	 */
	protected function enabled() {
		return class_exists( 'nProjects' );
	}
}
