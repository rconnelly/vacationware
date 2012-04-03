<?php get_header(); ?>	

	<div class="post four-oh-four-title rounded-corners-8px">
		<h2><?php _e( "Page or Post Not Found", "wptouch-pro" ); ?></h2>
	</div>
	
	<div class="post four-oh-four-content rounded-corners-8px">
		<?php wptouch_the_404_message(); ?>
	</div>		

<?php get_footer(); ?>