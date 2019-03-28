<?php get_header(); ?>
    <!-- Container -->
    <div class="container main-container blog-page">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">

                <!-- Main Content -->
                <main id="main" class="main">

                    <?php

                        if ( have_posts() ) {
                            while ( have_posts() ) {
                                the_post();

                                get_template_part( 'layouts/blog/loop', get_post_format() );
                            }
                        } else {
                            echo '<h4>'. esc_html__('No Posts Found!', 'pearl-antarctica');
                        }

                        $args = array(
                            'type' => 'list',
                            'prev_text' => '<span aria-hidden="true"><i class="fa fa-angle-left"></i></span>',
                            'next_text' => '<span aria-hidden="true"><i class="fa fa-angle-right"></i></span>',
                        );

                        the_posts_pagination( $args );
                    ?>
                </main>
            </div>
        </div>
    </div>
<?php get_footer(); ?>