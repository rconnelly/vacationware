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
			<?php if ( function_exists('yoast_breadcrumb') && !is_front_page() ) {
			yoast_breadcrumb('<div id="breadcrumbs">','</div>');
			} ?>
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h2 class="posttitle"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'templatesquare' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<div class="entry-utility"><?php  the_time('M, d y') ?>  <?php _e('Post by', 'templatesquare');?>: <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>"> <?php the_author();?></a> | <?php comments_popup_link(__('No Comments', 'templatesquare'), __('1 Comments', 'templatesquare'), __('% Comments', 'templatesquare')); ?> </div>
				<div class="entry-content">
					<?php the_content( __( 'Read More &rarr;', 'templatesquare' ) ); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'templatesquare' ), 'after' => '</div>' ) ); ?>
					<div class="clear"></div><!-- end clear float -->
					<?php edit_post_link( __( 'Edit', 'templatesquare' ), '<span class="edit-link">', '</span>' ); ?>
				</div>
			</div><!-- end post -->
			<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
			</div><!-- end #content -->
			
			<div class="sidebar_right">
			<div class="sidebar">
				<?php get_sidebar();?>
            </div><!-- end #sidebar -->
			</div><!-- end #sidebar_right -->
			
			<div class="clear"></div>
		</div><!-- end #maincontent -->

<?php get_footer(); ?>
