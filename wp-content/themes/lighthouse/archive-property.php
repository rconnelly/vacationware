<?php
/**
 * The template for displaying Archive Property.
 * @package WordPress
 * @subpackage Light House
 * @since Light House 1.0
 */

get_header(); ?>


		<?php
		$pLayout = get_option('templatesquare_property_layout');
		$numpost = get_option('templatesquare_property_post');
		if($pLayout=="pgrid"){
		$addclass="full";
		}
		?>

		<div id="maincontent">
			<div id="content"  class="<?php echo $addclass;?>">
			
				<h1 class="pagetitle">
					<?php 
					$authid = $_GET["authorid"];
					echo get_the_author_meta('display_name',$authid) .' '.'Listings' ; 
					 ?>
				</h1>
			
				
				<?php
				 global $wp_query;
				$authid = $_GET["authorid"];
				$wp_query = new WP_Query('post_type=property&post_status=publish&paged='.$paged.'&posts_per_page='.$numpost.'&author='.$authid);
				
				?>
			<?php
				rewind_posts();
				 get_template_part( 'loop', 'property' );
				 wp_reset_query();
			?>
			</div><!-- end #content -->
			
			<?php if($pLayout=="plist"){ ?>
			<div class="sidebar_right">
			<div class="sidebar">
				<?php get_sidebar('property');?>
            </div><!-- end #sidebar -->
			</div><!-- end #sidebar_right -->
			<?php } ?>
			
			<div class="clear"></div>
		</div><!-- end #maincontent -->
<?php get_footer(); ?>
