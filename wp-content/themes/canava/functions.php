<?php
/**
 * WARNING: This file is part of the theme. DO NOT edit
 * this file under any circumstances.
 */
defined( 'ABSPATH' ) or exit;





if ( ! function_exists( 'canava_import_translation' ) ) {
	/**
	 * Load the translation files into the theme textdomain
	 * 
	 * @return  void
	 */
	function canava_import_translation() {
		load_theme_textdomain( 'canava', get_template_directory() . '/languages' );
	}
}
add_action( 'after_setup_theme', 'canava_import_translation', 5 );


if ( ! function_exists( 'canava_requirement_check' ) ):
	add_action( 'after_switch_theme', 'canava_requirement_check', 10, 2 );

	/**
	 * Check the theme requirements
	 */
	function canava_requirement_check( $name, $theme ) {
	    if ( version_compare( PHP_VERSION, '5.3', '<' ) ):
			add_action( 'admin_notices', 'canava_requirement_notice' );

			function canava_requirement_notice() {
				printf( '<div class="error"><p>%s</p></div>',
					__( 'Sorry! Your server does not meet the minimum requirements, please upgrade PHP version to 5.3 or higher', 'canava' ) );
			}

			// Switch back to previous theme
			switch_theme( $theme->stylesheet );
		endif;
	}
endif;



if ( version_compare( PHP_VERSION, '5.3', '>=' ) ):
	// Classes
	require_once get_template_directory() . '/includes/vendor/plugin-activation.php';
	require_once get_template_directory() . '/includes/vendor/options-plus.php';

	// Functions
	require_once get_template_directory() . '/includes/plugins.php';
	require_once get_template_directory() . '/includes/assets.php';
	require_once get_template_directory() . '/includes/woocommerce.php';
	require_once get_template_directory() . '/includes/functions/helpers.php';
	require_once get_template_directory() . '/includes/functions/template.php';
	require_once get_template_directory() . '/includes/functions/visual-composer.php';
	require_once get_template_directory() . '/includes/functions/structure.php';
	require_once get_template_directory() . '/includes/functions/options-override.php';

	require_once get_template_directory() . '/includes/autoload.php';

	// Register class mapping
	Canava_AutoLoad::map( 'Canava_', get_template_directory() . '/includes/classes/' );
	Canava_AutoLoad::map_class( 'Canava', get_template_directory() . '/includes/classes/class-theme.php' );
	Canava_AutoLoad::register();

	// Initialize the theme
	Canava::instance();
	Canava_Admin::instance();
endif;
