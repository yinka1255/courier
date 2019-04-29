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
class Canava_Admin extends Canava_Base
{
	public function __construct() {
		if ( is_admin() ) {
			Canava_PostOptions::instance();
			Canava_PageOptions::instance();

			/**
			 * Initialize theme advanced settings
			 */
			Canava_Advanced::instance();

			/**
			 * Initialize sample data installer
			 */
			Canava_SampleData::instance();
		}
	}
}
