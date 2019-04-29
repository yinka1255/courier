<?php
/**
 * The template for displaying home page.
 *
 * Template Name: Custom Home Page
 *
 * @package Logistic Transport
 */

get_header(); ?>

<?php if( get_theme_mod('logistic_transport_slider_hide_show') != ''){ ?>
  <section id="slider">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
      <?php $pages = array();
          for ( $count = 1; $count <= 3; $count++ ) {
            $mod = intval( get_theme_mod( 'logistic_transport_slider_page' . $count ));
            if ( 'page-none-selected' != $mod ) {
              $pages[] = $mod;
            }
          }
          if( !empty($pages) ) :
          $args = array(
              'post_type' => 'page',
              'post__in' => $pages,
              'orderby' => 'post__in'
          );
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
            $i = 1;
      ?>     
      <div class="carousel-inner" role="listbox">
          <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
          <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
              <img src="<?php the_post_thumbnail_url('full'); ?>"/>
              <div class="carousel-caption">
                <div class="inner_carousel">
                    <h2><?php the_title();?></h2>
                    <p><?php $excerpt = get_the_excerpt(); echo esc_html( logistic_transport_string_limit_words( $excerpt,15 ) ); ?></p>
                    <div class="read-btn">
                      <a href="<?php echo esc_url( get_permalink() );?>" class="blogbutton-small" title="<?php esc_attr_e( 'Read More', 'logistic-transport' ); ?>"><?php esc_html_e('Read More','logistic-transport'); ?><i class="fas fa-angle-right"></i>
                      </a>
                    </div>  
                </div>
              </div>
          </div>
          <?php $i++; endwhile; 
          wp_reset_postdata();?>
      </div>
      <?php else : ?>
      <div class="no-postfound"></div>
        <?php endif;
      endif;?>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
      </a>
    </div>  
    <div class="clearfix"></div>
  </section> 
<?php }?>

<?php do_action( 'logistic_transport_after_slider' ); ?>

<?php if( get_theme_mod('logistic_transport_services_category') != ''){ ?>

<section id="services">
	<div class="container">
    <div class="service-box">
        <div class="row">
	        <?php 
	         	$page_query = new WP_Query(array( 'category_name' => esc_html(get_theme_mod('logistic_transport_services_category'),'theblog')));?>
	          	<?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
	          		<div class="col-lg-4 col-md-4">
                  <div class="service-content">
		                <img src="<?php the_post_thumbnail_url('full'); ?>"/>
                    <h4><a href="<?php echo esc_url( get_permalink() );?>"><?php the_title();?></a></h4><hr>
                    <div class="learn-btn">
                      <a href="<?php echo esc_url( get_permalink() );?>" class="blogbutton-small" title="<?php esc_attr_e( 'LEARN MORE', 'logistic-transport' ); ?>"><?php esc_html_e('LEARN MORE','logistic-transport'); ?>
                      </a>
                    </div>
                  </div>
		            </div>
	          	<?php endwhile;
	          	wp_reset_postdata();
	        ?>
	      </div>
    </div>
	</div>
</section>

<?php }?>

<?php do_action( 'logistic_transport_after_service' ); ?>

<?php if( get_theme_mod('logistic_transport_discover_post') != ''){ ?>

<section id="about">
  <div class="container">
    <div class="row">
        <?php
          $args = array( 'name' => get_theme_mod('logistic_transport_discover_post',''));
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
            while ( $query->have_posts() ) : $query->the_post(); ?>
              <div class="row">
                <div class="col-lg-6 col-md-6">
                  <?php
                     $content = apply_filters( 'the_content', get_the_content() );
                     $video = false;

                     // Only get video from the content if a playlist isn't present.
                     if ( false === strpos( $content, 'wp-playlist-script' ) ) {
                       $video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
                     }
                  ?>  
                  <?php
                     if ( ! is_single() ) {
                       // If not a single post, highlight the video file.
                       if ( ! empty( $video ) ) {
                         foreach ( $video as $video_html ) {
                           echo '<div class="entry-video">';
                             echo $video_html;
                           echo '</div>';
                         }
                       }
                       elseif(has_post_thumbnail()) { 
                         the_post_thumbnail(); 
                       } 
                     }; 
                  ?>
                                   
                </div>
                <div class="col-lg-6 col-md-6">
                  <div class="about-content">
                    <a href="<?php echo esc_url( get_permalink() );?>"><h3><?php the_title(); ?></h3><hr></a>
                    <p><?php $excerpt = get_the_excerpt(); echo esc_html( logistic_transport_string_limit_words( $excerpt,60 ) ); ?></p>
                  </div>          
                </div>
              </div>
            <?php endwhile; 
            wp_reset_postdata();?>
            <?php else : ?>
              <div class="no-postfound"></div>
            <?php
        endif; ?>
    </div>
  </div>
</section>

<?php }?>

<?php do_action( 'logistic_transport_after_product' ); ?>

<div id="content-ma">
	<div class="container">
  	<?php while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?>
	</div>
</div>

<?php get_footer(); ?>