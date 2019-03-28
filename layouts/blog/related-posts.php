<div class="another-post">
    <div class="row">
        <?php

        $categories = get_the_category();
        $cat_slugs  = array();

        foreach ( $categories as $category ) {
            $cat_slugs[] = $category->slug;
        }

        $posts = get_posts( array(
            'posts_per_page' => 3,
            'post__not_in' => array( get_the_ID() ),
            'meta_key'  => '_thumbnail_id',
            'meta_compare' => 'EXISTS',
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field'    => 'slug',
                    'terms'    => $cat_slugs,
                ),
            )
        ) );

        if ( $posts ) {
            foreach ( $posts as $post ) {

            setup_postdata( $post );

                ?>
                <div class="col-xs-6 col-sm-4">
                    <div class="post-feature-img">
                        <a href="<?php the_permalink(); ?>" class="img-hover">
                            <?php the_post_thumbnail( 'pearl_image_size_475_360' ); ?>
                        </a>
                    </div>
                    <div class="entry-header">
                        <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p class="post-meta"><?php the_time( get_option( 'date_format' ) ); ?>, <?php esc_html_e( 'posted in', 'pearl-antarctica' ); pearl_first_category_link(); ?></p>
                    </div>
                </div>
                <?php
            }

            wp_reset_postdata();
        }
        ?>
    </div>
</div>