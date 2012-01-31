<?php 
	$optpropertytype 	= get_option("templatesquare_property_type");
	$optlistingtype 	= get_option("templatesquare_listing_type");
	$sizeunit			= get_option("templatesquare_property_area_unit");
	$maxbed				= get_option("templatesquare_property_num_bed");
	$maxbath			= get_option("templatesquare_property_num_bath");
	$maxsleeps			= get_option("templatesquare_property_num_sleeps");
	
	$opttype = array(
		"property_type" 	=> explode(",",$optpropertytype),
		"listing_type" 		=> explode(",",$optlistingtype)
	);
	
	$advcity		= (isset($_GET['advcity']))? stripslashes(trim($_GET['advcity'])) : "";
	$advstate		= (isset($_GET['advstate']))? stripslashes(trim($_GET['advstate'])) : "";
	$advzipcode		= (isset($_GET['advzipcode']))? stripslashes(trim($_GET['advzipcode'])) : "";
	$advprice1 		= (isset($_GET['advprice1']))? stripslashes(trim($_GET['advprice1'])) : "";
	$advprice2 		= (isset($_GET['advprice2']))? stripslashes(trim($_GET['advprice2'])) : "";
	$advbed			= (isset($_GET['advbed']))? stripslashes(trim($_GET['advbed'])) : "";
	$advbath		= (isset($_GET['advbath']))? stripslashes(trim($_GET['advbath'])) : "";
	
?>
						
<div id="advance-search-grid-property">					
<form id="search" name="searchform" method="get" action="<?php echo home_url(); ?>">
<div id="searchMain">
<!--
<label for="advcity">
	<span class="colortext"><?php _e("City", "templatesquare"); ?></span><br />
	<input type="text" id="advcity" name="advcity" size="25" value="<?php echo $advcity ;?>" />
</label>
<label for="advstate">
	<span class="colortext"><?php _e("State", "templatesquare"); ?></span><br />
	<input type="text" id="advstate" name="advstate" size="25" value="<?php echo $advstate ;?>" />
</label>
<label for="advzipcode">
	<span class="colortext"><?php _e("Zip", "templatesquare"); ?></span><br />
	<input type="text" id="advzipcode" name="advzipcode" size="10" value="<?php echo $advzipcode ;?>" />
</label>

<label for="advpricerange">
	<span class="colortext"><?php _e("Price Range", "templatesquare"); ?></span><br />
	<input type="text" id="advprice1" name="advprice1"  size="10" value="<?php echo $advprice1 ;?>" />
	<?php _e("to", "templatesquare"); ?>
	<input type="text" id="advprice2" name="advprice2" size="10" value="<?php echo $advprice2 ;?>" />
</label>

-->

<label for="advsleeps">
	<span class="colortext"><?php _e("Sleeps"); ?></span><br />
	<select name="advsleeps" id="advsleeps">
    	<?php for($i=1;$i<=$maxsleeps;$i++){ ?>
    		<option value="<?php echo $i; ?>" <?php if(trim($i)==trim($advsleeps)){echo 'selected';}?>><?php echo $i; ?></option>
    	<?php } ?>
    	</select>
</label>

<label for="advbed">
	<span class="colortext"><?php _e("Beds", "templatesquare"); ?></span><br />
	<select name="advbed" id="advbed">
	<?php for($i=1;$i<=$maxbed;$i++){ ?>
		<option value="<?php echo $i; ?>" <?php if(trim($i)==trim($advbed)){echo 'selected';}?>><?php echo $i."+"; ?></option>
	<?php } ?>
	</select>
</label>
<label for="advbath">
	<span class="colortext"><?php _e("Baths", "templatesquare"); ?></span><br />
	<select name="advbath" id="advbath">
	<?php for($i=1;$i<=$maxbath;$i++){ ?>
		<option value="<?php echo $i; ?>" <?php if(trim($i)==trim($advbath)){echo 'selected';}?>><?php echo $i."+"; ?></option>
	<?php } ?>
	</select>
</label>
<label class="last"><br />
<input type="hidden" name="post_type" value="property" />
<div style="display:none;">
<input type="search" id="s" name="s" title="<?php _e('Search Property','templatesquare');?>" placeholder="<?php _e('Search Property','templatesquare');?>" value="search" />
</div>
<button type="submit" value="search" id="searchsubmit"><?php _e('Search','templatesquare');?></button>
</label>
<div class="clear"></div>
</div>
</form>
<div class="clear"></div>
</div> 
