<?php
//include('session_header.php');
session_start();
include('../config/config1.php');
$member_ID = $_SESSION['login_user_id'];
 
if($member_ID!="" && $member_ID!=0)
{		
	$content = str_replace(array("'")," ",$_POST['content']);
	$insertReplyMailQry = "INSERT INTO `message`(`message_from_id`,`message_to_id`,`message_content`) VALUES('".$_POST['fromMsgID']."','".$_POST['toMsgID']."','".$content."')";
	mysql_query($insertReplyMailQry);
	
	$messagefrmID = $_POST['fromMsgID'];
	$parentID = ($_POST['pID'] == 0)?$_POST['msgID']:$_POST['pID'];
	
	$mailingQry = "SELECT m.message_id,m.message_from_id,m.message_content,m.message_to_id,fm.full_name AS fmName,tm.full_name AS tmName,fm.profile_photo_name AS fmPhoto,tm.profile_photo_name AS tmPhoto FROM `message` m
INNER JOIN `alacut_member` fm ON fm.member_id = m.`message_from_id`
INNER JOIN `alacut_member` tm ON m.message_to_id = tm.member_id WHERE m.`message_from_id`='".$_POST['fromMsgID']."' AND m.status!=2 AND m.`message_to_id`='".$_POST['toMsgID']."' ORDER BY m.`message_id` DESC LIMIT 1";
	$mailingRes = mysql_query($mailingQry);
	
	/*$mailingNum = mysql_num_rows($mailingRes);
	
	$mailToINFO = mysql_fetch_row($mailingRes);
	$fromID = $user_check;
	if($mailToINFO[1] == $fromID){
		$toID = $mailToINFO[3];
	}else{
		$toID = $mailToINFO[1];
	}*/
	
?>
<?php while($mailingInfo = mysql_fetch_array($mailingRes)) {?>
<article class="chat">
<div class="user_img">
	<?php if($mailingInfo['fmPhoto'] != ''){
		 echo '<img src="upload/profilePhotos/'.$mailingInfo['fmPhoto'].'" alt="" width="40" height="40"/>';
	}else{
		echo '<img src="images/no-image.jpg" alt="" width="40" height="40"/>';
}?>
 </div>
<strong><?php echo $mailingInfo['fmName'];?></strong>
<details class="chat_text"><?php echo $mailingInfo['message_content'];?></details>
</article>
<?php 
$fromid=$mailingInfo['message_from_id'];
}
} ?>
