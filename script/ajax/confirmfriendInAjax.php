<?php
include('../../config/config1.php');
session_start();
if($_SESSION['login_user_id']!="" || $_SESSION['login_user_id']!=0)
{
if($_POST['rtype']=="a")
{	
$updateFriendStatusQry = "UPDATE `friend` SET `status` = 'C' WHERE frnd_req_from_id = '".$_POST['fromID']."' AND frnd_req_to_id='".$_POST['toID']."' AND `status`='P'";
mysql_query($updateFriendStatusQry);
echo "unfriend";
}
else if($_POST['rtype']=="u" || $_POST['rtype']=="c" )
{	
 $updateFriendStatusQry = "UPDATE `friend` SET `status` = 'U' WHERE frnd_req_from_id = '".$_POST['fromID']."' AND frnd_req_to_id='".$_POST['toID']."'";
mysql_query($updateFriendStatusQry);
echo "add as friend";
}
else if($_POST['rtype']=="n"){
	$insertFriend = "INSERT INTO `friend`(`frnd_req_from_id`,`frnd_req_to_id`,`status`) VALUES ('".$_POST['fromID']."','".$_POST['toID']."','P')";
	mysql_query($insertFriend);
	echo "cancel request";
}

}
?>