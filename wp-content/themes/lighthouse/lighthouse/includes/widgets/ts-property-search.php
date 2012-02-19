<?php
// =============================== TS Property Search widget ======================================
class TS_PropertySearchWidget extends WP_Widget {
    /** constructor */
	function TS_PropertySearchWidget() {
		$widget_ops = array('classname' => 'widget_ts_property_search', 'description' => __('Displays a form for searching for properties','templatesquare') );
		$this->WP_Widget('ts-property-search', __('TS - Property Search','templatesquare'), $widget_ops);
	}


    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        ?>
		

              <?php echo $before_widget; ?>
			  	<?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
                        <?php 
							$optpropertytype 	= get_option("templatesquare_property_type");
							$optlistingtype 	= get_option("templatesquare_listing_type");
							$sizeunit			= get_option("templatesquare_property_area_unit");
							$maxbed				= get_option("templatesquare_property_num_bed");
							$maxbath			= get_option("templatesquare_property_num_bath");
                            $maxsleeps			= get_option("templatesquare_property_num_sleeps");
							
							
							$opttype = array(
								"property_type" 	=> explode(",",$optpropertytype),
								"listing_type" 		=> explode(",",$optlistingtype)
							);
							
							
							$advcity		= (isset($_GET['advcity']))? stripslashes(trim($_GET['advcity'])) : "";
							$advstate		= (isset($_GET['advstate']))? stripslashes(trim($_GET['advstate'])) : "";
							$advzipcode		= (isset($_GET['advzipcode']))? stripslashes(trim($_GET['advzipcode'])) : "";
							$advprice1 		= (isset($_GET['advprice1']))? stripslashes(trim($_GET['advprice1'])) : "";
							$advprice2 		= (isset($_GET['advprice2']))? stripslashes(trim($_GET['advprice2'])) : "";
							$advbed			= (isset($_GET['advbed']))? stripslashes(trim($_GET['advbed'])) : "";
							$advbath		= (isset($_GET['advbath']))? stripslashes(trim($_GET['advbath'])) : "";
							$advlisttype	= (isset($_GET['advlisttype']))? stripslashes(trim($_GET['advlisttype'])) : "";
							$advproptype	= (isset($_GET['advproptype']))? stripslashes(trim($_GET['advproptype'])) : "";
							$advsleeps	    = (isset($_GET['advsleeps']))? stripslashes(trim($_GET['advsleeps'])) : "";
							
						?>
						<form id="search" name="searchform" method="get" action="<?php echo home_url(); ?>">
						<div id="searchMain">
                        <?php
						/*
						<input type="search" id="s" name="s" title="<?php _e('Search Property','templatesquare');?>" placeholder="<?php _e('Search Property','templatesquare');?>" />
                        <br />
                        <label for="advtoggle">
                        	<input type="checkbox" id="advtoggle" name="advtoggle" value="" />
                            Use Advanced Search
                        </label>
						<br />
						*/
						?>
                        <div style="display:none;">
                        <input type="search" id="s" name="s" title="<?php _e('Search Property','templatesquare');?>" placeholder="<?php _e('Search Property','templatesquare');?>" value="search" />
                        </div>
                        <div class="advselectcont">
                            <label for="advlisttype">
                                <?php _e("Listing Type", "templatesquare"); ?> :<br />
                                <select name="advlisttype" id="advlisttype" class="advselect">
                                	<option value=""><?php _e("-Choose Type-","templatesquare"); ?></option>
									<?php foreach($opttype["listing_type"] as $optlisttype){ ?>
                                        <option value="<?php echo $optlisttype; ?>" <?php if(trim($optlisttype)==trim($advlisttype)){echo 'selected';}  ?> /><?php echo $optlisttype;?></option>
                                    <?php } ?>
                                </select>
                            </label>
                        </div>
                        <div class="advselectcont">
                            <label for="advproptype">
                                <?php _e("Property Type", "templatesquare"); ?> : <br />
                                <select name="advproptype" id="advproptype" class="advselect">
                                	<option value=""><?php _e("-Choose Type-","templatesquare"); ?></option>
									<?php foreach($opttype["property_type"] as $optproptype){ ?>
                                        <option value="<?php echo $optproptype; ?>" <?php if(trim($optproptype)==trim($advproptype)){echo 'selected';}  ?> /><?php echo $optproptype;?></option>
                                    <?php } ?>
                                </select>
                            </label>
                        </div>
                        <div class="clear"></div>
                        <label for="advcity">
                        	<?php _e("City", "templatesquare"); ?> : <br />
                        	<input type="text" id="advcity" name="advcity" class="txtlong" value="<?php echo $advcity;?>" />
                        </label>
                        <br />
                        <div id="advstatecont">
                        <label for="advstate">
                        	<?php _e("State", "templatesquare"); ?> : <br />
                        	<input type="text" id="advstate" name="advstate" value="<?php echo $advstate;?>" />
                        </label>
                        </div>
                        <div id="advzipcodecont">
                        <label for="advzipcode">
                        	<?php _e("Zip Code", "templatesquare"); ?> : <br />
                        	<input type="text" id="advzipcode" name="advzipcode" value="<?php echo $advzipcode; ?>" />
                        </label>
                        </div>
                        <div class="clear"></div>
                        	<?php _e("Price", "templatesquare"); ?> : <br />
                        	<input type="text" id="advprice1" name="advprice1" class="txtadvprice" value="<?php echo $advprice1; ?>" />
                            <?php _e("to", "templatesquare"); ?>
                            <input type="text" id="advprice2" name="advprice2" class="txtadvprice" value="<?php echo $advprice2; ?>" />
						<br />
                        <div id="advbedcont">
                        <label for="advbed">
                        	<?php _e("Bedroom(s)", "templatesquare"); ?> : <br />
                            <select name="advbed" id="advbed" class="advselect">
							<?php for($i=1;$i<=$maxbed;$i++){ ?>
                            	<option value="<?php echo $i; ?>" <?php if(trim($i)==trim($advbed)){echo 'selected';}?>><?php echo $i."+"; ?></option>
                            <?php } ?>
                            </select>
                        </label>
                        </div>
                        <div id="advbathcont">
                        <label for="advbath">
                        	<?php _e("Bathroom(s)", "templatesquare"); ?> : <br />
                            <select name="advbath" id="advbath" class="advselect">
							<?php for($i=1;$i<=$maxbath;$i++){ ?>
                            	<option value="<?php echo $i; ?>" <?php if(trim($i)==trim($advbath)){echo 'selected';}?> ><?php echo $i."+"; ?></option>
                            <?php } ?>
                            </select>
                        </label>
                        </div>
                        <div class="clear"></div>
                        <br />
                        <input type="hidden" name="post_type" value="property" />
						<button type="submit" value="search" id="searchsubmit"><?php _e('Search','templatesquare');?></button><br/>
						</div>
						</form>   
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