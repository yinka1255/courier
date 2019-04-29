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
 * @package  Canava
 * @author   Binh Pham Thanh <binhpham@linethemes.com>
 */
class Canava_Breadcrumb extends Canava_Base
{
	protected function __construct() {
		if ( class_exists( 'Breadcrumb_Trail' ) ):
			
			/**
			 * Add breadcrumb item when post title is empty
			 */
			add_filter( 'breadcrumb_trail_items', array( $this, 'empty_title_item' ), 10, 2 );

		endif;
	}

	/**
	 * Add breadcrumb item when post title is empty
	 * 
	 * @param   array  $items  Breadcrumb items
	 * @param   array  $args   Arguments
	 * @return  array
	 */
	public function empty_title_item( $items, $args ) {
		if ( is_singular() ) {
			$post = get_post();
			
			if ( empty( $post->post_title ) ) {
				$items[] = get_the_title();
			}
		}

		return $items;
	}
}
