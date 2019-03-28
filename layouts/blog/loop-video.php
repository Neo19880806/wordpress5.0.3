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
        if ( has_post_thumbnail() ) {
            ?>
            <div class="post-thumbnail">
                <?php
                    $video_url = get_post_meta( get_the_ID(), 'pearl_video_url', true );
                    if ( ! empty ( $video_url ) ) {
                        ?>
                        <a data-rel="lightcase" href="<?php echo esc_url( $video_url ); ?>">
                            <?php the_post_thumbnail(); ?>
                        </a>
                        <?php
                    } else {
                        the_post_thumbnail();
                    }
                ?>
            </div>
            <?php
        }

        get_template_part( 'layouts/blog/loop-content' );
    ?>

</article>