// closure to avoid namespace collision
(function(){
	// creates the plugin
	tinymce.create('tinymce.plugins.ts_display', {
		// creates control instances based on the control's id.
		// our button's id is "mygallery_button"
		createControl : function(id, controlManager) {
			if (id == 'ts_display_button') {
				// creates the button
				var button = controlManager.createButton('ts_display_button', {
					title : 'TS Display Shortcode', // title of the button
					image : '../wp-content/themes/lighthouse/includes/ts-display/images/TS-Display.png',  // path to the button's image
					onclick : function() {
						// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'TS Display Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=ts-display-form' );
					}
				});
				return button;
			}
			return null;
		}
	});
	
	// registers the plugin. DON'T MISS THIS STEP!!!
	tinymce.PluginManager.add('ts_display', tinymce.plugins.ts_display);
	
	// executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="ts-display-form"><table id="ts-display-table" class="form-table">\
			<tr>\
				<th><label for="ts-display-col">Columns</label></th>\
				<td><input type="text" id="ts-display-col" name="col" value="3" /><br />\
				<small>specify the number of columns.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-display-postperpage">Post per Page</label></th>\
				<td><input type="text" id="ts-display-postperpage" name="postperpage" value="8" /><br />\
				<small>specify the number of post that you want to display in every page.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-display-orderby">Order By</label></th>\
				<td><input type="text" name="orderby" id="ts-display-orderby" value="menu_order ASC, ID ASC" /><br /><small>RAND (random) is also supported.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-display-cat">Category</label></th>\
				<td><input type="text" name="cat" id="ts-display-cat" value="" /><br />\
					<small>specify the category.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-display-frame">Frame</label></th>\
				<td><select name="frame" id="ts-display-frame">\
					<option value="default" selected="selected">Default</option>\
					<option value="square">Square</option>\
					<option value="rounded">Rounded</option>\
				</select><br />\
					<small>specify the style of display.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-display-fbordercolor">Frame Border Color</label></th>\
				<td><input type="text" name="fbordercolor" id="ts-display-fbordercolor" value="#d5d5d5" /><br />\
					<small>specify the border color. this option is only for frame 2 and frame 3</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-display-fbgcolor">Frame Background Color</label></th>\
				<td><input type="text" name="fbgcolor" id="ts-display-fbgcolor" value="#e9e9e9" /><br />\
					<small>specify the background color. this option is only for frame 2 and frame 3</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-display-customclass">Custom Class</label></th>\
				<td><input type="text" name="customclass" id="ts-display-customclass" value="" /><br />\
					<small>you can add custom class. if you want to custom the layout.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-display-contentwidth">Width Container</label></th>\
				<td><input type="text" name="contentwidth" id="ts-display-contentwidth" value="" /><br />\
					<small>specify how wide is your display container. default value is from the TS Display settings.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-display-widthimg">Width Image</label></th>\
				<td><input type="text" name="widthimg" id="ts-display-widthimg" value="" /><br />\
					<small>specify your image width. default value is from the TS Display settings.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-display-heightimg">Height Image</label></th>\
				<td><input type="text" name="heightimg" id="ts-display-heightimg" value="" /><br />\
					<small>specify your image height. default value is from the TS Display settings.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-display-colspacing">Column Spacing</label></th>\
				<td><input type="text" name="colspacing" id="ts-display-colspacing" value="" /><br />\
					<small>specify the space between 2 columns. default value is from the TS Display settings.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-display-rowspacing">Row Spacing</label></th>\
				<td><input type="text" name="rowspacing" id="ts-display-rowspacing" value="" /><br />\
					<small>specify the space between 2 rows. default value is from the TS Display settings.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-display-showtitle">Show Title</label></th>\
				<td><input type="checkbox" name="showtitle" id="ts-display-showtitle" value="yes" /><br />\
					<small>check it if you want to show the title.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-display-showdesc">Show Description</label></th>\
				<td><input type="checkbox" name="showdesc" id="ts-display-showdesc" value="yes" /><br />\
					<small>check it if you want to show the description.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-display-showmore">Show Read More</label></th>\
				<td><input type="checkbox" name="showtitle" id="ts-display-showmore" value="yes" /><br />\
					<small>check it if you want to show read more link.</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="ts-display-submit" class="button-primary" value="Insert Display" name="submit" />\
		</p>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#ts-display-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'cat'         	: '',
				'col'       	: '3',
				'postperpage'	: '8',
				'orderby'    	: 'menu_order ASC, ID ASC',
				'frame'    		: 'default',
				'showtitle' 	: 'no',
				'showdesc' 		: 'no',
				'showmore'		: 'no',
				'fbordercolor'	: '#d5d5d5',
				'fbgcolor'		: '#e9e9e9',
				'customclass'	: '',
				'contentwidth'	: '',
				'widthimg'		: '',
				'heightimg'		: '',
				'colspacing'	: '',
				'rowspacing'	: ''
				};
			var shortcode = '[ts-display';
			
			for( var index in options) {
				var inputs = table.find('#ts-display-' + index);
				var value = inputs.val();
				
				// validate number of columns. it cant be higher than 4 and less than 1
				if(index=="col" && isNaN(value)){
					value = 3;
				}
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if(inputs.attr("type")=='checkbox'){
					if(inputs.attr("checked"))	
						shortcode += ' ' + index + '="' + value + '"';
				}else{
					if ( value !== options[index] )
						shortcode += ' ' + index + '="' + value + '"';
				}
			}
			
			shortcode += ']';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})()