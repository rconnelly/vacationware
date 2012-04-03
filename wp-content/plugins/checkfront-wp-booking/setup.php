<?php if(isset($_POST['checkfront_host'])) {
	update_option('checkfront_mode',$_POST['checkfront_mode']);
	$Checkfront->mode = $_POST['checkfront_mode'];
	if($host = $Checkfront->valid_host($_POST['checkfront_host'])) {
		update_option('checkfront_host',$host);
		$Checkfront->host = $host;
		$cf_msg = "Updated!";
	} else {
		$cf_msg = "Invalid URL!";
	}
}


?>
<script src="<?php print WP_PLUGIN_URL . '/' . basename(dirname(__FILE__))?>/setup.js" type="text/javascript"></script>
<form method="post" action="">
<a href="http://www.checkfront.com/"><img src="http://www.checkfront.com/images/logo-small.png" alt="Checkfront" /></a><br />
<strong>Simplified Online Bookings</strong>
<p>Checkfront is a powerful online booking system that allows businesses to manage their inventories, centralize reservations, and process payments. </p>

<h3>Get Started</h3>
<ol>
<li><a href="https://www.checkfront.com/start/" target="_blank">Create your Checkfront account</a>, setup your inventory, configure your account and e-commerce.</li>
<li>Supply your Checkfront URL in the setup below.</li>
<li>Create a booking page.</li>
<li>Enable the <a href="widgets.php">Checkfront sidebar widget</a> (optional).</li>
</ol>
	<div class="metabox-holder meta-box-sortables pointer">
		<div class="postbox">
			<h3 class="hndle"><span  style="background: url('//media.checkfront.com/images/mnu/manage.png') left center no-repeat; padding: 1em 1em 1em 24px;">Setup</span></h3>
<?php
if(isset($cf_msg)){?>
<div style="background-color: rgb(255, 251, 204); margin:1em 1em 0em 1em" id="message" class="updated fade"><p><strong><?php echo $cf_msg?></strong></p></div>
<?php }?>
			<div class="inside" style="padding: 0 10px">
				<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="checkfront_email">Checkfront Host Url:</label></th>
						<td nowrap>https://<input name="checkfront_host" style="width: 20em" id="CF_id" value="<?php echo $Checkfront->host?>" class="regular-text" type="text" /> </td>
						<td id="CF_status"><em>Location of your Checkfront Management Console [<a href="https://www.checkfront.com/start">Create</a>]</em></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="checkfront_mode">Render mode:</label></th>
						<td><input type="radio" name="checkfront_mode" id="inline" value="inline" <?php if($Checkfront->mode == 'inline') print 'checked="checked"';?> /><label for="inline">Inline</label> &nbsp;&nbsp; <input type="radio" value="framed" id="framed" name="checkfront_mode"  <?php if($Checkfront->mode == 'framed') print 'checked="checked"';?> /><label for="framed">Framed</label></td>
						<td><em>In-line will blend better with your existing layout, but is not compatible with some themes.  </em></td>
					</tr>
					<tr>
					<td>
						<input type="submit" name="submit" class="button-primary" value=" Update " /> 
				</td>
					</tr>
				</tbody>
			</table>

			</div>
		</div>
	</div>
</form>
<style type="text/css">
#CF_inv  {
}
#CF_inv ul {
padding: .2em 0 .2em 2em;
}
</style>
<div class="metabox-holder meta-box-sortables pointer">
        <div class="postbox">
			<h3 class="hndle"><span  style="background: url('//media.checkfront.com/images/mnu/inventory.png') left center no-repeat; padding: 1em 1em 1em 24px;">Create a booking page</span></h3>
				<p style="padding-left: .5em"> Create a <a href="page-new.php">new Wordpress page</a> and embed the Checkfront booking system by pasting in the shortcode below.</p>
				<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="checkfront_email">Checkfront Shortcode:</label></th>
						<td><input  id="CF_shortcode" value="[checkfront]" class="regular-text" type="text" readonly="readonly" /></td>
						<td><em></em></td>
					</tr>
					<tr valign="top">
						<th scope="row">&nbsp;</th>
						<td>
			<ul id="CF_inv">
			<li><input type="radio" value="*" name="inventory" id="inventory_all" checked="checked" /><label for="inventory_all"><strong>All items and categories</strong></label></li>
			</ul>
</td>
						<td><em></em></td>
					</tr>
				</tbody>
				</table>
</ul>
</div>
</div>
<p style="color: #555">&copy; Checkfront Inc <?php print date('Y')?> &nbsp; &nbsp;  API Version: <?php print $Checkfront->api_version?></p>
