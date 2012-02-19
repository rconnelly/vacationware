var $jq = jQuery.noConflict();
$jq(document).ready(function(){
	if($jq != undefined){
		$jq("#ts-display a[rel^=\'prettyPhoto\']").prettyPhoto({theme:'facebook'});
	}
});