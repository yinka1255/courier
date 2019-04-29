<?php
/**
 * WARNING: This file is part of the theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();
?>

<?php if ( have_posts() ): ?>
	<div class="content-inner">
		<?php while ( have_posts() ): the_post(); ?>
			<?php the_content() ?>
		<?php endwhile ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="navigation paging-navigation pager"><div class="pagination loop-pagination">',
				'after'  => '</div></div>',
				'next_or_number' => 'next',
				'nextpagelink' => esc_html__( 'Next &rarr;', 'canava' ),
				'previouspagelink' => esc_html__( '&larr; Previous', 'canava' )
			) );
		?>
	</div>
	<!-- /.content-inner -->

	<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) comments_template();
	?>
<?php endif ?>