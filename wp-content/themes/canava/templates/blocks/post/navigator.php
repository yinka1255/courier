<?php
/**
 * WARNING: This file is part of the theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

if ( ! get_next_post_link() && ! get_previous_post_link() ) return;
?>

<nav class="navigation post-navigation" role="navigation">
	<ul class="nav-links">
		<?php
		if ( is_attachment() ) :
			previous_post_link( '<li>%link</li>', sprintf( '<span class="meta-nav">%s</span> %%title', esc_html__( 'Published In', 'canava' ) ) );
		else :
			previous_post_link( '<li class="previous-post">%link</li>', sprintf( '<span class="meta-nav">%s</span> %%title', esc_html__( 'Previous Post', 'canava' ) ) );
			next_post_link( '<li class="next-post">%link</li>', sprintf( '<span class="meta-nav">%s</span> %%title', esc_html__( 'Next Post', 'canava' ) ) );
		endif;
		?>
	</ul><!-- .nav-links -->
</nav><!-- .navigation -->
