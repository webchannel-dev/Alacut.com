<?php
include "config.php";
// Include the YOS library.
//require dirname(__FILE__).'/lib/Yahoo.inc';

// debug settings
error_reporting(E_ALL | E_NOTICE); # do not show notices as library is php4 compatable
ini_set('display_errors', true);
//YahooLogger::setDebug(true);
//YahooLogger::setDebugDestination('LOG');

// use memcache to store oauth credentials via php native sessions
ini_set('session.save_handler', 'files');
session_save_path('/tmp/');
session_start();

// Make sure you obtain application keys before continuing by visiting:
// https://developer.yahoo.com/dashboard/createKey.html



if(array_key_exists("logout", $_GET)) {
  // if a session exists and the logout flag is detected
  // clear the session tokens and reload the page.
  YahooSession::clearSession();
  header("Location: index.php");
}

// check for the existance of a session.
// this will determine if we need to show a pop-up and fetch the auth url,
// or fetch the user's social data.
$hasSession = YahooSession::hasSession(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET, OAUTH_APP_ID);

if($hasSession == FALSE) {
  // create the callback url,
  $callback = YahooUtil::current_url()."?in_popup";

  // pass the credentials to get an auth url.
  // this URL will be used for the pop-up.
  $auth_url = YahooSession::createAuthorizationUrl(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET, $callback);
}
else {
  // pass the credentials to initiate a session
  $session = YahooSession::requireSession(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET, OAUTH_APP_ID);

  // if the in_popup flag is detected,
  // the pop-up has loaded the callback_url and we can close this window.
  if(array_key_exists("in_popup", $_GET)) {
    close_popup();
    exit;
  }

  // if a session is initialized, fetch the user's profile information
  if($session) {
  if(@$_GET['error']!="")
  echo @$_GET['error']."<br/><br/>";
  echo "Select your Friends to Invite<br/>";
  echo "<form method='post' action='process.php' name='invite' id='invite-form'>";
    // Get the currently sessioned user.
    $user = $session->getSessionedUser();
	$contact=$user->getContacts(0,5000);
	$n1=$contact->contacts->total;
echo "<input type='hidden' name='total' value='".$n1."'>";
$contacts=$contact->contacts->contact;
$n2=1;
  foreach($contacts as $cont)   
 {  
 //$email=$cont->fields[0]->value;

 $num=count($cont->fields);
 for($i=0;$i<$num;$i++)
 {
 
 if($cont->fields[$i]->type=="email")
 {
 $email=$cont->fields[$i]->value;
  echo "<input type='checkbox' name='".$n2."' value='".$email."'>   ";
 $flag=0;
 for($i1=0;$i1<$num;$i1++)
 {
  if($cont->fields[$i1]->type=="name")
 {if($flag!=1)
 {

 $fname=$cont->fields[$i1]->value->givenName;
 $lname=$cont->fields[$i1]->value->familyName;
 echo $fname;
 if($fname!="")
 {echo " ";}
 echo $lname;
 if($fname==""&&$lname=="")
{echo $email;}
echo "    ";
}
 $flag=1;
 }
 }
 if($flag==0)
 {echo $email;echo "    ";}
 echo "&lt;".$email."&gt;";
 echo "<br/>";
 }
 }
 $n2++;
 }
 
echo "Subject:<br/> <input type='text' name='subject'value='".$subject."' size='50' ><br/><br/>";
 echo "Message:<br/> <textarea name='msg' cols='50' rows='15'>".$msg."</textarea>";
 echo "<br/><br/><input type='submit' name='submit' value='Invite'>";
 echo "</form>";
 // notice and follow visible link to www.terabug.com must stay below e-mail list to use the script 
	echo "Yahoo Invite All Application Coded by TeraBug. Visit <a href='http://www.terabug.com'>TeraBug.com</a>";
 //print_r($contact->contacts->contact[12]->fields[0]->value);
 
    // Load the profile for the current user.
    $profile = $user->getProfile();
	//print_r($profile);
  }
}

/**
 * Helper method to close the pop-up window via javascript.
 */
function close_popup() {
?>
<script type="text/javascript">
  window.close();
</script>
<?php
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
  <head>
    <title>Yahoo Invite Application</title>
<meta property="og:image" content="http://www.terabug.com/yahoo/ylogo.jpg"/><link rel="image_src" href="http://www.terabug.com/yahoo/ylogo.jpg" / >

    <!-- Combo-handled YUI JS files: -->
    <script type="text/javascript" src="http://yui.yahooapis.com/combo?2.7.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
    <script type="text/javascript" src="popupmanager.js"></script>

    <!-- Combo-handled YUI CSS files: -->
    <!-- <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/combo?2.7.0/build/reset-fonts-grids/reset-fonts-grids.css&2.7.0/build/base/base-min.css"> -->
  </head>
  <body>
    <?php
      if($hasSession == FALSE) {
        // if a session does not exist, output the
        // login / share button linked to the auth_url.
		echo "Click Yahoo mail icon to authorize and proceed to Invite<br/>";
        echo sprintf("<a href=\"%s\" id=\"yloginLink\"><img style=\"border:none\" src=\"ylogo.jpg\"></a>\n", $auth_url);
      }
      else if($hasSession && $profile) {
     

        echo "<p><a href=\"?logout\">Logout</a></p>";
      }
    ?>
    <script type="text/javascript">
      var Event = YAHOO.util.Event;
      var _gel = function(el) {return document.getElementById(el)};

      function handleDOMReady() {
        if(_gel("yloginLink")) {
          Event.addListener("yloginLink", "click", handleLoginClick);
        }
      }

      function handleLoginClick(event) {
        // block the url from opening like normal
        Event.preventDefault(event);

        // open pop-up using the auth_url
        var auth_url = _gel("yloginLink").href;
        PopupManager.open(auth_url,600,435);
      }

      Event.onDOMReady(handleDOMReady);
    </script>
	<!-- notice and follow visible link to www.terabug.com must stay below e-mail list to use the script -->
	Yahoo Invite All Application Coded by TeraBug. Visit <a href='http://www.terabug.com'>TeraBug.com</a>
	</body>
</html>