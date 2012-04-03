/* Cookie */
jQuery.cookie = function(name, value, options) {
if (typeof value != 'undefined') {
options = options || {};
if (value === null) {
value = '';
options.expires = -1;
}
var expires = '';
if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
var date;
if (typeof options.expires == 'number') {
date = new Date();
date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
} else {
date = options.expires;
}
expires = '; expires=' + date.toUTCString();
}
var path = options.path ? '; path=' + (options.path) : '';
var domain = options.domain ? '; domain=' + (options.domain) : '';
var secure = options.secure ? '; secure' : '';
document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
} else {
var cookieValue = null;
if (document.cookie && document.cookie != '') {
var cookies = document.cookie.split(';');
for (var i = 0; i < cookies.length; i++) {
var cookie = jQuery.trim(cookies[i]);
if (cookie.substring(0, name.length + 1) == (name + '=')) {
cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
break;
}
}
}
return cookieValue;
}
};
/* Box Height, Shake */
(function(jQuery) {
jQuery.fn.equalHeights = function(minHeight, maxHeight) {
tallest = (minHeight) ? minHeight : 0;
this.each(function() {
if(jQuery(this).height() > tallest) {
tallest = jQuery(this).height();
}
});
if((maxHeight) && tallest > maxHeight) tallest = maxHeight;
return this.each(function() {
jQuery(this).height(tallest).css("overflow","hidden");
});
}
})(jQuery);
jQuery.fn.shake = function(intShakes , intDistance , intDuration ) {
this.each(function() {
jQuery(this).css({position:'relative'});
for (var x=1; x<=intShakes; x++) {
jQuery(this).animate({left:(intDistance*-1)}, (((intDuration/intShakes)/4)))
.animate({left:intDistance}, ((intDuration/intShakes)/2))
.animate({left:0}, (((intDuration/intShakes)/4)));
}
});
return this;
};
/* Fileupload */
(function(){
var d = document, w = window;
function get(element){
if (typeof element == "string")
element = d.getElementById(element);
return element;
}
function addEvent(el, type, fn){
if (w.addEventListener){
el.addEventListener(type, fn, false);
} else if (w.attachEvent){
var f = function(){
fn.call(el, w.event);
};	el.attachEvent('on' + type, f)
}
}
var toElement = function(){
var div = d.createElement('div');
return function(html){
div.innerHTML = html;
var el = div.childNodes[0];
div.removeChild(el);
return el;
}
}();
function hasClass(ele,cls){
return ele.className.match(new RegExp('(\\s|^)'+cls+'(\\s|$)'));
}
function addClass(ele,cls) {
if (!hasClass(ele,cls)) ele.className += " "+cls;
}
function removeClass(ele,cls) {
var reg = new RegExp('(\\s|^)'+cls+'(\\s|$)');
ele.className=ele.className.replace(reg,' ');
}
if (document.documentElement["getBoundingClientRect"]){
var getOffset = function(el){
var box = el.getBoundingClientRect(),
doc = el.ownerDocument,
body = doc.body,
docElem = doc.documentElement,
clientTop = docElem.clientTop || body.clientTop || 0,
clientLeft = docElem.clientLeft || body.clientLeft || 0,
zoom = 1;
if (body.getBoundingClientRect) {
var bound = body.getBoundingClientRect();
zoom = (bound.right - bound.left)/body.clientWidth;
}
if (zoom > 1){
clientTop = 0;
clientLeft = 0;
}
var top = box.top/zoom + (window.pageYOffset || docElem && docElem.scrollTop/zoom || body.scrollTop/zoom) - clientTop,
left = box.left/zoom + (window.pageXOffset|| docElem && docElem.scrollLeft/zoom || body.scrollLeft/zoom) - clientLeft;
return {
top: top,
left: left
};
}
} else {
var getOffset = function(el){
if (w.jQuery){
return jQuery(el).offset();
}	var top = 0, left = 0;
do {
top += el.offsetTop || 0;
left += el.offsetLeft || 0;
}
while (el = el.offsetParent);
return {
left: left,
top: top
};
}
}
function getBox(el){
var left, right, top, bottom;	var offset = getOffset(el);
left = offset.left;
top = offset.top;
right = left + el.offsetWidth;
bottom = top + el.offsetHeight;	return {
left: left,
right: right,
top: top,
bottom: bottom
};
}
function getMouseCoords(e){	if (!e.pageX && e.clientX){
var zoom = 1;	var body = document.body;
if (body.getBoundingClientRect) {
var bound = body.getBoundingClientRect();
zoom = (bound.right - bound.left)/body.clientWidth;
}
return {
x: e.clientX / zoom + d.body.scrollLeft + d.documentElement.scrollLeft,
y: e.clientY / zoom + d.body.scrollTop + d.documentElement.scrollTop
};
}
return {
x: e.pageX,
y: e.pageY
};	}
var getUID = function(){
var id = 0;
return function(){
return 'ValumsAjaxUpload' + id++;
}
}();
function fileFromPath(file){
return file.replace(/.*(\/|\\)/, "");	}
function getExt(file){
return (/[.]/.exec(file)) ? /[^.]+$/.exec(file.toLowerCase()) : '';
}	Ajax_upload = AjaxUpload = function(button, options){
if (button.jquery){
button = button[0];
} else if (typeof button == "string" && /^#.*/.test(button)){	button = button.slice(1);	}
button = get(button);	this._input = null;
this._button = button;
this._disabled = false;
this._submitting = false;
this._justClicked = false;
this._parentDialog = d.body;
if (window.jQuery && jQuery.ui && jQuery.ui.dialog){
var parentDialog = jQuery(this._button).parents('.ui-dialog');
if (parentDialog.length){
this._parentDialog = parentDialog[0];
}
}	this._settings = {
action: 'upload.php',	name: 'userfile',
data: {},
autoSubmit: true,
responseType: false,
onChange: function(file, extension){},	onSubmit: function(file, extension){},
onComplete: function(file, response) {}
};
for (var i in options) {
this._settings[i] = options[i];
}
this._createInput();
this._rerouteClicks();
}
AjaxUpload.prototype = {
setData : function(data){
this._settings.data = data;
},
disable : function(){
this._disabled = true;
},
enable : function(){
this._disabled = false;
},
destroy : function(){
if(this._input){
if(this._input.parentNode){
this._input.parentNode.removeChild(this._input);
}
this._input = null;
}
},	_createInput : function(){
var self = this;
var input = d.createElement("input");
input.setAttribute('type', 'file');
input.setAttribute('name', this._settings.name);
var styles = {
'position' : 'absolute'
,'margin': '-5px 0 0 -175px'
,'padding': 0
,'width': '220px'
,'height': '30px'
,'fontSize': '14px'	,'opacity': 0
,'cursor': 'hand'
,'display' : 'none'
,'zIndex' :  2147483583
};
for (var i in styles){
input.style[i] = styles[i];
}
if ( ! (input.style.opacity === "0")){
input.style.filter = "alpha(opacity=0)";
}
this._parentDialog.appendChild(input);
addEvent(input, 'change', function(){
var file = fileFromPath(this.value);	if(self._settings.onChange.call(self, file, getExt(file)) == false ){
return;	}	if (self._settings.autoSubmit){
self.submit();	}	});
addEvent(input, 'click', function(){
self.justClicked = true;
setTimeout(function(){
self.justClicked = false;
}, 2500);	});	this._input = input;
},
_rerouteClicks : function (){
var self = this;
var box, dialogOffset = {top:0, left:0}, over = false;
addEvent(self._button, 'mouseover', function(e){
if (!self._input || over) return;
over = true;
box = getBox(self._button);
if (self._parentDialog != d.body){
dialogOffset = getOffset(self._parentDialog);
}	});
addEvent(document, 'mousemove', function(e){
var input = self._input;	if (!input || !over) return;
if (self._disabled){
removeClass(self._button, 'hover');
input.style.display = 'none';
return;
}	var c = getMouseCoords(e);
if ((c.x >= box.left) && (c.x <= box.right) &&
(c.y >= box.top) && (c.y <= box.bottom)){
input.style.top = c.y - dialogOffset.top + 'px';
input.style.left = c.x - dialogOffset.left + 'px';
input.style.display = 'block';
addClass(self._button, 'hover');
} else {	over = false;
var check = setInterval(function(){
if (self.justClicked){
return;
}
if ( !over ){
input.style.display = 'none';	}	clearInterval(check);
}, 25);
removeClass(self._button, 'hover');
}	});	},
_createIframe : function(){
var id = getUID();
var iframe = toElement('<iframe src="javascript:false;" name="' + id + '" />');
iframe.id = id;
iframe.style.display = 'none';
d.body.appendChild(iframe);	return iframe;	},
submit : function(){
var self = this, settings = this._settings;	if (this._input.value === ''){
return;
}
var file = fileFromPath(this._input.value);	if (! (settings.onSubmit.call(this, file, getExt(file)) == false)) {
var iframe = this._createIframe();
var form = this._createForm(iframe);
form.appendChild(this._input);
form.submit();
d.body.removeChild(form);	form = null;
this._input = null;
this._createInput();
var toDeleteFlag = false;
addEvent(iframe, 'load', function(e){
if (
iframe.src == "javascript:'%3Chtml%3E%3C/html%3E';" ||
iframe.src == "javascript:'<html></html>';"){	if( toDeleteFlag ){
setTimeout( function() {
d.body.removeChild(iframe);
}, 0);
}
return;
}	var doc = iframe.contentDocument ? iframe.contentDocument : frames[iframe.id].document;
if (doc.readyState && doc.readyState != 'complete'){
return;
}
if (doc.body && doc.body.innerHTML == "false"){
return;	}
var response;
if (doc.XMLDocument){
response = doc.XMLDocument;
} else if (doc.body){
response = doc.body.innerHTML;
if (settings.responseType && settings.responseType.toLowerCase() == 'json'){
if (doc.body.firstChild && doc.body.firstChild.nodeName.toUpperCase() == 'PRE'){
response = doc.body.firstChild.firstChild.nodeValue;
}
if (response) {
response = window["eval"]("(" + response + ")");
} else {
response = {};
}
}
} else {
var response = doc;
}
settings.onComplete.call(self, file, response);
toDeleteFlag = true;
iframe.src = "javascript:'<html></html>';";	});
} else {
d.body.removeChild(this._input);	this._input = null;
this._createInput();	}
},	_createForm : function(iframe){
var settings = this._settings;
var form = toElement('<form method="post" enctype="multipart/form-data"></form>');
form.style.display = 'none';
form.action = settings.action;
form.target = iframe.name;
d.body.appendChild(form);
for (var prop in settings.data){
var el = d.createElement("input");
el.type = 'hidden';
el.name = prop;
el.value = settings.data[prop];
form.appendChild(el);
}	return form;
}	};
})();
/* Clipboard */
var ZeroClipboard = {
version: "1.0.7",
clients: {},
moviePath: WPtouchCustom.wptouch_url + '/admin/js/ZeroClipboard.swf',
nextId: 1,
$: function(thingy) {
if (typeof(thingy) == 'string') thingy = document.getElementById(thingy);
if (!thingy.addClass) {
thingy.hide = function() { this.style.display = 'none'; };
thingy.show = function() { this.style.display = ''; };
thingy.addClass = function(name) { this.removeClass(name); this.className += ' ' + name; };
thingy.removeClass = function(name) {
var classes = this.className.split(/\s+/);
var idx = -1;
for (var k = 0; k < classes.length; k++) {
if (classes[k] == name) { idx = k; k = classes.length; }
}
if (idx > -1) {
classes.splice( idx, 1 );
this.className = classes.join(' ');
}
return this;
};
thingy.hasClass = function(name) {
return !!this.className.match( new RegExp("\\s*" + name + "\\s*") );
};
}
return thingy;
},
setMoviePath: function(path) {
this.moviePath = path;
},
dispatch: function(id, eventName, args) {
var client = this.clients[id];
if (client) {
client.receiveEvent(eventName, args);
}
},
register: function(id, client) {
this.clients[id] = client;
},
getDOMObjectPosition: function(obj, stopObj) {
var info = {
left: 0,
top: 0,
width: obj.width ? obj.width : obj.offsetWidth,
height: obj.height ? obj.height : obj.offsetHeight
};
while (obj && (obj != stopObj)) {
info.left += obj.offsetLeft;
info.top += obj.offsetTop;
obj = obj.offsetParent;
}
return info;
},
Client: function(elem) {
this.handlers = {};
this.id = ZeroClipboard.nextId++;
this.movieId = 'ZeroClipboardMovie_' + this.id;
ZeroClipboard.register(this.id, this);
if (elem) this.glue(elem);
}
};
ZeroClipboard.Client.prototype = {
id: 0,
ready: false,
movie: null,
clipText: '',
handCursorEnabled: true,
cssEffects: true,
handlers: null,
glue: function(elem, appendElem, stylesToAdd) {
this.domElement = ZeroClipboard.$(elem);
var zIndex = 99;
if (this.domElement.style.zIndex) {
zIndex = parseInt(this.domElement.style.zIndex, 10) + 1;
}
if (typeof(appendElem) == 'string') {
appendElem = ZeroClipboard.$(appendElem);
}
else if (typeof(appendElem) == 'undefined') {
appendElem = document.getElementsByTagName('body')[0];
}
var box = ZeroClipboard.getDOMObjectPosition(this.domElement, appendElem);
this.div = document.createElement('div');
var style = this.div.style;
style.position = 'absolute';
style.left = '' + box.left + 'px';
style.top = '' + box.top + 'px';
style.width = '' + box.width + 'px';
style.height = '' + box.height + 'px';
style.zIndex = zIndex;
if (typeof(stylesToAdd) == 'object') {
for (addedStyle in stylesToAdd) {
style[addedStyle] = stylesToAdd[addedStyle];
}
}
appendElem.appendChild(this.div);
this.div.innerHTML = this.getHTML( box.width, box.height );
},
getHTML: function(width, height) {
var html = '';
var flashvars = 'id=' + this.id +
'&width=' + width +
'&height=' + height;
if (navigator.userAgent.match(/MSIE/)) {
var protocol = location.href.match(/^https/i) ? 'https://' : 'http://';
html += '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="'+protocol+'download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="'+width+'" height="'+height+'" id="'+this.movieId+'" align="middle"><param name="allowScriptAccess" value="always" /><param name="allowFullScreen" value="false" /><param name="movie" value="'+ZeroClipboard.moviePath+'" /><param name="loop" value="false" /><param name="menu" value="false" /><param name="quality" value="best" /><param name="bgcolor" value="#ffffff" /><param name="flashvars" value="'+flashvars+'"/><param name="wmode" value="transparent"/></object>';
}
else {
html += '<embed id="'+this.movieId+'" src="'+ZeroClipboard.moviePath+'" loop="false" menu="false" quality="best" bgcolor="#ffffff" width="'+width+'" height="'+height+'" name="'+this.movieId+'" align="middle" allowScriptAccess="always" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="'+flashvars+'" wmode="transparent" />';
}
return html;
},
hide: function() {
if (this.div) {
this.div.style.left = '-2000px';
}
},
show: function() {
this.reposition();
},
destroy: function() {
if (this.domElement && this.div) {
this.hide();
this.div.innerHTML = '';
var body = document.getElementsByTagName('body')[0];
try { body.removeChild( this.div ); } catch(e) {;}
this.domElement = null;
this.div = null;
}
},
reposition: function(elem) {
if (elem) {
this.domElement = ZeroClipboard.$(elem);
if (!this.domElement) this.hide();
}
if (this.domElement && this.div) {
var box = ZeroClipboard.getDOMObjectPosition(this.domElement);
var style = this.div.style;
style.left = '' + box.left + 'px';
style.top = '' + box.top + 'px';
}
},
setText: function(newText) {
this.clipText = newText;
if (this.ready) this.movie.setText(newText);
},
addEventListener: function(eventName, func) {
eventName = eventName.toString().toLowerCase().replace(/^on/, '');
if (!this.handlers[eventName]) this.handlers[eventName] = [];
this.handlers[eventName].push(func);
},
setHandCursor: function(enabled) {
this.handCursorEnabled = enabled;
if (this.ready) this.movie.setHandCursor(enabled);
},
setCSSEffects: function(enabled) {
this.cssEffects = !!enabled;
},
receiveEvent: function(eventName, args) {
eventName = eventName.toString().toLowerCase().replace(/^on/, '');
switch (eventName) {
case 'load':
this.movie = document.getElementById(this.movieId);
if (!this.movie) {
var self = this;
setTimeout( function() { self.receiveEvent('load', null); }, 1 );
return;
}
if (!this.ready && navigator.userAgent.match(/Firefox/) && navigator.userAgent.match(/Windows/)) {
var self = this;
setTimeout( function() { self.receiveEvent('load', null); }, 100 );
this.ready = true;
return;
}
this.ready = true;
this.movie.setText( this.clipText );
this.movie.setHandCursor( this.handCursorEnabled );
break;
case 'mouseover':
if (this.domElement && this.cssEffects) {
this.domElement.addClass('hover');
if (this.recoverActive) this.domElement.addClass('active');
}
break;
case 'mouseout':
if (this.domElement && this.cssEffects) {
this.recoverActive = false;
if (this.domElement.hasClass('active')) {
this.domElement.removeClass('active');
this.recoverActive = true;
}
this.domElement.removeClass('hover');
}
break;
case 'mousedown':
if (this.domElement && this.cssEffects) {
this.domElement.addClass('active');
}
break;
case 'mouseup':
if (this.domElement && this.cssEffects) {
this.domElement.removeClass('active');
this.recoverActive = false;
}
break;
}
if (this.handlers[eventName]) {
for (var idx = 0, len = this.handlers[eventName].length; idx < len; idx++) {
var func = this.handlers[eventName][idx];
if (typeof(func) == 'function') {
func(this, args);
}
else if ((typeof(func) == 'object') && (func.length == 2)) {
func[0][ func[1] ](this, args);
}
else if (typeof(func) == 'string') {
window[func](this, args);
}}}}};

/* The Colorpicker Pop-Up */
var win=null;function NewWindow(mypage,myname,w,h,scroll){LeftPosition=(screen.width)?(screen.width-w)/2:0;TopPosition=(screen.height)?(screen.height-h)/2:0;settings='height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+','
win=window.open(mypage,myname,settings)}


function doBncTooltip( selector, tooltip_id, x_offset, y_offset ) {
	jQuery( selector ).live( 'mouseover', function() { 
		var tooltipText = jQuery( this ).attr( 'title' );
		jQuery( this ).attr( 'title', '' );

		var offset = jQuery( this ).position();

		jQuery( this ).parent().append( '<div id="wptouch-tooltip" class="round-12" style="display: none; width: 35%;">' + tooltipText + '</div>' );
		
		jQuery( tooltip_id ).html( tooltipText );
		
		var tooltip_height = jQuery( tooltip_id ).height();
		var tooltip_width = jQuery( tooltip_id ).width();
	
		jQuery( tooltip_id ).css( 'left', ( offset.left + x_offset ) + 'px' ).css( 'top', ( offset.top + y_offset - tooltip_height ) + 'px' ).fadeIn( 250 );
		jQuery( tooltip_id ).css( 'position', 'absolute' );
	}).live( 'mouseout', function() { 
		var tooltipText = jQuery( tooltip_id ).html();
		jQuery( this ).attr( 'title', tooltipText );
		jQuery( tooltip_id ).remove();
	//	jQuery( tooltip_id ).fadeOut( 250 );
	});
}