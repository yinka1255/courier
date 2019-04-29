<?php
/**
 * WARNING: This file is part of the theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

if ( ! function_exists( 'themekit_shortcode_posts' ) )
	return;

$args = array(
	'limit'         => op_option( 'blog_related_posts_count', 4 ),
	'layout'        => op_option( 'blog_related_posts_style', 'carousel' ),
	'grid_columns'  => op_option( 'blog_related_posts_columns', 3 ),
	'hide_readmore' => 'yes',
	'exclude'       => get_the_ID()
);

$tags = (array) get_the_tags();
$categories = (array) get_the_category();

if ( empty( $tags ) && empty( $categories ) )
	return;

$args['tag']      = wp_list_pluck( $tags, 'slug' );
$args['category'] = wp_list_pluck( $categories, 'slug' );
$related_content  = themekit_shortcode_posts( $args );

if ( empty( $related_content ) )
	return;
?>
<section class="box related-posts-box">
	<div class="box-wrapper">
		<h3 class="box-title"><?php esc_html_e( 'Related Posts', 'canava' ) ?></h3>
		<div class="box-content">
			<?php echo wp_kses_post( $related_content ) ?>
		</div>
	</div>
</section>
