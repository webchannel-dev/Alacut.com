<?php
    ini_set('allow_url_fopen',1);
    ini_set('allow_url_include',1);
session_save_path('/home/users/web/b42/nf.mavajsunco/public_html/MavajSunCo/customer/AlaCut/session');
ini_set('session.gc_probability', 1);
ob_start();
session_start();
/**
 * Copyright 2011 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

require 'src/facebook.php';
//require "../StoreImage.php";
// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '532187950135694',
  'secret' => '5c2e500e4af264be8e7568627ec9c50e',
));

// Get User ID
$user = $facebook->getUser();
$token = $facebook->getAccessToken();
// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    /*$user_profile = $facebook->api('/me');
//$fbimg=new StoreImage();
        $uid=$user_profile['id'];
        $_SESSION['username'] = $userdata['username'];
        $usernamePhoto="http://graph.facebook.com/".$uid.'/picture/?type=large';
        if($usernamePhoto)
				$_SESSION['usernamePhoto']=StoreFBImage($usernamePhoto);
        $_SESSION['shwsgnup']=1;
        //header("Location: ../index.php");*/
		$fql = "SELECT uid, first_name, last_name,middle_name, email,pic_big FROM user WHERE uid =".$user;
		$user_profile = $facebook->api(array(
		  'method' => 'fql.query',
		  'query'  => $fql,
		  'access_token' => $token,
		  // don't use an access token
		));	
		print_r($user_profile);exit();
		$userdata=$user_profile[0];	
        $uid=$userdata['uid'];
        $_SESSION['username'] = $userdata['first_name'].' '.$userdata['middle_name'].' '.$userdata['last_name'];
        $usernamePhoto=$userdata['pic_big'];
        if($usernamePhoto)
				$_SESSION['usernamePhoto']=StoreFBImage($usernamePhoto);
        $_SESSION['shwsgnup']=1;
        //header("Location: index.php");
    } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl();
}
function StoreFbImage($uri)
{       
		//$output_filename='/upload/profilePhotos/'.com_create_guid()."_profile.jpeg";
			$ch = curl_init();
	        //$output_filename='/upload/profilePhotos/'.com_create_guid()."_profile.jpeg";
	    $output_filename=uniqid()."_profile.jpeg";
        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, false);
        curl_setopt($ch, CURLOPT_REFERER, "http://profile.ak.fbcdn.net");
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $result = curl_exec($ch);
        curl_close($ch);

        // the following lines write the contents to a file in the same directory (provided permissions etc)
        //$fp = fopen($_SERVER["DOCUMENT_ROOT"].$output_filename, 'w');
	    $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/test/upload/profilePhotos/'.$output_filename, 'w');
        fwrite($fp, $result);
        fclose($fp);
	    return $output_filename;
}
?>
<html>
<head>

</head>
<body>
<a href="<?php echo $loginUrl;?>">Invite FB</a>
</body>
</html>
