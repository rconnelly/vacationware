<?php
/**
 * Template Name: Property
 *
 * A custom page template for property list.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
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
			
				<?php
				if(!is_front_page()){
					get_template_part( 'title' );
				}
				 ?>
				<?php if ( function_exists('yoast_breadcrumb') && !is_front_page() ) {
				yoast_breadcrumb('<div id="breadcrumbs">','</div>');
				} ?>
				
				<?php
				 global $wp_query;
				$wp_query = new WP_Query('post_type=property&post_status=publish&paged='.$paged.'&showposts='.$numpost);
				
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
