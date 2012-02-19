<?php
/**
 * Template Name: Blog
 *
 * A custom page template for blog page.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Light House
 * @since Light House 1.0
 */

get_header(); ?>
		<div id="maincontent">
			<div id="content">
				<?php
				if(!is_front_page()){
					get_template_part( 'title' );
				}
				 ?>	
				<?php if ( function_exists('yoast_breadcrumb') && !is_front_page() ) {
				yoast_breadcrumb('<div id="breadcrumbs">','</div>');
				} ?>
				<?php the_content();?>
				<?php 
				$values = get_post_custom_values("category-include"); $cat=$values[0]; 
				 ?>
				<?php 
				
						global $more; $post;
						
						$args = array(
							'category_name' => $cat,
							'paged' => $paged
						);
						
				
					query_posts($args); 
				
				
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
				
				<?php wp_reset_query();?>
			</div><!-- end #content -->
			
			<div class="sidebar_right">
			<div class="sidebar">
				<?php get_sidebar();?>
            </div><!-- end #sidebar -->
			</div><!-- end #sidebar_right -->
			
			<div class="clear"></div>
		</div><!-- end #maincontent -->
<?php get_footer(); ?>
