<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Light House
 * @since Light House 1.0
 */

get_header(); ?>

		<div id="maincontent">
			<div id="content" class="full">
			<h1 class="pagetitle"><?php _e( 'Not Found', 'templatesquare' ); ?></h1>	
			<div id="post-0" class="error404 not-found">
				<div class="entry-content">
					<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'templatesquare' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- entry-content -->
			</div><!-- #post -->
			</div><!-- end #content -->
			<div class="clear"></div>
		</div><!-- end #maincontent -->
<script type="text/javascript">
	// focus on search field after it has loaded
	document.getElementById('s') && document.getElementById('s').focus();
</script>
<?php get_footer(); ?>