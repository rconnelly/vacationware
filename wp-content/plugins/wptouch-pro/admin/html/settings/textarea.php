<label class="textarea" for="<?php wptouch_the_tab_setting_name(); ?>">
	<?php wptouch_the_tab_setting_desc(); ?>
</label>

<?php if ( wptouch_the_tab_setting_has_tooltip() ) { ?>
<a href="#" class="wptouch-tooltip" title="<?php wptouch_the_tab_setting_tooltip(); ?>">&nbsp;</a>
<?php } ?><br />	
<textarea rows="5" class="textarea"  id="<?php wptouch_the_tab_setting_name(); ?>" name="<?php wptouch_the_tab_setting_name(); ?>"><?php echo htmlspecialchars( wptouch_get_tab_setting_value() ); ?></textarea>