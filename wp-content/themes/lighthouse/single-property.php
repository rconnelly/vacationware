<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Light House
 * @since Light House 1.0
 */

get_header(); ?>
		<div id="maincontent">
			<div id="content">
				<?php 
				while ( have_posts() ) : the_post(); ?>
				<?php
				
				$currencyunit 	= get_option("templatesquare_property_currency");
				$areaunit 		= get_option("templatesquare_property_area_unit");
				$lotunit 			= get_option("templatesquare_property_lot_unit");
				
				$prefix = 'ts_';
				
				$custom = get_post_custom($post->ID);
				$price = (isset($custom[$prefix."price"][0]))? $custom[$prefix."price"][0] : "";
				$listingType = (isset($custom[$prefix."listingType"][0]))? $custom[$prefix."listingType"][0] : "";
				$propertyType = (isset($custom[$prefix."propertyType"][0]))? $custom[$prefix."propertyType"][0] : "";
				$listingTitle = (isset($custom[$prefix."listingTitle"][0]))? $custom[$prefix."listingTitle"][0] : "";
				$listingNote = (isset($custom[$prefix."listingNote"][0]))? $custom[$prefix."listingNote"][0] : "";
				
				$address = (isset($custom[$prefix."address"][0]))? $custom[$prefix."address"][0] : "";
				$city = (isset($custom[$prefix."city"][0]))? $custom[$prefix."city"][0] : "";
				$state = (isset($custom[$prefix."state"][0]))? $custom[$prefix."state"][0] : "";
				$zipcode = (isset($custom[$prefix."zipcode"][0]))? $custom[$prefix."zipcode"][0] : "";

				$rates= (isset($custom[$prefix."rates"][0]))? $custom[$prefix."rates"][0] : "";
				$beds = (isset($custom[$prefix."beds"][0]))? $custom[$prefix."beds"][0] : "";
				$baths = (isset($custom[$prefix."baths"][0]))? $custom[$prefix."baths"][0] : "";
				$houseSize = (isset($custom[$prefix."houseSize"][0]))? $custom[$prefix."houseSize"][0] : "";
				$lotSize = (isset($custom[$prefix."lotSize"][0]))? $custom[$prefix."lotSize"][0] : "";
				$yearBuilt = (isset($custom[$prefix."yearBuilt"][0]))? $custom[$prefix."yearBuilt"][0] : "";
				$neighborHood = (isset($custom[$prefix."neighborHood"][0]))? $custom[$prefix."neighborHood"][0] : "";
				$style = (isset($custom[$prefix."style"][0]))? $custom[$prefix."style"][0] : "";
				$stories = (isset($custom[$prefix."stories"][0]))? $custom[$prefix."stories"][0] : "";
				$garage = (isset($custom[$prefix."garage"][0]))? $custom[$prefix."garage"][0] : "";
				$propertyFeatures = (isset($custom[$prefix."propertyFeatures"][0]))? $custom[$prefix."propertyFeatures"][0] : "";
				$fireplaceFeatures = (isset($custom[$prefix."fireplaceFeatures"][0]))? $custom[$prefix."fireplaceFeatures"][0] : "";
				$heatingFeatures = (isset($custom[$prefix."heatingFeatures"][0]))? $custom[$prefix."heatingFeatures"][0] : "";
				$externalConstruction = (isset($custom[$prefix."externalConstruction"][0]))? $custom[$prefix."externalConstruction"][0] : "";
				$roofing = (isset($custom[$prefix."roofing"][0]))? $custom[$prefix."roofing"][0] : "";
				$interiorFeatures = (isset($custom[$prefix."interiorFeatures"][0]))? $custom[$prefix."interiorFeatures"][0] : "";
				$exteriorFeatures = (isset($custom[$prefix."exteriorFeatures"][0]))? $custom[$prefix."exteriorFeatures"][0] : "";
				
				
				$emailTo = get_the_author_meta( 'user_email' );
				$disableContact = (isset($custom[$prefix."disableContact"][0]))? $custom[$prefix."disableContact"][0] : "";
				
				?>
				<?php 
					$t=$address . ' '. $city . ' '. $state . ' '. $zipcode;
					
					if($listingTitle=="Use address as title"){
						$ltitle=$t;
					}else{
						$ltitle=get_the_title();
					}
					
					$subjecttitle = $ltitle;
					
					echo '<h2 class="underline">'.$ltitle.'</h2>';
				 ?>
				 
				 <?php
					$attachments = get_children( array(
						'post_parent' => $post->ID,
						'post_type' => 'attachment',
						'order' => '',
						'post_mime_type' => 'image')
						);            
				 ?>
				 
				 <!--GALLERY PROPERTY IMAGE-->
				 
 				<?php if(count($attachments)==1){ ?>
				
				<div id="container-image-one">
					<?php
					 foreach ( $attachments as $att_id => $attachment ) {
					$getimage = wp_get_attachment_image_src($att_id, 'property-gallery', true);
					$propertyimage = $getimage[0];
					echo '<img src="'.$propertyimage.'" />';
					 }
					?>
				</div>
				
				<?php }elseif(count($attachments)==0){ ?>	
				
				<div id="container-image">
					<?php
					echo '<img src="'.get_stylesheet_directory_uri() . "/images/nophoto620x360.jpg".'" />';
					?>
				</div>
				
				<?php } else{ ?>
				 
				<div id="container-slider">
					<ul id="slideshow_detail">
					
					<?php if(count($attachments)!=0){ ?>
					
						<?php
							 foreach ( $attachments as $att_id => $attachment ) {
						 ?>
								
							<li>
								<h3></h3>
								<span>
									<?php
										$getimage = wp_get_attachment_image_src($att_id, 'property-gallery', true);
										$propertyimage = $getimage[0];
										echo $propertyimage;
									 ?>
								</span>
								<p></p>
								<?php
									$getimageThumb = wp_get_attachment_image_src($att_id, 'property-gallery-thumb', true);
									$propertyimageThumb = $getimageThumb[0];
									
									echo '<img src="'. $propertyimageThumb.'" alt="thumb" />';
								?>						
							</li>
							
						<?php }  ?>
						
				<?php }else{?>
				
						<li>
							<h3></h3>
							<span>
								<?php
									
									echo get_stylesheet_directory_uri() . "/images/nophoto620x360.jpg";
								 ?>
							</span>
							<p></p>
							<?php
								echo '<img src="'.get_stylesheet_directory_uri() . "/images/nophoto185x120.jpg".'" alt="thumb" />';
							?>						
						</li>
						
				<?php } ?>
						
					</ul>
					<div id="wrapper">
						<div id="fullsize">
                        	<img id="preloadimg" src="<?php echo get_template_directory_uri(); ?>/images/preload.gif" alt="Wait a Minute" />
							<div id="imgprev" class="imgnav" title="Previous Image"></div>
							<div id="imglink"></div>
							<div id="imgnext" class="imgnav" title="Next Image"></div>
							<div id="image"></div>
							<div id="information">
								<h3></h3>
								<p></p>
							</div>
						</div>
						<div id="thumbnails">
							<div id="slideleft" title="Slide Left"></div>
							<div id="slidearea">
								<div id="slider"></div>
							</div>
							<div id="slideright" title="Slide Right"></div>
						</div>
					</div>
					<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/compressed.js"></script>
					<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/gallery.js"></script>
					<script type="text/javascript">
					<!-- 
						$('slideshow_detail').style.display='block';
						$('wrapper').style.display='block';
						var slideshow_detail=new TINY.slideshow_detail("slideshow_detail");
						window.onload=function(){
							slideshow_detail.auto=true;
							slideshow_detail.speed=5;
							slideshow_detail.link="linkhover";
							slideshow_detail.info="information";
							slideshow_detail.thumbs="slider";
							slideshow_detail.left="slideleft";
							slideshow_detail.right="slideright";
							slideshow_detail.scrollSpeed=4;
							slideshow_detail.spacing=8;
							slideshow_detail.active="#fff";
							slideshow_detail.init("slideshow_detail","image","imgprev","imgnext","imglink");
						}
					//-->  
					</script>
			</div><!-- end content-slider -->
			
			<?php } ?>
			
			<!--END GALLERY PROPERTY IMAGE-->
			
			<div class="clear"></div><br /><br />
			
			<h2 class="underline"><?php _e('Property Details', 'templatesquare'); ?></h2>
			<div id="property-detail">
			<div class="one_half">
				<ul class="box_text">
					<?php
						if($beds!=""){echo'<li><span class="left">'.__('Beds', 'templatesquare').'</span>'.$beds.'</li>';}else{ echo'<li><span class="left">'.__('Beds', 'templatesquare').'</span>-</li>';}
						//if($houseSize!=""){echo'<li><span class="left">'.__('House Size', 'templatesquare').'</span>'.$houseSize.' '.$areaunit.'</li>';}else{echo'<li><span class="left">'.__('House Size', 'templatesquare').'</span>-</li>';}
						//if($price!=""){echo'<li><span class="left">'.__('Price', 'templatesquare').'</span>'.$currencyunit.' '.number_format($price, 0, '.', ',').'</li>';}else{echo'<li><span class="left">'.__('Price', 'templatesquare').'</span>-</li>';}
						//if($propertyType!=""){echo'<li><span class="left">'.__('Property Type', 'templatesquare').'</span>'.$propertyType.'</li>';}else{echo'<li><span class="left">'.__('Property Type', 'templatesquare').'</span>-</li>';}
						//if($neighborHood!=""){echo'<li><span class="left">'.__('Neighborhood', 'templatesquare').'</span>'.$neighborHood.'</li>';}else{echo'<li><span class="left">'.__('Neighborhood', 'templatesquare').'</span>-</li>';}
						//if($stories!=""){echo'<li><span class="left">'.__('Stories', 'templatesquare').'</span>'.$stories.'</li>';}else{echo'<li><span class="left">'.__('Stories', 'templatesquare').'</span>-</li>';}
					?>
				</ul>	
			</div>
			<div class="one_half last">
				<ul class="box_text">
					<?php
						if($baths!=""){echo'<li><span class="left">'.__('Baths', 'templatesquare').'</span>'.$baths.'</li>';}else{echo'<li><span class="left">'.__('Baths', 'templatesquare').'</span>-</li>';}
						
						//if($lotSize!=""){echo'<li><span class="left">'.__('Lot Size', 'templatesquare').'</span>'.$lotSize.' '.$lotunit.'</li>';}else{echo'<li><span class="left">'.__('Lot Size', 'templatesquare').'</span>-</li>';}
						
						/*if($price!="" && $houseSize!=""){
							$priceSqft = $currencyunit.' '.number_format(($price / $houseSize),0,".",",");
						}else{
							$priceSqft = "-";
						}
						echo'<li><span class="left">'.__('Price/'.$areaunit, 'templatesquare').'</span>'.$priceSqft.'</li>';

                        						*/
						//if($yearBuilt!=""){echo'<li><span class="left">'.__('Year Built', 'templatesquare').'</span>'.$yearBuilt.'</li>';}else{echo'<li><span class="left">'.__('Year Built', 'templatesquare').'</span>-</li>';}
						
						//if($style!=""){echo'<li><span class="left">'.__('Style', 'templatesquare').'</span>'.$style.'</li>';}else{echo'<li><span class="left">'.__('Style', 'templatesquare').'</span>-</li>';}
						
						//if($garage!=""){echo'<li><span class="left">'.__('Garage', 'templatesquare').'</span>'.$garage.'</li>';}else{echo'<li><span class="left">'.__('Garage', 'templatesquare').'</span>-</li>';}
						
					?>
				</ul>	
			</div>
				<ul class="box_text">
					<?php
					if($rates!=""){echo'<li><span class="left">'.__('Rates').'</span><span class="right">'.$rates.'</span></li>';}else{echo'<li><span class="left">'.__('Rates').'</span><span class="right">-</span></li>';}
						if($propertyFeatures!=""){echo'<li><span class="left">'.__('Property Features', 'templatesquare').'</span><span class="right">'.$propertyFeatures.'</span></li>';}else{echo'<li><span class="left">'.__('Property Features', 'templatesquare').'</span><span class="right">-</span></li>';}
						/*if($fireplaceFeatures!=""){echo'<li><span class="left">'.__('Fireplace Features', 'templatesquare').'</span><span class="right">'.$fireplaceFeatures.'</span></li>';}else{echo'<li><span class="left">'.__('Fireplace Features', 'templatesquare').'</span><span class="right">-</span></li>';}
						if($heatingFeatures!=""){echo'<li><span class="left">'.__('Heating Features', 'templatesquare').'</span><span class="right">'.$heatingFeatures.'</span></li>';}else{echo'<li><span class="left">'.__('Heating Features', 'templatesquare').'</span><span class="right">-</span></li>';}
						if($externalConstruction!=""){echo'<li><span class="left">'.__('External Construction', 'templatesquare').'</span><span class="right">'.$externalConstruction.'</span></li>';}else{echo'<li><span class="left">'.__('External Construction', 'templatesquare').'</span><span class="right">-</span></li>';}
						if($roofing!=""){echo'<li><span class="left">'.__('Roofing', 'templatesquare').'</span><span class="right">'.$roofing.'</span></li>';}else{echo'<li><span class="left">'.__('Roofing', 'templatesquare').'</span><span class="right">-</span></li>';}
						if($interiorFeatures!=""){echo'<li><span class="left">'.__('Interior Features', 'templatesquare').'</span><span class="right">'.$interiorFeatures.'</span></li>';}else{echo'<li><span class="left">'.__('Interior Features', 'templatesquare').'</span><span class="right">-</span></li>';}
						if($exteriorFeatures!=""){echo'<li><span class="left">'.__('Exterior Features', 'templatesquare').'</span><span class="right">'.$exteriorFeatures.'</span></li>';}else{echo'<li><span class="left">'.__('Exterior Features', 'templatesquare').'</span><span class="right">-</span></li>';}
					*/
					?>
				</ul>	
				</div>
				
				<div class="clear"></div><br />
				
				<?php the_content( __( 'Read More', 'templatesquare' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'templatesquare' ), 'after' => '</div>' ) ); ?>
				<?php edit_post_link( __( 'Edit', 'templatesquare' ), '<span class="edit-link">', '</span>' ); ?>
				
				<div class="clear"></div><br /><br />
				
				<h2 class="underline"><?php _e('Location','templatesquare');?></h2>
				
				
				<?php
				$location=$address . ' '. $city . ' '. $state . ' '. $zipcode;
				$maps = str_replace(' ', '+', $location);
				?>
				
<iframe width="620" height="353" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $maps ;?> &amp;aq=&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo $maps ;?>&amp;spn=0.020085,0.045447&amp;z=14&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=<?php echo $maps ;?>&amp;aq=&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo $maps ;?>&amp;spn=0.020085,0.045447&amp;z=14" style="color:#0000FF;text-align:left"><?php _e('View Larger Map','templatesquare');?></a></small>
				
				
				<?php comments_template( '', true ); ?>
				
			</div><!-- end #content -->
			
			<?php endwhile; ?>
			
			<div class="sidebar_right">
			<div class="sidebar">
				<ul>
				
					<li class="widget-container widget_text">
						<h2 class="widget-title"><?php _e('Contact Information'); ?></h2>
						
						<div class="agent">
						
						<?php echo'<div class="alignleft">
						'.get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'templatesquare_author_bio_avatar_size', 60 ) ).'</div>
						<span class="black">'.get_the_author() .'</span><br/>';
						
						if ( get_the_author_meta( 'description' ) ) : 
							the_author_meta( 'description' );
						endif;
                        echo '
						<a href="mailto:'.get_the_author_meta( 'user_email' ).'">'.get_the_author_meta( 'user_email' ). '</a><br/>
						' ;
						echo '<a href="http://twitter.com/'.get_the_author_meta( 'twitter' ).'">@'.get_the_author_meta( 'twitter' ). '</a><br/>' ;
						?>
					  </div>
					 
					</li>
					
					
					<?php 
					
					if($disableContact!=true){ ?>
					<!--
					<li class="widget-container widget_search">
						<h2 class="widget-title"><?php _e('Contact Agent', 'templatesquare');?></h2>
						<?php
						
						include_once(TEMPLATEPATH."/includes/property/agentform.php");
						 
						if(isset($emailSent) && $emailSent == true) {
							echo '<div id="messageThanks"><strong>'.__("Contact Form Submitted!", "templatesquare").'</strong><p>'.__("We will be in touch soon.").'</p><div>';
						}else{
						?>
						<form action="<?php echo get_template_directory_uri(); ?>/includes/property/agentform.php" id="contact-agent" method="post">
							<fieldset>
							<ul>
								<li>
									<label for="contactName"><?php _e('First Name','templatesquare');?>:</label>
									<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" size="21" />
								</li>
								<li>
									<label for="contactName2"><?php _e('Last Name','templatesquare');?>:</label>
									<input type="text" name="contactName2" id="contactName2" value="<?php if(isset($_POST['contactName2'])) echo $_POST['contactName2'];?>" class="required requiredField" size="21" />
								</li>
							</ul>
							<label for="email"><?php _e('Email','templatesquare');?>:</label><br />
							<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" size="34" /><br />
							<label for="commentsText"><?php _e('Message','templatesquare');?>:</label><br />
							<textarea name="comments" id="commentsText" rows="3" cols="37" class="required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
							<input type="submit" name="submit" class="button" value="submit"/>
							<input type="hidden" name="submitted" id="submitted" value="true" />
                            <input type="hidden" name="ltitle" id="ltitle" value="<?php echo trim($subjecttitle); ?>" />
							<input type="hidden" name="emailto" id="emailto" value="<?php echo $emailTo; ?>" />
							</fieldset>
							<div id="validateContainer">
								<span class="error"></span>
								<?php if($nameError != '') { echo '<span class="error">'.$nameError.'</span>';?><?php } ?>
								<?php if($nameError2 != '') { echo '<span class="error">'.$nameError2.'</span>';?><?php } ?>
								<?php if($emailError != '') { echo '<span class="error">'.$emailError.'</span>';?><?php } ?>
								<?php if($commentError != '') { echo '<span class="error">'.$commentError.'</span>';?><?php } ?>
							</div>
						</form>	
						<?php } ?>
											
					</li>
					-->
					<?php } ?>
					
					<li class="widget-container widget_text">
						<?php 
							
						function get_related_author_posts() {
						global $authordata, $post;
						
							$authors_posts = get_posts( array( 'author' => $authordata->ID, 'post__not_in' => array( $post->ID ), 'post_type' => 'property', 'posts_per_page' => 2, 'order' => 'ASC' ) );
							
							$output = '';
							if(count($authors_posts)){
								$output .='<h2 class="widget-title">'.__('Agent&acute;s Other Listings','templatesquare').'</h2>';
								$output .='<div class="property-list">';
							
								foreach ( $authors_posts as $authors_post ) {
									$output .= '<p>';							
									$prefix = 'ts_';
									
									$custom = get_post_custom($authors_post->ID);
									$listingTitle = (isset($custom[$prefix."listingTitle"][0]))? $custom[$prefix."listingTitle"][0] : "";
									$price = (isset($custom[$prefix."price"][0]))? $custom[$prefix."price"][0] : "";
									$beds = (isset($custom[$prefix."beds"][0]))? $custom[$prefix."beds"][0] : "";
									$baths = (isset($custom[$prefix."baths"][0]))? $custom[$prefix."baths"][0] : "";
									$houseSize = (isset($custom[$prefix."houseSize"][0]))? $custom[$prefix."houseSize"][0] : "";
									$address = (isset($custom[$prefix."address"][0]))? $custom[$prefix."address"][0] : "";
									$city = (isset($custom[$prefix."city"][0]))? $custom[$prefix."city"][0] : "";
									$state = (isset($custom[$prefix."state"][0]))? $custom[$prefix."state"][0]  : "";
									$zipcode = (isset($custom[$prefix."zipcode"][0]))? $custom[$prefix."zipcode"][0] : "";
									
									$t2='<span class="title">'. $address . ' '. $city . '</span><br/> '. $state . ' '. $zipcode.'<br/>';
									$t3 ='<span class="title">'.get_the_title($authors_post->ID).'</span><br/>';
									
									
									if($listingTitle=="Use address as title"){
										$ltitle2=$t2;
									}else{
										$ltitle2=$t3;
									}
									
									
									$auth_attachments = get_children( array(
										'post_parent' => $authors_post->ID,
										'post_type' => 'attachment',
										'posts_per_page' => 1,
										'order' => '',
										'post_mime_type' => 'image')
									);  
									
									if(count($auth_attachments)!=0){          
										
										// put the image in a array
										foreach ( $auth_attachments as $auth_att_id => $auth_attachment ) {
											
											$auth_imageWidget = wp_get_attachment_image_src($auth_att_id, 'property-agent-listing-widget', true);
											// the [0] position goes for the image URL
											$auth_propertyimageWidget = $auth_imageWidget[0];
											
											$output .= '<img src="'.$auth_propertyimageWidget.'" alt="" />';
											
										}
									
									} else{
									
										$output .= '<img src="'.get_stylesheet_directory_uri() . "/images/nophoto300x178.jpg".'" alt="" />';
									}
									
									$currencyunit 	= get_option("templatesquare_property_currency");
									$areaunit 		= get_option("templatesquare_property_area_unit");
									$output .= '
									<a href="'.get_permalink($authors_post->ID).'">'.$ltitle2.'</a>
									<span class="black">'.$currencyunit.' '.number_format($price, 0, '.', ',').'</span><br />
									<small>'.$beds.' beds, '.$baths.' baths, '.$houseSize.' '.$areaunit.'</small>
									';
									
									$output .= '</p>';	
										
								}
								 $output .= '</div>';
							 }
						
							return $output;
						}
						
						echo get_related_author_posts();
						
						 ?>
					</li>
				</ul>
				<?php get_sidebar('property');?>
            </div><!-- end #sidebar -->
			</div><!-- end #sidebar_right -->
			<div class="clear"></div>
		</div><!-- end #maincontent -->
<?php get_footer(); ?>
