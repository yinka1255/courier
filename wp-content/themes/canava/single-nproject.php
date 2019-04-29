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

<div class="content-inner">
	<?php while( have_posts() ): the_post(); ?>
		<?php

			$classes = apply_filters( 'projects/single-class', array( 'project-single' ) );
			$classes[] = sprintf( 'project-content-%s', op_option( 'projects_single_content_position', 'fullwidth' ) );

			if ( op_option( 'projects_single_content_sticky', true ) )
				$classes[] = 'project-content-sticky';

			$classes = array_filter( $classes );
			$classes = array_unique( $classes );

		?>

		<div class="<?php echo esc_attr( join( ' ', $classes ) ) ?>">
			<div class="project-single-wrap">
				<?php get_template_part( 'templates/blocks/project-gallery', op_option( 'projects_single_gallery_type', 'list' ) ); ?>
				
				<div class="project-content">
					<div class="project-content-wrap">
						<h3 class="project-title"><?php esc_html_e( 'Description', 'canava' ) ?></h3>
						<?php the_content() ?>
					</div>
				</div>
			</div>
		</div>

		<?php if ( op_option( 'projects_single_navigator_enabled', true ) ): ?>
			<?php get_template_part( 'templates/blocks/post-navigator' ) ?>
		<?php endif ?>

		<?php get_template_part( 'templates/blocks/project-related' ) ?>

	<?php endwhile ?>
</div>
