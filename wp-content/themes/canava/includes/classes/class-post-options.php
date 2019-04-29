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
class Canava_PostOptions extends Canava_Base
{
	protected function __construct() {
		add_action( 'admin_init', array( $this, 'register' ) );
	}

	/**
	 * Register post options controls
	 * 
	 * @return  void
	 */
	public function register() {
		$options = array();
		$options['images_heading'] = array(
			'type'        => 'heading',
			'title'       => esc_html__( 'Featured Gallery', 'canava' ),
			'description' => esc_html__( 'Add images to create a slider for this post, post format "Gallery" must be checked.', 'canava' ),
			'section'     => 'all'
		);

		$options['post_images'] = array(
			'type'        => 'media-list',
			'section'     => 'all',
			'media_types' => array( 'image' ),
			'default'     => array()
		);

		$options['video_heading'] = array(
			'type'        => 'heading',
			'section'     => 'all',
			'title'       => esc_html__( 'Video URL', 'canava' ),
			'description' => esc_html__( 'Add an URL that linked to a video, it can be Youtube, Vimeo, ... The added video will be displayed on top of the page.', 'canava' )
		);

		$options['post_video'] = array(
			'type'    => 'media-input',
			'section' => 'all',
			'library' => 'video',
			'default' => ''
		);

		$options['audio_heading'] = array(
			'type'        => 'heading',
			'section'     => 'all',
			'title'       => esc_html__( 'Audio URL', 'canava' ),
			'description' => esc_html__( 'This field will be applied when post format "Audio" is checked. A audio player will be displayed on top of the post.', 'canava' )
		);

		$options['post_audio'] = array(
			'type'    => 'media-input',
			'section' => 'all',
			'library' => 'audio',
			'default' => ''
		);

		$options['link_heading'] = array(
			'type'        => 'heading',
			'section'     => 'all',
			'title'       => esc_html__( 'External Link', 'canava' ),
			'description' => esc_html__( 'When post format "Link" is selected you need provide a link to this field.', 'canava' )
		);

		$options['post_link'] = array(
			'type'    => 'text',
			'section' => 'all',
			'default' => 'http://'
		);

		new \OptionsPlus\Metabox\Properties( 'post-options', array(
			'label'       => esc_html__( 'Post Options', 'canava' ),
			'post_types'  => 'post',
			'context'     => 'normal',
			'priority'    => 'high',
			'storage_key' => '_post_options',
			'show_tabs'   => false,
			'sections'    => array(
				'all'     => array( 'title' => esc_html__( 'Post Options', 'canava' ) ) 
			),
			'options'     => $options
		) );
	}
}
