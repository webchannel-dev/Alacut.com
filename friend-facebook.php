<!DOCTYPE html>
<html>
	<head>
		<title>Developed by Roomi</title>
        <script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script>
        <script type="text/javascript">
         FB.init({
         appId  : '<?php echo $appID ?>',
         status : true, // check login status
         cookie : true, // enable cookies to allow the server to access the session
         xfbml  : true  // parse XFBML
       });
 
        function newInvite(){
                 var receiverUserIds = FB.ui({ 
                        method : 'apprequests',
                        message: 'Invite your Facebook friends to use this app.',
 
                 },
                 function(receiverUserIds) {
                          console.log("IDS : " + receiverUserIds.request_ids);
                        }
                 );
                 //http://developers.facebook.com/docs/reference/dialogs/requests/
            }
        </script>
	</head>
<body>
 
<?php
	include 'config/fbconfig.php';
    $fbconfig['appid' ] = $appID;
    $fbconfig['secret'] = $appSecret;
 
    $fbconfig['baseUrl'] = $base_url.'/invite.php'; // "http://roomi.orgfree.com/etb/";
    $fbconfig['appBaseUrl'] = "http://apps.facebook.com/alacutface/"; // "http://apps.facebook.com/et_blog/";
 
    /* 
     * If user first time authenticated the application facebook
     * redirects user to baseUrl, so I checked if any code passed
     * then redirect him to the application url 
     */
    if (isset($_GET['code'])){
        header("Location: " . $fbconfig['appBaseUrl']);
        exit;
    }
    //~~
 
    //
    if (isset($_GET['request_ids'])){
        //user comes from invitation
        //track them if you need
    }
 
    $user            =   null; //facebook user uid
    try{
        include_once "facebook/src/facebook.php";
    }
    catch(Exception $o){
        print_r($o);
    }
    // Create our Application instance.
    
    $facebook = new Facebook(array(
      'appId'  => $fbconfig['appid'],
      'secret' => $fbconfig['secret'],
      'cookie' => true,
    ));
 
    //Facebook Authentication part
    $user       = $facebook->getUser();
    // We may or may not have this data based 
    // on whether the user is logged in.
    // If we have a $user id here, it means we know 
    // the user is logged into
    // Facebook, but we don’t know if the access token is valid. An access
    // token is invalid if the user logged out of Facebook.
 
    $loginUrl   = $facebook->getLoginUrl(
            array(
                'scope'         => 'publish_stream'
            )
    );
 
    if ($user) {
      try {
        // Proceed knowing you have a logged in user who's authenticated.
        $user_profile = $facebook->api('/me');
		$access_token = $facebook->getAccessToken();
      } catch (FacebookApiException $e) {
        //you should use error_log($e); instead of printing the info on browser
        d($e);  // d is a debug function defined at the end of this file
        $user = null;
      }
    }
 
    if (!$user) {
        header('location: '.$loginUrl);
        exit;
    }
 
    echo '<button onclick="newInvite()">Invite your friends!</button>';
 
?>
</body>
</html>