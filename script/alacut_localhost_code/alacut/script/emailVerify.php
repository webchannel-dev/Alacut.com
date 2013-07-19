<?php
include('../config/config1.php');

	if(isset($_REQUEST['email']) && !empty($_REQUEST['email']) AND isset($_REQUEST['hash']) && !empty($_REQUEST['hash']))
	{
		// Verify data
		$email = mysql_escape_string($_REQUEST['email']); // Set email variable
		$hash = mysql_escape_string($_REQUEST['hash']); // Set hash variable
		
		$search = mysql_query("SELECT email, hash, active FROM alacut_member WHERE email='".$email."' AND hash='".$hash."' AND active='0'") or die(mysql_error()); 
		$match  = mysql_num_rows($search);
		
		if($match > 0)
		{
			// We have a match, activate the account
			mysql_query("UPDATE alacut_member SET active='1' WHERE email='".$_REQUEST['email']."' AND hash='".$_REQUEST['hash']."' AND active='0'") or die(mysql_error());
			echo '<div class="statusmsg">Your account has been activated, Click here <a href="index.php">Login</div>';
		}else{
			// No match -> invalid url or account has already been activated.
			echo '<div class="statusmsg">The url is either invalid or you already have activated your account.</div>';
			}
		
	}else{
		// Invalid approach
		echo '<div class="statusmsg">Invalid approach, please use the link that has been send to your email.</div>';
		}
	
?>
