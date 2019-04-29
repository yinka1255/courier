<?php
/**
 * WARNING: This file is part of the theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();


if ( ! function_exists( 'canava_style_switcher_settings' ) ) {
	add_filter( 'style-switcher/settings', 'canava_style_switcher_settings' );

	function canava_style_switcher_settings( $settings ) {
		$settings['scheme'] = array(
			'scheme' => op_option( 'scheme_color' ),
			'scheme2' => op_option( 'scheme2_color' ),
			'scheme3' => op_option( 'scheme3_color' )
		);
		
		$settings['colors'] = array(
			array(
				'scheme'  => '#32bfc0',
				'scheme2' => '#21242b',
				'scheme3' => '#ffc952'
			),

			array(
				'scheme'  => '#fcbe32',
				'scheme2' => '#004e66',
				'scheme3' => '#ff5f2e'
			),

			array(
				'scheme'  => '#e53a40',
				'scheme2' => '#282c37',
				'scheme3' => '#30a9de'
			),

			array(
				'scheme'  => '#282c37',
				'scheme2' => '#9baec8',
				'scheme3' => '#d9e1e8'
			),

			array(
				'scheme'  => '#090707',
				'scheme2' => '#e53a40',
				'scheme3' => '#090707'
			),

			array(
				'scheme'  => '#a8dba8',
				'scheme2' => '#3b8686',
				'scheme3' => '#79bd9a'
			)
		);
		$settings['headers'] = array(
			'header-v1' => 'Classic',
			'header-v2' => 'Modern',
			'header-v3' => 'Transparent',
			'header-v4' => 'Header Widget'
		);

		$settings['header'] = op_option( 'header_style' );

		return $settings;
	}
}

add_filter( 'style-switcher/less-file', function() {
	return get_template_directory() . '/assets/less/_color.less';
} );


/**
 * Return the predefined background patterns
 * 
 * @return  array
 */
function canava_background_patterns() {
	static $patterns;

	if ( empty( $patterns ) || ! is_array( $patterns ) ) {
		$patterns = array();
		$template_directory = get_template_directory();
		$stylesheet_directory = get_stylesheet_directory();

		// Find background pattern from template's assets
		foreach( glob( $template_directory . '/assets/img/patterns/*' ) as $file ) {
			if ( is_dir( $file ) )
				continue;

			$patterns['parent_' . basename($file)] = get_template_directory_uri() . '/assets/img/patterns/' . basename($file);
		}

		if ( $template_directory != $stylesheet_directory ) {
			// Find background patterns from child theme's assets
			foreach( glob( $stylesheet_directory . '/assets/img/patterns/*' ) as $file ) {
				if ( is_dir( $file ) )
					continue;

				$patterns['child_' . basename($file)] = get_stylesheet_directory_uri() . '/assets/img/patterns/' . basename($file);
			}
		}

		$patterns = apply_filters( 'theme/predefined_background_patterns', $patterns );
	}

	return $patterns;
}



/**
 * Return currently post type
 * 
 * @return  strings
 */
function canava_current_posttype_is( $post_type ) {
	return op_current_post_type() == $post_type;
}



if ( ! function_exists( 'canava_upload_mimes' ) ) {
	add_filter( 'upload_mimes', 'canava_upload_mimes' );

	/**
	 * Register custom mime types for the theme
	 * 
	 * @param   array  $mimes  List of mime types
	 * @return  array
	 */
	function canava_upload_mimes( $mimes ){
		$mimes['svg'] = 'image/svg+xml';
		$mimes['ico'] = 'image/x-icon';

		return $mimes;
	}
}



if ( ! function_exists( 'canava_under_construction_mode' ) ) {
	add_action( 'wp', 'canava_under_construction_mode' );

	/**
	 * This function will be check user permission and redirect to
	 * under construction page then under construction mode is turnned on
	 * 
	 * @return  void
	 */
	function canava_under_construction_mode() {
		// We not check user permission in admin page
		if ( is_admin() ) return;

		// Check under construction is enabled and it is associated
		// to a page
		if ( op_option( 'under_construction_enabled', false ) && ( $page_id = op_option( 'under_construction_page_id', false ) ) ) {
			$allow_groups = op_option( 'under_construction_allowed', array() );
			$page_permalink = get_permalink( $page_id );

			// Force view permission for administrator
			if ( ! in_array( 'administrator', $allow_groups ) ) {
				array_unshift( $allow_groups, 'administrator' );
			}

			// Just do nothing if current page is assigned as under construction page
			if ( is_page( $page_id ) )
				return;

			// If user not logged in
			if ( ! is_user_logged_in() ) {
				wp_redirect( $page_permalink );
				exit;
			}

			// For logged in user
			else {
				$user = wp_get_current_user();
				$user_can_view = false;

				foreach ( $user->roles as $role ) {
					if ( in_array( $role, $allow_groups ) ) {
						$user_can_view = true;
						break;
					}
				}

				if ( ! $user_can_view ) {
					wp_redirect( $page_permalink );
					exit;
				}
			}
		}
	}
}



if ( is_admin() ) {
	add_action('admin_print_scripts-post-new.php', 'canava_pricing_table_styles');
	add_action('admin_print_scripts-post.php', 'canava_pricing_table_styles');

	function canava_pricing_table_styles() {
		global $post_type;

		if ( $post_type == 'easy-pricing-table' ) {
			echo '<style type="text/css">#dh_ptp_metabox_tabs { display: none !important; }</style>';
		}
	}
}



/**
 * Return an array of sidebars that will be use for
 * the dropdown in the theme options
 * 
 * @return  array
 */
function canava_sidebars_dropdown_options() {
	global $wp_registered_sidebars;
	static $sidebars;

	if ( empty( $sidebars ) ) {
		$sidebars = array();

		foreach ( $wp_registered_sidebars as $sidebar ) {
			if ( $sidebar['id'] == 'wp_inactive_widgets' || strpos( $sidebar['id'], 'orphaned_widgets' ) !== false )
				continue;
			
			$sidebars[$sidebar['id']] = $sidebar['name'];
		}
	}
	
	return $sidebars;
}

