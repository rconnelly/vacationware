<input type="text" autocomplete="off" class="text" id="<?php wptouch_the_tab_setting_name(); ?>" name="<?php wptouch_the_tab_setting_name(); ?>" value="<?php wptouch_the_tab_setting_value(); ?>" />
<label class="text" for="<?php wptouch_the_tab_setting_name(); ?>">
	<?php wptouch_the_tab_setting_desc(); ?>
</label>			
<?php if ( wptouch_the_tab_setting_has_tooltip() ) { ?>
<a href="#" class="wptouch-tooltip" title="<?php wptouch_the_tab_setting_tooltip(); ?>">&nbsp;</a> 
<?php } ?>