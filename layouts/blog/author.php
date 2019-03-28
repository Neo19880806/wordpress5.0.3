<?php

    $author_meta = get_user_meta( get_the_author_meta( 'ID' ) );

    if( ! empty( $author_meta['description'][0] ) ) {

        ?>
        <div class="about-bio-wrap clearfix">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 170 ); ?>
            <div class="author-bio">
                <div class="clearfix">
                <span class="social-profiles">
                    <?php

                        if( ! empty(  $author_meta['facebook_profile'][0] ) ) :
                            echo '<a class="facebook" target="_blank" href="'. esc_url( $author_meta['facebook_profile'][0] ) .'"><i class="fa fa-facebook"></i></a>';
                        endif;

                        if( ! empty(  $author_meta['twitter_profile'][0] ) ) :
                            echo '<a class="twitter" target="_blank" href="'. esc_url( $author_meta['twitter_profile'][0] ) .'"><i class="fa fa-twitter"></i></a>';
                        endif;


                        if( ! empty(  $author_meta['google_profile'][0] ) ) :
                            echo '<a class="gplus" target="_blank" href="'. esc_url( $author_meta['google_profile'][0] ) .'"><i class="fa fa-google-plus"></i></a>';
                        endif;

                        if( ! empty(  $author_meta['youtube_profile'][0] ) ) :
                            echo '<a class="youtube" target="_blank" href="'. esc_url( $author_meta['youtube_profile'][0] ) .'"><i class="fa fa-youtube"></i></a>';
                        endif;

                        if( ! empty(  $author_meta['instagram_profile'][0] ) ) :
                            echo '<a class="instagram" target="_blank" href="'. esc_url( $author_meta['instagram_profile'][0] ) .'"><i class="fa fa-instagram"></i></a>';
                        endif;
                    ?>
                </span>
                    <h4><?php the_author(); ?></h4>
                </div>
                <p><?php echo esc_html( $author_meta['description'][0] ); ?></p>
                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="view-all-btn" title="<?php esc_attr( the_author() ); ?>"><?php esc_html_e( 'View All Posts by Author', 'pearl-antarctica' ); ?></a>
            </div>
        </div>
<?php } ?>