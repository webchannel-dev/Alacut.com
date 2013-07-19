<h3 style="width:auto; text-align:center;">Selected Contacts</h3>
(email was sent)<br/><br/>
<div style="font-size:0.8em; text-align:left; color:gray;">
<?php
session_start();
include('../../../config/config1.php');
$member_ID = $_SESSION['login_user_id'];

$nameQry = "SELECT `member_id`,`full_name` FROM `alacut_member` WHERE `member_id` = '".$member_ID."'";
$nameRes = mysql_query($nameQry);
$nameInfo = mysql_fetch_array($nameRes);

foreach ($post["contacts"] as $contact_email => $contact_name)
{
	//! do something here: store or send out emails (use PHPMailer or other mailing library)
	//echo "{$contact_name} ({$contact_email})<br />";
	$toName = $contact_name;
	$fromName = $nameInfo['full_name'];
	
	  $to = $contact_email; //Send email to our user
			$subject = 'Friend Invitation for alacut social networking' ; 
			$message = '

			Hi '.$toName.',
				
				'.$fromName.' added you as a friend in alacut. We need your confirmation to be friend in alacut. 
		
			Please click this link to visit alcut social networking:
			http://www.alacut.com/test/script/index.php
			
			Thanks,
			The alacut team'; 
			
			$headers = 'From:admin@alacut.com' . "\r\n"; // Set from headers
			mail($to, $subject, $message, $headers); // Send the email
}
?>
</div>