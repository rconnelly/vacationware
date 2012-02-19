<?php
// =============================== TS Recent Posts widget ======================================
class TS_RecentPostWidget extends WP_Widget {
    /** constructor */

	function TS_RecentPostWidget() {
		$widget_ops = array('classname' => 'widget_ts_recent_posts', 'description' => __('Shows a list of recent posts','templatesquare') );
		$this->WP_Widget('ts-recent-posts', __('TS - Recent Posts','templatesquare'), $widget_ops);
	}


  /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', empty($instance['title']) ? __('TS Recent Posts','templatesquare') : $instance['title']);
		$category = apply_filters('widget_category', $instance['category']);
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
						
								<?php  if (have_posts()) : ?>
								<ul class="latestpost">
								<?php $querycat = $category;?>
								<?php 
									query_posts("showposts=3&category_name=" . $querycat);
									global $post;
								?>
								<?php while (have_posts()) : the_post(); ?>
								<?php
									
									$custom = get_post_custom($post->ID);
									$cf_thumb = "";
									
									if(isset($custom["thumb"][0])){
										$cf_thumb = $custom["thumb"][0];
										if($cf_thumb!=""){
											$cf_thumb = "<img src='" . $cf_thumb . "' alt=''  width='80' height='80' class='alignleft'/>";
										}
									}
									
								?>	
								<li>
								<?php if($cf_thumb!=""){ echo $cf_thumb; } ?>
								<span class="date"><?php  the_time('M, d Y') ?></span>
								<?php $excerpt = get_the_excerpt(); echo ts_string_limit_words($excerpt,15);?>
								<a href="<?php the_permalink() ?>" class="more" rel="bookmark" title="<?php _e('Permanent Link to', 'templatesquare');?> <?php the_title_attribute(); ?>"><?php _e('Read More...', 'templatesquare');?></a>
								</li>
								<?php endwhile; ?>
								</ul>
								<?php endif; ?>

								<?php wp_reset_query();?>
								
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
		$instance['category'] = (isset($instance['category']))? $instance['category'] : "";
					
        $title = esc_attr($instance['title']);
		$category = esc_attr($instance['category']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'templatesquare'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			
            <p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category:', 'templatesquare'); ?> <input class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" type="text" value="<?php echo $category; ?>" /></label></p>
        <?php 
    }

} // class  Widget
?>