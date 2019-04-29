<?php
/**
 * WARNING: This file is part of the theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

/**
 * Ignore fetching project terms when archive filter is
 * disabled
 */
if ( op_option( 'projects_archive_filter', true ) ):
	$terms = array();

	while ( have_posts() ) {
		the_post();

		if ( $categories = get_the_terms( get_the_ID(), nProjects::TYPE_CATEGORY ) )
			foreach ( $categories as $term )
				$terms[ $term->term_id ] = $term;
	}

	rewind_posts();
	?>

	<?php if ( ! empty( $terms ) ): ?>
		<div class="projects-filter">
			<ul>
				<li data-filter="*" class="active">
					<a href=""><?php esc_html_e( 'All', 'canava' ) ?></a>
				</li>
				<?php foreach ( $terms as $id => $term ): ?>
					<li data-filter=".nproject-category-<?php echo esc_attr( $term->slug ) ?>">
						<a href="<?php echo esc_url( get_term_link( $term ) ) ?>"><?php echo esc_html( $term->name ) ?></a>
					</li>
				<?php endforeach ?>
			</ul>
		</div>
	<?php endif ?>
<?php endif ?>
