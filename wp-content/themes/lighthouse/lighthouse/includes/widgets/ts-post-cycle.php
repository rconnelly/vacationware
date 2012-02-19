<?php
// =============================== TS Post Cycle widget ======================================
class TS_PostCycleWidget extends WP_Widget {
    /** constructor */
	function TS_PostCycleWidget() {
		$widget_ops = array('classname' => 'widget_ts_post_cycle', 'description' => __('TS - Post Cycle','templatesquare') );
		$this->WP_Widget('ts-post-cycle', __('TS - Post Cycle','templatesquare'), $widget_ops);
	}


    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
		
		$instance['title'] = (isset($instance['title']))? $instance['title'] : "";
		$instance['limit'] = (isset($instance['limit']))? $instance['limit'] : "";
		$instance['cat'] = (isset($instance['cat']))? $instance['cat'] : "";
		$instance['posttype'] = (isset($instance['posttype']))? $instance['posttype'] : "";
		$instance['effect'] = (isset($instance['effect']))? $instance['effect'] : "";
		
        $title = apply_filters('widget_title', $instance['title']);
		$limit = apply_filters('widget_title', $instance['limit']);
		$cat = apply_filters('widget_title', $instance['cat']);
		$posttype = apply_filters('widget_posttype', $instance['posttype']);
		$effect = apply_filters('widget_effect', $instance['effect']);
		
		if($effect=="fade"){
		$boxslideshow="boxslideshow";
		}else{
		$boxslideshow="boxslideshow2";
		}
        ?>
		

              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title .'<a class="next"></a><a class="prev"></a>'. $after_title; ?>
						
						<?php if($posttype=="thinkbox"){?>
						<div class="textwidget">
							<div class="<?php echo $boxslideshow; ?>">
								
								<?php 
									$limittext = $limit;
									global $more;	$more = 0;
									query_posts('&thinkbox-category='.$cat .'&showposts=-1');
									global $post;
									
									while (have_posts()) : the_post(); 
										$custom = get_post_custom($post->ID);
										$tbname = (isset($custom["tb-name"]))? $custom["tb-name"][0] : "";
										$tbinfo = (isset($custom["tb-info"]))? $custom["tb-info"][0] : "";
								?>
								
								<div class="cycle">

								<?php if($limittext=="" || $limittext==0){ ?>
									<blockquote class="quote">
									<div>
									<?php the_excerpt(); ?>
									 </div></blockquote>
									 <div class="name-testi">
									 <span class="user"><?php echo $tbname; ?></span>
									 <br style="line-height:4px" /><?php echo $tbinfo; ?>
									 </div>
								<?php }else{ ?>
									<blockquote class="quote">
									<div>
									<?php $excerpt = get_the_excerpt(); echo ts_string_limit_words($excerpt,$limittext).'... ';?>
									 </div></blockquote>
									 <div class="name-testi">
									 <span class="user"><?php echo $tbname; ?></span>
									 <br style="line-height:4px" /><?php echo $tbinfo; ?></div>
								<?php } ?>
								</div>
								<?php endwhile; ?>
								<?php wp_reset_query();?>
							</div>
							<!-- end of boxslideshow -->
						</div>
						
						<?php } else { ?>
						
						<div class="textwidget">
						
							<div class="<?php echo $boxslideshow; ?>">
								<?php $limittext = $limit;?>
								<?php global $more;	$more = 0;?>
							
								<?php 
									if($posttype=="display") { 
										query_posts('&display-category='.$cat .'&showposts=-1');
									} else { 
										query_posts("category_name=" . $cat);
									}
									global $post;
								?>
								
								<?php while (have_posts()) : the_post(); ?>	
								<?php
									$custom = get_post_custom($post->ID);
									$cf_thumb = (isset($custom["thumb-cycle"]))? $custom["thumb-cycle"][0] : "";
									if($cf_thumb!=""){
										$cf_thumb = "<img src='" . $cf_thumb . "' alt=''  width='300' height='80' />";
									}
								?>	
								<div class="cycle">
								<?php if($cf_thumb!=""){ echo $cf_thumb; } ?>
								<span class="wdt-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></span>
									<?php if($limittext=="" || $limittext==0){
									the_excerpt();
									}else{
									$excerpt = get_the_excerpt(); echo ts_string_limit_words($excerpt,$limittext).'... ';
									?>
									<?php } ?>
								</div>
								<?php endwhile; ?>
								<?php wp_reset_query();?>
							</div>
							<!-- end of boxslideshow -->
							</div>
							<?php }?>
              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        $title = (isset($instance['title']))? esc_attr($instance['title']) : "";
		$limit = (isset($instance['limit']))? esc_attr($instance['limit']) : "";
		$cat = (isset($instance['cat']))? esc_attr($instance['cat']) : "";
		$posttype = (isset($instance['posttype']))? esc_attr($instance['posttype']) : "";
		$effect = (isset($instance['effect']))? esc_attr($instance['effect']) : "";
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'templatesquare'); ?> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			
 <p><label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Limit Text:', 'templatesquare'); ?> 
 <input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label></p>
 			
            <p><label for="<?php echo $this->get_field_id('posttype'); ?>"><?php _e('Post Type:', 'templatesquare'); ?><br />

		<select id="<?php echo $this->get_field_id('posttype'); ?>" name="<?php echo $this->get_field_name('posttype'); ?>" style="width:150px;" > 
		<option value="thinkbox" <?php echo ($posttype === 'thinkbox' ? ' selected="selected"' : ''); ?>><?php _e('Thinkbox','templatesquare');?></option>
		<option value="display" <?php echo ($posttype === 'display' ? ' selected="selected"' : ''); ?> ><?php _e('Display','templatesquare');?></option>
		<option value="" <?php echo ($posttype === '' ? ' selected="selected"' : ''); ?>><?php _e('Default','templatesquare');?></option>
		</select>
			</label></p>
			
 <p><label for="<?php echo $this->get_field_id('cat'); ?>"><?php _e('Category:', 'templatesquare'); ?> 
 <input class="widefat" id="<?php echo $this->get_field_id('cat'); ?>" name="<?php echo $this->get_field_name('cat'); ?>" type="text" value="<?php echo $cat; ?>" /></label></p>
 
  <p><label for="<?php echo $this->get_field_id('effect'); ?>"><?php _e('Effect:', 'templatesquare'); ?> <br />
 		<select id="<?php echo $this->get_field_id('effect'); ?>" name="<?php echo $this->get_field_name('effect'); ?>" style="width:150px;" > 
		<option value="fade" <?php echo ($effect === 'fade' ? ' selected="selected"' : ''); ?>>Fade</option>
		<option value="scroll" <?php echo ($effect === 'scroll' ? ' selected="selected"' : ''); ?> >Scroll</option>
		</select>

 </label></p>
			
        <?php 
    }

} // class Cycle Widget


?>