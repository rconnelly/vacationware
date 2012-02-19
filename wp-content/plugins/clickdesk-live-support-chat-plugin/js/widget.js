var glcpath = (('https:' == document.location.protocol) ? 'https://contactuswidget.appspot.com/livily/browser/' : 'http://contactuswidget.appspot.com/livily/browser/');

var glcp = (('https:' == document.location.protocol) ? 'https://' : 'http://');
var glcspt = document.createElement('script'); glcspt.type = 'text/javascript'; glcspt.async = true;glcspt.src = glcpath + 'livechat.js';

var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(glcspt, s);

