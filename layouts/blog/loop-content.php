<header class="entry-header">
	<div class="entry-meta clearfix">

		<?php
			if ( is_sticky() ) {
				echo '<span class="sticky"><i class="fa fa-thumb-tack" aria-hidden="true"></i></span>';
			}

			$first_category = pearl_first_category_link();

			if ( ! empty( $first_category ) ) {
				?>
				<div class="post-cat">
					<?php echo wp_kses( $first_category, wp_kses_allowed_html() ); ?>
				</div>
				<?php
			}

			if ( ! is_single() ) {
				?>
				<div class="post-author">
					<div class="author-info-wrap">
						<h4 class="author-title">
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
							   title="<?php esc_attr( the_author() ); ?>"><?php the_author(); ?></a>
						</h4>
						<span class="posted-on"><?php the_time( get_option( 'date_format' ) ); ?></span>
					</div>
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
					   title="<?php esc_attr( the_author() ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 48 ); ?></a>
				</div>
				<?php
			}
		?>

	</div>
	<?php
		if ( is_single() ) {
			?><h2 class="entry-title"><?php the_title(); ?></h2><?php
		} else {
			?><h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2><?php
		}
	?>
</header>

<?php

	if ( is_single() ) {
		?>
		<div class="entry-content clearfix">
			<?php the_content(); ?>
		</div>
		<?php pearl_link_pages(); ?>
		<footer class="entry-footer clearfix">
			<div class="entry-tags">
				<?php
					$tags_heading = '<span>' . esc_html__( 'tags widget:', 'pearl-antarctica' ) . '</span>';
					the_tags( $tags_heading, '', '' );
				?>
			</div>
			
			<?php 
			/* MP JAC 2018 */
			$first_category = pearl_first_category_link();

			if ( ! empty( $first_category ) ) {
				?>
				<div class="post-cat">
					<?php echo wp_kses( $first_category, wp_kses_allowed_html() ); ?>
				</div>
				<?php
			}
			
			
			// list categories - TODO, NON-FUNCTIONAL
			
			$categories = get_the_category(get_the_ID());
			if (!empty($categories)) {
			    for($i = 0; $i < count($categories); $i++) {
			        $cat_name = $categories[$i]->name;
			        $cat_link = get_term_link($categories[$i]->term_id);
			        $gen_link = ' <a href="' . esc_url( $cat_link ) . '">' . esc_html( $cat_name ) . '</a>';
			        ?>
			            <div class="post-cat">
					        <?php echo $gen_link; ?>
				        </div>
			        <?php
			    }
			    
			}			
			do_action( 'pearl_blog_social_share' ); ?>
		</footer>
		<?php
	} else {
		?>
		<div class="entry-summary clearfix">
			<p><?php echo wp_trim_words( get_the_content(), apply_filters( 'pearl_blog_trim_words', 50 ), apply_filters( 'pearl_blog_trim', '...' ) ); ?></p>
		</div>
		<a href="<?php the_permalink(); ?>"
		   class="btn btn-default single-post-link"><?php esc_html_e( 'Continue Reading', 'pearl-antarctica' ); ?> <i class="fa fa-long-arrow-right"></i></a>
		<?php do_action( 'pearl_blog_social_share' );
	}

?>