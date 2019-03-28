<?php get_header(); ?>
    <!-- Container -->
    <div class="container main-container default-page entry-content">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">

                <!-- Main Content -->
                <main id="main" class="main">

                    <?php

                        if ( have_posts() ) {
                            while ( have_posts() ) {
                                the_post();

                                if ( has_post_thumbnail() ) {
                                    ?>
                                    <div class="post-thumbnail">
                                        <?php the_post_thumbnail( ); ?>
                                    </div>
                                    <?php
                                }

                                the_content();
                            }
                        }

                        pearl_link_pages();

                        // If comments are open and there is at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) {
                            comments_template();
                        }
                    ?>
                </main>
            </div>
                    <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#quizModal">Open Modal</button>
		<?php get_template_part( 'modal' ); ?>
        </div>
    </div>
<?php get_footer(); ?>