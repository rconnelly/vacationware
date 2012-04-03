<?php 
	$settings = wptouch_get_settings();
	
	ob_start();
	wp_dropdown_pages(); 
	$contents = ob_get_contents();
	ob_end_clean();
	
	$contents = str_replace( 'page_id', 'classic_latest_posts_page', $contents );
	$value_string = 'value="' . $settings->classic_latest_posts_page . '"';
	$contents = str_replace( $value_string, $value_string . ' selected', $contents );
	
	$is_custom = ( $settings->classic_latest_posts_page == 'none' ? ' selected' : '' );
	$contents = str_replace( '</select>', '<option class="level-0" value="none"' . $is_custom . '>' . __( "None (Use WordPress Settings)", "wptouch-pro" ) . '</option></select>', $contents );
	
	echo $contents;
	
?>
<label for="classic_latest_posts_page"><?php _e( "Custom latest posts page", "wptouch-pro" ); ?>

<a href="#" class="wptouch-tooltip" title="<?php _e( 'This setting can be used to convert a regular WordPress page into a page that shows the latest posts.', 'wptouch-pro' ); ?>">&nbsp;</a>
</label>