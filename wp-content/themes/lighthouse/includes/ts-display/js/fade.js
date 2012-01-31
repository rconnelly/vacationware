var $jq = jQuery.noConflict();

$jq(document).ready(function () {
	if($jq != undefined){
		if ($jq.browser.msie && $jq.browser.version < 7) return; // Don't execute code if it's IE6 or below cause it doesn't support it.
		
		$jq('.ts-display-img-container').hover(
			function() {
				$jq(this).find('.rollover').stop().fadeTo(500, 0.60);
			},
			function() {
				$jq(this).find('.rollover').stop().fadeTo(500, 0);
			}
		)
		
	}
});