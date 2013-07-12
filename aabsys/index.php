<?php
//Always place this code at the top of the Page
session_start();
if (isset($_SESSION['id'])) {
    // Redirection to login page twitter or facebook
    header("location: home.php");
}

if (array_key_exists("login", $_GET)) {
    $oauth_provider = $_GET['oauth_provider'];
    if ($oauth_provider == 'twitter') {
        header("Location: login-twitter.php");
    } else if ($oauth_provider == 'facebook') {
        header("Location: login-facebook.php");
    } else if ($oauth_provider == 'linkedin') {
        header("Location: linkedin-login.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<title>alacut</title>
<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if lte IE 6]>
<link rel="stylesheet" href="http://universal-ie6-css.googlecode.com/files/ie6.1.1.css" media="screen, projection">
<![endif]-->
<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->
<title>alacut</title>
<link href="../favicon.ico" rel="shortcut icon" type="image/x-icon" />
<style type="text/css">
    #buttons
	{
	text-align:center
	}
    #buttons img,
    #buttons a img
    { border: none;}
	h1
	{
	font-family:Arial, Helvetica, sans-serif;
	color:#999999;
	}
	
</style>
<body>
<div id="buttons">
<h1>Sign in With Twitter Facebook Linkedin</h1><br/><br/>
    <a href="?login&oauth_provider=twitter"><img src="images/twitter.gif"></a>&nbsp;&nbsp;&nbsp;
    <a href="?login&oauth_provider=facebook"><img src="images/facebook.gif"></a>&nbsp;&nbsp;&nbsp;
	<a href="?login&oauth_provider=linkedin"><img src="images/in.gif"></a> 
</div>
</body>
</html>
