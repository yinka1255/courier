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
 * Ignore render related box when it's disabled
 */
if ( ! op_option( 'projects_related_box_enabled', true ) ||
	 ! is_singular( nProjects::TYPE_NAME ) ) {
	return;
}

// Query args
$args = array(
	'post_type'      => nProjects::TYPE_NAME,
	'posts_per_page' => op_option( 'projects_related_posts_count', 4 ),
	'post__not_in'   => array( get_the_ID() )
);

$related_item_type = op_option( 'projects_related_type', 'tag' );

// Filter by tags
if ( 'tag' == $related_item_type ) {
	if ( ! ( $terms = get_the_terms( get_the_ID(), nProjects::TYPE_TAG ) ) )
		return;

	$args['tax_query'] = array(
		'taxonomy' => nProjects::TYPE_TAG,
		'field'    => 'term_id',
		'terms'    => wp_list_pluck( $terms, 'term_id' )
	);
}
// Filter by categories
elseif ( 'category' == $related_item_type ) {
	if ( ! ( $terms = get_the_terms( get_the_ID(), nProjects::TYPE_CATEGORY ) ) )
		return;

	$args['tax_query'] = array(
		'taxonomy' => nProjects::TYPE_CATEGORY,
		'field'    => 'term_id',
		'terms'    => wp_list_pluck( $terms, 'term_id' )
	);
}
// Show random items
elseif ( 'random' == $related_item_type ) {
	$args['orderby'] = 'rand';
}
// Show latest items
elseif ( 'recent' == $related_item_type ) {
	$args['order'] = 'DESC';
	$args['orderby'] = 'date';
}

// Create the query instance
$query = new WP_Query( $args );

// Build classes for related projects box
$classes = array(
	'projects',
	'projects-related',
	'projects-' . op_option( 'projects_related_style', 'grid' )
);

$widget_title   = op_option( 'projects_related_title' );
$thumbnail_size = op_option( 'projects_related_style' ) == 'masonry'
	? 'portfolio-medium' : 'portfolio-medium-crop';

if ( $query->have_posts() ): ?>

	<div class="<?php echo esc_attr( join( ' ', $classes ) ) ?>" data-columns="<?php echo esc_attr( op_option( 'projects_related_columns_count', 4 ) ) ?>">
		<div class="projects-related-wrap">
			<?php if ( ! empty( $widget_title ) ): ?>

				<h3 class="projects-related-title">
					<?php echo esc_html( $widget_title ) ?>
				</h3>

			<?php endif ?>

			<div class="projects-items">
				<?php while ( $query->have_posts() ): $query->the_post(); ?>

					<div class="<?php echo esc_attr( join( ' ', get_post_class( 'project' ) ) ) ?>" itemscope="itemscope" itemtype="http://schema.org/CreativeWork">
						<div class="project-wrap">
							<figure class="project-thumbnail">
								<a href="<?php the_permalink() ?>">
									<?php the_post_thumbnail( $thumbnail_size, array( 'itemprop' => 'image' ) ) ?>
								</a>
								
								<figcaption>
									<div class="project-buttons">
										<?php

											$attachment_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
											$attachment_image_src = $attachment_image[0];

										?>
										<a href="<?php echo esc_url( $attachment_image_src ) ?>" class="project-quick-view" data-lightbox="nivoLightbox">
											<span><?php esc_html_e( 'Quick View', 'canava' ) ?></span>
										</a>
									</div>
								</figcaption>
							</figure>

							<div class="project-info">
								<div class="project-info-wrap">
									<h3 class="project-title" itemprop="name headline">
										<a href="<?php the_permalink() ?>">
											<?php the_title() ?>
										</a>
									</h3>
									<ul class="project-categories">
										<?php the_terms( get_the_ID(), nProjects::TYPE_CATEGORY, '<li>', '</li><li>', '</li>' ) ?>
									</ul>
								</div>
							</div>
						</div>
					</div>

				<?php endwhile ?>
			</div>
		</div>
	</div>

<?php endif ?>
