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
                        }

                        // post author
                        get_template_part( 'layouts/blog/author' );

                        // related posts
                        get_template_part( 'layouts/blog/related-posts' );

                        // If comments are open and there is at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) {
                            comments_template();
                        }
                    ?>
                </main>
            </div>
        </div>
    </div>
<?php get_footer(); ?>