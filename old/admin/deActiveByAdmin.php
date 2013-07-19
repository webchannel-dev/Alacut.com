<?php
include('../config/config1.php'); 
	
	$deActivateQry = "UPDATE `alacut_member` SET `active` = '0' WHERE `member_id`= '".$_REQUEST['id']."' ";
	mysql_query($deActivateQry);
	header("location: userDetail.php");
?>