<?php
/**
 * WARNING: This file is part of the theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

get_template_part( 'templates/project-archive',
	op_option( 'projects_archive_layout' ) );
