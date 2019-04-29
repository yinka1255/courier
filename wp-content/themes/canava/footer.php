<?php
/**
 * WARNING: This file is part of the theme. DO NOT edit
 * this file under any circumstances.
 */
defined( 'ABSPATH' ) or die();
?>
<?php do_action( 'theme/above_site_footer' ) ?>
<div id="site-footer">
	<?php get_template_part( 'templates/blocks/footer/content-bottom-widgets' ) ?>

	<?php get_template_part( 'templates/blocks/footer/widgets' ) ?>

	<div id="footer-content">
		<div class="wrapper">
			<?php get_template_part( 'templates/blocks/footer/social-links' ) ?>
			<?php get_template_part( 'templates/blocks/footer/copyright' ) ?>
		</div>
	</div>
	<!-- /.wrapper -->
</div>
<?php do_action( 'theme/below_site_footer' ) ?>
<!-- /#site-footer -->