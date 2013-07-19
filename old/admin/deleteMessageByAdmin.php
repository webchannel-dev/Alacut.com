<?php
include('../config/config1.php'); 

	$deleteMsgQry = "UPDATE `message` SET `status` = '2' WHERE `message_id`='".$_REQUEST['id']."'";
	mysql_query($deleteMsgQry);
	header("location: messageDetail.php");
?>