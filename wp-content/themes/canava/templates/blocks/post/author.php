<?php
/**
 * WARNING: This file is part of the theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();

if ( ! op_option( 'blog_author_box_enabled' ) ) return;
if ( ! ( $author_id = get_the_author_meta( 'ID' ) ) )
	$author_id = get_query_var( 'author' );

$author_description = get_the_author_meta( 'description', $author_id );

if ( empty( $author_description ) ) return;
?>
<section class="box author-box" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">
	<div class="box-wrapper">
		<h3 class="box-title author-name">
			<span><?php esc_html_e( 'About', 'canava' ) ?></span>
			<a href="<?php echo esc_url( get_author_posts_url( $author_id ) ) ?>" itemprop="name">
				<?php echo wp_kses_post( get_user_option( 'display_name', $author_id ) ) ?>
			</a>
		</h3>
		<div class="box-content">
			<?php if ( get_option( 'show_avatars' ) ): ?>
				<div class="author-avatar">
					<?php echo wp_kses_post( get_avatar( $author_id ) ) ?>
				</div>
			<?php endif ?>

			<div class="author-description">
				<?php echo wp_kses_post( $author_description ) ?>
			</div>
		</div>
	</div>
</section>
