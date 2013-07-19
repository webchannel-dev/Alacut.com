<?php
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
  'appId'  => '199269936876427',
  'secret' => '011d3f54b473009041fe09d3ced6b200',
));

// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
//$fbimg=new StoreImage();
        $uid=$user_profile['id'];
        $_SESSION['username'] = $userdata['username'];
        $usernamePhoto="http://graph.facebook.com/".$uid.'/picture/?type=large';
        if($usernamePhoto)
				$_SESSION['usernamePhoto']=StoreFBImage($usernamePhoto);
        $_SESSION['shwsgnup']=1;
        //header("Location: ../index.php");
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
	$output_filename=uniqid()."_profile.jpeg";
    $img = file_get_contents($uri);
    //$file = 'C:/wamp/www/alacut/upload/profilePhotos/'.$output_filename;
    $file = $_SERVER['DOCUMENT_ROOT'].'/alacut/upload/profilePhotos/'.$output_filename;
    file_put_contents($file, $img);
	return $output_filename;
}
?>
