var $jq = jQuery.noConflict();
$jq(document).ready(function () {
	if ($jq.browser.msie && $jq.browser.version < 7) return; // Don't execute code if it's IE6 or below cause it doesn't support it.
	
	$jq(".fade").fadeTo(1, 1);
	$jq(".fade").hover(
		function () {
			$jq(this).fadeTo("fast", 0.33);
		},
		function () {
			$jq(this).fadeTo("slow", 1);
		}
  	);
});