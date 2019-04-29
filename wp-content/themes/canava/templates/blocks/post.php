<?php
/**
 * WARNING: This file is part of the theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

global $_post_options, $_post_thumbnail_size;

$_post_options = get_post_meta( get_the_ID(), '_post_options', true );
$_post_thumbnail_size = 'full';

if ( ! is_single() ) {
	switch ( op_option( 'blog_archive_layout' ) ) {
		case 'medium':
			$_post_thumbnail_size = 'portfolio-medium-crop';
			break;

		case 'grid':
			$_post_thumbnail_size = 'blog-medium-crop';
			break;

		case 'masonry':
			$_post_thumbnail_size = 'blog-medium';
			break;

		case 'large':
			$_post_thumbnail_size = 'blog-large';
			break;
	}
}
?>
<article <?php post_class() ?>>
	<div class="entry-wrapper">
		<?php get_template_part( 'templates/blocks/post/cover', get_post_format() ) ?>
		
		<?php if ( op_current_post_type() != 'page' ): ?>
			<h4 class="entry-time">
				<span class="entry-month">
					<?php echo esc_html( get_the_date( 'M' ) ) ?>
				</span>
				<span class="entry-day">
					<?php echo esc_html( get_the_date( 'd' ) ) ?>
				</span>
			</h4>

			<header class="entry-header">
				<?php if ( ! is_single() || op_option( 'pagetitle_enabled', true ) == false ): ?>
					<?php canava_post_title() ?>
				<?php endif ?>
				
				<?php canava_post_meta() ?>
			</header>

		<?php endif ?>

		<div class="entry-content" itemprop="text">
			
			<?php
			canava_post_content();
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'canava' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
			?>

		</div>
		<!-- /entry-content -->

		<?php if ( is_single() && get_the_tags() ): ?>
			<div class="entry-footer">
				<div class="entry-tags">
					<strong><?php esc_html_e( 'Tags', 'canava' ) ?></strong>
					<?php the_tags( '', ' ' ); ?>
				</div>
			</div>
			<!-- /.entry-footer -->
		<?php endif ?>
	</div>
	<!-- /.entry-wrapper -->
</article>
<!-- /#post-<?php echo get_the_ID() ?> -->
