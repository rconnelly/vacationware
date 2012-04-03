<?php get_header(); ?>	

	<?php while ( wptouch_have_posts() ) { ?>

		<?php wptouch_the_post(); ?>

		<div class="<?php wptouch_post_classes(); ?> rounded-corners-8px">

			<?php global $post_ID; ?>
			<?php if ( is_sticky( $post_ID ) ) echo '<div class="sticky-pushpin"></div>'; ?>

			<?php if ( wptouch_theme_use_calendar_icons() || wptouch_theme_use_thumbnail_icons() ) { ?>
				<?php if ( wptouch_get_comment_count() ) { ?> 
					<div class="comment-bubble <?php if ( wptouch_get_comment_count() > 9 ) echo 'double'; elseif ( wptouch_get_comment_count() > 99 ) echo 'triple';  ?>">
						<?php comments_number('0','1','%'); ?>
					</div>
				<?php } ?>
			<?php } ?>
			
			<?php if ( wptouch_theme_use_calendar_icons() ) { ?>
				<?php include('calendar-icons.php'); ?>	
			<?php } elseif ( wptouch_theme_use_thumbnail_icons() ) { ?>
				<?php include('thumbnails.php'); ?>
			<?php } ?>		
				
			<!-- the blue arrow button -->
			<a href="<?php wptouch_the_permalink(); ?>" class="arrow-button wptouch-ajax"></a>
			<h2><a href="<?php wptouch_the_permalink(); ?>"><?php wptouch_the_title(); ?></a></h2>
	
			<div class="date-author-wrap">
				<?php if ( !wptouch_theme_use_calendar_icons() ) { ?>
					<div class="<?php wptouch_date_classes(); ?>">
						<?php wptouch_the_time( 'F jS, Y' ); ?> &bull; 
					</div>	
				<?php } ?>		
				<div class="post-author">
					<?php the_author(); ?> 
				</div>
			</div>
							
			<?php if ( wptouch_has_tags() ) { ?>
				<div class="tags-and-categories">
					<?php _e( "Tags", "wptouch-pro" ); ?>: <?php wptouch_the_tags(); ?>
				</div>
			<?php } ?>
			
			<?php if ( wptouch_has_categories() ) { ?>
				<div class="tags-and-categories">
					<?php _e( "Categories", "wptouch-pro" ); ?>: <?php wptouch_the_categories(); ?>
				</div>
			<?php } ?>			
			
			<div class="<?php wptouch_content_classes(); ?>">
				<?php wptouch_the_excerpt(); ?>
			</div>

		</div><!-- .wptouch_posts_classes() -->

	<?php } ?>

		<?php if ( wptouch_has_next_posts_link() ) { ?>
			<?php if ( !wptouch_theme_is_ajax_enabled() ) { ?>	
				<div class="posts-nav post rounded-corners-8px">
					<div class="left"><?php previous_posts_link( __( "Back", "wptouch-pro" ) ) ?></div>
					<div class="right clearfix"><?php next_posts_link( __( "Next", "wptouch-pro" ) ) ?></div>
				</div>
			<?php } else { ?>
				<a class="load-more-link" href="#" rel="<?php echo get_next_posts_page_link(); ?>"><?php _e( "Load More Entries&hellip;", "wptouch-pro" ); ?></a>
			<?php } ?>
		<?php } ?>

<?php get_footer(); ?>