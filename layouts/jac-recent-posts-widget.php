<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of jac_recent_posts_widget
 *
 * @author Administrator
 */
class jac_recent_posts_widget extends WP_Widget {

    function __construct() {
        parent::__construct('jac_widget', 'jac_recent_posts_widget');
    }

    const DEFAULT_TITLE = "RECENT BLOG POSTS";
    const DEFAULT_SHOW_TOTAL_NUMBER_OF_POSTS    = 10;
    const DEFAULT_SHOW_NUMBER_OF_IMAGE_POSTS    = 2;
    const DEFAULT_EXCERPT_LENGTH                 = 10;
    //
    //put your code here
    function widget($args, $instance) {
        $order_by        =  'date';
        $title = $instance['show_title'];
        $skip_number_of_posts = $instance['show_images_of_posts'];
        $number_of_posts =  $instance['show_totalnumber_of_posts'];
	$excerpt_title_length = $instance['excerpt_length'];
        $link   = $instance['link'];

        // WP_Query arguments
        $post_args = array(
                'post_type'           => 'post',
                'posts_per_page'      => intval( $number_of_posts ),
                'meta_key'            => '_thumbnail_id',
                'meta_compare'        => 'EXITS',
                'orderby'             => esc_html( $order_by ),
                'ignore_sticky_posts' => 1
        );

        // The Query
        $query = new WP_Query( $post_args );
        ?>
        <div class = "list-recent-posts-wrapper">
                <div class = "list-title-section">
                    <div>
                        <span class="title"> 
                            <?php 
                            if(empty($link)){
                               echo $title; 
                            }else{
                                $url = home_url();
                            ?>
                            <a href='<?php echo esc_url( $url ) . $link?>'>
                                    <?php echo $title?> 
                            </a>
                            <?php
                                }
                            ?>
                        </span>
                    </div>
                    <ul class = "list-of-recent-posts">
                    <?php
                    // The Loop
                    $list_images_count = 0;
                    while ( $query->have_posts() ) {
                            $list_images_count++;
                            if($list_images_count <= $skip_number_of_posts){
                                continue;
                            }
                            $query->the_post();
                            ?>
                            <li class = "item-of-recent-posts">
                                <div class="post-content">
                                    <?php
                                        $excerpt = $this->get_excerpt(get_the_title(),$excerpt_title_length);
                                    ?>
                                    <div class="post-title">
                                        <a class = "recent-posts-link" href="<?php the_permalink(); ?>">
                                            <span class = "post-title-span"><?php echo $excerpt?></span>
                                            <span class = "read-more">Read More</span>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <?php
                    }
                    ?>
                    </ul>
                </div>
                <div class="list-image-section cff-wrapper">
                    <ul class = "list-of-recent-posts">
                    <?php
                    // The Loop
                        $list_images_count = 0;
                        while ( $query->have_posts() ) :
                            $list_images_count++;
                            if($list_images_count > $skip_number_of_posts) break;
                                $query->the_post();
                                ?>
                                <li class = "item-of-recent-posts">
                                    <?php
                                        $excerpt = $this->get_excerpt(get_the_title(),$excerpt_title_length);
                                    ?>
                                    <div class="post-thumb cff-media-wrap">
                                            <a  class = "img-link" href="<?php the_permalink(); ?>">
													<div class = "photo-hover recent-posts"></div>
                                                    <?php the_post_thumbnail('medium_large'); ?>
                                            </a>
                                    </div>
                                    <div class ="cff-text-wrapper">
                                        <p class ="cff-post-text">
                                            <span class = "cff-text">
                                                <?php echo $excerpt?>
                                            </span>
                                        </p>
                                    </div>
                                </li>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </ul>
                </div>
            </div>
        <?php
    }
    
    function update($new_instance, $old_instance) {
        $instance = array();
        $instance['show_title'] = (!empty($new_instance['show_title'])) ? strip_tags($new_instance['show_title']) : self::DEFAULT_TITLE;
        $instance['link'] = (!empty($new_instance['link'])) ? strip_tags($new_instance['link']) : "";
        $instance['show_totalnumber_of_posts'] = (!empty($new_instance['show_totalnumber_of_posts'])) ? strip_tags($new_instance['show_totalnumber_of_posts']) : self::DEFAULT_SHOW_TOTAL_NUMBER_OF_POSTS;
        $instance['show_images_of_posts'] = (!empty($new_instance['show_images_of_posts'])) ? strip_tags($new_instance['show_images_of_posts']) : self::DEFAULT_SHOW_NUMBER_OF_IMAGE_POSTS;
        $instance['excerpt_length'] = (!empty($new_instance['excerpt_length'])) ? strip_tags($new_instance['excerpt_length']) : self::DEFAULT_EXCERPT_LENGTH;
        return $instance;
    }
    
    function form($instance) {
        $show_title = isset($instance['show_title']) ? strip_tags($instance['show_title']) : self::DEFAULT_TITLE;
        $link = isset($instance['link']) ? strip_tags($instance['link']) : "";
        $show_totalnumber_of_posts = isset($instance['show_totalnumber_of_posts']) ? strip_tags($instance['show_totalnumber_of_posts']) : self::DEFAULT_SHOW_TOTAL_NUMBER_OF_POSTS;
        $show_images_of_posts = isset($instance['show_images_of_posts']) ? strip_tags($instance['show_images_of_posts']) : self::DEFAULT_SHOW_NUMBER_OF_IMAGE_POSTS;
        $excerpt_length = isset($instance['excerpt_length']) ? strip_tags($instance['excerpt_length']) : self::DEFAULT_EXCERPT_LENGTH;
        ?>
        <p>
            <label for = "<?php echo $this->get_field_id('show_title') ?>">Title:</label>
            <input class="widefat"
                   id="<?php echo $this->get_field_id('show_title'); ?>" 
                   name="<?php echo $this->get_field_name('show_title'); ?>" 
                   type="text"
                   value = "<?php echo $show_title ?>">
            </input>
        </p>
        <p>
            <label for = "<?php echo $this->get_field_id('link') ?>">Link:</label>
            <input class="widefat"
                   id="<?php echo $this->get_field_id('link'); ?>" 
                   name="<?php echo $this->get_field_name('link'); ?>" 
                   type="text"
                   value = "<?php echo $link ?>">
            </input>
        </p>
        <p>
            <label for = "<?php echo $this->get_field_id('show_totalnumber_of_posts') ?>">Number of posts to show:</label>
            <input class="widefat"
                   id="<?php echo $this->get_field_id('show_totalnumber_of_posts'); ?>" 
                   name="<?php echo $this->get_field_name('show_totalnumber_of_posts'); ?>" 
                   type="number"
                   step="1" 
                   min="0"
                   value = "<?php echo $show_totalnumber_of_posts ?>">
            </input>
        </p>
        <p>
            <label for = "<?php echo $this->get_field_id('show_images_of_posts') ?>">Number of image posts to show:</label>
            <input class="widefat"
                   id="<?php echo $this->get_field_id('show_images_of_posts'); ?>" 
                   name="<?php echo $this->get_field_name('show_images_of_posts'); ?>" 
                   type="number"
                   step="1" 
                   min="0"
                   value = "<?php echo $show_images_of_posts ?>">
            </input>
        </p>
        <p>
            <label for = "<?php echo $this->get_field_id('excerpt_length') ?>">Excerpt Length:</label>
            <input class="widefat"
                   id="<?php echo $this->get_field_id('excerpt_length'); ?>" 
                   name="<?php echo $this->get_field_name('excerpt_length'); ?>" 
                   type="number"
                   step="1" 
                   min="0"
                   value = "<?php echo $excerpt_length ?>">
            </input>
        </p>
        <?php 
    }

    function get_excerpt($content,$length){
        $excerpt = $content;
        $excerpt = strip_tags($excerpt);
        $excerpt = substr($excerpt, 0, $length);

        if(strlen($excerpt) >= $length){
           $excerpt = substr($excerpt, 0, strripos($excerpt, " ")); 
           $excerpt .="...";
        }                               
        return $excerpt;
    }
}