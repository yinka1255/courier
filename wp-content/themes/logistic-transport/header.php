<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content-ma">
 *
 * @package Logistic Transport
 */

?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width">
  <link rel="profile" href="<?php echo esc_url( __( 'http://gmpg.org/xfn/11', 'logistic-transport' ) ); ?>">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> class="main-bodybox">

<div id="header">
  	<div class="container inner-box">
  		<div class="site_header">
	  		<div class="row m-0">
			    <div class="col-lg-3 col-md-3">
			    	<div class="logo">
				      	<?php if( has_custom_logo() ){ logistic_transport_the_custom_logo();
				         	}else{ ?>
				        	<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				        <?php $description = get_bloginfo( 'description', 'display' );
				        	if ( $description || is_customize_preview() ) : ?> 
				          <p class="site-description"><?php echo esc_html($description); ?></p>
				      	<?php endif; }?>
				    </div>
			    </div>
			    <div class="col-lg-9 col-md-9">
			    	<div class="row topbar">
				        <div class="col-lg-3 col-md-6">
				        	<div class="call">
				        	<?php if( get_theme_mod( 'logistic_transport_call','' ) != '') { ?>
				        		<i class="fas fa-phone"></i><?php echo esc_html( get_theme_mod('logistic_transport_call',__('0123456789','logistic-transport')) ); ?>
				          	<?php } ?>
				          	</div>
				        </div>
				        <div class="col-lg-4 col-md-6">
				        	<div class="call">
					        	<?php if( get_theme_mod( 'logistic_transport_mail','' ) != '') { ?>
							        <i class="fas fa-envelope"></i><?php echo esc_html( get_theme_mod('logistic_transport_mail',__('support@sitename.com','logistic-transport')) ); ?>
							    <?php } ?>
						    </div>
				        </div>
				        <div class="col-lg-3 col-md-6">
				        	<div class="call">
					        	<?php if( get_theme_mod( 'logistic_transport_time','' ) != '') { ?>
					        		<i class="far fa-clock"></i><?php echo esc_html( get_theme_mod('logistic_transport_time',__('8:00 AM - 6:00 PM','logistic-transport')) ); ?>
					        	<?php } ?>
				        	</div>
				        </div>
				        <div class="col-lg-2 col-md-6">
				        	<div class="social-media">
			          			<?php if( get_theme_mod( 'logistic_transport_facebook_url' ) != '') { ?>
			            			<a href="<?php echo esc_url( get_theme_mod( 'logistic_transport_facebook_url','' ) ); ?>"><i class="fab fa-facebook-f"></i></a>
			          			<?php } ?>
			          			<?php if( get_theme_mod( 'logistic_transport_twitter_url' ) != '') { ?>
			            			<a href="<?php echo esc_url( get_theme_mod( 'logistic_transport_twitter_url','' ) ); ?>"><i class="fab fa-twitter"></i></a>
			          			<?php } ?>
			          			<?php if( get_theme_mod( 'logistic_transport_google_url' ) != '') { ?>
			            			<a href="<?php echo esc_url( get_theme_mod( 'logistic_transport_google_url','' ) ); ?>"><i class="fab fa-google-plus-g"></i></a>
			          			<?php } ?>
			          			<?php if( get_theme_mod( 'logistic_transport_linkdin_url' ) != '') { ?>
			            			<a href="<?php echo esc_url( get_theme_mod( 'logistic_transport_linkdin_url','' ) ); ?>"><i class="fab fa-linkedin-in"></i></a>
			          			<?php } ?>
			          			<?php if( get_theme_mod( 'logistic_transport_youtube_url' ) != '') { ?>
			            			<a href="<?php echo esc_url( get_theme_mod( 'logistic_transport_youtube_url','' ) ); ?>"><i class="fab fa-youtube"></i></a>
			          			<?php } ?>
			        		</div>
				        </div>
				    </div>
				    <div class="toggle"><a class="toggleMenu" href="#"><?php esc_html_e('Menu','logistic-transport'); ?></a></div>				    
			        <div class="row">
						<div class="menubox nav col-lg-8 col-md-12">
						    <div class="mainmenu">
						      <?php wp_nav_menu( array('theme_location'  => 'primary') ); ?>
						    </div>
							<div class="clear"></div>
						</div>
						<div class="search-box col-lg-1 col-md-1 col-1 p-0">
							<span><i class="fas fa-search"></i></span>
						</div>
						<div class="serach_outer">
				  		  	<div class="closepop"><i class="far fa-window-close"></i></div>
				  			<div class="serach_inner">
				  				<?php get_search_form(); ?>
				  			</div>
				  	  	</div>
				  	  	<div class="col-lg-3 col-md-8 col-8 p-0">
							<div class="request-btn">
							  <a href="<?php echo esc_url( get_permalink() );?>" class="blogbutton-small" title="<?php esc_attr_e( 'Request a Date', 'logistic-transport' ); ?>"><?php esc_html_e('Request a Date','logistic-transport'); ?>
							  </a>
							</div>
						</div>
					</div>
			    </div>
		    </div>
		</div>
	</div>
</div>