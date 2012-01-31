<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage Light House
 * @since Light House 1.0
 */
?>
	</div><!-- end #centercolumn -->
	
	
	<div id="bottom-container">
		<div class="centercolumn">
		
			<div id="footer">
				<div id="footer-left">
					<?php 
					$sidefooteractive = 0;
					if(is_active_sidebar('footer1')){
						$sidefooteractive ++;
					}
					if(is_active_sidebar('footer2')){
						$sidefooteractive ++;
					}
					if(is_active_sidebar('footer3')){
						$sidefooteractive ++;
					}
					if(is_active_sidebar('footer4')){
						$sidefooteractive ++;
					}
					if($sidefooteractive==1){
						$classfootercontainer = "one_column";
					}elseif($sidefooteractive==2){
						$classfootercontainer = "one_half";
					}elseif($sidefooteractive==3){
						$classfootercontainer = "one_third";
					}elseif($sidefooteractive==4){
						$classfootercontainer = "one_fourth";
					}
					
					$islast2 = "";
					$islast3 = "";
					$islast4 ="";
					
					if(is_active_sidebar('footer4')){
						$islast4 = "last";
					}elseif(is_active_sidebar('footer3') && !is_active_sidebar('footer4')){
						$islast3 = "last";
					}elseif(is_active_sidebar('footer2') && !is_active_sidebar('footer3') && !is_active_sidebar('footer4')){
						$islast2 = "last";
					}
					
					 ?>
					 
					 <?php if(is_active_sidebar('footer1')){ ?>
					<div class="<?php echo $classfootercontainer;?>">
						<?php get_sidebar('footer1');?>
					</div><!-- end #one_fourth -->
					<?php } ?>
					
					<?php if(is_active_sidebar('footer2')){ ?>
					<div class="<?php echo $classfootercontainer." ".$islast2;?>">
						<?php get_sidebar('footer2');?>
					</div><!-- end #one_fourth -->
					<?php } ?>
					
					<?php if(is_active_sidebar('footer3')){ ?>
					<div class="<?php echo $classfootercontainer." ".$islast3;?>">
						<?php get_sidebar('footer3');?>
					</div><!-- end #one_fourth -->
					<?php } ?>
					
					<?php if(is_active_sidebar('footer4')){ ?>
					<div class="<?php echo $classfootercontainer." ".$islast4;?>">
						<?php get_sidebar('footer4');?>
					</div><!-- end #one_fourth -->
					<?php } ?>
					
				</div><!-- end #footer-left -->
				<div id="footer-right">
					<?php if(is_active_sidebar('footer5')){ ?>
						<?php get_sidebar('footer5');?>
					<?php } ?>
				</div><!-- end #footer-right -->
			</div><!-- end #footer -->
			<div class="clear"></div>
			<div id="copyright">
				<?php $foot= stripslashes(get_option('templatesquare_footer'))?>
				<?php if($foot==""){?>
				<?php _e('Copyright', 'templatesquare'); ?> &copy;
				<?php global $wpdb;
				$post_datetimes = $wpdb->get_results("SELECT YEAR(min(post_date_gmt)) AS firstyear, YEAR(max(post_date_gmt)) AS lastyear FROM $wpdb->posts WHERE post_date_gmt > 1970");
				if ($post_datetimes) {
					$firstpost_year = $post_datetimes[0]->firstyear;
					$lastpost_year = $post_datetimes[0]->lastyear;
	
					$copyright = $firstpost_year;
					if($firstpost_year != $lastpost_year) {
						$copyright .= '-'. $lastpost_year;
					}
					$copyright .= ' ';
	
					echo $copyright;
					echo '<a href="'.home_url( '/').'">'.get_bloginfo('name') .'</a>';
				}
			?>. <?php _e('All rights reserved.', 'templatesquare'); ?>
	
				<?php }else{?>
				<?php echo $foot; ?>
				<?php } ?>
			</div>
			
		 	<div class="clear"></div>
		</div><!-- end #centercolumn -->
	
	</div><!-- end #bottom-container -->
	<script type="text/javascript"> Cufon.now(); </script> <!-- to fix cufon problems in IE browser -->
	<?php
		/* Always have wp_footer() just before the closing </body>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to reference JavaScript files.
		 */
	
		wp_footer();
	?>
	<?php $google = stripslashes(get_option('templatesquare_google'));?>
	<?php if($google=="false"){?>
	<?php }else{?>
	<?php echo $google; ?>
	<?php } ?>

</body>
</html>
