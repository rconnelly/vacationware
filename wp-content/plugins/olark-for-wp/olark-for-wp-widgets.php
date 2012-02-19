<?php
/*=== LEGAL INFORMATION ===
   Copyright (C) 2011 Russell Osborne <projects@burningpony.com> - www.burningpony.com

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program. If not, see <http://www.gnu.org/licenses/>.
*/
class Olark_Callout_Widget extends WP_Widget {
    /** constructor */
    function Olark_Callout_Widget() {
		global $themename;
		$widget_ops = array('classname' => 'custom-recent-widget', 'description' => __( "Custom callout image for olark.") );
		$control_ops = array('width' => 250, 'height' => 200);
		$this->WP_Widget('Olark_Callout_Widget', __('Olark Callout Widget'), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract( $args );
 		echo $before_widget;
		 if (!empty($title))
		   echo $before_title . $title . $after_title;;
?>
			<div class="olark_for_wp">
				<a href="javascript:void(0);" onclick="habla_window.expand()">
					<img src="<?php  echo ($instance['default'])?>?online=<?php echo $instance['offline']?>&offline=<?php echo $instance['online']?>" border=0>
				</a>
			</div>
<?php		
		echo $after_widget;
    }
    function update($new_instance, $old_instance) {				
        	$instance = $old_instance;
			$instance['default'] = $new_instance['default'];
			$instance['online'] = $new_instance['online'];
			$instance['offline'] = $new_instance['offline'];		
        return $instance;
    }

    function form($instance) {	
		$default = isset($instance['default']) ? esc_attr($instance['default']) : '';
		if ( !isset($instance['default']) || !$online = (string) $instance['default'] )
			$default = "http://images-async.olark.com/status/4379-1434713-10-8892/image.png";			
		$online = isset($instance['online']) ? esc_attr($instance['online']) : '';
		if ( !isset($instance['online']) || !$online = (string) $instance['online'] )
			$online = "http://static.olark.com/images/image-orangelark-available.png";
		$offline = isset($instance['offline']) ? esc_attr($instance['offline']) : '';
		if ( !isset($instance['offline']) || !$offline = (string) $instance['offline'] )
			$offline = "http://static.olark.com/images/image-orangelark-unavailable.png";
        ?>
		<p><label for="<?php echo $this->get_field_id('default'); ?>"><?php _e('Default Image:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('default'); ?>" name="<?php echo $this->get_field_name('default'); ?>" type="text" value="<?php echo $default; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('online'); ?>"><?php _e('Online Image:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('online'); ?>" name="<?php echo $this->get_field_name('online'); ?>" type="text" value="<?php echo $online; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('offline'); ?>"><?php _e('Offline Image:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('offline'); ?>" name="<?php echo $this->get_field_name('offline'); ?>" type="text" value="<?php echo $offline; ?>" /></p>
        <?php 
    }

}

add_action('widgets_init', create_function('', 'return register_widget("Olark_Callout_Widget");'));

?>