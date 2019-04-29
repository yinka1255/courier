<?php
/**
 * WARNING: This file is part of the theme. DO NOT edit
 * this file under any circumstances.
 */
defined( 'ABSPATH' ) or die();
?>
<!DOCTYPE html>
<html <?php language_attributes() ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">

		<?php if ( version_compare( get_bloginfo( 'version' ), '4.1', '<' ) ): ?>
			<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php endif ?>

		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ) ?>" />

		<?php wp_head() ?>
	</head>
	<body <?php body_class() ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
		<?php if ( op_option( 'loading_enabed', true ) ): ?>
			<div class="loading-overlay"></div>
		<?php endif ?>
		
		<?php do_action( 'theme/above_site_wrapper' ) ?>

		<?php $page_options = get_post_meta( get_the_ID(), '_page_options', true ) ?>

		<div id="site-wrapper">
			<?php get_header() ?>
			<?php do_action( 'theme/above_site_content' ) ?>
			
			<div id="site-content">
				<?php get_template_part( 'templates/blocks/content/header' ) ?>
			
				
				<?php do_action( 'theme/above_page_body' ) ?>

				<div id="page-body">
					<div class="wrapper">
						<?php do_action( 'theme/above_content_wrap' ) ?>

						<div class="content-wrap">
							<?php do_action( 'theme/above_main_content' ) ?>
						
							<main id="main-content" class="content" itemprop="mainContentOfPage">
								<div class="main-content-wrap">
									<?php include canava_template_path() ?>
								</div>
							</main>
							<!-- /#main-content -->
						
							<?php do_action( 'theme/below_main_content' ) ?>
							<?php get_sidebar() ?>
						</div>
						<!-- /.content-wrap -->
						
						<?php do_action( 'theme/below_content_wrap' ) ?>
					</div>
					<!-- /.wrapper -->
				</div>
				<!-- /#page-body -->

				<?php do_action( 'theme/below_page_body' ) ?>
			</div>
			<!-- /#site-content -->
			
			<?php do_action( 'theme/below_site_content' ) ?>
			<?php get_footer() ?>
		</div>
		<!-- /#site-wrapper -->

		<?php do_action( 'theme/below_site_wrapper' ) ?>
		<?php get_template_part( 'templates/blocks/header/off-canvas' ) ?>
		<?php wp_footer() ?>
	</body>
</html>
