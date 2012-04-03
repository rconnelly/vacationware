  <?php
// AdMob Publisher Code
// Language: PHP (fsockopen)
// Version: 20081105
// Copyright AdMob, Inc., All rights reserved
// Documentation at http://developer.admob.com/wiki/Main_Page

global $wptouch_pro;
$settings = $wptouch_pro->get_settings();

$admob_params = array(
  'PUBLISHER_ID'      => $settings->admob_publisher_id, // Required to request ads. To find your Publisher ID, log in to your AdMob account and click on the "Sites & Apps" tab.
  'AD_REQUEST'        => true, // To request an ad, set to TRUE.
  'ANALYTICS_REQUEST' => false, // To enable the collection of analytics data, set to TRUE.
  'TEST_MODE'         => false, // While testing, set to TRUE. When you are ready to make live requests, set to FALSE.
  // Additional optional parameters are available at: http://developer.admob.com/wiki/AdCodeDocumentation
  'OPTIONAL'          => array()
);

if ( $wptouch_pro->is_in_developer_mode() ) {
	$admob_params['TEST_MODE'] = true;	
}
 
// Send request to AdMob. To make additional ad requests per page, copy and paste this function call elsewhere on your page.
echo admob_request($admob_params);

/////////////////////////////////
// Do not edit below this line //
/////////////////////////////////

// This section defines AdMob functions and should be used AS IS.
// We recommend placing the following code in a separate file that is included where needed.

function admob_request($admob_params) {
  static $pixel_sent = false;

  $ad_mode = false;
  if (!empty($admob_params['AD_REQUEST']) && !empty($admob_params['PUBLISHER_ID'])) $ad_mode = true;
  
  $analytics_mode = false;
  if (!empty($admob_params['ANALYTICS_REQUEST']) && !empty($admob_params['ANALYTICS_ID']) && !$pixel_sent) $analytics_mode = true;
  
  $protocol = 'http';
  if (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off') $protocol = 'https';
  
  $rt = $ad_mode ? ($analytics_mode ? 2 : 0) : ($analytics_mode ? 1 : -1);
  if ($rt == -1) return '';
  
  list($usec, $sec) = explode(' ', microtime()); 
  $params = array('rt=' . $rt,
                  'z=' . ($sec + $usec),
                  'u=' . urlencode($_SERVER['HTTP_USER_AGENT']), 
                  'i=' . urlencode($_SERVER['REMOTE_ADDR']), 
                  'p=' . urlencode("$protocol://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']),
                  'v=' . urlencode('20081105-PHPFSOCK-33fdd8e59a40dd9a')); 

  $sid = empty($admob_params['SID']) ? session_id() : $admob_params['SID'];
  if (!empty($sid)) $params[] = 't=' . md5($sid);
  if ($ad_mode) $params[] = 's=' . $admob_params['PUBLISHER_ID'];
  if ($analytics_mode) $params[] = 'a=' . $admob_params['ANALYTICS_ID'];
  if (!empty($_COOKIE['admobuu'])) $params[] = 'o=' . $_COOKIE['admobuu'];
  if (!empty($admob_params['TEST_MODE'])) $params[] = 'm=test';

  if (!empty($admob_params['OPTIONAL'])) {
    foreach ($admob_params['OPTIONAL'] as $k => $v) {
      $params[] = urlencode($k) . '=' . urlencode($v);
    }
  }

  $ignore = array('HTTP_PRAGMA' => true, 'HTTP_CACHE_CONTROL' => true, 'HTTP_CONNECTION' => true, 'HTTP_USER_AGENT' => true, 'HTTP_COOKIE' => true);
  foreach ($_SERVER as $k => $v) {
    if (substr($k, 0, 4) == 'HTTP' && empty($ignore[$k]) && isset($v)) {
      $params[] = urlencode('h[' . $k . ']') . '=' . urlencode($v);
    }
  }

  $post = implode('&', $params);
  $request_timeout = 1; // 1 second timeout
  $contents = '';
  $errno = 0;
  $errstr = '';
  list($usec_start, $sec_start) = explode(' ', microtime());
  $request = @fsockopen('r.admob.com', 80, $errno, $errstr, $request_timeout);
  if($request) {
    stream_set_timeout($request, $request_timeout);
    $post_body = "POST /ad_source.php HTTP/1.0\r\nHost: r.admob.com\r\nContent-Type: application/x-www-form-urlencoded\r\nContent-Length: " . strlen($post) . "\r\n\r\n" . $post;
    $post_body_len = strlen($post_body);
    $bytes_written = 0;
    $body = false;

    $info = stream_get_meta_data($request);
    $timeout = $info['timed_out'];
    while($bytes_written < $post_body_len && !$timeout) { 
      $current_bytes_written = fwrite($request, $post_body); 
      if($current_bytes_written === false) return ''; // write failed 
      $bytes_written += $current_bytes_written; 
      if($bytes_written === $post_body_len) break;
      $post_body = substr($post_body, $bytes_written); 
      $info = stream_get_meta_data($request);
      $timeout = $info['timed_out'];
    }

    while(!feof($request) && !$timeout) {
      $line = fgets($request);
      if(!$body && $line == "\r\n") $body = true;
      if($body && !empty($line)) $contents .= $line;
      $info = stream_get_meta_data($request);
      $timeout = $info['timed_out'];
    }
    fclose($request);
  }
  else {
    $contents = '';
  }
  
  if (!$pixel_sent) {
    $pixel_sent = true;
    list($usec_end, $sec_end) = explode(' ', microtime());
    $contents .= "<img src=\"$protocol://p.admob.com/e0?"
              . 'rt=' . $rt
              . '&amp;z=' . ($sec + $usec)
              . '&amp;a=' . ($analytics_mode ? $admob_params['ANALYTICS_ID'] : '')
              . '&amp;s=' . ($ad_mode ? $admob_params['PUBLISHER_ID'] : '')
              . '&amp;o=' . (empty($_COOKIE['admobuu']) ? '' : $_COOKIE['admobuu'])
              . '&amp;lt=' . ($sec_end + $usec_end - $sec_start - $usec_start)
              . '&amp;to=' . $request_timeout
              . '" alt="" width="1" height="1"/>';
  }
  
  return $contents;
}

function admob_setcookie($domain = '', $path = '/') {
  if (empty($_COOKIE['admobuu'])) {    
    $value = md5(uniqid(rand(), true));
    if (!empty($domain) && $domain[0] != '.') $domain = ".$domain";
    if (setcookie('admobuu', $value, mktime(0, 0, 0, 1, 1, 2038), $path, $domain)) {
      $_COOKIE['admobuu'] = $value; // make it visible to admob_request()
    } 
  }
}
  
