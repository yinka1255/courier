<?php
$original_atts = $atts;
$atts = shortcode_atts( array(
	'widget_title'   => '',
	'categories'     => '',
	'tags'           => '',
	'filter'         => 'yes',
	'filter_by'      => 'category',
	'mode'          => 'carousel',
	'columns'        => 3,
	'limit'          => 9,
	'offset'         => 0,
	'thumbnail_size' => 'full',
	'order'          => 'date',
	'direction'      => 'DESC',
	'class'          => '',
	'css'            => ''
), $atts );

// Remove attribute "class" from origial attributes
if ( isset( $original_atts['class'] ) ) unset( $original_atts['class'] );
if ( isset( $original_atts['css'] ) )   unset( $original_atts['css'] );

// Santinize the shortcode attributes
$atts['limit']  = abs( (int) $atts['limit'] );
$atts['limit']  = max( 1, $atts['limit']);
$atts['offset'] = abs( (int) $atts['offset'] );

// Santinize categories
$atts['categories'] = explode( ',', $atts['categories'] );
$atts['categories'] = array_map( 'trim', $atts['categories'] );
$atts['categories'] = array_filter( $atts['categories'] );

// Sanitize tags
$atts['tags'] = explode( ',', $atts['tags'] );
$atts['tags'] = array_map( 'trim', $atts['tags'] );
$atts['tags'] = array_filter( $atts['tags'] );

$atts['filter'] = $atts['filter'] == 'yes' && $atts['mode'] != 'carousel';

if ( ! in_array( $atts['order'], array( 'date', 'ID', 'author', 'title', 'modified', 'rand', 'comment_count', 'menu_order' ) ) )
	$atts['order'] = 'date';

if ( ! in_array( $atts['direction'], array( 'ASC', 'DESC' ) ) )
	$atts['order'] = 'DESC';

// Begin build post type query
$args = array(
	'post_type'      => nProjects::TYPE_NAME,
	'posts_per_page' => $atts['limit'],
	'offset'         => $atts['offset'],
	'orderby'        => $atts['order'],
	'order'          => $atts['direction'],
	'tax_query'      => array(
		'relation'   => 'AND'
	)
);

if ( ! empty( $atts['categories'] ) ) {
	$args['tax_query'][] = array(
		'taxonomy' => nProjects::TYPE_CATEGORY,
		'field'    => 'term_id',
		'terms'    => $atts['categories']
	);
}

if ( ! empty( $atts['tags'] ) ) {
	$args['tax_query'][] = array(
		'taxonomy' => nProjects::TYPE_TAG,
		'field'    => 'term_id',
		'terms'    => $atts['tags']
	);
}

$query = new WP_Query( $args );

// Start output the carousel
if ( $query->have_posts() ):
	$classes = array( 'projects projects-shortcode' );
	$classes[] = "projects-{$atts['mode']}";

	if ( $atts['mode'] == 'carousel' ) {
		$classes[]              = 'projects-grid';
		$original_atts['items'] = $atts['columns'];
		$atts['columns']        = 1;
	}

	if ( $atts['filter'] )
		$classes[] = 'projects-has-filter';

	$classes[] = $atts['class'];
	$classes[] = vc_shortcode_custom_css_class( $atts['css'], ' ' );
?>
	<!-- BEGIN: .projects -->
	<div class="<?php echo esc_attr( join( ' ', $classes ) ) ?>" data-columns="<?php echo esc_attr( $atts['columns'] ) ?>">
		<div class="projects-wrap">

			<?php if ( ! empty( $atts['widget_title'] ) ): ?>
				<h3 class="widget-title"><?php echo esc_html( $atts['widget_title'] ) ?></h3>
			<?php endif ?>

			<?php
			if ( $atts['filter'] ):
				$terms = array();
				$filter_type = array( 'category' => nProjects::TYPE_CATEGORY, 'tag' => nProjects::TYPE_TAG );

				while ( $query->have_posts() ):
					$query->the_post();

					if ( $categories = get_the_terms( get_the_ID(), $filter_type[ $atts['filter_by'] ] ) )
						foreach ( $categories as $term )
							$terms[ $term->term_id ] = $term;
				endwhile;

				// Reset the posts pointer
				$query->rewind_posts();
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

			<div class="projects-items">
				<?php
					/**
					 * Start output buffering to inject content
					 * into carousel wrapper
					 */
					if ( $atts['mode'] == 'carousel' ) ob_start();

					/**
					 * Start posts loop
					 */
					while ( $query->have_posts() ):
						$query->the_post();
				?>
					
					<!-- Project -->
					<div class="<?php echo esc_attr( join( ' ', get_post_class( 'project' ) ) ) ?>" itemscope="itemscope" itemtype="http://schema.org/CreativeWork">
						<div class="project-wrap">
							<figure class="project-thumbnail">
								<a href="<?php the_permalink() ?>">
									<?php

										/**
										 * Preparing the post thumbnail
										 */
										$image = wpb_getImageBySize( array( 'post_id' => get_the_ID(), 'thumb_size' => $atts['thumbnail_size'] ) );
										print( $image['thumbnail'] );
									?>
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
					<!-- /Project -->

				<?php

					// End the post loop
					endwhile;

					/**
					 * We need reset post data to ensure
					 * not conflict with other code
					 */
					wp_reset_postdata();

					/**
					 * Inject content to carousel wrapper
					 */
					if ( $atts['mode'] == 'carousel' ) {
						global $shortcode_tags;

						if ( isset( $shortcode_tags['elements_carousel'] ) ) {
							echo $shortcode_tags['elements_carousel']( $original_atts, ob_get_clean() );
						}
					}
				?>

			</div>
		</div>
	</div>
	<!-- END: .projects -->
<?php endif ?>
