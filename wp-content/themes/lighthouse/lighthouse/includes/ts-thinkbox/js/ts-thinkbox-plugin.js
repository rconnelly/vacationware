/*
Plugin Name: TS Thinkbox
Plugin URI: http://www.templatesquare.com/plugin
Description: TS Thinkbox is a wordpress plugin for displaying stylish testimonial etc.
Version: 1.0
Author: templatesquare
Author URI: http://www.templatesquare.com
License: GPL
*/

/*  Copyright 2010  TEMPLATESQUARE  (email : support@templatesquare.com)
	
	This file is part of TS Thinkbox
	
    TS Thinkbox is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// closure to avoid namespace collision
(function(){
	// creates the plugin
	tinymce.create('tinymce.plugins.ts_thinkbox', {
		// creates control instances based on the control's id.
		// our button's id is "mygallery_button"
		createControl : function(id, controlManager) {
			if (id == 'ts_thinkbox_button') {
				// creates the button
				var button = controlManager.createButton('ts_thinkbox_button', {
					title : 'TS Thinkbox Shortcode', // title of the button
					image : '../wp-content/themes/lighthouse/includes/ts-thinkbox/images/icon-mce-plugin.png',  // path to the button's image
					onclick : function() {
						// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'TS Thinkbox Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=ts-thinkbox-form' );
					}
				});
				return button;
			}
			return null;
		}
	});
	
	// registers the plugin. DON'T MISS THIS STEP!!!
	tinymce.PluginManager.add('ts_thinkbox', tinymce.plugins.ts_thinkbox);
	
	// executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="ts-thinkbox-form"><table id="ts-thinkbox-table" class="form-table">\
			<tr>\
				<th><label for="ts-thinkbox-col">Column</label></th>\
				<td><input type="text" id="ts-thinkbox-col" name="col" value="1" /><br />\
				<small>specify how many columns that you want to use for thinkbox.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-thinkbox-postperpage">Post per Page</label></th>\
				<td><input type="text" id="ts-thinkbox-postperpage" name="postperpage" value="" /><br />\
				<small>specify the number of post that you want to display in every page.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-thinkbox-cat">Category</label></th>\
				<td><input type="text" name="cat" id="ts-thinkbox-cat" value="" /><br />\
					<small>specify the category.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-thinkbox-testiid">Testimonial ID</label></th>\
				<td><input type="text" name="testiid" id="ts-thinkbox-testiid" value="" /><br />\
					<small>fill this if you want to show unique post.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-thinkbox-type">Types</label></th>\
				<td><select name="type" id="ts-thinkbox-type">\
					<option value="1" selected="selected">1</option>\
					<option value="2">2</option>\
				</select><br />\
					<small>specify the style of thinkbox.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-thinkbox-frame">Frames</label></th>\
				<td><select name="frame" id="ts-thinkbox-frame">\
					<option value="square" selected="selected">Square</option>\
					<option value="rounded">Rounded</option>\
				</select><br />\
					<small>specify the frame of thinkbox.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-thinkbox-customclass">Custom Class</label></th>\
				<td><input type="text" name="customclass" id="ts-thinkbox-customclass" value="" /><br />\
					<small>you can add custom class. if you want to custom the layout.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-thinkbox-showtitle">Show Title</label></th>\
				<td><input type="checkbox" name="showtitle" id="ts-thinkbox-showtitle" value="yes" /><br />\
					<small>check it if you want to show the title.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-thinkbox-showname">Show Name</label></th>\
				<td><input type="checkbox" name="showname" id="ts-thinkbox-showname" value="yes" checked="checked" /><br />\
					<small>check it if you want to show the name.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-thinkbox-showinfo">Show Info</label></th>\
				<td><input type="checkbox" name="showinfo" id="ts-thinkbox-showinfo" value="yes" checked="checked" /><br />\
					<small>check it if you want to show the info.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-thinkbox-showthumb">Show Thumb</label></th>\
				<td><input type="checkbox" name="showthumb" id="ts-thinkbox-showthumb" value="yes" checked="checked" /><br />\
					<small>check it if you want to show the thumb image.</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="ts-thinkbox-submit" class="button-primary" value="Insert Thinkbox" name="submit" />\
		</p>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#ts-thinkbox-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = {
				'col'			: '1',
				'cat'         	: '',
				'postperpage'	: '',
				'type'    		: '1',
				'frame'			: 'square',
				'testiid' 		: '',
				'showthumb' 	: 'yes',
				'showtitle'		: 'no',
				'showname'		: 'yes',
				'showinfo'		: 'yes',
				'customclass'	: ''
				};
			var shortcode = '[ts-thinkbox';
			
			for( var index in options) {
				var inputs = table.find('#ts-thinkbox-' + index);
				var value = inputs.val();
				
				// validate number of columns. it cant be higher than 4 and less than 1
				if(index=="col" && isNaN(value)){
					value = 3;
				}
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if(inputs.attr("type")=='checkbox'){
					if(index=="showtitle"){
						if(inputs.attr("checked")){
							shortcode += ' ' + index + '="yes"';
						}
					}else{
						if(!inputs.attr("checked"))	
							shortcode += ' ' + index + '="no"';
					}
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
	
	
	//ts-thinkboxslider icon
	// creates the plugin
	tinymce.create('tinymce.plugins.ts_thinkbox_slider', {
		// creates control instances based on the control's id.
		// our button's id is "mygallery_button"
		createControl : function(id, controlManager) {
			if (id == 'ts_thinkbox_slider_button') {
				// creates the button
				var button = controlManager.createButton('ts_thinkbox_slider_button', {
					title : 'TS Thinkbox Slider Shortcode', // title of the button
					image : '../wp-content/themes/lighthouse/includes/ts-thinkbox/images/icon-mce-plugin2.png',  // path to the button's image
					onclick : function() {
						// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'TS Thinkbox Slider Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=ts-thinkbox-slider-form' );
					}
				});
				return button;
			}
			return null;
		}
	});
	
	// registers the plugin. DON'T MISS THIS STEP!!!
	tinymce.PluginManager.add('ts_thinkbox_slider', tinymce.plugins.ts_thinkbox_slider);
	
	// executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="ts-thinkbox-slider-form"><table id="ts-thinkbox-slider-table" class="form-table">\
			<tr>\
				<th><label for="ts-thinkbox-slider-sliderfx">Slider Effects</label></th>\
				<td><select name="sliderfx" id="ts-thinkbox-slider-sliderfx">\
					<option value="scrollHorz" selected="selected">Default</option>\
					<option value="fade">Fade</option>\
					<option value="scrollUp">Scroll Up</option>\
					<option value="scrollDown">Scroll Down</option>\
				</select><br />\
				<small>specify the effect for thinkbox slider.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-thinkbox-slider-postperpage">Post per Page</label></th>\
				<td><input type="text" id="ts-thinkbox-slider-postperpage" name="postperpage" value="" /><br />\
				<small>specify the number of post that you want to display in every page.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-thinkbox-slider-cat">Category</label></th>\
				<td><input type="text" name="cat" id="ts-thinkbox-slider-cat" value="" /><br />\
					<small>specify the category.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-thinkbox-slider-testiid">Testimonial ID</label></th>\
				<td><input type="text" name="testiid" id="ts-thinkbox-slider-testiid" value="" /><br />\
					<small>fill this if you want to show unique post.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-thinkbox-slider-customclass">Custom Class</label></th>\
				<td><input type="text" name="customclass" id="ts-thinkbox-slider-customclass" value="" /><br />\
					<small>you can add custom class. if you want to custom the layout.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-thinkbox-slider-showtitle">Show Title</label></th>\
				<td><input type="checkbox" name="showtitle" id="ts-thinkbox-slider-showtitle" value="yes" /><br />\
					<small>check it if you want to show the title.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-thinkbox-slider-showname">Show Name</label></th>\
				<td><input type="checkbox" name="showname" id="ts-thinkbox-slider-showname" value="yes" checked="checked" /><br />\
					<small>check it if you want to show the name.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ts-thinkbox-slider-showinfo">Show Info</label></th>\
				<td><input type="checkbox" name="showinfo" id="ts-thinkbox-slider-showinfo" value="yes" checked="checked" /><br />\
					<small>check it if you want to show the info.</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="ts-thinkbox-slider-submit" class="button-primary" value="Insert Thinkbox Slider" name="submit" />\
		</p>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#ts-thinkbox-slider-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = {
				'sliderfx'		: 'scrollHorz',
				'cat'         	: '',
				'postperpage'	: '',
				'testiid' 		: '',
				'showtitle'		: 'no',
				'showname'		: 'yes',
				'showinfo'		: 'yes',
				'customclass'	: ''
				};
			var shortcode = '[ts-thinkboxslider';
			
			for( var index in options) {
				var inputs = table.find('#ts-thinkbox-slider-' + index);
				var value = inputs.val();
				
				// validate number of columns. it cant be higher than 4 and less than 1
				if(index=="col" && isNaN(value)){
					value = 3;
				}
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if(inputs.attr("type")=='checkbox'){
					if(index=="showtitle"){
						if(inputs.attr("checked")){
							shortcode += ' ' + index + '="yes"';
						}
					}else{
						if(!inputs.attr("checked"))	
							shortcode += ' ' + index + '="no"';
					}
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