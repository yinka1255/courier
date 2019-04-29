<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Logistic Transport
 */

get_header(); ?>

<?php do_action( 'logistic_transport_page_header' ); ?>

<div class="container space-top">
    <div class="middle-align">
        <div id="content-ma">
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="feature-box">   
                    <img src="<?php the_post_thumbnail_url('full'); ?>" width="100%">
                </div>
                <h1><?php the_title(); ?></h1>
                <?php the_content();
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . __( 'Pages:', 'logistic-transport' ),
                    'after'  => '</div>',
                ) );
                
                    //If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || '0' != get_comments_number() )
                        comments_template();
                ?>
            <?php endwhile; // end of the loop. ?>             
        </div>
    </div>
</div>
<div class="clearfix"></div>

<?php do_action( 'logistic_transport_page_footer' ); ?>

<?php get_footer(); ?>