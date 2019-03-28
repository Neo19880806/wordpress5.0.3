<?php

    $post_format = ( ! empty( get_post_format() ) ) ? get_post_format() : 'standard';

    $classes = array(
        'post-item',
        'format-' . $post_format,
        'has-post-thumbnail',
        'hentry',
        'clearfix',
    );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
    <?php

        if ( has_post_thumbnail() && is_single() ) {
            ?>
            <div class="post-thumbnail">
                <a href="<?php the_post_thumbnail_url( 'full' ); ?>" data-rel="lightcase">
                    <?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) ); ?>
                </a>
            </div>
            <?php
        } else if ( has_post_thumbnail() ) {
            ?>
            <div class="post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( ); ?>
                </a>
            </div>
            <?php
        }

        get_template_part( 'layouts/blog/loop-content' );
    ?>
</article>