<?php get_header(); ?>	

	<?php if ( wptouch_have_posts() ) { ?>
	
		<?php wptouch_the_post(); ?>
		<div class="<?php wptouch_post_classes(); ?> rounded-corners-8px">
			<div class="title-area">
				<?php if ( classic_use_thumbnail_icons() && classic_thumbs_on_single() ) { ?>
					<img src="<?php wptouch_the_post_thumbnail(); ?>" class="attachment-post-thumbnail default-thumbnail" alt="post thumbnail" />	
				<?php } ?>	

				<?php if ( classic_show_date_single() ) { ?>
					<div class="post-date">
						<?php _e( "Published on", "wptouch-pro" ); ?> <?php wptouch_the_time( 'F jS, Y' ); ?>
					</div>			
				<?php } ?>

				<h2><?php wptouch_the_title(); ?></h2>

				<?php if ( classic_show_author_single() ) { ?>
					<div class="post-author">
						<?php _e( "Written by", "wptouch-pro" ); ?>: <?php the_author(); ?> 
					</div>
				<?php } ?>	
			</div>
			
			<div class="<?php wptouch_content_classes(); ?>">
				<?php wptouch_the_content(); ?>
				<?php if ( classic_show_cats_single() || classic_show_tags_single() || wp_link_pages( 'echo=0' ) ) { ?>
					<div class="single-post-meta-bottom">
						<?php wp_link_pages( 'before=<div class="post-page-nav">' . __( "Article Pages", "wptouch-pro" ) . ':&after=</div>&next_or_number=number&pagelink=page %&previouspagelink=&raquo;&nextpagelink=&laquo;' ); ?>          
	
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
								<?php if ( classic_show_cats_single() ) { ?>
									<div class="post-cats"><?php _e( "Categories", "wptouch-pro" ); ?>: <?php if ( the_category( ', ' ) ) the_category(); ?></div>
								<?php } ?>
			
								<?php if ( classic_show_tags_single() ) { ?>				
									<?php if ( function_exists( 'get_the_tags' ) ) the_tags( '<div class="post-tags">' . __( 'Tags', 'wptouch-pro' ) . ': ', ', ', '</div>'); ?>  
								<?php } ?>
							<?php } ?>
						<?php } ?>
					</div>   
				<?php } ?>
			</div>

			<div class="post-navigation nav-bottom dark-gradient">
				<div class="post-nav-fwd">
					<?php classic_get_next_post_link(); ?>
				</div>	
				<div class="post-nav-back">
					<?php classic_get_previous_post_link(); ?>
				</div>
			</div>
		</div><!-- wptouch_posts_classes() -->

			<?php if ( classic_show_share_single() ) { ?>					
				<div class="aligncenter">
					<a class="share-post button no-ajax" href="javascript:void(0);"><?php _e( "Share or Save This Post", "wptouch-pro" ); ?></a>
					<div id="share-placeholder">
						<header>
							<h1><?php _e( 'Share Or Save', 'wptouch-pro' ); ?></h1>
						</header>
						<div class="pop-inner">
							<ul>
								<li id="twitter"><a target="_blank" class="no-ajax"href="http://m.twitter.com/home/?status=<?php echo classic_url_encode( wptouch_get_title() . ' // ' . get_permalink() ); ?>"><?php _e( "Share on Twitter", "wptouch-pro" ); ?></a></li>
								<li id="facebook"><a  target="_blank" class="no-ajax" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&t=<?php the_title();?>"><?php _e( "Share on Facebook", "wptouch-pro" ); ?></a></li>
								<li id="delicious"><a class="no-ajax" target="_blank" href="http://del.icio.us/post?url=<?php the_permalink(); ?>&title=<?php the_title();?>"><?php _e( "Save to Del.icio.us", "wptouch-pro" ); ?></a></li>
								<li id="email"><a class="no-ajax" href="mailto:?subject=<?php
								wptouch_get_bloginfo('site_title'); ?>%20-%20<?php the_title_attribute();?>&body=<?php _e( "Check out this post:", "wptouch" ); ?>%20<?php the_permalink(); ?>"><?php _e( "Share via E-Mail", "wptouch-pro" ); ?></a></li>
								<li id="instapaper"><a class="no-ajax" href="#"><?php _e( "Save to Instapaper", "wptouch-pro" ); ?></a></li>
							</ul>
						</div>
						<p class="share-pointer-arrow">&nbsp;</p>
					</div>
				</div>
			<?php } ?>
				
		<?php } ?>

		<?php comments_template(); ?>
<?php get_footer(); ?>