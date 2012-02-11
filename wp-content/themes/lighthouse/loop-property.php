<?php
/**
 * The loop that displays property.
 *
 * The loop displays the property.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage Light House
 * @since Light House 1.0
 */
?>
	
<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="posttitle"><?php _e( 'Not Found', 'templatesquare' ); ?></h1>
		<div class="entry">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'templatesquare' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php if (have_posts() ) : ?>

<?php $pLayout = get_option('templatesquare_property_layout');?>

<?php if($pLayout=="plist"){ ?>

		<!--PROPERTY LIST-->		
		
		<?php while ( have_posts() ) : the_post(); ?>
		
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

		$sleeps = (isset($custom[$prefix."sleeps"][0]))? $custom[$prefix."sleeps"][0] : "";
		$beds = (isset($custom[$prefix."beds"][0]))? $custom[$prefix."beds"][0] : "";
		$baths = (isset($custom[$prefix."baths"][0]))? $custom[$prefix."baths"][0] : "";
		$shortDescription = (isset($custom[$prefix."shortDescription"][0]))? $custom[$prefix."shortDescription"][0] : "";
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
		?>

		
		<div class="list_properties" id="post-<?php the_ID(); ?>">
			<div class="title_property2">
			<?php 
			$t=$address . ' '. $city . ' '. $state . ' '. $zipcode;
			
			if($listingTitle=="Use address as title"){
				$ltitle=$t;
			}else{
				$ltitle=get_the_title();
			}
			
			echo '<h2><a href="'.get_permalink().'">'.$ltitle.'</a></h2>';
			
			 ?>
			</div><!-- end .title_property2 -->
			<div class="clear"></div>
			<div class="list_img">
			<?php
			
			if(!has_post_thumbnail( $post->ID )){
				// lets get the type image and fully RANDOM.
				$attachments = get_children( array(
					'post_parent' => $post->ID,
					'numberposts' => 1,
					'post_type' => 'attachment',
					'orderby' => 'DESC',
					'post_mime_type' => 'image')
					);   
							 
				$propertyimage = "";				
				 foreach ( $attachments as $att_id => $attachment ) {
					
					// put the image in a array
					$getimage = wp_get_attachment_image_src($att_id, 'property-list', true);
					
					// the [0] position goes for the image URL
					$propertyimage = $getimage[0];
					
				}
				echo '<a href="'. get_permalink() .'">';
				if($propertyimage!=""){
				echo '<img src="'.$propertyimage.'" alt="" />';
				}else{
				echo '<img src="'.get_bloginfo('stylesheet_directory') . "/images/nophoto130x85.jpg".'" alt="" />';
				}
				echo '</a>';
				
			}else{

            	echo '<a href="'. get_permalink() .'">';
				the_post_thumbnail('property-list',  array('alt' =>'', 'title' =>''));
			    echo '</a>';
			}
			
			?>
			</div>
			<div class="list_text">
				<div class="avatar-right">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'templatesquare_author_bio_avatar_size', 70 ) );  ?>
				</div>
				<?php 


                if($shortDescription!=""){echo $shortDescription ." ". __("Short Description") . ' | ';}

				if($sleeps!=""){echo $sleeps ." ". __("Sleeps"). ' | ';}
				if($beds!=""){echo $beds ." ". __("Beds", "templatesquare"). ' | ';}
				if($baths!=""){echo $baths ." ". __("Baths", "templatesquare") . ' | ';}


				echo '<br /><br />';
				
				?>
			</div><!-- end .list_text -->
			<?php edit_post_link( __( 'Edit', 'templatesquare' ), '<span class="edit-link">', '</span>' ); ?>
			<div class="clear"></div>
		</div><!-- end .list_properties -->
		
		<?php endwhile; ?>


<?php }else{ ?>

	<!--PROPERTY GRID-->
	
	<?php 
		$disableadvancesearch = get_option("templatesquare_disable_advance_search_property");
		if($disableadvancesearch!=true){
			get_template_part('/includes/property/gridsearch');
		}
	?>
	
	<?php  $i=1; $addclass = ""; ?>
	
	
	<ul class="four_column_properties">
	
	<?php while ( have_posts() ) : the_post(); ?>

	<?php

	if(($i%4) == 0){ $addclass = "last";	}	
	
	$prefix = 'ts_';
	
	$currencyunit 	= get_option("templatesquare_property_currency");
	$areaunit 		= get_option("templatesquare_property_area_unit");
	$lotunit 			= get_option("templatesquare_property_lot_unit");
	
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


	$shortDescription = (isset($custom[$prefix."shortDescription"][0]))? $custom[$prefix."shortDescription"][0] : "";
    $sleeps = (isset($custom[$prefix."sleeps"][0]))? $custom[$prefix."sleeps"][0] : "";
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
	?>

	<li class="<?php echo $addclass;?>">
		<div class="col">
		<?php
		if(!has_post_thumbnail( $post->ID )){
			// lets get the type image and fully RANDOM.
			$attachments = get_children( array(
				'post_parent' => $post->ID,
				'numberposts' => 1,
				'post_type' => 'attachment',
				'order' => 'DESC',
				'post_mime_type' => 'image')
				);            
							
			 $propertyimage = "";
			 foreach ( $attachments as $att_id => $attachment ) {
				
				// put the image in a array
				$getimage = wp_get_attachment_image_src($att_id, 'property-grid', true);
				
				// the [0] position goes for the image URL
				$propertyimage = $getimage[0];
	
			}

            	echo '<a href="'. get_permalink() .'">';
			if($propertyimage!=""){
			echo '<img src="'.$propertyimage.'" alt="" />';
			}else{
			echo '<img src="'.get_bloginfo('stylesheet_directory') . "/images/nophoto185x120.jpg".'" alt="" />';
			}
			echo '<a/>';
			
		}else{

            echo '<a href="'. get_permalink() .'">';
			the_post_thumbnail('property-grid',  array('alt' =>'', 'title' =>''));
		    echo '<a/>';
		}
		?>
		
		<?php 
		$t=$address . ' '. $city . '<br/> '. $state . ' '. $zipcode;
		
		if($listingTitle=="Use address as title"){
			$ltitle=$t;
		}else{
			$ltitle=get_the_title($post->ID );
		}
		
		echo '<h6><a href="'. get_permalink() .'">'.$ltitle.'</a></h6>';
		 ?>
		 
		 <?php
		 if($beds!="" || $baths!="" || $houseSize!="" || $lotSize!=""){
			echo '<ul class="box_text">';
		 }

         if($shortDescription!=""){echo '<li class="leftContent">'.$shortDescription.'</li>';}
		 if($sleeps!=""){echo '<li><span class="left">'.__('Sleeps').': </span>'.$sleeps.'</li>';}else{echo '<li><span class="left">'.__('Sleeps').': </span>-</li>';}
		 if($beds!=""){echo '<li><span class="left">'.__('Beds', 'templatesquare').': </span>'.$beds.'</li>';}else{echo '<li><span class="left">'.__('Beds', 'templatesquare').': </span>-</li>';}
		 if($baths!=""){echo '<li><span class="left">'.__('Baths', 'templatesquare').': </span>'.$baths.'</li>';}else{echo '<li><span class="left">'.__('Baths', 'templatesquare').': </span>-</li>';}
		 //if($houseSize!=""){echo '<li><span class="left">'.__('House Size', 'templatesquare').': </span>'.$houseSize.' '.$areaunit.'</li>';}else{echo '<li><span class="left">'.__('House Size', 'templatesquare').': </span>-</li>';}
		 //if($lotSize!=""){echo '<li><span class="left">'.__('Lot Size', 'templatesquare').': </span>'.$lotSize.' '.$lotunit.'</li>';}else{echo '<li><span class="left">'.__('Lot Size', 'templatesquare').': </span>-</li>';}
		 
		 
		 if($beds!="" || $baths!="" || $houseSize!="" || $lotSize!=""){
			echo '</ul>';
		 }
		 
		 ?>
		 </div>
		 
	</li>
	<?php $i++; $addclass = "";  endwhile;?>
</ul>

<?php }?>
				
<?php endif; ?>


<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
 <?php if(function_exists('wp_pagenavi')) { ?>
	 <?php wp_pagenavi(); ?>
 <?php }else{ ?>
	<div id="nav-below" class="navigation">
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&laquo;</span> Older', 'templatesquare' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer <span class="meta-nav">&raquo;</span>', 'templatesquare' ) ); ?></div>
	</div><!-- #nav-below -->
<?php }?>
<?php endif; ?>
