<?php
// =============================== TS Property Tag widget ======================================
class TS_PropertyTagWidget extends WP_Widget {
    /** constructor */
	function TS_PropertyTagWidget() {
		$widget_ops = array('classname' => 'widget_ts_property_tag', 'description' => __('TS - Property Tag','templatesquare') );
		$this->WP_Widget('ts-property-tag', __('TS - Property Tag','templatesquare'), $widget_ops);
	}


    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        ?>
		

              <?php echo $before_widget; ?>
			  	<?php if ( $title )
                        echo $before_title . $title . $after_title;
						$cloud_args = array('taxonomy' => 'propertytag');
						wp_tag_cloud( $cloud_args ); 
						
					?>
           <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {
		$instance['title'] = (isset($instance['title']))? $instance['title'] : "";				
        $title = esc_attr($instance['title']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'templatesquare'); ?> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			
			
        <?php 
    }

} // class Cycle Widget


?>