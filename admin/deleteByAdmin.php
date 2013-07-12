<?php
include('../config/config1.php'); 
session_start();	
$member_ID = $_SESSION['login_user_id'];
	
	$deleteQry = "UPDATE `alacut_member` SET `active` = '2',`deleted_by`='".$member_ID."' WHERE `member_id`= '".$_REQUEST['id']."' ";
	mysql_query($deleteQry);
	header("location: userDetail.php");
?>