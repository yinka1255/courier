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
 * Return an array that declaration theme customize sections
 */
return array(
	'general'            => array( 'title' => esc_html__( 'General', 'canava' ) ),
	'header'             => array( 'title' => esc_html__( 'Header', 'canava' ) ),
	'footer'             => array( 'title' => esc_html__( 'Footer', 'canava' ) ),
	'layout'             => array( 'title' => esc_html__( 'Layout & Styles', 'canava' ) ),
	'typography'         => array( 'title' => esc_html__( 'Typography', 'canava' ) ),
	'blog'               => array( 'title' => esc_html__( 'Blog', 'canava' ) ),
	'under-construction' => array(
		'title'    => esc_html__( 'Under Construction', 'canava' ),
		'priority' => 99
	)
);
