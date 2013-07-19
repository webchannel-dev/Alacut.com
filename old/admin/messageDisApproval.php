<?php
include('../config/config1.php'); 

	$disApproveMsgQry = "UPDATE `message` SET `active` = '0' WHERE `message_id`='".$_REQUEST['id']."'";
	mysql_query($disApproveMsgQry);
	header("location: messageDetail.php");
?>