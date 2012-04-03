<?php while ( wptouch_have_posts() ) { ?>
	<?php wptouch_the_post(); ?>
	
	<div class="<?php wptouch_post_classes(); ?>">
	
		<h1><?php wptouch_the_title(); ?></h1>
	
		<!-- The Date Contents -->
		<div class="<?php wptouch_date_classes(); ?>">
			<?php wptouch_the_time( 'F jS, Y' ); ?>
		</div>

		<!-- Post Content Goes Here -->
	</div>
<?php }