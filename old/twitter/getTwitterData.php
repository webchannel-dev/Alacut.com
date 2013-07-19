<?php
session_start();

include "../config/config1.php";
require("twitter/twitteroauth.php");

require 'config/twconfig.php';

if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {
    // We've got everything we need
    $twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
// Let's request the access token
    $access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
// Save it in a session var
    $_SESSION['access_token'] = $access_token;
// Let's get the user's info
    $user_info = $twitteroauth->get('account/verify_credentials');
// Print user's info
    //echo '<pre>';
    //print_r($user_info);exit();
	
    //echo '</pre><br/>';
    if (isset($user_info->error)) {
        // Something's wrong, go back to square 1  
        header('Location: login-twitter.php');
    } else {
        
        $uid = $user_info->id;
        $username = $user_info->name; 
		$usernamePhoto = $user_info->profile_image_url;
        $_SESSION['username'] = $username;
        if($usernamePhoto)
			$_SESSION['usernamePhoto']=StoreTwitterImage($usernamePhoto);
        $_SESSION['shwsgnup']=1;
        header("Location: ".SITE_URL);
		exit();
        
    }
} else {
    // Something's missing, go back to square 1
    header('Location: login-twitter.php');
}
function StoreTwitterImage($uri)
{
    $uri=str_replace("_normal","",$uri);

    $ch = curl_init();
    //$output_filename='/upload/profilePhotos/'.com_create_guid()."_profile.jpeg";
    $output_filename=uniqid()."_profile.jpeg";
    curl_setopt($ch, CURLOPT_URL, $uri);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_AUTOREFERER, false);
    curl_setopt($ch, CURLOPT_REFERER, "http://a0.twimg.com");
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $result = curl_exec($ch);
    curl_close($ch);

    // the following lines write the contents to a file in the same directory (provided permissions etc)
    $fp = fopen($_SERVER["DOCUMENT_ROOT"].'/upload/profilePhotos/'.$output_filename, 'w');
   // $fp = fopen('C:/wamp/www/alacut/upload/profilePhotos/'.$output_filename, 'w');
    fwrite($fp, $result);
    fclose($fp);
    return $output_filename;
}
?>
