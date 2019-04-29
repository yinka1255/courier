<?php
/**
 * WARNING: This file is part of the theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();



if ( ! function_exists( 'canava_head_title' ) ) {
	add_filter( 'wp_title', 'canava_head_title', 10, 2 );

	/**
	 * Format the title that will display on the head
	 * of HTML document
	 * 
	 * @param   string  $title  Title
	 * @param   string  $sep    Title separator
	 * 
	 * @return  string
	 */
	function canava_head_title( $title, $sep ) {
		$version = get_bloginfo( 'version' );

		if ( version_compare( $version, '4.1', '>=' ) )
			return $title;

		if ( is_feed() )
			return $title;

		global $paged, $page;

		// Add the site name.
		$title = get_bloginfo( 'name', 'display' );

		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title = "$title $sep $site_description";
		}

		// Add a page number if necessary.
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'canava' ), max( $paged, $page ) );
		}

		return $title;
	}
}



if ( ! function_exists( 'canava_body_classes' ) ) {
	add_filter( 'body_class', 'canava_body_classes' );

	function canava_body_classes( $classes ) {
		$classes[] = 'page-loading';
		$classes[] = op_option( 'layout_mode' );
		$classes[] = op_option( 'sidebar_layout' );

		if ( op_option( 'topbar_enabled' ) )
			$classes[] = 'has-topbar';

		if ( ( is_single() && op_option( 'blog_post_navigator_sticky' ) ) ||
			 ( is_singular( 'portfolio' ) && op_option( 'portfolio_post_navigator_sticky' ) ) )
			$classes[] = 'sticky-post-nav';

		if ( is_page_template( 'templates/template-blog.php' ) || ( canava_current_posttype_is( 'post' ) && ( is_home() || is_archive() ) ) ) {
			$blog_layout = op_option( 'blog_archive_layout' );
			$classes[] = 'blog blog-' . $blog_layout;

			if ( $blog_layout == 'grid' || $blog_layout == 'masonry' ) {
				$columns = op_option( 'blog_grid_columns', 2 );
				$column_names = array(
					2 => 'blog-two-columns',
					3 => 'blog-three-columns',
					4 => 'blog-four-columns'
				);

				$classes[] = $column_names[$columns];
			}

			if ( op_option( 'blog_archive_show_post_meta' ) ) {
				$classes[] = 'blog-has-postmeta';
			}
		}

		/**
		 * Header styles
		 */
		$classes[] = op_option( 'header_style' );

		/**
		 * Portfolio template
		 */
		if ( is_page_template( 'templates/portfolio.php' ) )
			$classes[] = 'page-portfolio';

		/**
		 * Full-Width layout template
		 */
		elseif ( is_page_template( 'templates/template-fullwidth.php' ) )
			$classes[] = 'page-fullwidth';
		
		/**
		 * Blank layout template
		 */
		elseif ( is_page_template( 'templates/template-blank.php' ) ) {
			$classes[] = 'page-blank';
			$classes[] = 'page-fullwidth';
		}

		if ( is_page() ) {
			$classes[] = pathinfo( get_page_template_slug( get_the_ID() ), PATHINFO_FILENAME );
		}

		if ( op_option( 'pagetitle_enabled' ) == false ) {
			$classes[] = 'pageheader-hidden';
		}

		return $classes;
	}
}



if ( ! function_exists( 'canava_post_classes' ) ) {
	add_filter( 'post_class', 'canava_post_classes' );

	function canava_post_classes( $classes ) {
		if ( ! has_post_thumbnail() )
			$classes[] = 'no-post-thumbnail';

		return $classes;
	}
}



if ( ! function_exists( 'canava_override_page_menu' ) ) {
	add_filter( 'wp_nav_menu_args', 'canava_override_page_menu' );

	/**
	 * Override menu parameters for single page
	 * 
	 * @param   array  $params  Menu parameters
	 * @return  array
	 */
	function canava_override_page_menu( $params ) {
		if ( is_page() ) {
			$page_options = get_post_meta( get_the_ID(), '_page_options', true );

			// Override navigator options
			if ( isset( $page_options["menu_location_{$params['theme_location']}"] ) &&
				$page_options["menu_location_{$params['theme_location']}"] != 'default' ) {
				$params['menu'] = (int) $page_options["menu_location_{$params['theme_location']}"];
			}
		}

		return $params;
	}
}



if ( ! function_exists( 'canava_extra_menu_items' ) ) {
	add_action( 'theme/after_primary_menu', 'canava_extra_menu_items' );

	/**
	 * Register extra menu items
	 *
	 * @param   array  $args  Callback arguments
	 * @return  void
	 */
	function canava_extra_menu_items( $args ) {
		if ( $args['env'] == 'desktop' ) {
			get_template_part( 'templates/blocks/header/extra-menus' );
		}
	}
}



if ( ! function_exists( 'canava_fix_post_title' ) ) {
	add_filter( 'the_title', 'canava_fix_post_title', 10, 2 );

	/**
	 * Auto generate title for the post
	 * 
	 * @param   string  $title  Post title
	 * @param   int     $id     Post ID
	 * @return  string
	 */
	function canava_fix_post_title( $title, $id ) {
		$post = get_post( $id );

		if ( empty( $post->post_title ) && $post->post_type == 'post' )
			$title.= ' ' . get_the_date();

		return $title;
	}	
}
