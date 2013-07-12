<?php
session_start();
require '../config/config1.php';

if(isset($_REQUEST['email']))
{
	$val = mysql_query("SELECT count(member_id) AS countuser FROM alacut_member WHERE email ='".$_REQUEST['email']."'");
	$val = mysql_fetch_array($val);
	if($val["countuser"]>0)
		echo "0";
	else 
	{
		
		/*$_SESSION['sendEmail']=1;
		header("location: ../script/emailValidate.php?email='".$_REQUEST['email']."'&pwd='".$_REQUEST['pwd']."'&uname='".$_REQUEST['signupname']."'");
		header("location: index.php?id=$_POST[ac_id]&err=$login");
		include('../script/emailValidate.php');*/
		
		if(isset($_POST['signupname']) && !empty($_POST['signupname']) AND isset($_POST['email']) && !empty($_POST['email']) AND isset($_POST['pwd']) && !empty($_POST['pwd'])) 
		{ 
			$name = mysql_real_escape_string($_POST['signupname']); 
			$email = mysql_real_escape_string($_POST['email']);
			$pwd = mysql_real_escape_string($_POST['pwd']);
			$fname="";$lname="";$image="";
		
		if($_SESSION['shwsgnup'] == 1)
		{
			if(isset($_SESSION['username']) && $_SESSION['username']!="")
			{
				$fname = $_SESSION['username'];
				$fname =ltrim(rtrim($fname));
				if(strripos($fname,' ')>1)
				{
					$lname=  rtrim(ltrim(substr($fname,strripos($fname,' ')+1,strlen($fname))));
					$fname= rtrim(ltrim(substr($fname,0,strripos($fname,' '))));
				}
				$_SESSION['username']="";
			}
			
			$image=str_replace('/upload/profilePhotos/','', $_SESSION['usernamePhoto']);
			$_SESSION['shwsgnup'] = 0;
		}
			// Return Success - Valid Email
			$msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
			$hash = md5( rand(0,1000) ); // Generate random 32 character hash and assign it to a local variable.
			//$password = rand(1000,5000); // Generate random number between 1000 and 5000 and assign it to a local variable.
			$qry = "INSERT INTO alacut_member (first_name,last_name,full_name,login_user_name, password, email, hash ,profile_photo_name) VALUES(
						'".$fname."',
						'".$lname."',
						'".$fname.' '.$lname."',
						'".$name."', 
						'".$pwd."', 
						'".$email."',
						'".$hash."', 
						'".$image."')";
			mysql_query($qry);  
			
			$to      = $email; //Send email to our user
			$subject = 'Signup | Verification for alacut social networking' ; //// Give the email a subject 
			$message = '
		
			Thanks for signing up in alacut!
			Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
		
			------------------------
			Username: '.$name.'
			Email ID:  '.$email.'
			Password: '.$pwd.'
			------------------------
			Please click this link to activate your account:
			http://www.alacut.com/emailVerify.php?email='.$email.'&hash='.$hash.'
		
			'; 
			$headers = 'From:admin@alacut.com' . "\r\n"; // Set from headers
			mail($to, $subject, $message, $headers); // Send the email
		
		//}
		}
	}
}
?>