<?php
/**
 * WARNING: This file is part of the theme. DO NOT edit
 * this file under any circumstances.
 */

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();


if ( ! function_exists( 'canava_post_title' ) ) {
	/**
	 * Display the post title
	 * 
	 * @return  void
	 */
	function canava_post_title() {
		$post_link = apply_filters( 'the_permalink', get_permalink() );

		if ( get_post_format() == 'link' ) {
			$post_options = get_post_meta( get_the_ID(), '_post_options', true );

			if ( isset( $post_options['post_link'] ) && filter_var( $post_options['post_link'], FILTER_VALIDATE_URL ) )
				$post_link = $post_options['post_link'];
		}

		if ( is_singular() ) {
			if ( op_option( 'blog_page_title_enabled' ) == false ) {
				printf( '<h2 class="entry-title" itemprop="headline">%s</h2>', get_the_title() );
			}
		}
		else {
			printf( '<h2 class="entry-title" itemprop="headline"><a href="%s" itemprop="url">%s</a></h2>',
				esc_url( $post_link ),
				get_the_title()
			);
		}
	}
}


if ( ! function_exists( 'canava_post_meta' ) ) {
	/**
	 * Display the post meta
	 * 
	 * @return  void
	 */
	function canava_post_meta() {
		if ( ! op_option( 'blog_archive_show_post_meta' ) )
			return;
		
		?>
		
			<div class="entry-meta">
				<i class="fa fa-user"></i>
				<span class="entry-author" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>" class="entry-author-link" itemprop="url" rel="author">
						<span class="entry-author-name" itemprop="name"><?php the_author() ?></span>
					</a>
				</span>
				<i class="fa fa-folder-open"></i>
				<span class="entry-categories">
					<?php the_category( _x( ', ', 'Used between list items, there is a space after the comma.', 'canava' ) ); ?>
				</span>

				<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
					<?php if ( in_array( op_option( 'blog_archive_layout' ), array( 'grid', 'masonry' ) ) && ! is_single() ): ?>

						<span class="entry-comments-link">
							<?php comments_popup_link( '0 Comment', '1 Comment', '% Comments' ); ?>
						</span>

					<?php else: ?>
						<i class="fa fa-comment"></i>
						<span class="entry-comments-link">
							<?php comments_popup_link( esc_html__( '0 Comment', 'canava' ), esc_html__( '1 Comment', 'canava' ), esc_html__( '% Comments', 'canava' ) ); ?>
						</span>

					<?php endif ?>
				<?php endif ?>
				
				<?php edit_post_link( esc_html__( '(Edit)', 'canava' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

		<?php
	}
}


if ( ! function_exists( 'canava_post_content' ) ) {
	/**
	 * Display the post content
	 * 
	 * @return  void
	 */
	function canava_post_content() {
		if ( ! is_single() && canava_current_posttype_is( 'post' ) ) {
			$content = get_the_content( false, false );
			$auto_post_excerpts = op_option( 'blog_archive_post_excepts' );
			$post_excerpts_length = op_option( 'blog_archive_post_excepts_length' );

			if ( $auto_post_excerpts && mb_strlen( $content ) > $post_excerpts_length ) {
				$content = trim( strip_tags( $content ) );
				$content = mb_substr( $content, 0, $post_excerpts_length );
				$content.= '...';

				echo wp_kses_post( $content );
			}
			else {
				the_content( false );
			}

			if ( op_option( 'blog_archive_readmore' ) ) {
				printf( '<div class="readmore"><a href="%s" class="more-link">%s</a></div>',
					get_permalink(),
					esc_html( op_option( 'blog_archive_readmore_text' ) ) );
			}
		}
		else {
			the_content( false );
		}
	}
}
