<?php
/**
 * WARNING: This file is part of the theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

$controls = array();

/**
 * General controls
 */
$controls['siteinfo_heading'] = array(
	'type'        => 'heading',
	'title'       => esc_html__( 'Site Information', 'canava' ),
	'description' => esc_html__( 'This section have basic information of your site, just change it to match with you need.', 'canava' ),
	'section'     => 'general',
	'class'       => 'no-border'
);

$controls['site_name'] = array(
	'type'     => 'text',
	'label'    => esc_html__( 'Site Name', 'canava' ),
	'section'  => 'general',
	'settings' => 'blogname'
);

$controls['site_desc'] = array(
	'type'     => 'text',
	'label'    => esc_html__( 'Site Tagline', 'canava' ),
	'section'  => 'general',
	'settings' => 'blogdescription'
);

$controls['static_frontpage_heading'] = array(
	'type'        => 'heading',
	'section'     => 'general',
	'class'       => 'no-border',
	'title'       => esc_html__( 'Static Front Page', 'canava' ),
	'description' => esc_html__( 'Switch this option to use static page or posts page on the home', 'canava' )
);

$controls['static_frontpage_enabled'] = array(
	'type'     => 'radio-buttons',
	'section'  => 'general',
	'settings' => 'show_on_front',
	'choices'  => array(
		'posts' => esc_html__( 'Posts', 'canava' ),
		'page'  => esc_html__( 'Static Page', 'canava' )
	)
);

$controls['static_frontpage'] = array(
	'type'     => 'dropdown-pages',
	'section'  => 'general',
	'label'    => esc_html__( 'Front Page', 'canava' ),
	'settings' => 'page_on_front'
);

$controls['posts_page'] = array(
	'type'     => 'dropdown-pages',
	'section'  => 'general',
	'label'    => esc_html__( 'Posts Page', 'canava' ),
	'settings' => 'page_for_posts'
);

$controls['general_misc_heading'] = array(
	'type'        => 'heading',
	'section'     => 'general',
	'class'       => 'no-border',
	'title'       => esc_html__( 'Misc', 'canava' ),
	'description' => esc_html__( 'This section have options that allow to adding bookmark icon, social icons, ...', 'canava' )
);

$controls['gotop_enabed'] = array(
	'type'    => 'switcher',
	'label'   => esc_html__( 'Enable Go Top Button', 'canava' ),
	'section' => 'general',
	'default' => true
);
$controls['loading_enabed'] = array(
	'type'    => 'switcher',
	'label'   => esc_html__( 'Enable Page Loading', 'canava' ),
	'section' => 'general',
	'default' => true
);

$controls['social_links'] = array(
	'type'    => 'social-icons',
	'label'   => esc_html__( 'Social Links', 'canava' ),
	'section' => 'general',
	'default' => array(
		'facebook' => 'https://facebook.com/thelinethemes',
		'twitter'  => 'https://twitter.com/linethemes'
	)
);

/**
 * Styles
 */
$controls['body_font_heading'] = array(
	'type'        => 'heading',
	'class'       => 'no-border',
	'section'     => 'typography',
	'title'       => esc_html__( 'Body Font', 'canava' ),
	'description' => esc_html__( 'You can modify the font family, size, color, ... for global content.', 'canava' )
);

$controls['body_font'] = array(
	'type'    => 'typography',
	'section' => 'typography',
	'default' => array(
		'family'      => 'Raleway',
		'size'        => 14,
		'style'       => 400,
		'color'       => '#333333'
	)
);

$controls['heading_font_heading'] = array(
	'type'        => 'heading',
	'class'       => 'no-border',
	'section'     => 'typography',
	'title'       => esc_html__( 'Heading Font', 'canava' ),
	'description' => esc_html__( 'You can modify the font options for your headings. h1, h2, h3, h4, ...', 'canava' )
);

$controls['heading_font'] = array(
	'type'    => 'typography',
	'section' => 'typography',
	'fields'  => array( 'family', 'style' ),
	'default' => array(
		'family'      => 'Montserrat',
		'style'       => 400,
		'color'       => '#333333'
	)
);

$controls['heading_fontsize'] = array(
	'type'    => 'dimension',
	'section' => 'typography',
	'class'   => 'no-label',
	'fields' => array(
		'h1' => esc_html__( 'H1 Font Size (px)', 'canava' ),
		'h2' => esc_html__( 'H2 Font Size (px)', 'canava' ),
		'h3' => esc_html__( 'H3 Font Size (px)', 'canava' ),
		'h4' => esc_html__( 'H4 Font Size (px)', 'canava' ),
		'h5' => esc_html__( 'H5 Font Size (px)', 'canava' ),
		'h6' => esc_html__( 'H6 Font Size (px)', 'canava' ),
	),
	'default' => array(
		0, 0, 0, 0, 0, 0
	)
);

$controls['menu_font_heading'] = array(
	'type'        => 'heading',
	'class'       => 'no-border',
	'section'     => 'typography',
	'title'       => esc_html__( 'Menu Font', 'canava' ),
	'description' => esc_html__( 'Select your custom font options for your main navigation menu.', 'canava' )
);

$controls['menu_font'] = array(
	'type'    => 'typography',
	'section' => 'typography',
	'default' => array(
		'family' => 'Montserrat',
		'size'   => 14,
		'style'  => 400,
		'color'  => '#333333'
	)
);

$controls['font_subsets_heading'] = array(
	'type'        => 'heading',
	'class'       => 'no-border',
	'section'     => 'typography',
	'title'       => esc_html__( 'Font Subsets', 'canava' ),
	'description' => esc_html__( 'Sometime you need to load extra font subsets for another languages, this options will allow to do it.', 'canava' )
);

$controls['cyrillic_subsets_enabled'] = array(
	'type'    => 'switcher',
	'section' => 'typography',
	'label'   => esc_html__( 'Cyrillic', 'canava' ),
	'default' => false
);

$controls['cyrillic_ext_subsets_enabled'] = array(
	'type'    => 'switcher',
	'section' => 'typography',
	'label'   => esc_html__( 'Cyrillic Extended', 'canava' ),
	'default' => false
);

$controls['greek_subsets_enabled'] = array(
	'type'    => 'switcher',
	'section' => 'typography',
	'label'   => esc_html__( 'Greek', 'canava' ),
	'default' => false
);
$controls['greek_ext_subsets_enabled'] = array(
	'type'    => 'switcher',
	'section' => 'typography',
	'label'   => esc_html__( 'Greek Extended', 'canava' ),
	'default' => false
);

$controls['vietnamese_subsets_enabled'] = array(
	'type'    => 'switcher',
	'section' => 'typography',
	'label'   => esc_html__( 'Vietnamese', 'canava' ),
	'default' => false
);

$controls['latin_ext_subsets_enabled'] = array(
	'type'    => 'switcher',
	'section' => 'typography',
	'label'   => esc_html__( 'Latin Extended', 'canava' ),
	'default' => false
);

$controls['devanagari_subsets_enabled'] = array(
	'type'    => 'switcher',
	'section' => 'typography',
	'label'   => esc_html__( 'Devanagari', 'canava' ),
	'default' => false
);

/**
 * Layout controls
 */
$controls['scheme_color_heading'] = array(
	'type'        => 'heading',
	'class'       => 'no-border',
	'section'     => 'layout',
	'title'       => esc_html__( 'Scheme Color', 'canava' ),
	'description' => esc_html__( 'Select the color that will be used for theme color.', 'canava' )
);

$controls['scheme_color'] = array(
	'type'    => 'color-picker',
	'label'   => esc_html__( 'Primary Color', 'canava' ),
	'section' => 'layout',
	'default' => '#32bfc0'
);

$controls['scheme2_color'] = array(
	'type'    => 'color-picker',
	'label'   => esc_html__( 'Second Color', 'canava' ),
	'section' => 'layout',
	'default' => '#21242b'
);

$controls['scheme3_color'] = array(
	'type'    => 'color-picker',
	'label'   => esc_html__( 'Third Color', 'canava' ),
	'section' => 'layout',
	'default' => '#ffc952'
);

$controls['layout_heading'] = array(
	'type'        => 'heading',
	'class'       => 'no-border',
	'section'     => 'layout',
	'title'       => esc_html__( 'Layout', 'canava' ),
	'description' => esc_html__( 'Choose between a full or a boxed layout to set how your website\'s layout will look like.', 'canava' )
);

$controls['layout_mode'] = array(
	'type'    => 'radio-images',
	'label'   => esc_html__( 'Display Style', 'canava' ),
	'section' => 'layout',
	'choices' => array(
		'layout-wide'  => array(
			'src'     => op_directory_uri() . '/assets/img/layout-wide.png',
			'tooltip' => esc_html__( 'Wide', 'canava' )
		),

		'layout-boxed'  => array(
			'src'     => op_directory_uri() . '/assets/img/layout-boxed.png',
			'tooltip' => esc_html__( 'Boxed', 'canava' )
		),
	),
	'default' => 'layout-wide'
);

$controls['boxed_background'] = array(
	'type'     => 'background',
	'label'    => esc_html__( 'Boxed Background', 'canava' ),
	'section'  => 'layout',
	'patterns' => canava_background_patterns(),
	'default'  => array(
		'type'     => 'none',
		'pattern'  => 'none',
		'color'    => '#fff',
		'image'    => '',
		'repeat'   => 'repeat',
		'position' => 'top-left',
		'style'    => 'scroll'
	)
);

$controls['content_width'] = array(
	'type'    => 'text',
	'label'   => esc_html__( 'Content Width', 'canava' ),
	'section' => 'layout',
	'default' => '1110px'
);

$controls['sidebar_heading'] = array(
	'type'        => 'heading',
	'class'       => 'no-border',
	'section'     => 'layout',
	'title'       => esc_html__( 'Sidebar', 'canava' ),
	'description' => esc_html__( 'Select the position of sidebar that you wish to display.', 'canava' )
);
$controls['sidebar_layout'] = array(
	'type'    => 'radio-images',
	'label'   => esc_html__( 'Sidebar Position', 'canava' ),
	'section' => 'layout',
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
	'default' => 'no-sidebar'
);

$controls['sidebar_default'] = array(
	'type'    => 'dropdown-sidebars',
	'label'   => esc_html__( 'Default Sidebar', 'canava' ),
	'section' => 'layout',
	'default' => 'sidebar-primary'
);
// End layout
	
$controls['pagetitle_heading'] = array(
	'type'        => 'heading',
	'class'       => 'no-border',
	'section'     => 'layout',
	'title'       => esc_html__( 'Page Title', 'canava' ),
	'description' => esc_html__( 'In this section you can turn on/off or modify style for the Page Title.', 'canava' )
);
$controls['pagetitle_enabled'] = array(
	'type'    => 'switcher',
	'label'   => esc_html__( 'Enable Page Title', 'canava' ),
	'section' => 'layout',
	'default' => true
);

$controls['pagetitle_background'] = array(
	'type'     => 'background',
	'section'  => 'layout',
	'label'    => esc_html__( 'Background', 'canava' ),
	'patterns' => canava_background_patterns(),
	'default'  => array(
		'type'     => 'none',
		'pattern'  => 'none',
		'color'    => '#f2f2f2',
		'image'    => '',
		'repeat'   => 'repeat',
		'position' => 'top-left',
		'style'    => 'scroll'
	)
);

$controls['pagetitle_parallax'] = array(
	'type'    => 'switcher',
	'label'   => esc_html__( 'Enable Parallax Effect', 'canava' ),
	'section' => 'layout',
	'default' => false
);

$controls['pagetitle_textcolor'] = array(
	'type'    => 'color-picker',
	'section' => 'layout',
	'label'   => esc_html__( 'Text Color', 'canava' ),
	'default' => '#333333'
);

$controls['breadcrumb_heading'] = array(
	'type'        => 'heading',
	'class'       => 'no-border',
	'section'     => 'layout',
	'title'       => esc_html__( 'Breadcrumb', 'canava' ),
	'description' => esc_html__( 'Change settings for the breadcrumb.', 'canava' )
);
$controls['breadcrumb_enabled'] = array(
	'type'    => 'switcher',
	'label'   => esc_html__( 'Enable Breadcrumbs', 'canava' ),
	'section' => 'layout',
	'default' => true
);

$controls['breadcrumb_prefix'] = array(
	'type'    => 'text',
	'label'   => esc_html__( 'Breadcrumb Prefix', 'canava' ),
	'section' => 'layout',
	'default' => esc_html__( 'You are here:', 'canava' )
);

$controls['breadcrumb_separator'] = array(
	'type'    => 'text',
	'label'   => esc_html__( 'Breadcrumb Separator', 'canava' ),
	'section' => 'layout',
	'default' => '/'
);

/**
 * Header
 */
$controls['logo_heading'] = array(
	'type'        => 'heading',
	'class'       => 'no-border',
	'section'     => 'header',
	'title'       => esc_html__( 'Custom Logo', 'canava' ),
	'description' => esc_html__( 'In this section You can upload your own custom logo, change the way your logo can be displayed', 'canava' )
);

// Logo options
$controls['logo_image'] = array(
	'type'    => 'switcher',
	'label'   => esc_html__( 'Use Logo Image', 'canava' ),
	'section' => 'header',
	'default' => true
);

$controls['show_tagline'] = array(
	'type'    => 'switcher',
	'label'   => esc_html__( 'Display Site Tagline', 'canava' ),
	'section' => 'header',
	'default' => false
);

$controls['logo_src'] = array(
	'type'    => 'media-picker',
	'label'   => esc_html__( 'Logo', 'canava' ),
	'section' => 'header',
	'default' => get_template_directory_uri() . '/assets/img/logo.png'
);

$controls['logo_retina_src'] = array(
	'type'    => 'media-picker',
	'label'   => esc_html__( 'Logo For Retina', 'canava' ),
	'section' => 'header',
	'default' => get_template_directory_uri() . '/assets/img/logo.png'
);

$controls['logo_size'] = array(
	'type'    => 'dimension',
	'label'   => esc_html__( 'Logo Size', 'canava' ),
	'section' => 'header',
	'fields'  => array(
		'width'  => esc_html__( 'Width (px)', 'canava' ),
		'height' => esc_html__( 'Height (px)', 'canava' )
	),
	'default' => array( 0, 0 )
);

$controls['logo_margin'] = array(
	'type'    => 'dimension',
	'label'   => esc_html__( 'Logo Margin', 'canava' ),
	'section' => 'header',
	'fields'  => array(
		'top'    => esc_html__( 'Top (px)', 'canava' ),
		'bottom' => esc_html__( 'Bottom (px)', 'canava' )
	),
	'default' => array( 25, 25 )
);

$controls['navigator_heading'] = array(
	'type'        => 'heading',
	'class'       => 'no-border',
	'section'     => 'header',
	'title'       => esc_html__( 'Navigator', 'canava' ),
	'description' => esc_html__( 'Just select your menu that you wish assign it to the location on the theme', 'canava' )
);

// Navigator
$menus     = wp_get_nav_menus();
$locations = get_registered_nav_menus();

$choices = array( 0 => esc_html__( '&dash; Select &dash;', 'canava' ) );

if ( $menus ) {
	foreach ( $menus as $menu ) {
		$choices[ $menu->term_id ] = wp_html_excerpt( $menu->name, 40, '&hellip;' );
	}
}

foreach ( $locations as $location => $description ) {
	$menu_setting_id = "nav_menu_locations[{$location}]";

	$controls["menu_location_{$location}"] = array(
		'label'    => $description,
		'section'  => 'header',
		'type'     => 'dropdown',
		'choices'  => $choices,
		'settings' => $menu_setting_id
	);
}

$controls['header_heading'] = array(
	'type'        => 'heading',
	'class'       => 'no-border',
	'section'     => 'header',
	'title'       => esc_html__( 'Header Options', 'canava' ),
	'description' => esc_html__( 'Toggle sticky header feature and turn on/off extra menu icons', 'canava' )
);

$controls['header_style'] = array(
	'type' => 'dropdown',
	'section' => 'header',
	'label'   => esc_html__( 'Header Style', 'canava' ),
	'choices' => array(
		'header-v1' => esc_html__( 'Classic', 'canava' ),
		'header-v2' => esc_html__( 'Modern', 'canava' ),
		'header-v3' => esc_html__( 'Transparent', 'canava' ),
		'header-v4' => esc_html__( 'Header Widget', 'canava' )
	)
);

$controls['header_sticky'] = array(
	'type'    => 'switcher',
	'section' => 'header',
	'label'   => esc_html__( 'Enable Sticky Header', 'canava' )
);

$controls['header_searchbox'] = array(
	'type'    => 'switcher',
	'section' => 'header',
	'label'   => esc_html__( 'Show Search Menu', 'canava' ),
	'default' => true
);

$controls['header_cart_menu'] = array(
	'type'    => 'switcher',
	'section' => 'header',
	'label'   => esc_html__( 'Show Cart Menu', 'canava' ),
	'default' => true
);

$controls['topbar_heading'] = array(
	'type'        => 'heading',
	'class'       => 'no-border',
	'section'     => 'header',
	'title'       => esc_html__( 'Top Bar', 'canava' ),
	'description' => esc_html__( 'Turn on/off the top bar and change it styles', 'canava' )
);
$controls['topbar_enabled'] = array(
	'type'    => 'switcher',
	'label'   => esc_html__( 'Enable Topbar', 'canava' ),
	'section' => 'header',
	'default' => true
);

$controls['topbar_content'] = array(
	'type'    => 'textarea',
	'label'   => esc_html__( 'Content', 'canava' ),
	'section' => 'header',
	'default' => esc_html__( '<i class="fa fa-phone"></i> Call Us Today! 1.555.555.555 <span class="spacer"></span> <i class="fa fa-envelope-o"></i> support@linethemes.com', 'canava' )
);

$controls['topbar_social_links_enabled'] = array(
	'type'    => 'switcher',
	'label'   => esc_html__( 'Enable Social Links', 'canava' ),
	'section' => 'header',
	'default' => true
);

/**
 * Content bottom widgets
 */
$controls['content_bottom_widgets_heading'] = array(
	'type'        => 'heading',
	'class'       => 'no-border',
	'section'     => 'footer',
	'title'       => esc_html__( 'Content Bottom Widgets', 'canava' ),
	'description' => esc_html__( 'This section allow to change the layout and styles of content-bottom widgets area to match as you need.', 'canava' )
);
$controls['content_bottom_widgets_enabled'] = array(
	'type'    => 'switcher',
	'label'   => esc_html__( 'Enable Content Bottom Widgets', 'canava' ),
	'section' => 'footer',
	'default' => true
);
$controls['content_bottom_widgets_layout'] = array(
	'type'    => 'widgets-layout',
	'label'   => esc_html__( 'Widgets Layout', 'canava' ),
	'section' => 'footer',
	'max'     => 4,
	'default' => array(
		'active' => 3,
		'layout' => array(
			array( 12 ),
			array( 6, 6 ),
			array( 4, 4, 4 ),
			array( 3, 3, 3, 3 )
		)
	)
);

/**
 * Footer
 */
$controls['footer_widgets_heading'] = array(
	'type'        => 'heading',
	'class'       => 'no-border',
	'section'     => 'footer',
	'title'       => esc_html__( 'Footer Widgets', 'canava' ),
	'description' => esc_html__( 'This section allow to change the layout and styles of footer widgets to match as you need.', 'canava' )
);

$controls['footer_widgets_enabled'] = array(
	'type'    => 'switcher',
	'label'   => esc_html__( 'Enable Footer Widgets', 'canava' ),
	'section' => 'footer',
	'default' => true
);

$controls['footer_widgets_layout'] = array(
	'type'    => 'widgets-layout',
	'label'   => esc_html__( 'Widgets Layout', 'canava' ),
	'max'     => 4,
	'section' => 'footer',
	'default' => array(
		'active' => 3,
		'layout' => array(
			array( 12 ),
			array( 6, 6 ),
			array( 4, 4, 4 ),
			array( 3, 3, 3, 3 )
		)
	)
);

$controls['footer_widgets_background'] = array(
	'type'     => 'background',
	'section'  => 'footer',
	'label'    => esc_html__( 'Widgets Background', 'canava' ),
	'patterns' => canava_background_patterns(),
	'default'  => array(
		'type'     => 'none',
		'pattern'  => 'none',
		'color'    => '#1a1a1a',
		'image'    => '',
		'repeat'   => 'repeat',
		'position' => 'top-left',
		'style'    => 'scroll'
	)
);

$controls['footer_widgets_textcolor'] = array(
	'type'    => 'color-picker',
	'section' => 'footer',
	'label'   => esc_html__( 'Text Color', 'canava' ),
	'default' => '#666666'
);

$controls['footer_heading'] = array(
	'type'        => 'heading',
	'class'       => 'no-border',
	'section'     => 'footer',
	'title'       => esc_html__( 'Custom Footer', 'canava' ),
	'description' => esc_html__( 'You can change the copyright text, show/hide the social icons on the footer.', 'canava' )
);

$controls['footer_social_links_enabled'] = array(
	'type'    => 'switcher',
	'label'   => esc_html__( 'Enable Social Links', 'canava' ),
	'section' => 'footer',
	'default' => true
);

$controls['footer_copyright'] = array(
	'type'    => 'textarea',
	'label'   => esc_html__( 'Copyright', 'canava' ),
	'section' => 'footer'
);

/**
 * Blog
 */
$controls['blog_list_heading'] = array(
	'type'        => 'heading',
	'class'       => 'no-border',
	'section'     => 'blog',
	'title'       => esc_html__( 'Blog List', 'canava' ),
	'description' => esc_html__( 'All options in this section will be used to make style for blog page.', 'canava' )
);

$controls['blog_archive_sidebar_layout'] = array(
	'type'    => 'radio-images',
	'label'   => esc_html__( 'List Sidebar Position', 'canava' ),
	'section' => 'blog',
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

$controls['blog_archive_sidebar'] = array(
	'type'    => 'dropdown-sidebars',
	'section' => 'blog',
	'label'   => esc_html__( 'Blog List Sidebar', 'canava' ),
	'default' => 'sidebar-primary'
);

$controls['blog_archive_post_excepts'] = array(
	'type'    => 'switcher',
	'label'   => esc_html__( 'Auto Post Excepts', 'canava' ),
	'section' => 'blog',
	'default' => false
);

$controls['blog_archive_post_excepts_length'] = array(
	'type'    => 'text',
	'label'   => esc_html__( 'Post Excepts Length', 'canava' ),
	'section' => 'blog',
	'default' => 40
);

$controls['blog_archive_show_post_meta'] = array(
	'type'    => 'switcher',
	'label'   => esc_html__( 'Show Post Meta', 'canava' ),
	'section' => 'blog',
	'default' => true
);

$controls['blog_archive_readmore'] = array(
	'type'    => 'switcher',
	'label'   => esc_html__( 'Show Read More', 'canava' ),
	'section' => 'blog',
	'default' => true
);

$controls['blog_archive_readmore_text'] = array(
	'type'    => 'text',
	'label'   => esc_html__( 'Read More Text', 'canava' ),
	'section' => 'blog',
	'default' => esc_html__( 'Continue Read &rarr;', 'canava' )
);

$controls['blog_archive_pagination_style'] = array(
	'type'    => 'radio-images',
	'label'   => esc_html__( 'Pagination Style', 'canava' ),
	'section' => 'blog',
	'default' => 'numeric',
	'choices' => array(
		'pager' => array(
			'src' => op_directory_uri() . '/assets/img/paging-pager.png',
			'tooltip' => esc_html__( 'Pager', 'canava' )
		),
		'numeric' => array(
			'src' => op_directory_uri() . '/assets/img/paging-numeric.png',
			'tooltip' => esc_html__( 'Numeric', 'canava' )
		),
		'pager-numeric' => array(
			'src' => op_directory_uri() . '/assets/img/paging-pager-numeric.png',
			'tooltip' => esc_html__( 'Pager & Numeric', 'canava' )
		),
		'loadmore' => array(
			'src' => op_directory_uri() . '/assets/img/paging-loadmore.png',
			'tooltip' => esc_html__( 'Load More', 'canava' )
		)
	)
);

$controls['blog_posts_per_page'] = array(
	'type'     => 'spinner',
	'section'  => 'blog',
	'label'    => esc_html__( 'Posts Per Page', 'canava' )
);

$controls['blog_single_heading'] = array(
	'type'        => 'heading',
	'class'       => 'no-border',
	'section'     => 'blog',
	'title'       => esc_html__( 'Blog Single', 'canava' ),
	'description' => esc_html__( 'Also, you can change the style for blog single to make your site unique.', 'canava' )
);

$controls['blog_single_sidebar_layout'] = array(
	'type'    => 'radio-images',
	'label'   => esc_html__( 'Single Sidebar Position', 'canava' ),
	'section' => 'blog',
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

$controls['blog_single_sidebar'] = array(
	'type'    => 'dropdown-sidebars',
	'section' => 'blog',
	'label'   => esc_html__( 'Blog Single Sidebar', 'canava' ),
	'default' => 'sidebar-primary'
);

$controls['blog_post_navigator_enabled'] = array(
	'type'    => 'switcher',
	'label'   => esc_html__( 'Show Post Navigator', 'canava' ),
	'section' => 'blog',
	'default' => true
);

$controls['blog_author_box_enabled'] = array(
	'type'    => 'switcher',
	'label'   => esc_html__( 'Show Author Box', 'canava' ),
	'section' => 'blog',
	'default' => true
);

$controls['blog_related_box_enabled'] = array(
	'type'    => 'switcher',
	'label'   => esc_html__( 'Show Related Posts', 'canava' ),
	'section' => 'blog',
	'default' => true
);

$controls['blog_related_posts_style'] = array(
	'type'    => 'radio-images',
	'label'   => esc_html__( 'Related Posts Style', 'canava' ),
	'section' => 'blog',
	'choices' => array(
		'list' => array(
			'src' => op_directory_uri() . '/assets/img/related-list.png',
			'tooltip' => esc_html__( 'Simple List', 'canava' )
		),
		'grid' => array(
			'src' => op_directory_uri() . '/assets/img/blog-grid.png',
			'tooltip' => esc_html__( 'Grid', 'canava' )
		),
		'masonry' => array(
			'src' => op_directory_uri() . '/assets/img/blog-masonry.png',
			'tooltip' => esc_html__( 'Masonry Grid', 'canava' )
		),
		'carousel' => array(
			'src' => op_directory_uri() . '/assets/img/related-slider.png',
			'tooltip' => esc_html__( 'Carousel', 'canava' )
		)
	),
	'default' => 'carousel'
);

$controls['blog_related_posts_columns'] = array(
	'type'    => 'dropdown',
	'section' => 'blog',
	'label'   => esc_html__( 'Columns Of Related Posts', 'canava' ),
	'default' => 3,
	'choices' => array(
		2 => esc_html__( '2 Columns', 'canava' ),
		3 => esc_html__( '3 Columns', 'canava' ),
		4 => esc_html__( '4 Columns', 'canava' )
	)
);

$controls['blog_related_posts_count'] = array(
	'type'    => 'spinner',
	'section' => 'blog',
	'label'   => esc_html__( 'Number Of Related Posts', 'canava' ),
	'min'     => 1,
	'default' => 4
);

/**
 * Member
 */
$controls['members_list_heading'] = array(
	'type'        => 'heading',
	'class'       => 'no-border',
	'section'     => 'members',
	'title'       => esc_html__( 'Member List', 'canava' ),
	'description' => esc_html__( 'Change options in this section to custom style for portfolio listing page.', 'canava' )
);

$controls['members_archive_sidebar_layout'] = array(
	'type'    => 'radio-images',
	'label'   => esc_html__( 'List Sidebar Position', 'canava' ),
	'section' => 'members',
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

$controls['members_archive_sidebar'] = array(
	'type'    => 'dropdown-sidebars',
	'section' => 'members',
	'label'   => esc_html__( 'Member List Sidebar', 'canava' ),
	'default' => 'sidebar-primary'
);

$controls['members_archive_pagination_style'] = array(
	'type'    => 'radio-images',
	'label'   => esc_html__( 'Pagination Style', 'canava' ),
	'section' => 'members',
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

$controls['members_posts_per_page'] = array(
	'type'     => 'spinner',
	'section'  => 'members',
	'label'    => esc_html__( 'Posts Per Page', 'canava' )
);

$controls['members_single_heading'] = array(
	'type'        => 'heading',
	'class'       => 'no-border',
	'section'     => 'members',
	'title'       => esc_html__( 'Single Member', 'canava' ),
	'description' => esc_html__( 'Change the layout, sidebar, navigator, ... for the single portfolio page.', 'canava' )
);

$controls['members_single_sidebar_layout'] = array(
	'type'    => 'radio-images',
	'label'   => esc_html__( 'Single Sidebar Position', 'canava' ),
	'section' => 'members',
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

$controls['members_single_sidebar'] = array(
	'type'    => 'dropdown-sidebars',
	'section' => 'members',
	'label'   => esc_html__( 'Single Member Sidebar', 'canava' ),
	'default' => 'sidebar-primary'
);

/**
 * Portfolio
 */
$controls['portfolio_page_title_enabled'] = array(
	'type'    => 'switcher',
	'section' => 'portfolio',
	'label'   => esc_html__( 'Enable Page Title', 'canava' ),
	'default' => true
);

$controls['portfolio_page_title'] = array(
	'type'    => 'text',
	'section' => 'portfolio',
	'label'   => esc_html__( 'Custom Page Title', 'canava' ),
	'default' => esc_html__( 'Portfolio', 'canava' )
);

$controls['portfolio_list_heading'] = array(
	'type'        => 'heading',
	'class'       => 'no-border',
	'section'     => 'portfolio',
	'title'       => esc_html__( 'Portfolio List', 'canava' ),
	'description' => esc_html__( 'Change options in this section to custom style for portfolio listing page.', 'canava' )
);

$controls['portfolio_archive_sidebar_layout'] = array(
	'type'    => 'radio-images',
	'label'   => esc_html__( 'List Sidebar Position', 'canava' ),
	'section' => 'portfolio',
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

$controls['portfolio_archive_sidebar'] = array(
	'type'    => 'dropdown-sidebars',
	'section' => 'portfolio',
	'label'   => esc_html__( 'Portfolio List Sidebar', 'canava' ),
	'default' => 'sidebar-primary'
);

$controls['portfolio_archive_layout'] = array(
	'type'    => 'radio-images',
	'label'   => esc_html__( 'List Layout', 'canava' ),
	'section' => 'portfolio',
	'choices' => array(
		'grid' => array(
			'src' => op_directory_uri() . '/assets/img/blog-grid.png',
			'tooltip' => esc_html__( 'Grid', 'canava' )
		),
		'masonry' => array(
			'src' => op_directory_uri() . '/assets/img/blog-masonry.png',
			'tooltip' => esc_html__( 'Masonry Grid', 'canava' )
		),
		'no-margin' => array(
			'src' => op_directory_uri() . '/assets/img/portfolio-no-margin.png',
			'tooltip' => esc_html__( 'Grid No Margin', 'canava' )
		)
	),
	'default' => 'grid'
);

$controls['portfolio_grid_columns'] = array(
	'type'    => 'dropdown',
	'section' => 'portfolio',
	'label'   => esc_html__( 'Grid Columns', 'canava' ),
	'default' => 3,
	'choices' => array(
		2 => esc_html__( '2 Columns', 'canava' ),
		3 => esc_html__( '3 Columns', 'canava' ),
		4 => esc_html__( '4 Columns', 'canava' ),
		5 => esc_html__( '5 Columns', 'canava' ),
	)
);

$controls['portfolio_archive_filter'] = array(
	'type'    => 'switcher',
	'section' => 'portfolio',
	'label'   => esc_html__( 'Show Items Filter', 'canava' ),
	'default' => true
);

$controls['portfolio_archive_pagination_style'] = array(
	'type'    => 'radio-images',
	'label'   => esc_html__( 'Pagination Style', 'canava' ),
	'section' => 'portfolio',
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

$controls['portfolio_posts_per_page'] = array(
	'type'     => 'spinner',
	'section'  => 'portfolio',
	'label'    => esc_html__( 'Posts Per Page', 'canava' ),
	'default'  => get_option( 'posts_per_page' )
);

$controls['portfolio_single_heading'] = array(
	'type'        => 'heading',
	'class'       => 'no-border',
	'section'     => 'portfolio',
	'title'       => esc_html__( 'Single Portfolio', 'canava' ),
	'description' => esc_html__( 'Change the layout, sidebar, navigator, ... for the single portfolio page.', 'canava' )
);

$controls['portfolio_single_sidebar_layout'] = array(
	'type'    => 'radio-images',
	'label'   => esc_html__( 'Single Sidebar Position', 'canava' ),
	'section' => 'portfolio',
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

$controls['portfolio_single_sidebar'] = array(
	'type'    => 'dropdown-sidebars',
	'section' => 'portfolio',
	'label'   => esc_html__( 'Single Portfolio Sidebar', 'canava' ),
	'default' => 'sidebar-primary'
);

$controls['portfolio_post_navigator_enabled'] = array(
	'type'    => 'switcher',
	'label'   => esc_html__( 'Show Single Navigator', 'canava' ),
	'section' => 'portfolio',
	'default' => true
);

$controls['portfolio_post_navigator_sticky'] = array(
	'type'    => 'switcher',
	'label'   => esc_html__( 'Single Sticky Navigator', 'canava' ),
	'section' => 'portfolio',
	'default' => false
);

$controls['portfolio_related_box_enabled'] = array(
	'type'    => 'switcher',
	'label'   => esc_html__( 'Show Related Portfolios', 'canava' ),
	'section' => 'portfolio',
	'default' => true
);

$controls['portfolio_related_style'] = array(
	'type'    => 'dropdown',
	'section' => 'portfolio',
	'label'   => esc_html__( 'Related Portfolio Style', 'canava' ),
	'default' => 'grid',
	'choices' => array(
		'grid'      => esc_html__( 'Grid', 'canava' ),
		'masonry'   => esc_html__( 'Grid Masonry', 'canava' ),
		'no-margin' => esc_html__( 'Grid No Margin', 'canava' ),
		'carousel'  => esc_html__( 'Carousel', 'canava' ),
		'carousel-no-margin'  => esc_html__( 'Carousel No Margin', 'canava' )
	)
);

$controls['portfolio_related_columns_count'] = array(
	'type'    => 'dropdown',
	'section' => 'portfolio',
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

$controls['portfolio_related_posts_count'] = array(
	'type'    => 'spinner',
	'section' => 'portfolio',
	'label'   => esc_html__( 'Number Of Related Portfolios', 'canava' ),
	'min'     => 1,
	'default' => 4
);

/**
 * Under Construction
 */
$controls['under_construction_enabled'] = array(
	'type'    => 'switcher',
	'label'   => esc_html__( 'Enable Under Construction', 'canava' ),
	'section' => 'under-construction',
	'default' => false
);

$controls['under_construction_page_id'] = array(
	'type'     => 'dropdown-pages',
	'section'  => 'under-construction',
	'label'    => esc_html__( 'Under Construction Page', 'canava' )
);

$controls['under_construction_allowed'] = array(
	'type'    => 'checkboxes',
	'section' => 'under-construction',
	'label'   => esc_html__( 'Role-based Access Permission', 'canava' ),
	'choices' => function() {
		$choices = array();

		foreach ( get_editable_roles() as $id => $params )
			$choices[$id] = $params['name'];
		
		return $choices;
	},

	'default' => array( 'administrator', 'editor' )
);

return $controls;
