<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of my_widget
 *
 * @author Administrator
 */
class my_widget extends WP_Widget {

    function __construct() {
        //parent::__construct('jac_contact', 'Contact');
        parent::__construct('jac_widget', 'my_widget');
    }

    //put your code here
    function widget($args, $instance) {
        echo "
            <ul class = 'my_widget'>
            <li>" . $instance['line1'] . "</li>
            <li>" . $instance['line2'] . "</li>
            <li>" . $instance['line3'] . "</li>
            </ul>
            ";
    }

    function update($new_instance, $old_instance) {
        $instance = array();
        $instance['line1'] = (!empty($new_instance['line1'])) ? strip_tags($new_instance['line1']) : "";
        $instance['line2'] = (!empty($new_instance['line2'])) ? strip_tags($new_instance['line2']) : "";
        $instance['line3'] = (!empty($new_instance['line3'])) ? strip_tags($new_instance['line3']) : "";
        return $instance;
    }

    function form($instance) {
        $line1 = isset($instance['line1']) ? strip_tags($instance['line1']) : "";
        $line2 = isset($instance['line2']) ? strip_tags($instance['line2']) : "";
        $line3 = isset($instance['line3']) ? strip_tags($instance['line3']) : "";
        ?>
        <p>
            <label for = "<?php echo $this->get_field_id('line1') ?>">Line 1</label>
            <input class="widefat"
                   id="<?php echo $this->get_field_id('line1'); ?>" 
                   name="<?php echo $this->get_field_name('line1'); ?>" 
                   type="text"
                   value = "<?php echo $line1 ?>">
            </input>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('line2'); ?>">Line 2</label>
            <input class="widefat"
                   id ="<?php echo $this->get_field_id('line2') ?> "
                   name ="<?php echo $this->get_field_name('line2') ?> "
                   type ="text"
                   value="<?php echo $line2 ?> ">
            </input>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('line3'); ?>">Line 3</label>
            <input class="widefat"
                   id ="<?php echo $this->get_field_id('line3') ?> "
                   name ="<?php echo $this->get_field_name('line3') ?> "
                   type ="text"
                   value="<?php echo $line3 ?> ">
            </input>
        </p>
        <?php
    }

}
