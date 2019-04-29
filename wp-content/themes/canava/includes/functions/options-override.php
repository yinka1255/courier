<?php
/**
 * WARNING: This file is part of the theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

// Migrate theme options after switched theme
add_action( 'after_switch_theme', 'canava_migrate_theme_options' );

// Override theme options for specific page
add_filter( 'op/prepare_options', 'canava_override_theme_options' );

/**
 * Callback function to migrate theme options
 * 
 * @return  void
 */
function canava_migrate_theme_options() {
	$default_options = canava_customize_default_options();
	$options = get_theme_mods();
	
	foreach ( $default_options as $id => $value ) {
		if ( ! isset( $options[$id] ) )
			set_theme_mod( $id, $value );
	}
}



/**
 * Return an array that declare the default options
 * for the theme
 * 
 * @return  array
 */
function canava_customize_default_options() {
	return json_decode(
		'{"data_version":"1.0","gotop_enabed":true,"social_links":{"twitter":"https:\/\/twitter.com\/linethemes","facebook":"https:\/\/facebook.com\/thelinethemes","google-plus":"#","pinterest":"#","__icons_ordering__":["twitter","facebook","google-plus","pinterest","instagram","youtube","vimeo","linkedin","behance","bitcoin","bitbucket","codepen","delicious","deviantart","digg","dribbble","flickr","foursquare","github","jsfiddle","reddit","skype","slack","soundcloud","spotify","stack-exchange","stack-overflow","steam","stumbleupon","tumblr","rss"]},"body_font":{"family":"Source+Sans+Pro","size":"15","style":"400","color":"#666e70"},"heading_font":{"family":"Poppins","style":"600"},"heading_fontsize":["48","36","30","24","18","16"],"menu_font":{"family":"Poppins","size":"15","style":"500","color":"#21242b"},"cyrillic_subsets_enabled":false,"cyrillic_ext_subsets_enabled":false,"greek_subsets_enabled":false,"greek_ext_subsets_enabled":false,"vietnamese_subsets_enabled":false,"latin_ext_subsets_enabled":false,"devanagari_subsets_enabled":false,"scheme_color":"#32bfc0","layout_mode":"layout-wide","boxed_background":{"type":"none","pattern":"none","color":"#fff","image":"","repeat":"repeat","position":"top-left","style":"scroll"},"sidebar_layout":"no-sidebar","sidebar_default":"sidebar-primary","pagetitle_enabled":true,"pagetitle_background":{"color":"","type":"custom","pattern":"none","image":"","repeat":"repeat","position":"top-left","style":"scroll"},"pagetitle_textcolor":"#fff","breadcrumb_prefix":"You are here:","breadcrumb_separator":"\u2192","logo_image":true,"show_tagline":false,"logo_src":"","logo_margin":[0,0],"header_sticky":true,"header_searchbox":true,"topbar_enabled":true,"topbar_content":"","topbar_social_links_enabled":true,"footer_widgets_enabled":true,"footer_widgets_layout":{"active":"3","layout":[["12"],["6","6"],["4","4","4"],["3","3","3","3"]]},"footer_widgets_background":{"color":"","type":"none","pattern":"none","image":"","repeat":"repeat-x","position":"center-center","style":"scroll"},"footer_widgets_textcolor":"","footer_social_links_enabled":true,"footer_copyright":"Copyright \u00a9 2016 Canava. Theme by <a href=\"http:\/\/linethemes.com\" target=\"_blank\">Linethemes.<\/a>","blog_archive_sidebar_layout":"sidebar-right","blog_archive_sidebar":"sidebar-primary","blog_archive_post_excepts":true,"blog_archive_post_excepts_length":"250","blog_archive_show_post_meta":true,"blog_archive_readmore":true,"blog_archive_readmore_text":"Read more","blog_archive_pagination_style":"numeric","blog_posts_per_page":"5","blog_single_sidebar_layout":"sidebar-right","blog_single_sidebar":"sidebar-primary","blog_post_navigator_enabled":true,"blog_author_box_enabled":false,"blog_related_box_enabled":false,"blog_related_posts_style":"grid","blog_related_posts_count":3,"blog_related_posts_columns":3,"under_construction_enabled":false,"under_construction_page_id":0,"under_construction_allowed":["administrator"],"content_width":"1110px","pagetitle_parallax":true,"members_archive_sidebar_layout":"no-sidebar","members_archive_sidebar":0,"members_single_sidebar":"sidebar-0","members_posts_per_page":10,"members_single_sidebar_layout":"sidebar-right","nav_menu_locations":{"primary":6},"woocommerce_single_sidebar_layout":"sidebar-right","woocommerce_single_sidebar":"sidebar-56fcab0596e6b","woocommerce_products_per_page":"9","woocommerce_related_products_count":3,"woocommerce_archive_sidebar_layout":"sidebar-right","woocommerce_archive_sidebar":"sidebar-56fcab0596e6b","woocommerce_related_box_enabled":true,"projects_permalink_base":"gallery","projects_category_permalink_base":"gallery-category","projects_tag_permalink_base":"gallery-tag","projects_grid_columns":"3","projects_archive_sidebar_layout":"no-sidebar","projects_single_content_position":"right","projects_single_content_sticky":true,"projects_related_type":"recent","projects_related_columns_count":"3","projects_related_posts_count":"6","projects_single_sidebar_layout":"no-sidebar","projects_single_sidebar":"sidebar-primary","projects_single_gallery_type":"grid","projects_posts_per_page":"10","projects_archive_layout":"grid-alt","projects_related_title":"Related gallery","projects_single_gallery_columns":"3","header_cart_menu":true,"header_style":"header-v2","scheme2_color":"#21242b","scheme3_color":"#ffc952","content_bottom_widgets_enabled":true,"content_bottom_widgets_layout":{"active":"3","layout":[["12"],["6","6"],["4","4","4"],["2","2","2","6"]]},"projects_related_style":"grid-alt","projects_archive_pagination_style":"loadmore","logo_size":[0,0],"logo_retina_src":""}',
		true
	);
}



/**
 * This action will be used to override global theme
 * options as a specific options from page
 * 
 * @param   array  $options  Global options
 * @return  array
 */
function canava_override_theme_options( $options ) {
	global $post;

	if ( is_admin() ) return $options;

	// Blog options
	if ( is_search() || ( canava_current_posttype_is( 'post' ) && ( is_home() || is_archive() || is_single() ) ) ) {
		if ( is_single() ) {
			$options['sidebar_layout'] = $options['blog_single_sidebar_layout'];
			$options['sidebar_default'] = $options['blog_single_sidebar'];
		}
		else {
			$options['sidebar_layout'] = $options['blog_archive_sidebar_layout'];
			$options['sidebar_default'] = $options['blog_archive_sidebar'];
		}
	}

	// Page options
	elseif ( is_page() ) {
		$page_options_defaults = array(
			'sidebar_layout'            => 'default',
			'enable_custom_page_header' => false,
			'breadcrumb_enabled'        => 'default',
			'topbar_enabled'            => 'default'
		);
		$page_options = array_merge( $page_options_defaults, (array) get_post_meta( get_the_ID(), '_page_options', true ) );

		// Override layout option
		if ( $page_options['sidebar_layout'] !== 'default' ) {
			$options['sidebar_layout'] = $page_options['sidebar_layout'];
			$options['sidebar_default'] = $page_options['sidebar_default'];
		}

		// Override custom page title option
		if ( isset( $page_options['enable_custom_page_header'] ) && $page_options['enable_custom_page_header'] == true ) {
			$options['pagetitle_enabled'] = $page_options['pagetitle_enabled'];
			$options['pagetitle_background'] = $page_options['pagetitle_background'];
		}

		// Override breadcrumbs options
		if ( $page_options['breadcrumb_enabled'] != 'default' ) {
			$options['breadcrumb_enabled'] = $page_options['breadcrumb_enabled'] == 'enable';
		}

		// Override topbar options
		if ( $page_options['topbar_enabled'] != 'default' ) {
			$options['topbar_enabled'] = $page_options['topbar_enabled'] == 'enable';
		}

		// Override options from custom fields
		foreach ( get_post_custom( get_queried_object_id() ) as $name => $value ) {
			if ( isset( $options[ $name ] ) ) {
				$options[ $name ] = is_array( $value ) ? array_shift( $value ) : $value;;
			}
		}
	}
	
	return $options;
}

