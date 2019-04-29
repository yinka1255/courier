<?php
/**
 * WARNING: This file is part of the theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

$site_name     = get_bloginfo( 'name' );
$site_desc     = get_bloginfo( 'description' );
$home_url      = home_url();
$brand_classes = array( 'brand' );

if ( op_option( 'logo_image' ) == true && $standard = op_option( 'logo_src' ) ) {
	$brand_classes[] = 'has-logo';

	$srcset = array();
	$srcset[] = sprintf( '%s 1x', $standard );

	if ( $retina = op_option( 'logo_retina_src' ) ) {
		$srcset[] = sprintf( '%s 2x', $retina );
	}

	$site_name = sprintf( '<img src="%s" srcset="%s" alt="%s">', $standard, join( ', ', $srcset ), $site_name );
}

if ( op_option( 'show_tagline', false ) ) {
	$brand_classes[] = 'has-tagline';
}

// Open .brand
printf( '<div%s>', op_attributes( array( 'id' => 'site-logo', 'class' => $brand_classes ), 'canava_brand_attrs' ) );

	// Open .brand > .logo
	printf( '<div%s>', op_attributes( array( 'class' => 'logo', 'itemprop' => 'headline' ) ) );

		// Display the logo
		printf( '<a href="%s">%s</a>', esc_url( $home_url ), $site_name );

	// Close .brand > .logo
	print( '</div>' );

	// Open .brand > .tagline
	if ( op_option( 'show_tagline', false ) )
		printf( '<p class="tagline" itemprop="description">%s</p>', esc_html( $site_desc ) );

// Close .brand
print( '</div>' );
