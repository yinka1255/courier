<?php
/**
 * WARNING: This file is part of the theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

$classes = apply_filters( 'projects/archive-class', array( 'projects' ) );
$classes = array_filter( $classes );
$classes = array_unique( $classes );
?>

<?php if ( have_posts() ): ?>

	<div class="content-inner">
		<div class="<?php echo esc_attr( join( ' ', $classes ) ) ?>" data-columns="<?php echo esc_attr( op_option( 'projects_grid_columns', 4 ) ) ?>">
			<div class="projects-wrap">
				<?php get_template_part( 'templates/blocks/project', 'filter' ) ?>

				<div class="projects-items">
					<?php while ( have_posts() ): the_post(); ?>

						<div class="<?php echo esc_attr( join( ' ', get_post_class( 'project' ) ) ) ?>" itemscope="itemscope" itemtype="http://schema.org/CreativeWork">
							<div class="project-wrap">
								<figure class="project-thumbnail">
									<a href="<?php the_permalink() ?>">
										<?php the_post_thumbnail( apply_filters( 'projects/archive-thumbnail-size', 'portfolio-medium' ), array( 'itemprop' => 'image' ) ) ?>
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
	</div>

	<?php get_template_part( 'templates/blocks/pagination' ) ?>

<?php else: ?>
	<!-- Show empty message -->
<?php endif ?>
