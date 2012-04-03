<?php get_header(); ?>	
	<!-- Custom links template, adds itself as a drop menu option -->
	<div class="<?php wptouch_post_classes(); ?> wptouch-custom-page page-title-area rounded-corners-8px">
		<?php if ( wptouch_page_has_icon() ) { ?>
				<img src="<?php wptouch_page_the_icon(); ?>" alt="<?php the_title(); ?>-page-icon" />
		<?php } ?>

		<h2><?php _e( 'Links', 'wptouch-pro' ); ?></h2>
	</div>	
			
	<ul>	
		<?php wp_list_bookmarks(); ?>
	</ul>
	
<?php get_footer(); ?>