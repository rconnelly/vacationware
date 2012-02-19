<?php
/*
Plugin Name: FrameKiller
Plugin URI: http://blogwordpress.ws/plugin-framekiller
Description: Plugin to prevent your site being open inside frames and iframes
Author: Anderson Makiyama
Version: 0.1
Author URI: http://blogwordpress.ws
*/


class Anderson_Makiyama_Framekiller{
	const CLASS_NAME = 'Anderson_Makiyama_Framekiller';
	public static $CLASS_NAME = self::CLASS_NAME;
	const PLUGIN_ID = 5;
	public static $PLUGIN_ID = self::PLUGIN_ID;
	const PLUGIN_NAME = 'Framekiller';
	public static $PLUGIN_NAME = self::PLUGIN_NAME;
	const PLUGIN_PAGE = 'http://blogwordpress.ws/plugin-framekiller';
	public static $PLUGIN_PAGE = self::PLUGIN_PAGE;
	const PLUGIN_VERSION = '0.1';
	public static $PLUGIN_VERSION = self::PLUGIN_VERSION;
	public $plugin_slug = "anderson_makiyama_";
	public $plugin_base_name;
	
    public function getStaticVar($var) {
        return self::$$var;
    }	
	
	public function __construct(){
		$this->plugin_base_name = plugin_basename(__FILE__);
		$this->plugin_slug.= str_replace(" ","_",self::PLUGIN_NAME);

	}
	
	public function add_jscript(){
		global $anderson_makiyama;
		$options = get_option($anderson_makiyama[self::PLUGIN_ID]->plugin_slug."_options");
		$places = $options[$anderson_makiyama[self::PLUGIN_ID]->plugin_slug."_places"];
		
		$is["home"] = is_home();
		$is["single"] = is_single();
		$is["page"] = is_page();
		$is["category"] = is_category();
		$is["tag"] = is_tag();
		$is["search"] = is_search();
		
		if(!empty($places) || is_array($places)){
			foreach($places as $place){
				if($is[$place]){
					return;	
				}
			}
		}
		
		echo '<script>
			if (top != self) top.location = self.location;
			</script>';
	    
	}
	
	public function options(){
		global $anderson_makiyama;
		global $user_level;
		get_currentuserinfo();
		if ($user_level < 10) {
			return;
		}

		  if (function_exists('add_options_page')) {
			add_options_page(__(self::PLUGIN_NAME), __(self::PLUGIN_NAME), 1, __FILE__, array(self::CLASS_NAME,'options_page'));
		  }
		
	}	
	
	public function options_page(){
		global $anderson_makiyama;
		global $user_level;
		get_currentuserinfo();
		if ($user_level < 10) {
			return;
		}
		
		$options = get_option($anderson_makiyama[self::PLUGIN_ID]->plugin_slug."_options");
		
		if ($_POST[$anderson_makiyama[self::PLUGIN_ID]->plugin_slug.'_submit']) {
			$options[$anderson_makiyama[self::PLUGIN_ID]->plugin_slug.'_places'] = $_POST[$anderson_makiyama[self::PLUGIN_ID]->plugin_slug.'_places'];
			update_option($anderson_makiyama[self::PLUGIN_ID]->plugin_slug."_options", $options);
		}
				
		
		include("templates/options.php");
	}	
	
	public function is_checked($place){
		global $anderson_makiyama;

		$options = get_option($anderson_makiyama[self::PLUGIN_ID]->plugin_slug."_options");
		$places_ = $options[$anderson_makiyama[self::PLUGIN_ID]->plugin_slug."_places"];
		
		if(is_array($places_) && in_array($place,$places_)) return " checked='checked' ";
		
		return "";
		
	}	
	
	public static function makeData($data, $anoConta,$mesConta,$diaConta){
	   $ano = substr($data,0,4);
	   $mes = substr($data,5,2);
	   $dia = substr($data,8,2);
	   return date('Y-m-d',mktime (0, 0, 0, $mes+($mesConta), $dia+($diaConta), $ano+($anoConta)));	
	}
	
	public static function get_data_array($data,$part=''){
	   $data_ = array();
	   $data_["ano"] = substr($data,0,4);
	   $data_["mes"] = substr($data,5,2);
	   $data_["dia"] = substr($data,8,2);
	   if(empty($part))return $data_;
	   return $data_[$part];
	}	
	
	public static function isSelected($campo, $varCampo){
		if($campo==$varCampo) return " selected=selected ";
		return "";
	}	
}
if(!isset($anderson_makiyama)) $anderson_makiyama = array();
$anderson_makiyama_indice = Anderson_Makiyama_Framekiller::PLUGIN_ID;
$anderson_makiyama[$anderson_makiyama_indice] = new Anderson_Makiyama_Framekiller();
add_filter("admin_menu", array($anderson_makiyama[$anderson_makiyama_indice]->getStaticVar('CLASS_NAME'), 'options'),30);
add_action('wp_head',array($anderson_makiyama[$anderson_makiyama_indice]->getStaticVar('CLASS_NAME'), 'add_jscript'));

?>