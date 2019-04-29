<?php
/* Theme-specific action to configure ThemeREX Addons components
------------------------------------------------------------------------------- */


/* ThemeREX Addons components
------------------------------------------------------------------------------- */
if (!function_exists('freightco_trx_addons_theme_specific_setup1')) {
	add_filter( 'trx_addons_filter_components_editor', 'freightco_trx_addons_theme_specific_components');
	function freightco_trx_addons_theme_specific_components($enable=false) {
		return FREIGHTCO_THEME_FREE
					? false		// Free version
					: false;		// Pro version or Developer mode
	}
}

if (!function_exists('freightco_trx_addons_theme_specific_setup1')) {
	add_action( 'after_setup_theme', 'freightco_trx_addons_theme_specific_setup1', 1 );
	function freightco_trx_addons_theme_specific_setup1() {
		if (freightco_exists_trx_addons()) {
			add_filter( 'trx_addons_cv_enable',					'freightco_trx_addons_cv_enable');
			add_filter( 'trx_addons_demo_enable',				'freightco_trx_addons_demo_enable');
			add_filter( 'trx_addons_filter_edd_themes_market',	'freightco_trx_addons_edd_themes_market_enable');
			add_filter( 'trx_addons_cpt_list',					'freightco_trx_addons_cpt_list');
			add_filter( 'trx_addons_sc_list',					'freightco_trx_addons_sc_list');
			add_filter( 'trx_addons_widgets_list',				'freightco_trx_addons_widgets_list');
		}
	}
}

// CV
if ( !function_exists( 'freightco_trx_addons_cv_enable' ) ) {
	//Handler of the add_filter( 'trx_addons_cv_enable', 'freightco_trx_addons_cv_enable');
	function freightco_trx_addons_cv_enable($enable=false) {
		// To do: return false if theme not use CV functionality
		return FREIGHTCO_THEME_FREE
					? false		// Free version
					: true;		// Pro version
	}
}

// Demo mode
if ( !function_exists( 'freightco_trx_addons_demo_enable' ) ) {
	//Handler of the add_filter( 'trx_addons_demo_enable', 'freightco_trx_addons_demo_enable');
	function freightco_trx_addons_demo_enable($enable=false) {
		// To do: return false if theme not use Demo functionality
		return FREIGHTCO_THEME_FREE
					? false		// Free version
					: true;		// Pro version
	}
}

// EDD Themes market
if ( !function_exists( 'freightco_trx_addons_edd_themes_market_enable' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_edd_themes_market', 'freightco_trx_addons_edd_themes_market_enable')) {
	function freightco_trx_addons_edd_themes_market_enable($enable=false) {
		// To do: return false if theme not Themes market functionality
		return FREIGHTCO_THEME_FREE
					? false		// Free version
					: true;		// Pro version
	}
}


// API
if ( !function_exists( 'freightco_trx_addons_api_list' ) ) {
	//Handler of the add_filter('trx_addons_api_list',	'freightco_trx_addons_api_list');
	function freightco_trx_addons_api_list($list=array()) {
		// To do: Enable/Disable Third-party plugins API via add/remove it in the list

		// If it's a free version - leave only basic set
		if (FREIGHTCO_THEME_FREE) {
			$free_api = array('instagram_feed', 'siteorigin-panels', 'woocommerce', 'contact-form-7');
			foreach ($list as $k=>$v) {
				if (!in_array($k, $free_api)) {
					unset($list[$k]);
				}
			}
		}
		return $list;
	}
}


// CPT
if ( !function_exists( 'freightco_trx_addons_cpt_list' ) ) {
	//Handler of the add_filter('trx_addons_cpt_list',	'freightco_trx_addons_cpt_list');
	function freightco_trx_addons_cpt_list($list=array()) {
		// To do: Enable/Disable CPT via add/remove it in the list

		// If it's a free version - leave only basic set
		if (FREIGHTCO_THEME_FREE) {
			$free_cpt = array('layouts', 'portfolio', 'post', 'services', 'team', 'testimonials');
			foreach ($list as $k=>$v) {
				if (!in_array($k, $free_cpt)) {
					unset($list[$k]);
				}
			}
		}
		return $list;
	}
}

// Shortcodes
if ( !function_exists( 'freightco_trx_addons_sc_list' ) ) {
	//Handler of the add_filter('trx_addons_sc_list',	'freightco_trx_addons_sc_list');
	function freightco_trx_addons_sc_list($list=array()) {
		// To do: Add/Remove shortcodes into list
		// If you add new shortcode - in the theme's folder must exists /trx_addons/shortcodes/new_sc_name/new_sc_name.php

		// If it's a free version - leave only basic set
		if (FREIGHTCO_THEME_FREE) {
			$free_shortcodes = array('action', 'anchor', 'blogger', 'button', 'form', 'icons', 'price', 'promo', 'socials');
			foreach ($list as $k=>$v) {
				if (!in_array($k, $free_shortcodes)) {
					unset($list[$k]);
				}
			}
		}
		return $list;
	}
}

// Widgets
if ( !function_exists( 'freightco_trx_addons_widgets_list' ) ) {
	//Handler of the add_filter('trx_addons_widgets_list',	'freightco_trx_addons_widgets_list');
	function freightco_trx_addons_widgets_list($list=array()) {
		// To do: Add/Remove widgets into list
		// If you add widget - in the theme's folder must exists /trx_addons/widgets/new_widget_name/new_widget_name.php

		// If it's a free version - leave only basic set
		if (FREIGHTCO_THEME_FREE) {
			$free_widgets = array('aboutme', 'banner', 'contacts', 'flickr', 'popular_posts', 'recent_posts', 'slider', 'socials');
			foreach ($list as $k=>$v) {
				if (!in_array($k, $free_widgets)) {
					unset($list[$k]);
				}
			}
		}
		return $list;
	}
}

// Add mobile menu to the plugin's cached menu list
if ( !function_exists( 'freightco_trx_addons_menu_cache' ) ) {
	add_filter( 'trx_addons_filter_menu_cache', 'freightco_trx_addons_menu_cache');
	function freightco_trx_addons_menu_cache($list=array()) {
		if (in_array('#menu_main', $list)) $list[] = '#menu_mobile';
		$list[] = '.menu_mobile_inner > nav > ul';
		return $list;
	}
}

// Add theme-specific vars into localize array
if (!function_exists('freightco_trx_addons_localize_script')) {
	add_filter( 'freightco_filter_localize_script', 'freightco_trx_addons_localize_script' );
	function freightco_trx_addons_localize_script($arr) {
		$arr['alter_link_color'] = freightco_get_scheme_color('alter_link');
		return $arr;
	}
}


// Shortcodes support
//------------------------------------------------------------------------

// Add new output types (layouts) in the shortcodes
if ( !function_exists( 'freightco_trx_addons_sc_type' ) ) {
	add_filter( 'trx_addons_sc_type', 'freightco_trx_addons_sc_type', 10, 2);
	function freightco_trx_addons_sc_type($list, $sc) {
		// To do: check shortcode slug and if correct - add new 'key' => 'title' to the list
		if ($sc == 'trx_sc_title') {
			$list['default with_border'] = esc_html__('Default With Border', 'freightco');
			$list['default with_border alter'] = esc_html__('Default With Border Alter', 'freightco');
			$list['default with_border alter alter_color'] = esc_html__('Default With Border Style 2', 'freightco');
			$list['default big'] = esc_html__('Default Big', 'freightco');
		}			
		if ($sc == 'trx_sc_button') {
			$list['simple dark'] = esc_html__('Simple Dark', 'freightco');
			$list['default big_icon'] = esc_html__('Big Icon', 'freightco');
		}			
		if ($sc == 'trx_sc_icons') {
			$list['modern alter'] = esc_html__('Modern Alter', 'freightco');
			$list['alter'] = esc_html__('Alter', 'freightco');
			$list['images'] = esc_html__('Images', 'freightco');
			$list['number'] = esc_html__('Number', 'freightco');
		}			
		return $list;
	}
}

// Add params to the default shortcode's atts
if ( !function_exists( 'freightco_trx_addons_sc_atts' ) ) {
	add_filter( 'trx_addons_sc_atts', 'freightco_trx_addons_sc_atts', 10, 2);
	function freightco_trx_addons_sc_atts($atts, $sc) {
		
		// Param 'scheme'
		if (in_array($sc, array('trx_sc_action', 'trx_sc_blogger', 'trx_sc_cars', 'trx_sc_courses', 'trx_sc_content', 'trx_sc_dishes',
								'trx_sc_events', 'trx_sc_form',	'trx_sc_googlemap', 'trx_sc_layouts', 'trx_sc_portfolio', 'trx_sc_price', 'trx_sc_promo',
								'trx_sc_properties', 'trx_sc_services', 'trx_sc_team', 'trx_sc_testimonials', 'trx_sc_title',
								'trx_widget_audio', 'trx_widget_twitter', 'trx_sc_layouts_container')))
			$atts['scheme'] = 'inherit';
		// Param 'color_style'
		if (in_array($sc, array('trx_sc_action', 'trx_sc_blogger', 'trx_sc_cars', 'trx_sc_courses', 'trx_sc_content', 'trx_sc_dishes',
								'trx_sc_events', 'trx_sc_form',	'trx_sc_googlemap', 'trx_sc_portfolio', 'trx_sc_price', 'trx_sc_promo',
								'trx_sc_properties', 'trx_sc_services', 'trx_sc_team', 'trx_sc_testimonials', 'trx_sc_title',
								'trx_widget_audio', 'trx_widget_twitter',
								'trx_sc_button')))
			$atts['color_style'] = 'default';
		return $atts;
	}
}

// Add params to the shortcodes VC map
if ( !function_exists( 'freightco_trx_addons_sc_map' ) ) {
	add_filter( 'trx_addons_sc_map', 'freightco_trx_addons_sc_map', 10, 2);
	function freightco_trx_addons_sc_map($params, $sc) {

		// Param 'scheme'
		if (in_array($sc, array('trx_sc_action', 'trx_sc_blogger', 'trx_sc_cars', 'trx_sc_courses', 'trx_sc_content', 'trx_sc_dishes',
								'trx_sc_events', 'trx_sc_form', 'trx_sc_googlemap', 'trx_sc_layouts', 'trx_sc_portfolio', 'trx_sc_price', 'trx_sc_promo',
								'trx_sc_properties', 'trx_sc_services', 'trx_sc_team', 'trx_sc_testimonials', 'trx_sc_title',
								'trx_widget_audio', 'trx_widget_twitter', 'trx_sc_layouts_container'))) {
			if (empty($params['params']) || !is_array($params['params'])) $params['params'] = array();
			$params['params'][] = array(
					'param_name' => 'scheme',
					'heading' => esc_html__('Color scheme', 'freightco'),
					'description' => wp_kses_data( __('Select color scheme to decorate this block', 'freightco') ),
					'group' => esc_html__('Colors', 'freightco'),
					'admin_label' => true,
					'value' => array_flip(freightco_get_list_schemes(true)),
					'type' => 'dropdown'
				);
		}
		// Param 'color_style'
		$param = array(
			'param_name' => 'color_style',
			'heading' => esc_html__('Color style', 'freightco'),
			'description' => wp_kses_data( __('Select color style to decorate this block', 'freightco') ),
			'edit_field_class' => 'vc_col-sm-4',
			'admin_label' => true,
			'value' => array_flip(freightco_get_list_sc_color_styles()),
			'type' => 'dropdown'
		);
		if (in_array($sc, array('trx_sc_button'))) {
			if (empty($params['params']) || !is_array($params['params'])) $params['params'] = array();
			$new_params = array();
			foreach ($params['params'] as $v) {
				if (in_array($v['param_name'], array('type', 'size'))) $v['edit_field_class'] = 'vc_col-sm-4';
				$new_params[] = $v;
				if ($v['param_name'] == 'size') {
					$new_params[] = $param;
				}
			}
			$params['params'] = $new_params;
		} else if (in_array($sc, array('trx_sc_action', 'trx_sc_blogger', 'trx_sc_cars', 'trx_sc_courses', 'trx_sc_content', 'trx_sc_dishes',
								'trx_sc_events', 'trx_sc_form',	'trx_sc_googlemap', 'trx_sc_portfolio', 'trx_sc_price', 'trx_sc_promo',
								'trx_sc_properties', 'trx_sc_services', 'trx_sc_team', 'trx_sc_testimonials', 'trx_sc_title',
								'trx_widget_audio', 'trx_widget_twitter'))) {
			if (empty($params['params']) || !is_array($params['params'])) $params['params'] = array();
			$new_params = array();
			foreach ($params['params'] as $v) {
				if (in_array($v['param_name'], array('title_style', 'title_tag', 'title_align'))) $v['edit_field_class'] = 'vc_col-sm-6';
				$new_params[] = $v;
				if ($v['param_name'] == 'title_align') {
					if (!empty($v['group'])) $param['group'] = $v['group'];
					$param['edit_field_class'] = 'vc_col-sm-6';
					$new_params[] = $param;
				}
			}
			$params['params'] = $new_params;
		}
		return $params;
	}
}

// Add params into shortcodes SOW map
if ( !function_exists( 'freightco_trx_addons_sow_map' ) ) {
	add_filter( 'trx_addons_sow_map', 'freightco_trx_addons_sow_map', 10, 2);
	function freightco_trx_addons_sow_map($params, $sc) {

		// Param 'color_style'
		$param = array(
			'color_style' => array(
				'label' => esc_html__('Color style', 'freightco'),
				'description' => wp_kses_data( __('Select color style to decorate this block', 'freightco') ),
				'options' => freightco_get_list_sc_color_styles(),
				'default' => 'default',
				'type' => 'select'
			)
		);
		if (in_array($sc, array('trx_sc_button')))
			freightco_array_insert_after($params, 'size', $param);
		else if (in_array($sc, array('trx_sc_action', 'trx_sc_blogger', 'trx_sc_cars', 'trx_sc_courses', 'trx_sc_content', 'trx_sc_dishes',
								'trx_sc_events', 'trx_sc_form',	'trx_sc_googlemap', 'trx_sc_portfolio', 'trx_sc_price', 'trx_sc_promo',
								'trx_sc_properties', 'trx_sc_services', 'trx_sc_team', 'trx_sc_testimonials', 'trx_sc_title',
								'trx_widget_audio', 'trx_widget_twitter')))
			freightco_array_insert_after($params, 'title_align', $param);
		return $params;
	}
}

// Add classes to the shortcode's output
if ( !function_exists( 'freightco_trx_addons_sc_output' ) ) {
	add_filter( 'trx_addons_sc_output', 'freightco_trx_addons_sc_output', 10, 4);
	function freightco_trx_addons_sc_output($output, $sc, $atts, $content) {
		
		if (in_array($sc, array('trx_sc_action'))) {
			if (!empty($atts['scheme']) && !freightco_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_action ', 'class="sc_action scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !freightco_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_action ', 'class="sc_action color_style_'.esc_attr($atts['color_style']).' ', $output);

		} else if (in_array($sc, array('trx_sc_blogger'))) {
			if (!empty($atts['scheme']) && !freightco_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_blogger ', 'class="sc_blogger scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !freightco_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_blogger ', 'class="sc_blogger color_style_'.esc_attr($atts['color_style']).' ', $output);

		} else if (in_array($sc, array('trx_sc_button'))) {
			if (!empty($atts['color_style']) && !freightco_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_button ', 'class="sc_button color_style_'.esc_attr($atts['color_style']).' ', $output);

		} else if (in_array($sc, array('trx_sc_cars'))) {
			if (!empty($atts['scheme']) && !freightco_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_cars ', 'class="sc_cars scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !freightco_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_cars ', 'class="sc_cars color_style_'.esc_attr($atts['color_style']).' ', $output);

		} else if (in_array($sc, array('trx_sc_courses'))) {
			if (!empty($atts['scheme']) && !freightco_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_courses ', 'class="sc_courses scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !freightco_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_courses ', 'class="sc_courses color_style_'.esc_attr($atts['color_style']).' ', $output);

		} else if (in_array($sc, array('trx_sc_content'))) {
			if (!empty($atts['scheme']) && !freightco_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_content ', 'class="sc_content scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !freightco_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_content ', 'class="sc_content color_style_'.esc_attr($atts['color_style']).' ', $output);

		} else if (in_array($sc, array('trx_sc_dishes'))) {
			if (!empty($atts['scheme']) && !freightco_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_dishes ', 'class="sc_dishes scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !freightco_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_dishes ', 'class="sc_dishes color_style_'.esc_attr($atts['color_style']).' ', $output);

		} else if (in_array($sc, array('trx_sc_events'))) {
			if (!empty($atts['scheme']) && !freightco_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_events ', 'class="sc_events scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !freightco_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_events ', 'class="sc_events color_style_'.esc_attr($atts['color_style']).' ', $output);

		} else if (in_array($sc, array('trx_sc_form'))) {
			if (!empty($atts['scheme']) && !freightco_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_form ', 'class="sc_form scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !freightco_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_form ', 'class="sc_form color_style_'.esc_attr($atts['color_style']).' ', $output);

		} else if (in_array($sc, array('trx_sc_googlemap'))) {
			if (!empty($atts['scheme']) && !freightco_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_googlemap_content', 'class="sc_googlemap_content scheme_'.esc_attr($atts['scheme']), $output);
			if (!empty($atts['color_style']) && !freightco_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_googlemap_content ', 'class="sc_googlemap_content color_style_'.esc_attr($atts['color_style']).' ', $output);

		} else if (in_array($sc, array('trx_sc_layouts'))) {
			if (!empty($atts['scheme']) && !freightco_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_layouts ', 'class="sc_layouts scheme_'.esc_attr($atts['scheme']).' ', $output);
	
		} else if (in_array($sc, array('trx_sc_portfolio'))) {
			if (!empty($atts['scheme']) && !freightco_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_portfolio ', 'class="sc_portfolio scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !freightco_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_portfolio ', 'class="sc_portfolio color_style_'.esc_attr($atts['color_style']).' ', $output);
	
		} else if (in_array($sc, array('trx_sc_price'))) {
			if (!empty($atts['scheme']) && !freightco_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_price ', 'class="sc_price scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !freightco_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_price ', 'class="sc_price color_style_'.esc_attr($atts['color_style']).' ', $output);
	
		} else if (in_array($sc, array('trx_sc_promo'))) {
			if (!empty($atts['scheme']) && !freightco_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_promo ', 'class="sc_promo scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !freightco_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_promo ', 'class="sc_promo color_style_'.esc_attr($atts['color_style']).' ', $output);
	
		} else if (in_array($sc, array('trx_sc_properties'))) {
			if (!empty($atts['scheme']) && !freightco_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_properties ', 'class="sc_properties scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !freightco_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_properties ', 'class="sc_properties color_style_'.esc_attr($atts['color_style']).' ', $output);
	
		} else if (in_array($sc, array('trx_sc_services'))) {
			if (!empty($atts['scheme']) && !freightco_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_services ', 'class="sc_services scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !freightco_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_services ', 'class="sc_services color_style_'.esc_attr($atts['color_style']).' ', $output);
	
		} else if (in_array($sc, array('trx_sc_team'))) {
			if (!empty($atts['scheme']) && !freightco_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_team ', 'class="sc_team scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !freightco_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_team ', 'class="sc_team color_style_'.esc_attr($atts['color_style']).' ', $output);
	
		} else if (in_array($sc, array('trx_sc_testimonials'))) {
			if (!empty($atts['scheme']) && !freightco_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_testimonials ', 'class="sc_testimonials scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !freightco_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_testimonials ', 'class="sc_testimonials color_style_'.esc_attr($atts['color_style']).' ', $output);
	
		} else if (in_array($sc, array('trx_sc_title'))) {
			if (!empty($atts['scheme']) && !freightco_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_title ', 'class="sc_title scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !freightco_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_title ', 'class="sc_title color_style_'.esc_attr($atts['color_style']).' ', $output);
	
		} else if (in_array($sc, array('trx_widget_audio'))) {
			if (!empty($atts['scheme']) && !freightco_is_inherit($atts['scheme']))
				$output = str_replace('sc_widget_audio', 'sc_widget_audio scheme_'.esc_attr($atts['scheme']), $output);
			if (!empty($atts['color_style']) && !freightco_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_widget_audio ', 'class="sc_widget_audio color_style_'.esc_attr($atts['color_style']).' ', $output);
	
		} else if (in_array($sc, array('trx_widget_twitter'))) {
			if (!empty($atts['scheme']) && !freightco_is_inherit($atts['scheme']))
				$output = str_replace('sc_widget_twitter', 'sc_widget_twitter scheme_'.esc_attr($atts['scheme']), $output);
			if (!empty($atts['color_style']) && !freightco_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_widget_twitter ', 'class="sc_widget_twitter color_style_'.esc_attr($atts['color_style']).' ', $output);
	
		} else if (in_array($sc, array('trx_sc_layouts_container'))) {
			if (!empty($atts['scheme']) && !freightco_is_inherit($atts['scheme']))
				$output = str_replace('sc_layouts_container', 'sc_layouts_container scheme_'.esc_attr($atts['scheme']), $output);
	
		}
		return $output;
	}
}

// Return tag for the item's title
if ( !function_exists( 'freightco_trx_addons_sc_item_title_tag' ) ) {
	add_filter( 'trx_addons_filter_sc_item_title_tag', 'freightco_trx_addons_sc_item_title_tag');
	function freightco_trx_addons_sc_item_title_tag($tag='') {
		return $tag=='h1' ? 'h2' : $tag;
	}
}

// Return args for the item's button
if ( !function_exists( 'freightco_trx_addons_sc_item_button_args' ) ) {
	add_filter( 'trx_addons_filter_sc_item_button_args', 'freightco_trx_addons_sc_item_button_args', 10, 3);
	function freightco_trx_addons_sc_item_button_args($args, $sc, $sc_args) {
		if (!empty($sc_args['color_style']))
			$args['color_style'] = $sc_args['color_style'];
		return $args;
	}
}

// Return theme specific title layout for the slider
if ( !function_exists( 'freightco_trx_addons_slider_title' ) ) {
	add_filter( 'trx_addons_filter_slider_title',	'freightco_trx_addons_slider_title', 10, 2 );
	function freightco_trx_addons_slider_title($title, $data) {
		$title = '';
		if (!empty($data['title'])) 
			$title .= '<h3 class="slide_title">'
						. (!empty($data['link']) ? '<a href="'.esc_url($data['link']).'">' : '')
						. esc_html($data['title'])
						. (!empty($data['link']) ? '</a>' : '')
						. '</h3>';
		if (!empty($data['cats']))
			$title .= sprintf('<div class="slide_cats">%s</div>', $data['cats']);
		return $title;
	}
}

// Add new styles to the Google map
if ( !function_exists( 'freightco_trx_addons_sc_googlemap_styles' ) ) {
	add_filter( 'trx_addons_filter_sc_googlemap_styles',	'freightco_trx_addons_sc_googlemap_styles');
	function freightco_trx_addons_sc_googlemap_styles($list) {
		$list['dark'] = esc_html__('Shades of Grey', 'freightco');
		return $list;
	}
}


// WP Editor addons
//------------------------------------------------------------------------

// Theme-specific configure of the WP Editor
if ( !function_exists( 'freightco_trx_addons_tiny_mce_style_formats' ) ) {
	add_filter( 'trx_addons_filter_tiny_mce_style_formats', 'freightco_trx_addons_tiny_mce_style_formats');
	function freightco_trx_addons_tiny_mce_style_formats($style_formats) {
		// Add style 'Arrow' to the 'List styles'
		// Remove 'false &&' from the condition below to add new style to the list
		if (is_array($style_formats) && count($style_formats)>0 ) {
			unset($style_formats[1]);
			$style_formats[1]['title'] = "Copyright";
			$style_formats[1]['items'] = array();			
			foreach ($style_formats as $k=>$v) {
				if ( $v['title'] == esc_html__('Inline', 'freightco') ) {
					unset($style_formats[$k]['items']);
					$style_formats[$k]['items'] = array();

					$style_formats[$k]['items'][] = array(
								'title' => esc_html__('Accent text color', 'freightco'),
								'inline' => 'span',
								'classes' => 'trx_addons_accent'
							);
					$style_formats[$k]['items'][] = array(
								'title' => esc_html__('Hovered text color', 'freightco'),
								'inline' => 'span',
								'classes' => 'trx_addons_hover'
							);
					$style_formats[$k]['items'][] = array(
								'title' => esc_html__('Text with background', 'freightco'),
								'inline' => 'span',
								'classes' => 'trx_addons_accent_bg'
							);
					$style_formats[$k]['items'][] = array(
								'title' => esc_html__('Font size 1.125em', 'freightco'),
								'inline' => 'span',
								'classes' => 'trx_addons_fontsize_1125em'
							);
					$style_formats[$k]['items'][] = array(
								'title' => esc_html__('Margin bottom 1.1em', 'freightco'),
								'inline' => 'span',
								'classes' => 'trx_addons_mb_11em'
							);
					$style_formats[$k]['items'][] = array(
								'title' => esc_html__('Dropcap 1', 'freightco'),
								'inline' => 'span',
								'classes' => 'trx_addons_dropcap trx_addons_dropcap_style_1'
							);
					$style_formats[$k]['items'][] = array(
								'title' => esc_html__('Dropcap 2', 'freightco'),
								'inline' => 'span',
								'classes' => 'trx_addons_dropcap trx_addons_dropcap_style_2'
							);
				}

				if ( $v['title'] == esc_html__('List styles', 'freightco') ) {
					unset($style_formats[$k]['items']);
					$style_formats[$k]['items'] = array();
					$style_formats[$k]['items'][] = array(
								'title' => esc_html__('Success (circled)', 'freightco'),
								'selector' => 'ul',
								'classes' => 'trx_addons_list_success_circled'
							);
					$style_formats[$k]['items'][] = array(
								'title' => esc_html__('Dot', 'freightco'),
								'selector' => 'ul',
								'classes' => 'trx_addons_list_dot'
							);
					$style_formats[$k]['items'][] = array(
								'title' => esc_html__('Number', 'freightco'),
								'selector' => 'ol',
								'classes' => 'trx_addons_list_number'
							);
				}				
				if ( $v['title'] == esc_html__('Copyright', 'freightco') ) {
					$style_formats[$k]['items'][] = array(
								'title' => esc_html__('Default', 'freightco'),
								'inline' => 'span',
								'classes' => 'copyright_text'
							);

				}				
			}
		}
		return $style_formats;
	}
}


if ( !function_exists( 'freightco_filter_get_list_sc_slider_paginations_types' ) ) {
	add_filter( 'trx_addons_filter_get_list_sc_slider_paginations_types',	'freightco_filter_get_list_sc_slider_paginations_types', 10);
	function freightco_filter_get_list_sc_slider_paginations_types($list='') {
		unset($list['progress']);
		unset($list['fraction']);
		return $list;
	}
}
if ( !function_exists( 'freightco_filter_get_list_sc_slider_effects' ) ) {
	add_filter( 'trx_addons_filter_get_list_sc_slider_effects',	'freightco_filter_get_list_sc_slider_effects', 10);
	function freightco_filter_get_list_sc_slider_effects($list='') {
		unset($list['fade']);
		unset($list['cube']);
		unset($list['flip']);
		unset($list['coverflow']);
		return $list;
	}
}

if ( !function_exists( 'freightco_filter_get_list_sc_icon_sizes' ) ) {
	add_filter( 'trx_addons_filter_get_list_sc_icon_sizes',	'freightco_filter_get_list_sc_icon_sizes', 10);
	function freightco_filter_get_list_sc_icon_sizes($list='') {
		// unset($list['small']);
		// unset($list['large']);
		return $list;
	}
}


if ( !function_exists( 'freightco_filter_get_list_sc_layouts_search' ) ) {
	add_filter( 'trx_addons_filter_get_list_sc_layouts_search',	'freightco_filter_get_list_sc_layouts_search', 10);
	function freightco_filter_get_list_sc_layouts_search($list='') {
		// unset($list['expand']);
		// unset($list['fullscreen']);
		return $list;
	}
}

if ( !function_exists( 'freightco_filter_get_list_sc_layouts_row_types' ) ) {
	add_filter( 'trx_addons_filter_get_list_sc_layouts_row_types',	'freightco_filter_get_list_sc_layouts_row_types', 10);
	function freightco_filter_get_list_sc_layouts_row_types($list='') {
		// unset($list['narrow']);
		return $list;
	}
}

// Input hover
if ( !function_exists( 'freightco_filter_get_list_input_hover' ) ) {
	add_filter( 'trx_addons_filter_get_list_input_hover',	'freightco_filter_get_list_input_hover');
	function freightco_filter_get_list_input_hover($list) {
		unset($list);
		$list = array();
		$list['default'] = esc_html__('Default', 'freightco');
		return $list;
	}
}

// menu hover
if ( !function_exists( 'freightco_filter_get_list_menu_hover' ) ) {
	add_filter( 'trx_addons_filter_get_list_menu_hover',	'freightco_filter_get_list_menu_hover');
	function freightco_filter_get_list_menu_hover($list) {
		unset($list);
		$list = array();
		$list['none'] = esc_html__('- None -', 'freightco');
		$list['fade'] = esc_html__('Fade', 'freightco');
		return $list;
	}
}

// animation in
if ( !function_exists( 'freightco_filter_get_list_animations_in' ) ) {
	add_filter( 'trx_addons_filter_get_list_animations_in',	'freightco_filter_get_list_animations_in');
	function freightco_filter_get_list_animations_in($list) {
		unset($list);
		$list = array();
		$list['none'] = esc_html__('- None -', 'freightco');
		$list['fadeIn'] = esc_html__('Fade In', 'freightco');
		return $list;
	}
}

// animation out
if ( !function_exists( 'freightco_filter_get_list_animations_out' ) ) {
	add_filter( 'trx_addons_filter_get_list_animations_out',	'freightco_filter_get_list_animations_out');
	function freightco_filter_get_list_animations_out($list) {
		unset($list);
		$list = array();
		$list['none'] = esc_html__('- None -', 'freightco');
		$list['fadeOut'] = esc_html__('fade Out', 'freightco');
		return $list;
	}
}

// Setup team and portflio pages
//------------------------------------------------------------------------


// Disable override header image on team and portfolio pages
if ( !function_exists( 'freightco_trx_addons_allow_override_header_image' ) ) {
	add_filter( 'freightco_filter_allow_override_header_image', 'freightco_trx_addons_allow_override_header_image' );
	function freightco_trx_addons_allow_override_header_image($allow) {
		return freightco_is_team_page() ? false : $allow;
	}
}

// Get thumb size for the team items
if ( !function_exists( 'freightco_trx_addons_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_thumb_size',	'freightco_trx_addons_thumb_size', 10, 2);
	function freightco_trx_addons_thumb_size($thumb_size='', $type='') {
//		Uncomment next lines to change team members images (default is 'avatar')
//		if ($type == 'team-default')
//			$thumb_size = freightco_get_thumb_size('big');
		return $thumb_size;
	}
}

// Add fields to the meta box for the team members
// All other CPT meta boxes may be modified in the same method
if (!function_exists('freightco_trx_addons_meta_box_fields')) {
	add_filter( 'trx_addons_filter_meta_box_fields', 'freightco_trx_addons_meta_box_fields', 10, 2);
	function freightco_trx_addons_meta_box_fields($mb, $post_type) {
		if (defined('TRX_ADDONS_CPT_TEAM_PT') && $post_type==TRX_ADDONS_CPT_TEAM_PT) {
			$mb['email'] = array(
				"title" => esc_html__("E-mail",  'freightco'),
				"desc" => wp_kses_data( __("Team member's email", 'freightco') ),
				"std" => "",
				"details" => true,
				"type" => "text"
			);

		}
		return $mb;
	}
}

// CF7
if ( !function_exists( 'freightco_wpcf7_field_group_add_button_atts' ) ) {
	add_filter( 'wpcf7_field_group_add_button_atts',	'freightco_wpcf7_field_group_add_button_atts', 10);
	function freightco_wpcf7_field_group_add_button_atts($list='') {
		$list['text'] = esc_html__('Add another item', 'freightco');
		return $list;
	}
}

if ( !function_exists( 'freightco_wpcf7_field_group_remove_button_atts' ) ) {
	add_filter( 'wpcf7_field_group_remove_button_atts',	'freightco_wpcf7_field_group_remove_button_atts', 10);
	function freightco_wpcf7_field_group_remove_button_atts($list='') {
		$list['text'] = esc_html__('Remove previous item', 'freightco');
		return $list;
	}
}


?>