<?php
/* SiteOrigin Panels support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('freightco_sop_theme_setup9')) {
	add_action( 'after_setup_theme', 'freightco_sop_theme_setup9', 9 );
	function freightco_sop_theme_setup9() {

		add_filter( 'freightco_filter_merge_styles',						'freightco_sop_merge_styles' );
		
		if (freightco_exists_sop()) {
			add_filter( 'siteorigin_panels_general_style_fields',		'freightco_sop_add_row_params', 10, 3 );
			add_filter( 'siteorigin_panels_general_style_attributes',	'freightco_sop_row_style_attributes', 10, 2 );
		}
		if (is_admin()) {
			add_filter( 'freightco_filter_tgmpa_required_plugins',		'freightco_sop_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'freightco_sop_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('freightco_filter_tgmpa_required_plugins',	'freightco_sop_tgmpa_required_plugins');
	function freightco_sop_tgmpa_required_plugins($list=array()) {
		if (freightco_storage_isset('required_plugins', 'siteorigin-panels')) {
			$list[] = array(
					'name' 		=> esc_html__('SiteOrigin Panels (free Page Builder)', 'freightco'),
					'slug' 		=> 'siteorigin-panels',
					'required' 	=> false
			);
			$list[] = array(
					'name' 		=> esc_html__('SiteOrigin Panels Widgets bundle', 'freightco'),
					'slug' 		=> 'so-widgets-bundle',
					'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if SiteOrigin Panels is installed and activated
if ( !function_exists( 'freightco_exists_sop' ) ) {
	function freightco_exists_sop() {
		return class_exists('SiteOrigin_Panels');
	}
}

// Check if SiteOrigin Widgets Bundle is installed and activated
if ( !function_exists( 'freightco_exists_sow' ) ) {
	function freightco_exists_sow() {
		return class_exists('SiteOrigin_Widgets_Bundle');
	}
}
	
// Merge custom styles
if ( !function_exists( 'freightco_sop_merge_styles' ) ) {
	//Handler of the add_filter('freightco_filter_merge_styles', 'freightco_sop_merge_styles');
	function freightco_sop_merge_styles($list) {
		if (freightco_exists_sop()) {
			$list[] = 'plugins/siteorigin-panels/_siteorigin-panels.scss';
		}
		return $list;
	}
}



// Shortcodes support
//------------------------------------------------------------------------

// Add params to the standard SOP rows
if ( !function_exists( 'freightco_sop_add_row_params' ) ) {
	//Handler of the add_filter( 'siteorigin_panels_general_style_fields', 'freightco_sop_add_row_params', 10, 3 );
	function freightco_sop_add_row_params($fields, $post_id, $args) {
		$fields['scheme'] = array(
			'name'        => esc_html__( 'Color scheme', 'freightco' ),
			'description' => wp_kses_data( __( 'Select color scheme to decorate this block', 'freightco' )),
			'group'       => 'design',
			'priority'    => 3,
			'default'     => 'inherit',
			'options'     => freightco_get_list_schemes(true),
			'type'        => 'select'
		);
		return $fields;
	}
}

// Add layouts specific classes to the standard SOP rows
if ( !function_exists( 'freightco_sop_row_style_attributes' ) ) {
	//Handler of the add_filter( 'siteorigin_panels_general_style_attributes', 'freightco_sop_row_style_attributes', 10, 2 );
	function freightco_sop_row_style_attributes($attributes, $style) {
		if ( !empty($style['scheme']) && !trx_addons_is_inherit($style['scheme']) )
			$attributes['class'][] = 'scheme_' . $style['scheme'];
		return $attributes;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if (freightco_exists_sop()) { require_once FREIGHTCO_THEME_DIR . 'plugins/siteorigin-panels/siteorigin-panels-styles.php'; }
?>