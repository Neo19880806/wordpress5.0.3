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
    <blockquote>
        <?php the_content(); ?>
    </blockquote>
</article>