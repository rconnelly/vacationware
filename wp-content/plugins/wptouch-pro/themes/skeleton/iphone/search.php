<?php get_header(); ?>	

	<!-- This function figures out what type of archive it is and spits it out as the title in a div class="archive-text" -->
	<?php wptouch_theme_archive_text(); ?>

	<?php while ( wptouch_have_posts() ) { ?>

		<?php wptouch_the_post(); ?>

		<div class="<?php wptouch_post_classes(); ?> rounded-corners-8px">

			<?php if ( is_sticky( $post_ID ) ) echo '<div class="sticky-pushpin"></div>'; ?>		

			<?php if ( wptouch_get_comment_count() && wptouch_theme_use_calendar_icons() ) { ?> 
				<div class="comment-bubble <?php if ( wptouch_get_comment_count() > 9 ) echo 'double'; elseif ( wptouch_get_comment_count() > 99 ) echo 'triple';  ?>">
					<?php comments_number('0','1','%'); ?>
				</div>
			<?php } ?>
				
			<?php if ( wptouch_theme_use_calendar_icons() ) { ?>
				<?php include('calendar-icons.php'); ?>	
			<?php } else { ?>
				<?php include('thumbnails.php'); ?>
			<?php } ?>			
			
			<!-- the blue arrow button -->
			<a href="<?php wptouch_the_permalink(); ?>" class="blue-button"></a>
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
						
			<div class="<?php wptouch_content_classes(); ?>">
				<?php the_excerpt_rss(); ?>
			</div>

		</div><!-- .wptouch_posts_classes() -->

	<?php } ?>

		<?php if ( wptouch_has_next_posts_link() ) { ?>
			<?php if ( !wptouch_theme_is_ajax_enabled() ) { ?>	
				<div class="posts-nav post rounded-corners-8px">
					<div class="left"><?php wptouch_theme_archive_navigation_back(); ?></div>
					<div class="right clearfix"><?php wptouch_theme_archive_navigation_next(); ?></div>
				</div>
			<?php } else { ?>
				<a class="load-more-link" href="#" rel="<?php echo get_next_posts_page_link(); ?>"><?php _e( "Load More Entries&hellip;", "wptouch-pro" ); ?></a>
			<?php } ?>
		<?php } ?>
	
<?php get_footer(); ?>