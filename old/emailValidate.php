<?php 
session_start();
echo "Mail";
	if(isset($_REQUEST['signupname']) && !empty($_REQUEST['signupname']) AND isset($_REQUEST['email']) && !empty($_REQUEST['email']) AND isset($_REQUEST['pwd']) && !empty($_REQUEST['pwd'])) 
	{ echo "4";
		$name = mysql_real_escape_string($_POST['signUname']); 
		$email = mysql_real_escape_string($_POST['signEmail']);
		$pwd = mysql_real_escape_string($_POST['signPwd']);
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
            else 
            {
                $fname = rtrim(ltrim($_SESSION['userfname']));
                $lname = rtrim(ltrim($_SESSION['userlname']));
                
            }
            $image=$_SESSION['usernamePhoto'];
            $_SESSION['shwsgnup'] = 0;
        }
			// Return Success - Valid Email
			$msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
			$hash = md5( rand(0,1000) ); // Generate random 32 character hash and assign it to a local variable.
			//$password = rand(1000,5000); // Generate random number between 1000 and 5000 and assign it to a local variable.
			echo $qry = "INSERT INTO alacut_member (first_name,last_name,full_name,login_user_name, password, email, hash ,profile_photo_name) VALUES(
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
			http://www.alacut.com/test/script/emailVerify.php?email='.$email.'&hash='.$hash.'

			'; // Our message above including the link
			
			// To send HTML mail, the Content-type header must be set
			//$headers  = 'MIME-Version: 1.0' . "\r\n";
			//$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			// Additional headers
			//$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
			//$headers .= 'From: Birthday Reminder <birthday@example.com>' . "\r\n";
			//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
			//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
			$headers = 'From:admin@alacut.com' . "\r\n"; // Set from headers
			mail($to, $subject, $message, $headers); // Send the email

		//}
	}
?>

<?php
	echo "3";
	if($showPunchSuccess){
    unset($_SESSION['showPunchSuccess']);
?>
<link type="text/css" rel="stylesheet" href="css/colorbox.css" />
<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
<script type="text/javascript">
var $a=jQuery.noConflict();
  $a(function() {
    $a.colorbox({scrolling:false, overlayClose: false, escKey: false, opacity: 0.8, inline:true, href:"#attendancePunchSuccess"});
});
</script>
<div style='display:none'>
	<div style="background: #FFFFFF; padding: 20px;" id="attendancePunchSuccess">
		<div>&nbsp;</div>
		<div style="color: #4A4949;">
		<strong>Successfully Punched in Attendance.</strong>
		</div>
		<div>&nbsp;</div>
	</div>
</div>
<?php }?>