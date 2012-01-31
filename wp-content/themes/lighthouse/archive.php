<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
		 
		$term_exists = term_exists( $term, 'propertytag', $parent ) 
		 ?>
		 
		 <?php if($term_exists==true){ ?>	
		<div id="maincontent">
			<div id="content" class="<?php echo $addclass;?>">
					
				<h1 class="pagetitle"><?php
					printf( __( 'Tag: %s', 'templatesquare' ), '<span>' . single_tag_title( '', false ) . '</span>' );
				?></h1>
			<?php if ( function_exists('yoast_breadcrumb') && !is_front_page() ) {
			yoast_breadcrumb('<div id="breadcrumbs">','</div>');
			} ?>	
					
					<?php
					 global $wp_query;
				$wp_query = new WP_Query('post_type=property&post_status=publish&propertytag='.single_tag_title( '', false ) .'&paged='.$paged.'&showposts='.$numpost);
				
				//query_posts('&propertytag=minimalist&paged='.$paged.'&showposts=8'); 
					/* Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called loop-search.php and that will be used instead.
					 */
					 get_template_part( 'loop', 'property' );
					 
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

		<?php } else {?>
		

		<div id="maincontent">
			<div id="content">
			<h1 class="pagetitle">
			<?php if ( is_day() ) : ?>
				<?php printf( __( 'Daily Archives <span>%s</span>', 'templatesquare' ), get_the_date() ); ?>
			<?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Monthly Archives <span>%s</span>', 'templatesquare' ), get_the_date('F Y') ); ?>
			<?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Yearly Archives <span>%s</span>', 'templatesquare' ), get_the_date('Y') ); ?>
			<?php else : ?>
				<?php printf( __( '%s', 'templatesquare' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
			<?php endif; ?>
			</h1>
			<?php if ( function_exists('yoast_breadcrumb') && !is_front_page() ) {
			yoast_breadcrumb('<div id="breadcrumbs">','</div>');
			} ?>	
			
			
			<?php
				/* Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();
			
				/* Run the loop for the archives page to output the posts.
				 * If you want to overload this in a child theme then include a file
				 * called loop-archives.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'archive' );
			?>
			</div><!-- end #content -->
			
			<div class="sidebar_right">
			<div class="sidebar">
				<?php get_sidebar();?>
            </div><!-- end #sidebar -->
			</div><!-- end #sidebar_right -->
			
			<div class="clear"></div>
		</div><!-- end #maincontent -->
		
		<?php }  ?>
<?php get_footer(); ?>
