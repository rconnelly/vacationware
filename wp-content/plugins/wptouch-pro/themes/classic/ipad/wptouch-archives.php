<?php get_header(); ?>	
<!-- Custom archives template, adds itself as a drop menu option -->
	<div class="<?php wptouch_post_classes(); ?> wptouch-custom-page page-title-area rounded-corners-8px">
		<?php if ( wptouch_page_has_icon() ) { ?>
			<img src="<?php wptouch_page_the_icon(); ?>" alt="<?php the_title(); ?>-page-icon" />
		<?php } ?>

		<h2><?php _e( 'Archives', 'wptouch-pro' ); ?></h2>
	</div>	
		
	<h2 class="wptouch-archives"><?php _e( 'Browse Last 15 Posts', 'wptouch-pro' ); ?></h2>	
	<ul class="wptouch-archives">
		<?php wp_get_archives( 'type=postbypost&limit=15' ); ?>
	</ul>
				
	<h2 class="wptouch-archives"><?php _e( 'Browse Last 12 Months', 'wptouch-pro' ); ?></h2>
	
	<ul class="wptouch-archives">
		<?php wp_get_archives( 'type=monthly&limit=12' ); ?>
	</ul>
	
<?php get_footer(); ?>