jQuery(document).ready(function() {
 
	var imgurl;
	
	jQuery('#ts_uploadimg_button').click(function() {
	 	
		var postid = jQuery('#ts_uploadimg_hidden').val();
		window.send_to_editor = function(html) {
			
			imgurl = jQuery('img',html).attr('src');
			jQuery('#ts_uploadimg').val(imgurl);
			tb_remove();
	 
		}
		tb_show('', 'media-upload.php?post_id='+postid+'&amp;type=image&amp;TB_iframe=true');
		return false;
		
	});
	
	// user inserts file into post. only run custom if user started process using the above process
	// window.send_to_editor(html) is how wp would normally handle the received data

	window.original_send_to_editor = window.send_to_editor;
	window.send_to_editor = function(html){

		if (imgurl) {
			fileurl = jQuery('img',html).attr('src');

			jQuery('#ts_uploadimg').val(fileurl);

			tb_remove();

			jQuery('html').removeClass('Image');

		} else {
			window.original_send_to_editor(html);
		}
	};
 
 
});
 
jQuery(document).ready(function() {
 
	jQuery('#upload_image_button2').click(function() {
	
		window.send_to_editor = function(html) {
			
			imgurl = jQuery('img',html).attr('src');
			jQuery('#upload_image2').val(imgurl);
			tb_remove();
	
		}
	 
		tb_show('', 'media-upload.php?post_id=1&amp;type=image&amp;TB_iframe=true');
		return false;
	
	});
 
});
