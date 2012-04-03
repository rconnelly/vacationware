<?php get_header(); ?>	
<!-- Custom photos template, looks for FlicrkRSS plugin adds itself as a drop menu option -->
	<div class="<?php wptouch_post_classes(); ?> wptouch-custom-page page-title-area rounded-corners-8px">
		<?php if ( wptouch_page_has_icon() ) { ?>
			<img src="<?php wptouch_page_the_icon(); ?>" alt="<?php the_title(); ?>-page-icon" />
		<?php } ?>

		<h2><?php _e( 'Photos', 'wptouch-pro' ); ?></h2>
	</div>	
		
	<div class="wptouch-flickr-photos post rounded-corners-8px">
		<?php if ( function_exists( 'get_flickrRSS' ) ) { ?>
			<?php get_flickrRSS( array ( 'num_items' => 20, 'html' => '<a href="%flickr_page%" target="_blank" title="%title%"><img src="%image_square%" alt="%title%"/></a>') ); ?>
		<?php } ?> 
	</div>
	
<?php get_footer(); ?>