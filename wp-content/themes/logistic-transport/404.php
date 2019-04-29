<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Logistic Transport
 */

get_header(); ?>
	<div id="content-ma">
		<div class="container space-top">
            <div class="page-content">		
				<h1><?php esc_html_e( '404 Not Found', 'logistic-transport' ); ?></h1>
				<p class="text-404"><?php esc_html_e( 'Looks like you have taken a wrong turn&hellip;', 'logistic-transport' ); ?></p>
				<p class="text-404"><?php esc_html_e( 'Dont worry&hellip it happens to the best of us.', 'logistic-transport' ); ?></p>
				<div class="read-moresec">
               		<a href="<?php echo esc_url( home_url() ); ?>" class="button hvr-sweep-to-right"><?php esc_html_e( 'Return to Home Page', 'logistic-transport' ); ?></a>
 				</div>
				<div class="clearfix"></div>
            </div>
		</div>
	</div>
<?php get_footer(); ?>