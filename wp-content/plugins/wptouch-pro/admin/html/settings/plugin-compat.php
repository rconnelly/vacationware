<?php if ( wptouch_has_plugin_warnings() ) { ?>
<table>
	<tr>
		<th><?php _e( "Problem Area", "wptouch-pro" ); ?></th>
		<th><?php _e( "Description", "wptouch-pro" ); ?></th>
		<th><?php _e( "Action", "wptouch-pro" ); ?></th>
	</tr>
	<?php while ( wptouch_has_plugin_warnings() ) { ?>
		<?php wptouch_the_plugin_warning(); ?>
		<tr>
			<td class="plugin-name"><?php wptouch_plugin_warning_the_name(); ?></td>
			<td class="warning-item-desc"><?php wptouch_plugin_warning_the_desc(); ?></td>
			<td>
			<?php if ( wptouch_plugin_warning_has_link() ) { ?>
				<a href="<?php wptouch_plugin_warning_the_link(); ?>" class="info-button" target="_blank"><?php _e( "More Info", "wptouch-pro" ) ?></a>
			<?php } ?>
			<a href="#" id="<?php wptouch_plugin_warning_the_name(); ?>" class="dismiss-button"><?php _e( "Dismiss", "wptouch-pro" ) ?></a></td>
		</tr>
	<?php } ?>	
</table>
<?php } else { ?>
	<p class="no-warnings"><?php _e( "No known warnings or conflicts.", "wptouch-pro" ) ?></p>
<?php } ?>