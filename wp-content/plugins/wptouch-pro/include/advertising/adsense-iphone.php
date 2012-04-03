<?php global $wptouch_pro; ?>
<?php $settings = $wptouch_pro->get_settings(); ?>

<script type="text/javascript"><!--
	window.googleAfmcRequest = {
	  client: '<?php echo $settings->adsense_id; ?>',
	  ad_type: 'text',
	  output: 'html',
	  channel: '<?php echo $settings->adsense_channel; ?>',
	  format: '320x50_mb',
	  oe: 'utf8',
	  color_border: '336699',
	  color_bg: 'FFFFFF',
	  color_link: '0000FF',
	  color_text: '000000',
	  color_url: '008000'
	};
//--></script>
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_afmc_ads.js"></script>