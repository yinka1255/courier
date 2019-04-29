<?php
add_action( 'woocommerce_before_shop_loop_item', function() {
	ob_start();
}, -99 );

add_action( 'woocommerce_after_shop_loop_item', function() {
	echo sprintf( '<div class="product-inner">%s</div>', ob_get_clean() );
}, 999 );

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open' );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

// Remove results count & products sort
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

add_action( 'woocommerce_before_shop_loop_item', 'canava_before_shop_loop_item' );
add_action( 'canava_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'canava_before_shop_loop_item', 'woocommerce_template_loop_product_thumbnail', 10 );

add_filter( 'woocommerce_get_image_size_shop_catalog', 'canava_woocommerce_catalog_image_size' );
add_filter( 'woocommerce_get_image_size_shop_single', 'canava_woocommerce_single_image_size' );


function canava_woocommerce_single_image_size( $size ) {
	$size['width']  = 600;
	$size['height'] = 600;
	$size['crop']   = true;

	return $size;
}
function canava_woocommerce_catalog_image_size( $size ) {
	$size['width']  = 600;
	$size['height'] = 600;
	$size['crop']   = true;

	return $size;
}


function canava_before_shop_loop_item() {
  echo '<div class="product-thumbnail">';
  woocommerce_template_loop_product_link_open();
  
  do_action( 'canava_before_shop_loop_item' );
  
  woocommerce_template_loop_product_link_close();
  echo '</div>';
  echo '<div class="product-info">
  			<div class="product-info-wrap">';
  
}

add_action( 'woocommerce_after_shop_loop_item', function() {
  echo '</div></div><!-- END -->';
}, 99 );

add_action( 'woocommerce_after_single_product_summary', function() {
	if ( op_option( 'woocommerce_product_navigator_enabled' ) ) {
		get_template_part( 'templates/blocks/post-navigator' );
	}
}, 15 );


if ( ! function_exists( 'canava_dequeue_plugins_assets' ) ) {
	function canava_dequeue_plugins_assets() {
		wp_dequeue_style( 'pif-styles' );
		wp_dequeue_script( 'pif-script' );
	}
}
add_action( 'wp_enqueue_scripts', 'canava_dequeue_plugins_assets', 999 );
