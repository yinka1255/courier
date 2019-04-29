<?php
/**
 * WARNING: This file is part of the theme. DO NOT edit
 * this file under any circumstances.
 */
defined( 'ABSPATH' ) or die();
?>
<?php do_action( 'theme/above_site_header' ) ?>

<div id="site-header">
	<?php get_template_part( 'templates/blocks/header/topbar' ) ?>
	<?php get_template_part( 'templates/blocks/header/masthead', op_option( 'header_style' ) ) ?>
</div>
<!-- /#site-header -->

<?php do_action( 'theme/below_site_header' ) ?>