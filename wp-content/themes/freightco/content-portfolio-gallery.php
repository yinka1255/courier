<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage FREIGHTCO
 * @since FREIGHTCO 1.0
 */

$freightco_blog_style = explode('_', freightco_get_theme_option('blog_style'));
$freightco_columns = empty($freightco_blog_style[1]) ? 2 : max(2, $freightco_blog_style[1]);
$freightco_post_format = get_post_format();
$freightco_post_format = empty($freightco_post_format) ? 'standard' : str_replace('post-format-', '', $freightco_post_format);
$freightco_animation = freightco_get_theme_option('blog_animation');
$freightco_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($freightco_columns).' post_format_'.esc_attr($freightco_post_format) ); ?>
	<?php echo (!freightco_is_off($freightco_animation) ? ' data-animation="'.esc_attr(freightco_get_animation_classes($freightco_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($freightco_image[1]) && !empty($freightco_image[2])) echo intval($freightco_image[1]) .'x' . intval($freightco_image[2]); ?>"
	data-src="<?php if (!empty($freightco_image[0])) echo esc_url($freightco_image[0]); ?>"
	>

	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	$freightco_image_hover = 'icon';	//freightco_get_theme_option('image_hover');
	if (in_array($freightco_image_hover, array('icons', 'zoom'))) $freightco_image_hover = 'dots';
	$freightco_components = freightco_array_get_keys_by_value(freightco_get_theme_option('meta_parts'));
	$freightco_counters = freightco_array_get_keys_by_value(freightco_get_theme_option('counters'));
	freightco_show_post_featured(array(
		'hover' => $freightco_image_hover,
		'thumb_size' => freightco_get_thumb_size( strpos(freightco_get_theme_option('body_style'), 'full')!==false || $freightco_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. (!empty($freightco_components)
										? freightco_show_post_meta(apply_filters('freightco_filter_post_meta_args', array(
											'components' => $freightco_components,
											'counters' => $freightco_counters,
											'seo' => false,
											'echo' => false
											), $freightco_blog_style[0], $freightco_columns))
										: '')
								. '<div class="post_description_content">'
									. get_the_excerpt()
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'freightco') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>