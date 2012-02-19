<h2><?php echo strtoupper(self::PLUGIN_NAME)?> OPTIONS PAGE:</h2>
<form action="" method="post">
<p>Places to <strong>ALLOW</strong> being open inside frames and iframes:<br />
<input type="checkbox" name="<?php echo $anderson_makiyama[self::PLUGIN_ID]->plugin_slug?>_places[]" value="home" <?php echo self::is_checked("home")?>  /> <label>Home</label>
<br />
<input type="checkbox" name="<?php echo $anderson_makiyama[self::PLUGIN_ID]->plugin_slug?>_places[]" value="single" <?php echo self::is_checked("single");?> /> 
<label>Posts</label>
<br />
<input type="checkbox" name="<?php echo $anderson_makiyama[self::PLUGIN_ID]->plugin_slug?>_places[]" value="page" <?php echo self::is_checked("page");?> /> 
<label>Pages</label>
<br />
<input type="checkbox" name="<?php echo $anderson_makiyama[self::PLUGIN_ID]->plugin_slug?>_places[]" value="category" <?php echo self::is_checked("category");?>  /> 
<label>Categories</label>
<br />
<input type="checkbox" name="<?php echo $anderson_makiyama[self::PLUGIN_ID]->plugin_slug?>_places[]" value="search" <?php echo self::is_checked("search");?> /> 
<label>Search Results</label>
<br />
<input type="checkbox" name="<?php echo $anderson_makiyama[self::PLUGIN_ID]->plugin_slug?>_places[]" value="tag" <?php echo self::is_checked("tag");?>  /> 
<label>Tags</label>
<br />
<br />
<input type="hidden" name="<?php echo $anderson_makiyama[self::PLUGIN_ID]->plugin_slug?>_submit" value="1" />
</p>
<p>
  <input type="submit" name="<?php echo $anderson_makiyama[self::PLUGIN_ID]->plugin_slug?>_submit" value="Save Changes" class="button-primary" />
</form>
<hr />
<p>
<ul>
<li>Visit Plugin's page: <a href="<?php echo self::PLUGIN_PAGE ?>" target="_blank"><?php echo self::PLUGIN_NAME ?></a>
</li>
<li>
Visit Autor's blog: <a href="http://blogwordpress.ws" target="_blank">Anderson Makiyama</a>
</li>
</ul>
</p>