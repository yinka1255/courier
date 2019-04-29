<?php
/**
 * WARNING: This file is part of the theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

// Don't print empty markup if there's only one page.
if ( $GLOBALS['wp_query']->max_num_pages < 2 ) return;

$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
$pagenum_link = html_entity_decode( get_pagenum_link() );
$query_args   = array();
$url_parts    = explode( '?', $pagenum_link );

if ( isset( $url_parts[1] ) ) {
	wp_parse_str( $url_parts[1], $query_args );
}

$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

// Set up paginated links.
$links = paginate_links( array(
	'base'     => $pagenum_link,
	'format'   => $format,
	'total'    => $GLOBALS['wp_query']->max_num_pages,
	'current'  => $paged,
	'mid_size' => 1,
	'add_args' => array_map( 'urlencode', $query_args ),
	'prev_text' => esc_html__( '&larr; Previous', 'canava' ),
	'next_text' => esc_html__( 'Next &rarr;', 'canava' ),
) );

$numeric_links = paginate_links( array(
	'base'     => $pagenum_link,
	'format'   => $format,
	'total'    => $GLOBALS['wp_query']->max_num_pages,
	'current'  => $paged,
	'mid_size' => 1,
	'add_args' => array_map( 'urlencode', $query_args ),
	'prev_next' => false
) );

$next_link = get_next_posts_link( esc_html__( 'Next &rarr;', 'canava' ) );
$prev_link = get_previous_posts_link( esc_html__( '&larr; Previous', 'canava' ) );
$more_link = get_next_posts_link( esc_html__( 'Load More', 'canava' ) );

$paging_style = op_option( 'blog_archive_pagination_style' );
?>

<?php if ( $paging_style == 'pager' && ! ( empty( $next_link ) && empty( $prev_link ) ) ): ?>

	<nav class="navigation paging-navigation pager" role="navigation">
		<div class="pagination loop-pagination">
			<?php echo wp_kses_post( $prev_link ) ?>
			<?php echo wp_kses_post( $next_link ) ?>
		</div>
	</nav>

<?php elseif ( $paging_style == 'numeric' && ! empty( $numeric_links ) ): ?>

	<nav class="navigation paging-navigation numeric" role="navigation">
		<div class="pagination loop-pagination">
			<?php echo wp_kses_post( $numeric_links ) ?>
		</div>
	</nav>

<?php elseif ( $paging_style == 'loadmore' && ! empty( $next_link ) ): ?>
	
	<nav class="navigation paging-navigation loadmore" role="navigation">
		<div class="pagination loop-pagination">
			<?php echo wp_kses_post( $more_link ) ?>
		</div>
	</nav>

<?php elseif ( ! empty( $links ) ): ?>

	<nav class="navigation paging-navigation pager-numeric" role="navigation">
		<div class="pagination loop-pagination">
			<?php echo wp_kses_post( $links ) ?>
		</div>
	</nav>

<?php endif ?>
