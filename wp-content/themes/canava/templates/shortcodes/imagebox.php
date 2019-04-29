<?php
$atts = shortcode_atts( array(
	'class'       => '',
	'css'         => '',
	'image'       => '',
	'image_size'  => 'full',
	'title'       => '',
	'subtitle'    => '',
	'link'        => '',
	'target'      => '_self',
	'show_button' => 'no',
	'button_text' => 'Continue'
), $atts );

// Enqueue shortcode assets
wp_enqueue_script( 'themekit-shortcodes' );

// Preparing the shortcode attributes
$atts['show_button'] = $atts['show_button'] == 'yes';
$atts['button_text'] = empty( $atts['button_text'] ) ? 'Continue' : $atts['button_text'];

// Build the element classes
$classes = array( 'imagebox' );
$classes[] = $atts['class'];
$classes[] = vc_shortcode_custom_css_class( $atts['css'], ' ' );

// Preparing image for the box
if ( is_numeric( $atts['image'] ) ) {
	$image = wpb_getImageBySize( array( 'attach_id' => $atts['image'], 'thumb_size' => $atts['image_size'] ) );
	$image = $image['thumbnail'];
}
elseif ( filter_var( $atts['image'], FILTER_VALIDATE_URL ) ) {
	$image = sprintf( '<img src="%s" />', esc_url( $atts['image'] ) );
}
?>

<!-- BEGIN .imagebox -->
<div class="<?php echo esc_attr( join( ' ', $classes ) ) ?>">
	<div class="box-wrapper">
		<?php if ( ! empty( $image ) ): ?>
			
			<div class="box-image">
				<?php

					if ( ! $atts['show_button'] ):
						printf( '<a href="%s" target="%s">%s</a>',
							esc_url( $atts['link'] ),
							esc_attr( $atts['target'] ), $image );
					else:
						print( $image );
					endif;

				?>
			</div>

		<?php endif ?>

		<div class="box-header">
			<h3 class="box-title">
				<a href="<?php echo esc_url( $atts['link'] ) ?>" target="<?php echo esc_attr( $atts['target'] ) ?>">
					<?php echo wp_kses_post( $atts['title'] ) ?>
				</a>	
			</h3>

			<?php if ( ! empty( $atts['subtitle'] ) ): ?>
				<div class="box-subtitle"><?php echo wp_kses_post( $atts['subtitle'] ) ?></div>
			<?php endif ?>
		</div>

		<div class="box-content">
			<?php if ( ! empty( $content ) ): ?>
				<div class="box-desc">
					<?php echo esc_html( $content ) ?>
				</div>
			<?php endif ?>
			
			<?php if ( $atts['show_button'] ): ?>
				
				<div class="box-button">
					<a href="<?php echo esc_url( $atts['link'] ) ?>" target="<?php echo esc_attr( $atts['target'] ) ?>">
						<?php echo esc_html( $atts['button_text'] ) ?>
					</a>
				</div>

			<?php endif ?>
		</div>
	</div>
</div>
<!-- End .imagebox -->
