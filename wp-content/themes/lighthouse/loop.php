<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
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

<?php
	$blogtype = get_option('templatesquare_blog_layout');
	if($blogtype=="grid"){
	$postcontainer="gridlayout";
	}else{
	$postcontainer="listlayout";
	}
?>

<ul class="<?php echo $postcontainer;?>">

<?php $i=1;?>

<?php while ( have_posts() ) : the_post(); ?>

<?php if(($i%2) == 0){ $addclass = "last";}  if($blogtype=="list"){ $sizetitle = "large";	}	?>

	<?php /* How to display all posts. */ ?>
		<li<?php if($blogtype=="grid"){?> class="<?php echo $addclass; ?>"<?php } ?>>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h2 class="posttitle <?php echo $sizetitle;?>"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'templatesquare' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<?php if (!is_search() ) { ?>
				<div class="entry-utility"><?php  the_time('M, d y') ?>  <?php _e('Post by', 'templatesquare');?>: <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>"> <?php the_author();?></a> | <?php comments_popup_link(__('No Comments', 'templatesquare'), __('1 Comments', 'templatesquare'), __('% Comments', 'templatesquare')); ?> </div>
				<?php } ?>
				
				<?php if (is_search() ) : // Only display excerpts for archives and search. ?>
					<div class="entry-content">
						<?php $excerpt = get_the_excerpt(); echo ts_string_limit_char($excerpt,200);?>
						<?php edit_post_link( __( 'Edit', 'templatesquare' ), '<span class="edit-link">', '</span>' ); ?>
						<div class="clear"></div><!-- end clear float -->
					</div><!-- .entry-summary -->
					
				<?php else : ?>
				<div class="entry-content">
						<?php if($blogtype=="grid"){?>
							<?php
								$custom = get_post_custom($post->ID);
								$cf_thumb = (isset($custom["thumb"][0]))? $custom["thumb"][0] : "";
								
								if($cf_thumb!=""){
									$cf_thumb = "<img src='" . $cf_thumb . "' alt='' width='290' height='90' />";
								}
							?>
							<?php if($cf_thumb!=""){ echo $cf_thumb; }else{ the_post_thumbnail( 'blog-post-thumbnail', array('alt' =>'', 'title' =>'') );} ?>
							<?php $excerpt = get_the_excerpt(); echo ts_string_limit_words($excerpt,20);?>
							<a href="<?php the_permalink() ?>" class="more" rel="bookmark" title="<?php _e('Permanent Link to', 'templatesquare');?> <?php the_title_attribute(); ?>"><?php _e('Read More', 'templatesquare');?></a>
							
						<?php }else{?>
						
						<?php the_content( __( 'Read More', 'templatesquare' ) ); ?>
						
						<?php } ?>
					
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'templatesquare' ), 'after' => '</div>' ) ); ?>
					<div class="clear"></div><!-- end clear float -->
					<?php edit_post_link( __( 'Edit', 'templatesquare' ), '<span class="edit-link">', '</span>' ); ?>
				</div>
				<?php endif; ?>
			</div><!-- end post -->
		</li>
		
<?php $i++; $addclass=""; endwhile; // End the loop. Whew. ?>

</ul>

<?php comments_template( '', true ); ?>

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
