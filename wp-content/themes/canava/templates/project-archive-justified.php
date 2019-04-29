<?php
/**
 * WARNING: This file is part of the Mountain Theme. DO NOT edit
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
		<div class="<?php echo esc_attr( join( ' ', $classes ) ) ?>">
			<div class="projects-wrap">
				<div class="projects-items flex-images">
					<?php while ( have_posts() ): the_post();
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'portfolio-medium' );
						?>

						<div class="<?php echo esc_attr( join( ' ', get_post_class( 'project item' ) ) ) ?>" itemscope="itemscope" itemtype="http://schema.org/CreativeWork"
							data-w="<?php echo esc_attr( $thumbnail[1] ) ?>" data-h="<?php echo esc_attr( $thumbnail[2] ) ?>">
							<a href="<?php the_permalink() ?>">
								<?php the_post_thumbnail( 'portfolio-medium', array( 'itemprop' => 'image' ) ) ?>
							</a>

							<div class="project-info">
								<div class="project-info-wrap">
									<h3 class="project-title" itemprop="name headline">
										<a href="<?php the_permalink() ?>">
											<?php the_title() ?>
										</a>
									</h3>

									<?php if ( op_option( 'projects_archive_category_enabled' ) ): ?>
										<ul class="project-categories">
											<?php the_terms( get_the_ID(), nProjects::TYPE_CATEGORY, '<li>', '</li><li>', '</li>' ) ?>
										</ul>
									<?php endif ?>
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
