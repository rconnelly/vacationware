<?php
if (!class_exists( 'PluginFrameworkRawFunction' )):
    class PluginFrameworkRawFunction {
        
        /**
         * Generate HTML input element
         * @param string $name: Name of input element
         * @param mixed $value: Value of input element
         * @param string $type: Type of input element, Possible types are: text, password, select, textarea, file
         * @param array $attr : all other attribute will goes there. 
         * Supporting common attr: id, class, style, label, enclose, before, after
         * For select element: use 'by_key' as for using $optipms key as select value
         * Use enclose for enclosing by other html element: (eg. array('enclose'=>'p') or  array("enclose"=>"p class='abc'")  )
         * @param array $options : options for select, checkbox
         */
        function createInput($name='', $type='text', $attr=array(), $options=array()){   
            $name   = trim($name);
            $name   = $name ? "name=\"$name\"" : '';      
            
            if( isset($attr['value']) ){
                if( is_string( $attr['value'] ) ) $attr['value'] = esc_attr( trim( $attr['value'] ) );
            }                           
            $value  = isset( $attr['value'] ) ? $attr['value'] : null;           
            
            //filter attr for add
            $excludeAttr = array( 'before', 'after', 'enclose', 'label', 'by_key', 'label_class', 'combind', 'option_before', 'option_after' );      
            $excludeType = array( 'select', 'radio', 'label', 'checkbox' );  //exclude adding value                          
            if(in_array( $type, $excludeType )) $excludeAttr[] = 'value';   
            $include = null;                  
            if($attr){
                foreach( $attr as $key => $val){
                    if( !in_array( $key, $excludeAttr ) ){
                        $include .= $val ? "$key='$val' " : "";
                    }                        
                }
            }
            
            $option_before  = isset( $attr['option_before'] )  ? $attr['option_before'] : null;
            $option_after   = isset( $attr['option_after'] )   ? $attr['option_after']  : null;    
            $by_key         = isset( $attr['by_key'] )         ? $attr['by_key']        : null;    
            $label_class    = isset( $attr['label_class'] )    ? $attr['label_class']   : null;  
            
            $html = '';          
            if( $type == 'select' ){
                $html .= "<select $name $include>";
                if(isset($options)){                    
                    foreach($options as $key => $val){
                        if( !$by_key ) $key = $val;         
                        $key = is_string($key) ? trim($key) : $key;                                                                    
                        $selected = ($key == $value) ? "selected='selected'" : ""; 
                        $html .= "<option value='$key' $selected>$val</option>";
                    }                    
                }
                $html .= "</select>";
            }elseif($type == 'radio'){
                if(isset($options)){
                    foreach($options as $key => $val){
                        if( !$by_key ) $key = $val; 
                        $key = is_string($key) ? trim($key) : $key;
                        $checked = ($key == $value) ? "checked='checked'" : "";
                        $html .= "$option_before<input type='$type' $name $include value='$key' $checked /> $val $option_after";
                    }                    
                }   
            }elseif($type == 'checkbox'){ //print_r($options);
                $attr['combind'] = isset($attr['combind']) ? $attr['combind'] : false;
                if( $attr['combind'] ){
                    $name = rtrim( $name, "\"") . "[]\"";
                    if(isset($options)){
                        foreach($options as $key => $val){
                            if( !$by_key ) $key = $val; 
                            $key = is_string($key) ? trim($key) : $key;
                            if( is_array($value) )
                                $checked = in_array( $key, $value ) ? "checked='checked'" : "";
                            else
                                $checked = ($key == $value) ? "checked='checked'" : "";
                            $html .= "$option_before<input type='$type' {$name} $include value='$key' $checked /> $val $option_after";
                        }     
                    }          
                }else{             
                    $checked = $value ? "checked='checked'" : "";                
                    $html .= "<input type='$type' $name $include $checked />";
                }
            }elseif($type == 'textarea'){
                $html .= "<textarea $name $include>$value</textarea>";
            }elseif($type == 'file'){
                $html .= "<input type='$type' $name $include />";
                //$form_name = isset($config['form_name']) ? $config['form_name'] : '';                
            	/*?><script type="text/javascript">
            		var form = document.getElementById($form_name);
            		form.encoding = 'multipart/form-data';
            		form.setAttribute('enctype', 'multipart/form-data');
            	</script><?php  */        
            }elseif( $type == 'label' ){        
                $for   = isset($attr['for']) ? "for='{$attr['for']}'" : '';
                $html .= "<label $for $include>$value</label>";
            }else{
                $html .= "<input type='$type' $name $include />";
            }
            
            
            $before  = isset( $attr['before'] )  ? $attr['before'] : null;
            $after   = isset( $attr['after'] )   ? $attr['after']  : null;            
            $html = $before . $html . $after;
            
            //Add lebel if required
            $label_class =  $label_class ? $label_class : 'pf_label';            
            if( isset($attr['label']) ){
                $for   = isset($attr['id']) ? "for='{$attr['id']}'" : '';
                $html = "<label class='$label_class' $for>{$attr['label']}</label>" . $html;
            }
                                                             
            //Enclose by other html element
            if( isset($attr['enclose']) ){
                $enclose = $attr['enclose'];
                $encloseTag = explode( ' ', trim($enclose) );
                $encloseTag = $encloseTag[0];
                $html = "<$enclose>$html</$encloseTag>";
            }
                 
            
            return $html;              
            
        }        

        /**
         * Remove directory with all files
         */
        function deleteDirectory( $dir ) {
            if (!file_exists($dir)) return true;
            if (!is_dir($dir) || is_link($dir)) return unlink($dir);
                foreach (scandir($dir) as $item) {
                    if ($item == '.' || $item == '..') continue;
                    if (!deleteDirectory($dir . "/" . $item)) {
                        chmod($dir . "/" . $item, 0777);
                        if (!deleteDirectory($dir . "/" . $item)) return false;
                    };
                }
            return rmdir($dir);
        }  
        
        /**
         * Extract fileinfo like filename, extension, directry from file name
         * @param string $file: filename
         * @return object : ext, name, dir
         */
        function fileinfo( $file ){
            $return      = new stdClass;
            $fileData    = explode( '.', $file );
            $return->ext =  strpos( $file, '.' ) ? end($fileData) : null;
            
            $realPath     = rtrim( trim($file), '.' . $return->ext );
            $replacedPath = str_replace( "\\", "/", $realPath );
            
            if( strpos( $replacedPath, '/' ) ){
                $pathData = explode( "/", $replacedPath );
                $return->name = end($pathData);
                $return->dir  = rtrim( $realPath, end($pathData) );
                $return->dir  = rtrim( $return->dir, "/[\/\\]/" );
            }else{
                $return->name = $replacedPath;
                $return->dir  = null;
            }
            return $return;
        }       
        
        /**
         * go up one directory/url
         * @param string $path: url or path
         * @return string : path/url without last slash
         */
        function directoryUp( $path ){
            $path         = rtrim( trim($path), "/[\/\\]/" );   //Removing last slash
            $replacedPath = str_replace( "\\", "/", $path );        
            $pathData     = explode( '/', $replacedPath );  
            $lastPath     = end( $pathData );
            $return       = rtrim( $path, $lastPath );          //Removing last path
            $return       = rtrim( $return, "/[\/\\]/" );         //Removing last slash
            return $return;       
        }     
        
        /**
         * Remove empty value and array from array
         * @param array 
         * @param bool $keepEmptyArray true for keep and false for not keep. Default false.
         * @return array
         */
        function arrayRemoveEmptyValue( $array, $keepEmptyArray=false ){
            $result = array();
            foreach ( $array as $key=>$val ){
                if(is_array($val)){
                    $child = self::arrayRemoveEmptyValue($val);       
                    if($child)
                        $result[$key] = $child;
                    elseif($keepEmptyArray)
                        $result[$key] = $child;                  
                }else{
                    if($val)
                        $result[$key] = $val;             
                }
            }
            return $result;
        }   
        
        /**
         * get maximum key of an array
         */
        function maxKey( $arr ){
            if( !is_array( $arr ) ) return false;
            if( !$arr ) return false;
            
            $keys = array();
            foreach( $arr as $k => $v )
                $keys[] = $k;
            return max( $keys );
        }
        
        /**
         * Convert data to string
         * @param $data: data for convert
         * @param $separator : default:','
         * @return string
         */
        function toString( $data, $separator=',' ){
            $result = null;
            if( !$data ) return $result;
            if( is_array($data) )
                $result = implode( $separator, $data );
            else
                $result = $data;
            return (string) $result;
        }
        
        /**
         * Convert data to array
         * @param $data: data for convert
         * @param $separator : default:','
         * @return array
         */        
        function toArray( $data, $separator=',' ){
            $result = array();
            if( !$data ) return $result;            
            if( is_string($data) )
                $result = explode( $separator, $data );
            else
                $result = $data;
            return (array) $result;
        }
        
        function dump( $data, $dump=false ){
            echo "<pre>";
            if( is_array($data) OR is_object($data) ){
                if($dump)   var_dump($data);                   
                else        print_r($data);                    
            }                
            else    var_dump($data);                
            echo "</pre>";
        }
        
    }
endif;
?>