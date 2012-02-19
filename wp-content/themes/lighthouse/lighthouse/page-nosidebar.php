<?php
/**
 * Template Name: No sidebar
 *
 * A custom page template without sidebar.
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
		
			<?php
			get_sidebar('before-content');
			 ?>
		
			<div id="content" class="full">
				<?php
				if(!is_front_page()){
					get_template_part( 'title' );
				}
				 ?>
				<?php if ( function_exists('yoast_breadcrumb') && !is_front_page() ) {
				yoast_breadcrumb('<div id="breadcrumbs">','</div>');
				} ?>
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
						<?php the_content( __( 'Read More', 'templatesquare' ) ); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'templatesquare' ), 'after' => '</div>' ) ); ?>
						<div class="clear"></div>
						<?php edit_post_link( __( 'Edit', 'templatesquare' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</div><!-- #post -->
	
				<?php comments_template( '', true ); ?>
	
				<?php endwhile; ?>
			</div><!-- end #content -->
			<div class="clear"></div>
		</div><!-- end #maincontent -->
<?php get_footer(); ?>
