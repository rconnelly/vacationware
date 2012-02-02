	<div id="slider_container">
	<div id="slideshow_navigation">
	<div id="pager"></div>
	</div><!-- end slideshow navigation -->
		<div id="slideshow">
			<?php
			$optSlider = get_option('templatesquare_slider_option');
			$buttontext = get_option('templatesquare_slider_buttontext');
			?> 
			<?php if($optSlider=="opt1"){ ?> 
			<?php
				$qryarr = array(
					"post_type" => "property",
					"post_status" => "publish",
					"posts_per_page" => -1
				);
				query_posts($qryarr);
				while ( have_posts() ) : the_post();
				
				$currencyunit 	= get_option("templatesquare_property_currency");
				$areaunit 		= get_option("templatesquare_property_area_unit");
				
				$prefix = 'ts_';
				
				$custom = get_post_custom($post->ID);
				$propertyTitle = get_the_title($post->ID);
				$listingSlider = (isset($custom[$prefix."listingSlider"][0]))? $custom[$prefix."listingSlider"][0] : "";
				$propertyType = (isset($custom[$prefix."propertyType"][0]))? $custom[$prefix."propertyType"][0] : "";
				$address = (isset($custom[$prefix."address"][0]))? $custom[$prefix."address"][0] : "";
				$city = (isset($custom[$prefix."city"][0]))? $custom[$prefix."city"][0] : "";
				$state = (isset($custom[$prefix."state"][0]))? $custom[$prefix."state"][0] : "";
				$zipcode = (isset($custom[$prefix."zipcode"][0]))? $custom[$prefix."zipcode"][0] : "";
				$houseSize = (isset($custom[$prefix."houseSize"][0]))? $custom[$prefix."houseSize"][0] : "";
				$yearBuilt = (isset($custom[$prefix."yearBuilt"][0]))? $custom[$prefix."yearBuilt"][0] : "";
				$baths = (isset($custom[$prefix."baths"][0]))? $custom[$prefix."baths"][0] : "";
				$beds = (isset($custom[$prefix."beds"][0]))? $custom[$prefix."beds"][0] : "";
				$sleeps = (isset($custom[$prefix."sleeps"][0]))? $custom[$prefix."sleeps"][0] : "";
				$shortDescription = (isset($custom[$prefix."shortDescription"][0]))? $custom[$prefix."shortDescription"][0] : "";
				$price = (isset($custom[$prefix."price"][0]))? $custom[$prefix."price"][0] : "";
                $rates = (isset($custom[$prefix."rates"][0]))? $custom[$prefix."rates"][0] : "";
				
				if($listingSlider!=true){continue;}
				
				$addr = $address . ' ' . $city . ' , ' . $state .' '. $zipcode ;
				 
			?>	
				
			<div class="cycle">
			
				<?php
						
					if(!has_post_thumbnail( $post->ID )){
						$attachments = get_children( array(
							'post_parent' => $post->ID,
							'numberposts' => -1,
							'post_type' => 'attachment',
							'order' => 'DESC',
							'post_mime_type' => 'image')
							);   
							
						if(count($attachments)!=0){         
										
						 $propertyimage = "";
						 foreach ( $attachments as $att_id => $attachment ) {
							
							$getimage = wp_get_attachment_image_src($att_id, 'property-slider-home', true);
							$propertyimage = $getimage[0];
				
						}
						
						echo '<img src="'.$propertyimage.'" alt="" />';
						
						}else{
						
						echo '<img src="'.get_bloginfo('stylesheet_directory') . "/images/nophoto518x360.jpg".'" alt="" />';
						
						}
						
					}else{
					
						the_post_thumbnail('property-slider-home',  array('alt' =>'', 'title' =>''));
					
					}
						
				
				?>
			
				<div class="frame-slide-text">
				    <h2>
				        <?php echo $propertyTitle ?>
                    </h2>
                    <?php if($shortDescription != "") echo '<p>'.$shortDescription.'</p>'; ?>
					<ul class="slide-text">
						<?php
						if($sleeps!=""){echo '<li><span class="slide-label">'.__('Sleeps').'</span>'.$sleeps.'</li>';}
						if($baths!=""){echo '<li><span class="slide-label">'.__('Baths','templatesquare').'</span>'.$baths.'</li>';}
						if($beds!=""){echo '<li><span class="slide-label">'.__('Beds','templatesquare').'</span>'.$beds.'</li>';}
						?>
					</ul>
					<div class="frame-price">
						<?php if($rates!=""){echo '<div class="slider-price">'. nl2br($rates) .'</div>';} ?>
					</div>

                    <div class="slider-button"><a href="<?php the_permalink(); ?>"><?php echo $buttontext;?></a></div>
				</div>
			</div><!-- end cycle -->
			
			<?php endwhile; wp_reset_query(); ?>
			
			<?php } else { ?>
			
			<?php 
			query_posts("post_type=slider&post_status=publish&posts_per_page=-1");
			while ( have_posts() ) : the_post();
			$custom = get_post_custom($post->ID);
			$cf_slideurl = $custom["slider-url"][0];
			$cf_thumb = $custom["thumb"][0];
			?>
			
			<div class="cycle">
			
				<?php if(has_post_thumbnail( $the_ID) || $cf_thumb!=""){ ?>
					<?php 
						if($cf_thumb!=""){
							echo "<img src='" . $cf_thumb . "' alt=''  width='518' height='360' />";
						}else{
							the_post_thumbnail('slider-home',  array('alt' =>'', 'title' =>''));
						}
					?>
				<?php } ?>
			
				<div class="frame-slide-text">
					<?php 
					echo '<h1>'.get_the_title().'</h1>';
					$excerpt = get_the_excerpt(); echo ts_string_limit_words($excerpt,50).'... ';
					
					?>
					<br/><br/>
					<div class="slider-button">
					<?php if($cf_slideurl!=""){?>
						<a href="<?php echo $cf_slideurl; ?>"><?php echo $buttontext;?></a>
					<?php } ?> 
					</div>
				</div>
			</div><!-- end cycle -->
			
			<?php endwhile; wp_reset_query(); ?>
			
			<?php } ?>
			
		</div><!-- end #slideshow -->
	</div><!-- end #slide -->
