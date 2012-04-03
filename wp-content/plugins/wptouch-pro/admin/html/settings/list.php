<select name="<?php wptouch_the_tab_setting_name(); ?>" id="<?php wptouch_the_tab_setting_name(); ?>" class="list">
	<?php while ( wptouch_tab_setting_has_options() ) { ?>
		<?php wptouch_tab_setting_the_option(); ?>
		
		<option value="<?php wptouch_tab_setting_the_option_key(); ?>"<?php if ( wptouch_tab_setting_is_selected() ) echo " selected"; ?>><?php wptouch_tab_setting_the_option_desc(); ?></option>
	<?php } ?>
</select>

<label class="list" for="<?php wptouch_the_tab_setting_name(); ?>">
	<?php wptouch_the_tab_setting_desc(); ?>	
</label>
<?php if ( wptouch_the_tab_setting_has_tooltip() ) { ?>
<a href="#" class="wptouch-tooltip" title="<?php wptouch_the_tab_setting_tooltip(); ?>">&nbsp;</a>	
<?php } ?>