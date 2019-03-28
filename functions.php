<?php

require_once (__DIR__."/layouts/my_widget.php");
require_once(__DIR__ . "/layouts/contact-widget.php");
require_once(__DIR__ . "/layouts/jac-recent-posts-widget.php");

if (!function_exists('pearl_enqueue_child_styles')) {

    /**
     * Enqueue styles in the child theme
     */
    function pearl_enqueue_child_styles() {
        if (!is_admin()) {

            // dequeue and deregister parent default css
            wp_dequeue_style('parent-default');
            wp_deregister_style('parent-default');

            // dequeue parent custom css
            wp_dequeue_style('pearl-parent-custom');

            // parent default css
            wp_enqueue_style('parent-default', get_template_directory_uri() . '/style.css');

            // parent custom css
            wp_enqueue_style('pearl-parent-custom');

            // child default css
            wp_enqueue_style('child-default', get_stylesheet_uri(), array('parent-default'), '1.0.0', 'all');

            // child custom css
            wp_enqueue_style('pearl-child-custom', get_stylesheet_directory_uri() . '/child-custom.css', array('child-default'), '1.0.0', 'all');
            //wp_enqueue_style('emali-quiz-style', get_stylesheet_directory_uri() . '/emali_quiz_style.css', array('child-default'), '1.0.0', 'all');
            //wp_enqueue_style('emali-quiz-style', get_stylesheet_directory_uri() . '/emali_quiz_style.css');
            wp_enqueue_style('bootstrap-css', get_stylesheet_directory_uri() .'/bootstrap-modal.css', array(), '1.0.0', 'all');
            //wp_enqueue_script('bootstrap-css', get_stylesheet_directory_uri() .'/bootstrap-modal.js', array(), '1.0.0', 'all');
            //wp_enqueue_style('bootstrap-css-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css', array(), '1.0.0', 'all');
            //wp_enqueue_script('bootstrap-js-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js', array('jquery'), '1.0.0', 'all');
             //<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
            //<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        }
    }

}
add_action('wp_enqueue_scripts', 'pearl_enqueue_child_styles', PHP_INT_MAX);


if (!function_exists('pearl_load_translation_from_child')) {

    /**
     * Load translation files from child theme
     */
    function pearl_load_translation_from_child() {
        load_child_theme_textdomain('pearl-antarctica-child', get_stylesheet_directory() . '/languages');
    }

    add_action('after_setup_theme', 'pearl_load_translation_from_child');
}

/*
 * Override theme function
 */
if (!function_exists('pearl_header_banner_image')) {

    /**
     * Display Header Banner Image With Settings
     */
    function pearl_header_banner_image() {


        $background_repeat = 'no-repeat';
        $background_size = 'cover';
        $background_position = 'center-center';

        if (is_singular('post')) {
            $post_id = get_the_ID();
            $banner_image_id = get_post_meta($post_id, 'pearl_post_banner_image', true);
            if (!empty($banner_image_id)) {
                $background_url = wp_get_attachment_image_url($banner_image_id, 'full', false);
            } else {
                $background_url = get_option('pearl_banner_image', get_template_directory_uri() . '/img/sub-header-bg.jpg');
            }
        } else if (is_singular('portfolio')) {

            $background_url = get_option('pearl_portfolio_banner_image');

            if (empty($background_url)) {
                $background_url = get_option('pearl_banner_image', get_template_directory_uri() . '/img/sub-header-bg.jpg');
            }
        } else {

            if (is_home()) {
                $post_id = get_option('page_for_posts');
            } else {
                $post_id = get_the_ID();
            }

            $banner_image_id = get_post_meta($post_id, 'pearl_banner_image', true);

            if (!empty($banner_image_id)) {
                $background_url = wp_get_attachment_image_url($banner_image_id, 'full', false);
            } else {
                $background_url = get_option('pearl_banner_image', get_template_directory_uri() . '/img/sub-header-bg.jpg');
            }
        }


        echo 'background: url(' . esc_url($background_url) . '); ';
        echo 'background-repeat: ' . esc_html($background_repeat) . '; ';
        echo 'background-size: ' . esc_html($background_size) . '; ';
        echo 'background-position: ' . str_replace('-', ' ', esc_html($background_position)) . '; ';
    }

}

/*
 * Override theme function
 */
if ( ! function_exists( 'pearl_inline_css' ) ) {
	/**
	 * Build and return theme inline css
	 */
	function pearl_inline_css() {

		if ( is_home() ) {
			$post_id = get_option( 'page_for_posts' );
		} else {
			$post_id = get_the_ID();
		}

		// banner css
		$banner_padding        = 184;
		$banner_padding_bottom = 184;
		$banner_overlay        = 60;

		if ( is_singular( 'post' ) ) {

//			$banner_padding        = get_option( 'pearl_blog_banner_padding', 184 );
//			$banner_padding_bottom = get_option( 'pearl_blog_banner_padding_bottom', 184 );
//			$banner_overlay        = get_option( 'pearl_blog_banner_overlay', 60 );
                        
                        $meta_data = get_post_custom( $post_id );

			if ( ! empty( $meta_data['pearl_post_banner_padding'] ) ) {
				$banner_padding = esc_html( $meta_data['pearl_post_banner_padding'][0] );
			}

			if ( ! empty( $meta_data['pearl_post_banner_padding_bottom'] ) ) {
				$banner_padding_bottom = esc_html( $meta_data['pearl_post_banner_padding_bottom'][0] );
			}

			if ( ! empty( $meta_data['pearl_post_banner_opacity'][0] ) ) {
				$banner_overlay = esc_html( $meta_data['pearl_post_banner_opacity'][0] );
			}

		} else if ( is_singular( 'portfolio' ) ) {

			$banner_padding        = get_option( 'pearl_portfolio_banner_padding', 184 );
			$banner_padding_bottom = get_option( 'pearl_portfolio_banner_padding_bottom', 184 );
			$banner_overlay        = get_option( 'pearl_portfolio_banner_overlay', 60 );

		} else {

			$meta_data = get_post_custom( $post_id );

			if ( ! empty( $meta_data['pearl_banner_padding'] ) ) {
				$banner_padding = esc_html( $meta_data['pearl_banner_padding'][0] );
			}

			if ( ! empty( $meta_data['pearl_banner_padding_bottom'] ) ) {
				$banner_padding_bottom = esc_html( $meta_data['pearl_banner_padding_bottom'][0] );
			}

			if ( ! empty( $meta_data['pearl_banner_opacity'][0] ) ) {
				$banner_overlay = esc_html( $meta_data['pearl_banner_opacity'][0] );
			}
		}

		$banner_overlay = ( $banner_overlay * 100 ) / 100;

		if ( $banner_overlay > 99 ) {
			$banner_overlay = 1;
		} else {
			$banner_overlay = '0.' . $banner_overlay;
		}

		$custom_css = "
@media (min-width: 1200px) {
    .sub-header {
        padding-top: {$banner_padding}px;
        padding-bottom: {$banner_padding_bottom}px;
    }                   

}

.sub-header .bg-overlay {
        background-color: rgba(23, 32, 37, {$banner_overlay})
}

";
		/**
		 * Filters Pearl inline css.
		 *
		 * @since Pearl Antarctica 1.3.0
		 *
		 * @param string $custom_css String of inline css.
		 */
		$custom_css = apply_filters('pearl_inline_css', $custom_css);

		return $custom_css;
	}
}

/*
 * Add banner image for posts.
 */
if (!function_exists("pearl_register_post_metaboxes")) {
    
    function pearl_register_post_metaboxes($meta_boxes) {
        $prefix = 'pearl_post_';
        // Banner Meta Box Settings
        $meta_boxes[] = array(
            'id' => 'banner-meta-box-post',
            'title' => esc_html__('Banner Configuration', 'pearl-antarctica'),
            'pages'    => array( 'post'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => esc_html__('Banner Image', 'pearl-antarctica'),
                    'id' => "{$prefix}banner_image",
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                ),
                array(
                    'name' => esc_html__('Banner Sub-Title / Description', 'pearl-antarctica'),
                    'id' => "{$prefix}banner_description",
                    'type' => 'text',
                    'size' => '80'
                ),
                array(
                    'name' => esc_html__('Banner Top Space', 'pearl-antarctica'),
                    'desc' => esc_html__('Set banner top space.', 'pearl-antarctica'),
                    'id' => "{$prefix}banner_padding",
                    'type' => 'range',
                    'std' => '184',
                    'min' => '10',
                    'max' => '333'
                ),
                array(
                    'name' => esc_html__('Banner Bottom Space', 'pearl-antarctica'),
                    'desc' => esc_html__('Set banner bottom space.', 'pearl-antarctica'),
                    'id' => "{$prefix}banner_padding_bottom",
                    'type' => 'range',
                    'std' => '184',
                    'min' => '10',
                    'max' => '333'
                ),
                array(
                    'name' => esc_html__('Banner Overlay Opacity', 'pearl-antarctica'),
                    'id' => "{$prefix}banner_opacity",
                    'type' => 'range',
                    'std' => '60',
                    'min' => '10',
                    'max' => '100'
                ),
            )
        );
        // apply a filter before returning meta boxes
        $meta_boxes = apply_filters('pearl_register_post_metaboxes', $meta_boxes);

        return $meta_boxes;
    }

    add_filter('rwmb_meta_boxes', 'pearl_register_post_metaboxes');
}

/**
 * Enable additional theme options
 */
add_action('after_setup_theme', 'wordpress_setup');

function wordpress_setup() {
    // Menu positions
    register_nav_menu('copyright', 'Copyright');
}

add_action('widgets_init', 'wpb_load_widgets');

function wpb_load_widgets() {
    register_widget('jac_contact_widget');
    register_widget('my_widget');
    register_widget('jac_recent_posts_widget');
}


function load_media_files() {
    wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'load_media_files' );
require_once(__DIR__ . "/ModalSetting.php");

// INCLUDE EMALI_QUIZ AJAX
require_once(__DIR__."/emali_quiz.php");
//
//if(!function_exists("jac_recent_post_setting")){
//    add_action("admin_init","jac_recent_post_setting");
//    function jac_recent_post_setting(){
//        register_setting("my_option_group", "my_option_name","intval");
//    }
//}


