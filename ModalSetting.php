<?php
/**
 * Plugin Name: ModalSetting
 * Version: 1.0
 * Description: 
 * Author: Neo
 */

class ModalSetting {
    private $options;
    function __construct() {
        add_action("admin_menu",array($this,"add_plugin_page"));
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }
    
    public  function add_plugin_page(){
       // This page will be under "Settings"
        add_options_page(
            'ModalSetting',
            'ModalSetting',
            'manage_options',
            'modal_setting_admin',
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        $this->options = get_option( 'modal_setting_options' );
        ?>
        <div class="wrap">

            <form method="post" action="options.php" class="modal-settings-form">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'modal_setting_option_group' );
                do_settings_sections( 'modal_setting_admin' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }
    
    public function page_init()
    {
        register_setting(
            'modal_setting_option_group', // Option group
            'modal_setting_options', // Option name
            array( $this, 'my_sanitize' ) // Sanitize
        );

        add_settings_section(
            'modal_setting_section', // ID
            'Modal Setting', // Title
            array( $this, 'print_section_info' ), // Callback
            'modal_setting_admin' // Page
        );
                                
        add_settings_field(
            'book_tour_background_image ', // ID
            'Book Tour Background Image Setting: ', // Title
            array( $this, 'book_tour_background_image_callback' ), // Callback
            'modal_setting_admin', // Page
            'modal_setting_section'
        );
        
        add_settings_field(
            'enquiry_background_image ', // ID
            'Enquiry Background Image Setting: ', // Title
            array( $this, 'enquiry_background_image_callback' ), // Callback
            'modal_setting_admin', // Page
            'modal_setting_section'
        );
    }
    
    function book_tour_background_image_callback(){
            $book_tour_background_image = $this->options["book_tour_background_image"]; 
            ?>
            <p>
            <img style="max-width:200px;height:auto;" id="book-tour-background-image-preview" src="<?php if ( isset ( $book_tour_background_image ) ){ echo $book_tour_background_image; } ?>" />
            <input type="hidden" name="modal_setting_options[book_tour_background_image]" id="book_tour_background_image" value="<?php if ( isset ( $book_tour_background_image ) ){ echo $book_tour_background_image; } ?>" />   

            <button id="set-book-tour-image-button" class="button insert-media add_media">Add Media</button>
            <br>
            <button id="replace-book-tour-image-button" class="button insert-media add_media">Replace</button>
            <button id="remove-book-tour-image-button" class="button insert-media add_media">Remove</button>

            <?php if ( isset ( $book_tour_background_image) && !empty( $book_tour_background_image )){
                echo "<script>jQuery('#set-book-tour-image-button').hide();</script>";
                echo "<script>jQuery('#replace-book-tour-image-button').show();</script>";
                echo "<script>jQuery('#remove-book-tour-image-button').show();</script>";
            }else{
                echo "<script>jQuery('#set-book-tour-image-button').show();</script>";
                echo "<script>jQuery('#replace-book-tour-image-button').hide();</script>";
                echo "<script>jQuery('#remove-book-tour-image-button').hide();</script>";
            }?>

            </p>
            
            <script>
    //Set banner Click Event
    jQuery('#set-book-tour-image-button').click(function() {
        var send_attachment_bkp = wp.media.editor.send.attachment;
        wp.media.editor.send.attachment = function(props, attachment) {
            jQuery('#book_tour_background_image').val(attachment.url);
        jQuery('#book-tour-background-image-preview').attr('src',attachment.url);
            wp.media.editor.send.attachment = send_attachment_bkp;
            jQuery('#set-book-tour-image-button').hide();
            jQuery('#replace-book-tour-image-button').show();
            jQuery('#remove-book-tour-image-button').show();
        };
        wp.media.editor.open();
        return false;
    });

    //Replace banner Click Event
    jQuery('#replace-book-tour-image-button').click(function() {
        var send_attachment_bkp = wp.media.editor.send.attachment;
        wp.media.editor.send.attachment = function(props, attachment) {
            jQuery('#book_tour_background_image').val(attachment.url);
        jQuery('#book-tour-background-image-preview').attr('src',attachment.url);
            wp.media.editor.send.attachment = send_attachment_bkp;
            jQuery('#set-book-tour-image-button').hide();
            jQuery('#replace-book-tour-image-button').show();
            jQuery('#remove-book-tour-image-button').show();
        };
        wp.media.editor.open();
        return false;
    });
    //Remove banner Click Event
    jQuery('#remove-book-tour-image-button').click(function(){
        jQuery('#book_tour_background_image').val("");
        jQuery('#book-tour-background-image-preview').attr('src',"");
        jQuery('#set-book-tour-image-button').show();
        jQuery('#replace-book-tour-image-button').hide();
        jQuery('#remove-book-tour-image-button').hide();
        return false;
    });
</script>
        <?php 
    }
    
    function enquiry_background_image_callback(){
            $enquiry_background_image = $this->options["enquiry_background_image"]; 
            ?>
            <p>
            <img style="max-width:200px;height:auto;" id="enquiry-background-image-preview" src="<?php if ( isset ( $enquiry_background_image ) ){ echo $enquiry_background_image; } ?>" />
            <input type="hidden" name="modal_setting_options[enquiry_background_image]" id="enquiry_background_image" value="<?php if ( isset ( $enquiry_background_image ) ){ echo $enquiry_background_image; } ?>" />   

            <button id="set-enquiry-image-button" class="button insert-media add_media">Add Media</button>
            <br>
            <button id="replace-enquiry-image-button" class="button insert-media add_media">Replace</button>
            <button id="remove-enquiry-image-button" class="button insert-media add_media">Remove</button>

            <?php if ( isset ( $enquiry_background_image) && !empty( $enquiry_background_image )){
                echo "<script>jQuery('#set-enquiry-image-button').hide();</script>";
                echo "<script>jQuery('#replace-enquiry-image-button').show();</script>";
                echo "<script>jQuery('#remove-enquiry-image-button').show();</script>";
            }else{
                echo "<script>jQuery('#set-enquiry-image-button').show();</script>";
                echo "<script>jQuery('#replace-enquiry-image-button').hide();</script>";
                echo "<script>jQuery('#remove-enquiry-image-button').hide();</script>";
            }?>

            </p>
            
            <script>
    //Set banner Click Event
    jQuery('#set-enquiry-image-button').click(function() {
        var send_attachment_bkp = wp.media.editor.send.attachment;
        wp.media.editor.send.attachment = function(props, attachment) {
            jQuery('#enquiry_background_image').val(attachment.url);
        jQuery('#enquiry-background-image-preview').attr('src',attachment.url);
            wp.media.editor.send.attachment = send_attachment_bkp;
            jQuery('#set-enquiry-image-button').hide();
            jQuery('#replace-enquiry-image-button').show();
            jQuery('#remove-enquiry-image-button').show();
        };
        wp.media.editor.open();
        return false;
    });

    //Replace banner Click Event
    jQuery('#replace-enquiry-image-button').click(function() {
        var send_attachment_bkp = wp.media.editor.send.attachment;
        wp.media.editor.send.attachment = function(props, attachment) {
            jQuery('#enquiry_background_image').val(attachment.url);
        jQuery('#enquiry-background-image-preview').attr('src',attachment.url);
            wp.media.editor.send.attachment = send_attachment_bkp;
            jQuery('#set-enquiry-image-button').hide();
            jQuery('#replace-enquiry-image-button').show();
            jQuery('#remove-enquiry-image-button').show();
        };
        wp.media.editor.open();
        return false;
    });
    //Remove banner Click Event
    jQuery('#remove-enquiry-image-button').click(function(){
        jQuery('#enquiry_background_image').val("");
        jQuery('#enquiry-background-image-preview').attr('src',"");
        jQuery('#set-enquiry-image-button').show();
        jQuery('#replace-enquiry-image-button').hide();
        jQuery('#remove-enquiry-image-button').hide();
        return false;
    });
</script>
        <?php 
    }

    public function my_sanitize( $input )
    {
        $new_input = array();
	if( isset( $input['book_tour_background_image'] ) ){
            $new_input['book_tour_background_image'] = esc_attr($input['book_tour_background_image']);
	}
        
        if( isset( $input['enquiry_background_image'] ) ){
            $new_input['enquiry_background_image'] = esc_attr($input['enquiry_background_image']);
	}
        
        return $new_input;
    }
    
    /**
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }
}

$ModalSetting = new ModalSetting();
