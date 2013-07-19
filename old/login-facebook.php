<?php
session_start();
require 'facebook/facebook.php';
require 'config/fbconfig.php';
include 'config/config1.php';
$facebook = new Facebook(array(
            'appId' => APP_ID,
            'secret' => APP_SECRET,
            ));

$user = $facebook->getUser();

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }

if (!empty($user_profile )) {
        # User info ok? Let's print it (Here we will be adding the login and registering routines)
  
        $username = $user_profile['name'];
			 $uid = $user_profile['id'];
		 $email = $user_profile['email'];
		 $_SESSION['username'] = $username;
		$_SESSION['email']=$email;
		$aResponse = $facebook->api('/me', array(
		    'fields' => 'picture',
		    'type' => 'large'
		));
		if(strpos($aResponse["picture"]['data']["url"], 'https://fbcdn-profile-a.akamaihd.net/static-ak/rsrc.php/')===false)
			$usernamePhoto=str_replace('_q.', '_n.', $aResponse["picture"]['data']["url"]);
		else {
			$usernamePhoto='';
		}
		
		if(!empty($usernamePhoto))
				$_SESSION['usernamePhoto']=StoreFBImage($usernamePhoto);
        $_SESSION['shwsgnup']=1;
		header("Location: ".SITE_URL);
		exit();
		   } else {
        # For testing purposes, if there was an error, let's kill the script
        die("There was an error.");
    }
} else {
    # There's no active session, let's generate one
	$login_url = $facebook->getLoginUrl(array( 'scope' => 'email'));
    header("Location: " . $login_url);
}
function StoreFBImage($uri)
{
	
	$ch = curl_init();
	$fnm=uniqid()."_profile.jpeg";
    $output_filename='/upload/profilePhotos/'.$fnm;
    
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
    $fp = fopen($_SERVER["DOCUMENT_ROOT"].$output_filename, 'w');
    
    fwrite($fp, $result);
    fclose($fp);
	
    return $fnm;
}
?>
