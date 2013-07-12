<?php
include('../config/config1.php'); 

	$approveMsgQry = "UPDATE `message` SET `active` = '1' WHERE `message_id`='".$_REQUEST['id']."'";
	mysql_query($approveMsgQry);
	header("location: messageDetail.php");
?>