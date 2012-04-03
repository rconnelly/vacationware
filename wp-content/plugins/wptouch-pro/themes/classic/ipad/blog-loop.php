<?php if ( wptouch_have_posts() ) { while ( wptouch_have_posts() ) { ?>

	<?php wptouch_the_post(); ?>

<div class="<?php wptouch_post_classes(); ?> rounded-corners-8px">

	<div class="title-area">
		<a href="<?php wptouch_the_permalink(); ?>" class="ipad-read-entry"></a>

		<?php if ( is_sticky() ) { ?>
			<img src="<?php wptouch_bloginfo( 'template_directory' ); ?>/images/paperclip.png" alt="paperclip" class="paperclip" />
		<?php } ?>

		<?php if ( classic_use_calendar_icons() || classic_use_thumbnail_icons() ) { ?>
			<?php if ( wptouch_get_comment_count() ) { ?> 
				<div class="comment-bubble <?php wptouch_comment_bubble_size(); ?>">
					<?php comments_number( '0', '1', '%' ); ?>
				</div>
			<?php } ?>
		<?php } ?>

		<?php if ( classic_use_calendar_icons() ) { ?>
			<?php $template = locate_template( 'calendar-icons.php' ); ?>	
			<?php include( $template ); ?>
		<?php } elseif ( classic_use_thumbnail_icons() ) { ?>
				<img src="<?php wptouch_the_post_thumbnail(); ?>" class="attachment-post-thumbnail default-thumbnail" alt="post thumbnail" />	
		<?php } ?>

		<?php if ( !classic_use_calendar_icons() && classic_show_date_in_posts() ) { ?>
			<div class="post-date">
				<?php wptouch_the_time( 'M j / y' ); ?>
			</div>	
		<?php } ?>		
				
		<a class="h2" href="<?php wptouch_the_permalink(); ?>"><?php wptouch_the_title(); ?></a>
				
		<?php if ( classic_show_author_in_posts() ) { ?>
			<div class="post-author">
				<?php _e( "By", "wptouch-pro" ); ?>: <?php the_author(); ?> 
			</div>
		<?php } ?>
					
		<?php if ( classic_should_show_taxonomy() ) { ?>
			<?php if ( classic_has_custom_taxonomy() ) { ?>
				<?php $custom_tax = classic_get_custom_taxonomy(); ?>
				<?php if ( $custom_tax && count( $custom_tax ) ) { ?>
					<?php foreach( $custom_tax as $tax_name => $contents ) { ?>
						<div class="post-cats">
							<?php echo $tax_name . ': '; ?>
							<?php $tax_array = array(); ?>
							<?php foreach( $contents as $term ) { ?>
								<?php $tax_array[] = '<a href="' . $term->link . '">' . $term->name . '</a>'; ?>
							<?php } ?>
							<?php echo implode( ', ', $tax_array ); ?>
						</div>
					<?php } ?>
				<?php } ?>			
			<?php } else { ?>							
				<?php if ( wptouch_has_tags() && classic_show_tags_in_posts() ) { ?>
					<div class="post-tags">
						<?php _e( "Tags", "wptouch-pro" ); ?>: <?php wptouch_the_tags(); ?>
					</div>
				<?php } ?>
					
				<?php if ( wptouch_has_categories() && classic_show_categories_in_posts() ) { ?>
					<div class="post-cats">
						<?php _e( "Categories", "wptouch-pro" ); ?>: <?php wptouch_the_categories(); ?>
					</div>
				<?php } ?>
			<?php } ?>
		<?php } ?>
	</div>

	<?php the_excerpt(); ?>

</div><!-- .wptouch_posts_classes() -->

<?php } } ?>

<?php if ( wptouch_has_next_posts_link() ) { ?>
	<?php if ( !classic_is_ajax_enabled() ) { ?>	
		<div class="posts-nav post rounded-corners-8px">
			<div class="left"><?php previous_posts_link( __( "Back", "wptouch-pro" ) ) ?></div>
			<div class="right clearfix"><?php next_posts_link( __( "Next", "wptouch-pro" ) ) ?></div>
		</div>
	<?php } else { ?>
		<a class="load-more-link button" href="<?php echo get_next_posts_page_link(); ?>">
			<span></span><?php _e( "Load More Entries&hellip;", "wptouch-pro" ); ?>
		</a>
	<?php } ?>
<?php } ?>