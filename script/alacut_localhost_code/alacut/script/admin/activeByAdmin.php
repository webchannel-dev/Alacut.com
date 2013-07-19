<?php
include('../../config/config1.php'); 
	
	$activateQry = "UPDATE `alacut_member` SET `active` = '1' WHERE `member_id`= '".$_REQUEST['id']."' ";
	mysql_query($activateQry);
	header("location: userDetail.php");
?>