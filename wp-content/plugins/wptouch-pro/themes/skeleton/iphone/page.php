<?php get_header(); ?>	

	<?php if ( wptouch_have_posts() ) { ?>
	
		<?php wptouch_the_post(); ?>
		<div class="<?php wptouch_post_classes(); ?> page-title-area rounded-corners-8px">

			<?php if ( wptouch_page_has_icon() ) { ?>
				<img src="<?php wptouch_page_the_icon(); ?>" alt="<?php the_title(); ?>-page-icon" />
			<?php } ?>

			<h2><?php wptouch_the_title(); ?></h2>

					<?php wp_link_pages( 'before=<div class="post-page-nav">' . __( "Pages", "wptouch-pro" ) . ':&after=</div>&next_or_number=number&pagelink=page %&previouspagelink=&raquo;&nextpagelink=&laquo;' ); ?>        
		</div>	
		
		<div class="<?php wptouch_post_classes(); ?> rounded-corners-8px">
			
			<div class="<?php wptouch_content_classes(); ?>">
				<?php wptouch_the_content(); ?>
			</div>
			
			<?php wp_link_pages( __( 'Pages in the article:', 'wptouch-pro' ), '', 'number' ); ?>

		</div><!-- wptouch_posts_classes() -->
	<?php } ?>
	
	<?php if ( wptouch_theme_show_comments_on_pages() ) { ?>
		<?php comments_template(); ?>
	<?php } ?>
	
<?php get_footer(); ?>