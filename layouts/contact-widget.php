<?php
/**
 * Created by PhpStorm.
 * User: matthewgibbs
 * Date: 19/7/18
 * Time: 11:21 AM
 */
class jac_contact_widget extends WP_Widget {

    function __construct() {
        parent::__construct('jac_contact', 'Contact');
    }

    // Front-end
    public function widget( $args, $instance ) {

        echo "
            <ul class='contact-list'>
                <li>". $instance['line1'] ."</li>
                <li>". $instance['line2'] ."</li>
                <li>". $instance['line3'] ."</li>
                <li>". $instance['line4'] ."</li>
            </ul>
        ";
    }

    // Widget Backend
    public function form($instance) {

        // Load existing values.
        $line1 = isset($instance['line1']) ? $instance['line1'] : "";
        $line2 = isset($instance['line2']) ? $instance['line2'] : "";
        $line3 = isset($instance['line3']) ? $instance['line3'] : "";
        $line4 = isset($instance['line4']) ? $instance['line4'] : "";

        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'line-1' ); ?>">Line 1</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'line-1' ); ?>" name="<?php echo $this->get_field_name( 'line1' ); ?>" type="text" value="<?php echo $line1; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'line-2' ); ?>">Line 2</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'line-2' ); ?>" name="<?php echo $this->get_field_name( 'line2' ); ?>" type="text" value="<?php echo $line2; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'line-3' ); ?>">Line 3</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'line-3' ); ?>" name="<?php echo $this->get_field_name( 'line3' ); ?>" type="text" value="<?php echo $line3; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'line-4' ); ?>">Line 4</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'line-4' ); ?>" name="<?php echo $this->get_field_name( 'line4' ); ?>" type="text" value="<?php echo $line4; ?>" />
        </p>
        <?php
    }

    // Save widget values
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['line1'] = (!empty( $new_instance['line1'] ) ) ? strip_tags( $new_instance['line1'] ) : '';
        $instance['line2'] = (!empty( $new_instance['line2'] ) ) ? strip_tags( $new_instance['line2'] ) : '';
        $instance['line3'] = (!empty( $new_instance['line3'] ) ) ? strip_tags( $new_instance['line3'] ) : '';
        $instance['line4'] = (!empty( $new_instance['line4'] ) ) ? strip_tags( $new_instance['line4'] ) : '';
        return $instance;
    }
}