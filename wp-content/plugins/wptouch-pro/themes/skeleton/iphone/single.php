<?php get_header(); ?>	

		<?php while ( wptouch_have_posts() ) { ?>

		<?php wptouch_the_post(); ?>

		<div class="<?php wptouch_post_classes(); ?> rounded-corners-8px">

			<h2><?php wptouch_the_title(); ?></h2>

			<div class="date-author-wrap">
				<div class="<?php wptouch_date_classes(); ?>">
					<?php _e( "Published on", "wptouch-pro" ); ?> <?php wptouch_the_time( 'F jS, Y' ); ?>
				</div>			
				<div class="post-author">
					<?php _e( "Written by", "wptouch-pro" ); ?>: <?php the_author(); ?> 
				</div>
			</div>
		</div>	
		
		<div class="<?php wptouch_post_classes(); ?> rounded-corners-8px">

		<!-- text for 'back and 'next' is hidden via CSS, and replaced with arrow images -->
			<div class="post-navigation nav-top">
				<div class="post-nav-fwd">
					<?php wptouch_theme_get_next_post_link(); ?>
				</div>				
				<div class="post-nav-middle">
					<?php if ( wptouch_get_comment_count() > 0 ) echo '<a href="#comments" class="middle-link no-ajax">' . __( "Skip to Responses", "wptouch-pro" ) . '</a>' ; ?>
				</div>
				<div class="post-nav-back">
					<?php wptouch_theme_get_previous_post_link(); ?>
				</div>
			</div>
			
			<div class="<?php wptouch_content_classes(); ?>">
				<?php wptouch_the_content(); ?>

				<div class="single-post-meta-bottom">
					<?php wp_link_pages( 'before=<div class="post-page-nav">' . __( "Article Pages", "wptouch-pro" ) . ':&after=</div>&next_or_number=number&pagelink=page %&previouspagelink=&raquo;&nextpagelink=&laquo;');  ?>        
					<?php _e( "Categories", "wptouch-pro" ); ?>: <?php if ( the_category( ', ' ) ) the_category(); ?>
					<?php if ( function_exists( 'get_the_tags') ) the_tags( '<br />' . __( 'Tags', 'wptouch-pro' ) . ': ', ', ', ''); ?>  
				</div>   
			</div>

			<div class="post-navigation nav-bottom">
				<div class="post-nav-fwd">
					<?php wptouch_theme_get_next_post_link(); ?>
				</div>	
				<div class="post-nav-middle">
					<a href="#header" class="back-to-top"><?php _e( "Back to Top", "wptouch-pro" ); ?></a>
				</div>
				<div class="post-nav-back">
					<?php wptouch_theme_get_previous_post_link(); ?>
				</div>
			</div>
		</div><!-- wptouch_posts_classes() -->

		<?php } // endwhile ?>

		<?php comments_template(); ?>

<?php get_footer(); ?>