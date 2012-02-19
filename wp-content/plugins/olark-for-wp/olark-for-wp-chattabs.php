<?php
/*=== LEGAL INFORMATION ===
   Copyright (C) 2011 Russell Osborne <projects@burningpony.com> - www.burningpony.com

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program. If not, see <http://www.gnu.org/licenses/>.
*/
$tab_options = get_option('ofwTabs');

if($tab_options["type"]=="CSS"){
	add_action('wp_footer', 'ofw_css_tab');
}elseif($tab_options["type"]=="Image"){
	add_action('wp_footer', 'ofw_image_tab');
}
	
function ofw_css_tab(){	
	echo '<!-- BEGIN OLARK TAB--> <style> div#olark_tab{ position: fixed; left: 0; bottom:40%; z-index:5000; } #olark_tab div{ height: 150px; width: 150px; float: left; filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3); -webkit-transform: rotate(-90deg); -moz-transform: rotate(-90deg); } #olark_tab a{ /*Edit these to change the look of your tab*/ background-color: black; color: white; font: bold 18px "century gothic"; height: 20px; padding: 6px; border: 2px solid #363636;display: block; text-decoration: none; text-align: center; width: auto; -webkit-border-bottom-right-radius:9px; -webkit-border-bottom-left-radius:9px; -moz-border-radius-bottomleft:9px;-moz-border-radius-bottomright:9px; border-top-style: none; border-top-width: 0; }#olark_tab a:hover{ background-color: white; color: black; }</style><div id="olark_tab"> <div> <a href="javascript:void(0);" onclick="habla_window.expand()">click to chat</a> </div> </div> <!-- END OLARK TAB-->';
}
function ofw_image_tab(){
	
	echo '<!-- BEGIN OLARK IMAGE TAB--><style>div#olark_tab{ position: fixed; left: 0; bottom:0%; z-index:5000; }#olark_tab a { display:block; /*Edit these to change the look of your tab*/ border: 3px solid white; border-left-style: none; border-bottom-style: none; margin-top:0px; }#olark_tab a:hover{ border-color: orange; }</style><div id="olark_tab"> <a href="javascript:void(0);" onclick="habla_window.expand()"><img src="http://static.olark.com/images/livehelp-tab-icon.png" /></a> </div><!-- END OLARK TAB-->';
}
?>