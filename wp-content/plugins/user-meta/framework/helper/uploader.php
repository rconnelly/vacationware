<?php
$dirInfo = pathinfo( __FILE__ );
$dirName = $dirInfo['dirname'];

// Determine wp-load path and include
$found = false;$i=0;
while( !$found || $i<10 ){
    $i++;
    $dirName .= '/..';
    if( file_exists( $dirName . '/wp-load.php' ) ){
        $found = true;
        define('WP_USE_THEMES', false);
        require_once( $dirName . '/wp-load.php' );
    }    
}

global $userMeta;


/**
 * Handle file uploads via XMLHttpRequest
 */
class qqUploadedFileXhr {
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path) {    
        $input = fopen("php://input", "r");
        $temp = tmpfile();
        $realSize = stream_copy_to_stream($input, $temp);
        fclose($input);
        
        if ($realSize != $this->getSize()){            
            return false;
        }
        
        $target = fopen($path, "w");        
        fseek($temp, 0, SEEK_SET);
        stream_copy_to_stream($temp, $target);
        fclose($target);
        
        return true;
    }
    function getName() {
        return $_GET['qqfile'];
    }
    function getSize() {
        if (isset($_SERVER["CONTENT_LENGTH"])){
            return (int)$_SERVER["CONTENT_LENGTH"];            
        } else {
            throw new Exception('Getting content length is not supported.');
        }      
    }   
}

/**
 * Handle file uploads via regular form post (uses the $_FILES array)
 */
class qqUploadedFileForm {  
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path) {
        if(!move_uploaded_file($_FILES['qqfile']['tmp_name'], $path)){
            return false;
        }
        return true;
    }
    function getName() {
        return $_FILES['qqfile']['name'];
    }
    function getSize() {
        return $_FILES['qqfile']['size'];
    }
}

class qqFileUploader {
    private $allowedExtensions = array();
    private $sizeLimit = 10485760;
    private $file;

    function __construct(array $allowedExtensions = array(), $sizeLimit = 10485760){        
        $allowedExtensions = array_map("strtolower", $allowedExtensions);
            
        $this->allowedExtensions = $allowedExtensions;        
        $this->sizeLimit = $sizeLimit;
        
        $this->checkServerSettings();       

        if (isset($_GET['qqfile'])) {
            $this->file = new qqUploadedFileXhr();
        } elseif (isset($_FILES['qqfile'])) {
            $this->file = new qqUploadedFileForm();
        } else {
            $this->file = false; 
        }
    }
    
    private function checkServerSettings(){        
        $postSize = $this->toBytes(ini_get('post_max_size'));
        $uploadSize = $this->toBytes(ini_get('upload_max_filesize'));        
        
        if ($postSize < $this->sizeLimit || $uploadSize < $this->sizeLimit){
            $size = max(1, $this->sizeLimit / 1024 / 1024) . 'M';             
            //die("{'error':'increase post_max_size and upload_max_filesize to $size'}");    
        }        
    }
    
    private function toBytes($str){
        $val = trim($str);
        $last = strtolower($str[strlen($str)-1]);
        switch($last) {
            case 'g': $val *= 1024;
            case 'm': $val *= 1024;
            case 'k': $val *= 1024;        
        }
        return $val;
    }
    
    /**
     * Returns array('success'=>true) or array('error'=>'error message')
     */
    function handleUpload($replaceOldFile = FALSE){
        $uploads        = wp_upload_dir();
        $uploadPath     = $uploads['path'] . '/';
        $uploadUrl      = $uploads['url']  . '/';
        
        if (!is_writable($uploadPath)){
            return array('error' => "Server error. Upload directory isn't writable.");
        }
        
        if (!$this->file){
            return array('error' => 'No files were uploaded.');
        }
        
        $size = $this->file->getSize();
        
        if ($size == 0) {
            return array('error' => 'File is empty');
        }
        
        if ($size > $this->sizeLimit) {
            return array('error' => 'File is too large');
        }
        
        $pathinfo = pathinfo($this->file->getName());
        $filename = time();
        //$filename = $pathinfo['filename'];
        //$filename = str_replace( " ", "-", $filename );
        //$filename = md5(uniqid());
        $ext = $pathinfo['extension'];

        if($this->allowedExtensions && !in_array(strtolower($ext), $this->allowedExtensions)){
            $these = implode(', ', $this->allowedExtensions);
            return array('error' => 'File has an invalid extension, it should be one of '. $these . '.');
        }
        
        if(!$replaceOldFile){
            /// don't overwrite previous files that were uploaded
            while (file_exists($uploadPath . $filename . '.' . $ext)) {
                $filename .= rand(10, 99);
            }
        }
        
        $fieldname = isset( $_REQUEST['fieldname'] ) ? $_REQUEST['fieldname'] : null;
        
        $filepath = $uploads['subdir'] . "/$filename.$ext";
        
        if ($this->file->save($uploadPath . $filename . '.' . $ext)){
            return array('success'=>true, 'fieldname'=>$fieldname, 'filepath'=>$filepath);
        } else {
            return array('error'=> 'Could not save uploaded file.' .
                'The upload was cancelled, or server error encountered');
        }
        
    }    
}


// list of valid extensions, ex. array("jpeg", "xml", "bmp")
$allowedExtensions = array( 'jpg','jpeg','png','gif' );
// max file size in bytes
$sizeLimit = 1 * 1024 * 1024;


// Change File limit and extension based on field setting
if( isset( $_REQUEST['fieldid'] ) ){
    if( strpos( $_REQUEST['fieldid'], 'um_field_' ) !== false ){
       $fieldID = str_replace( "um_field_", "", $_REQUEST['fieldid'] );
       $fields = get_option( $userMeta->options['fields'] );
       if( isset( $fields[$fieldID]['allowed_extension'] ) )
            $allowedExtensions = explode( ",", $fields[$fieldID]['allowed_extension'] );
       if( isset( $fields[$fieldID]['max_file_size'] ) )
            $sizeLimit = $fields[$fieldID]['max_file_size'] * 1024;       
    }
}



$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
$result = $uploader->handleUpload();
// to pass data through iframe you will need to encode all html tags
echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
?>