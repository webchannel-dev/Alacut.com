<?php
session_start();
	
	$config['base_url']             =   'http://www.alacut.com/aabsys/linkedin-login.php';
    $config['callback_url']         =   'http://www.alacut.com/aabsys/linkedin-data.php';
    $config['linkedin_access']      =   'sncjjb8mqhxf';
    $config['linkedin_secret']      =   'UTlQBihITGwLrm0N';
    include_once "linkedin/linkedin.php";
   
    
    # First step is to initialize with your consumer key and secret. We'll use an out-of-band oauth_callback
    $linkedin = new LinkedIn($config['linkedin_access'], $config['linkedin_secret'], $config['callback_url'] );
    //$linkedin->debug = true;

   if (isset($_REQUEST['oauth_verifier'])){
        $_SESSION['oauth_verifier']     = $_REQUEST['oauth_verifier'];

        $linkedin->request_token    =   unserialize($_SESSION['requestToken']);
        $linkedin->oauth_verifier   =   $_SESSION['oauth_verifier'];
        $linkedin->getAccessToken($_REQUEST['oauth_verifier']);

        $_SESSION['oauth_access_token'] = serialize($linkedin->access_token);
        header("Location: " . $config['callback_url']);
        exit;
   }
   else{
        $linkedin->request_token    =   unserialize($_SESSION['requestToken']);
        $linkedin->oauth_verifier   =   $_SESSION['oauth_verifier'];
        $linkedin->access_token     =   unserialize($_SESSION['oauth_access_token']);
   }


    # You now have a $linkedin->access_token and can make calls on behalf of the current member
    $xmlLinkedIN = simplexml_load_string($linkedin->getProfile("~:(id,first-name,last-name,headline,picture-url,email-address,picture-urls::(original))"));
    if($xmlLinkedIN->id != '0' && $xmlLinkedIN->id!='' )
    {
        $firstname =  'first-name';
        $lastname =  'last-name';
        $pics = "picture-urls";
        $pic = "picture-url";
		$email="email-address";
        echo $_SESSION['username']= ltrim(rtrim($xmlLinkedIN->$firstname)).' '.ltrim(rtrim($xmlLinkedIN->$lastname));
		if($xmlLinkedIN->$pics->$pic)
		echo $xmlLinkedIN->$pics->$pic;
		echo $xmlLinkedIN->$email;
		exit();
        $_SESSION['usernamePhoto']=StoreImageLinkedin($xmlLinkedIN->$pics->$pic);
        $_SESSION['shwsgnup']=1;
                
    }
    function StoreImageLinkedin($uri)
    {
        
        $ch = curl_init();
	    
	    $output_filename=uniqid()."_profile.jpeg";
        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, false);
        curl_setopt($ch, CURLOPT_REFERER, "http://m3.licdn.com");
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $result = curl_exec($ch);
        curl_close($ch);

        // the following lines write the contents to a file in the same directory (provided permissions etc)
        //$fp = fopen($_SERVER["DOCUMENT_ROOT"].$output_filename, 'w');
	    $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/upload/profilePhotos/'.$output_filename, 'w');
        fwrite($fp, $result);
        fclose($fp);
	    return $output_filename;
    }
?>

